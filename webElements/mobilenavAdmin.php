<!--Button elements which show all accessible web pages. This is the navbar for smaller screen size-->
<div class="mobilesubnav d-lg-none">
		<div class="offcanvas offcanvas-top" id="mobilenav">
      <div class="offcanvas-header">

        <button type="button" class="btn btn-danger<?php if ($page === "logout"){print '_active';} ?>" onclick="location.href = '../../logout.php'" data-bs-toggle="offcanvas" data-bs-target="#mobilenav">
          <i class="bi bi-power"></i>
        </button>
    </div>
  </div>

  <!--Button to open the mobile navbar-->
  <div class="container-fluid mt-3">
    <button class="btn btn-outline-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenav">
      <i class="bi bi-list"></i>
    </button>
  </div>

</div>
