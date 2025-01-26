<?php

namespace App\Models;

use App\Models\BaseModel;

class Attendee extends BaseModel
{
    protected $table = 'attendees';

    public function registerAttendee($data)
    {
        $stmt = $this->db->getConnection()->prepare("
            INSERT INTO {$this->table} (event_id, name, email, phone)
            VALUES (:event_id, :name, :email, :phone)
        ");
        return $stmt->execute($data);
    }

    public function countAttendees($eventId)
    {
        $stmt = $this->db->getConnection()->prepare("
            SELECT COUNT(*) AS count FROM {$this->table} WHERE event_id = :event_id
        ");
        $stmt->execute(['event_id' => $eventId]);
        return $stmt->fetch()['count'];
    }

    public function isAlreadyRegistered($eventId, $email)
    {
        $stmt = $this->db->getConnection()->prepare("
            SELECT COUNT(*) 
            FROM {$this->table} 
            WHERE event_id = :event_id AND email = :email
        ");
        $stmt->execute([
            'event_id' => $eventId,
            'email' => $email
        ]);

        return $stmt->fetchColumn() > 0;
    }
}
