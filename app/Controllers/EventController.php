<?php
namespace App\Controllers;

use App\Core\Auth;
use App\Core\Validator;
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

           // Validation rules
        $rules = [
            'name' => ['required', ['max', 150]],
            'description' => ['required'],
            'date' => ['required', 'date'],
            'time' => ['required', 'time'],
            'location' => ['required'],
            'max_capacity' => ['required', 'integer', ['min', 1]],
        ];

        $validator = new Validator();

        if(!$validator->validate($data, $rules)) {
          
          $errors = $validator->getErrors();

          // Pass errors and data back to the form
          require_once __DIR__ . '/../Views/events/create.php';
          return;
        }


      
          $event= new Event();
          if ($event->createEvent($data)) {
              
              return redirectWithMessage('/events', 'Event Created Successfully', 'success');

          }
      }
    
    }

    public function show($id) {
      
        $event = new Event();
        $eventDetails = $event->find($id);

        require_once __DIR__ . '/../Views/events/show.php';
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
           
            return redirectWithMessage('/events', 'Event Data Updated Successfully!', 'success');
        }
    }
    

    }

    public function delete($id) {

    $event = new Event();
    $user = Auth::getUser();
    $eventDetails = $event->find($id);
    
    if (!$eventDetails || $eventDetails['user_id'] != $user['id']) {
        http_response_code(403);
        
        return redirectWithMessage('/events', 'Unauthorized or event not found!', 'warning');
    }

    // Delete the event
    $event->delete($id);

    return redirectWithMessage('/events', 'Event deleted successfully!', 'success');
  }


}

?>
