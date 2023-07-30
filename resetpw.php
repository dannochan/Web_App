<?php

include("config.php");

if(!isset($_GET['userid']) || !isset($_GET['code'])) {
    echo "<script>
    setTimeout(function() {
        swal.fire({
            title: 'Kein Code übermittelt!',
            text: 'Beim Aufruf dieser Website wurde kein Code zum Zurücksetzen ermittelt.',
            icon: 'error',
            showCloseButton: true,
            timer: 5000,
            timerProgressBar: true
        }, );
    }, 300);
   </script>";
}
 
$userid = $_GET['userid'];
$code = $_GET['code'];
 
//Abfrage des Nutzers
$statement = $pdo->prepare("SELECT * FROM UniMember WHERE PersonID = :userid");
$result = $statement->execute(array('userid' => $userid));
$user = $statement->fetch();
 
//Überprüfe dass ein Nutzer gefunden wurde und dieser auch ein Passwortcode hat
if($user === null || $user['PasswordCode'] === null) {
    echo "<script>
    setTimeout(function() {
        swal.fire({
            title: 'Kein Code vorhanden!',
            text: 'Du hast noch keinen Code angefordert.',
            icon: 'error',
            showCloseButton: true,
            timer: 5000,
            timerProgressBar: true
        }, );
    }, 300);
   </script>";
}
 
if($user['PasswordCode_Time'] === null || strtotime($user['PasswordCode_Time']) < (time()-24*3600) ) {
    echo "<script>
    setTimeout(function() {
        swal.fire({
            title: 'Code abgelaufen!',
            text: 'Der Link in der E-Mail ist abgelaufen. Bitte fordere nochmal ein neues Passwort an.',
            icon: 'error',
            showCloseButton: true,
            timer: 5000,
            timerProgressBar: true
        }, );
    }, 300);
   </script>";
}


//Der Code war korrekt, der Nutzer darf ein neues Passwort eingeben
 
if(isset($_GET['send'])) {
    $Password = $_POST['Password'];
    $Password2 = $_POST['Password2'];
 
 if($Password != $Password2) {
 echo "<script>
 setTimeout(function() {
     swal.fire({
         title: 'Ungültige Eingabe!',
         text: 'Die beiden Passwörter müssen übereinstimmen.',
         icon: 'error',
         showCloseButton: true,
         timer: 3000,
         timerProgressBar: true
     }, );
 }, 300);
</script>";
 } else { //Speichere neues Passwort und lösche den Code
    $Password_Hash = password_Hash($Password, PASSWORD_DEFAULT);
    $statement = $pdo->prepare("UPDATE UniMember SET Password = :Password_Hash, PasswordCode = NULL, PasswordCode_Time = NULL WHERE PersonID = :userid");
    $result = $statement->execute(array('Password_Hash' => $Password_Hash, 'userid'=> $userid));
 
 if($result) {
echo "<script>
setTimeout(function() {
    swal.fire({
        title: 'Passwort gespeichert!',
        text: 'Dein neues Passwort wurde erfolgreich gespeichert.',
        icon: 'success',
        showCloseButton: true,
        timer: 3000,
        timerProgressBar: true
    }, );
}, 300);
</script>"; }
 }
}
?>
 <?php include("webElements/header.php"); ?>
 <main class="border-bottom">
 <div class="mx-auto p-3">
		<div class="p-4 align-items-center">
<h1 class="display-4 fw-bold lh-1">Passwort vergeben</h1>
Gib hier dein gewünschtes Passwort ein.
<form class="mw425 needs-validation" novalidate="" action="?send=1&amp;userid=<?php echo htmlentities($userid); ?>&amp;code=<?php echo htmlentities($code); ?>" method="post">

      <input required="" type="password" class="form-control" placeholder="Passwort" name="Password">

    <input required="" type="password" class="form-control col" placeholder="Passwort wdh." name="Password2">
 
<div class="forgot"><button class="btn btn-lg btn-primary btn-sm" value="Passwort speichern" type="submit">Absenden</button>     <small><i class="bi bi-unlock-fill"></i> <a href="forgotpw.php">Erneut anfordern</a> | <i class="bi bi-door-open-fill"></i> <a href="login.php">Zum Login</a></small></div>
</form>
</div>
</div>
</main>
<?php include("webElements/footer.php"); ?>
