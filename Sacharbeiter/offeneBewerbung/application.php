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
			<?php 
				// In this section is checked whether an interaction with this page has been made. If it is the case, there will be an alert.
				try{
					proof_activity();
				}catch(ErrorException $exception){
					print_result("Es gab einen unerwarteten Fehler: ".$exception->getMessage(), False);
				}
			?>
			<div class="row">
				<!--Link to the startpage under the navbar-->
				<nav aria-label="breadcrumb" class="d-none d-lg-block">
					<p class="breadcrumb">»<a href="https://web06.iis.uni-bamberg.de/WIP/wip2122_g3/" >Startseite</a></p>
				</nav>

				<!--Standard information of the student-->	
				<h3><b>Studierendendaten</b></h3>
				<div class="border border-dark row px-3 table-wraper overflow-auto" style="height: 500px;">
					<table class="table table-hover border border-secondary mt-2 my-table">
						<tbody>
        	    			<?php 
								try{
									add_student_data(); 
								}catch(ErrorException $exception){
									print_result("An Error occurred: ".$exception->getMessage().". Please try it later again.", False);
								}
							?>
						</tbody>
					</table>
				</div>

				<!--Option for downloading and opening Transscript of Records-->
				<div class="ui-state-default">
					<div style="left: 30px">Transscript of Records</div>
					<form method="GET" action="./File.php">
						<?php 
							try{
								create_input_field();
							}catch (ErrorException $exception){
								print_result("An Error occurred: ".$exception->getMessage().". Please try it later again.", False);
							}
						?>
						<input hidden type="text" name="docName" value="RecordTranscript"/>
						<input type="submit" class="btn btn-primary btn-sm" value="Öffnen"/>
					</form>
				</div>

				<!--Option for downloading and opening Visa-Informationen-->
				<div class="ui-state-default">
					<div style="left: 30px">Visa-Informationen</div>
					<form method="GET" action="./File.php">
						<?php 
							try{
								create_input_field();
							}catch (ErrorException $exception){
								print_result("An Error occurred: ".$exception->getMessage().". Please try it later again.", False);
							}
						?>
						<input hidden type="text" name="docName" value="Visa"/>
						<input type="submit" class="btn btn-primary btn-sm" value="Öffnen"/>
					</form>
				</div>

				<!--Option for downloading and opening Motivationsschreiben-->
				<div class="ui-state-default">
					<div style="left: 30px">Motivationsschreiben</div>
					<form method="GET" action="./File.php">
						<?php 
							try{
								create_input_field();
							}catch (ErrorException $exception){
								print_result("An Error occurred: ".$exception->getMessage().". Please try it later again.", False);
							}
						?>
						<input hidden type="text" name="docName" value="MotivationLetter"/>
						<input type="submit" class="btn btn-primary btn-sm" value="Öffnen"/>
					</form>
				</div>

				<!--Option for downloading and opening Sprachtest-->
				<div class="ui-state-default">
					<div style="left: 30px">Sprachtest</div>
					<form method="GET" action="./File.php">
						<?php 
							try{
								create_input_field();
							}catch (ErrorException $exception){
								print_result("An Error occurred: ".$exception->getMessage().". Please try it later again.", False);
							}
						?>
						<input hidden type="text" name="docName" value="LanguageTest"/>
						<input type="submit" class="btn btn-primary btn-sm" value="Öffnen"/>
					</form>
				</div>

				<!--Option for downloading and opening Pass-Informationen-->
				<div class="ui-state-default">
					<div style="left: 30px">Pass-Informationen</div>
					<form method="GET" action="./File.php">
						<?php 
							try{
								create_input_field();
							}catch (ErrorException $exception){
								print_result("An Error occurred: ".$exception->getMessage().". Please try it later again.", False);
							}
						?>
						<input hidden type="text" name="docName" value="PassportInfo"/>
						<input type="submit" class="btn btn-primary btn-sm" value="Öffnen"/>
					</form>
				</div>

				<!--Option for downloading and opening Passbild-->
				<div class="ui-state-default">
					<div style="left: 30px">Passbild</div>
					<form method="GET" action="./File.php">
						<?php 
							try{
								create_input_field();
							}catch (ErrorException $exception){
								print_result("An Error occurred: ".$exception->getMessage().". Please try it later again.", False);
							}
						?>
						<input hidden type="text" name="docName" value="Passport"/>
						<input type="submit" class="btn btn-primary btn-sm" value="Öffnen"/>
					</form>
				</div>

				<!--Button options-->
				<div class="ui-state-default border-white">
					<button type="button" class="btn btn-primary btn-sm" onclick="location.href='../Bewerbungsliste'">Zurück</button>
					<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#changeStatus">Status setzen</button>
					<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#sendMessage">Nachricht verfassen</button>
				</div>
				<form method="POST">
						<button type="submit" class="btn btn-success btn-sm" name="Button" value="Accept_App">Bewerbung annehmen</button>
						<button type="submit" class="btn btn-danger btn-sm" name="Button" value="Decline_App">Bewerbung ablehnen</button>
				</form>
				
				<!--A pop-up window which gives the user the opportunity to change the status of the application-->
				<div class="modal fade" id="changeStatus" tabindex="-1" data-bs-backdrop="static" aria-labelledby="changeStatus" aria-hidden="true">
					<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        				<div class="modal-content">	
							<div class="modal-header">
            					<h5 class="modal-title"><b>Status ändern</b></h5>
            					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         					</div>
          					<div class="modal-body text-center">
								<form method="POST">
								<select class="form-control" name="SelectStatus">
  									<option value="State_Appli_Accept">Die Bewerbung wird angenommen</option>
									<option value="State_Appli_Decline">Die Bewerbung wird abgelehnt</option>
									<option value="State_Appli_Work">Die Bewerbung ist in Bearbeitung</option>
									<option value="State_Appli_New">Die Bewerbung ist neu</option>
								</select>
								<br>
								<button type="submit" class="btn btn-primary btn-sm">Status ändern</button>
								</form>
							</div>
						</div>
					</div>
				</div>

				<!--A pop-up window which gives the user the opportunity to send a message to the student-->
				<div class="modal fade" id="sendMessage" tabindex="-1" data-bs-backdrop="static" aria-labelledby="sendMessage" aria-hidden="true">
					<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        				<div class="modal-content">	
							<div class="modal-header">
            					<h5 class="modal-title"><b>Nachricht senden</b></h5>
            					<button type="button" class="btn-close" onclick="change_border_color();" data-bs-dismiss="modal" aria-label="Close"></button>
         					</div>
          					<div class="modal-body text-center">
								<form name="Message" method="POST" onsubmit="validate_msg(event);">
								<div class="form-group">
    								<label for="exampleFormControlInput1">Betreff</label>
    								<input type="text" class="form-control" name="subjectLine" id="subjectLine">
  								</div>
								<div class="form-group">
    								<label for="exampleFormControlTextarea1">Nachricht</label>
    								<textarea type="text" class="form-control" name="textArea" rows="3" id="textArea"></textarea>
  								</div>
								<br>
								<button type="submit" class="btn btn-primary btn-sm">Nachricht versenden</button>
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
	 * This function validates the text and the subject line for a message, if they are empty. If it is the case, the border of
	 * the elements will be coloured with red and the POST-event will be cancelled.
	 */
	function validate_msg(event){
		var subjectLine = document.querySelector("#subjectLine").value;
		var textMessage = document.querySelector("#textArea").value;
		if (subjectLine == "" && textMessage == ""){
			document.getElementById("subjectLine").style = "border-color: red";
			document.getElementById("textArea").style = "border-color: red";
			event.preventDefault();
		}else if (subjectLine == ""){
			document.getElementById("subjectLine").style = "border-color: red";
			event.preventDefault();
		}else if (textMessage == ""){
			document.getElementById("textArea").style = "border-color: red";
			event.preventDefault();
		}
	}

	/**
	 * Change the color of the text and subject line blick to grey.
	 */
	function change_border_color(){
		document.getElementById("subjectLine").style = "border-color: grey";
		document.getElementById("textArea").style = "border-color: grey";
	}
</script>

<?php 
	/**
	 * This function checks if the user interacted with this webpage. It proofs if the user wants to change the status of an application
	 * based on the "SelectStatus"-Key from the POST-Array, if the user want to accept or decline the whole application based on on the
	 * "Button"-Key or if the user want to send a message to the student based on the "subjectLine"-Key and the "textArea"-Key
	 * 
	 * @throw ErrorException: If the value of the POST-Array is not correct / does not exist.
	 */
	function proof_activity(){
		// Proof if the status should change
		if (array_key_exists("SelectStatus", $_POST)){
			if ($_POST['SelectStatus'] == "State_Appli_Accept"){
				try{
					change_status("Angenommen");
					print_result("Status wurde erfolgreich geändert.", True);
				}catch(ErrorException $exception){
					print_result("Der Status konnte nicht geändert werden.".$exception->getMessage(), False);
				}
			}elseif($_POST['SelectStatus'] == "State_Appli_Decline"){
				try{
					change_status("Abgelehnt");
					print_result("Status wurde erfolgreich geändert.", True);
				}catch(ErrorException $exception){
					print_result("Der Status konnte nicht geändert werden.".$exception->getMessage(), False);
				}
			}elseif($_POST['SelectStatus'] == "State_Appli_New"){
				try{
					change_status("Neu");
					print_result("Status wurde erfolgreich geändert.", True);
				}catch(ErrorException $exception){
					print_result("Der Status konnte nicht geändert werden.".$exception->getMessage(), False);
				}
			}elseif($_POST['SelectStatus'] == "State_Appli_Work"){
				try{
					change_status("Bearbeitung");
					print_result("Status wurde erfolgreich geändert.", True);
				}catch(ErrorException $exception){
					print_result("Der Status konnte nicht geändert werden.".$exception->getMessage(), False);
				}
			}else{
				exception_handler("The value of the POST-Array is not correct", 1, "application.php", 277, NULL);
			}
		}
		if (array_key_exists("Button", $_POST)){
			// Proof if the application should be accepted or declined
			$uni_name = get_uni_name();
			if ($_POST['Button'] == "Accept_App"){
				try{
					$subject = "Ihre Bewerbung wurde angenommen!";
					$message = "Hallo,\nherzlichen Glückwunsch ihre Bewerbung zur Universität: ".$uni_name." wurde angenommen\n";
					change_status("Angenommen");
					send_message($subject, $message);
					print_result("Bewerbung wurde angenommen.", True);
				}catch(ErrorException $exception){
					print_result("Der Status konnte nicht geändert werden.".$exception->getMessage(), False);
				}
			}elseif ($_POST['Button'] == "Decline_App"){
				try{
					$subject = "Ihre Bewerbung wurde abgelehnt!";
					$message = "Hallo,\nleider muss ich ihnen mitteilen, dass ihre Bewerbung zur Universität: ".$uni_name." abgelehnt wurde\n";
					change_status("Abgelehnt");
					send_message($subject, $message);
					print_result("Bewerbung wurde abgelehnt.", True);
				}catch(ErrorException $exception){
					print_result("Der Status konnte nicht geändert werden.".$exception->getMessage(), False);
				}
			}else{
				exception_handler("The value of the POST-Array is not correct", 1, "application.php", 303, NULL);
			}
		}
		//Proof if the user want to send a message to the student
		if (array_key_exists("subjectLine", $_POST) && array_key_exists("textArea", $_POST)){
			try{
				send_message($_POST['subjectLine'], $_POST['textArea']);
				print_result("Nachricht wurde erfolgreich gesendet!", True);
			}catch (PDOException $exception){
				print_result("Es konnte keine Nachricht versendet werden: ".$exception->getMessage(), False);
			}
		}
	}

	/**
	 * This function requests the application data about the student (not the documents) from the database.
	 * 
	 * @param string $appli_id	The application ID
	 * @throws ErrorException	If a connection to the database cannot be established
	 */
	function get_student_data($appli_id){
		try{
			$db = db_connection();
			$statement = $db->prepare('SELECT UniMember.FirstName AS StudFN, UniMember.LastName AS StudLN, 
										Student.BirthDate, Student.BirthLocation, Student.StudyCourse, Student.SecStudyCourse, 
										Student.Semester, Student.Street AS StudS, Student.PostalCode AS StudP, 
										Student.Residence AS StudL, Student.PhoneNumber AS StudT, HomeAddress.location AS HomeL, 
										HomeAddress.Street AS HomeS, HomeAddress.TelNumber, HomeAddress.MobNumber, 
										InitialRequest.Nationality, InitialRequest.Gender,InitialRequest.SecNationality, 
										InitialRequest.StartSemester, InitialRequest.StartYear, InitialRequest.Duration, 
										InitialRequest.Program, InitialRequest.AccountHolder, InitialRequest.IBAN, 
										EmergContact.FirstName AS EmergFN, EmergContact.LastName AS EmergLN, 
										EmergContact.Email, EmergContact.TelNumber AS EmergTel, EmergContact.Relationship, University.Name
										FROM Applications JOIN Student ON Applications.MatriculationNumber = Student.MatriculationNumber 
										JOIN InitialRequest ON InitialRequest.MatriculationNumber = Student.MatriculationNumber 
										JOIN EmergContact ON EmergContact.RequestID = InitialRequest.RequestID 
										JOIN University ON University.UniID = Applications.UniID
										JOIN HomeAddress ON HomeAddress.RequestID = InitialRequest.RequestID 
										JOIN UniMember ON UniMember.PersonID = Student.PersonID 
										Where Applications.ApplicationID = ?');
			$statement->execute(array($appli_id));
			return $statement;

		}catch(PDOException $exception){
			exception_handler("Database Connection Error: ".$exception->getMessage(), 0, "application.php", 347, $exception);
		}
	}

	/**
	 * This function adds the student data (not the documents) to the table
	 */
	function add_student_data(){
		$appli_id = get_appli_id();
		$statement = get_student_data($appli_id);
		if ($statement->rowCount() === 0){
			exception_handler("Die Daten des Studierenden konnten nicht gefunden werden", 1, "application.php", 358, NULL);
		}
		while($row = $statement->fetch()){
			echo '
			<tr>
			<td><b>Vorname:</b></td>
			<td>'.$row['StudFN'].'</td>
			</tr>
			<tr>
			<td><b>Nachname:</b></td>
			<td>'.$row['StudLN'].'</td>
			</tr>			
			<tr>
			<td><b>Geburtsdatum:</b></td>
			<td>'.$row['BirthDate'].'</td>	
			</tr>
			<tr>
			<td><b>Geburtsort:</b></td>
			<td>'.$row['BirthLocation'].'</td>
			</tr>
			<tr>
			<td><b>Geschlecht:</b></td>
			<td>'.$row['Gender'].'</td>
			</tr>			
			<tr>
			<td><b>Studiengang:</b></td>
			<td>'.$row['StudyCourse'].'</td>
			</tr>
			<tr>
			<td><b>2. Studiengang:</b></td>';
			if ($row['SecStudyCourse'] == NULL){
				echo '
				<td>*</td>';

			}else{
				echo '
				<td>'.$row['SecStudyCourse'].'</td>';
			}
			echo' 
			</tr>
			<tr>
			<td><b>Fachsemester:</b></td>
			<td>'.$row['Semester'].'</td>
			</tr>
			<tr>
			<td><b>Straße (Semesteradresse):</b></td>
			<td>'.$row['StudS'].'</td>
			</tr>
			<tr>
			<td><b>Adresse (Semesteradresse):</b></td>
			<td>'.$row['StudP'].' '.$row['StudL'].'</td>
			</tr>
			<tr>
			<td><b>Telefonnummer:</b></td>
			<td>'.$row['StudT'].'</td>
			</tr>
			<tr>
			<td><b>Mobile Nummer:</b></td>
			<td>'.$row['MobNumber'].'</td>
			</tr>
			<tr>
			<td><b>Wohnort (Heimatadresse):</b></td>
			<td>'.$row['HomeL'].'</td>
			</tr>
			<tr>
			<td><b>Straße (Heimatadresse):</b></td>
			<td>'.$row['HomeS'].'</td>
			</tr>
			<tr>
			<td><b>Telefonnummer (Heimatadresse):</b></td>
			<td>'.$row['TelNumber'].'</td>
			</tr>
			<tr>
			<td><b>Staatsangehörigkeit:</b></td>
			<td>'.$row['Nationality'].'</td>
			</tr>
			<tr>
			<td><b>2. Staatsangehörigkeit:</b></td>';
			if ($row['SecNationality'] == NULL){
				echo '
				<td>*</td>';

			}else{
				echo '
				<td>'.$row['SecNationality'].'</td>';
			}
			echo '
			</tr>
			<tr>
			<td><b>Wunschuniversität:</b></td>
			<td>'.$row['Name'].'</td>
			</tr>
			<tr>
			<td><b>Beginn:</b></td>
			<td>'.$row['StartSemester'].' '.$row['StartYear'].'</td>
			</tr>
			<tr>
			<td><b>Dauer:</b></td>
			<td>'.$row['Duration'].'. Semester</td>
			</tr>
			<tr>
			<td><b>Studienprogramm:</b></td>
			<td>'.$row['Program'].'</td>
			</tr>
			<tr>
			<td><b>Vorname (Notfallkontakt):</b></td>
			<td>'.$row['EmergFN'].'</td>
			</tr>
			<tr>
			<td><b>Nachname (Notfallkontakt):</b></td>
			<td>'.$row['EmergLN'].'</td>
			</tr>
			<tr>
			<td><b>E-Mail Adresse (Notfallkontakt):</b></td>
			<td>'.$row['Email'].'</td>
			</tr>
			<td><b>Telefonnummer (Notfallkontakt):</b></td>
			<td>'.$row['EmergTel'].'</td>
			</tr>
			<tr>
			<td><b>Beziehung (Notfallkontakt):</b></td>
			<td>'.$row['Relationship'].'</td>
			</tr>
			<tr>
			<td><b>Kontoinhaber:</b></td>
			<td>'.$row['AccountHolder'].'</td>
			</tr>
			<tr>
			<td><b>IBAN:</b></td>
			<td>'.$row['IBAN'].'</td>
			</tr>';			
			
		}
	}

	/**
	 * Create a hidden input tag for the form of the documents to save the application ID.
	 */
	function create_input_field(){
		echo'
		<input hidden type="text" name="appli_id" value="'.get_appli_id().'"/>';
	}

	/**
	 * This function changes the status of the application.
	 * 
	 * @param string $value		The new status of the application.
	 * @throws ErrorException	If a connection to the database cannot be established	
	 */
	function change_status($value){
		try{
			$db = db_connection();
			$appli_id = get_appli_id();
			$statement = $db->prepare(' UPDATE Applications SET Status = ?
										Where Applications.ApplicationID = ?');
			$statement->execute(array($value, $appli_id));
		}catch(PDOException $exception){
			exception_handler("Database Connection Error", 1, "application.php", 519, $exception);
		}
	}

	/**
	 * This function sends a message to the student of whom this application originates
	 * 
	 * @param string $subject	Is the subject line of the message.
	 * @param string $text		Is the message which the user want to send.
	 */
	function send_message($subject, $text){
		$db = db_connection();
		$appli_id = get_appli_id();
		$sender_id = get_worker_id();
		$statement = $db->prepare("INSERT INTO `Message`(Subject, Text, Sender, Receiver, isDelete) VALUES (?,?,?,
									(SELECT UniMember.PersonID 
									FROM Applications JOIN Student ON Applications.MatriculationNumber = Student.MatriculationNumber
									JOIN UniMember ON UniMember.PersonID = Student.PersonID
									WHERE Applications.ApplicationID = ?), 0)");
		$statement->execute(array($subject, $text, $sender_id, $appli_id));
	}

	/**
	 * This function gets the ID of the application which was selected by the user.
	 * 
	 * @return string	The application ID
	 * @throws ErrorException	If the application ID is missing
	 */
	function get_appli_id(){
		$appli_id = "";
		if (!empty($_GET)){
			$appli_id = $_GET['appli_id'];
		}else{
			exception_handler("Missing application ID", 1, "application.php", 552, NULL);
		}
		return $appli_id;
	}

	function get_uni_name(){
		$db = db_connection();
		$appli_id = get_appli_id();
		$statement = $db->prepare("SELECT Name FROM Applications JOIN University ON Applications.UniID = University.UniID
									WHERE Applications.ApplicationID = ?");
		$statement->execute(array($appli_id));
		if ($statement->rowCount() != 0){
			$value = $statement->fetch();
			return $value["Name"];
		}else{
			return "Unknown";
		}
	}

?>