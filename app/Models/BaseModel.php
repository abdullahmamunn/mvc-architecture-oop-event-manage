<?php

namespace App\Models;

use App\Core\Database;

class BaseModel
{
    protected $db;
    protected $table;

    public function __construct()
    {
        $this->db = new Database(); // Use the Database connection from Core
    }

    public function find($id)
    {
        $stmt = $this->db->getConnection()->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function getAll()
    {
        $stmt = $this->db->getConnection()->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll();
    }

    public function delete($id)
    {
        $stmt = $this->db->getConnection()->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
