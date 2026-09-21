<?php

return [
    'app' => [
        'env' => $_ENV['APP_ENV'] ?? 'local',
        'debug' => filter_var($_ENV['APP_DEBUG'] ?? true, FILTER_VALIDATE_BOOLEAN),
        'url' => $_ENV['APP_URL'] ?? 'http://localhost:8000',
    ],
    'database' => [
        'host' => $_ENV['DB_HOST'] ?? '127.0.0.1',
        'port' => $_ENV['DB_PORT'] ?? '3306',
        'database' => $_ENV['DB_DATABASE'] ?? 'comparador_pc',
        'username' => $_ENV['DB_USERNAME'] ?? 'root',
        'password' => $_ENV['DB_PASSWORD'] ?? '',
    ],
];
