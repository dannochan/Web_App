<?php
session_start();
require '../../config/DBConnection.php';
?>
<!DOCTYPE html>
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
  $page = "university";
  include "../../webElements/navSB.php";
  include "../../webElements/mobilenavSB.php";
  ?>
  <div class="row">

    <div class=" col left"><?php include  "../../webElements/sidebarSB.php"; ?></div>

    <div class=" col right">
      <div class="container">
        <!--Link to the startpage under the navbar-->
        <nav aria-label="breadcrumb" class="d-none d-lg-block">
          <p class="breadcrumb">»<a href="https://web06.iis.uni-bamberg.de/WIP/wip2122_g3/">Startseite</a></p>
        </nav>

        <div class="col p-0 m-0">
          <div class="col">
            <div class="row">
              <div class="col md-auto">
                <h2>Partneruniversitäten</h2>
              </div>
            </div>

            <?php
            if (isset($_SESSION['errorArray']) && !empty($_SESSION['errorArray'])) {

              echo
              '<div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
              <use xlink:href="#check-circle-fill" />
            </svg>
            <div>
             ' . $_SESSION['errorArray'] . '
            </div>
          </div>';

              unset($_SESSION['errorArray']);
            }
            ?>

            <div class="container border border-light filter-area">
              <form class="row my-0 py-0 filter-form" action="./uniProf.php" method="POST">
                <div class="row row-col-2 mt-2 align-items-center">
                  <div class="col">
                    <label class="f-label col-sm-3" for="ID">ID</label>
                    <input class="f-label form-control-sm col-sm-8" type="text" name="uniID" placeholder="--ID eingeben--">
                  </div>
                  <div class="col ">
                    <label class="f-label col-sm-3" for="UniName">Name</label>
                    <input class="f-label form-control-sm col-sm-8" type="text" name="uniName" placeholder="--Universität eingeben--">
                  </div>
                </div>
                <div class="row row-col-2 align-items-center">
                  <div class="col">
                    <label class="f-label col-sm-3" for="Land">Land</label>
                    <input class="f-label form-control-sm col-sm-8" type="text" name="uniLand" placeholder="--Land eingeben--">

                  </div>
                  <div class="col">
                    <label class="f-label col-sm-3" for="Region">Region</label>
                    <input class="f-label form-control-sm col-sm-8" type="text" name="uniRegion" placeholder="--Region eingeben--">
                  </div>
                </div>
                <div class=" row row-col-2 align-items-center">
                  <div class=" col">
                    <label class="f-label col-sm-3" for="Abschluss">Abschluss</label>
                    <select class="f-label form-select-sm col-sm-8" name="filterDegree">
                      <option selected value>--Abschluss auswählen--</option>
                      <option value="Bachelor">Bachelor</option>
                      <option value="Master">Master</option>
                    </select>
                  </div>
                  <div class="col">
                    <label class="f-label col-sm-3" for="Semester">Semester</label>
                    <select class="f-label form-select-sm col-sm-8" name="filterSemester">
                      <option selected value>--Semester auswählen--</option>
                      <option value="sommer">Sommersemester</option>
                      <option value="winter">Wintersemester</option>
                      <option value="SSundWS">Beides</option>
                    </select>
                  </div>
                </div>
                <div class=" row align-items-center">
                  <button type="submit" class="btn btn-primary" id="filter-Btn" name="filter-Btn">Suchen</button>
                </div>

              </form>


            </div>

            <!-- Buttonf für die Funktion: Anlegen, Konfigurieren und Löschen -->

            <div class="row ">
              <div class=" btn-bar btn-group ml-0 ml-0 mt-1" role="group">
                <!--Das erste Button soll eigentlich <a> sein, Änderung nach Integration der Tabelle-->
                <div><button type="button" class="btn btn-outline-primary btn-md" data-bs-toggle="modal" data-bs-target="#profilAnlegen">
                    <span><img src="../../assets/images/plus.svg" alt="plus" class="bi-plus"></span>
                    <b>Profil anlegen</b> </button></div>

              </div>
            </div>

            <!-- Die Tabelle von den Partneruniversitäten-->

            <div class="container m-0 p-0">
              <div class="row px-3 table-wraper">
                <Form class=" m-0 p-0" method="POST" action="updateForm.php">

                  <table class="table table-hover border border-secondary mt-1 my-table table-sm" id="my-table">
                    <thead>
                      <tr class=" table-info">
                        <th scope="col"><b>ID</b></th>
                        <th scope="col"><b>Name</b></th>
                        <th scope="col"><b>Land</b></th>
                        <th scope="col"><b>Stadt</b></th>
                        <th scope="col" colspan="2"><b>Operation</b></th>
                      </tr>
                    </thead>
                    <tbody>
                      <!--!!!wenn keine Suchkriterien eingesetzt ist, dann normale tabelle sonst andere tabelle
          oder einfach die SQL statement ändern?  -->
                      <?php include 'DataTable.php'; ?>
                    </tbody>
                  </table>
                </Form>
              </div>
            </div>


          </div>
        </div>
      </div>





    </div>

    <!-- Popup Fenster für Profil anlegen-->
    <?php include 'newProf.php' ?>

    <script>
      // Die Schlagwörter submitten wenn Eingabe gedrückt wird
      document.getElementById("filter-Btn").addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
          event.defaultPrevented;
          document.getElementById("filter-Btn").click;
        }

      })

      $('#my-table tbody tr').click(function() {
        if ($(this).hasClass('table-primary')) {
          $(this).removeClass('table-primary');
        } else {
          $(this).addClass('table-primary').siblings().removeClass('table-primary');
        }
      })

      function validate_info(event) {
        remove_error_msg();
        change_border_color();
        var uniname = document.querySelector("#uniname").value;
        var unilocation = document.querySelector("#unilocation").value;
        var unicountry = document.querySelector("#unicountry").value;
        var unicontact = document.querySelector("#unicontact").value;
        var unigrade = document.querySelector("#unigrade").value;
        var unilink = document.querySelector("#unilink").value;
        var unilogo = document.querySelector("#unilogo").value;
        var unifotos = document.querySelector("#unifotos").value;
        var description = document.querySelector("#kurzBeschreibung").value;
        var check = true;

        if (uniname == "") {
          document.getElementById("uniname").style = "border-color: red";
          check = false;
        } else {
          let pattern = /[0-9]+/;
          if (pattern.test(uniname) || uniname.length < 5) {
            var div = document.getElementById("profErstellen");
            var p = document.createElement("div");
            p.innerHTML = "Bitte für die Universität einen gültigen Namen nur mit Buchstaben eingeben!";
            p.style.cssText = "color:red;";
            p.id = "ErrorUN";
            div.appendChild(p);
            document.getElementById("uniname").style = "border-color: red";
            check = false;
          }
        }

        if (unilocation == "") {
          document.getElementById("unilocation").style = "border-color: red";
          check = false;
        } else {
          let pattern = /[0-9]+/;
          if (pattern.test(unilocation) || unilocation.length < 5) {
            var div = document.getElementById("profErstellen");
            var p = document.createElement("div");
            p.innerHTML = "Bitte für die Adresse der Universität nur Buchstaben eingeben!";
            p.style.cssText = "color:red;";
            p.id = "ErrorUL";
            div.appendChild(p);
            document.getElementById("unilocation").style = "border-color: red";
            check = false;
          }
        }

        if (unicountry == "") {
          document.getElementById("unicountry").style = "border-color: red";
          check = false;
        } else {
          let pattern = /[0-9]+/;
          if (pattern.test(unicountry) || unicountry.length < 5) {
            var div = document.getElementById("profErstellen");
            var p = document.createElement("div");
            p.innerHTML = "Bitte für das Land der Universität nur Buchstaben eingeben!";
            p.style.cssText = "color:red;";
            p.id = "ErrorUC";
            div.appendChild(p);
            document.getElementById("unicountry").style = "border-color: red";
            check = false;
          }
        }
        if (unicontact == "") {
          document.getElementById("unicontact").style = "border-color: red";
          check = false;
        } else {
          let pattern = /[0-9]+/;
          if (pattern.test(unicontact) || unicontact.length < 3) {
            var div = document.getElementById("profErstellen");
            var p = document.createElement("div");
            p.innerHTML = "Bitte für den Ansprechspartner der Universität nur Buchstaben eingeben!";
            p.style.cssText = "color:red;";
            p.id = "ErrorUCo";
            div.appendChild(p);
            document.getElementById("unicontact").style = "border-color: red";
            check = false;
          }
        }

        if (unigrade == "") {
          document.getElementById("unigrade").style = "border-color: red";
          check = false;
        } else {
          let pattern = /[a-zA-Z]+/;
          if (pattern.test(unigrade)) {
            var div = document.getElementById("profErstellen");
            var p = document.createElement("div");
            p.innerHTML = "Bitte für die Noten der Universität eingeben!";
            p.style.cssText = "color:red;";
            p.id = "ErrorUG";
            div.appendChild(p);
            document.getElementById("unigrade").style = "border-color: red";
            check = false;
          }
        }

        if (description == "") {
          document.getElementById("kurzBeschreibung").style = "border-color: red";
          check = false;
        } else {
          if ((description.length) < 6) {
            var div = document.getElementById("profErstellen");
            var p = document.createElement("div");
            p.innerHTML = "Bitte eine gültige Beschreibung für die Universität eingeben!";
            p.style.cssText = "color:red;";
            p.id = "ErrorUD";
            div.appendChild(p);
            document.getElementById("kurzBeschreibung").style = "border-color: red";
            check = false;
          }
        }
        if (unilink == "") {
          document.getElementById("unilink").style = "border-color: red";
          check = false;
        }
        if (unilogo == "") {
          document.getElementById("unilogo").style = "border-color: red";
          check = false;
        }
        if (unifotos == "") {
          document.getElementById("unifotos").style = "border-color: red";
          check = false;
        }
        if (!check) {
          event.preventDefault();
        }
      }

      /**
       * Change the color of the text and subject line blick to grey.
       */
      function change_border_color() {
        document.getElementById("uniname").style = "border-color: grey";
        document.getElementById("unilocation").style = "border-color: grey";
        document.getElementById("unicountry").style = "border-color: grey";
        document.getElementById("unicontact").style = "border-color: grey";
        document.getElementById("unigrade").style = "border-color: grey";
        document.getElementById("unilink").style = "border-color: grey";
        document.getElementById("unilogo").style = "border-color: grey";
        document.getElementById("unifotos").style = "border-color: grey";
        document.getElementById("kurzBeschreibung").style = "border-color: grey";
      }

      function remove_error_msg() {
        if (document.getElementById("ErrorUN")) {
          document.getElementById("ErrorUN").remove();
        }
        if (document.getElementById("ErrorUL")) {
          document.getElementById("ErrorUL").remove();
        }
        if (document.getElementById("ErrorUC")) {
          document.getElementById("ErrorUC").remove();
        }
        if (document.getElementById("ErrorUCo")) {
          document.getElementById("ErrorUCo").remove();
        }
        if (document.getElementById("ErrorUG")) {
          document.getElementById("ErrorUG").remove();
        }
        if (document.getElementById("ErrorUL")) {
          document.getElementById("ErrorUL").remove();
        }
        if (document.getElementById("ErrorUD")) {
          document.getElementById("ErrorUD").remove();
        }
      }
    </script>



</body>
<?php
include "../../webElements/footerSB.php";
?>

</html>