
<!-- Content -->
<div class="flex-grow-1">
<div id="dashboardContent">
    <!-- Dashboard content goes here -->
    <div class="p-3">
      <h3 class="text-center">Reports</h3>
    </div>
    <div class="container">

      <div class="row">
        <div class="col-md-12">
          <div id="alertMessage" class="alert alert-dismissible fade show d-none" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        </div>
        <div class="col-md-12 mb-3">
          <!-- Filter Form -->
          <form id="filterForm">
            <div class="row">
              <div class="col-md-2">
                <input type="text" class="form-control" name="location" placeholder="Filter by location" value="<?= $_GET['location'] ?? '' ?>">

              </div>
              <div class="col-md-2">
                <input type="text" class="form-control" name="organizer" placeholder="Filter by organizer" value="<?= $_GET['organizer'] ?? '' ?>">

              </div>
              <div class="col-md-2">
                <label>
                  Upcoming Events:
                  <input type="checkbox" name="upcoming" <?= isset($_GET['upcoming']) ? 'checked' : '' ?>>
                </label>
              </div>
              <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Apply Filters</button>

              </div>
            </div>

          </form>
        </div>

        <div class="col-md-12">
          <!-- Events Table -->
          <table class="table table-bordered">
            <thead>
              <tr>
                <th><a href="?sortField=name&sortOrder=<?= $sortOrder === 'ASC' ? 'DESC' : 'ASC' ?>">Name</a></th>
                <th><a href="?sortField=date&sortOrder=<?= $sortOrder === 'ASC' ? 'DESC' : 'ASC' ?>">Date</a></th>
                <th>Time</th>
                <th>Location</th>
                <th>Capacity</th>
                <th>Download CSV</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($events as $event): ?>
                <tr>
                  <td><?= $event['name'] ?></td>
                  <td><?= formatDate($event['date']) ?></td>
                  <td><?= formatTime($event['time']) ?></td>
                  <td><?= $event['location'] ?></td>
                  <td><?= $event['max_capacity'] ?></td>
                  <td>
                    <a href="/events/reports?event_id=<?= $event['id'] ?>" class="btn btn-sm btn-info">
                      <i class="bi bi-filetype-csv"></i> Attendee Lists
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>

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
      </div>
    </div>
  </div>
</div>
