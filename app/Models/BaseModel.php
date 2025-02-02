<?php

namespace App\Models;

use App\Services\Database;
use PDO;

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

    public function getAllDataWithPaginate($limit, $offset, $sortField = 'date', $sortOrder = 'ASC') {
        $query = "SELECT * FROM {$this->table}";
         // Add sorting
         $query .= " ORDER BY {$sortField} {$sortOrder}";
    
         // Add pagination
         $query .= " LIMIT :limit OFFSET :offset";
     
         $stmt = $this->db->getConnection()->prepare($query);

         $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
         $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
     
         $stmt->execute();
     
         return $stmt->fetchAll();
    }

    public function count()
    {
        $query = "SELECT COUNT(*) as total FROM {$this->table}";
       
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

}
