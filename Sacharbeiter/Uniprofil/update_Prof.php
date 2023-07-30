<?php

require '../../config/DBConnection.php'; ?>
<?php

if (isset($_POST['updateBtn'])) {

  $id = $_POST['updateUniID'];
  $name = $_POST['uniName'];
  $land = $_POST['uniLand'];
  $location = $_POST['uniLocation'];
  $link = $_POST['uniLink'];
  $description = $_POST['uniDescription'];
  $contact = $_POST['uniAnsPart'];
  $uniNoten = $_POST['notenSchnitt'];
  $abschluss = $_POST['uniAbschluss'];
  $semester = $_POST['uniSemester'];
  $images = $_FILES['uniFoto'];

  $targetFolderForLogo = "../../uploads/logos/";
  $targetLogo = $targetFolderForLogo . basename($_FILES['uniLogo']['name'][0]);
  $uniLogo = $targetFolderForLogo . $_FILES['uniLogo']['name'][0];
  move_uploaded_file($_FILES['uniLogo']['tmp_name'][0], $targetLogo);

  $sql_uniProf = "UPDATE University SET Name=?, Country = ?, Location = ? , Degree =? ,
     Semester = ?, GPA=?, Description=?, Link=?, Contact=?, Logo=? WHERE UniID = ?";
  $stmt = db_connection()->prepare($sql_uniProf);
  $stmt->execute(array(
    $name, $land, $location, $abschluss, $semester,
    $uniNoten, $description, $link, $contact, $uniLogo, $id
  ));

  // hier werde die Fotos für die Uni hochgeladen. (fehlt Validierung)

  if (!empty($images)) {
    $countfiles = count($images['name']);
    for ($i = 0; $i < $countfiles; $i++) {
      $targetFolderForImg = "../../uploads/imgs/";
      $targetImg = $targetFolderForImg . basename($images['name'][$i]);
      $uniImgs = $targetFolderForImg . $images['name'][$i];
      move_uploaded_file($images['tmp_name'][$i], $targetImg);
      $sql_image = "UPDATE Image SET  Picture=? WHERE UniID =?";
      $stmtForImg = db_connection()->prepare($sql_image);
      $stmtForImg->execute(array($uniImgs, $id));
    };
  }
  header("Location: uniProf.php");
  exit;
}

?> 