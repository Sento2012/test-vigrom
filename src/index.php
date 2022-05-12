<?php

define('__ROOT__', __DIR__);

require_once 'vendor/autoload.php';
require_once 'App/Core/ConsoleApplication.php';
require_once 'App/Core/WebApplication.php';
require_once 'App/Core/Enum.php';

use App\Core\ConsoleApplication;
use App\Core\WebApplication;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$config = require_once __ROOT__ . '/config.php';
$isCLI = ( php_sapi_name() == 'cli' );

$dependencyContainer = new ContainerBuilder();
$loader = new YamlFileLoader($dependencyContainer, new FileLocator(__ROOT__));
$loader->load(__ROOT__ . '/services.yaml');

if (!$isCLI) {
    $application = new WebApplication($config, $dependencyContainer);
} else {
    $application = new ConsoleApplication($config, $dependencyContainer);
}
$application->run();
