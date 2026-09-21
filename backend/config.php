<?php
// Lê as variáveis do .env e devolve como array simples
return [
    'host' => $_ENV['DB_HOST'] ?? '127.0.0.1',
    'database' => $_ENV['DB_DATABASE'] ?? 'comparador_pc',
    'username' => $_ENV['DB_USERNAME'] ?? 'root',
    'password' => $_ENV['DB_PASSWORD'] ?? '',
];
