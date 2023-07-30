<?php 

require "config/DBConnection.php";
require "config/Error.php";

if(array_key_exists('Email', $_POST)) {
    validate_input($_POST['Email'], $_POST['Password']);
}
    
?>

<?php include("webElements/headerlogin.php"); ?>

<body class="signin text-center">

<main class="form-signin">
  <form action="" method="post">
    <h1 class="h3 mb-3 fw-normal">Anmeldedaten eingeben</h1>

    <div class="form-floating">
      <input type="Email" class="form-control" id="floatingInput" placeholder="E-Mail Adresse" name="Email">
      <label for="floatingInput">E-Mail-Adresse</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Passwort" name="Password">
      <label for="floatingPassword">Passwort</label>
    </div>
    <br>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Anmelden</button>
    <p class="mt-5 mb-3 text-muted"><a href="https://web06.iis.uni-bamberg.de/WIP/wip2122_g3/"><i class="bi bi-house-fill"></i> Startseite</a></p>
  </form>
</main>
</body>

<?php 

/**
 * This function validates the user input from the login of the workers and administrators.
 * 
 * @param string $email:      The email of the user which he entered for login.
 * @param string $password:   The password of the user which he entered for login.
 */
function validate_input($email, $password){
  $db = db_connection();
  $statement = $db->prepare("SELECT Password, PersonID, FirstName, LastName FROM UniMember WHERE UniMember.Email = ?");
  $statement->execute(array($email));

  if ($statement->rowCount() === 0){
    print_error_popup("Ungültige Eingabewerte", "Die eingegebenen Werte sind nicht richtig!");
  }else{
    $user = $statement->fetch();
    if (password_verify($password, $user['Password']) && is_worker($user['PersonID'])){
      session_start();
      $_SESSION['PersonID'] = $user['PersonID'];
      $_SESSION['firstname'] = $user['FirstName'];
      $_SESSION['lastname'] = $user['LastName'];
      $_SESSION['User'] = 'Worker';
      if (is_admin($user['PersonID'])){
        echo '<script>window.location.href = "SysAdmin/interface/";</script>';
      }else{
        echo '<script>window.location.href = "Sacharbeiter/Bewerbungsliste/";</script>';
      }
    }else{
      print_error_popup("Ungültige Eingabewerte", "Die eingegebenen Werte sind nicht richtig!");
    }
  }
}

/**
 * This function proofs if the user is a worker or a student.
 * 
 * @param string $id:   The id of the user.
 * @return bool:        True - If the user is a worker. False - If the user is a student.
 */
function is_worker($id){
  $db = db_connection();
  $statement = $db->prepare("SELECT Student.MatriculationNumber FROM UniMember 
                              JOIN Student ON Student.PersonID = UniMember.PersonID WHERE UniMember.PersonID = ? ");
  $statement->execute(array($id));
  if ($statement->rowCount() === 0){
    return True;
  }
  return False;
}

/**
 * This function proofs if the worker is the admin.
 * 
 * @param string $id:   The id of the user.
 * @return bool:        True - If the worker is the admin. False - If the user is is not the admin.
 */
function is_admin($id){
  $db = db_connection();
  $statement = $db->prepare("SELECT * FROM SysAdmin 
                              JOIN UniMember ON SysAdmin.PersonID = UniMember.PersonID WHERE UniMember.PersonID = ? ");
  $statement->execute(array($id));
  if ($statement->rowCount() === 0){
    return False;
  }
  return True;
}
?>


