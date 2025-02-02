<?php
namespace App\Controllers;

use App\Models\Event;

class DashboardController
  {

      public function index() {
          $event = new Event();

          // $limit = $_GET['limit'] ?? 10;
          // $page = $_GET['page'] ?? 1;
          // $offset = ($page - 1) * $limit;

          $limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 10;
          $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
          $offset = ($page - 1) * $limit;


          $sortField = $_GET['sortField'] ?? 'date';
          $sortOrder = $_GET['sortOrder'] ?? 'ASC';

          $filters = [
              'location' => $_GET['location'] ?? null,
              'name'     => $_GET['name'] ?? null,
              'upcoming' => $_GET['upcoming'] ?? null,
          ];

          $events = $event->getFilterEvents($limit, $offset, $sortField, $sortOrder, $filters);
          
          $totalEvents = $event->countEvents($filters);

          $totalPages = ceil($totalEvents / $limit);

          if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) and $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
            // Only return the main content for AJAX
            include_once __DIR__ . '/../Views/dashboard/partials/content.php';
            return;
        }
    
        // Include the full layout for non-AJAX requests
        include_once __DIR__ . '/../Views/dashboard/index.php';
      }

  }


?>
