<?php

session_start();
require '../../config/DBConnection.php';
include '../../config/Error.php'; ?>
<?php
if (isset($_POST['newProfBtn'])) {

  try {
    $db = db_connection();
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


    isUniExist($name);

    if (!empty($_FILES['uniLogo'])) {

      validateImage($_FILES['uniLogo']);
      $file_extension = pathinfo($_FILES['uniLogo'], PATHINFO_EXTENSION);
      $fileActualExt = strtolower(end($file_extension));
      $allowedExts = array("gif", "jpeg", "jpg", "png");

      if (in_array($fileActualExt, $allowedExts)) {

        $newName = str_replace(" ", "", $name) . "Logo" . $fileActualExt;
        $targetFolderForLogo = "../../uploads/logos/";
        $targetLogo = $targetFolderForLogo . $newName;
        $uniLogo = "uploads/logos/" . $newName;
        $test = move_uploaded_file($_FILES['uniLogo']['tmp_name'], $targetLogo);
      }
    } else {
      $uniLogo = NULL;
    }

    $sql_uniProf = "INSERT INTO University (Name, Country, Location, Degree, Semester,
     GPA, Description, Link, Contact, Logo) VALUE (?, ?, ?, ?, ?, ?, ?,?,?,?)";
    $stmt = $db->prepare($sql_uniProf);
    $stmt->execute(array(
      $name, $land, $location, $abschluss, $semester,
      $uniNoten, $description, $link, $contact, $uniLogo
    ));

    $stmtLastInsertedID = $db->lastInsertId($sql_uniProf);

    // hier werde die Fotos für die Uni hochgeladen. (fehlt Validierung)

    if (!empty($images)) {
      $countfiles = count($images['name']);
      for ($i = 0; $i < $countfiles; $i++) {
        $targetFolderForImg = "../../uploads/images/";
        $targetImg = $targetFolderForImg . basename($images['name'][$i]);
        $uniImgs = "uploads/images/" . $images['name'][$i];
        move_uploaded_file($images['tmp_name'][$i], $targetImg);
        $sql_image = "INSERT INTO Image(UniID, Picture) VALUE (?, ?)";
        $stmtForImg = db_connection()->prepare($sql_image);
        $stmtForImg->execute(array($stmtLastInsertedID, $uniImgs));
      };
    }

    header("Location: uniProf.php");
    exit;
  } catch (InvalidArgumentException $exc) {
    $_SESSION['errorArray'] = $exc->getMessage();
    header("Location: uniProf.php");
  } catch (Exception $e) {
    $_SESSION['errorArray'] = $e->getMessage();
    header("Location: uniProf.php");
  }
}

?>

<?php

function isUniExist($name)
{
  $db = db_connection();
  $sql = "SELECT * FROM University WHERE NAME = ?";
  $stmt = $db->prepare($sql);
  $stmt->execute(array($name));
  $row = $stmt->fetch();
  if ($row > 0) {

    throw new Exception("Das Profil existiert breits in Datenbank. " . $name);
  }
}

?>