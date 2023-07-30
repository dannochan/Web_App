<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header('Location: login.php');
} ?>

<?php require "config/DBConnection.php" ?>
<?php require "config/Error.php" ?>

<?php
if (isset($_POST['rezensionabsenden']) && (isset($_SESSION['userid']))) {
    if (isset($_POST['university']) && isset($_POST['radiodozent']) && isset($_POST['radiolehre']) && isset($_POST['radiointernational']) && isset($_POST['radioausstattung']) && isset($_POST['radiofreizeit']) && isset($_POST['radiocampus']) && isset($_POST['bericht'])) {
        $uni = $_POST['university'];
        $starsdozent = $_POST['radiodozent'];
        $starslehre = $_POST['radiolehre'];
        $starsinternational = $_POST['radiointernational'];
        $starsausstattung = $_POST['radioausstattung'];
        $starsfreizeit = $_POST['radiofreizeit'];
        $starscampus = $_POST['radiocampus'];
        $bericht = $_POST['bericht'];
        $matrikelnummer = (int)$_SESSION['matriculation'];

        //Hier wird die Bewertung abgeschickt
        $sql = "INSERT INTO Reviews( MatriculationNumber, UniID, Report, Lecturer, Teaching, Internationality, Facilities, FreeTime, Campus, CreationDate, Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";        
        $con = db_connection();
        $stmt = $con->prepare($sql);
        $stmt->execute(array($matrikelnummer, $uni, $bericht, $starsdozent, $starslehre, $starsinternational, $starsausstattung, $starsfreizeit, $starscampus, date("Y-m-d"), 'Neu'));

        $stmt = $con->prepare("UPDATE `Student` SET `hasReplied` = '1' WHERE `Student`.`MatriculationNumber` = ?;");
        $stmt->execute(array($matrikelnummer));
?>

        <!--Mitteilung über erfolgreiche Absendung der Eingaben und Weiterleitung zum dashboard-->
        <!DOCTYPE html>
        <html lang="de">

        <head> </head>

        <body>
            <h4>Rezension erfolgreich eingereicht.</h4>
            <button class="btn btn-success" onclick="window.location.href='dashboard.php'">Zurück zum Dashboard</button>
        </body>

        </html>

<?php

    }
}
?>