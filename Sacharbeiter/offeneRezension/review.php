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

				<!--Standard information about the review-->	
				<h3><b>Rezensionsdaten</b></h3>
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

				<!--The report-->
				<h3><b>Bericht</b></h3>
				<div class="border border-black">
					<?php 
						try{
							get_report();
						}catch (ErrorException $exception){
							print_result("An Error occurred: ".$exception->getMessage().".", False);
						}
					?>
				</div>
				
				<!--Button options-->
				<div class="ui-state-default border-white">
					<button type="button" class="btn btn-primary btn-sm" onclick="location.href='../Rezensionsliste'">Zurück</button>
					<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#changeStatus">Status setzen</button>
					<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#sendMessage">Nachricht verfassen</button>
				</div>
				<form method="POST">
						<button type="submit" class="btn btn-success btn-sm" name="Button" value="Accept_Review">Rezension annehmen</button>
						<button type="submit" class="btn btn-danger btn-sm" name="Button" value="Decline_Review">Rezension ablehnen</button>
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
  									<option value="State_Review_Accept">Die Rezension wird angenommen</option>
									<option value="State_Review_Decline">Die Rezension wird abgelehnt</option>
									<option value="State_Review_Work">Die Rezension ist in Bearbeitung</option>
									<option value="State_Review_New">Die Rezension ist neu</option>
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
            					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="change_border_color();"></button>
         					</div>
          					<div class="modal-body text-center">
								<form method="POST" onsubmit="validate_msg(event);">
								<div class="form-group">
    								<label for="exampleFormControlInput1">Betreff</label>
    								<input class="form-control" name="subjectLine" id="subjectLine">
  								</div>
								<div class="form-group">
    								<label for="exampleFormControlTextarea1">Nachricht</label>
    								<textarea class="form-control" name="textArea" rows="3" id="textArea"></textarea>
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
	 * This function checks if the user interacted with this webpage. It proofs if the user wants to change the status of an review
	 * based on the "Button"-Key from the POST-Array or if the user want to accept or decline the whole review based on ...
	 * 
	 * @throw ErrorException: If the value of the POST-Array is not correct / does not exist.
	 */
	function proof_activity(){
		if (array_key_exists("SelectStatus", $_POST)){
			if ($_POST['SelectStatus'] == "State_Review_Accept"){
				try{
					change_status("Angenommen");
					print_result("Status wurde erfolgreich geändert.", True);
				}catch(ErrorException $exception){
					print_result("Der Status konnte nicht geändert werden.".$exception->getMessage(), False);
				}
			}elseif($_POST['SelectStatus'] == "State_Review_Decline"){
				try{
					change_status("Abgelehnt");
					print_result("Status wurde erfolgreich geändert.", True);
				}catch(ErrorException $exception){
					print_result("Der Status konnte nicht geändert werden.".$exception->getMessage(), False);
				}
			}elseif($_POST['SelectStatus'] == "State_Review_New"){
				try{
					change_status("Neu");
					print_result("Status wurde erfolgreich geändert.", True);
				}catch(ErrorException $exception){
					print_result("Der Status konnte nicht geändert werden.".$exception->getMessage(), False);
				}
			}elseif($_POST['SelectStatus'] == "State_Review_Work"){
				try{
					change_status("Bearbeitung");
					print_result("Status wurde erfolgreich geändert.", True);
				}catch(ErrorException $exception){
					print_result("Der Status konnte nicht geändert werden.".$exception->getMessage(), False);
				}
			}else{
				exception_handler("The value of the POST-Array is not correct", 1, "review.php", 190, NULL);
			}
		}
		//Proof if the user decline or accept a application and send if necessary a message.
		if (array_key_exists("Button", $_POST)){
			if ($_POST['Button'] == "Accept_Review"){
				try{
					$subject = "Ihre Rezension wurde angenommen!";
					$message = "Hallo,\nherzlichen Glückwunsch ihre Rezension wurde angenommen\n";
					change_status("Angenommen");
					send_message($subject, $message);
					print_result("Rezension wurde angenommen.", True);
				}catch(ErrorException $exception){
					print_result("Der Status konnte nicht geändert werden.".$exception->getMessage(), False);
				}
			}elseif ($_POST['Button'] == "Decline_Review"){
				try{
					$subject = "Ihre Rezension wurde abgelehnt!";
					$message = "Hallo,\nleider muss ich ihnen mitteilen, dass ihre Rezension abgelehnt wurde\n";
					change_status("Abgelehnt");
					send_message($subject, $message);
					print_result("Rezension wurde abgelehnt.", True);
				}catch(ErrorException $exception){
					print_result("Der Status konnte nicht geändert werden.".$exception->getMessage(), False);
				}
			}else{
				exception_handler("The value of the POST-Array is not correct", 1, "review.php", 216, NULL);
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
	 * This function requests the review data from the database.
	 * 
	 * @param string $review_id	The review ID
	 * @throws ErrorException	If a connection to the database cannot be established
	 */
	function get_student_data($review_id){
		try{
			$db = db_connection();
			$statement = $db->prepare('SELECT Firstname, Lastname, University.Name, Lecturer, Teaching, Internationality, Facilities, 
                                        FreeTime, Campus, CreationDate 
                                        FROM Reviews JOIN University ON Reviews.UniID = University.UniID 
                                        JOIN Student ON Reviews.MatriculationNumber = Student.MatriculationNumber 
                                        JOIN UniMember ON Student.PersonID = UniMember.PersonID 
										Where ReviewID = ?');
			$statement->execute(array($review_id));
			return $statement;

		}catch(PDOException $exception){
			exception_handler("Database Connection Error", 0, "review.php", 249, $exception);
		}
	}

	/**
	 * This function adds the student data from the review.
	 */
	function add_student_data(){
		$review_id = get_review_id();
		$statement = get_student_data($review_id);
		if ($statement->rowCount() === 0){
			exception_handler("Die Daten der Rezension konnten nicht gefunden werden", 1, "review.php", 260, NULL);
		}
		while($row = $statement->fetch()){
            $star_elements = array($row['Lecturer'], $row['Teaching'], $row['Internationality'], $row['Facilities'], $row['FreeTime'], $row['Campus']);
            $element_names = array("Dozent", "Lehre", "Internationalität", "Ausstattung", "Freizeitmöglichkeiten", "Campus");

            for($i = 0; $i < sizeof($element_names); $i++){
                $stars = 5;
                echo '<tr><td><b>'.$element_names[$i].'</b></td><td>';
                while($stars != 0){
                    if ($star_elements[$i] != 0){
                        echo '<label class="yellow-star" style="color: #eee200; font-size: 25px;">☆</label>';
                        $star_elements[$i]--;
                    }else{
                        echo '<label class="black-star" style="color: black; font-size: 25px;">☆</label>';
                    }
                    $stars--;
                }
                echo '</td></tr>';
            }
            echo '
            <tr>
            <td><b>Erstellungsdatum</b></td>
            <td>'.$row['CreationDate'].'</td>
            </tr>
            <tr>
            <td><b>Name</b></td>
            <td>'.$row['Firstname'].' '.$row['Lastname'].'</td>
            </tr>
            <tr>
            <td><b>Universität</b></td>
            <td>'.$row['Name'].'</td>
            </tr>';            
		}
	}

	function get_report(){
		try{
			$db = db_connection();
			$review_id = get_review_id();
			$statement = $db->prepare('SELECT Report FROM Reviews WHERE Reviews.ReviewID = ?');
			$statement->execute(array($review_id));

			if ($statement->rowCount() != 0){
				while ($row = $statement->fetch()){
					echo '<p class="text-left">'.$row['Report'].'</p>';
				}
			}else{
				exception_handler('No report was found!', 1, 'review.php', 308, NULL);
			}
		}catch (PDOException $exception){
			exception_handler("Database Connection Error", 1, "review.php", 311, $exception);
		}
	}

	/**
	 * This function changes the status of the review.
	 * 
	 * @param string $value		The new status of the review.
	 * @throws ErrorException	If a connection to the database cannot be established	
	 */
	function change_status($value){
		try{
			$db = db_connection();
			$review_id = get_review_id();
			$statement = $db->prepare(' UPDATE Reviews SET Status = ?
										Where Reviews.ReviewID = ?');
			$statement->execute(array($value, $review_id));
		}catch(PDOException $exception){
			exception_handler("Database Connection Error", 1, "review.php", 329, $exception);
		}
	}

	/**
	 * This function sends a message to the student of whom this review originates
	 * 
	 * @param string $subject	Is the subject line of the message.
	 * @param string $text		Is the message which the user want to send.
	 */
	function send_message($subject, $text){
		$db = db_connection();
		$review_id = get_review_id();
		$sender_id = get_worker_id();
		$statement = $db->prepare("INSERT INTO `Message`(`Subject`, `Text`, `Sender`, `Receiver`, `isDelete`) VALUES (?,?,?,
									(SELECT UniMember.PersonID 
									FROM Reviews JOIN Student ON Reviews.MatriculationNumber = Student.MatriculationNumber
									JOIN UniMember ON UniMember.PersonID = Student.PersonID
									WHERE Reviews.ReviewID = ?), 0)");
		$statement->execute(array($subject, $text, $sender_id, $review_id));
	}

	/**
	 * This function gets the ID of the review which was selected by the user.
	 * 
	 * @return string	The review ID
	 * @throws ErrorException	If the review ID is missing
	 */
	function get_review_id(){
		$review_id = "";
		if (!empty($_GET)){
			$review_id = $_GET['review_id'];
		}else{
			exception_handler("Missing review ID", 1, "review.php", 362, NULL);
		}
		return $review_id;
	}
?>