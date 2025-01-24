<?php

namespace App\Core;

use PDO;
use PDOException;
use Dotenv\Dotenv;

class Database
{
    private $connection;

    public function __construct()
    {
        // Load .env file
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();

        $host = $_ENV['DB_HOST'];
        $dbName = $_ENV['DB_DATABASE'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];

        try {
            $this->connection = new PDO(
                "mysql:host=$host;dbname=$dbName;charset=utf8mb4",
                $username,
                $password
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
