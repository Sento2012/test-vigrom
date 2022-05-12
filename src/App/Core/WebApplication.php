<?php

namespace App\Core;

use Exception;

class WebApplication extends BaseApplication
{
    public function run(): void
    {
        try {
            $request = $this->createRequest();
            [$controller, $arguments] = $request->getControllerWithArguments($this->containerBuilder);
            echo $this->createResponse()->getSuccessResponse($controller, $arguments);
        } catch (Exception $e) {
            echo $this->createResponse()->getFailedResponse($e->getMessage());
        }
    }

    protected function createResponse(): Response
    {
        return new Response();
    }

    protected function createRequest(): Request
    {
        return new Request();
    }
}