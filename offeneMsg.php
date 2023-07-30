<?php
session_start();
if (!isset($_SESSION['userid'])) {
	header('Location: login.php');
}

require 'config.php';

$page = "inbox";

?>

<?php
include ("webElements/header.php");
$page = "inbox";
?>
	<main class="border-bottom">
  <div class="mx-auto">
		<div class="p-4 align-items-center">
    <div class="wrapper bg-light">
			<?php include("webElements/nav.php"); ?>
				<div class="row">
					<div class="col left">
          <?php include ("webElements/sidebar.php"); ?>
					</div>
					<div class="col right">
						<div class="row">
						<?php include("webElements/breadcrumbs.php"); ?>
            <div class="container rounded bg-white">            
  <div class="row">


    <div class="p-0 m-0">

          <div class="col">

            <div class="row">

              <?php
              if (!empty($_GET['MessageID'])) {
                $msgID = $_GET['MessageID'];
                $sql = "SELECT Message.Subject, Message.Sender, Message.Text, UniMember.FirstName, UniMember.LastName FROM Message
                INNER JOIN UniMember ON Message.Sender = UniMember.PersonID
                WHERE MessageID = ?";
                $sqlRead = "UPDATE Message SET isNew =0 WHERE MessageID =?";
                $stmtForRead = $pdo->prepare($sqlRead);
                $stmtForRead->execute(array($msgID));
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array($msgID));
                if ($row = $stmt->fetch()) {

              ?>

                  <div class="container">
                    <label class="h4" for="subjet">Betreff:</label>
                    <div>
                      <p><b><?php echo $row['Subject']; ?></b></p>
                    </div>
                    <label class="h4" for="Sender">Absender:</label>
                    <div>
                      <p><?php echo $row['FirstName'] . " " . $row['LastName']; ?></p>
                    </div>
                    <label class="h4" for="nachricht">Nachricht:</label>
                    <div class="border rounded pt-2">
                      <p class="text-center"><?php echo $row['Text']; ?></p>
                    </div>
                    <button onclick="location.href = 'inbox.php'" class="btn btn-primary w-100 my-3">Zum Postfach</button>

                  </div>

              <?php }
              } ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
            </main>

<?php
include "webElements/footer.php";
?>