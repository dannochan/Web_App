<?php 
session_start();

include("config.php");

if(isset($_GET['login'])) {
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    
    $statement = $pdo->prepare("SELECT * FROM UniMember WHERE Email = :Email");
    $result = $statement->execute(array('Email' => $Email));
    $user = $statement->fetch();

    //Überprüfung des Passwords
    if ($user !== false && password_verify($Password, $user['Password'])) {
        echo '<script>window.location.href = "dashboard.php";</script>';
        } else {
        echo "<script>
        setTimeout(function() {
            swal.fire({
                title: 'Ungültige Eingabe!',
                text: 'E-Mail-Adresse oder Passwort fehlerhaft.',
                icon: 'error',
                showCloseButton: true,
                timer: 3000,
                timerProgressBar: true
            }, );
        }, 300);
    </script>";
    }

  //Session-Variablen speichern
  $_SESSION['userid'] = $user['PersonID'];
  $_SESSION['firstname'] = $user['FirstName'];
  $_SESSION['lastname'] = $user['LastName'];
  $_SESSION['email'] = $user['Email'];

}
?>

<?php 

$userid = $_SESSION['userid'];

//Abfrage des Nutzers
$statement = $pdo->prepare("SELECT * FROM Student WHERE PersonID = :userid");
$result = $statement->execute(array('userid' => $userid));
$user = $statement->fetch();


//Restliche Session-Variablen speichern
$_SESSION['matriculation'] = $user['MatriculationNumber'];
$_SESSION['course'] = $user['StudyCourse'];
$_SESSION['birthdate'] = $user['BirthDate'];
$_SESSION['residence'] = $user['Residence'];
$_SESSION['phone'] = $user['PhoneNumber'];
$_SESSION['street'] = $user['Street'];
$_SESSION['postcode'] = $user['PostalCode'];
$_SESSION['sem'] = $user['Semester'];

?>

<?php include("webElements/headerlogin.php"); ?>

<body class="signin text-center">

<main class="form-signin">
  <form action="?login=1" method="post">
    <h1 class="h3 mb-3 fw-normal">Anmeldedaten eingeben</h1>

    <div class="form-floating">
      <input type="Email" class="form-control" id="floatingInput" placeholder="vorname.nachname@stud.uni-bamberg.de" name="Email">
      <label for="floatingInput">Studentische E-Mail-Adresse</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Passwort" name="Password">
      <label for="floatingPassword">Passwort</label>
    </div>

    <div class="mb-3">
    <small><a href="registration.php"><i class="bi bi-people-fill"></i> Registrieren</a> | <i class="bi bi-unlock-fill"></i> <a href="forgotpw.php">Passwort vergessen?</a></small>

    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Anmelden</button>
    <p class="mt-5 mb-3 text-muted"><a href="https://web06.iis.uni-bamberg.de/WIP/wip2122_g3/"><i class="bi bi-house-fill"></i> Startseite</a></p>
  </form>
</main>

    
</body>


