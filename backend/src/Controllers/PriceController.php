<?php

namespace App\Controllers;

use App\Services\PriceService;

class PriceController
{
    public function __construct(
        private PriceService $priceService = new PriceService()
    ) {
    }

    public function history(string $productId): void
    {
        header('Content-Type: application/json');
        echo json_encode($this->priceService->getHistory($productId));
    }
}
