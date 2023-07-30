<!-- Button elements which show all accessible web pages-->
<div class="bar d-none d-lg-block">

  <button type="button" data-bs-toggle="tooltip" title="Logout" class="btn btn-danger<?php if ($page === "logout"){print '_active';} ?>" onclick="location.href = '../../logout.php'">
    <i class="bi bi-power"></i>
  </button>
</div>



<script>
  // Creates the tooltip messages above the buttons
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })
</script>