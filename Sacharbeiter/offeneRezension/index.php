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
		$page = "review";
		include "../../webElements/navSB.php";
		include "../../webElements/mobilenavSB.php"
	?>

	<?php 
		include "../../config/Error.php";
		include "review.php"; 
		include "../../webElements/footerSB.php";
	?>
	</div>
</body>
</html>