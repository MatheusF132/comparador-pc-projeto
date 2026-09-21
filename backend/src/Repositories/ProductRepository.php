<?php

namespace App\Repositories;

use App\Database\Database;
use App\Models\Product;
use PDO;

class ProductRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function findAll(): array
    {
        $stmt = $this->db->query('SELECT * FROM products ORDER BY name ASC');
        return array_map(fn ($row) => new Product($row), $stmt->fetchAll());
    }

    public function findById(string $id): ?Product
    {
        $stmt = $this->db->prepare('SELECT * FROM products WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        return $row ? new Product($row) : null;
    }

    public function search(string $query): array
    {
        $stmt = $this->db->prepare('SELECT * FROM products WHERE name LIKE :query ORDER BY name ASC');
        $stmt->execute(['query' => "%{$query}%"]);

        return array_map(fn ($row) => new Product($row), $stmt->fetchAll());
    }
}
