<?php

use App\Controllers\ProductController;
use App\Controllers\StoreController;
use App\Controllers\PriceController;

$method = $_SERVER['REQUEST_METHOD'];
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$segments = explode('/', $uri);

// Espera-se URIs no formato: api/products, api/products/{id}, api/products/{id}/prices, api/stores

array_shift($segments); // remove "api"
$resource = $segments[0] ?? null;
$id = $segments[1] ?? null;
$sub = $segments[2] ?? null;

if ($resource === 'products' && $method === 'GET') {
    if ($id && $sub === 'prices') {
        (new PriceController())->history($id);
    } elseif ($id) {
        (new ProductController())->show($id);
    } else {
        (new ProductController())->index();
    }
} elseif ($resource === 'stores' && $method === 'GET') {
    (new StoreController())->index();
} else {
    http_response_code(404);
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Rota não encontrada']);
}
