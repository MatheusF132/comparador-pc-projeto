<?php

function loadEnv(string $path): void
{
    if (!file_exists($path)) {
        return;
    }

    foreach (file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        if (str_starts_with(trim($line), '#')) {
            continue;
        }
        [$key, $value] = array_map('trim', explode('=', $line, 2));
        $_ENV[$key] = $value;
    }
}
// monta o caminho da pasta onde esse arquivo (init.php) está
$path = realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR;

loadEnv("{$path}/../.env");
require_once "{$path}/../classes/autoload.php";

date_default_timezone_set($_ENV['APP_TIMEZONE'] ?? 'America/Sao_Paulo');