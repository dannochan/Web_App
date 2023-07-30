<!-- Button elements which show all accessible web pages-->
<div class="bar d-none d-lg-block">

  <button type="button" data-bs-toggle="tooltip" title="Profil" class="btn btn-light<?php if ($page === "profil"){print '_active';} ?>" onclick="location.href = 'https://web06.iis.uni-bamberg.de/WIP/wip2122_g3/Sacharbeiter/Profil/'">
    <i class="bi bi-person-circle"></i>
  </button>

  <button type="button" data-bs-toggle="tooltip" title="Postfach" class="btn btn-light<?php if ($page === "post"){print '_active';} ?>" onclick="location.href = 'https://web06.iis.uni-bamberg.de/WIP/wip2122_g3/Sacharbeiter/Postfach/postfach.php'">
    <i class="bi bi-mailbox2"></i>
  </button>

  <button type="button" data-bs-toggle="tooltip" title="Universitäten" class="btn btn-light<?php if ($page === "university"){print '_active';} ?>" onclick="location.href = 'https://web06.iis.uni-bamberg.de/WIP/wip2122_g3/Sacharbeiter/Uniprofil/uniProf.php'">
    <i class="bi bi-building"></i>
  </button>

  <button type="button" data-bs-toggle="tooltip" title="Bewerbungen" class="btn btn-light<?php if ($page === "application"){print '_active';} ?>" onclick="location.href = 'https://web06.iis.uni-bamberg.de/WIP/wip2122_g3/Sacharbeiter/Bewerbungsliste/'">
    <i class="bi bi-newspaper"></i>
  </button>

  <button type="button" data-bs-toggle="tooltip" title="Rezensionen" class="btn btn-light<?php if ($page === "review"){print '_active';} ?>" onclick="location.href = 'https://web06.iis.uni-bamberg.de/WIP/wip2122_g3/Sacharbeiter/Rezensionsliste/'">
    <i class="bi bi-star-fill"></i>
  </button>

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