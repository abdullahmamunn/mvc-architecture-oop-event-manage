<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function exists(string $field, string $value): bool
    {
        $query = "SELECT COUNT(*) FROM users WHERE $field = :value";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bindParam(':value', $value);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function create(array $data): bool
    {
        $query = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $this->db->getConnection()->prepare($query);
        return $stmt->execute($data);
    }

    public function getUserByEmail($email)
    {
        $stmt = $this->db->getConnection()->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
