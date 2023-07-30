<?php 

include("config.php");

if(isset($_GET['register'])) {
    $error = false;
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    $Password2 = $_POST['Password2'];
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $MatriculationNumber = $_POST['MatriculationNumber'];
    $Residence = $_POST['Residence'];
    $BirthDate = $_POST['BirthDate'];
    $StudyCourse = $_POST['StudyCourse'];

      
    //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
    if(!$error) { 
        $statement = $pdo->prepare("SELECT * FROM UniMember WHERE Email = :Email");
        $result = $statement->execute(array('Email' => $Email));
        $user = $statement->fetch();
        
        if($user !== false) {
			echo '<script>
			setTimeout(function() {
				swal.fire({
					title: "E-Mail-Adresse vergeben!",
					text: "Diese E-Mail-Adresse existiert bereits.",
					icon: "error",
					showCloseButton: true,
					timer: 5000,
					timerProgressBar: true
				}, );
			}, 300);
		</script>';             
		$error = true;
        }    
    }

	if($Password != $Password2) {
		echo "<script>
		setTimeout(function() {
			swal.fire({
				title: 'Registrierung gescheitert!',
				text: 'Die beiden Passwörter müssen übereinstimmen.',
				icon: 'error',
				showCloseButton: true,
				timer: 3000,
				timerProgressBar: true
			}, );
		}, 300);
	   </script>";
	   $error = true;
		}

    //Keine Fehler, wir können den Nutzer registrieren
    if(!$error) {    
        $Password_Hash = password_Hash($Password, PASSWORD_DEFAULT);

		$sql_string = "INSERT INTO UniMember (Email, Password, FirstName, LastName, PrivacyPoli) VALUES (:Email, :Password, :FirstName, :LastName, 1)";
        $statement = $pdo->prepare($sql_string);								
        $result = $statement->execute(array('Email' => $Email, 'Password' => $Password_Hash, 'FirstName' => $FirstName, 'LastName' => $LastName));
		$id = $pdo->lastInsertId($sql_string);
        $statement2 = $pdo->prepare("INSERT INTO Student (MatriculationNumber, BirthDate, Residence, StudyCourse, PersonID) VALUES (:MatriculationNumber, :BirthDate, :Residence, :StudyCourse, :PersonID)");
		$result2 = $statement2->execute(array('MatriculationNumber' => $MatriculationNumber, 'BirthDate' => $BirthDate, 'Residence' => $Residence, 'StudyCourse' => $StudyCourse, 'PersonID' => $id));

        if($result) {        
			echo '<script>
			setTimeout(function() {
				swal.fire({
					title: "Registierung erfolgreich!",
					text: "Du kannst dich jetzt anmelden.",
					icon: "success",
					showCloseButton: true,
					timer: 3000,
					timerProgressBar: true
				}, );
			}, 300);
		</script>';
        } else {
			echo '<script>
			setTimeout(function() {
				swal.fire({
					title: "Registierung gescheitert!",
					text: "Beim Speichern ist ein Fehler aufgetreten.",
					icon: "error",
					showCloseButton: true,
					timer: 3000,
					timerProgressBar: true
				}, );
			}, 300);
		</script>';         
		}
    } 
}
 
?>

 	<?php include("webElements/header.php"); ?>
<main class="border-bottom">
<hr class="d-none d-lg-block">
     <div class="col-lg-8 mx-auto p-3 py-md-5">
		<div class="row align-items-center">
			<div class="col-md-6">
				<h1 class="display-4 fw-bold lh-1 mb-3">Noch nicht registriert?</h1>
				<p class="col-lg-10 fs-4">Wenn du keinen Account besitzt, kannst du dich hier auf dieser Seite registrieren.</p>
			</div>
			<div class="col-md-6">
				<form class="p-4 p-md-6 border rounded-3 bg-light needs-validation" novalidate="" action="?register=1" method="post">
					<div class="row">
						<div class="col">
							<input class="form-control" pattern="[a-zA-ZÄÖÜäöüß]+" placeholder="Vorname" required="" type="text" name="FirstName">
							<div class="invalid-feedback">
							Nur Buchstaben erlaubt!
						</div>
						</div>
						<div class="col">
							<input class="form-control" pattern="[a-zA-ZÄÖÜäöüß]+" placeholder="Nachname" required="" type="text" name="LastName">
							<div class="invalid-feedback">
							Nur Buchstaben erlaubt!
						</div>
						</div>
					</div>
                    <div class="col">
						<input class="form-control" pattern=".+@stud\.uni-bamberg\.de" placeholder="Studentische E-Mail-Adresse" required="" type="email" name="Email">
						<div class="invalid-feedback">
							Nur @stud.uni-bamberg.de erlaubt!
						</div>
					</div>
					<div class="row">
						<div class="col">
							<input class="form-control" pattern="[a-zA-ZÄÖÜäöüß]+" placeholder="Wohnort" required="" type="text" name="Residence">
							<div class="invalid-feedback">
							Nur Buchstaben erlaubt!
						</div>
						</div>
						<div class="col">
							<input class="form-control" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" id="datepicker" placeholder="Geburtsdatum" required="" type="text" name="BirthDate">
							<div class="invalid-feedback">
							Nur YYYY-MM-DD erlaubt!
						</div>
						</div>
					</div>
					<div class="row">
                    <div class="col">
						<input class="form-control" pattern="[0-9]+" placeholder="Matrikelnummer" required="" type="text" name="MatriculationNumber">
						<div class="invalid-feedback">
							Nur Zahlen erlaubt!
						</div>
                    </div>
						<div class="col">
							<select class="form-select" required="" name="StudyCourse">
								<option selected="selected" value="">
									Studiengang
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
							<div class="invalid-feedback">
							Studiengang fehlt!
						</div>
						</div>
                        </div>
                        <div class="row">
					<div class="col">
					<input class="form-control" placeholder="Passwort" required="" type="password" name="Password">
					</div>
                    <div class="col">
					<input class="form-control" placeholder="Passwort wdh." required="" type="password" name="Password2">
					</div>
</div>
						<div class="row">
							<div class="col">
								<input class="form-check-input" id="check" name="remember" required="" type="checkbox"> <label class="form-check-label" for="check"><a href="privacynote.php">Datenschutzerklärung <i class="bi bi-question-circle"></i></a></label>
								<div class="valid-feedback">
									Datenschutzerklärung zugestimmt.
								</div>
								<div class="invalid-feedback">
									Bitte der Datenschutzerklärung zustimmen.
								</div>
							</div>
						</div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Registrieren</button>
					<hr class="my-4">
					<small class="text-muted">Account vorhanden?</small><br>
					<div>
					<?php if($_SESSION['userid']) { echo '<button class="btn btn-sm btn-outline-success" onclick="location.href = \'dashboard.php\'" type="button">Zum Dashboard</button>'; } else { echo '<button class="btn btn-sm btn-outline-success" onclick="location.href = \'login.php\'" type="button">Hier anmelden</button>'; } ?>
					 <button class="btn btn-sm btn-outline-success" onclick="location.href = 'loginSB.php'" type="button">Sacharbeiter</button>
</div>
					</form>
			</div>
		</div>
	</div>

                            </main>

	<?php include("webElements/footer.php"); ?>
