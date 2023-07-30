<?php

include_once("config.php");

?>



<div class="bar d-none d-lg-block">
  <button data-bs-toggle="tooltip" title="Dashboard" class="btn btn-light<?php if ($page == "dashboard") echo "_active"; ?>" onclick="location.href = 'dashboard.php'" type="button">
    <i class="bi bi-speedometer2"></i>
  </button>
  <button data-bs-toggle="tooltip" title="Profil" class="btn btn-light<?php if ($page == "profile") echo "_active"; ?>" onclick="location.href = 'profile.php'" type="button">
    <i class="bi bi-person-circle"></i>
  </button>
  <button data-bs-toggle="tooltip" title="Postfach" class="btn btn-light<?php if ($page == "inbox") echo "_active"; ?>" onclick="location.href = '/Postfach/postfacj.php'" type="button">
    <i class="bi bi-inbox"></i>
  </button>
  <button data-bs-toggle="tooltip" title="Universitäten" class="btn btn-light<?php if ($page == "universities") echo "_active";  ?>" onclick="location.href = 'universities.php'" type="button">
    <i class="bi bi-mortarboard"></i>
  </button>
  <button data-bs-toggle="tooltip" title="Bewerben" class="btn btn-light<?php if ($page == "apply") echo "_active"; ?>" onclick="location.href = 'apply.php'" type="button">
    <i class="bi bi-cloud-arrow-up"></i>
  </button>
  <button data-bs-toggle="tooltip" title="Rezension" class="btn btn-light<?php if ($page == "review") echo "_active"; ?>" onclick="location.href = 'rezension.php'" type="button">
    <i class="bi bi-star-fill"></i>
  </button>
  <button data-bs-toggle="tooltip" title="FAQ" class="btn btn-light<?php if ($page == "faq") echo "_active"; ?>" onclick="location.href = 'faq.php'" type="button">
    <i class="bi bi-question-circle"></i>
  </button>
  <button data-bs-toggle="tooltip" title="Kontakt" class="btn btn-light<?php if ($page == "contact") echo "_active"; ?>" onclick="location.href = 'contact.php'" type="button">
    <i class="bi bi-envelope"></i> </button>
  <button data-bs-toggle="tooltip" title="Logout" class="btn btn-danger" onclick="location.href = 'logout.php'" type="button">
    <i class="bi bi-power"></i></button>
</div>