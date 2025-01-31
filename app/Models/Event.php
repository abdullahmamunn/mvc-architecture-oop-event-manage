<?php

namespace App\Models;

use PDO;

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

    public function getUpcomingEvents()
    {
        $stmt = $this->db->getConnection()->prepare("SELECT * FROM {$this->table} WHERE date >= CURDATE() ORDER BY date ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getFilterEvents($limit, $offset, $sortField = 'date', $sortOrder = 'ASC', $filters = [])
    {
        $query = "SELECT e.*, u.name AS organizer_name 
                  FROM {$this->table} e
                  LEFT JOIN users u ON e.user_id = u.id";
        
        $conditions = [];
        $params = [];
    
        // Add filters
        if (!empty($filters['location'])) {
            $conditions[] = 'e.location LIKE :location';
            $params['location'] = '%' . $filters['location'] . '%';
        }
        if (!empty($filters['name'])) {
            $conditions[] = 'e.name LIKE :name';
            $params['name'] = '%' . $filters['name'] . '%';
        }
        if (!empty($filters['upcoming'])) {
            $conditions[] = 'e.date >= CURDATE()';
        }
    
        if ($conditions) {
            $query .= ' WHERE ' . implode(' AND ', $conditions);
        }
    
        // Add sorting
        $query .= " ORDER BY e.{$sortField} {$sortOrder}";
    
        // Add pagination
        $query .= " LIMIT :limit OFFSET :offset";
    
        $stmt = $this->db->getConnection()->prepare($query);
    
        // Bind parameters (cast limit and offset to integers)
        foreach ($params as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
    
        $stmt->execute();
    
        return $stmt->fetchAll();
    }
    
    public function countEvents($filters = [])
    {
        $query = "SELECT COUNT(*) as total FROM {$this->table}";
        $conditions = [];
        $params = [];

        if (!empty($filters['location'])) {
            $conditions[] = 'location LIKE :location';
            $params['location'] = '%' . $filters['location'] . '%';
        }
        
        if (!empty($filters['upcoming'])) {
            $conditions[] = 'date >= CURDATE()';
        }

        if ($conditions) {
            $query .= ' WHERE ' . implode(' AND ', $conditions);
        }

        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    public function getEventAttendees($eventId)
    {
        $query = "SELECT e.name AS event_name, 
                         e.id, e.description, e.date, e.time, e.location, e.max_capacity,
                         a.name AS attendee_name, a.email, a.phone, a.registered_at, 
                         u.name AS organizer_name
                  FROM events e
                  LEFT JOIN attendees a ON a.event_id = e.id
                  JOIN users u ON e.user_id = u.id
                  WHERE e.id = :event_id"; // Ensure to use e.id for the event filter
    
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bindParam(':event_id', $eventId, \PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function Search($query)
    {
        $stmt = $this->db->getConnection()->prepare("
        SELECT 'event' AS type, id, name FROM events WHERE name LIKE :query
        UNION 
        SELECT 'attendee' AS type, id, name FROM attendees WHERE name LIKE :query
    ");
    $stmt->execute(['query' => "%$query%"]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
    }
    
    

}
