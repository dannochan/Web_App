<!DOCTYPE html>
<html lang="de">
<?php 
require "../../config/DBConnection.php";
require "../../config/Error.php";

try{
    get_document();
}catch(ErrorException $exception){
    alert($exception->getMessage());
}

/**
 * This function requests the documents of an application from the database.
 * 
 * @param string            $appli_id  The ID of the application
 * @return PDOStatement     The Answer statement of the database
 * @throws ErrorException   If a connection to the database cannot be established
 */
function request_document($appli_id){
    try{
        $db = db_connection();
        $statement = $db->prepare('SELECT *
                                    FROM Applications JOIN Documents ON Applications.MatriculationNumber = Documents.MatriculationNumber
                                    WHERE Applications.ApplicationID = ?');
        $statement->execute(array($appli_id));
        return $statement;
    }catch(PDOException $exception){
        exception_handler("Database-Error: ".$exception->getMessage(), 1, "File.php", 29, $exception);
    } 
}

/**
 * This function give the user the opportunity (opens a little window) to open or to download the requested file.
 * 
 * @throws ErrorException   If the requested file does not exist in the database.
 */
function get_document(){
    $appli_id = get_appli_id();
    $doc_name = get_doc_name();
    $statement = request_document($appli_id);
    $path = NULL;
    while ($row = $statement->fetch()){
        $path = $row[$doc_name];
    }
    if ($path != NULL){
        $real_path = "../../".$path;
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="File.pdf"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        readfile($real_path);
    }else{
        exception_handler("No document found!", 1, "File.php", 54, NULL);
    }
}

/**
* This function gets the ID of the application which was selected by the user.
* 
* @return string	        The application ID
* @throws ErrorException	If the application ID is missing
*/
function get_appli_id(){
    $appli_id = "";
    if (!empty($_GET)){
        $appli_id = $_GET['appli_id'];
    }else{
        exception_handler("Missing application ID!", 1, "File.php", 69, NULL);
    }
    return $appli_id;
}

/**
 * This function proofs if the $_GET array is empty.
 * 
 * @throws ErrorException   If the $_GET Array is empty.
 */
function get_doc_name(){
    $doc_name = "";
    if (!empty($_GET)){
        $doc_name = $_GET['docName'];
    }else{
        exception_handler("Missing document name!", 1, "File.php", 84, NULL);
    }
    return $doc_name;
}

/**
 * This function creates an alert with Java Script if an Exception was thrown and display this Error. Furthermore it returns to
 * the application side.
 * 
 * @param string $message   The message which should be shown to the user if an Error occurred.
 */
function alert($message){
    print '<script>
                window.alert(\''.$message.'\');
                window.history.back();
            </script>';
}

?>
</html>