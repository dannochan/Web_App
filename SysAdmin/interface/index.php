<?php session_start();?>
<!DOCTYPE html>
<html lang="de">
<?php
	require "../../config/proofSession.php";
	require "../../webElements/head.php";
?>
<body class="shadow-lg">
	<div class="site">
		<?php 
			require "../../webElements/headerSB.php";
			include "../../webElements/navAdmin.php";
			include "../../webElements/mobilenavAdmin.php"
		?>

		<?php 
			include "../../config/Error.php";
			include "interface.php"; 
			include "../../webElements/footerSB.php";
		?>
	</div>
</body>
</html>