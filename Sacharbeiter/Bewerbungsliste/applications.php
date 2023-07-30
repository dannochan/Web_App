<?php 
	require 'ApplicClass.php';
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
	
				<!--Filter function-->	
				<form method="POST" action="./" class="border border-dark rounded">
					<h2>Bewerbungen</h2>
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

					<!--Options for specify a university and the status of the applications-->
					<div class="row">
						<div class="col right">
							<p class="filter-text">Name der Universität</p>
      						<select id="inputState" name="University" class="form-control">
        						<option selected>Alle</option>
								<?php 
									try{
										get_universities();
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
						<input type="submit" class="btn btn-primary btn-sm" value="Filter anwenden"/>
					</div>
				</form>

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
								// Get all applications from the database and proofs if the filter function was used. 
								$app_list = get_applications();
								if(!empty($_POST)){
									$id = $_POST['ID'];
									$name = $_POST['Name'];
									$university = $_POST['University'];
									$status = $_POST['Status'];
									filter($id, $name, $university, $status, $app_list);
								}else{
									create_appList($app_list);
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
	 * This function filters the applications according to the entered parameters.
	 * 
	 * @param string $id 			An ID of an application which could be entered by an user.
	 * @param string $name			A Name of a student which could be entered by an user.
	 * @param string $university	A Name of an university which could be selected by an user. 
	 * @param string $status		The Status of an application which could be selected by an user.
	 * @param array $app_list		A List of all applications from the database.
	 *  
	 */
	function filter($id, $name, $university, $status, $app_list){
		if($id === "" && $name === "" && $university === "Alle" && $status === "Alle"){
			create_appList($app_list);
		}else{
			$app_list_fil = [];
			foreach($app_list as $key => $val){
				if (proof_id($id, $val) && proof_university($university, $val) && proof_student($name, $val) && proof_status($status, $val)){
					array_push($app_list_fil, $val);
				}
			}
			create_appList($app_list_fil);
		}
	}
	/**
	 * This function creates a connection to the database and requests all available applications. All necessary information about
	 * all applications will be saved in an object from the Application Class. All application objects will be saved in an array.
	 * 
	 * @return array An array with all applications (as objects from the ApplicClass.php) from the database.
	 */
	function get_applications(){
		$app_list = array();
		$db = db_connection();
		$statement = $db->prepare("SELECT Applications.ApplicationID, UniMember.FirstName, UniMember.LastName, University.Name, Applications.Status
									FROM Applications JOIN University ON Applications.UniID = University.UniID 
									JOIN Student ON Applications.MatriculationNumber = Student.MatriculationNumber 
									JOIN UniMember ON Student.PersonID = UniMember.PersonID");
		$statement->execute();
		while($row = $statement->fetch()){
			$new_applic = new Application($row['ApplicationID'], $row['FirstName'], $row['LastName'], $row['Name'], $row['Status']);
			array_push($app_list, $new_applic);
		}
		return $app_list;
	}

	/**
	 * This function get all names of all stored universities from the databse and creates for every name a selectable option for the
	 * filter function.
	 */
	function get_universities(){
		$db = db_connection();
		$statement = $db->prepare("SELECT Name From University");
		$statement->execute();
		while($row = $statement->fetch()){
			echo '<option>'.$row['Name'].'</option>';
		}
	}

	/**
	 * This function creates a row for every application in the list with all visible elements.
	 * 
	 * @param array $app_list		A List of applications which should be displayed.
	 * @throws ErrorException		If the list is empty.
	 */
	function create_appList($app_list){

		if (empty($app_list)){
			exception_handler("Keine passenden Ergebnisse gefunden!", 1, "applications.php", 173, NULL);
		}else{
			foreach($app_list as $key => $val){
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
				<form method="GET" action="../offeneBewerbung">
				<input type="text" name = "appli_id" hidden value=\''.$val->get_id().'\'/>
				<input type="submit" class="btn btn-primary btn-sm" value="Öffnen"/>
				</form>
				</td>
				</tr></tbody>';
			}
		}
	}


	/**
	 * This function proofs if a application should be displayed, since it has the appropriate id.
	 * 
	 * @param $id:	    		The selected id of an application from the filter function.
	 * @param $application:     A application-instance from the database which should be proofed.
	 * @return bool:    		True - If the id is accepted by the filter. False - If the id is declined by the filter.
	 */
	function proof_id($id, $application){
	    if ($id === "" || $application->get_id() === $id){
	        return True;
	    }
	    return False;
	}

	/**
	 * This function proofs if a application should be displayed, since it is in the appropriate university name.
	 * 
	 * @param $name: 		 		The selected university name from the filter function.
	 * @param $application:         A application-instance from the database which should be proofed.
	 * @return bool:        		True - If the university name is accepted by the filter. 
	 * 								False - If the university name is declined by the filter.
	 */
	function proof_university($name, $application){
	    if ($name === "Alle" || $application->get_university() === $name){
	        return True;
	    }
	    return False;
	}

	/**
	 * This function proofs if a application should be displayed, since it has the appropriate student name.
	 * 
	 * @param $name:  			    The selected student name from the filter function.
	 * @param $application:         A application-instance from the database which should be proofed.
	 * @return bool:        		True - If the student name is accepted by the filter. 
	 * 								False - If the student name is declined by the filter.
	 */
	function proof_student($name, $application){
		$complete_name = $application->get_first_name()." ".$application->get_last_name();
	    if ($name === "" || $application->get_first_name() === $name || $application->get_last_name() === $name || $complete_name === $name){
	        return True;
	    }
	    return False;
	}

	/**
	 * This function proofs if a application should be displayed, since it has the appropriate status.
	 * 
	 * @param $status:    			The selected status from the filter function.
	 * @param $application:         A application-instance from the database which should be proofed.
	 * @return bool:        		True - If the status is accepted by the filter. 
	 * 								False - If the status is declined by the filter.
	 */
	function proof_status($status, $application){
	    if ($status === "Alle" || $application->get_status() === $status){
	        return True;
	    }
	    return False;
	}
	
?>