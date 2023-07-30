<?php
session_start();
if(!isset($_SESSION['userid'])) {
	header('Location: login.php');
}

$page = "faq";

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

							<div id="accordion">
								<h3>Wann sind die Bewerbungsfristen für ein Auslandssemester?</h3>
								<div>
									Der Bewerbungsschluss am Akademischen Auslandsamt ist für alle Austauschprogramme der <u>26. November des Kalenderjahres</u>.
								</div>
								<h3>Welche Unterlagen muss ich einreichen?</h3>
								<div>
									Die dazu erforderlichen Bewerbungsformulare findest du ganz bequem in diesem Bewerbungsportal. Im Einzelnen muss deine Bewerbung aus folgenden Teilen bestehen: <u>Initialer Antrag, Transcript of Records, Visa- bzw. Pass-Informationen inklusive Passbild, Sprachtest und Motivationsschreiben.</u><br><br>
									» <a href="apply.php">Hier kommst du zu den Bewerbungsunterlagen</a>
								</div>
								<h3>Wo kann ich mich über Partneruniversitäten informieren?</h3>
								<div>
									Über das Auswahlportal dieser Seite kannst du ganz bequem und einfach die wichtigsten Informationen zur gewünschten Universität einholen.<br><br>
									» <a href="universities.php">Hier kommst du zu den Partneruniversitäten</a>
								</div>
								<h3>Wie wird der Aufenthalt finanziert?</h3>
								<div>
									Für die Finanzierung deines Aufenthaltes ist eine Förderung der Universität verfügbar, für die du dich bitte im Speziellen an das <u>Akademische Auslandsamt</u> wenden. Im Normalfall ist ein Auslandssemester über Finanzierungsmöglichkeiten, wie etwa dem BAföG oder ähnliche staatliche Finanzierungsformen möglich. Bitte informiere dich im Falle einer Förderung rechtzeitig bei der zuständigen Institution.
								</div>
								<h3>Wie kann ich Studienleistungen anerkennen lassen?</h3>
								<div>
									Für die Anerkennung von Studienleistungen können sogenannte <u>Learning Agreements</u> mit Lehrstühlen abgeschlossen werden. Diese gilt es im Speziellen mit dem jeweiligen Lehrstuhl zu klären. In der Regel werden Modulhandbücher des jeweiligen Studienfaches der Auslandsuniversität benötigt, um eine Gleichwertigkeit zum Bamberger Modul bestätigen zu können. 
								</div>
								<h3>Wo finde ich Erfahrungsberichte von ehemaligen Auslandsstudierenden?</h3>
								<div>
									Diese kannst du auch ganz einfach und bequem über das Auswahlportal dieser Seite einsehen. Klicke hierfür einfach auf den Button <u>"Weitere Informationen"</u> der jeweiligen Universität und du wirst auf das Profil inklusive der Rezensionen der jeweiligen Universität weitergeleitet. Sollten keine Rezensionen vorhanden sein, kannst du der erste Austauschstudent der Universität Bamberg werden. Wir freuen uns!<br><br>
									» <a href="universities.php">Hier kommst du zu den Partneruniversitäten</a>
								</div>
								<h3>Wie sind die Semesterzeiten an den internationalen Partneruniversitäten?</h3>
								<div>
									An vielen Partneruniversitäten sind diese äquivalent zur Universiät Bamberg. In Übersee-Austauschprogrammen können diese allerdings variieren. Informiere dich daher rechtzeitig bei der <u>ausländischen Universität</u> über die jeweiligen Semesterzeiten. Die Homepage finden du im jeweiligen Profil der Universität, welches du über das Auswahlportal dieser Seite erreichst.
								</div>
								<h3>Wann und wie bekomme ich Bescheid, ob ich einen Auslandsplatz bekommen habe?</h3>
								<div>
									Mit einer Rückmeldung kannst du aller Vorraussicht nach <u>Ende Januar/Anfang Februar des Folgejahres</u> rechnen. Da dieser Prozess etwas Zeit in Anspruch nimmt, bitten wir dich etwas geduldig zu sein.
								</div>
								<h3>Was passiert nach einer Zusage von der Partneruniversität?</h3>
								<div>
									Bei einer Zusage von der Partneruniversität werden dir separat alle wichtigen Informationen von der ausländischen Universität zugesandt. In der Regel werden da wichtige Informationen zur <u>finalen Anmeldung und den ersten Tagen nach deiner Ankunft</u> versandt. Diese Informationen können allerdings erst ein paar Wochen nach der Zusage erfolgen, da in der Regel oftmals das Ende des jeweiligen Semesters abgewartet wird.
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
	<?php include("webElements/footer.php"); ?>
