<?php include __DIR__ . '/../templates/header.php'; ?>
<?php include __DIR__ . '/../templates/sidebar.php'; ?>

<div class="flex-grow-1" style="margin-left: 250px;">
  <div class="p-3">
    <div class="container mt-5">
      <h1 class="mb-4">Create a new event</h1>
      <a class="btn btn-primary" href="/events">Event List</a>
      <form id="registrationForm" method="POST" action="/events/store" novalidate>
        <div class="mb-3">
          <label for="name" class="form-label">Event name</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter Event Name">
        </div>
        <div class="mb-3">
          <label for="Description" class="form-label">Description</label>
          <textarea class="form-control" name="description" id="description" col="5" row="5"></textarea>
        </div>
        <div class="mb-3">
          <label for="date" class="form-label">Date</label>
          <input type="date" class="form-control" name="date" id="date" required>
        </div>
        <div class="mb-3">
          <label for="time" class="form-label">Time</label>
          <input type="time" class="form-control" name="time" id="time" required>
        </div>
        <div class="mb-3">
          <label for="location" class="form-label">Location</label>
          <input type="text" class="form-control" name="location" id="location" placeholder="Enter Location" required>
        </div>
        <div class="mb-3">
          <label for="max_capacity" class="form-label">Capacity</label>
          <input type="number" class="form-control" name="max_capacity" id="max_capacity" placeholder="Enter Capacity" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Register</button>
      </form>
    </div>

  </div>
</div>


<?php include __DIR__ . '/../templates/footer.php'; ?>
