<?php
session_start();
if (!isset($_SESSION['userid'])) {
	header('Location: login.php');
}

require 'config.php';

$page = "inbox";

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
            <div class="container rounded bg-white">            
    <div class="row">


      <div class="col p-0 m-0">

        <div class="row">
          <div class="col m-1">
            <h4>Nachricht verfassen</h4>
          </div>
        </div>

        <div class="row m-1">


          <!-- Feedback ob die Nachricht erfolreich gesendet wird order  nicht -->
          <?php
          if (isset($_SESSION['msg_success'])) { ?>

                <?php echo '<script>
	setTimeout(function() {
		swal.fire({
			title: "E-Mail gesendet!",
			text: "Deine E-Mail wurde erfolgreich gesendet.",
			icon: "success"
		}, );
	}, 300);
	setTimeout(function() {
		window.location.href = "neueMsg.php";
	}, 2000);
</script>'; ?>

          <?php
            unset($_SESSION['msg_success']);
          } elseif (isset($_SESSION['msg_fail'])) {

          ?> 
                <?php 	echo '<script>
	setTimeout(function() {
		swal.fire({
			title: "Versenden gescheitert!",
			text: "Beim Versenden deiner E-Mail ist ein Fehler aufgetreten.",
			icon: "error"
		}, );
	}, 300);
	setTimeout(function() {
		window.location.href = "neueMsg.php";
	}, 2000);
</script>'; ?>


          <?php unset($_SESSION['msg_fail']);
          } ?>


          <!--Form fürs Schreiben einer neuen Nachricht-->

          <form class="needs-validation" novalidate="" name="neueMsgSchreiben" action="newMsg.php" method="POST">
            <label for="recipient">Empfäger:</label>
            <select type="text" class="form-select" placeholder="Empfanger" name="recipient" id="recipName" value="<?php if (isset($_GET['recipName'])) {
                                                                                                                      echo replacePoint($_GET['recipName']);
                                                                                                                    } ?>">
                                                                                                                    <?php
$stmt = $pdo->prepare("SELECT * FROM Worker JOIN UniMember ON Worker.PersonID = UniMember.PersonID");
$stmt->execute();

if ($stmt->rowCount() > 0) {
  while ($row = $stmt->fetch()) {
echo '<option value="'.$row['PersonID'].'">'.$row['FirstName'].' '.$row['LastName'].'</option>';
  }
}
?>

                                                                                                                  
                                                                                                                  </select><br>
            <label for="subject">Betreff:</label>
            <input required="" type="text" class="form-control" placeholder="Betreff" name="subject" id="msgSubject"><br>
            <label for="message">Nachricht:</label>

            <textarea required="" class="form-control w-100" cols="40" rows="5" placeholder="Nachricht verfassen" name="message" id="msgBody"></textarea>

            <button type="submit" class="btn btn-primary my-3 w-100" name="newMsgBtn">Nachricht senden</button>
            <a href="inbox.php" class="btn btn-outline-primary mt-1 w-100">Zurück</a>

          </form>

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
	</div>
</main>
<?php
include "webElements/footer.php";
?>

<?php
function replacePoint($name)
{
  return $result = str_replace(".", " ", $name);
}
?>