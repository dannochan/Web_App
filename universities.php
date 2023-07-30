<?php 
        require "config/DBConnection.php";
        require "config/Error.php";
        require "university.php";

        $page = "universities";

    ?>

<?php include("webElements/header.php"); ?>

<main class="border-bottom">

<div class="mx-auto">
		<div class="p-4 align-items-center">
			<div class="wrapper bg-light">
			<?php include("webElements/nav.php"); ?>
				<div class="row">
					<div class="col left">
						<?php include("webElements/sidebar.php"); ?>
						<?php include("webElements/mobilenav.php"); ?>
					</div>
					<div class="col right">
						<div class="row">
						<?php include("webElements/breadcrumbs.php"); ?>

                                    <!-- ab hier euer code -->
                                    <div class="container rounded bg-white">
                                        <div class="auswahlcontainer" style="grid-template-columns: 100%;">
                                        <div id="filter" class="jmp"></div>        
                                        <h4>Partneruniversitäten</h4>
                                            <form method="GET">
                                            <div class="auswahlcontainer">
                                                    <div class="uniauswahlitem"><span>Universität</span>
                                                        <select class="form-select" name="Universität" id="Universität">
                                                            <option selected>Alle</option>
                                                            <?php 
                                                                try{
                                                                    get_universities();
                                                                }catch (PDOException $exception){
                                                                    print_error_popup("An Error occurred:", $exception->getMessage().". Please try it later again.");
                                                                }
                                                            ?>
                                                        </select>
                                                        </div>
                                                    <div class="uniauswahlitem"><span>Land</span>
                                                        <select class="form-select" name="Land" id="Land">
                                                            <option selected>Alle</option>
                                                            <?php 
                                                                try{
                                                                    get_countries();
                                                                }catch (PDOException $exception){
                                                                    print_error_popup("An Error occurred:", $exception->getMessage().". Please try it later again.");
                                                                }
                                                            ?>
					                                    </select>
                                                        </div>

                                                    <div class="uniauswahlitem"><span>Abschluss</span>
                                                        <select class="form-select" name="Abschluss" id="Abschluss">
						                                    <option selected value="Alle">Alle</option>
					                                    	<option value="Bachelor">Bachelor</option>
					                                    	<option value="Master">Master</option>
					                                    </select>
                                                        </div>
                                                    <div class="uniauswahlitem"><span>Semester</span>
                                                        <select class="form-select" name="Semester" id="Semester">
						                                    <option selected value="Beides">Beides</option>
						                                    <option value="Wintersemester">Wintersemester</option>
						                                    <option value="Sommersemester">Sommersemester</option>
				                                        </select>
                                                        </div>
                                            </div>
                                            <div class="filter">
                                                <button type="submit" class="btn btn-primary btn-sm">Filter anwenden</button>
                                            </div>
                                            </form>
                                            <?php 
                                                try{
                                                    $university_list = get_university();
                                                    if (!empty($_GET)){
                                                        $university = $_GET['Universität'];
                                                        $country = $_GET['Land'];
                                                        $degree = $_GET['Abschluss'];
                                                        $semester = $_GET['Semester'];
                                                        filter($university, $country, $degree, $semester, $university_list);
                                                    }else{
                                                        create_university_list($university_list);
                                                    }
                                                }catch (PDOException $exception){
                                                    print_result("An Error occurred: ".$exception->getMessage().". Please try it later again.", False);
                                                }catch (ErrorException $exception){
                                                    print_result($exception->getMessage(), False);
                                                }
                                            ?>
                                            </div>
                                        </div>
                                            </div>
                                        <!-- bis hier euer code -->
                                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
	<?php include("webElements/footer.php"); ?>

<?php 

/**
 * This function get all names of all stored universities from the database and creates for every name a selectable option for the
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
 * This function get all countries of all stored universities from the database and creates for every country a selectable option for the
 * filter function.
 */
function get_countries(){
	$db = db_connection();
	$statement = $db->prepare("SELECT DISTINCT Country From University");
	$statement->execute();
	while($row = $statement->fetch()){
		echo '<option>'.$row['Country'].'</option>';
	}
}

/**
 * This function creates a connection to the database and requests all available universities. All necessary information about
 * each university will be saved in an object from the University Class. All university objects will be saved in an array.
 * 
 * @return array An array with all universities (as objects from the university.php) from the database.
 */
function get_university(){
	$university_list = array();
	$db = db_connection();
	$statement = $db->prepare("SELECT University.Name, University.UniID, University.Location, University.Country, University.Degree, 
                                University.Semester, University.Description
                                FROM University");
	$statement->execute();
	while($row = $statement->fetch()){
		$new_university = new University($row['UniID'], $row['Name'], $row['Location'],  $row['Country'], $row['Semester'], $row['Description'], $row['Degree']);
		array_push($university_list, $new_university);
	}
	return $university_list;
}

/**
 * This function creates a row for every university in the list with all visible elements.
 * 
 * @param array $university_list		A List of universities which should be displayed.
 * @throws ErrorException		        If the list is empty.
 */
function create_university_list($university_list){
	if (empty($university_list)){
		exception_handler("Keine passenden Ergebnisse gefunden!", 1, "auswahlportal.php", 186, NULL);
	}else{
		foreach($university_list as $key => $val){
            //The button "Mehr Informationen" opens the application with the "offeneBewerbung" Directory and POST the application_ID.
			echo '
			<div class="auswahlcontainer1">
    	    <b>Name:</b> <span style="margin-bottom: 15px">'.$val->get_name().'</span>
            <b>Ort:</b> <span style="margin-bottom: 15px">'.$val->get_location().'</span>
            <b>Beschreibung:</b>
            <p class="text-left text-truncate">'.$val->get_description().'
            </p>
            <button style="width: min-content" class="btn btn-light btn-sm d-none d-lg-block" onclick="location.href = \'#filter\'"><i class="bi bi-arrow-up-short"></i></button>
            <form method="POST" action="uniprofile.php">
            <input type="text" name ="uni_name" hidden value=\''.$val->get_name().'\'/>
            <button type="submit" class="btn btn-primary btn-sm">Mehr Informationen</button>
            </form>
            </div>';
		}
	}
}

/**
 * This function filters the universities according to the entered parameters.
 * 
 * @param string $name			    A Name of a university which could be selected by an user or "Alle".
 * @param string $country   	    A country where universities are located which could be selected by an user or "Alle". 
 * @param string $degree            A degree which universities offer which could be selected by an user or "Alle".
 * @param string $semester          A semester where a student can do a abroad semester which could be selected by an user or "Beides".
 * @param array $university_list	A List of all universities from the database.
 *  
 */
function filter($name, $country, $degree, $semester, $university_list){
    if($name === "Alle" && $country === "Alle" && $degree === "Alle" && $semester === "Beides"){
        create_university_list($university_list);
    }else{
        $university_list_fil = [];
        foreach($university_list as $key => $val){
            if (proof_name($name, $val) && proof_country($country, $val) && proof_degree($degree, $val) && proof_semester($semester, $val)){
                array_push($university_list_fil, $val);
            }
        }
        create_university_list($university_list_fil);
    }
}

/**
 * This function proofs if a university should be displayed, since it has the appropriate name.
 * 
 * @param $name:    The selected name of a university from the filter function.
 * @param $uni:     A university-instance from the database which should be proofed.
 * @return bool:    True - If the name is accepted by the filter. False - If the name is declined by the filter.
 */
function proof_name($name, $uni){
    if ($name === "Alle" || $uni->get_name() === $name){
        return True;
    }
    return False;
}

/**
 * This function proofs if a university should be displayed, since it is in the appropriate country.
 * 
 * @param $country:     The selected country from the filter function.
 * @param $uni:         A university-instance from the database which should be proofed.
 * @return bool:        True - If the country is accepted by the filter. False - If the country is declined by the filter.
 */
function proof_country($country, $uni){
    if ($country === "Alle" || $uni->get_country() === $country){
        return True;
    }
    return False;
}

/**
 * This function proofs if a university should be displayed, since it has the appropriate degree.
 * 
 * @param $degree:      The selected degree from the filter function.
 * @param $uni:         A university-instance from the database which should be proofed.
 * @return bool:        True - If the degree is accepted by the filter. False - If the degree is declined by the filter.
 */
function proof_degree($degree, $uni){
    if ($degree === "Alle" || $uni->get_degree() === $degree){
        return True;
    }
    return False;
}

/**
 * This function proofs if a university should be displayed, since it has the appropriate semester.
 * 
 * @param $semester:    The selected semester from the filter function.
 * @param $uni:         A university-instance from the database which should be proofed.
 * @return bool:        True - If the semester is accepted by the filter. False - If the semester is declined by the filter.
 */
function proof_semester($semester, $uni){
    if ($semester === "Beides" || $uni->get_semester() === $semester || $uni->get_semester() === "Beides"){
        return True;
    }
    return False;
}
?>