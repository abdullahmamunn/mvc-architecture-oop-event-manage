<?php

namespace App\Models;

class Event extends BaseModel
{
    protected $table = 'events';

    public function getAllEvents($userId)
    {
        $stmt = $this->db->getConnection()->prepare("SELECT * FROM {$this->table} WHERE user_id = :userId ORDER BY date, time");
        $stmt->execute(['userId' => $userId]);
        return $stmt->fetchAll();
    }

    public function createEvent($data)
    {
        $stmt = $this->db->getConnection()->prepare("INSERT INTO {$this->table} 
            (user_id, name, description, date, time, location, max_capacity) 
            VALUES (:user_id, :name, :description, :date, :time, :location, :max_capacity)");
        return $stmt->execute($data);
    }

    public function updateEvent($id, $data)
    {
        $stmt = $this->db->getConnection()->prepare("UPDATE {$this->table} 
            SET name = :name, description = :description, date = :date, time = :time, location = :location, max_capacity = :max_capacity 
            WHERE id = $id AND user_id = :user_id");
        return $stmt->execute($data);
    }

    public function deleteEvent($eventId, $userId)
    {
        $stmt = $this->db->getConnection()->prepare("DELETE FROM {$this->table} WHERE id = :id AND user_id = :user_id");
        return $stmt->execute(['id' => $eventId, 'user_id' => $userId]);
    }

    public function getUpcomingEvents()
    {
        $stmt = $this->db->getConnection()->prepare("SELECT * FROM {$this->table} WHERE date >= CURDATE() ORDER BY date ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
