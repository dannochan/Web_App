<?php
include_once '../../config/DBConnection.php';

?>

<?php
if (isset($_GET['uniID'])) {
  $prepareTodelete = $_GET['uniID'];

  $sql = "DELETE FROM University WHERE UniID =?";
  $stmt = db_connection()->prepare($sql);
  $stmt->execute(array($prepareTodelete));

  $sql2 = "DELETE FROM Image WHERE UniID = ?";
  $stmt2 = db_connection()->prepare($sql2);
  $stmt2->execute(array($prepareTodelete));
  header("Location: uniProf.php");
}
?>