<?php 
    require "reviewClass.php";
    require "../../config/DBConnection.php";
	require "checkhistory.php";
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
				<?php 
					if (!empty($_POST)){
						$key = 'SelectUni';
						if (key_exists($key, $_POST)){
							try{
								proof_accepted_applications();
								$result = start_review_process($_POST['SelectUni']);
								print_result("Es wurden an ".$result." Studierenden eine Anfrage gesendet", True);
							}catch (PDOException $exception){
								print_result("An Error occurred: ".$exception->getMessage().". Please try it later again.", False);
							}catch (ErrorException $exception){
								print_result($exception->getMessage(), False);
							}
						}
					}
				?>
				<!--Link to the startpage under the navbar-->
				<nav aria-label="breadcrumb" class="d-none d-lg-block">
					<p class="breadcrumb">»<a href="https://web06.iis.uni-bamberg.de/WIP/wip2122_g3/" >Startseite</a></p> 
				</nav>

                <!--Filter function-->	
				<form method="GET" action="./" class="border border-dark rounded">
					<h2>Rezensionen</h2>
					<hr>
					<!--Options for entering an ID and a name for a student-->
					<div class="row">
						<div class="col right">
							<p class="filter-text">ID</p>
							<input type="text" name="ID" class="form-control" placeholder="--ID eingeben--">
						</div>
						<div class="col right">
							<p class="filter-text">Studierendenname</p>
							<input type="text" name="Name" class="form-control" placeholder="--Studierendenname eingeben--">
						</div>
					</div>

					<!--Options for specify a university and the status of the reviews-->
					<div class="row">
						<div class="col right">
							<p class="filter-text">Name der Universität</p>
      						<select id="inputState" name="University" class="form-control">
        						<option selected>Alle</option>
								<?php 
									try{
										get_universities(False);
									}catch (PDOException $exception){
										print_result("An Error occurred: ".$exception->getMessage().". Please try it later again.", False);
									}		
								?>	
      						</select>
						</div>
						<div class="col right">
							<p class="filter-text">Status</p>
      						<select id="inputState" name="Status" class="form-control">
        						<option selected>Alle</option>
        						<option>Angenommen</option>
								<option>Abgelehnt</option>
								<option>Bearbeitung</option>
								<option>Neu</option>
      						</select>
						</div>
					</div>
					<div class="col align-self-center">
						<input type="submit" class="btn btn-primary" value="Filter anwenden"/>
					</div>
                    <div class="col align-self-center">
                        <button class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#startprocess">Rezensionsprozess starten</button>
                    </div>
				</form>

                <!--A pop-up window which gives the user the opportunity to start the review process for a specfic university-->
				<div class="modal fade" id="startprocess" tabindex="-1" data-bs-backdrop="static" aria-labelledby="startProcess" aria-hidden="true">
					<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        				<div class="modal-content">	
							<div class="modal-header">
            					<h5 class="modal-title"><b>Rezensionsprozess starten</b></h5>
            					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         					</div>
          					<div class="modal-body text-center">
								<form method="POST">
								<select class="form-control" name="SelectUni">
  									<?php
                                        get_universities(True);  
                                    ?>
								</select>
								<br>
								<button type="submit" class="btn btn-primary btn-sm">Prozess starten</button>
								</form>
							</div>
						</div>
					</div>
				</div>

                <div class="row px-3 table-wraper">
					<table class="table table-hover border border-secondary mt-2 my-table">
  						<thead>
							<tr class="table-secondary">
							  <th scope="col"><b>ID</b></th>
							  <th scope="col"><b>Name</b></th>
							  <th scope="col"><b>Universität</b></th>
							  <th scope="col"><b>Status</b></th>
							  <th scope="col"><b>Öffnen</b></th>
							</tr>
						</thead>

						<?php
							try{
								// Get all reviews from the database and proofs if the filter function was used. 
								$review_list = get_reviews();
								if(!empty($_GET)){
									$id = $_GET['ID'];
									$name = $_GET['Name'];
									$university = $_GET['University'];
									$status = $_GET['Status'];
									filter($id, $name, $university, $status, $review_list);
								}else{
									create_review_list($review_list);
								}
							
							}catch (PDOException $exception){
								print_result("An Error occurred: ".$exception->getMessage().". Please try it later again.", False);
							}catch (ErrorException $exception){
								print_result($exception->getMessage(), False);
							}
						?>
					</table>
				</div>

            </div>
        </div>
    </div>
</div>

<?php 
	/**
	 * This function filters the reviews according to the entered parameters.
	 * 
	 * @param string $id 			An ID of an review which could be entered by an user.
	 * @param string $name			A Name of a student which could be entered by an user.
	 * @param string $university	A Name of an university which could be selected by an user. 
	 * @param string $status		The Status of an review which could be selected by an user.
	 * @param array $review_list	A List of all reviews from the database.
	 *  
	 */
	function filter($id, $name, $university, $status, $review_list){
		if($id === "" && $name === "" && $university === "Alle" && $status === "Alle"){
			create_review_list($review_list);
		}else{
			$review_list_fil = [];
			foreach($review_list as $key => $val){
				if (proof_id($id, $val) && proof_university($university, $val) && proof_student($name, $val) && proof_status($status, $val)){
					array_push($review_list_fil, $val);
				}
			}
			create_review_list($review_list_fil);
		}
	}
	/**
	 * This function creates a connection to the database and requests all available reviews. All necessary information about
	 * all reviews will be saved in an object from the review Class. All application objects will be saved in an array.
	 * 
	 * @return array An array with all reviews (as objects from the reviewClass.php) from the database.
	 */
	function get_reviews(){
		$review_list = array();
		$db = db_connection();
		$statement = $db->prepare("SELECT Reviews.ReviewID, UniMember.FirstName, UniMember.LastName, University.Name, Reviews.Status
									FROM Reviews JOIN University ON Reviews.UniID = University.UniID 
									JOIN Student ON Reviews.MatriculationNumber = Student.MatriculationNumber 
									JOIN UniMember ON Student.PersonID = UniMember.PersonID");
		$statement->execute();
		while($row = $statement->fetch()){
			$new_review = new Review($row['ReviewID'], $row['FirstName'], $row['LastName'], $row['Name'], $row['Status']);
			array_push($review_list, $new_review);
		}
		return $review_list;
	}

	/**
	 * This function get all names of all stored universities from the databse and creates for every name a selectable option for the
	 * filter function.
	 */
	function get_universities($with_id){
		$db = db_connection();
		$statement = $db->prepare("SELECT Name, UniID From University");
		$statement->execute();
		while($row = $statement->fetch()){
            if ($with_id){
                echo '<option value="'.$row['UniID'].'">'.$row['Name'].'</option>';
            }else{
                echo '<option>'.$row['Name'].'</option>';
            }
		}
	}

	/**
	 * This function creates a row for every application in the list with all visible elements.
	 * 
	 * @param array $review_list	A List of reviews which should be displayed.
	 * @throws ErrorException		If the list is empty.
	 */
	function create_review_list($review_list){

		if (empty($review_list)){
			exception_handler("Keine passenden Ergebnisse gefunden!", 1, "reviewlist.php", 221, NULL);
		}else{
			foreach($review_list as $key => $val){
				echo "
				<tbody>
        	    <tr><th scope='row'>" . $val->get_id() . "</th>
        	    <td>" . $val->get_first_name().' '.$val->get_last_name() . "</td>
        	    <td>" . $val->get_university() . "</td>";
				if ($val->get_status() === "Angenommen"){
					echo'
					<td>
					<span class="badge badge-success icon">
					<i class="bi bi-check-circle"></i>
					</span>
					</td>';
				} elseif($val->get_status() === "Abgelehnt"){
					echo '
					<td>
					<span class="badge badge-danger icon">
    				<i class="bi bi-x-circle"></i>
					</span>
					</td>';
				} elseif ($val->get_status() === "Neu"){
					echo '
					<td>
					<span class="badge badge-info icon">
					<i class="bi bi-bell"></i>
					</span>
					</td>';
				} elseif ($val->get_status() === "Bearbeitung"){
					echo '
					<td>
					<span class="badge badge-info icon">
					<i class="bi bi-pencil-fill"></i>
					</span>
					</td>';
				} else{
					echo '
					<td>
					<span class="badge badge-info icon">
					<i class="bi bi-patch-question-fill"></i>
					</span>
					</td>';
				}
				//The button "Öffnen" opens the application with the "offeneBewerbung" Directory and POST the application_ID.
				echo '
				<td>
				<form method="GET" action="../offeneRezension">
				<input type="text" name = "review_id" hidden value=\''.$val->get_id().'\'/>
				<input type="submit" class="btn btn-primary btn-sm" value="Öffnen"/>
				</form>
				</td>
				</tr></tbody>';
			}
		}
	}

	/**
	 * This function get a list of all students which have completed their Semester abroad and have not write a review from the 
	 * database.
	 * 
	 * @param string $uni_id	The ID of the university
	 * @return PDOStatement		The result from the request.
	 */
    function get_candidates($uni_id){
        $db = db_connection();
        $statement = $db->prepare("SELECT UniMember.PersonID, Student.MatriculationNumber
                                    FROM UniMember JOIN Student ON UniMember.PersonID = Student.PersonID 
                                    JOIN Applications ON Student.MatriculationNumber = Applications.MatriculationNumber 
                                    JOIN University ON Applications.UniID = University.UniID 
                                    WHERE University.UniID = ? AND Student.Completed = 1 AND Student.getRequest = 0
                                    AND Student.hasReplied = 0");
        $statement->execute(array($uni_id));
        return $statement;
    }

	/**
	 * This function send messages to all student which were selected from the database.
	 * 
	 * @param string $id	The id of the student which should get a message to write a review.
	 * @param string $matr	The Matriculationnumber of the student which should get a message to write a review.
	 */
    function send_message($id, $matr){
        $db = db_connection();
        $message = "Guten Tag,\nSie wurden ausgewählt, eine Rezension zu schreiben. Bitte gehen sie in der Plattform auf die Seite 
        der Rezension und lassen sie uns teilhaben an ihren Erfahrungen. \nWir freuen uns für eine Teilnahme";
		$sender_id = get_worker_id();
        $statement = $db->prepare("INSERT INTO `Message`(`Subject`, `Text`, `Sender`, `Receiver`, `isDelete`) VALUES ('Rezensionsanfrage',?,?,?,0)");
        $statement->execute(array($message, $sender_id, $id));
		$statement = $db->prepare("UPDATE Student SET getRequest = 1 WHERE MatriculationNumber = ?");
        $statement->execute(array($matr));
    }

	/**
	 * This function starts the review process. Therefor it searches for all students which completed their semester abroad and have not
	 * write a review. After that it sends to all this students a request.
	 * 
	 * @param string $uni_id	The ID of the university which needed new reviews.
	 * @return int $counter		The total number of students which get a request.
	 * @throws ErrorException	If there are not students which visited the university and did not write a review.
	 */
    function start_review_process($uni_id){
        $statement = get_candidates($uni_id);
        
        if ($statement->rowCount() != 0){
            $counter = 0;
            while ($row = $statement->fetch()){
                $counter++;
				send_message($row['PersonID'], $row['MatriculationNumber']);
            }
            return $counter;
        }else{
            exception_handler("Es gibt keine Studierenden die an dieser Universität ohne Rezension ein Auslandssemster abgeschlossen haben!"
            , 1, "reviewlist.php", 334, NULL);
        }
    }	

	/**
	 * This function proofs if a review should be displayed, since it has the appropriate id.
	 * 
	 * @param $id:	    		The selected id of an review from the filter function.
	 * @param $review:     		A review-instance from the database which should be proofed.
	 * @return bool:    		True - If the id is accepted by the filter. False - If the id is declined by the filter.
	 */
	function proof_id($id, $review){
	    if ($id === "" || $review->get_id() === $id){
			return True;
	    }
	    return False;
	}

	/**
	 * This function proofs if a review should be displayed, since it is in the appropriate university name.
	 * 
	 * @param $name: 		 		The selected university name from the filter function.
	 * @param $review:        		 A review-instance from the database which should be proofed.
	 * @return bool:        		True - If the university name is accepted by the filter. 
	 * 								False - If the university name is declined by the filter.
	 */
	function proof_university($name, $review){
	    if ($name === "Alle" || $review->get_university() === $name){
			return True;
	    }
	    return False;
	}

	/**
	 * This function proofs if a review should be displayed, since it has the appropriate student name.
	 * 
	 * @param $name:  			    The selected student name from the filter function.
	 * @param $review:         		A review-instance from the database which should be proofed.
	 * @return bool:        		True - If the student name is accepted by the filter. 
	 * 								False - If the student name is declined by the filter.
	 */
	function proof_student($name, $review){
		$complete_name = $review->get_first_name()." ".$review->get_last_name();
	    if ($name === "" || $review->get_first_name() === $name || $review->get_last_name() === $name || $complete_name === $name){
			return True;
	    }
	    return False;
	}

	/**
	 * This function proofs if a review should be displayed, since it has the appropriate status.
	 * 
	 * @param $status:    			The selected status from the filter function.
	 * @param $review:         		A review-instance from the database which should be proofed.
	 * @return bool:        		True - If the status is accepted by the filter. 
	 * 								False - If the status is declined by the filter.
	 */
	function proof_status($status, $review){
	    if ($status === "Alle" || $review->get_status() === $status){
			return True;
	    }
	    return False;
	}
?>
