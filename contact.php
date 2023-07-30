<?php
session_start();
if(!isset($_SESSION['userid'])) {
	header('Location: login.php');
}

$page = "contact";

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
								<h3>Dr. Patrick Walke</h3>
								<div>
								<div class="contact">
									<div class="row">
										<div class="col">
											<ul>
											<li>Leiter des Akademischen Auslandsamtes</li>
											<li>ERASMUS- und ECTS-Hochschulkoordinator</li>
											<li>Organisation der Austauschprogramme</li>
											<li>Stipendienverwaltung</li>
										</ul>
								</div>
									<div class="col"><p><i class="bi bi-geo-alt"></i>: Kapolderstraße 25, Zimmer 02.08<br><i class="bi bi-telephone"></i>: +49 (0) 951 368 -01 oder -00 (Sekretariat)<br><i class="bi bi-envelope-plus"></i>: patrick.walke(at)uni-bamberg.de<br><br>										<b>Sprechzeiten:</b><br>Telefonisch o. per Video n.V.

</p></div></div>
								</div>
								</div>

								<h3>David Berthold, M.A.</h3>
								<div>
								<div class="contact">
									<div class="row">
									<div class="col">
											<ul>
											<li>Beratung zum Auslandsstudium und den Austauschprogrammen - NORDAMERIKA/EUROPA</li>
											<li>Koordination der Bamberger Austauschprogramme</li>
										</ul>
										</div>

										<div class="col"><p><i class="bi bi-geo-alt"></i>: Kapolderstraße 25, Zimmer 02.09<br><i class="bi bi-telephone"></i>: +49 (0) 951 368 -08 oder -00 (Sekretariat)<br><i class="bi bi-envelope-plus"></i>: david.berthold(at)uni-bamberg.de<br><br><b>Sprechzeiten:</b><br>Telefonisch o. per Video n.V.</p></div>
								</div></div>
								</div>

								<h3>Petra Müller, M.Sc.</h3>
								<div>
								<div class="contact">
									<div class="row">
									<div class="col">
											<ul>
											<li>Beratung zum Auslandsstudium und den Austauschprogrammen - SÜDAMERIKA/EUROPA</li>
											<li>Koordination der Bamberger Austauschprogramme</li>
										</ul>
								</div>
								<div class="col"><p>										<i class="bi bi-geo-alt"></i>: Kapolderstraße 25, Zimmer 02.09<br><i class="bi bi-telephone"></i>: +49 (0) 951 368 -09 oder -00 (Sekretariat)<br><i class="bi bi-envelope-plus"></i>: petra.mueller(at)uni-bamberg.de<br><br><b>Sprechzeiten:</b><br>Telefonisch o. per Video n.V.
</p></div></div>
								</div>
								</div>
								<h3>Andreas Franke, M.Sc.</h3>
								<div>
								<div class="contact">
									<div class="row">
									<div class="col">
											<ul>
											<li>Beratung zum Auslandsstudium und den Austauschprogrammen - ASIEN/AFRIKA</li>
											<li>Koordination der Stipendien für Übersee</li>
										</ul>
								</div>
								<div class="col"><p>										<i class="bi bi-geo-alt"></i>: Kapolderstraße 25, Zimmer 02.10<br><i class="bi bi-telephone"></i>: +49 (0) 951 368 -10 oder -00 (Sekretariat)<br><i class="bi bi-envelope-plus"></i>: andreas.franke(at)uni-bamberg.de<br><br><b>Sprechzeiten:</b><br>Telefonisch o. per Video n.V.
</p></div></div>
								</div>
								</div>

								<h3>Maximilian Reiner, M.A.</h3>
								<div>
								<div class="contact">
									<div class="row">
									<div class="col">
											<ul>
											<li>Beratung zum Auslandsstudium und den Austauschprogrammen - ASIEN/AFRIKA</li>
											<li>Koordination der Stipendien für Europa</li>
										</ul>
								</div>
								<div class="col"><p>										<i class="bi bi-geo-alt"></i>: Kapolderstraße 25, Zimmer 02.10<br><i class="bi bi-telephone"></i>: +49 (0) 951 368 -11 oder -00 (Sekretariat)<br><i class="bi bi-envelope-plus"></i>: maximilian.reiner(at)uni-bamberg.de<br><br><b>Sprechzeiten:</b><br>Telefonisch o. per Video n.V.
</p></div></div>
								</div>
								</div>


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
