<?php

use Dotenv\Dotenv;

// Load .env file
$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

// Access environment variables
return [
    'app_name' => $_ENV['APP_NAME'],
    'app_env' => $_ENV['APP_ENV'],
    'app_debug' => filter_var($_ENV['APP_DEBUG'], FILTER_VALIDATE_BOOLEAN),
    'db' => [
        'host' => $_ENV['DB_HOST'],
        'port' => $_ENV['DB_PORT'],
        'database' => $_ENV['DB_DATABASE'],
        'username' => $_ENV['DB_USERNAME'],
        'password' => $_ENV['DB_PASSWORD'],
    ],
];
