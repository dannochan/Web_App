<?php
session_start();
require '../../config/DBConnection.php';
include '../../config/Error.php';

?>

<?php
if (!isset($_SESSION['PersonID'])) {
  echo '<script>alert("Bitte loggen Sie sich ein!")</script>';
} else {
  $id = $_SESSION['PersonID'];
  $subject = '';
  $recipient = '';
  $message = '';
  $messageCheck = false;
  try {

    if (
      isset($_POST['newMsgBtn']) && !empty($_POST['subject']) && !empty($_POST['recipient']) && !empty($_POST['message'])
    ) {

      $subject = validateInput($_POST['subject']);
      $recipient = getRepID($_POST['recipient']);
      $message = validateInput($_POST['message']);

      $sql = "INSERT INTO Message(Subject, Text, Sender, Receiver, isNew, isDelete) Value (?,?,?,?,1,0)";
      $stmt = db_connection()->prepare($sql);
      $stmt->execute(array($subject, $message, $id, $recipient));
      $messageCheck = true;
    }
    if ($messageCheck) {
      $_SESSION['msg_success'] = "Nachricht wurde gesendet!";
      header("Location: neueMsg.php");
    } else {
      $_SESSION['msg_fail'] = "Nachricht wurde nicht gesendet!";
      header("Location: neueMsg.php");
    }
  } catch (InvalidArgumentException $ex) {
    print_result($ex->getMessage(), false);
  }
}

function getRepID($recipientName)
{
  $dbCon = db_connection();
  $nameInput = $recipientName;
  $nameArray = explode(' ', $nameInput);
  $firstname = $nameArray[0];
  $lastname = $nameArray[1];

  $sql = "SELECT * FROM UniMember WHERE firstName = ? AND lastName = ? LIMIT 1";
  $stmt = $dbCon->prepare($sql);
  $stmt->execute(array($firstname, $lastname));
  $row = $stmt->fetch();
  if (empty($row)) {
    return 0;
  } else {
    return $row['PersonID'];
  }
}

?>

