<?php
session_start();
if (!isset($_SESSION['userid'])) {
	header('Location: login.php');
}

require 'config.php';

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
            <h4>Gesendete E-Mails</h4>  <div class="row">


    <div class="p-0 m-0">

      <!-- Navbar für die Nachrichte-->
      <div class="row">
        <div class="col-sm-2 py-2">
          <ul class="list-group list-group-flush bg-transparent">
            <li class="list-group-item list-group-item-action bg-transparent"><a class="nav-link active m-0 p-0" href="inbox.php">Posteingang</a></li>
            <li class="list-group-item list-group-item-action bg-transparent nav-item"><a class="nav-link active m-0 p-0" href="sentMsg.php">Gesendet</a></li>
          </ul>
        </div>
        <div class="col">
          <div class="row">
          <div class="mb-2 text-center">
          <a href="neueMsg.php" class="w-100 btn btn-labeled btn-primary me-5 w-25">E-Mail versenden</a>
          </div>
            <form method="GET" action="offeneMsg.php">

              <table class="table table-hover table-bordered border-secondary my-table " id="my-table">
                <thead>
                  <tr class=" table-light">
                  <th scope="col">Betreff</th>
                    <th scope="col">Benutzer</th>
                    <th scope="col">Aktion</th>
                  </tr>
                </thead>
                <tbody>
                    <!--!!!wenn keine Suchkriterien eingesetzt ist, dann normale tabelle sonst andere tabelle
                    oder einfach die SQL statement ändern?  -->

                    <?php
                    $senderId = $_SESSION['userid'];
                    $sql = "SELECT Message.MessageID, Message.Subject, Message.isDelete, UniMember.FirstName, UniMember.LastName FROM Message 
                    INNER JOIN UniMember ON Message.Receiver = UniMember.PersonID
                    WHERE Sender = ?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(array($senderId));
                    if ($stmt->rowCount() != 0) :
                      while ($row = $stmt->fetch()) :

                    ?>
                        <tr>
                          <th scope="row"><?php echo $row['Subject']; ?></th>
                          <td><?php echo $row['FirstName'] . " " . $row['LastName']; ?></td>
                          <td style="text-align: center"><button class="btn btn-primary btn-sm openBtn" type="submit" id="openBtn" name="openBtn"><a href="offeneMsg.php?MessageID=<?php echo $row['MessageID']; ?>">Öffnen</a></button>
                          </td>
                        </tr>
                    <?php endwhile;
                    endif; ?>
                  </tbody>
                </table>
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
	</div>
                </main>
<?php
include "webElements/footer.php";
?>