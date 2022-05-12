<?php

namespace App\Core;

class Enum
{
    public const CONFIG_ROUTES = 'routes';
    public const CONFIG_ROUTES_NAME = 'name';
    public const CONFIG_ROUTES_ROUTE = 'route';
    public const CONFIG_ROUTES_METHODS = 'method';
    public const CONFIG_ROUTES_ACTION = 'action';
    public const CONFIG_ROUTES_PARAMS = 'params';

    public const DATABASE_CONFIG = 'db';
    public const DATABASE_CONFIG_DRIVER = 'driver';
    public const DATABASE_CONFIG_HOST = 'host';
    public const DATABASE_CONFIG_DATABASE = 'database';
    public const DATABASE_CONFIG_USER = 'user';
    public const DATABASE_CONFIG_PASSWORD = 'password';
    public const DATABASE_CONFIG_CHARSET = 'charset';
    public const DATABASE_CONFIG_COLLATION = 'collation';
    public const DATABASE_CONFIG_PORT = 'port';
    public const DATABASE_CONFIG_PREFIX = 'prefix';

    public const TIMEZONE_API_KEY = 'timezone_api_key';
}