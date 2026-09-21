<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Repositories\PriceRepository;

class ProductService
{
    public function __construct(
        private ProductRepository $productRepository = new ProductRepository(),
        private PriceRepository $priceRepository = new PriceRepository()
    ) {
    }

    public function list(): array
    {
        return array_map(
            fn ($product) => $this->withPrices($product),
            $this->productRepository->findAll()
        );
    }

    public function search(string $query): array
    {
        return array_map(
            fn ($product) => $this->withPrices($product),
            $this->productRepository->search($query)
        );
    }

    public function getById(string $id): ?array
    {
        $product = $this->productRepository->findById($id);

        return $product ? $this->withPrices($product) : null;
    }

    private function withPrices($product): array
    {
        $data = $product->toArray();
        $data['prices'] = array_map(
            fn ($price) => $price->toArray(),
            $this->priceRepository->findByProductId($product->id)
        );

        return $data;
    }
}
