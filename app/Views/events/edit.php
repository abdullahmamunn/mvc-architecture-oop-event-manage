<?php include __DIR__ . '/../templates/header.php'; ?>
<?php include __DIR__ . '/../templates/sidebar.php'; ?>

<div class="flex-grow-1" style="margin-left: 250px;">
    <div class="p-3">

        <div class="container mt-5">
            <h1>Edit Event</h1>
            <form action="/events/update/<?= $eventData['id']; ?>" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Event Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($eventData['name']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" required><?= htmlspecialchars($eventData['description']); ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" name="date" id="date" class="form-control" value="<?= htmlspecialchars($eventData['date']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="time" class="form-label">Time</label>
                    <input type="time" name="time" id="time" class="form-control" value="<?= htmlspecialchars($eventData['time']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" name="location" id="location" class="form-control" value="<?= htmlspecialchars($eventData['location']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="max_capacity" class="form-label">Capacity</label>
                    <input type="number" name="max_capacity" id="max_capacity" class="form-control" value="<?= htmlspecialchars($eventData['max_capacity']); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>

    </div>

</div>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
