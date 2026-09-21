<?php

namespace App\Repositories;

use App\Database\Database;
use App\Models\PriceHistory;
use PDO;

class PriceRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function findByProductId(string $productId): array
    {
        $stmt = $this->db->prepare(
            'SELECT ph.*, s.name AS store_name
             FROM price_history ph
             JOIN stores s ON s.id = ph.store_id
             WHERE ph.product_id = :product_id
             ORDER BY ph.updated_at DESC'
        );
        $stmt->execute(['product_id' => $productId]);

        return array_map(fn ($row) => new PriceHistory($row), $stmt->fetchAll());
    }

    public function create(array $data): void
    {
        $stmt = $this->db->prepare(
            'INSERT INTO price_history (id, product_id, store_id, value, url, updated_at)
             VALUES (:id, :product_id, :store_id, :value, :url, NOW())'
        );
        $stmt->execute($data);
    }
}
