<?php
namespace App\Controllers;

use App\Core\Auth;
use App\Models\Event;

class EventController
{
    public function index() {
      $event = new Event();
      $user  = Auth::getUser();
      
      // $events  = $event->getAll();
      // var_dump($ls);
      $events = $event->getAllEvents($user['id']);
 
      require_once __DIR__ . '/../Views/events/index.php';

    }

    public function create() {
      $event = new Event();
      $user  = Auth::getUser();
      
      $events  = $event->getAll();
      // var_dump($ls);
      // $event->getAllEvents($user['id']);
 
      require_once __DIR__ . '/../Views/events/create.php';

    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $auth = Auth::getUser(); // Ensure user is authenticated
          $data = [
              'user_id' => $auth['id'], // Pass user ID to the model
              'name' => $_POST['name'],
              'description' => $_POST['description'],
              'date' => $_POST['date'],
              'time' => $_POST['time'],
              'location' => $_POST['location'],
              'max_capacity' => $_POST['max_capacity']
          ];

      
          $event= new Event();
          if ($event->createEvent($data)) {
              header("Location: /events");
              exit;
          }
      }
    
    }

    public function edit($id) {

      $event = new Event();
      $eventData = $event->find($id);
      
      require_once __DIR__ . '/../Views/events/edit.php';

    }

    public function update($id) {

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $auth = Auth::getUser();
       
        $data = [
            'name'        => $_POST['name'],
            'user_id'     => $auth['id'],
            'description' => $_POST['description'],
            'date'        => $_POST['date'],
            'time'        => $_POST['time'],
            'location'    => $_POST['location'],
            'max_capacity'=> $_POST['max_capacity']
        ];
    
        $event = new Event();
        if ($event->updateEvent($id, $data)) {
            header("Location: /events");
            exit;
        }
    }
    

    }
}

?>
