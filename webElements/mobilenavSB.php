<!--Button elements which show all accessible web pages. This is the navbar for smaller screen size-->
<div class="mobilesubnav d-lg-none">
		<div class="offcanvas offcanvas-top" id="mobilenav">
      <div class="offcanvas-header">

      <button type="button"  class="btn btn-light<?php if ($page === "profil"){print '_active';} ?>" onclick="location.href = 'https://web06.iis.uni-bamberg.de/WIP/wip2122_g3/Sacharbeiter/Profil/'" data-bs-toggle="offcanvas" data-bs-target="#mobilenav"> 
          <i class="bi bi-person-circle"></i>
        </button>

        <button type="button" class="btn btn-light<?php if ($page === "post"){print '_active';} ?>" onclick="location.href = 'https://web06.iis.uni-bamberg.de/WIP/wip2122_g3/Sacharbeiter/Postfach/postfach.php'" data-bs-toggle="offcanvas" data-bs-target="#mobilenav">
          <i class="bi bi-mailbox2"></i>
        </button>

        <button  type="button" class="btn btn-light<?php if ($page === "university"){print '_active';} ?>" onclick="location.href = 'https://web06.iis.uni-bamberg.de/WIP/wip2122_g3/Sacharbeiter/Uniprofil/uniProf.php'" data-bs-toggle="offcanvas" data-bs-target="#mobilenav">
          <i class="bi bi-building"></i>
        </button>

        <button type="button" class="btn btn-light<?php if ($page === "application"){print '_active';} ?>" onclick="location.href = 'https://web06.iis.uni-bamberg.de/WIP/wip2122_g3/Sacharbeiter/Bewerbungsliste/'" data-bs-toggle="offcanvas" data-bs-target="#mobilenav">
          <i class="bi bi-newspaper"></i>
        </button>

        <button type="button" class="btn btn-light<?php if ($page === "review"){print '_active';} ?>" onclick="location.href = 'https://web06.iis.uni-bamberg.de/WIP/wip2122_g3/Sacharbeiter/Rezensionsliste/'" data-bs-toggle="offcanvas" data-bs-target="#mobilenav">
          <i class="bi bi-star-fill"></i>
        </button>

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
