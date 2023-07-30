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
                    if(isset($_GET['edit'])) {
                        try{
                            $path = "uploads/images/".$_SESSION['lastname']."_".$_SESSION['PersonID'].".png";
                            $db = db_connection();
                            $statement = $db->prepare("UPDATE UniMember SET ProfileImage = ? WHERE PersonID = ?");
                            $statement->execute(array($path, $_SESSION['PersonID']));
                            print_result("Profilbild wurde erfolgreich hinzugefügt", True);
                        }catch(PDOException $exception){
                            print_result("An Error occured: ".$exception->getMessage(), False);
                        }
                    }
                ?>
                <div class="container rounded bg-white">
                	<h4>Profilbild hochladen (optional)</h4>
                	<div class="alert alert-warning alert-dismissible fade show">
                	<i class="bi bi-info-circle-fill"></i> Nur Bilder mit dem Dateinamen <span class="badge rounded-pill bg-warning text-dark"><?php echo $_SESSION['lastname'].'_'.$_SESSION['PersonID'] ?>.png</span> werden dargestellt!</div>
                    <form id="uploadimages" enctype="multipart/form-data">	
                		<div style="display: flex" class="mb-3">
                	        <input class="form-control upload" id="files" type="file" name="files[]"> <button style="margin-right: 5px" class="btn btn-sm btn-success" type="submit" name="submit">Hochladen</button> 	<div id="result"></div>
                        </div>
                    </form>
                    <form action="?edit=1" method="post">
                        <button class="btn btn-primary" type="submit">Speichern</button> <i class="bi bi-exclamation-circle-fill hint"> Nur Bilder bis 2 MB sind erlaubt!</i></form>

                <script>
                	// file upload
                	const url = "uploadimg.php";
                	const form = document.querySelector("#uploadimages");
                    // Ein EventListener wartet auf das submit
                    form.addEventListener ("submit", function (evt) {
                    evt.preventDefault ();
                    const files = document.querySelector('[type=file]').files;
                    const formData = new FormData();
                    
                    for (let i = 0; i < files.length; i++) {
                    	let file = files[i];
                    	formData.append('images[]', file)
                    }
                
                    fetch (url, {
                    	method: "POST",
                    	body: formData,
                    }).then ((response) => {
                    	console.log (response);
                    	if (response.status === 200) {
                    		document.querySelector("#result").innerHTML = "Bild wurde gesendet, bitte speichern.";
                    	}
                    });
                });
                </script>
                </div>
            </div>
        </div>
    </div>
</div>
