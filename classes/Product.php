<?php

class Product
{
    public static function all(): array
    {
        $stmt = Database::connect()->query('SELECT * FROM products ORDER BY name');
        return $stmt->fetchAll();
    }

    public static function search(string $query): array
    {
        $stmt = Database::connect()->prepare('SELECT * FROM products WHERE name LIKE :query ORDER BY name');
        $stmt->execute(['query' => "%{$query}%"]);
        return $stmt->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $stmt = Database::connect()->prepare('SELECT * FROM products WHERE productId = :id');
        $stmt->execute(['id' => $id]);
        $product = $stmt->fetch();
        return $product ?: null;
    }
}