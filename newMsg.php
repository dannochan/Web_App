<?php 
session_start();
require 'config/DBConnection.php';
include 'config/Error.php'; 
?>

<?php
if (!isset($_SESSION['userid'])) {
  echo '<script>alert("Bitte loggen Sie sich ein!")</script>';
} else {
  $id = $_SESSION['userid'];
  $subject = '';
  $recipient = '';
  $message = '';
  try {

    if (
      isset($_POST['newMsgBtn']) && !empty($_POST['subject']) && !empty($_POST['recipient']) && !empty($_POST['message'])
    ) {
      $subject = $_POST['subject'];
      $recipient =$_POST['recipient'];
      $message = $_POST['message'];
      if (validateInput($subject) && validateInput($message)){
        $sql = "INSERT INTO Message(Subject, Text, Sender, Receiver, isNew, isDelete) Values (?,?,?,?,1,0)";
        $con = db_connection();
        $stmt = $con->prepare($sql);
        $stmt->execute(array($subject, $message, $id, $recipient));
        $_SESSION['msg_success'] = "Nachricht wurde gesendet!";
        header("Location: neueMsg.php");
      }else{
        $_SESSION['msg_fail'] = "Nachricht wurde nicht gesendet!";
        header("Location: neueMsg.php");
      }
    }
  } catch (InvalidArgumentException $ex) {
    print_result($ex->getMessage(), false);
  }
}


/*function getRepName($recipientName)
{
  $dbCon = db_connection();
  $nameInput = $recipientName;
  $nameArray = explode(' ', $nameInput);
  $firstname = $nameArray[0];
  $lastname = $nameArray[1];
  echo '<script>alert('.$firstname.')</script>';
  echo '<script>alert('.$lastname.')</script>';
  $sql = "SELECT * FROM UniMember WHERE firstName = ? AND lastName = ? LIMIT 1";
  $stmt = $dbCon->prepare($sql);
  $stmt->execute(array($firstname, $lastname));
  $row = $stmt->fetch();
  if (empty($row)) {
    return 0;
  } else {
    return $row['PersonID'];
  }
}*/

?>



<!--

<script src='//cdn.tinymce.com/4/tinymce.min.js'> </script>
<script>
  tinymce.init({
    selector: '#message'
  });
</script>
-->