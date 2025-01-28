<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Events</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <?php

    use App\Models\Attendee;

    $attendee = new Attendee();

    include __DIR__ . '/./templates/header.php';
    ?>

    <div class="container mt-5">
        <h2>All Events</h2>

        <?php if (!empty($events)): ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th><a href="?sortField=name&sortOrder=<?= $sortOrder === 'ASC' ? 'DESC' : 'ASC' ?>">Name</a></th>
                        <th>Description</th>
                        <th><a href="?sortField=date&sortOrder=<?= $sortOrder === 'ASC' ? 'DESC' : 'ASC' ?>">Date</a></th>
                        <th>Time</th>
                        <th>Location</th>
                        <th>Capacity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($events as $event): ?>
                        <tr>
                            <td><?= htmlspecialchars($event['name']); ?></td>
                            <td><?= htmlspecialchars(mb_strimwidth($event['description'], 0, 30, '...')); ?></td>
                            <td><?= formatDate($event['date']); ?></td>
                            <td><?= formatTime($event['time']); ?></td>
                            <td><?= htmlspecialchars($event['location']); ?></td>
                            <td><?= htmlspecialchars($event['max_capacity']); ?></td>
                            <td>
                                <a href="/events/<?= $event['id']; ?>" class="btn btn-sm btn-primary">View</a>
                                <?php if ($attendee->countAttendees($event['id']) >= $event['max_capacity']): ?>
                                    <a href="#" class="btn btn-sm btn-danger" disabled>Slots out</a>
                                <?php else: ?>
                                    <a href="/events/<?= $event['id']; ?>/register" class="btn btn-sm btn-success">Register</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-danger">No events found.</p>
        <?php endif; ?>

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
</body>

</html>
