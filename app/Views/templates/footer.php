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

<script>
  // JavaScript for toggling dropdown
  function toggleDropdown() {
    const dropdownMenu = document.querySelector('.dropdown-menu');
    dropdownMenu.classList.toggle('active');
  }

  // Close the dropdown if clicked outside
  document.addEventListener('click', function(e) {
    const dropdown = document.querySelector('.dropdown');
    const isClickInside = dropdown.contains(e.target);
    if (!isClickInside) {
      const dropdownMenu = document.querySelector('.dropdown-menu');
      dropdownMenu.classList.remove('active');
    }
  });
</script>



</body>

</html>
