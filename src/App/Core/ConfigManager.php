<?php

namespace App\Core;

class ConfigManager
{
    private static array $config;

    public static function load(array $config)
    {
        self::$config = $config;
    }

    public static function getRoutes(): array
    {
        return self::$config[Enum::CONFIG_ROUTES] ?? [];
    }

    public static function getDatabaseConfig(string $key): string
    {
        return self::$config[Enum::DATABASE_CONFIG][$key] ?? '';
    }

    public static function getTimezoneApiKey(): string
    {
        return self::$config[Enum::TIMEZONE_API_KEY] ?? '';
    }
}
