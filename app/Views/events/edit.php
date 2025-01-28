<?php include __DIR__ . '/../templates/header.php'; ?>
<?php include __DIR__ . '/../templates/sidebar.php'; ?>

<div class="flex-grow-1" style="margin-left: 250px;">
    <div class="p-3">

        <div class="container mt-5">
            <h4>Edit Event</h4>
            <form action="/events/update/<?= $eventData['id']; ?>" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Event Name</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>"
                        value="<?= htmlspecialchars($eventData['name']); ?>">
                    <?php if (isset($errors['name'])): ?>
                        <div class="invalid-feedback"><?= implode('<br>', $errors['name']) ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea
                        name="description"
                        id="description"
                        class="form-control <?= isset($errors['description']) ? 'is-invalid' : '' ?>"><?= htmlspecialchars($eventData['description']); ?></textarea>
                    <?php if (isset($errors['description'])): ?>
                        <div class="invalid-feedback"><?= implode('<br>', $errors['description']) ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input
                        type="date"
                        name="date"
                        id="date"
                        class="form-control <?= isset($errors['date']) ? 'is-invalid' : '' ?>"
                        value="<?= htmlspecialchars($eventData['date']); ?>">
                    <?php if (isset($errors['date'])): ?>
                        <div class="invalid-feedback"><?= implode('<br>', $errors['date']) ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="time" class="form-label">Time</label>
                    <input
                        type="time"
                        name="time"
                        id="time"
                        class="form-control <?= isset($errors['time']) ? 'is-invalid' : '' ?>"
                        value="<?= htmlspecialchars($eventData['time']); ?>">
                    <?php if (isset($errors['time'])): ?>
                        <div class="invalid-feedback"><?= implode('<br>', $errors['time']) ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input
                        type="text"
                        name="location"
                        id="location"
                        class="form-control <?= isset($errors['location']) ? 'is-invalid' : '' ?>"
                        value="<?= htmlspecialchars($eventData['location']); ?>">
                    <?php if (isset($errors['location'])): ?>
                        <div class="invalid-feedback"><?= implode('<br>', $errors['location']) ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="max_capacity" class="form-label">Capacity</label>
                    <input
                        type="number"
                        name="max_capacity"
                        id="max_capacity"
                        class="form-control <?= isset($errors['max_capacity']) ? 'is-invalid' : '' ?>"
                        value="<?= htmlspecialchars($eventData['max_capacity']); ?>">
                    <?php if (isset($errors['max_capacity'])): ?>
                        <div class="invalid-feedback"><?= implode('<br>', $errors['max_capacity']) ?></div>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>

        </div>

    </div>

</div>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
