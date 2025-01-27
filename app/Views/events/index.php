<?php include __DIR__ . '/../templates/header.php'; ?>
<?php include __DIR__ . '/../templates/sidebar.php'; ?>

<div class="flex-grow-1" style="margin-left: 250px;">
    <div class="p-3">
        <div class="container mt-5">
            <div id="alertMessage" class="alert alert-dismissible fade show d-none" role="alert">
                <!-- Message will be dynamically inserted here -->
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <h1 class="mb-4">Events List</h1>
            <a class="btn btn-primary" href="/events/create">Create a new event</a>

            <?php if (!empty($events)): ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Event Name</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Location</th>
                            <th>Max Capacity</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($events as $index => $event): ?>
                            <tr>
                                <td><?= $index + 1; ?></td>
                                <td><?= htmlspecialchars($event['name']); ?></td>
                                <td>
                                    <?php
                                    $words = explode(' ', $event['description']);
                                    $shortDescription = implode(' ', array_slice($words, 0, 5));
                                    echo htmlspecialchars($shortDescription) . (count($words) > 5 ? '...' : '');
                                    ?>
                                </td>
                                <td><?= htmlspecialchars($event['date']); ?></td>
                                <td><?= htmlspecialchars($event['time']); ?></td>
                                <td><?= htmlspecialchars($event['location']); ?></td>
                                <td><?= htmlspecialchars($event['max_capacity']); ?></td>
                                <td>
                                    <a href="/events/<?= $event['id']; ?>" class="btn btn-sm btn-primary">View</a>
                                    <a href="/events/edit/<?= $event['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="/events/delete/<?= $event['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-center">No events found. <a href="/events/create">Create a new event</a>.</p>
            <?php endif; ?>
        </div>

    </div>
</div>


<?php include __DIR__ . '/../templates/footer.php'; ?>
