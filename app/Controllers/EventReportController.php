<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Models\Attendee;
use App\Models\Event;

class EventReportController
{
   public function showAllEvent()
   {
      $event = new Event();

      $limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 10;
      $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
      $offset = ($page - 1) * $limit;


      $sortField = $_GET['sortField'] ?? 'date';
      $sortOrder = $_GET['sortOrder'] ?? 'ASC';

      $filters = [
          'location' => $_GET['location'] ?? null,
          'organizer' => $_GET['organizer'] ?? null,
          'upcoming' => $_GET['upcoming'] ?? null,
      ];

      $events = $event->getPaginatedEvents($limit, $offset, $sortField, $sortOrder, $filters);
      $totalEvents = $event->countEvents($filters);

      $totalPages = ceil($totalEvents / $limit);

      if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) and $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
        // Only return the main content for AJAX
        include_once __DIR__ . '/../Views/Dashboard/partials/content.php';
        return;
    }

    // Include the full layout for non-AJAX requests
    include_once __DIR__ . '/../Views/reports/index.php';
   }


   public function downloadAttendeeReport()
   {
       // Ensure the admin is logged in
       $auth = Auth::getUser();

       if (!$auth || $auth['role'] !== 'admin') {
           http_response_code(403);
           
           return redirectWithMessage('/reports', 'Sorry, You dont have permission to access this resources!', 'danger');
       }

       // Get event ID from the query parameter
       $eventId = $_GET['event_id'] ?? null;
       if (!$eventId) {
           
           return redirectWithMessage('/reports', 'Event ID is required', 'danger');
       }

       $attendee = new Attendee();
       $attendees = $attendee->getAttendeesByEvent($eventId);

       // Check if attendees exist
       if (empty($attendees)) {

           return redirectWithMessage('/reports', 'No attendees found for this event.', 'danger');
       }

       // Generate CSV
       $csvFilename = "event_{$eventId}_attendees.csv";
       header('Content-Type: text/csv');
       header('Content-Disposition: attachment;filename="' . $csvFilename . '"');

       $output = fopen('php://output', 'w');
       fputcsv($output, ['Name', 'Email', 'Phone', 'Registered At']); // CSV header

       foreach ($attendees as $attendee) {
           fputcsv($output, [
               $attendee['name'],
               $attendee['email'],
               $attendee['phone'],
               $attendee['registered_at']
           ]);
       }

       fclose($output);
       exit;

   }

}
