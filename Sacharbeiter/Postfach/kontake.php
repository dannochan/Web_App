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
  <title>Uniprofil Verwaltung</title>
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
      <?php include  "../../webElements/sidebarSB.php"; ?>
    </div>


    <div class="col right">
      <!--Link to the startpage under the navbar-->
      <nav aria-label="breadcrumb" class="d-none d-lg-block">
        <p class="breadcrumb">»<a href="https://web06.iis.uni-bamberg.de/WIP/wip2122_g3/">Startseite</a></p>
      </nav>
      <div class="row">
        <div class="col md-auto">
          <h2>Kontakte</h2>
        </div>
      </div>



      <!-- Die Tabelle von den Partneruniversitäten-->
      <div class="row px-3 table-wraper">
        <a href="postfach.php" class="btn btn-outline-primary mt-1 w-100">Zurück zum Postfach</a>
        <Form class=" m-0 p-0">

          <table class="table table-hover border border-secondary mt-1 my-table" id="my-table">
            <thead>
              <tr class=" table-info">
                <th scope="col"><b>#</b></th>
                <th scope="col" colspan="2"><b>Name</b></th>
                <th scope="col" class="text-end"><b>Kontaktieren</b></th>
              </tr>
            </thead>
            <tbody>
              <!--!!!wenn keine Suchkriterien eingesetzt ist, dann normale tabelle sonst andere tabelle
          oder einfach die SQL statement ändern?  -->
              <?php include 'kontakteTabelle.php'; ?>
            </tbody>
          </table>
        </Form>
      </div>
    </div>
  </div>



  <script>
    $(document).ready(function() {
      $(document).on('click', '.contactBtn', function() {
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