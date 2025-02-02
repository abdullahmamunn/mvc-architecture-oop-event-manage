<?php

namespace App\Controllers;

use App\Services\Auth;
use App\Models\Event;
use App\Models\Attendee;
use App\Services\Validator;

class AttendeeController
{
    public function registerForm($eventId)
    {
        $event = new Event();
        $eventDetails = $event->find($eventId);

        if (!$eventDetails) {
            http_response_code(404);
            echo "Event not found!";
            return;
        }

        require_once __DIR__ . '/../Views/attendees/register.php';
    }

    public function register()
    {

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $eventId = $_POST['event_id'];
          $event = new Event();
          $attendee = new Attendee();
          $eventDetails = $event->find($eventId);

          if (!$eventDetails) {
              http_response_code(404);
              echo "Event not found!";
              return;
          }

          $validator = new Validator();
          $data = [
              'name' => $_POST['name'],
              'email' => $_POST['email'],
              'phone' => $_POST['phone']
          ];
          $rules = [
              'name' => ['required', ['max', 100]],
              'email' => ['required', ['max', 150]],
              'phone' => ['required', ['max', 15]]
          ];

          if (!$validator->validate($data, $rules)) {
            // Collect all validation errors into a flat array
              $validationErrors = [];
              foreach ($validator->getErrors() as $field => $messages) {
                  foreach ($messages as $message) {
                      $validationErrors[] = $message; // Flatten the errors
                  }
              }
              header('Content-Type: application/json');
              echo json_encode(['success' => false, 'errors' => $validationErrors]);
              return;
          }

          // Check if the user is already registered
          if ($attendee->isAlreadyRegistered($eventId, $data['email'])) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'errors' => ['You are already registered for this event.']]);
            return;
          }

          // Check if the event is full
          $currentAttendees = $attendee->countAttendees($eventId);

          if ($currentAttendees >= $eventDetails['max_capacity']) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'errors' => ['The event is fully booked!.']]);
            return;
          }

          $data['event_id'] = $eventId;

          if ($attendee->registerAttendee($data)) {
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'name' => $data['name']]);
            return;
          } else {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'errors' => ['Failed to register for the event.']]);
          }
      }
    }
}
