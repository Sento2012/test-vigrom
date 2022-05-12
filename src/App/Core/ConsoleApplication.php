<?php

namespace App\Core;

use Exception;

class ConsoleApplication extends BaseApplication
{
    public function run(): void
    {
        try {
            $controllerName = $this->getControllerName();
            $actionName = $_SERVER['argv'][2];
            $controller = new $controllerName($this->containerBuilder);
            if (method_exists($controller, $actionName)) {
                echo $controller->$actionName();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            return;
        }
    }

    protected function getControllerName(): string
    {
        return preg_replace('/\./isu', '\\', $_SERVER['argv'][1]);
    }
}
