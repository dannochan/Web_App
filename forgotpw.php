<?php 

include("config.php");
 
function random_string() {
 if(function_exists('random_bytes')) {
 $bytes = random_bytes(16);
 $str = bin2hex($bytes); 
 } else if(function_exists('openssl_random_pseudo_bytes')) {
 $bytes = openssl_random_pseudo_bytes(16);
 $str = bin2hex($bytes); 
 } else if(function_exists('mcrypt_create_iv')) {
 $bytes = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);
 $str = bin2hex($bytes); 
 } else {
 $str = md5(uniqid('cejSR8CZ!GCB?d4hIIxC', true));
 } 
 return $str;
}
 
 
$showForm = true;
 
if(isset($_GET['send']) ) {
 if(!isset($_POST['Email']) || empty($_POST['Email'])) {
 $error = "<script>
 setTimeout(function() {
     swal.fire({
         title: 'Fehlende Eingabe!',
         text: 'Bitte deine E-Mail-Adresse eingeben.',
         icon: 'error',
         showCloseButton: true,
         timer: 3000,
         timerProgressBar: true
     }, );
 }, 300);
</script>";
 } else {
 $statement = $pdo->prepare("SELECT * FROM UniMember WHERE Email = :Email");
 $result = $statement->execute(array('Email' => $_POST['Email']));
 $user = $statement->fetch(); 
 
 if($user === false) {
 $error = "<script>
 setTimeout(function() {
     swal.fire({
         title: 'Nicht vorhanden!',
         text: 'Die E-Mail-Adresse konnte nicht gefunden werden.',
         icon: 'error',
         showCloseButton: true,
         timer: 3000,
         timerProgressBar: true
     }, );
 }, 300);
</script>";
 } else {
 //Überprüfe, ob der User schon einen Passwortcode hat oder ob dieser abgelaufen ist 
 $PasswordCode = random_string();
 $statement = $pdo->prepare("UPDATE UniMember SET PasswordCode = :PasswordCode, PasswordCode_Time = NOW() WHERE PersonID = :userid");
 $result = $statement->execute(array('PasswordCode' => sha1($PasswordCode), 'userid' => $user['PersonID']));
 
 $recipient = $user['Email'];
 $reference = "Neues Passwort für deinen Account vom Auslandsportal der Uni Bamberg";
 $reference = "=?utf-8?b?".base64_encode($reference)."?=";
 $from = "From: forgotpassword@auslandsportal.uni-bamberg.de";
 $url_passwordcode = 'https://web06.iis.uni-bamberg.de/WIP/wip2122_g3/resetpw.php?userid='.$user['PersonID'].'&code='.$PasswordCode;
 $text = 'Hallo '.$user['FirstName'].',
 
für deinen Account vom Auslandsportal der Uni Bamberg wurde nach einem neuen Passwort gefragt. Um ein neues Passwort zu vergeben, rufe innerhalb der nächsten 24 Stunden die folgende Website auf:
'.$url_passwordcode.'
 
Sollte dir dein Passwort wieder eingefallen sein oder du hast dies nicht angefordert, ignoriere bitte diese E-Mail.
 
Viele Grüße,
dein Team vom Auslandsportal der Uni Bamberg';
 
 mail($recipient, $reference, $text, $from);
 
 echo '<script>
 setTimeout(function() {
     swal.fire({
         title: "Passwort zurückgesetzt!",
         text: "An die von dir angegebene E-Mail-Adresse (ggf. Spam-Ordner) wurde soeben ein Link für die erneute Passwortvergabe verschickt.",
         icon: "success",
         showCloseButton: true,
         timer: 5000,
         timerProgressBar: true
     }, );
 }, 300);
</script>'; 
 $showForm = true;
 }
 }
}
 
if($showForm):
?>
 <?php include("webElements/header.php"); ?>
 <main class="border-bottom">
 <div class="mx-auto p-3">
		<div class="p-4 align-items-center">
<h1 class="display-4 fw-bold lh-1 ">Passwort vergessen</h1>
Gib hier deine E-Mail-Adresse ein, um ein neues Passwort anzufordern.
 
<?php
if(isset($error) && !empty($error)) {
 echo $error;
}
?>
 
<form class="mw425 needs-validation" novalidate="" action="?send=1" method="post">
<input required="" type="Email" class="form-control col" placeholder="Studentische E-Mail-Adresse" name="Email" value="<?php echo isset($_POST['Email']) ? htmlentities($_POST['Email']) : ''; ?>">

<div class="forgot"><button class="btn btn-lg btn-primary btn-sm" value="Neues Passwort" type="submit">Absenden</button>     <small><i class="bi bi-people-fill"></i> <a href="registration.php">Registrieren</a> | <i class="bi bi-door-open-fill"></i> <a href="login.php">Zum Login</a></small></div>

</form>
</div>
</div>
</main>
<?php
endif; //Endif von if($showForm)
?>

<?php include("webElements/footer.php"); ?>
