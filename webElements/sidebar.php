<?php

include_once("config.php");


//holt den absoluten pfad des profilbildes aus der datenbank
$userid = $_SESSION['userid'];

$statement = $pdo->prepare("SELECT ProfileImage FROM UniMember WHERE PersonID = '$userid'");
$result = $statement->execute(array('userid' => $userid));
$user = $statement->fetch();

$imgpath = $user['ProfileImage'];

//relativer pfad des profilbildes
$profileimage = 'uploads/images/'.$_SESSION['lastname'].'_'.$_SESSION['matriculation'].'.png';

?>

<?php //verlängert content auf ganze seite und blendet sidebar für ausgeloggte user aus

if(!$_SESSION['userid']) { echo '<style>.col {flex: unset !important;} .sub {display: none !important;}</style>'; }

?>

<div class="sub">
		<div class="dot" <?php //nur wenn ein profilbild auf dem webserver existiert und ein pfad in der db gespeichert wurde, wird es angezeigt
		if (file_exists($profileimage) && $imgpath != NULL) {echo 'style="background-image: url('.$profileimage.'); background-size: 130px"';} else {echo '';}; ?>>

			<svg class="bi bi-person-fill" height="130" viewbox="0 0 16 16" width="130" xmlns="http://www.w3.org/2000/svg">
			<path d="<?php //wenn kein profilbild auf dem webserver existiert und kein pfad in der db gespeichert wurde, wird der platzhalter angezeigt
			 if (file_exists($profileimage) && $imgpath != NULL) {echo '';} else {echo 'M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z';} ?>"></path>
			</svg>

			<div class="name">
			<?php echo $_SESSION['firstname']; ?>
			<span><br><?php echo $_SESSION['lastname'] ?></span>
			</div>
</div>
	</div>
