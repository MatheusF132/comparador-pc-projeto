<?php

namespace App\Controllers;

use App\Services\ProductService;

class ProductController
{
    public function __construct(
        private ProductService $productService = new ProductService()
    ) {
    }

    public function index(): void
    {
        $search = $_GET['search'] ?? null;

        $products = $search
            ? $this->productService->search($search)
            : $this->productService->list();

        $this->json($products);
    }

    public function show(string $id): void
    {
        $product = $this->productService->getById($id);

        if (!$product) {
            http_response_code(404);
            $this->json(['error' => 'Produto não encontrado']);
            return;
        }

        $this->json($product);
    }

    private function json($data): void
    {
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
