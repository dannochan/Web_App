<?php require '../../config/DBConnection.php'; ?>

<?php
if (isset($_POST["PersonID"])) {

  $id = $_POST["PersonID"];
  $sql = "SELECT * FROM UniMember WHERE PersonID =?";
  $stmt = db_connection()->prepare($sql);
  $stmt->execute(array($id));
  $row = $stmt->fetch();
  echo json_encode($row);
}
?>