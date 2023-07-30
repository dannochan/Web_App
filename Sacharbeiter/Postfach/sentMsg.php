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
    <div class="col left"><?php include "../../webElements/sidebarSB.php"; ?></div>
    <div class="col right">
      <!--Link to the startpage under the navbar-->
      <nav aria-label="breadcrumb" class="d-none d-lg-block">
        <p class="breadcrumb">»<a href="https://web06.iis.uni-bamberg.de/WIP/wip2122_g3/">Startseite</a></p>
      </nav>
      <div class="col p-0 m-0 ">

        <div class="row">
          <div class="col m-1">
            <h2>Postfach</h2>
          </div>
        </div>

        <!-- Navbar für die Nachrichte-->
        <div class="row m-1">
          <div class="col col-sm-2 py-2 bg-secondary text-dark bg-opacity-25" style="height:540px; ">
            <ul class="list-group list-group-flush bg-transparent">
              <li class="list-group-item list-group-item-action bg-transparent"> <a href="postfach.php">Posteingang</a></li>
              <li class="list-group-item list-group-item-action bg-transparent"><a class="nav-link active m-0 p-0" href="sentMsg.php">Gesendete</a></li>
              <li class="list-group-item list-group-item-action bg-transparent "><a href="deleteMsg.php">Gelöschte</a> </li>
            </ul>
          </div>
          <div class="col col-sm-9">

            <div class=" bg-secondary mb-2 p-2 text-center text-dark bg-opacity-25" style="width: 640px; ">
              <a href="neueMsg.php" class="btn btn-labeled btn-outline-primary me-5 w-25">
                <span class="btn-label"><i class="bi bi-envelope m-2"></i></span>neue E-Mail</a>
              <a href="kontake.php" class="btn btn-labeled btn-outline-primary me-5 w-25">
                <span class="btn-label"><i class="bi bi-envelope m-2"></i></span>Kontakte</a>
            </div>

            <div class="row overflow-auto" style="width: 665px; height: 480px">
              <Form class=" " method="GET" action="offeneMsg.php">

                <table class="table table-hover table-bordered border-secondary my-table " id="my-table">
                  <thead>
                    <tr class=" table-light">
                      <th scope="col">Betreff</th>
                      <th scope="col">User</th>
                      <th scope="col">öffnen</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!--!!!wenn keine Suchkriterien eingesetzt ist, dann normale tabelle sonst andere tabelle
            oder einfach die SQL statement ändern?  -->

                    <?php
                    $senderId = $_SESSION['PersonID'];
                    $sql = "SELECT Message.MessageID, Message.Subject, Message.isDelete, UniMember.FirstName, UniMember.LastName FROM Message 
            INNER JOIN UniMember ON Message.Receiver = UniMember.PersonID
            WHERE Sender = ?";
                    $stmt = db_connection()->prepare($sql);
                    $stmt->execute(array($senderId));
                    if (count($row) != 0) :
                      while ($row = $stmt->fetch()) :

                    ?>
                        <tr>
                          <th scope="row"><?php echo $row['Subject']; ?></th>
                          <td><?php echo $row['FirstName'] . " " . $row['LastName']; ?></td>
                          <td><button class="btn btn-primary btn-sm openBtn" type="submit" id="openBtn" name="openBtn"><a href="offeneMsg.php?MessageID=<?php echo $row['MessageID']; ?>">Öffnen</a></button>
                          </td>
                        </tr>
                    <?php endwhile;
                    endif; ?>
                  </tbody>
                </table>
              </Form>
            </div>
          </div>
        </div>
      </div>
    </div>



  </div>
</body>
<?php
include "../../webElements/footerSB.php";
?>

</html>