<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Event Details</title>
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

        .text-justify {
            text-align: justify;
        }

        .event-card {
            margin-top: -50px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-register {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }

        .btn-register:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php
        use App\Models\Attendee;

        $attendee = new Attendee();
    ?>
    <!-- Event Banner -->
    <div class="event-banner text-center">
        Event Details
    </div>

    <!-- Event Card -->
    <div class="container mt-4">
        <div class="card event-card p-4">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="fw-bold">Event Name: <?= htmlspecialchars($event['event_name']) ?></h2>
                    <h6 class="text-muted">Capacity: <?= htmlspecialchars($event['max_capacity']) ?></h6>
                    <h6 class="text-muted">Organized By: <?= ucfirst($event['organizer_name']) ?></h6>
                    <h6 class="text-muted"><strong>Date:</strong> <?= htmlspecialchars($event['date']) ?></h6>
                    <h6 class="text-muted"><strong>Location:</strong> <?= htmlspecialchars($event['location']) ?></h6>
                    <p class="text-justify"><?= htmlspecialchars($event['description']) ?></p>

                    <?php if ($attendee->countAttendees($event['id']) >= $event['max_capacity']): ?>
                        <a href="#" class="btn btn-sm btn-danger px-4 py-2" disabled>Slots out</a>
                    <?php else: ?>
                        <!-- <a href="/events/<?= $event['id']; ?>/register" class="btn btn-sm btn-success">Register</a> -->
                    <a href="/events/<?= $event['id']; ?>/register" class="btn btn-register px-4 py-2">Register Now</a>

                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <img src="https://media.istockphoto.com/id/499517325/photo/a-man-speaking-at-a-business-conference.jpg?s=612x612&w=0&k=20&c=gWTTDs_Hl6AEGOunoQ2LsjrcTJkknf9G8BGqsywyEtE=" class="img-fluid rounded" alt="Event Image">
                </div>
            </div>
        </div>

        <!-- Attendee List -->
        <div class="mt-5">
            <h3>Attendees</h3>
            <?php if (empty($eventDetails)): ?>
                <p>No attendees registered yet.</p>
            <?php else: ?>
                <ul class="list-group">
                    <?php foreach ($eventDetails as $attendee): ?>
                        <?php if (empty($attendee['attendee_name'])) { ?>
                            <li class="list-group-item">No Data Found!</li>

                        <?php } else { ?>
                            <li class="list-group-item"><?= htmlspecialchars($attendee['attendee_name']) ?> - <?= htmlspecialchars($attendee['email']) ?></li>
                        <?php } ?>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
