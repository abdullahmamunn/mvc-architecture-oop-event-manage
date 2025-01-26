<?php include __DIR__ . '/../templates/header.php'; ?>
<?php include __DIR__ . '/../templates/sidebar.php'; ?>

<div class="flex-grow-1" style="margin-left: 250px;">
  <div class="p-3">
    <div class="container mt-5">
      <h1 class="mb-4">Create a new event</h1>
      <a class="btn btn-primary" href="/events">Event List</a>
      <form id="registrationForm" method="POST" action="/events/store" novalidate>
        <div class="form-group">
          <label for="name">Event Name</label>
          <input type="text" class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>" id="name" name="name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
          <?php if (isset($errors['name'])): ?>
            <div class="invalid-feedback"><?= implode('<br>', $errors['name']) ?></div>
          <?php endif; ?>
        </div>

        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea class="form-control <?= isset($errors['description']) ? 'is-invalid' : '' ?>" name="description" id="description" cols="5" rows="5"><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
          <?php if (isset($errors['description'])): ?>
            <div class="invalid-feedback"><?= implode('<br>', $errors['description']) ?></div>
          <?php endif; ?>
        </div>

        <div class="mb-3">
          <label for="date" class="form-label">Date</label>
          <input type="date" class="form-control <?= isset($errors['date']) ? 'is-invalid' : '' ?>" name="date" id="date" value="<?= htmlspecialchars($_POST['date'] ?? '') ?>" required>
          <?php if (isset($errors['date'])): ?>
            <div class="invalid-feedback"><?= implode('<br>', $errors['date']) ?></div>
          <?php endif; ?>
        </div>

        <div class="mb-3">
          <label for="time" class="form-label">Time</label>
          <input type="time" class="form-control <?= isset($errors['time']) ? 'is-invalid' : '' ?>" name="time" id="time" value="<?= htmlspecialchars($_POST['time'] ?? '') ?>" required>
          <?php if (isset($errors['time'])): ?>
            <div class="invalid-feedback"><?= implode('<br>', $errors['time']) ?></div>
          <?php endif; ?>
        </div>

        <div class="mb-3">
          <label for="location" class="form-label">Location</label>
          <input type="text" class="form-control <?= isset($errors['location']) ? 'is-invalid' : '' ?>" name="location" id="location" placeholder="Enter Location" value="<?= htmlspecialchars($_POST['location'] ?? '') ?>" required>
          <?php if (isset($errors['location'])): ?>
            <div class="invalid-feedback"><?= implode('<br>', $errors['location']) ?></div>
          <?php endif; ?>
        </div>

        <div class="mb-3">
          <label for="max_capacity" class="form-label">Capacity</label>
          <input type="number" class="form-control <?= isset($errors['max_capacity']) ? 'is-invalid' : '' ?>" name="max_capacity" id="max_capacity" placeholder="Enter Capacity" value="<?= htmlspecialchars($_POST['max_capacity'] ?? '') ?>" required>
          <?php if (isset($errors['max_capacity'])): ?>
            <div class="invalid-feedback"><?= implode('<br>', $errors['max_capacity']) ?></div>
          <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-primary w-100">Register</button>
      </form>
    </div>

  </div>
</div>


<?php include __DIR__ . '/../templates/footer.php'; ?>
