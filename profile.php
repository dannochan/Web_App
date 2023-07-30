<?php
session_start();
if(!isset($_SESSION['userid'])) {
	header('Location: login.php');
}

$page = "profile";

?>

<?php 
include("config.php");

$userid = $_SESSION['userid'];

$profileimage = 'uploads/images/'.$_SESSION['lastname'].'_'.$_SESSION['matriculation'].'.png';


if(isset($_GET['edit'])) {

	$error = false;
    $PhoneNumber = $_POST['PhoneNumber'];
    $Street = $_POST['Street'];
    $PostalCode = $_POST['PostalCode'];
    $Semester = $_POST['Semester'];
	$birth_date = $_POST['birthdate'];
	$study_course = $_POST['studyc'];
	$location = $_POST['location'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];

    if(!$error) {
        $statement = $pdo->prepare("UPDATE Student SET PhoneNumber = :PhoneNumber, BirthDate = :BirthDate, StudyCourse = :StudyCourse, Residence = :loca, Street = :Street, PostalCode = :PostalCode, Semester = :Semester WHERE PersonID = :userid");
        $result = $statement->execute(array('PhoneNumber' => $PhoneNumber, 'BirthDate' => $birth_date, 'StudyCourse' => $study_course, 'loca' => $location, 'Street' => $Street, 'PostalCode' => $PostalCode, 'Semester' => $Semester, 'userid' => $userid));

		$statement = $pdo->prepare("UPDATE UniMember SET FirstName = ?, LastName = ? WHERE PersonID = ?");
        $result = $statement->execute(array($firstname, $lastname, $userid));
		$_SESSION['firstname'] = $firstname;
		$_SESSION['lastname'] = $lastname;
		$_SESSION['course'] = $study_course;
		$_SESSION['birthdate'] = $birth_date;
		$_SESSION['residence'] = $location;
    }

	if($result) {        
		echo '<script>
		setTimeout(function() {
			swal.fire({
				title: "Profil gespeichert!",
				text: "Du hast dein Profil erfolgreich gespeichert.",
				icon: "success"
			}, );
		}, 300);
		setTimeout(function() {
			window.location.href = "profile.php";
		}, 2000);
	</script>';         
	} else {
		echo '<script>
		setTimeout(function() {
			swal.fire({
				title: "Speicherung gescheitert!",
				text: "Beim Speichern deiner Daten ist ein Fehler aufgetreten.",
				icon: "error"
			}, );
		}, 300);
		setTimeout(function() {
			window.location.href = "profile.php";
		}, 2000);
	</script>';         
	}
}

if(isset($_GET['upload'])) {

$statement2 = $pdo->prepare("UPDATE UniMember SET ProfileImage = '$profileimage' WHERE PersonID = '$userid'");
$result2 = $statement2->execute(array('ProfileImage' => $profileimage));

if($result2) {        
	echo '<script>
	setTimeout(function() {
		swal.fire({
			title: "Bild gespeichert!",
			text: "Du hast dein Profilbild erfolgreich gespeichert.",
			icon: "success"
		}, );
	}, 300);
	setTimeout(function() {
		window.location.href = "profile.php";
	}, 2000);
</script>';
} else {
	echo '<script>
	setTimeout(function() {
		swal.fire({
			title: "Upload gescheitert!",
			text: "Beim Speichern deines Uploads ist ein Fehler aufgetreten.",
			icon: "error"
		}, );
	}, 300);
	setTimeout(function() {
		window.location.href = "profile.php";
	}, 2000);
</script>';         
	}
}

?>

<?php 

//Abfrage des Nutzers
$statement = $pdo->prepare("SELECT * FROM Student WHERE PersonID = :userid");
$result = $statement->execute(array('userid' => $userid));
$user = $statement->fetch();


//Updated Session-Variablen speichern
$_SESSION['phone'] = $user['PhoneNumber'];
$_SESSION['street'] = $user['Street'];
$_SESSION['postcode'] = $user['PostalCode'];
$_SESSION['sem'] = $user['Semester'];

?>

	<?php include("webElements/header.php"); ?>
	<main class="border-bottom">

<div class="mx-auto">
		<div class="p-4 align-items-center">
			<div class="wrapper bg-light">
			<?php include("webElements/nav.php"); ?>
				<div class="row">
					<div class="col left">
						<?php include("webElements/sidebar.php"); ?>
						<?php include("webElements/mobilenav.php"); ?>
					</div>
					<div class="col right">
						<div class="row">
						<?php include("webElements/breadcrumbs.php"); ?>

							<div class="container rounded bg-white">


	<h4>Persönliche Daten</h4>
<form class="needs-validation" novalidate="" action="?edit=1" method="post">
<div class="row">

					<div class="col">
					<label>Vorname:</label>
							<input class="form-control" placeholder="Vorname" value="<?php echo $_SESSION['firstname'] ?>" type="text" name="firstname">
						</div>
						<div class="col">
						<label>Nachname:</label>
							<input class="form-control" placeholder="Nachname" value="<?php echo $_SESSION['lastname'] ?>" type="text" name="lastname">
						</div>
						<div class="col-3">
						<label>Geburtsdatum:</label>
							<input class="form-control" placeholder="Geburtsdatum" value="<?php echo $_SESSION['birthdate'] ?>" type="text" name="birthdate">
						</div>
                </div>
                

<div class="row">

					<div class="col">
					<label>Straße & Hausnummer:</label>
							<input class="form-control" placeholder="Straße" pattern="[a-zA-ZÄÖÜäöüß0-9\s-]+" value="<?php echo $_SESSION['street'] ?>" type="text" name="Street">
							<div class="invalid-feedback">
							Nur Buchstaben, Zahlen Leerzeichen und - erlaubt!
						</div>
						</div>
						<div class="col">
						<label>Wohnort:</label>
							<input class="form-control" placeholder="Wohnort" value="<?php echo $_SESSION['residence'] ?>" type="text" name="location">
						</div>
						<div class="col-3">
						<label>Postleitzahl:</label>
							<input class="form-control" placeholder="PLZ" pattern="[0-9]+" value="<?php echo $_SESSION['postcode'] ?>" type="text" name="PostalCode">
							<div class="invalid-feedback">
							Nur Zahlen erlaubt!
						</div>
						</div>
                </div>

<div class="row">
<div class="col">
	<label>Studentische E-Mail-Adresse:</label>
							<input class="form-control" placeholder="E-Mail-Adresse" value="<?php echo $_SESSION['email'] ?>" type="text" disabled name="email">
						</div>
						<div class="col">
						<label>Telefonnummer:</label>
							<input class="form-control" placeholder="Telefonnummer" pattern="[0-9]+" value="<?php echo $_SESSION['phone'] ?>" type="text" name="PhoneNumber">
							<div class="invalid-feedback">
							Nur Zahlen erlaubt!
						</div>
						</div>
</div>

				<div class="row">

					<div class="col">
					<label>Matrikelnummer:</label>
							<input class="form-control" placeholder="Matrikelnummer" value="<?php echo $_SESSION['matriculation'] ?>" type="text" disabled name="matr">
						</div>
						<div class="col">
					<label>Studiengang:</label>
					<select class="form-select" type="text" name="studyc">
								<option selected="selected" value="<?php echo $_SESSION['course'] ?>">
								<?php echo $_SESSION['course'] ?>
								</option>
								<option>
									B.Sc. Angewandte Informatik
								</option>
								<option>
									B.Sc. International Information Systems Management
								</option>
								<option>
									B.Sc. Software Systems Science
								</option>
								<option>
									B.Sc. Wirtschaftsinformatik
								</option>
								<option>
									B.Sc. NF Angewandte Informatik
								</option>
								<option>
									M.Sc. Angewandte Informatik
								</option>
								<option>
									M.Sc. Computing in the Humanities
								</option>
								<option>
									M.Sc. International Information Systems Management
								</option>
								<option>
									M.Sc. International Software Systems Science
								</option>
								<option>
									M.Sc. Wirtschaftsinformatik
								</option>
								<option>
									M.Sc. Wirtschaftspädagogik
								</option>
								<option>
									M.Sc. Virtueller Weiterbildungsstudiengang Wirtschaftsinformatik
								</option>
							</select>
						</div>
						<div class="col">
						<label>Semesteranzahl:</label> <output><?php echo $_SESSION['sem'] ?></output>

						<input class="form-range" step="1" min="1" max="15" placeholder="Semester" value="<?php echo $_SESSION['sem'] ?>" name="Semester" type="range" oninput="this.previousElementSibling.value = this.value"> 
						</div>
                </div>
				<button class="btn btn-primary" type="submit">Speichern</button>
</form>
</div>

<div class="container rounded bg-white">
						<h4>Profilbild hochladen (optional)</h4>

						<div class="alert alert-warning fade show">
						<i class="bi bi-info-circle-fill"></i> Nur Bilder mit dem Dateinamen <span class="badge rounded-pill bg-warning text-dark"><?php echo $_SESSION['lastname'].'_'.$_SESSION['matriculation'] ?>.png</span> werden dargestellt!</div>
		  <form id="uploadimages" enctype="multipart/form-data">	
			  <div style="display: flex" class="mb-3">
	<input class="form-control upload" id="files" type="file" name="files[]"> <button style="margin-right: 5px" class="btn btn-sm btn-success" type="submit" name="submit">Hochladen</button>


</div>
</form>
<form action="?upload=1" method="post">
<button class="btn btn-primary" type="submit">Speichern</button> <i class="bi bi-exclamation-circle-fill hint"> Nur Bilder bis 2 MB sind erlaubt!</i></form>

<script>
		// file upload
		const url = "uploadimg.php";
		const form = document.querySelector("#uploadimages");

// Ein EventListener wartet auf das submit
form.addEventListener ("submit", function (evt) {
	evt.preventDefault ();
	const files = document.querySelector('[type=file]').files;
    const formData = new FormData();
    
	for (let i = 0; i < files.length; i++) {
		let file = files[i];
		formData.append('images[]', file)
	}
	
	fetch (url, {
		method: "POST",
		body: formData,
	}).then ((response) => {
		console.log (response);
		if (response.status === 200) {
		}
	});
});
</script>
</div>
<!--- NICE TO HAVE

<div class="container rounded bg-white">

				<h4>Passwort ändern</h4>
				<form class="needs-validation" novalidate="">
				<div class="col">
				<input class="form-control" placeholder="Altes Passwort" required="" type="password" disabled="">
</div>
                <div class="row">
					


					<div class="col">
							<input class="form-control" placeholder="Neues Passwort" required="" type="password" disabled="">
						</div>
						<div class="col">
							<input class="form-control" placeholder="Passwort wiederholen" required="" type="password" disabled="">
						</div>


					</div>
					<button class="btn btn-primary">Speichern</button>


</form>

				</div>
--->
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
	<?php include("webElements/footer.php"); ?>

