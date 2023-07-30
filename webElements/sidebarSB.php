<?php
require_once("../../config.php");
//holt den absoluten pfad des profilbildes aus der datenbank
$personid = $_SESSION['PersonID'];
$statement = $pdo->prepare("SELECT ProfileImage FROM UniMember WHERE PersonID = ?");
$statement->execute(array($personid));
while ($row = $statement->fetch()){
	$imgpath = $row['ProfileImage'];
	break;
}
if ($imgpath != NULL){
	$profileimage = "../../".$imgpath;
}else{
	$profileimage = $imgpath;
}
?>

<div class="sub">
		<div class="<?php //nur eingeloggte user sehen dot
		if($_SESSION['PersonID']) {echo 'dot';} else {echo '';} ?>" <?php //nur wenn ein profilbild auf dem webserver existiert und ein pfad in der db gespeichert wurde, wird es angezeigt
		if (file_exists($profileimage)) {echo 'style="background-image: url('.$profileimage.'); background-size: 130px"';} else {echo '';}; ?>>

			<svg class="bi bi-person-fill" height="130" viewbox="0 0 16 16" width="130" xmlns="http://www.w3.org/2000/svg">
			<path style="<?php //blendet das platzhalter profilbild für ausgeloggte user aus
			 if($_SESSION['PersonID']) {echo '';} else {echo 'display: none';} ?>" d="<?php //wenn kein profilbild auf dem webserver existiert und kein pfad in der db gespeichert wurde, wird der platzhalter angezeigt
			 if (file_exists($profileimage)) {echo '';} else {echo 'M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z';} ?>"></path>
			</svg>

			<div class="name">
			<?php //nur eingeloggte user vorname
			if($_SESSION['PersonID']) {echo $_SESSION['firstname'];} ?>
			<span><br><?php //nur eingeloggte user sehen nachname
			if($_SESSION['PersonID']) {echo $_SESSION['lastname'];} ?></span>
			</div>
</div>
	</div>