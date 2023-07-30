<?php 
	require "../../config/DBConnection.php";
?>

<div class="mx-auto p-4 align-items-center wrapper bg-light">
	<div class="row">
		<div class="col left">
			<?php 
				include "../../webElements/sidebarSB.php"; 
			?>
		</div>	
		<div class="col right">
			<div class="row">
				<!--Link to the startpage under the navbar-->
				<nav aria-label="breadcrumb" class="d-none d-lg-block">
					<p class="breadcrumb">»<a href="https://web06.iis.uni-bamberg.de/WIP/wip2122_g3/" >Startseite</a></p>
				</nav>

                <?php 
                    // In this section is checked whether an interaction with this page has been made. If it is the case, there will be an alert.
				    try{
				    	proof_activity();
				    }catch(ErrorException $exception){
				    	print_result("Es gab einen unerwarteten Fehler: ".$exception->getMessage(), False);
				    }
                ?>

                <h2>Registrierte Sacharbeiter</h2>
                <div class="row px-3 table-wraper">
					<table class="table table-hover border border-secondary mt-2 my-table">
  						<thead>
							<tr class="table-secondary">
							  <th scope="col"><b>ID</b></th>
							  <th scope="col"><b>Name</b></th>
							  <th scope="col"><b>Email</b></th>
							  <th scope="col"><b>Telefonnummer</b></th>
							  <th scope="col"><b>Büro</b></th>
                              <th scope="col"><b>Löschen</b></th>
							</tr>
						</thead>
                            <?php
				            	try{
				            		// Get all workers from the database. 
				            		get_worker_list();
				            	}catch (PDOException $exception){
				            		print_result("An Error occurred: ".$exception->getMessage().". Please try it later again.", False);
				            	}catch (ErrorException $exception){
				            		print_result($exception->getMessage(), False);
				            	}
				            ?>
                    </table>
                </div>
                
                <div>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add_worker">Sacharbeiter hinzufügen</button>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#change_password">Passwort ändern</button>
                </div>

                <!--A pop-up window which gives the user the opportunity to add a new worker to the database-->
				<div class="modal fade" id="add_worker" tabindex="-1" data-bs-backdrop="static" aria-labelledby="add_worker" aria-hidden="true">
					<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        				<div class="modal-content">	
							<div class="modal-header">
            					<h5 class="modal-title"><b>Sacharbeiter hinzufügen</b></h5>
            					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="change_border_color();"></button>
         					</div>
          					<div class="modal-body text-center" id="add_header">
								<form method="POST" onsubmit="validate_info(event);">
                                    <label>Vorname</label>
                                    <input type="text" class="form-control" name="Firstname" id="Firstname" placeholder="Vorname">
                                    <label>Nachname</label>
                                    <input type="text" class="form-control" name="Lastname" id="Lastname" placeholder="Nachname">
                                    <label>E-Mail Adresse</label>
                                    <input type="email" class="form-control" name="Email" id="Email" placeholder="E-Mail-Adresse">
                                    <label>Telefonnummer</label>
                                    <input type="text" class="form-control" name="Telnumber" id="Telnumber" placeholder="Telefonnummer">
                                    <label>Büro</label>
                                    <input type="text" class="form-control" name="Office" id="Office" placeholder="Büro">
                                    <label>Passwort</label>
                                    <input type="password" class="form-control" name="Password" id="Password">
								<br>
								<button type="submit" class="btn btn-primary btn-sm" name="add">Hinzufügen</button>
								</form>
							</div>
						</div>
					</div>
				</div>


                <!--A pop-up window which gives the user the opportunity to change the password of a worker-->
				<div class="modal fade" id="change_password" tabindex="-1" data-bs-backdrop="static" aria-labelledby="change_password" aria-hidden="true">
					<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        				<div class="modal-content">	
							<div class="modal-header">
            					<h5 class="modal-title"><b>Passwort ändern</b></h5>
            					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="change_border_color();"></button>
         					</div>
          					<div class="modal-body text-center" id="add_header">
								<form method="POST">
                                    <select id="inputState" name="Worker_id" class="form-control">
        						        <?php
                                            try{
                                                get_all_worker_ids();
                                            }catch(PDOException $exception){
                                                print_error_popup("Datenbankfehler", "An Error occurred: ".$exception->getMessage());
                                            }
                                        ?>
                                </select>
                                    <label>Neues Passwort</label>
                                    <input type="password" class="form-control" name="new_password" require="">
								<br>
								<button type="submit" class="btn btn-primary btn-sm" name="change">Ändern</button>
								</form>
							</div>
						</div>
					</div>
				</div>

            </div>
        </div>
    </div>
</div>

<script>
	/**
	 * This function validates: 
     * 1. The entered firstname: Is it empty or are there any numbers.
     * 2. The entered lastname: Is it empty or are there any numbers.
     * 3. The entered email: Is it empty.
     * 4. Telefon number: Is it empty or are there any letters.
     * 5. Office: Is it empty.
     * 6. Password: Is it empty.
     * 
     * If something is the case, the border of the specific element will be colored red and a error message will show up.
	 */
	function validate_info(event){
        remove_error_msg();
        change_border_color();
		var firstname = document.querySelector("#Firstname").value;
		var lastname = document.querySelector("#Lastname").value;
        var email = document.querySelector("#Email").value;
        var telnumber = document.querySelector("#Telnumber").value;
        var office = document.querySelector("#Office").value;
        var password = document.querySelector("#Password").value;
        var check = true;
		if (firstname == ""){
			document.getElementById("Firstname").style = "border-color: red";
            check = false;
		}else{
            let pattern = /[0-9]+/;
            if (pattern.test(firstname)){
                var div = document.getElementById("add_header");
                var p = document.createElement("div");
                p.innerHTML = "Bitte für den Vornamen nur Buchstaben eingeben!";
                p.style.cssText = "color:red;";
                p.id = "ErrorFN";
                div.appendChild(p);
    			document.getElementById("Firstname").style = "border-color: red";
                check = false;
            }
        }
        if (lastname == ""){
			document.getElementById("Lastname").style = "border-color: red";
			check = false;
		}else{
            let pattern = /[0-9]+/;
            if (pattern.test(lastname)){
                var div = document.getElementById("add_header");
                var p = document.createElement("div");
                p.innerHTML = "Bitte für den Nachnamen nur Buchstaben eingeben!";
                p.style.cssText = "color:red;";
                p.id = "ErrorLN";
                div.appendChild(p);
                document.getElementById("Lastname").style = "border-color: red";
                check = false;
            }
        }
        if (email == ""){
			document.getElementById("Email").style = "border-color: red";
			check = false;
		}
        if (telnumber == ""){
            document.getElementById("Telnumber").style = "border-color: red";
			check = false;
        }else{
            let pattern = /[a-zA-Z]+/;
            if (pattern.test(telnumber)){
                var div = document.getElementById("add_header");
                var p = document.createElement("div");
                p.innerHTML = "Bitte für die Telefonnummer nur Zahlen (mit +) eingeben!";
                p.style.cssText = "color:red;";
                p.id = "ErrorTN";
                div.appendChild(p);
                document.getElementById("Telnumber").style = "border-color: red";
                check = false;
            }
        }
        if (office == ""){
            document.getElementById("Office").style = "border-color: red";
			check = false;
        }
        if (password == ""){
            document.getElementById("Password").style = "border-color: red";
			check = false;
        }
        if (!check){
            event.preventDefault();
        }
	}

	/**
	 * Change the color of all elements from the "add_worker" div element to grey.
	 */
	function change_border_color(){
		document.getElementById("Firstname").style = "border-color: grey";
		document.getElementById("Lastname").style = "border-color: grey";
        document.getElementById("Email").style = "border-color: grey";
        document.getElementById("Telnumber").style = "border-color: grey";
        document.getElementById("Office").style = "border-color: grey";
        document.getElementById("Password").style = "border-color: grey";
	}

    /**
     * This function removes all error messages from the "add_worker" div element.
     */
    function remove_error_msg(){
        if (document.getElementById("ErrorFN")){
            document.getElementById("ErrorFN").remove();
        }
        if (document.getElementById("ErrorLN")){
            document.getElementById("ErrorLN").remove();
        }
        if (document.getElementById("ErrorTN")){
            document.getElementById("ErrorTN").remove();
        }
    }
</script>

<?php 

/**
* This function checks if the user interacted with this webpage. It proofs if the user wants to add a new worker to the database
* on the basis of the "add"-key in the POST array, if the user want to delete a worker from the database on the basis of the
* "delete"-key in the POST array or if the user wants to change a password of a worker on the basis of the
* "change"-key in the POST array.
* 
* @throw ErrorException: If the a worker could not be added, deleted or the password could not be changed.
*/
function proof_activity(){
    if (array_key_exists("Delete", $_POST)){
        $delete_check = delete_worker($_POST['worker_id']);
        if (!$delete_check){
            exception_handler("Sacharbeiter konnte nicht gelöscht werden", 1, "interface.php", 253, NULL);
        }else{
            print_result("Sacharbeiter erfolgreich gelöscht", True);
        }
    }
    if (array_key_exists("add", $_POST)){
        if (validate_worker_info($_POST['Firstname'], $_POST['Lastname'], $_POST['Email'])){
            exception_handler("Sacharbeiter existiert bereits", 1, "interface.php", 260, NULL);
        }else{
            $add_check = add_worker($_POST['Firstname'], $_POST['Lastname'], $_POST['Email'], $_POST['Telnumber'], $_POST['Office'], $_POST['Password']);
            if (!$add_check){
                exception_handler("Sacharbeiter konnte nicht hinzugefügt werden", 1, "interface.php", 264, NULL);
            }else{
                print_result("Sacharbeiter erfolgreich hinzugefügt", True);
            }
        }
    }
    if (array_key_exists("change", $_POST)){
        $change_check = change_password($_POST['Worker_id'], $_POST['new_password']);
        if (!$change_check){
            exception_handler("Passwort konnte nicht geändert werden!", 1, "interface.php", 273, NULL);
        }else{
            print_result("Passwort erfolgreich geändert", True);
        }
    }
}

/**
 * This function gets all workers from the database and creates a list of all these workers.
 */
function get_worker_list(){
    $db = db_connection();
    $statement = $db->prepare("SELECT UniMember.PersonID, UniMember.FirstName, UniMember.LastName, UniMember.Email, 
                                Worker.worker_TelNumber, Worker.worker_Office
                                FROM UniMember JOIN Worker ON UniMember.PersonID = Worker.PersonID");
    $statement->execute();

    while ($row = $statement->fetch()){
        echo "
		<tbody>
        <tr><th scope='row'>" . $row['PersonID'] . "</th>
        <td>" . $row['FirstName'].' '.$row['LastName'] . "</td>
        <td>" . $row['Email'] . "</td>
		<td>" . $row['worker_TelNumber'] . "</td>
        <td>" . $row['worker_Office'] . "</td>
		<td>
		<form method='POST'>
		<input type='text' name ='worker_id' hidden value='".$row['PersonID']."'/>
		<input type='submit' name='Delete' class='btn btn-danger btn-sm' value='Löschen'/>
		</form>
		</td>
		</tr></tbody>";
        //The button "Öffnen" opens the application with the "offeneBewerbung" Directory and POST the application_ID.
    }
}

/**
 * This function deletes a worker from the database.
 * 
 * @param string $id:   The id of the worker which should be deleted.
 * @return bool:        True - If the worker could be deleted. False - If the worker could not be deleted.
 */
function delete_worker($id){
    $db = db_connection();
    $statement = $db->prepare("DELETE FROM UniMember WHERE UniMember.PersonID = ?");
    $statement->execute(array($id));

    if ($statement === False){
        return False;
    }
    return True;
}

/**
 * This function adds a worker to the database.
 * 
 * @param string $firstname:    The firstname of the worker which should be added.
 * @param string $lastname:     The lasname of the worker which should be addded.
 * @param string $email:        The email of the worker which should be addded.
 * @param string $telnumber:    The telefon number of the worker which should be addded.
 * @param string $office:       The office of the worker which should be addded.
 * @param string $password:     The password of the worker which should be addded.
 * @return bool:                True - If the worker could be added. False - If the worker could not be added.
 */
function add_worker($firstname, $lastname, $email, $telnumber, $office, $password){
    $db = db_connection();
    $password_hash = password_Hash($password, PASSWORD_DEFAULT);
    $sql_string = "INSERT INTO UniMember(Password, FirstName, LastName, Email, PrivacyPoli) VALUES (?, ?, ?, ?, 1)";
    $statement = $db->prepare($sql_string);
    $statement->execute(array($password_hash, $firstname, $lastname, $email));
    $id = $db->lastInsertId($sql_string);

    $statement2 = $db->prepare("INSERT INTO Worker(worker_TelNumber, worker_Office, PersonID) VALUES (?, ?, ?)");
    $statement2->execute(array($telnumber, $office, $id));

    if ($statement === False || $statement2 === False){
        return False;
    }
    return True;
}

/**
 * This function proofs if the worker already exist on the database.
 * 
 * @param string $firstname:    The firstname of the worker which should be proofed.
 * @param string $lastname:     The lasname of the worker which should be proofed.
 * @param string $email:        The email of the worker which should be proofed.
 * @return bool:                True - If the worker already exist. False - If the worker does not exist.
 */
function validate_worker_info($firstname, $lastname, $email){
    $db = db_connection();
    $statement = $db->prepare("SELECT FirstName, LastName, Email FROM Worker JOIN UniMember ON Worker.PersonID = UniMember.PersonID");
    $statement->execute();
    while ($row = $statement->fetch()){
        if ($row['FirstName'] === $firstname && $row['LastName'] === $lastname && $row['Email'] === $email){
            return True;
        }
    }
    return False;
}

/**
 * This function get all ids of the workers which are in the database.
 */
function get_all_worker_ids(){
    $db = db_connection();
    $statement = $db->prepare("SELECT PersonID FROM Worker");
    $statement->execute();

    while($row = $statement->fetch()){
        echo '<option>'.$row['PersonID'].'</option>';
    }
}

/**
 * This function changes the password of a worker.
 * 
 * @param string $id:           The id of the worker which should get a new password.
 * @param string $password:     The new password.
 * @return bool:                True - If the password was successfully changed. False - If the password was not successfully changed
 */
function change_password($id, $password){
    $password_hash = password_Hash($password, PASSWORD_DEFAULT);
    $db = db_connection();
    $statement = $db->prepare("UPDATE UniMember SET Password = ? WHERE PersonID = ?");
    $statement->execute(array($password_hash, $id));

    if ($statement === False){
        return False;
    }
    return True;
}
?>