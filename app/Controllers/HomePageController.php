<?php

namespace App\Controllers;

use App\Models\Event;

class HomePageController
{
    public function home()
    {
        $limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 12;
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        $sortField = $_GET['sortField'] ?? 'date';
        $sortOrder = $_GET['sortOrder'] ?? 'ASC';

        $event = new Event();
        $events = $event->getAllDataWithPaginate($limit, $offset, $sortField, $sortOrder);

        $totalEvents = $event->count();
        $totalPages = ceil($totalEvents / $limit);

        require_once __DIR__ . '/../Views/home.php';
    }

    public function eventDetails($id) {

        $event = new Event();
        $eventDetails = $event->getEventAttendees($id);
        $event = $eventDetails[0];
        
        // var_dump($event);
        // die();

        require_once __DIR__ . '/../Views/events/details.php';
    }

    public function search()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['query'])) {
            $query = trim($_POST['query']);
            $event = new Event();
            $results = $event->Search($query);
            
                if ($results) {
                    foreach ($results as $row) {
                        if ($row['type'] == 'event') {
                            echo "<div class='search-item'><a href='/event/details/{$row['id']}'>📅 Event: {$row['name']}</a></div>";
                        } else {
                            echo "<div class='search-item'><a href='/event/details/{$row['id']}'>👤 Attendee: {$row['name']}</a></div>";
                        }
                    }
                } else {
                    echo "<div class='search-item'>No results found.</div>";
                }
        }
    }
}   
