<?php
session_start();
if (!isset($_SESSION['userid'])) {
	header('Location: login.php');
}
include("webElements/header.php");
require "config/Error.php";
?>

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
                                <?php 
								if (isset($_GET['result'])){
									if ($_GET['result'] === "True"){
										print_result("<i class='bi bi-check-circle-fill'></i> Sie haben bereits erfolgreich eine Rezension hochgeladen.", True);
									}else{
										print_result("<i class='bi bi-exclamation-triangle-fill'></i> Sie haben keine Anfrage erhalten und können somit keine Rezension verfassen.", False);
									}
								}
								?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include("webElements/footer.php"); ?>