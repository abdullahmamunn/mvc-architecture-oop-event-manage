<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Event Registration</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .event-banner {
      background-color: #86b7fe;
      background-size: cover;
      height: 300px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 2rem;
      font-weight: bold;
      text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
    }
  </style>
</head>

<body>
  <!-- Event Banner -->
  <div class="event-banner text-center">
    Event Registration
  </div>

  <!-- Registration Form -->
  <div class="container mt-5">
    <h2 class="text-center mb-4">Register for <?= htmlspecialchars($eventDetails['name']); ?></h2>
    <div class="alert alert-danger" id="generalError" style="display: none;"></div>
    <form id="registrationForm">
      <input type="hidden" name="event_id" value="<?= $eventId ?>">

      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name">
        <div class="invalid-feedback" id="nameError"></div>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email">
        <div class="invalid-feedback" id="emailError"></div>
      </div>

      <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input type="text" class="form-control" id="phone" name="phone">
        <div class="invalid-feedback" id="phoneError"></div>
      </div>

      <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>
  </div>

  <!-- Success Modal -->
  <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="successModalLabel">Congratulations</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p id="successMessage"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    $(document).ready(function() {
      $("#registrationForm").submit(function(event) {
        event.preventDefault(); // Prevent the default form submission

        var formData = $(this).serialize(); // Get form data

        // Clear any previous error messages
        $(".invalid-feedback").text("").hide();
        $(".form-control").removeClass('is-invalid');
        $("#generalError").text("").hide(); // Clear general error message

        // Send AJAX request
        $.ajax({
          url: '/attendees/store', // PHP script that processes the form
          type: 'POST',
          data: formData,
          success: function(response) {
            if (response.success) {
              // If registration is successful, show success message in the modal
              $('#successMessage').text("Congratulations " + response.name + ", you have successfully registered for this event!");
              $('#successModal').modal('show');
              $('#registrationForm')[0].reset(); // Optionally reset the form
            } else {
              // If there are errors, display them in the form
              if (response.errors) {
                response.errors.forEach(function(error) {
                  // Try to match error with form field
                  if (error.includes('name')) {
                    $('#nameError').text(error).show();
                    $('#name').addClass('is-invalid');
                  } else if (error.includes('email')) {
                    $('#emailError').text(error).show();
                    $('#email').addClass('is-invalid');
                  } else if (error.includes('phone')) {
                    $('#phoneError').text(error).show();
                    $('#phone').addClass('is-invalid');
                  } else {
                    // If the error is a general message (like "The event is fully booked!"), display it
                    $("#generalError").text(error).show();
                  }
                });
              }
            }
          },
          error: function(xhr, status, error) {
            alert("An error occurred. Please try again.");
          }
        });
      });
    });
  </script>

</body>

</html>
