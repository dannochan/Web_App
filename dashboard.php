<?php
session_start();
if(!isset($_SESSION['userid'])) {
	header('Location: login.php');
}

$page = "dashboard";

include("config.php");

$MatriculationNumber = $_SESSION['matriculation'];

			//abfrage, ob initialer antrag vom eingeloggten user vorliegt
			$statement4 = $pdo->query("SELECT MatriculationNumber FROM InitialRequest WHERE MatriculationNumber = $MatriculationNumber");
			$result4 = $statement4->fetch();	

include("webElements/status.php");

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

<?php 

$profile = "";
$upload = "";

//abfrage, ob profil vom eingeloggten user vollständig ist
$statement = $pdo->query("SELECT PhoneNumber, Street, PostalCode, Semester FROM Student WHERE MatriculationNumber = $MatriculationNumber");
$result = $statement->fetch();

//abfrage, ob initialer antrag vom eingeloggten user vorliegt
$statement2 = $pdo->query("SELECT MatriculationNumber FROM InitialRequest WHERE MatriculationNumber = $MatriculationNumber");
$result2 = $statement2->fetch();

?>


							<div class="<?php //box-class ändert sich bei vervollständigtem profil
								if(!$result['PhoneNumber'] || !$result['Street'] || !$result['PostalCode'] || !$result['Semester']) {
									echo 'box0';
									$profile = false;
								} else { 
									echo 'box';
									$profile = true;
									}
										?>">
								<h5>Schritt 0: <div class="gif d-none d-lg-block"><a data-toggle="tooltip" data-bs-placement="bottom" title="<img width='600px' src='https://web06.iis.uni-bamberg.de/WIP/wip2122_g3/assets/images/step0.gif'/>">
							<i class="bi bi-info-circle-fill"></i></a></div></h5><i>Persönliche Daten vervollständigen</i>
							</div>

							<div class="<?php //box-class ändert sich bei vorliegendem initialen antrag
								if($profile && $result2['MatriculationNumber'] != $MatriculationNumber) {
									echo 'box0';
									$initial = false;
								} else { 
									echo 'box';
									$initial = true;
									}
										?>">
								<h5>Schritt 1: <div class="gif d-none d-lg-block"><a data-toggle="tooltip" data-bs-placement="bottom" title="<img width='600px' src='https://web06.iis.uni-bamberg.de/WIP/wip2122_g3/assets/images/step1.gif'/>">
							<i class="bi bi-info-circle-fill"></i></a></div></h5><i>Initialen Antrag ausfüllen</i>
							</div>
							<div class="<?php //box-class ändert sich bei vollständig hochgeladenen unterlagen
								if ($profile && $initial && !(file_exists($transcript) && file_exists($visa) && file_exists($lang) && file_exists($motivation) && file_exists($pass) && file_exists($photo))) { 
									echo 'box0';
									$upload = false;
								} else { 
									echo 'box';
									$upload = true;
									} 
										?>">
								<h5>Schritt 2: <div class="gif d-none d-lg-block"><a data-toggle="tooltip" data-bs-placement="bottom" title="<img width='600px' src='https://web06.iis.uni-bamberg.de/WIP/wip2122_g3/assets/images/step2.gif'/>">
							<i class="bi bi-info-circle-fill"></i></a></div></h5><i>Unterlagen hochladen</i>
							</div>
							<div class="<?php //box-class ändert sich bei erfüllten schritt 0-2 
								if($profile && $initial && $upload) {
									echo 'box0';
								} else { 
									echo 'box';
									}
										?>">
								<h5>Schritt 3: <div class="gif d-none d-lg-block"><a data-toggle="tooltip" data-bs-placement="bottom" title="<img width='600px' src='https://web06.iis.uni-bamberg.de/WIP/wip2122_g3/assets/images/step3.gif'/>">
							<i class="bi bi-info-circle-fill"></i></a></div></h5><i>Bewerbung abschicken</i>
							</div>
						</div>
						<div class="row">
							<div class="status">
							<div class="align-middle">
						<div class="mx-auto">
						<?php include("webElements/progress.php"); ?>
									</div><?php if($value == 100) { echo '<b>Unterlagen vollständig!</b>'; } else { echo '<b>Unterlagen benötigt!</b>'; } ?>
								</div>
								</div>
							<div class="feed">
								<?php get_newest_msg(); echo '<hr>'; get_newest_review();?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
	<?php include("webElements/footer.php"); ?>

<?php 
	function get_newest_msg(){
		$pdo = connect();
		$id = $_SESSION['userid'];
		$statement = $pdo->prepare("SELECT * FROM Message WHERE Receiver = ? AND isNew = 1 ORDER BY MessageID ASC LIMIT 1");
		$statement->execute(array($id));
		if ($statement->rowCount() === 0){
			// Keine Nachrichten im Postfach vorhanden
			echo '<b>Deine neueste ungelesene E-Mail:</b><br><i>Du hast alle deine E-Mails gelesen.</i>';
		}else{
			while($row = $statement->fetch()){
				$subject = $row['Subject'];
				// Aktuellste Betreffzeile aus dem Postfach
				echo '<b>Deine neueste ungelesene E-Mail:</b><br><i>'.$subject.'</i>';
			}
		}
	}

	function get_newest_review(){
		$pdo = connect();
		$statement = $pdo->prepare("SELECT * FROM Reviews JOIN University ON Reviews.UniID = University.UniID WHERE Status = 'Angenommen' ORDER BY ReviewID DESC LIMIT 1");
		$statement->execute();
		if ($statement->rowCount() === 0){
			// Keine Rezension in der Datenbank
			echo '<b>Die neueste Rezension:</b><i>Es sind keine Rezensionen vorhanden.</i>';
		}else{
			while($row = $statement->fetch()){
				$uni_name = $row['Name'];
				$uni_logo = $row['Logo'];
				$lecturer = (int)$row['Lecturer'];
				$teaching = (int)$row['Teaching'];
				$internationality = (int)$row['Internationality'];
				$facilities = (int)$row['Facilities'];
				$freeTime = (int)$row['FreeTime'];
				$campus = (int)$row['Campus'];

				$mean = ($lecturer + $teaching + $internationality + $facilities + $freeTime + $campus) / 6;
				$gesamt = (100 * $mean) / 5;
				// Bericht und Gesamtbewertung anzeigen
				echo '<b>Die neueste Rezension:</b><br>Die '.$uni_name.' <img width="5%" src="'.$uni_logo.'"> wurde zuletzt mit <div class="rate">
				<div class="empty-stars"></div>
				<div class="full-stars" style="width:'.$gesamt.'%"></div>
			</div> bewertet.'; 
			}
		}
	}

?>