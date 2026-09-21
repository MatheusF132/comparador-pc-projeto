<?php

namespace App\Database;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $connection = null;

    public static function getConnection(): PDO
    {
        if (self::$connection === null) {
            $config = require __DIR__ . '/../Config/config.php';
            $db = $config['database'];

            $dsn = "mysql:host={$db['host']};port={$db['port']};dbname={$db['database']};charset=utf8mb4";

            try {
                self::$connection = new PDO($dsn, $db['username'], $db['password'], [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            } catch (PDOException $e) {
                throw new PDOException('Falha na conexão com o banco: ' . $e->getMessage());
            }
        }

        return self::$connection;
    }
}
