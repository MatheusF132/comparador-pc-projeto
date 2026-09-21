<?php

namespace App\Services;

use App\Repositories\PriceRepository;

class PriceService
{
    public function __construct(
        private PriceRepository $priceRepository = new PriceRepository()
    ) {
    }

    public function getHistory(string $productId): array
    {
        return array_map(
            fn ($price) => $price->toArray(),
            $this->priceRepository->findByProductId($productId)
        );
    }

    public function registerPrice(array $data): void
    {
        $this->priceRepository->create($data);
    }
}
