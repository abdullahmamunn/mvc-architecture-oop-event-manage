<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Events</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        #searchResults {
            position: absolute;
            top: 100%; /* Places it below the input */
            right: 0; /* Aligns it to the right */
            background: white;
            border: 1px solid #ddd;
            width: 205px;
            max-height: 200px;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
        }


        .search-item {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .search-item a {
            text-decoration: none;
            color: #333;
        }

        .search-item:hover {
            background: #f5f5f5;
        }

    </style>
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
                                <a href="/event/details/<?= $event['id']; ?>" class="btn btn-sm btn-primary">View</a>
                                <!-- <a href="/event/details" class="btn btn-sm btn-primary">View</a> -->
                                
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

    <script>
  $(document).ready(function () {
    $("#searchQuery").on("keyup", function () {
        let query = $(this).val();

        if (query.trim() === "") {
            $("#searchResults").html("");
            return;
        }

        $.ajax({
            url: '/search',
            type: "POST",
            data: { query: query },
            success: function (response) {
              console.log(response)
                $("#searchResults").html(response);
            }
        });
    });

     // Hide results when clicking outside
    // $(document).click(function (e) {
    //     if (!$(e.target).closest("#searchResults, #searchQuery").length) {
    //         $("#searchResults").hide();
    //     }
    // });
});

</script>
</body>

</html>
