<?php

// Autoloader: carrega a classe automaticamente pelo nome do arquivo,
// sem precisar de require_once pra cada uma
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/' . $class . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});