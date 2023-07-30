<?php
include_once '../../config/DBConnection.php';

$testId = 2;
$sql = "SELECT * From UniMember WHERE PersonID = ?";
$stmt = db_connection()->prepare($sql);
$stmt->execute(array($testId));
$row = $stmt->fetch();
$_SESSION['PersonID'] = $row['PersonID'];

?>

<?php

if (isset($_GET['MessageID'])) {
  $msgID = $_GET['MessageID'];

  $sql = "UPDATE Message SET isDelete = 1 WHERE MessageID = ?";
  $stmt = db_connection()->prepare($sql);
  $stmt->execute(array($msgID));

  header("Location: postfach.php");
}


?>