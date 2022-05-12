<?php

namespace App\Core;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpFoundation\Request as WebRequest;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class Request
{
    protected const CORRECT_COUNT_CONTROLLER_NAME_PARTS = 2;

    protected RequestContext $requestContext;
    protected ControllerResolver $controllerResolver;
    protected ArgumentResolver $argumentResolver;

    public function __construct()
    {
        $this->requestContext = new RequestContext();
        $this->controllerResolver = new ControllerResolver();
        $this->argumentResolver = new ArgumentResolver();
    }

    protected function getRegisterRoutes(): RouteCollection
    {
        $routes = new RouteCollection();
        foreach (ConfigManager::getRoutes() as $routeItem) {
            $route = $this->createRoute($routeItem);
            $routes->add(
                $routeItem[Enum::CONFIG_ROUTES_NAME],
                $route,
            );
        }

        return $routes;
    }

    protected function createRoute(array $routeItem): Route
    {
        return new Route(
            $routeItem[Enum::CONFIG_ROUTES_ROUTE],
            $routeItem[Enum::CONFIG_ROUTES_ACTION],
            $routeItem[Enum::CONFIG_ROUTES_PARAMS],
            [],
            '',
            [],
            $routeItem[Enum::CONFIG_ROUTES_METHODS],
        );
    }

    public function getControllerWithArguments(ContainerBuilder $containerBuilder): ?array
    {
        $request = WebRequest::createFromGlobals();
        $this->requestContext->fromRequest($request);
        $request->attributes->add($this->createUrlMatcher()->match($request->getPathInfo()));
        $controllerNameParts = explode('::', $request->attributes->get('_controller'));
        if (count($controllerNameParts) != static::CORRECT_COUNT_CONTROLLER_NAME_PARTS) {
            return null;
        }
        $controllerInstance = new $controllerNameParts[0]($containerBuilder);
        $responseApplicationController = [$controllerInstance, $controllerNameParts[1]];
        $controller = $this->controllerResolver->getController($request);
        $arguments = $this->argumentResolver->getArguments($request, $controller);

        return [$responseApplicationController, $arguments];
    }

    protected function createUrlMatcher(): UrlMatcher
    {
        return new UrlMatcher($this->getRegisterRoutes(), $this->requestContext);
    }
}