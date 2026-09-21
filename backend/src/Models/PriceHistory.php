<?php

namespace App\Models;

class PriceHistory
{
    public string $id;
    public string $productId;
    public string $storeId;
    public float $value;
    public string $url;
    public string $updatedAt;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->productId = $data['product_id'];
        $this->storeId = $data['store_id'];
        $this->value = (float) $data['value'];
        $this->url = $data['url'];
        $this->updatedAt = $data['updated_at'];
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'productId' => $this->productId,
            'storeId' => $this->storeId,
            'value' => $this->value,
            'url' => $this->url,
            'updatedAt' => $this->updatedAt,
        ];
    }
}
