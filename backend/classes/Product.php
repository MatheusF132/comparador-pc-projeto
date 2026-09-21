<?php

// Tudo relacionado a "produto" no banco: listar, buscar, achar por id
class Product
{
    public static function all(): array
    {
        $stmt = Database::connect()->query('SELECT * FROM products ORDER BY name');
        return $stmt->fetchAll();
    }

    public static function search(string $query): array
    {
        $stmt = Database::connect()->prepare('SELECT * FROM products WHERE name LIKE :query');
        $stmt->execute(['query' => "%{$query}%"]);
        return $stmt->fetchAll();
    }

    public static function find(string $id): ?array
    {
        $stmt = Database::connect()->prepare('SELECT * FROM products WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $product = $stmt->fetch();
        return $product ?: null;
    }
}