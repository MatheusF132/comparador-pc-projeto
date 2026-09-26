<?php

class PriceHistory
{ 
    public static function save (int $product, array $price) : void 
    {
        $stmt = Database::connect()->prepare(
            'INSERT INTO price_history (productId, store, value, url, imageUrl) VALUES (:productId, :store, :value, :url, :imageUrl)'
            );
            $stmt->execute([
            'productId' => $product,
            'store' => $price['store'],
            'value' => $price['value'],
            'url' => $price['url'],
            'imageUrl' => $price['image'] ?? null,
            ]);
    }
}