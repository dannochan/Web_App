			<?php
session_start();
if(!isset($_SESSION['userid'])) {
	header('Location: login.php');
}

$page = "apply";

include("config.php");

$MatriculationNumber = $_SESSION['matriculation'];

			//abfrage, ob initialer antrag vom eingeloggten user vorliegt
			$statement4 = $pdo->query("SELECT MatriculationNumber FROM InitialRequest WHERE MatriculationNumber = $MatriculationNumber");
			$result4 = $statement4->fetch();	


include("webElements/status.php");

$UniId = $_POST['uni'];

if(isset($_GET['apply'])) {

		if (validate_app($MatriculationNumber, $UniId)){
			$statement = $pdo->prepare("INSERT INTO Applications (MatriculationNumber, UniID) VALUES ($MatriculationNumber, $UniId)");
        	$result = $statement->execute(array('MatriculationNumber' => $MatriculationNumber, 'UniID' => $UniId));
		}else{
			$result = True;
		}

        $statement2 = $pdo->prepare("INSERT INTO Documents (MatriculationNumber, RecordTranscript, MotivationLetter, LanguageTest, Visa, PassportInfo, Passport) VALUES ($MatriculationNumber, '$transcript', '$motivation', '$lang', '$visa', '$pass', '$photo')
		/* wenn schon unterlagen hochgeladen bzw. deren pfade in die db gespeichert wurden -> empty update, damit mehrere bewerbungen mit unterschiedlichen uniids in die db gespeichert werden */
		ON DUPLICATE KEY UPDATE MatriculationNumber = $MatriculationNumber");
		$result2 = $statement2->execute(array('MatriculationNumber' => $MatriculationNumber, 'RecordTranscript' => $transcript, 'MotivationLetter' => $motivation, 'LanguageTest' => $lang, 'Visa' => $visa, 'PassportInfo' => $pass, 'Passport' => $photo));

if($result && $result2) {        
			echo '<script>
			setTimeout(function() {
				swal.fire({
					title: "Bewerbung erfolgreich!",
					text: "Deine Bewerbung ist erfolgreich eingegangen.",
					icon: "success"
				}, );
			}, 300);
			setTimeout(function() {
				window.location.href = "apply.php";
			}, 2500);
		</script>';
        } else {
			echo '<script>
			setTimeout(function() {
				swal.fire({
					title: "Bewerbung gescheitert!",
					text: "Beim Abschicken deiner Bewerbung ist ein Fehler aufgetreten.",
					icon: "error"
				}, );
			}, 300);
			setTimeout(function() {
				window.location.href = "apply.php";
			}, 2500);
		</script>';         
		}
	}
	
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

						<button  onclick="location.href = 'initialrequest.php'" class="w-100 btn btn-lg btn-<?php if($result4['MatriculationNumber']) { echo 'success'; } else { echo 'danger'; } ?>"><?php if($result4['MatriculationNumber']) { echo 'Initialer Antrag eingereicht'; } else { echo 'Zum initialen Antrag'; } ?></button>

						<div class="alert alert-warning fade show">
							<i class="bi bi-info-circle-fill"></i> Beachte die korrekten <span class="badge rounded-pill bg-warning text-dark">Dateinamen</span> - ansonsten wird der Upload nicht erkannt.
</div>
							<div class="ui-state-default">

						<div class="w350">Vorlagen

						<button onclick="location.href = 'downloads/Original_Unterlagen_Europa.zip'" download="Original_Unterlagen_Europa.zip" type="button" class="btn btn-primary btn-sm">Herunterladen</button>
						<script>
jQuery(document).ready(function(){
	jQuery('.progressbar').each(function(){
		jQuery(this).find('.progressbar-bar').animate({
			width:jQuery(this).attr('data-percent')
		},1200);
	});
});
</script>
<div class="progressbar" data-percent="<?php echo $value; ?>%">
	<div class="progressbar-title" style="background: #<?php if($value < 100) { echo '00457d;'; } else { echo '157347'; } ?>"><span>Status:</span></div>
	<div class="progressbar-bar" style="background: #<?php if($value < 100) { echo '336a97;'; } else { echo '198754'; } ?>"></div>
	<div class="progress-bar-percent" style="color: #<?php if($value == 100) { echo 'ffffff;'; } ?>"><?php echo $value; ?> %</div>
</div>
</div>
						</div>

						<div class="ui-state-default">
	<form id="uploadfiles" method="post" enctype="multipart/form-data">
		<div class="mb-3">
			<input class="form-control" id="files" type="file" name="files[]" multiple>
		</div>
		<button class="btn btn-primary btn-sm" type="submit" name="submit">Hochladen</button> <i class="bi bi-exclamation-circle-fill hint"> Nur Dateien bis 5 MB sind erlaubt!</i>
	</form>

</div>

<div class="ui-state-default">

<div>
Transcript of Records <button <?php if (file_exists($transcript)) { echo "onclick=\"location.href = '$transcript'\""; } else { echo '';  } ?> type="button" class="btn btn-<?php if (file_exists($transcript)) { echo 'primary'; } else { echo 'secondary';  } ?> btn-sm">Öffnen</button> 
	<button type="button" class="btn btn-<?php if (file_exists($transcript)) { echo 'success'; } else { echo 'danger';  } ?> btn-sm"><i class="bi bi-check-circle"></i></button>
<span class="badge rounded-pill bg-warning text-dark"><?php echo $_SESSION['lastname'].'_TranscriptOfRecords_'.$_SESSION['matriculation'] ?>.pdf</span>
</div>

</div>

<div class="ui-state-default">


<div>
Visa-Informationen <button <?php if (file_exists($visa)) { echo "onclick=\"location.href = '$visa'\""; } else { echo '';  } ?> type="button" class="btn btn-<?php if (file_exists($visa)) { echo 'primary'; } else { echo 'secondary';  } ?> btn-sm">Öffnen</button> 
	<button type="button" class="btn btn-<?php if (file_exists($visa)) { echo 'success'; } else { echo 'danger';  } ?> btn-sm"><i class="bi bi-check-circle"></i></button>
<span class="badge rounded-pill bg-warning text-dark"><?php echo $_SESSION['lastname'].'_VisaInformation_'.$_SESSION['matriculation'] ?>.pdf</span>
</div>

</div>

<div class="ui-state-default">


<div>
Sprachtest <button <?php if (file_exists($lang)) { echo "onclick=\"location.href = '$lang'\""; } else { echo '';  } ?> type="button" class="btn btn-<?php if (file_exists($lang)) { echo 'primary'; } else { echo 'secondary';  } ?> btn-sm">Öffnen</button> 
	<button type="button" class="btn btn-<?php if (file_exists($lang)) { echo 'success'; } else { echo 'danger';  } ?> btn-sm"><i class="bi bi-check-circle"></i></button>
<span class="badge rounded-pill bg-warning text-dark"><?php echo $_SESSION['lastname'].'_LanguageTest_'.$_SESSION['matriculation'] ?>.pdf</span>
</div>

</div>

<div class="ui-state-default">

<div>Motivationsschreiben <button <?php if (file_exists($motivation)) { echo "onclick=\"location.href = '$motivation'\""; } else { echo '';  } ?> type="button" class="btn btn-<?php if (file_exists($motivation)) { echo 'primary'; } else { echo 'secondary';  } ?> btn-sm">Öffnen</button> 
	<button type="button" class="btn btn-<?php if (file_exists($motivation)) { echo 'success'; } else { echo 'danger';  } ?> btn-sm"><i class="bi bi-check-circle"></i></button>
<span class="badge rounded-pill bg-warning text-dark"><?php echo $_SESSION['lastname'].'_MotivationLetter_'.$_SESSION['matriculation'] ?>.pdf</span>
</div>

</div>

<div class="ui-state-default">

<div>Pass-Informationen <button <?php if (file_exists($pass)) { echo "onclick=\"location.href = '$pass'\""; } else { echo '';  } ?> type="button" class="btn btn-<?php if (file_exists($pass)) { echo 'primary'; } else { echo 'secondary';  } ?> btn-sm">Öffnen</button> 
	<button type="button" class="btn btn-<?php if (file_exists($pass)) { echo 'success'; } else { echo 'danger';  } ?> btn-sm"><i class="bi bi-check-circle"></i></button>

<span class="badge rounded-pill bg-warning text-dark"><?php echo $_SESSION['lastname'].'_PassInformation_'.$_SESSION['matriculation'] ?>.pdf</span>
</div>

</div>
	
<div class="ui-state-default">

<div>Passbild <button <?php if (file_exists($photo)) { echo "onclick=\"location.href = '$photo'\""; } else { echo '';  } ?> type="button" class="btn btn-<?php if (file_exists($photo)) { echo 'primary'; } else { echo 'secondary';  } ?> btn-sm">Öffnen</button> 
	<button type="button" class="btn btn-<?php if (file_exists($photo)) { echo 'success'; } else { echo 'danger';  } ?> btn-sm"><i class="bi bi-check-circle"></i></button>

<span class="badge rounded-pill bg-warning text-dark"><?php echo $_SESSION['lastname'].'_PassportPhoto_'.$_SESSION['matriculation'] ?>.pdf</span>
</div>

</div>

<div style="<?php if ($result4['MatriculationNumber'] && file_exists($transcript) && file_exists($visa) && file_exists($lang) && file_exists($motivation) && file_exists($pass) && file_exists($photo)) { echo ''; } else { echo 'display:none'; } ?>" class="container rounded bg-white">
<form class="needs-validation" novalidate="" <?php //submit nur möglich, wenn alle nötigen dokumente hochgeladen wurden
if($value < 100) { echo ''; } else { echo 'action="?apply=1" method="post"'; } ?>>
<select required="" class="form-select col" name="uni">
<option selected="selected" value="">
Partneruniversität auswählen
</option>
<?php

	$statement3 = $pdo->prepare("SELECT Name, UniID FROM University ORDER BY Name ASC");
	$statement3->execute();
	$result3 = $statement3 -> fetchAll();

	foreach($result3 as $uni) {
		echo '<option value="'.$uni['UniID'].'">'.$uni['Name'].'</option>';

	}

?>
</select>
<div class="invalid-feedback col">
Bitte Partneruniversität auswählen!
</div>
<button type="submit" class="w-100 btn btn-lg btn-primary">Bewerbung abschicken</button>
</form>
</div>
	<script>
		// file upload
		const url = "uploadfile.php";
		const form = document.querySelector("#uploadfiles");

// Ein EventListener wartet auf das submit
form.addEventListener ("submit", function (evt) {
	evt.preventDefault ();
	const files = document.querySelector('[type=file]').files;
    const formData = new FormData();
    
	for (let i = 0; i < files.length; i++) {
		let file = files[i];
		formData.append('files[]', file)
	}
	
	fetch (url, {
		method: "POST",
		body: formData,
	}).then ((response) => {
		console.log (response);
		if (response.status === 200) {
			window.setTimeout(function(){location.reload()},1000)
		}
	});
});
</script>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
	<?php include("webElements/footer.php"); ?>

<?php 
	function validate_app($MatriculationNumber, $UniId){
		$pdo = connect();
		$statement = $pdo->prepare("SELECT UniID FROM Applications WHERE MatriculationNumber = ? AND UniID = ?");
		$statement->execute(array($MatriculationNumber, $UniId));
		if ($statement->rowCount() === 0){
			return True;
		}
		return False;
	}

?>