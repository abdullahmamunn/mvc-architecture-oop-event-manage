<?php
$title = "dashboard";
include __DIR__ . '/../templates/header.php';
include __DIR__ . '/../templates/sidebar.php';
?>

<!-- Content -->
<div class="flex-grow-1" style="margin-left: 250px;">
  <div id="dashboardContent">
    <!-- Dashboard content goes here -->
    <div class="p-3">
      <h3 class="text-center">Welcome to the Event Dashboard</h3>
    </div>
    <div class="container">
      <!-- Filter Form -->
      <form id="filterForm">
        <input type="text" name="location" placeholder="Filter by location" value="<?= $_GET['location'] ?? '' ?>">
        <input type="text" name="organizer" placeholder="Filter by organizer" value="<?= $_GET['organizer'] ?? '' ?>">
        <label>
          Upcoming Events:
          <input type="checkbox" name="upcoming" <?= isset($_GET['upcoming']) ? 'checked' : '' ?>>
        </label>
        <button type="submit" class="btn btn-primary">Apply Filters</button>
      </form>

      <!-- Events Table -->
      <table class="table table-bordered">
        <thead>
          <tr>
            <th><a href="?sortField=name&sortOrder=<?= $sortOrder === 'ASC' ? 'DESC' : 'ASC' ?>">Name(ASC or DESC)</a></th>
            <th><a href="?sortField=date&sortOrder=<?= $sortOrder === 'ASC' ? 'DESC' : 'ASC' ?>">Date(ASC or DESC)</a></th>
            <th>Location</th>
            <th>Capacity</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($events as $event): ?>
            <tr>
              <td><?= $event['name'] ?></td>
              <td><?= $event['date'] ?></td>
              <td><?= $event['location'] ?></td>
              <td><?= $event['max_capacity'] ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <!-- Pagination -->
      <nav>
        <ul class="pagination">
          <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
              <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
            </li>
          <?php endfor; ?>
        </ul>
      </nav>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {
    $('#filterForm').on('submit', function (e) {
      e.preventDefault(); // Prevent default form submission

      const formData = $(this).serialize(); // Serialize the form data

      $.ajax({
        url: '/dashboard', // URL for the request
        type: 'GET',       // Use GET for filtering
        data: formData,    // Form data to send
        success: function (response) {
          // Replace the #dashboardContent with the new content
          $('#dashboardContent').html(response);
        },
        error: function () {
          alert('An error occurred while loading the data.');
        }
      });
    });

    // Handle pagination links with AJAX
    $(document).on('click', '.pagination .page-link', function (e) {
      e.preventDefault();

      const url = $(this).attr('href'); // Get the URL of the clicked page

      $.ajax({
        url: url, // Use the pagination URL
        type: 'GET',
        success: function (response) {
          $('#dashboardContent').html(response);
        },
        error: function () {
          alert('An error occurred while loading the data.');
        }
      });
    });
  });
</script>


