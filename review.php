<?php
session_start();
if (!isset($_SESSION['userid'])) {
	header('Location: login.php');
}
include("webElements/header.php");
require "config/DBConnection.php";
require "config/Error.php";

if (!get_request()){
	header("Location: reply.php?result=False");
}
if (has_replied()){
	header("Location: reply.php?result=True");
}

$userid = $_SESSION['userid'];

?>
<?php
if (isset($_POST['rezensionabsenden']) && (isset($_SESSION['userid']))) {
    if (isset($_POST['university']) && isset($_POST['radiodozent']) && isset($_POST['radiolehre']) && isset($_POST['radiointernational']) && isset($_POST['radioausstattung']) && isset($_POST['radiofreizeit']) && isset($_POST['radiocampus']) && isset($_POST['bericht'])) {
        $uni = $_POST['university'];
        $starsdozent = $_POST['radiodozent'];
        $starslehre = $_POST['radiolehre'];
        $starsinternational = $_POST['radiointernational'];
        $starsausstattung = $_POST['radioausstattung'];
        $starsfreizeit = $_POST['radiofreizeit'];
        $starscampus = $_POST['radiocampus'];
        $bericht = $_POST['bericht'];
        $matrikelnummer = $_SESSION['matriculation'];

        //Hier wird die Bewertung abgeschickt
        $sql = "INSERT INTO Reviews( MatriculationNumber, UniID, Report, Lecturer, Teaching, Internationality, Facilities, FreeTime, Campus, CreationDate, Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";        
        $con = db_connection();
        $stmt = $con->prepare($sql);
        $stmt->execute(array($matrikelnummer, $uni, $bericht, $starsdozent, $starslehre, $starsinternational, $starsausstattung, $starsfreizeit, $starscampus, date("Y-m-d"), 'Neu'));

        $stmt = $con->prepare("UPDATE `Student` SET `hasReplied` = '1' WHERE `Student`.`MatriculationNumber` = ?;");
        $stmt->execute(array($matrikelnummer));
	}
	if($stmt) {
		echo '<script>
		setTimeout(function() {
			swal.fire({
				title: "Absenden erfolgreich!",
				text: "Deine Rezension wurde erfolgreich gespeichert.",
				icon: "success"
			}, );
		}, 300);
		setTimeout(function() {
			window.location.href = "review.php";
		}, 2000);
	</script>';         
	} else {
		echo '<script>
		setTimeout(function() {
			swal.fire({
				title: "Absenden gescheitert!",
				text: "Beim Absenden deiner Rezension ist ein Fehler aufgetreten.",
				icon: "error"
			}, );
		}, 300);
		setTimeout(function() {
			window.location.href = "review.php";
		}, 2000);
	</script>';         
	}
}
?>
<script>
	function validate() {
		if (document.forms["rezension"]["university"].value == "" || document.forms["rezension"]["university"].value == "Bitte auswählen") {
			setTimeout(function() {
				swal.fire({
					title: "Absenden gescheitert!",
					text: "Bitte alle Felder ausfüllen.",
					icon: "error",
					showCloseButton: true,
					timer: 3000,
					timerProgressBar: true
				}, );
			}, 300);
				return false;
		}

		if (document.forms["rezension"]["radiointernational"].value == "") {
			setTimeout(function() {
				swal.fire({
					title: "Absenden gescheitert!",
					text: "Bitte alle Felder ausfüllen.",
					icon: "error",
					showCloseButton: true,
					timer: 3000,
					timerProgressBar: true
				}, );
			}, 300);
				return false;
		}

		if (document.forms["rezension"]["radioausstattung"].value == "") {
			setTimeout(function() {
				swal.fire({
					title: "Absenden gescheitert!",
					text: "Bitte alle Felder ausfüllen.",
					icon: "error",
					showCloseButton: true,
					timer: 3000,
					timerProgressBar: true
				}, );
			}, 300);
				return false;
		}

		if (document.forms["rezension"]["radiofreizeit"].value == "") {
			setTimeout(function() {
				swal.fire({
					title: "Absenden gescheitert!",
					text: "Bitte alle Felder ausfüllen.",
					icon: "error",
					showCloseButton: true,
					timer: 3000,
					timerProgressBar: true
				}, );
			}, 300);
				return false;
		}

		if (document.forms["rezension"]["radiocampus"].value == "") {
			setTimeout(function() {
				swal.fire({
					title: "Absenden gescheitert!",
					text: "Bitte alle Felder ausfüllen.",
					icon: "error",
					showCloseButton: true,
					timer: 3000,
					timerProgressBar: true
				}, );
			}, 300);
				return false;
		}

		if (document.forms["rezension"]["radiodozent"].value == "") {
			setTimeout(function() {
				swal.fire({
					title: "Absenden gescheitert!",
					text: "Bitte alle Felder ausfüllen.",
					icon: "error",
					showCloseButton: true,
					timer: 3000,
					timerProgressBar: true
				}, );
			}, 300);
				return false;
		}

		if (document.forms["rezension"]["radiolehre"].value == "") {
			setTimeout(function() {
				swal.fire({
					title: "Absenden gescheitert!",
					text: "Bitte alle Felder ausfüllen.",
					icon: "error",
					showCloseButton: true,
					timer: 3000,
					timerProgressBar: true
				}, );
			}, 300);
				return false;
		}

		if (document.forms["rezension"]["bericht"].value == "") {
			setTimeout(function() {
				swal.fire({
					title: "Absenden gescheitert!",
					text: "Bitte alle Felder ausfüllen.",
					icon: "error",
					showCloseButton: true,
					timer: 3000,
					timerProgressBar: true
				}, );
			}, 300);
				return false;
		}
	}
</script>

<main class="border-bottom">
	<div class="mx-auto">
		<div class="p-4 align-items-center">
			<div class="wrapper bg-light">
				<?php 
					$page = "review";
					include("webElements/nav.php"); 
				?>
				<div class="row">
					<div class="col left">
						<?php 
							include("webElements/sidebar.php"); 
							include("webElements/mobilenav.php");
						?>
					</div>
					<div class="col right">
						<div class="row">
							<?php include("webElements/breadcrumbs.php"); ?>
							<div class="container rounded bg-white">
								<h4>Rezension verfassen</h4>
								<form name="rezension" action="?rezensionabschicken=1" method="post" onsubmit="return validate()">
									<div class="grid-container rezensioncontainer">
										<div class="grid-item rezensionsitem">Universität</div>
										<select class="form-select" name="university" id="Universität">
											<option selected="selected" value="">
												Partneruniversität auswählen
											</option>
											<?php

											//gibt nur unis aus, an denen der student auch war
											$matr = $_SESSION['matriculation'];

											$statement3 = $pdo->prepare("SELECT University.Name, University.UniID FROM Student JOIN Applications ON Student.MatriculationNumber = Applications.MatriculationNumber JOIN University ON University.UniID = Applications.UniID WHERE Student.MatriculationNumber = ? AND Applications.Status = 'Angenommen'");
											$statement3->execute(array($matr));
											$result3 = $statement3->fetchAll();

											foreach ($result3 as $uni) {
												echo '<option value="' . $uni['UniID'] . '">' . $uni['Name'] . '</option>';
											}

											?>
										</select>

										<div class="grid-item rezensionsitem">Internationalität</div>
										<div class="stars">
											<div class="rating">
												<input id="star5" name="radiointernational" type="radio" value="5" class="radio-btn hide" />
												<label for="star5"><i class="bi bi-star-fill"></i></label>
												<input id="star4" name="radiointernational" type="radio" value="4" class="radio-btn hide" />
												<label for="star4"><i class="bi bi-star-fill"></i></label>
												<input id="star3" name="radiointernational" type="radio" value="3" class="radio-btn hide" />
												<label for="star3"><i class="bi bi-star-fill"></i></label>
												<input id="star2" name="radiointernational" type="radio" value="2" class="radio-btn hide" />
												<label for="star2"><i class="bi bi-star-fill"></i></label>
												<input id="star1" name="radiointernational" type="radio" value="1" class="radio-btn hide" />
												<label for="star1"><i class="bi bi-star-fill"></i></label>
												<div class="clear"></div>
											</div>
										</div>

										<div class="grid-item rezensionsitem">Ausstattung</div>
										<div class="stars">
											<div class="rating">
												<input id="star51" name="radioausstattung" type="radio" value="5" class="radio-btn hide" />
												<label for="star51"><i class="bi bi-star-fill"></i></label>
												<input id="star41" name="radioausstattung" type="radio" value="4" class="radio-btn hide" />
												<label for="star41"><i class="bi bi-star-fill"></i></label>
												<input id="star31" name="radioausstattung" type="radio" value="3" class="radio-btn hide" />
												<label for="star31"><i class="bi bi-star-fill"></i></label>
												<input id="star21" name="radioausstattung" type="radio" value="2" class="radio-btn hide" />
												<label for="star21"><i class="bi bi-star-fill"></i></label>
												<input id="star11" name="radioausstattung" type="radio" value="1" class="radio-btn hide" />
												<label for="star11"><i class="bi bi-star-fill"></i></label>
												<div class="clear"></div>
											</div>
										</div>

										<div class="grid-item rezensionsitem">Freizeitmöglichkeiten</div>
										<div class="stars">
											<div class="rating">
												<input id="star52" name="radiofreizeit" type="radio" value="5" class="radio-btn hide" />
												<label for="star52"><i class="bi bi-star-fill"></i></label>
												<input id="star42" name="radiofreizeit" type="radio" value="4" class="radio-btn hide" />
												<label for="star42"><i class="bi bi-star-fill"></i></label>
												<input id="star32" name="radiofreizeit" type="radio" value="3" class="radio-btn hide" />
												<label for="star32"><i class="bi bi-star-fill"></i></label>
												<input id="star22" name="radiofreizeit" type="radio" value="2" class="radio-btn hide" />
												<label for="star22"><i class="bi bi-star-fill"></i></label>
												<input id="star12" name="radiofreizeit" type="radio" value="1" class="radio-btn hide" />
												<label for="star12"><i class="bi bi-star-fill"></i></label>
												<div class="clear"></div>
											</div>
										</div>

										<div class="grid-item rezensionsitem">Campus</div>
										<div class="stars">
											<div class="rating">
												<input id="star53" name="radiocampus" type="radio" value="5" class="radio-btn hide" />
												<label for="star53"><i class="bi bi-star-fill"></i></label>
												<input id="star43" name="radiocampus" type="radio" value="4" class="radio-btn hide" />
												<label for="star43"><i class="bi bi-star-fill"></i></label>
												<input id="star33" name="radiocampus" type="radio" value="3" class="radio-btn hide" />
												<label for="star33"><i class="bi bi-star-fill"></i></label>
												<input id="star23" name="radiocampus" type="radio" value="2" class="radio-btn hide" />
												<label for="star23"><i class="bi bi-star-fill"></i></label>
												<input id="star13" name="radiocampus" type="radio" value="1" class="radio-btn hide" />
												<label for="star13"><i class="bi bi-star-fill"></i></label>
												<div class="clear"></div>
											</div>
										</div>

										<div class="grid-item rezensionsitem">Dozenten</div>
										<div class="stars">
											<div class="rating">
												<input id="star54" name="radiodozent" type="radio" value="5" class="radio-btn hide" />
												<label for="star54"><i class="bi bi-star-fill"></i></label>
												<input id="star44" name="radiodozent" type="radio" value="4" class="radio-btn hide" />
												<label for="star44"><i class="bi bi-star-fill"></i></label>
												<input id="star34" name="radiodozent" type="radio" value="3" class="radio-btn hide" />
												<label for="star34"><i class="bi bi-star-fill"></i></label>
												<input id="star24" name="radiodozent" type="radio" value="2" class="radio-btn hide" />
												<label for="star24"><i class="bi bi-star-fill"></i></label>
												<input id="star14" name="radiodozent" type="radio" value="1" class="radio-btn hide" />
												<label for="star14"><i class="bi bi-star-fill"></i></label>
												<div class="clear"></div>
											</div>
										</div>

										<div class="grid-item rezensionsitem">Lehre</div>
										<div class="stars">
											<div class="rating">
												<input id="star55" name="radiolehre" type="radio" value="5" class="radio-btn hide" />
												<label for="star55"><i class="bi bi-star-fill"></i></label>
												<input id="star45" name="radiolehre" type="radio" value="4" class="radio-btn hide" />
												<label for="star45"><i class="bi bi-star-fill"></i></label>
												<input id="star35" name="radiolehre" type="radio" value="3" class="radio-btn hide" />
												<label for="star35"><i class="bi bi-star-fill"></i></label>
												<input id="star25" name="radiolehre" type="radio" value="2" class="radio-btn hide" />
												<label for="star25"><i class="bi bi-star-fill"></i></label>
												<input id="star15" name="radiolehre" type="radio" value="1" class="radio-btn hide" />
												<label for="star15"><i class="bi bi-star-fill"></i></label>
												<div class="clear"></div>
											</div>
										</div>

										<div class="grid-item rezensionsitem">Bericht</div> <textarea placeholder="Dein Erfahrungsbericht..." class="form-control" rows="5" id="comment" name="bericht" style="width: 100%; height: max-content; resize: none; overflow: auto"></textarea>
										<div>
										</div>
										<button class="w-100 btn btn-lg btn-primary" type="submit" name="rezensionabsenden">Absenden</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
</main>
<?php include("webElements/footer.php"); ?>

<?php
	/**
	 * This function proofs if a student got a request to write a review.
	 * 
	 * @return bool:	True - If the student got already a request. False - If the student did not got a request.
	 */
	function get_request(){
		try{
			$db = db_connection();
			$statement = $db->prepare("SELECT getRequest FROM Student WHERE MatriculationNumber = ?");
			$statement->execute(array($_SESSION['matriculation']));
			$value = $statement->fetch();
			if ($value['getRequest']){
				return True;
			}
			return False;
		}catch(PDOException $exception){
			return False;
		}
	}

	/**
	 * This function proofs if a student wrote already a review.
	 * 
	 * @return bool:	True - If the student wrote already a review. False - If the student did not wrote a review.
	 */
	function has_replied(){
		try{
			$db = db_connection();
			$statement = $db->prepare("SELECT hasReplied FROM Student WHERE MatriculationNumber = ?");
			$statement->execute(array($_SESSION['matriculation']));
			$value = $statement->fetch();
			if ($value['hasReplied']){
				return True;
			}
			return False;
		}catch(PDOException $exception){
			return False;
		}
	}
?>

