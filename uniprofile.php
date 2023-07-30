    <?php include("config.php"); ?>
	<?php include("webElements/header.php"); ?>
	<?php include("config/Error.php"); ?>
	<main class="border-bottom">

<div class="mx-auto">
		<div class="p-4 align-items-center">
			<div class="wrapper bg-light">
				<?php  
				$page = "universities";
				include("webElements/nav.php");
				?>
				<div class="row">
					<div class="col left">
						<?php include("webElements/sidebar.php"); ?>
						<?php include("webElements/mobilenav.php"); ?>
					</div>
					<div class="col right">
						<div class="row">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
								<li class="breadcrumb-item">» <a href="https://web06.iis.uni-bamberg.de/WIP/wip2122_g3">Startseite</a></li>
								<li class="breadcrumb-item"><a href="universities.php">Auswahlportal</a></li>
									<?php
									if (isset($_POST['uni_name'])){
										$name = $_POST['uni_name'];
									}

									echo '<li class="breadcrumb-item active">'.$name.'</li>';
									?>
									
								</ol>
							</nav>
                            <!-- ab hier euer code -->
						
							
							<div class="container rounded bg-white"> <!--Beginn erste WEISSE BOX -->

								<?php

									if (isset($_POST['uni_name'])){
										$name = $_POST['uni_name'];
									}

	
								try {
								/*Hier wird die Überschrift angegeben, sprich der Name der aufgerufenen Universität*/
								getTitle($name);

                                /*Hier wird ein Bilderkarussel über die Uni angezeigt*/
                                getCarousel($name);
								
                                 /*Hier werden die wichtigsten Infos über die Uni aufgerufen und angezeigt*/
                                getUniProfile($name);
							
								}catch (PDOException $exception){
									print_result("ERROR: ".$exception->getMessage().". Die auserwählte Universität ist zurzeit nicht verfügbar. Bitte kontaktiere in dringenden Fällen das Akademische Auslandsamt!", False);
								}catch (ErrorException $exception){
									print_result($exception->getMessage(), False);
								}	
						
								?>

							</div> <!-- Schließung ersete weiße Box -->


							<!--div class="container rounded bg-white"--> <!--Beginn zweite weiße Box, falls Rezensionen vorliegen -->

								<?php

									if (isset($_POST['uni_name'])){
										$name = $_POST['uni_name'];
									}
								
							
								try {
									
									/*Hier werden die aktuellesten Rezensionen über die Uni aufgerufen und angezeigt (falls vorhanden)*/
									getReviews($name);
								
								}catch (PDOException $exception){
									print_result("ERROR: ".$exception->getMessage().". Aktuell liegt ein Problem bezüglich der Rezensionen vor. Bitte kontaktiere in dringenden Fällen das Akademische Auslandsamt!", False);
								}catch (ErrorException $exception){
									print_result($exception->getMessage(), False);
								}
								?> 


							<!--/div-->  <!--Schließung zweite weiße Box, falls Rezensionen vorliegen -->

                            <!-- bis hier euer code -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
	
	<?php include("webElements/footer.php"); ?>

	<!-- #### JAVA SCRIPT FUNKTIONEN #### -->

	<script>
	var myModal = document.getElementById('myModal')
	var myInput = document.getElementById('myInput')
	myModal.addEventListener('shown.bs.modal', function () {
	myInput.focus()
	})
	</script>



	<!-- #### PHP FUNKTIONEN #### -->

	<?php

	function getTitle($name){			

		$pdo = connect();
		
		$statement = "SELECT Name FROM University WHERE Name = ?";					
		$erg = $pdo->prepare($statement);
		$erg->execute(array($name));
	
								
		if($erg->rowCount() > 0){
			while($row = $erg->fetch()){
				echo '<h4><b>'.$row["Name"].'</b></h4>';
				}
		}
	}

	function getUniAdress($name){	
	
		$pdo = connect();
	
		$statement = "SELECT Location FROM University WHERE Name = ?";
		$erg = $pdo->prepare($statement);
		$erg->execute(array($name));

		if($erg->rowCount() > 0){
			while($row = $erg->fetch()){
			echo '<p><i>'.$row["Location"].'</i></p>';
			}
		}
	}

	/*Sollte eine Google Maps Verlinkung in der DB bestehen wird zusätzlich eine Map als Button vor getUniProfile angezeigt*/
	function createMapButton($name){
	
		$pdo = connect();	


		$statement = "SELECT Maps FROM University WHERE Name = ? AND Maps IS NOT NULL";
		$erg = $pdo->prepare($statement);
		$erg->execute(array($name));

		if($erg->rowCount() > 0){

			echo '<!-- Button trigger modal -->
			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
			    <i class="bi bi-bullseye"></i>
				Find me!
			</button>
			
			<!-- Modal -->
			<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">'.$name.'</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				  </div>
				  <div class="modal-body">';	
		
				while($row = $erg->fetch()){ 
				
				echo '<iframe src="'.$row["Maps"].'" width="300" height="225" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';
			
				}
		
					echo '     </div>
					<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Schließen</button>
					
				</div>
				</div>
			</div>
			</div> <br>';

		

		} 
	}

	function getCarousel($name){

		$pdo = connect();
	
		$statement = "SELECT Image.Picture 
					  FROM Image JOIN University ON Image.UniID = University.UniID 
					  WHERE University.Name = ? AND Image.Picture IS NOT NULL"; 
			
		$erg = $pdo->prepare($statement);
		$erg->execute(array($name));
		$num = $erg->rowCount();
	
		if($erg->rowCount() > 0){

			echo '<div class ="row"><div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-keyboard=true data-bs-interval="7500"><div class="carousel-indicators"><button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>';

			for($i=1; $i<$num; $i++){ 
				echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="'.$i.'" aria-label="Slide '.($i+1).'"></button>';
			}
			
			echo '</div><div class="carousel-inner">';

			
			$row = $erg->fetchAll();

	

			for($c=0; $c<$num; $c++) {

				if($c == 0) {
					echo 	'<div class="carousel-item active">
					<img src="'.$row[$c]['Picture'].'" class="d-block w-100" alt="Picture of University 1" width="300" height="350">
					</div>';
				} else {
					echo '<div class="carousel-item">
					<img src="'.$row[$c]['Picture'].'" class="d-block w-100" alt="Picture of University '.($c+1).'" width="300" height="350">
					</div>';
				}
				
			}
			
			echo '</div>
			<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Previous</span>
			</button>
			<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Next</span>
			</button>
			</div>
			</div><br>';
		
		
		} else {
			echo '<p> Aktuell liegen keine Fotos für'.$name.' vor. Bitte kontaktiere das Auslandsamt. </p>';
		}
		
	
	}

	function getUniProfile($name) {

		$pdo = connect();
	
		$statement = "SELECT Name, Location, Country, Link, Contact, Description 
					FROM University WHERE Name = ?";
		
		$erg = $pdo->prepare($statement);
		$erg->execute(array($name));
	
		if($erg->rowCount() > 0){

			echo createMapButton($name).'<br> <div class="row"> <div class="col">';

			while($row = $erg -> fetch()){

				echo '
				
				<div class="row">
					<div class="col">	
						<p><b>Name</b></p>
					</div>
					<div class="col">	
						<p>'.$row["Name"].'</p>
					</div>
			 	</div>
				
			 	<div class="row">
					<div class="col">	
						<p><b>Adresse</b></p>
					</div>
					<div class="col">	
						<p>'.$row["Location"].'</p>
					</div>
			  	</div>

			  	<div class="row">
					<div class="col">	
						<p><b>Land</b></p>
					</div>
					<div class="col">	
						<p>'.$row["Country"].'</p>
					</div>
			 	</div>

				<div class="row">
					<div class="col">	
						<p><b>Ansprechpartner</b></p>
					</div>
					<div class="col">	
						<p>'.$row["Contact"].'</p>
					</div>
			  	</div>

				<div class="row">
					<div class="col">	
						<p><b>Webseite</b></p>
					</div>
					<div class="col">	
						<a href="'.$row["Link"].'"><font color=black>'.$row["Link"].'</font></a>
					</div>
			  	</div>

				<div class ="row">	
					<p><b>Beschreibung</b></p>
				</div>
				<div class="row">
					<p align=justify >'.$row["Description"].'</p>		
				</div>
				</div>';
			}
		}
	}
	
	function getReviews($name){

		$pdo = connect();

		$statement = "SELECT UniMember.FirstName, UniMember.LastName, UniMember.ProfileImage, Reviews.UniID, Reviews.MatriculationNumber, Reviews.Report, Reviews.Lecturer, Reviews.Teaching, Reviews.Internationality, Reviews.Facilities, Reviews.FreeTime, Reviews.Campus, Reviews.CreationDate
							  FROM (Reviews INNER JOIN University ON Reviews.UniID = University.UniID)
							  		INNER JOIN Student ON Student.MatriculationNumber = Reviews.MatriculationNumber
									  INNER JOIN UniMember ON  UniMember.PersonID = Student.PersonID 				  
							  WHERE University.Name = ? AND Reviews.Status = 'Angenommen'
							  ORDER BY Reviews.CreationDate DESC"; 

		$erg = $pdo->prepare($statement);
		$erg->execute(array($name));

		
	
		if($erg->rowCount() > 0){

			echo '<div class="container rounded bg-white"> 
				  
				  <div class="container mt-5 mb-5">';

				  $count = $erg->rowCount();
				  if ($count > 3){
					  $count = 3;
				  }

				  while($row = $erg -> fetch()){
						$array[]= array('FirstName' => $row['FirstName'], 'LastName' => $row['LastName'], 'ProfileImage' => $row['ProfileImage'], 'MatriculationNumber' => $row['MatriculationNumber'], 'Report' => $row['Report'], 'Lecturer' => $row['Lecturer'], 'Teaching' => $row['Teaching'], 'Internationality' => $row['Internationality'], 'Facilities' => $row['Facilities'], 'FreeTime' => $row['FreeTime'], 'Campus' => $row['Campus'], 'CreationDate' => $row['CreationDate']);
					}
				  
					
				 	for($i=0; $i<$count; $i++){


							$lecturer = $array[$i]['Lecturer'];
							$teaching = $array[$i]['Teaching'];
							$internationality = $array[$i]['Internationality'];
							$facilities = $array[$i]['Facilities'];
							$freetime = $array[$i]['FreeTime'];
							$campus = $array[$i]['Campus'];
							$creationdate = $array[$i]['CreationDate'];
							$report = $array[$i]['Report'];
							$vorname = $array[$i]['FirstName'];
							$nachname = $array[$i]['LastName'];
							$bild = $array[$i]['ProfileImage'];
						
							echo ' 
							
							<div class="row g-2">
							
								<div class="card p-3 text-center px-4">

									<div class="row g-2">
				
										<div class="col-md-4">
												<br> <br> <br>
												<div class="user-image"> <img src="'.$bild.'" class="rounded-circle" width="80"> </div>
											<div class="user-content">
												<h5 class="mb-0"><b>'.$vorname.' '.$nachname.'</b></h5> <span>'.$creationdate.'</span>
											</div>
										</div>
									
										<div class="col-md-4">
												
													<div class="ratings"> <ab>Dozenten</ab> <br>';

													for($a=0; $a<$lecturer; $a++){
														echo '<i class="bi bi-star-fill"></i>';
													}

											echo '	</div>
											
													<div class="ratings"> <ab>Lehre</ab> <br>';
											
													for($a=0; $a<$teaching; $a++){
														echo '<i class="bi bi-star-fill"></i>';
													}

											echo '	</div>
												
													<div class="ratings"> <ab>Internationalität</ab> <br>';
										
													for($a=0; $a<$internationality; $a++){
														echo '<i class="bi bi-star-fill"></i>';
													}

											echo '	</div>
													
													<div class="ratings"> <ab>Ausstattung</ab> <br>';

													for($a=0; $a<$facilities; $a++){
														echo '<i class="bi bi-star-fill"></i>';
													}

											echo ' </div>
													
													<div class="ratings"> <ab>Freizeitmöglichkeiten</ab> <br>';
											
													for($a=0; $a<$freetime; $a++){
														echo '<i class="bi bi-star-fill"></i>';
													}

											echo ' </div>
													
													<div class="ratings"> <ab>Campus</ab> <br>';

													for($a=0; $a<$campus; $a++){
														echo '<i class="bi bi-star-fill"></i>';
													}
											
										echo '	 </div> <br> 
										
										</div> 
										
									</div>
											
									<div class="row g-2">
											
										<div class="user-content">
											<h6><b>Das sagt '.$vorname.' über den Aufenthalt:</b></h6>
											<p>'.$report.'</p>
										</div>
									</div>
				
												
								</div>
							</div>';

									if($i<2){
										echo '<br>';
									}
				 	}
				
						
					if($erg->rowCount() > 3) {
						echo '
						<br>
						<!-- Button trigger modal -->
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#moreReviews">
							Weitere Rezensionen anzeigen
						</button>';

						echo '<button type="button" data-bs-toggle="modal" title="Universitäten" class="btn btn-primary_active" onclick="location.href = ';
						
						echo "'https://web06.iis.uni-bamberg.de/WIP/wip2122_g3/universities.php'";
						
						echo '">
									
						<i class="bi bi-building"> Zurück zur Übersicht</i>
						</button>';

						echo '<!-- Modal -->
						<div class="modal fade" id="moreReviews" tabindex="-1" aria-labelledby="moreReviewsLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="moreReviewsLabel">Weitere Rezensionen zur '.$name.'</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								
									<div class="modal-body">';

					 			
										for($j=3; $j<count($array); $j++){


												$lecturer2 = $array[$j]['Lecturer'];
												$teaching2 = $array[$j]['Teaching'];
												$internationality2 = $array[$j]['Internationality'];
												$facilities2 = $array[$j]['Facilities'];
												$freetime2 = $array[$j]['FreeTime'];
												$campus2 = $array[$j]['Campus'];
												$creationdate2 = $array[$j]['CreationDate'];
												$report2 = $array[$j]['Report'];
												$vorname2 = $array[$j]['FirstName'];
												$nachname2 = $array[$j]['LastName'];
												$bild2 = $array[$j]['ProfileImage'];
								
											echo '
											
											<div class="row g-2">
									
												<div class="card p-3 text-center px-4">
		
													<div class="row g-2">
													
													<div class="col-md-4">
														<br> <br> <br>
														<div class="user-image"> <img src="'.$bild2.'" class="rounded-circle" width="80"> </div>
														<div class="user-content">
														<h5 class="mb-0"><b>'.$vorname2.' '.$nachname2.'</b></h5> <span>'.$creationdate2.'</span>
														</div>
													</div>
													
													<div class="col">
														
																<div class="ratings"> <ab>Dozenten</ab> <br>';
					
																for($b=0; $b<$lecturer2; $b++){
																	echo '<i class="bi bi-star-fill"></i>';
																}
			
														echo '	</div>
														
																<div class="ratings"> <ab>Lehre</ab> <br>';
														
																for($b=0; $b<$teaching2; $b++){
																	echo '<i class="bi bi-star-fill"></i>';
																}
			
														echo '	</div>
														
																<div class="ratings"> <ab>Internationalität</ab> <br>';
													
																for($b=0; $b<$internationality2; $b++){
																	echo '<i class="bi bi-star-fill"></i>';
																}
			
														echo '	</div>
														
																<div class="ratings"> <ab>Ausstattung</ab> <br>';
			
																for($b=0; $b<$facilities2; $b++){
																	echo '<i class="bi bi-star-fill"></i>';
																}
			
														echo '	</div>
														
																<div class="ratings"> <ab>Freizeitmöglichkeiten</ab> <br>';
														
																for($b=0; $b<$freetime2; $b++){
																	echo'<i class="bi bi-star-fill"></i>';
																}
			
														echo '	</div>
														
																<div class="ratings"> <ab>Campus</ab> <br>';
			
																for($b=0; $b<$campus2; $b++){
																	echo'<i class="bi bi-star-fill"></i>';
																}
														
														echo '	</div> <br> 
													
													</div> 
													</div>
															
													<div class="row g-2">
															
														<div class="user-content">
																<h6><b>Das sagt '.$vorname2.' über den Aufenthalt:</b></h6>
																<p>'.$report2.'</p>
														</div>
													</div>
													
												</div>
											</div>';
		
												if($j<(count($array)-1)){
													echo '<br>';
												}											
								}
				
							echo '
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Schließen</button>
									
								</div>
								</div>
							</div>
						</div>
						
					</div> </div>';
				
					}else {

					echo '<button type="button" data-bs-toggle="modal" title="Universitäten" class="btn btn-primary_active" onclick="location.href = ';
						
						echo "'https://web06.iis.uni-bamberg.de/WIP/wip2122_g3/universities.php'";
						
						echo '">
									
						<i class="bi bi-building"> Zurück zur Übersicht</i>
						</button>';

				}
		
		} else {
				echo '<div class="container rounded bg-white">'; 
				

				print_result("Keine Rezensionen verfügbar", False);
				
				
				
				echo '<br>

				<button type="button" data-bs-toggle="modal" title="Universitäten" class="btn btn-primary_active" onclick="location.href = ';
						
				echo "'https://web06.iis.uni-bamberg.de/WIP/wip2122_g3/universities.php'";
				
				echo '">
							
				<i class="bi bi-building"> Zurück zur Übersicht</i>
				</button>
	
				</div>'; 
		}
	}


	?>


