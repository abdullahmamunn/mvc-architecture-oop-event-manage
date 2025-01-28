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
        // Insert user into database
        $query = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $this->db->getConnection()->prepare($query);
        
        if ($stmt->execute($data)) {
            // If user creation is successful, fetch the user details and store them in session
            $user = $this->getUserByEmail($data['email']);
            
            // Store user details in session
            $_SESSION['user'] = $user;
            return true;
        }
        return false;
    }

    public function getUserByEmail($email)
    {
        $stmt = $this->db->getConnection()->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
