<?php include __DIR__ . '/../templates/header.php'; ?>
<?php include __DIR__ . '/../templates/sidebar.php'; ?>

<div class="flex-grow-1" style="margin-left: 250px;">
  <div class="p-3">
    <div class="container mt-5">
      <div id="alertMessage" class="alert alert-dismissible fade show d-none" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <h4 class="mb-4">Create a new event</h4>
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

<script>
  $(document).ready(function() {
    $("#registrationForm").validate({
      rules: {
        name: {
          required: true,
          maxlength: 150
        },
        description: {
          required: true
        },
        date: {
          required: true,
          date: true
        },
        time: {
          required: true
        },
        location: {
          required: true
        },
        max_capacity: {
          required: true,
          number: true,
          min: 1
        }
      },
      messages: {
        name: {
          required: "Please enter the event name.",
          maxlength: "Event name cannot exceed 150 characters."
        },
        description: {
          required: "Please enter a description."
        },
        date: {
          required: "Please select a date.",
          date: "Please enter a valid date."
        },
        time: {
          required: "Please select a time."
        },
        location: {
          required: "Please enter the location."
        },
        max_capacity: {
          required: "Please enter the capacity.",
          number: "Capacity must be a number.",
          min: "Capacity must be at least 1."
        }
      },
      errorClass: "is-invalid",
      validClass: "is-valid",
      errorPlacement: function(error, element) {
        error.addClass("invalid-feedback");
        element.closest(".form-group, .mb-3").append(error);
      }
    });
  });
</script>

<?php include __DIR__ . '/../templates/footer.php'; ?>


