<?php

use App\Core\Auth; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register for Event</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
<?php include __DIR__ . '/../templates/header.php';  ?>
    <div class="container mt-5">
        <div id="registrationForm"> 
            <h2>Register for <?= htmlspecialchars($eventDetails['name']); ?></h2>
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form id="eventRegistrationForm">
                <input type="hidden" id="event_id" name="event_id" value="<?= $eventId; ?>">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control">
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" name="phone" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Register</button>
            </form>
            <div id="registrationMessage" style="margin-top: 10px;"></div>

        </div>

    </div>
    <script>
        $(document).ready(function() {
            $('#eventRegistrationForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                const formData = $(this).serialize(); // Serialize form data
                const messageDiv = $('#registrationMessage');

                $.ajax({
                    url: '/attendees/store', // Backend route for storing attendees
                    type: 'POST',
                    data: formData,
                    dataType: 'json', // Expect JSON response
                    success: function(response) {
                        if (response.success) {
                            messageDiv.html('<div class="alert alert-success">Registration successful!</div>');
                            $('#eventRegistrationForm')[0].reset(); // Reset the form
                        } else {
                            
                            let errors = '<div class="alert alert-danger"><ul>';
                            response.errors.forEach(error => {
                                errors += `<li>${error}</li>`;
                            });
                            errors += '</ul></div>';
                            messageDiv.html(errors);
                        }
                    },
                    error: function() {
                        messageDiv.html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
                    }
                });
            });
        });
    </script>

</body>

</html>
