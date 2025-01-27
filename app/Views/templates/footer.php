<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<?php if (isset($_SESSION['alert'])): ?>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const alertDiv = document.getElementById('alertMessage');
      alertDiv.classList.remove('d-none', 'alert-success', 'alert-warning', 'alert-danger');
      alertDiv.classList.add('alert-<?= $_SESSION['alert']['type'] ?>');
      alertDiv.innerHTML = `<?= $_SESSION['alert']['message'] ?> 
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>`;

      // Auto-hide the alert after 2 seconds
      setTimeout(() => {
        alertDiv.classList.add('d-none');
      }, 2000);
    });
  </script>
  <?php unset($_SESSION['alert']); ?>
<?php endif; ?>
