<?php include __DIR__ . '/../templates/header.php'; ?>
<?php include __DIR__ . '/../templates/sidebar.php'; ?>
<div class="flex-grow-1" style="margin-left: 250px;">
  <div class="p-3">
    <div class="container mt-4">
      <h1 class="mb-4">Event Details</h1>

      <div class="card">
        <div class="card-header">
          <h3><?= htmlspecialchars($eventDetails['name']); ?></h3>
        </div>
        <div class="card-body">
          <p><strong>Description:</strong> <?= htmlspecialchars($eventDetails['description']); ?></p>
          <p><strong>Date:</strong> <?= formatDate($eventDetails['date']); ?></p>
          <p><strong>Time:</strong> <?= formatTime($eventDetails['time']); ?></p>
          <p><strong>Location:</strong> <?= htmlspecialchars($eventDetails['location']); ?></p>
          <p><strong>Maximum Capacity:</strong> <?= htmlspecialchars($eventDetails['max_capacity']); ?></p>
        </div>
      </div>

      <a href="/events" class="btn btn-secondary mt-3">Back to Events</a>
    </div>
  </div>
</div>


<?php include __DIR__ . '/../templates/footer.php'; ?>
