<?php

namespace App\Core;

use Illuminate\Database\Capsule\Manager as Capsule;
use Symfony\Component\DependencyInjection\ContainerBuilder;

abstract class BaseApplication
{
    protected ContainerBuilder $containerBuilder;

    public function __construct(array $config, ContainerBuilder $containerBuilder)
    {
        ConfigManager::load($config);
        $this->loadDatabase();
        $this->containerBuilder = $containerBuilder;
    }

    private function loadDatabase(): void
    {
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver' => ConfigManager::getDatabaseConfig(Enum::DATABASE_CONFIG_DRIVER),
            'host' => ConfigManager::getDatabaseConfig(Enum::DATABASE_CONFIG_HOST),
            'database' => ConfigManager::getDatabaseConfig(Enum::DATABASE_CONFIG_DATABASE),
            'username' => ConfigManager::getDatabaseConfig(Enum::DATABASE_CONFIG_USER),
            'password' => ConfigManager::getDatabaseConfig(Enum::DATABASE_CONFIG_PASSWORD),
            'charset' => ConfigManager::getDatabaseConfig(Enum::DATABASE_CONFIG_CHARSET),
            'collation' => ConfigManager::getDatabaseConfig(Enum::DATABASE_CONFIG_COLLATION),
            'port' => ConfigManager::getDatabaseConfig(Enum::DATABASE_CONFIG_PORT),
            'prefix' => ConfigManager::getDatabaseConfig(Enum::DATABASE_CONFIG_PREFIX),
        ]);
        $capsule->setAsGlobal();
    }

    abstract public function run(): void;
}