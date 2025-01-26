<?php

namespace App\Controllers;

use App\Models\Event;

class HomePageController
{
    public function home()
    {
        $event = new Event();
        $events = $event->getAll(); // Fetch all events from the database.

        require_once __DIR__ . '/../Views/home.php';
    }
}
