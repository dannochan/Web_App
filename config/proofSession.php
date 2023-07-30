<?php 
    // Proofs if a session was started
    if (!isset($_SESSION['PersonID'])){
        header("Location: ../../loginSB.php");
    }

    /**
     * This function gets the PersonID from the session array.
     */
    function get_worker_id(){
        if (array_key_exists("PersonID", $_SESSION)){
            return $_SESSION["PersonID"];
        }else{
            throw new ErrorException("Sie sind nicht eingeloggt!");
        }
        
    }

    function get_student_id(){
        if (array_key_exists("MatriculationNumber", $_SESSION)){
            return $_SESSION["MatriculationNumber"];
        }
        // TODO: Which else case. An exception?
    }
?>