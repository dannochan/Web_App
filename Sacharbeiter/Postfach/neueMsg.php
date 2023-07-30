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

    <div class=" col right">
      <!--Link to the startpage under the navbar-->
      <nav aria-label="breadcrumb" class="d-none d-lg-block">
        <p class="breadcrumb">»<a href="https://web06.iis.uni-bamberg.de/WIP/wip2122_g3/">Startseite</a></p>
      </nav>
      <div class="col p-0 m-0">

        <div class="row">
          <div class="col m-1">
            <h2>Postfach</h2>
          </div>
        </div>

        <div class="row m-1">


          <!-- Feedback ob die Nachricht erfolreich gesendet wird order  nicht -->
          <?php
          if (isset($_SESSION['msg_success'])) { ?>
            <div class="alert alert-success d-flex align-items-center" role="alert">
              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                <use xlink:href="#check-circle-fill" />
              </svg>
              <div>
                <?php echo $_SESSION['msg_success']; ?>
              </div>
            </div>
          <?php
            unset($_SESSION['msg_success']);
          } elseif (isset($_SESSION['msg_fail'])) {

          ?> <div class="alert alert-warning d-flex align-items-center" role="alert">
              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:">
                <use xlink:href="#exclamation-triangle-fill" />
              </svg>
              <div>
                <?php echo $_SESSION['msg_fail']; ?>
              </div>
            </div>

          <?php unset($_SESSION['msg_fail']);
          } ?>


          <!--Form fürs Schreiben einer neuen Nachricht-->

          <form name="neueMsgSchreiben" action="newMsg.php" method="POST">
            <label for="recipient">Empfanger</label>
            <input type="text" class="form-control" placeholder="Empfanger" name="recipient" id="recipName" value="<?php if (isset($_GET['recipName'])) {
                                                                                                                      echo replacePoint($_GET['recipName']);
                                                                                                                    } ?>">
            <label for="subject">Betreff</label>
            <input type="text" class="form-control" placeholder="Betreff" name="subject" id="msgSubject">
            <label for="message">Nachricht</label>
            <textarea class="form-control w-100" cols="40" rows="5" placeholder="Nachricht schreiben" name="message" id="msgBody"></textarea>

            <button type="submit" class="btn btn-outline-primary  w-100" name="newMsgBtn"> Nachricht senden</button>
            <a href="postfach.php" class="btn btn-outline-primary mt-1 w-100">
              Zurück zum Postfach</a>

          </form>

        </div>

      </div>
    </div>

  </div>



</body>
<?php
include "../../webElements/footerSB.php";
?>

<?php
function replacePoint($name)
{
  return $result = str_replace(".", " ", $name);
}
?>

</html>