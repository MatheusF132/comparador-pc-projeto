<?php

namespace App\Controllers;

use App\Database\Database;

class StoreController
{
    public function index(): void
    {
        $stmt = Database::getConnection()->query('SELECT * FROM stores ORDER BY name ASC');

        header('Content-Type: application/json');
        echo json_encode($stmt->fetchAll());
    }
}
