<?php

use App\Controllers\TransactionController;
use App\Controllers\WalletController;
use app\Core\Enum;

return [
    Enum::CONFIG_ROUTES => [
        [
            Enum::CONFIG_ROUTES_NAME => 'add-transaction',
            Enum::CONFIG_ROUTES_ROUTE => '/transaction',
            Enum::CONFIG_ROUTES_ACTION => ['_controller' => TransactionController::class . '::post'],
            Enum::CONFIG_ROUTES_METHODS => ['POST'],
            Enum::CONFIG_ROUTES_PARAMS => ['amount' => '.+'],
        ],
        [
            Enum::CONFIG_ROUTES_NAME => 'get-wallet',
            Enum::CONFIG_ROUTES_ROUTE => '/wallet/{id}',
            Enum::CONFIG_ROUTES_ACTION => ['_controller' => WalletController::class . '::get'],
            Enum::CONFIG_ROUTES_METHODS => ['GET'],
            Enum::CONFIG_ROUTES_PARAMS => ['id' => '[\d]+'],
        ],
    ],
    Enum::DATABASE_CONFIG => [
        Enum::DATABASE_CONFIG_DRIVER => 'mysql',
        Enum::DATABASE_CONFIG_HOST => 'db-test-api',
        Enum::DATABASE_CONFIG_DATABASE => 'root',
        Enum::DATABASE_CONFIG_USER => 'root',
        Enum::DATABASE_CONFIG_PASSWORD => 'root',
        Enum::DATABASE_CONFIG_CHARSET => 'utf8',
        Enum::DATABASE_CONFIG_COLLATION => 'utf8_unicode_ci',
        Enum::DATABASE_CONFIG_PORT => 3306,
        Enum::DATABASE_CONFIG_PREFIX => '',
    ],
    Enum::TIMEZONE_API_KEY => 'FTP62P35AHF5',
];
