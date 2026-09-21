<?php

// Recebe cada requisição que chega na API e chama a classe certa
class Router
{
    public static function dispatch(): void
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');

        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $parts = explode('/', $uri);
        array_shift($parts);

        $id = $parts[1] ?? null;
        $sub = $parts[2] ?? null;

        if ($id && $sub === 'prices') {
            $product = Product::find($id);
            echo json_encode($product ? PriceFetcher::fetch($product['name']) : []);
            return;
        }

        if ($id) {
            $product = Product::find($id);
            if (!$product) {
                http_response_code(404);
                echo json_encode(['error' => 'Produto não encontrado']);
                return;
            }
            $product['prices'] = PriceFetcher::fetch($product['name']);
            echo json_encode($product);
            return;
        }

        $search = $_GET['search'] ?? null;
        echo json_encode($search ? Product::search($search) : Product::all());
    }
}