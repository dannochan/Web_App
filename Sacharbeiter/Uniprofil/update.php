<?php

require '../../config/DBConnection.php';
?>
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
  include "../../webElements/navSB.php";
  ?>
    <div class="row">

      <div class="col left"><?php include  "../../webElements/sidebarSB.php"; ?></div>

      <div class=" col right ">
        <div class="col">
          <div class="row">
            <div class="col md-auto">
              <h2>Partneruniversitäten</h2>
            </div>
          </div>

          <?php
          if (isset($_GET['uniID'])) {
            $prepareToEdit = $_GET['uniID'];

            $stmt = db_connection()->prepare("SELECT * FROM University WHERE UniID = ? LIMIT 1");
            $stmt->execute(array($prepareToEdit));
            $row = $stmt->fetch();
          }
          ?>
          <div class="col overflow-scroll" style="height: 540px;">
            <form method="POST" id="updateProf" name="updateProf" action="update_Prof.php" enctype="multipart/form-data">
              <div class="row input-group mb-3">
                <input type="hidden" name="updateUniID" id="UniID" value="<?php echo $row['UniID']; ?>"></input>
                <label for="uniName" class="col-form-label col-sm-3">Name</label>
                <div class="col-sm-9">
                  <input class="form-control " id="uniName" type="text" name="uniName" value="<?php echo $row['Name']; ?>">
                </div>
              </div>
              <div class="row input-group mb-3">
                <label for="uniOrt" class="col-form-label col-sm-3">Ort</label>
                <div class="col-sm-9"><input type="text" class="form-control" id="uniOrt" name="uniLocation" value="<?php echo $row['Location']; ?>"> </div>
              </div>
              <div class="row input-group mb-3"><label for="uniLand" class="col-form-label col-sm-3">Land</label>
                <div class="col-sm-9"> <input type="text" class="form-control" id="uniLand" name="uniLand" value="<?php echo $row['Country']; ?>"> </div>
              </div>
              <div class="row input-group mb-3"><label for="UniAnsprechpartner" class="col-form-label col-sm-3">Ansprechpartner</label>
                <div class="col-sm-9"> <input type="text" class="form-control" id="uniContact" name="uniAnsPart" value="<?php echo $row['Contact']; ?>"> </div>
              </div>
              <div class=" row input-group mb-3"><label for="uniNotendurchschnitt" class="col-form-label col-sm-3">Notendurchschnitt</label>
                <div class="col-sm-9"> <input type="text" class="form-control" id="uniNoten" name="notenSchnitt" value="<?php echo $row['GPA']; ?>"> </div>

              </div>

              <div class="row input-group mb-3 ">
                <label for="uniSemester" class="col-form-label col-sm-3">Semester</label>
                <div class="col-sm-9">
                  <select name="uniSemester" id="uni_Semester" class="form-control" aria-label="Default select example"">
                <option class=" disabled">Bitte Semester auswählen</option>
                    <option value=" Sommersemester" <?php if ($row['Semester'] == "Sommersemester") {
                                                      echo 'selected="selected"';
                                                    }; ?>>Sommersemeseter</option>
                    <option value="Wintersemester" <?php if ($row['Semester'] == "Wintersemester") {
                                                      echo 'selected="selected"';
                                                    }; ?>>Wintersemester</option>
                    <option value="beides" <?php if ($row['Semester'] == "beides") {
                                              echo 'selected="selected"';
                                            }; ?>>Beides</option>
                  </select>
                </div>
              </div>

              <div class="row input-group mb-3 ">
                <label for="uniAbschluss" class="col-form-label col-sm-3">Abschluss</label>
                <div class="col-sm-9">
                  <select name="uniAbschluss" id="uniDegree" class="form-control" aria-label="Default select example">
                    <option class=" disabled">Bitte Abschluss auswählen</option>
                    <option value=" Bachelor" <?php if ($row['Degree'] == "Bachelor") {
                                                echo 'selected="selected"';
                                              }; ?>>Bachelor</option>
                    <option value="Master" <?php if ($row['Degree'] == "Master") {
                                              echo 'selected="selected"';
                                            }; ?>>Master</option>
                  </select>
                </div>
              </div>
              <div class="row input-group mb-3"><label for="uniLink" class="col-form-label col-sm-3">Link</label>
                <div class="col-sm-9"> <input type="text" class="form-control" id="uniLink" name="uniLink" value="<?php echo $row['Link']; ?>"> </div>

              </div>
              <div class="row input-group mb-3 ">
                <label for="uniLogo" class="col-form-label col-sm-3">Logo</label>
                <div class="col-sm-9"> <input type="file" class="form-control" id="uniLogo" name="uniLogo[]" value="<?php echo $row['Logo']; ?>"> </div>

              </div>
              <div class="row input-group mb-3"><label for="uniFotos" class="col-form-label col-sm-3">Fotos</label>
                <div class="col-sm-9"> <input type="file" class="form-control" id="uniFotos" name="uniFoto[]" multiple> </div>

              </div>
              <div class="row input-group mb-3"><label for="uniKurzbeschreibung" class="col-form-label col-sm-3">Kurzbeschreibung</label>
                <div class="col-sm-9 "> <textarea class="form-control mx-0 " id="kurzBeschreibung" name="uniDescription" rows="5"><?php echo $row['Description']; ?> </textarea>

                </div>
                <a href="uniProf.php" class="btn btn-secondary mt-1 w-100">Zurück</a>
                <button type="submit" form="updateProf" class="btn btn-primary" name="updateBtn" id="updateBtn">Aktualisieren</button>
            </form>
          </div>
          <!-- Die Tabelle von den Partneruniversitäten-->


        </div>
      </div>


    </div>



</body>
<?php
include "../../webElements/footerSB.php";
?>

</html>