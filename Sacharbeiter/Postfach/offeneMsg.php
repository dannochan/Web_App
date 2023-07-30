<?php
session_start();
require '../../config/DBConnection.php';
?>
<!DOCTYPE HTML>
<html lang="de">

<head>
  <meta http-equiv="X-UA-Compatible" content="text/html" charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../../assets/css/bootstrap.min-5.1.2.css" rel="stylesheet" type="text/css">
  <link href="../../assets/css/jquery-ui.min-1.13.0.css" rel="stylesheet" type="text/css">
  <link href="../../assets/css/custom.css" rel="stylesheet" type="text/css">
  <link href="../../assets/css/unipro.css" rel="stylesheet" type="text/css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
  <script src="../../assets/js/bootstrap.bundle.min-5.1.2.js" type="text/javascript"></script>
  <script src="../../assets/js/jquery.min-3.6.0.js" type="text/javascript"></script>
  <script src="../../assets/js/jquery-ui.min-1.13.0.js" type="text/javascript"></script>
  <title>Postfach</title>
</head>

<body class="shadow-lg">
  <!-- Temmplate Elemente einbinden, div tag mit Class werden noch gebraucht für die php-file, 
  damit man die noch mit eigenem CSS Stylesheet ändern  kann.-->
  <?php
  include "../../webElements/headerSB.php";
  $page = "post";
  include "../../webElements/navSB.php";
  include "../../webElements/mobilenavSB.php";
  ?>
  <div class="row">
    <div class="col left">
      <?php include "../../webElements/sidebarSB.php"; ?>
    </div>

    <div class=" col right ">
      <!--Link to the startpage under the navbar-->
      <nav aria-label="breadcrumb" class="d-none d-lg-block">
        <p class="breadcrumb">»<a href="https://web06.iis.uni-bamberg.de/WIP/wip2122_g3/">Startseite</a></p>
      </nav>
      <div class="col p-0 m-0">

        <div class="row">
          <div class="col mx-3 mt-2">
            <h2>Postfach</h2>
          </div>
        </div>

        <!-- Navbar für die Nachrichte-->
        <div class="row m-1">
          <div class="col col-sm-2 py-2 bg-secondary text-dark bg-opacity-25" style="height:530px; ">
            <ul class="list-group list-group-flush bg-transparent">
              <li class="list-group-item list-group-item-action bg-transparent"><a href="postfach.php">Posteingang</a></li>
              <li class="list-group-item list-group-item-action bg-transparent"><a href="sentMsg.php">Gesendte</a></li>
              <li class="list-group-item list-group-item-action bg-transparent"><a href="deleteMsg.php">Gelöschte</a> </li>
            </ul>
          </div>

          <div class="col col-sm-10">

            <div class="row overflow-auto" style="height: 480px">

              <?php
              if (!empty($_GET['MessageID'])) {
                $msgID = $_GET['MessageID'];
                $sql = "SELECT Message.Subject, Message.Sender, Message.Text, UniMember.FirstName, UniMember.LastName FROM Message
                INNER JOIN UniMember ON Message.Sender = UniMember.PersonID
                WHERE MessageID = ?";
                $sqlRead = "UPDATE Message SET isNew =0 WHERE MessageID =?";
                $stmtForRead = db_connection()->prepare($sqlRead);
                $stmtForRead->execute(array($msgID));
                $stmt = db_connection()->prepare($sql);
                $stmt->execute(array($msgID));
                if ($row = $stmt->fetch()) {

              ?>

                  <div class="container ">
                    <label class="h5" for="subjet">Subject:</label>
                    <div>
                      <p><?php echo $row['Subject']; ?></p>
                    </div>
                    <label class="h5" for="Sender">Sender:</label>
                    <div>
                      <p><?php echo $row['FirstName'] . " " . $row['LastName']; ?></p>
                    </div>
                    <label class="h5" for="nachricht">Nachricht:</label>
                    <div class="border border-secondary rounded pt-2">
                      <p><?php echo $row['Text']; ?></p>
                    </div>
                    <?php if ($row['Sender'] != $_SESSION['PersonID']) { ?>
                      <input type="button" name="replyBtn" value="Nachricht antworten" id="<?php echo $row["Sender"]; ?>" class="btn btn-outline-primary w-100 my-3 p-1 replyBtn" />
                    <?php }; ?>

                  </div>

              <?php }
              } ?>

            </div>
          </div>
        </div>
      </div>
    </div>


  </div>

  <script>
    $(document).ready(function() {
      $(document).on('click', '.replyBtn', function() {
        var perId = $(this).attr("id");
        $.ajax({
          url: "fetchID.php",
          method: "POST",
          data: {
            PersonID: perId
          },
          dataType: "json",
          success: function(data) {
            window.location.href = "neueMsg.php?recipName=" + data.FirstName + "." + data.LastName;
          }
        });


      });
    });
  </script>

</body>
<?php
include "../../webElements/footerSB.php";
?>

</html>