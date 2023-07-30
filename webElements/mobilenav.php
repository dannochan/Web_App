<?php

include_once("config.php");

$userid = $_SESSION['userid'];

$statement = $pdo->prepare("SELECT ProfileImage FROM UniMember WHERE PersonID = '$userid'");
$result = $statement->execute(array('userid' => $userid));
$user = $statement->fetch();

?>

<?php //blendet nav für ausgeloggte user aus

if(!$_SESSION['userid']) { echo '<style>div.mobilesubnav.d-lg-none {display: none !important;}</style>'; }

?>

<div class="mobilesubnav d-lg-none">
		<div class="offcanvas offcanvas-top" id="mobilenav">
  <div class="offcanvas-header">
  <button class="btn btn-light<?php if($page == "dashboard") echo "_active"; ?>" onclick="location.href = 'dashboard.php'" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenav">
  <i class="bi bi-speedometer2"></i>
  </button>
  <button class="btn btn-light<?php if($page == "profile") echo "_active"; ?>" onclick="location.href = 'profile.php'" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenav">
  <i class="bi bi-person-circle"></i>
  </button>
  <button class="btn btn-light<?php if($page == "inbox") echo "_active"; ?>" onclick="location.href = 'inbox.php'" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenav">
  <i class="bi bi-inbox"></i>
  </button>
  <button class="btn btn-light<?php if($page == "universities") echo "_active"; ?>" onclick="location.href = 'universities.php'" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenav">
  <i class="bi bi-mortarboard"></i>
  </button>
  <button class="btn btn-light<?php if($page == "apply") echo "_active"; ?>" onclick="location.href = 'apply.php'" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenav">
  <i class="bi bi-cloud-arrow-up"></i>
  </button>
    <button data-bs-toggle="tooltip" title="Rezension" class="btn btn-light<?php if($page == "review") echo "_active"; ?>" onclick="location.href = 'review.php'" type="button">
    <i class="bi bi-star-fill"></i>
    </button>
  <button class="btn btn-light<?php if($page == "faq") echo "_active"; ?>" onclick="location.href = 'faq.php'" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenav">
    <i class="bi bi-question-circle"></i>
    </button>
  <button class="btn btn-light<?php if($page == "contact") echo "_active"; ?>" onclick="location.href = 'contact.php'" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenav">
  <i class="bi bi-envelope"></i></button>
  <button class="btn btn-danger" onclick="location.href = 'logout.php'" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenav">
    <i class="bi bi-power"></i></button>
  </div>
</div>
<div class="container-fluid mt-3">
  <button class="btn btn-outline-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenav">
  <i class="bi bi-list"></i>
  </button>
</div>
		</div>

<?php
	
?>
