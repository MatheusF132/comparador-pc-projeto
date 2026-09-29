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
    public static function latestFor(int $productId): ?array
{
    $stmt = Database::connect()->prepare(
        'SELECT * FROM price_history WHERE productId = :productId ORDER BY fetchedAt DESC LIMIT 1'
    );
    $stmt->execute(['productId' => $productId]);

    $preco = $stmt->fetch();
    return $preco ?: null;
}
}