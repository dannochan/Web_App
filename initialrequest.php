<?php
session_start();
if(!isset($_SESSION['userid'])) {
	header('Location: login.php');
}

include('config/DBConnection.php');

$page = "apply";

?>

<?php include("webElements/header.php"); ?>

<?php 
    if (isset($_POST['save'])){
        if(save_data()) {        
			echo '<script>
			setTimeout(function() {
				swal.fire({
					title: "Einreichen erfolgreich!",
					text: "Dein initialer Antrag wurde erfolgreich eingereicht.",
					icon: "success"
				}, );
			}, 300);
			setTimeout(function() {
				window.location.href = "initialrequest.php";
			}, 2500);
		</script>';
        } else {
			echo '<script>
			setTimeout(function() {
				swal.fire({
					title: "Einreichen gescheitert!",
					text: "Beim Einreichen deines initialen Antrags ist ein Fehler aufgetreten.",
					icon: "error"
				}, );
			}, 300);
			setTimeout(function() {
				window.location.href = "initialrequest.php";
			}, 2500);
		</script>';    
		}
	}
?>
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

									<!-- initialer Antrag -->
                      

                                    <div class="container rounded bg-white">

	    <form method="POST" class="needs-validation" novalidate >
            <h4>Initialer Antrag</h4>
<br>
                <h5>Persönliche Daten</h5>

                <label>Vorname: </label>
                <div class="col">
	                <input class="form-control" pattern="[a-zA-ZÄÖÜäöüß]+" value="<?php echo $_SESSION['firstname'] ?>" required="" type="text" name="firstname">
                    <div class="invalid-feedback">
							Bitte ausfüllen!
                            </div>
	            </div>

                <label>Nachname: </label>
	            <div class="col">
	                <input class="form-control" pattern="[a-zA-ZÄÖÜäöüß]+" value="<?php echo $_SESSION['lastname'] ?>" required="" type="text" name="lastname">
                    <div class="invalid-feedback">
							Bitte ausfüllen!
                            </div>
                </div>    

                <label>Geschlecht: </label>               
                <div class="col">
	            	<select class="form-select" required="" name="gender">
                    <option disabled selected="selected" value="">Bitte wählen</option>
	            	    <option value="weiblich">weiblich</option>
	            	    <option value="männlich">männlich</option>
	            	    <option value="divers">divers</option>
	            	</select>
                    <div class="invalid-feedback">
							Bitte auswählen!
                            </div>
                </div>       

    <!-- wird momentan unten nicht an DB weitergeleitet -->
                <label>Matrikelnummer: </label>
	            <div class="col">
	                <input class="form-control" pattern="[0-9]+" value="<?php echo $_SESSION['matriculation'] ?>" required="" type="text" name="MatriculationNumber" disabled>
                    <div class="invalid-feedback">
							Bitte ausfüllen!
                            </div>
                </div>

                <label>Geburtsdatum: </label>
                <div class="col">
	                <input class="form-control" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" id="datepicker" value="<?php echo $_SESSION['birthdate'] ?>" required="" type="text" name="BirthDate">
                    <div class="invalid-feedback">
							Bitte ausfüllen!
                            </div>
	            </div>

                <label>Geburtsort: </label>
	            <div class="col">
	                <input class="form-control"  required="" type="text" name="BirthLocation">
                    <div class="invalid-feedback">
							Bitte ausfüllen!
                            </div>
                </div>


                <label>Geburtsland: </label>               
                <div class="col">
                    <select class="form-select" required="" name="BirthCountry">
                        <option disabled selected="selected" value="">Bitte wählen</option>
	                    <option value="Afghanistan">Afghanistan</option>
	                    <option value="Akrotiri und Dhekelia">Akrotiri und Dhekelia</option>
	                    <option value="Albanien">Albanien</option>
	                    <option value="Algerien">Algerien</option>
                        <option value="Amerikanisch-Samoa">Amerikanisch-Samoa</option>
                        <option value="Amerikanische Jungferninseln">Amerikanische Jungferninseln</option>
                        <option value="Andorra">Andorra</option>
                        <option value="Angola">Angola</option>
                        <option value="Anguilla">Anguilla</option>
                        <option value="Antigua und Barbuda">Antigua und Barbuda</option>
                        <option value="Argentinien">Argentinien</option>
                        <option value="Argentinische Antarktis">Argentinische Antarktis</option>
                        <option value="Armenien">Armenien</option>
                        <option value="Aruba">Aruba</option>
                        <option value="Aserbaidschan">Aserbaidschan</option>
                        <option value="Ashmore- und Cartierinseln">Ashmore- und Cartierinseln</option>
                        <option value="Australien">Australien</option>
                        <option value="Australisches Antarktis-Territorium">Australisches Antarktis-Territorium</option>
                        <option value="Åland">Åland</option>
                        <option value="Ägypten">Ägypten</option>
                        <option value="Äquatorialguinea">Äquatorialguinea</option>
                        <option value="Äthiopien">Äthiopien</option>
                        <option value="Bahamas">Bahamas</option>
                        <option value="Bahrain">Bahrain</option>
                        <option value="Bangladesch">Bangladesch</option>
                        <option value="Bardbados">Bardbados</option>
                        <option value="Belgien">Belgien</option>
                        <option value="Belize">Belize</option>
                        <option value="Benin">Benin</option>
                        <option value="Bermuda">Bermuda</option>
                        <option value="Bhutan">Bhutan</option>
                        <option value="Bolivien">Bolivien</option>
                        <option value="Bonaire, Saba, St. Eustatius">Bonaire, Saba, St. Eustatius</option>
                        <option value="Bosnien und Herzegowina">Bosnien und Herzegowina</option>
                        <option value="Botsuana">Botsuana</option>
                        <option value="Bouvetinseln">Bouvetinseln</option>
                        <option value="Braslilien">Braslilien</option>
                        <option value="Britische Jungferninseln">Britische Jungerferninseln</option>
                        <option value="Britisches Überseegebiet">Britisches Überseegebiet</option>
                        <option value="Britisches Antarktis-Territorium">Britisches Antarktis-Territorium</option>
                        <option value="Britisches Territorium im indischen Ozean">Britisches Territorium im indischen Ozean</option>
                        <option value="Brunei Darussalem">Brunei Darussalem</option>
                        <option value="Bulgarien">Bulgarien</option>
                        <option value="Burkina Faso">Burkina Faso</option>
                        <option value="Burundi">Burundi</option>
                        <option value="Chile">Chile</option>
                        <option value="Chilenische Antarktis">Chilenische Antarktis</option>
                        <option value="China">China</option>
                        <option value="Clipperton">Clipperton</option>
                        <option value="Cookinseln">Cookinseln</option>
                        <option value="Costa Rica">Costa Rica</option>
                        <option value="Côte d'Ivoire">Côte d'Ivoire</option>
                        <option value="Curaçao">Curaçao</option>
                        <option value="Dänemark">Dänkemark</option>
                        <option value="Deutschland">Deutschland</option>
                        <option value="Dominica">Dominica</option>
                        <option value="Dominikanische Republik">Dominikanische Republik</option>
                        <option value="Dschibuti">Dschibuti</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="El Salvador">El Salvador</option>
                        <option value="Eritrea">Eritrea</option>
                        <option value="Estland">Estland</option>
                        <option value="Falklandinseln">Falklandinseln</option>
                        <option value="Färöer">Färöer></option>
                        <option value="Fidschi">Fidschi</option>
                        <option value="Finnland">Finnland</option>
                        <option value="Frankreich">Frankreich</option>
                        <option value="Französisch-Guayana">Französisch-Guayana</option>
                        <option value="Französisch-Polynesien">Französisch-Polynesien</option>
                        <option value="Französische Süd- und Antarktisgebiete">Französische Süd- und Antarktisgebiete</option>
                        <option value="Gabun">Gabun</option>
                        <option value="Gambia">Gambia</option>
                        <option value="Georgien">Georgien</option>
                        <option value="Ghana">Ghana</option>
                        <option value="Gibraltar">Gibraltar</option>
                        <option value="Grenada">Grenada</option>
                        <option value="Griechenland">Griechenland</option>
                        <option value="Grönland">Grönland</option>
                        <option value="Guadeloupe">Guadeloupe</option>
                        <option value="Guam">Guam</option>
                        <option value="Guatemala">Guatemala</option>
                        <option value="Guernsey">Guernsey<option>
                        <option value="Guinea">Guinea</option>
                        <option value="Guinea-Bissau">Guinea-Bissau</option>
                        <option value="Guyana">Guyana</option>
                        <option value="Haiti">Haiti</option>
                        <option value="Heard und McDonaldinseln">Heard und McDonaldinseln</option>
                        <option value="Honduras">Honduras</option>
                        <option value="Hongkong">Hongkong</option>
                        <option value="Indien">Indien</option>
                        <option value="Indonesien">Indonesien</option>
                        <option value="Insel Man">Insel Man</option>
                        <option value="Irak">Irak</option>
                        <option value="Iran">Iran</option>
                        <option value="Irland">Irland</option>
                        <option value="Island">Island</option>
                        <option value="Israel">Israel</option>
                        <option value="Italien">Italien</option>
                        <option value="Jamaika">Jamaika</option>
                        <option value="Japan">Japan</option>
                        <option value="Jemen">Jemen</option>
                        <option value="Jersey">Jersey</option>
                        <option value="Jordanien">Jordanien</option>
                        <option value="Kaimaninseln">Kaimaninseln</option>
                        <option value="Kambodscha">Kambodscha</option>
                        <option value="Kamerun">Kamerun</option>
                        <option value="Kanada">Kanada</option>
                        <option value="Kasachstan">Kasachstan</option>
                        <option value="Katar">Katar</option>
                        <option value="Kenia">Kenia</option>
                        <option value="Kirgistan">Kirgistan</option>
                        <option value="Kiribati">Kiribati</option>
                        <option value="Kokosinseln">Kokosinseln</option>
                        <option value="Kolumbien">Kolumbien</option>
                        <option value="Komoren">Komoren</option>
                        <option value="Kongo">Kongo</option>
                        <option value="Korallenmeerinseln">Korallenmeerinseln</option>
                        <option value="Korea">Korea</option>
                        <option value="Kosovo">Kosovo</option>
                        <option value="Kroatien">Kroatien</option>
                        <option value="Kuba">Kuba</option>
                        <option value="Kuwait">Kuwait</option>
                        <option value="Laos">Laos</option>
                        <option value="Lesotho">Lesotho</option>
                        <option value="Lettland">Lettland</option>
                        <option value="Libanon">Libanon</option>
                        <option value="Liberia">Liberia</option>
                        <option value="Libyen">Libyen</option>
                        <option value="Liechtenstein">Liechtenstein</option>
                        <option value="Litauen">Litauen</option>
                        <option value="Luxemburg">Luxemburg</option>
                        <option value="Macau">Macau</option>
                        <option value="Madagaskar">Madagaskar</option>
                        <option value="Malawi">Malawi</option>
                        <option value="Malaysia">Malaysia</option>
                        <option value="Malediven">Malediven</option>
                        <option value="Mali">Mali</option>
                        <option value="Malta">Malta</option>
                        <option value="Marokko">Marokko</option>
                        <option value="Marshallinseln">Marshallinseln</option>
                        <option value="Martinique">Martinique</option>
                        <option value="Mauretanien">Mauretanien</option>
                        <option value="Mauritius">Mauritius</option>
                        <option value="Mayotte">Mayotte</option>
                        <option value="Mazedonien">Mazedonien</option>
                        <option value="Mexiko">Mexiko</option>
                        <option value="Mikronesien">Mikronesien</option>
                        <option value="Moldau">Moldau</option>
                        <option value="Monaco">Monaco</option>
                        <option value="Mongolei">Mongolei</option>
                        <option value="Montenegro">Montenegro</option>
                        <option value="Montserrat">Monserrat</option>
                        <option value="Mosambik">Mosambik</option>
                        <option value="Myanmar">Myanmar</option>
                        <option value="Namibia">Namibia</option>
                        <option value="Nauru">Nauru</option>
                        <option value="Navassa">Navassa</option>
                        <option value="Nepal">Nepal</option>
                        <option value="Neukaledonien">Neukaledonien</option>
                        <option value="Neuseeland">Neuseeland</option>
                        <option value="Neuseelädnische Antarktis">Neuseelädnische Antarktis</option>
                        <option value="Nicaragua">Nicaragua</option>
                        <option value="Niederlande">Niederlande</option>
                        <option value="Niger">Niger</option>
                        <option value="Nigeria">Nigeria</option>
                        <option value="Niue">Niue</option>
                        <option value="Norfolkinseln">Norfolkinseln</option>
                        <option value="Norwegen">Norwegen</option>
                        <option value="Norwegisches Antarktis-Territorium">Norwegisches Antarktis-Territorium</option>
                        <option value="Oman">Oman</option>
                        <option value="Österreich">Österreich</option>
                        <option value="Pakistan">Pakistan</option>
                        <option value="Palau">Palau</option>
                        <option value="Palästinenische Gebiete">Palästinenische Gebiete</option>
                        <option value="Panama">Panama</option>
                        <option value="Papua-Neuginea">Papua-Neuginea</option>
                        <option value="Paraguay">Paraguay</option>
                        <option value="Peru">Peru</option>
                        <option value="Philippinen">Philippinen</option>
                        <option value="Pitcairinseln">Pitcairinseln</option>
                        <option value="Polen">Polen</option>
                        <option value="Portugal">Portugal</option>
                        <option value="Puerto Rico">Puerto Rico</option>
                        <option value="Réunion">Réunion</option>
                        <option value="Ruanda">Ruanda</option>
                        <option value="Rumänien">Rumänien</option>
                        <option value="Russland">Russland</option>
                        <option value="Salomonen">Salomonen</option>
                        <option value="Sambia">Sambia</option>
                        <option value="Samoa">Samoa</option>
                        <option value="San Marino">San Marino</option>
                        <option value="Saudi-Arabien">Saudi-Arabien</option>
                        <option value="São Tomé und Príncipe">São Tomé und Príncipe</option>
                        <option value="Schweden">Schweden</option>
                        <option value="Schweiz">Schweiz</option>
                        <option value="Senegal">Senegal</option>
                        <option value="Serbien">Serbien</option>
                        <option value="Seychellen">Seychellen</option>
                        <option value="Sierra Leone">Sierra Leone</option>
                        <option value="Simbabwe">Simbabwe</option>
                        <option value="Singapur">Singapur</option>
                        <option value="Slowakei">Slowakei</option>
                        <option value="Slowenien">Slowenien</option>
                        <option value="Somalia">Somalia</option>
                        <option value="Spanien">Spanien</option>
                        <option value="Sri Lanka">Sri Lanka</option>
                        <option value="St. Kitts und Nevis">St. Kitts und Nevis</option>
                        <option value="St. Lucia">St. Lucia</option>
                        <option value="St. Vincent und die Grenadinen">St. Vincent und die Grenadinen</option>
                        <option value="Sudan">Sudan</option>
                        <option value="Suriname">Suriname</option>
                        <option value="Südafrika">Südafrika</option>
                        <option value="Südsudan">Südafrika</option>
                        <option value="Swasiland">Südafrika</option>
                        <option value="Syrien">Syrien</option>
                        <option value="Tadschikistan">Tadschikistan</option>
                        <option value="Taiwan">Taiwan</option>
                        <option value="Tansania">Tansania</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Timor-Leste">Timor-Leste</option>
                        <option value="Togo">Togo</option>
                        <option value="Tokelau">Tokelau</option>
                        <option value="Tonga">Tonga</option>
                        <option value="Trinidad und Tobago">Trinidad und Tobago</option>
                        <option value="Tschad">Tschad</option>
                        <option value="Tschechische Republik">Tschechische Republik</option>
                        <option value="Tunesien">Tunesien</option>
                        <option value="Turkmenistan">Turkmenistan</option>
                        <option value="Tuvalu">Tuvalu</option>
                        <option value="Türkei">Türkei</option>
                        <option value="Uganda">Uganda</option>
                        <option value="Ukraine">Ukraine</option>
                        <option value="Ungarn">Ungarn</option>
                        <option value="Uruguay">Uruguay</option>
                        <option value="Usbekistan">Usbekistan</option>
                        <option value="Vanuatu">Vanuatu</option>
                        <option value="Vatikanstadt">Vatikanstadt</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="Vereinigte Arabische Emirate">Vereinigte Arabische Emirate</option>
                        <option value="Vereinigte Staaten">Vereinigte Staaten</option>
                        <option value="Vereinigtes Königreich">Vereinigtes Königreich</option>
                        <option value="Vietnam">Vietnam</option>
                        <option value="Wallis und Futuna">Wallis und Futuna</option>
                        <option value="Weihnachtsinseln">Weihnachtsinseln</option>
                        <option value="Weißrussland">Weißrussland</option>
                        <option value="Westsahara">Westsahara</option>
                        <option value="Zentralafrikanische Republik">Zentralafrikanische Republik</option>
                        <option value="Zypern">Zypern</option>
				    </select>
                    <div class="invalid-feedback">
							Bitte auswählen!
                            </div>
                    </div>
			

                <label>Staatsangehörigkeit 1: </label>               
                <div class="col">
                    <select class="form-select" required="" name="nationality1">
                        <option disabled selected="selected" value="">Bitte wählen</option>
					    <option value="afghanisch">afghanisch</option>
					    <option value="albanisch">albanisch</option>
					    <option value="algerisch">algerisch</option>
                        <option value="amerikanisch">amerikanisch</option>
                        <option value="andorranisch">andorranisch</option>
                        <option value="angolanisch">angolanisch</option>
                        <option value="anguillanisch">anguillanisch</option>
                        <option value="argentinisch">argentinisch</option>
                        <option value="armenisch">armenisch</option>
                        <option value="aserbaidschanisch">aserbaidschanisch</option>
                        <option value="australisch">australisch</option>
                        <option value="ägyptisch">ägyptisch</option>
                        <option value="äuatorialguineisch">äquatorialguineisch</option>
                        <option value="äthiopisch">äthiopisch</option>
                        <option value="bahamaisch">bahamaisch</option>
                        <option value="bahrainisch">bahrainisch</option>
                        <option value="bangladeschisch">bangladeschisch</option>
                        <option value="bardbadisch">bardbadisch</option>
                        <option value="belgisch">belgisch</option>
                        <option value="belizisch">belizisch</option>
                        <option value="beninisch">beninisch</option>
                        <option value="bhutanisch">bhutanisch</option>
                        <option value="bolivianisch">bolivianisch</option>
                        <option value="bosnisch-herzegowinisch">bosnisch-herzegowinisch</option>
                        <option value="botsuanisch">botsuanisch</option>
                        <option value="braslilisch">braslilisch</option>
                        <option value="britisch">britisch</option>
                        <option value="britisch (BOTC)">britisch (BOTC)</option>
                        <option value="bruneiisch">bruneiisch</option>
                        <option value="bulgarisch">bulgarisch</option>
                        <option value="burkinisch">burkinisch</option>
                        <option value="burundisch">burundisch</option>
                        <option value="chilenisch">chilenisch</option>
                        <option value="chinesisch">chinesisch</option>
                        <option value="chinesisch (Hongkong)">chinesisch (Hongkong) </option>
                        <option value="chinesisch (Macau)">chinesisch (Macau)</option>
                        <option value="costa-ricanisch">costa-ricanisch</option>
                        <option value="dänisch">dänisch</option>
                        <option value="deutsch">deutsch</option>
                        <option value="dominicanisch">dominicanisch</option>
                        <option value="dominikanisch">dominikanisch</option>
                        <option value="dschibutisch">dschibutisch</option>
                        <option value="ecuadorianisch">ecuadorianisch</option>
                        <option value="eritreisch">eritreisch</option>
                        <option value="estnisch">estnisch</option>
                        <option value="fidschianisch">fidschianisch</option>
                        <option value="finnisch">finnisch</option>
                        <option value="französisch">französisch</option>
                        <option value="gabunisch">gabunisch</option>
                        <option value="gambisch">gambisch</option>
                        <option value="georgisch">georgisch</option>
                        <option value="ghanaisch">ghanaisch</option>
                        <option value="grenadisch">grenadisch</option>
                        <option value="griechisch">griechisch</option>
                        <option value="grönlandisch">grönländisch</option>
                        <option value="guatemaltekisch">guatemaltekisch</option>
                        <option value="guineisch">guineisch</option>
                        <option value="guinea-bissauisch">guinea-bissauisch</option>
                        <option value="guyanisch">guyanisch</option>
                        <option value="haitianisch">haitianisch</option>
                        <option value="honduranisch">honduranisch</option>
                        <option value="indisch">indisch</option>
                        <option value="indonesisch">indonesisch</option>
                        <option value="irakisch">irakisch</option>
                        <option value="iranisch">iranisch</option>
                        <option value="irisch">irisch</option>
                        <option value="isländisch">isländisch</option>
                        <option value="israelisch">israelisch</option>
                        <option value="italienisch">italienisch</option>
                        <option value="ivorisch">ivorisch</option>
                        <option value="jamaikanisch">jamaikanisch</option>
                        <option value="japanisch">japaisch</option>
                        <option value="jemenitisch">jemenitisch</option>>
                        <option value="jordanisch">jordanisch</option>
                        <option value="kambodschanisch">kambodschanisch</option>
                        <option value="kamerunisch">kamerunisch</option>
                        <option value="kanadisch">kanadisch</option>
                        <option value="kasachisch">kasachisch</option>
                        <option value="katarisch">katarisch</option>
                        <option value="kenianisch">kenianisch</option>
                        <option value="kirgisisch">kirgisisch</option>
                        <option value="kiribatisch">kiribatisch</option>
                        <option value="kolumbianisch">kolumbianisch</option>
                        <option value="komorisch">komorisch</option>
                        <option value="kongolesisch">kongolesisch</option>
                        <option value="koreanisch">koreanisch</option>
                        <option value="kosovarisch">kosovarisch</option>
                        <option value="kroatisch">kroatisch</option>
                        <option value="kubanisch">kubanisch</option>
                        <option value="kuwaitisch">kuwaitisch</option>
                        <option value="laotisch">laotisch</option>
                        <option value="lesothisch">lesothisch</option>
                        <option value="lettisch">lettisch</option>
                        <option value="libanesisch">libanisch</option>
                        <option value="liberianisch">liberianisch</option>
                        <option value="libysch">libysch</option>
                        <option value="liechtensteinisch">liechtensteinisch</option>
                        <option value="litauisch">litauisch</option>
                        <option value="luxemburgisch">luxemburgisch</option>
                        <option value="madagassisch">madagassisch</option>
                        <option value="malawisch">malawisch</option>
                        <option value="malaysisch">malaysisch</option>
                        <option value="maledivisch">maledivisch</option>
                        <option value="malisch">malisch</option>
                        <option value="maltaesisch">maltaesisch</option>
                        <option value="marokkoanisch">marokkoanisch</option>
                        <option value="marshallisch">marshallisch</option>
                        <option value="mauretanisch">mauretanisch</option>
                        <option value="mauritisch">mauritisch</option>
                        <option value="mazedonisch">mazedonisch</option>
                        <option value="mexikanisch">mexikanisch</option>
                        <option value="mikronesisch">mikronesisch</option>
                        <option value="moldauisch">moldauisch</option>
                        <option value="monegassisch">monegassisch</option>
                        <option value="mongolisch">mongolisch</option>
                        <option value="montenegrinisch">montenegrinisch</option>
                        <option value="mosambikanisch">mosambikanisch</option>
                        <option value="myanmarisch">myanmarisch</option>
                        <option value="namibisch">namibisch</option>
                        <option value="nauruisch">nauruisch</option>
                        <option value="nepalesisch">nepalesisch</option>
                        <option value="neuseeländisch">neuseeländisch</option>
                        <option value="nicaraguanisch">nicaraguanisch</option>
                        <option value="niederländisch">niederländisch</option>
                        <option value="nigerianisch">nigeriansch</option>
                        <option value="nigrisch">nigrisch</option>
                        <option value="norwegisch">norwegisch</option>
                        <option value="omanisch">omanisch</option>
                        <option value="österreichisch">österreichisch</option>
                        <option value="pakistanisch">pakistanisch</option>
                        <option value="palauisch">palauisch</option>
                        <option value="panamaisch">panamaisch</option>
                        <option value="papua-neugineisch">papua-neugineisch</option>
                        <option value="paraguayisch">paraguayisch</option>
                        <option value="peruanisch">peruanisch</option>
                        <option value="philippinisch">philippinisch</option>
                        <option value="polnisch">polnisch</option>
                        <option value="portugiesisch">portugiesisch</option>
                        <option value="ruandisch">ruandisch</option>
                        <option value="rumänisch">rumänisch</option>
                        <option value="russisch">russisch</option>
                        <option value="salomonisch">salomonisch</option>
                        <option value="salvadirianisch">salvadorianisch</option>
                        <option value="sambisch">sambisch</option>
                        <option value="samoanisch">samoanisch</option>
                        <option value="san-marinesisch">san-marinesisch</option>
                        <option value="saudi-arabisch">saudi-arabisch </option>
                        <option value="são-toméisch">são-toméisch</option>
                        <option value="schwedisch">schwedisch</option>
                        <option value="schweizerisch">schweizerisch</option>
                        <option value="senegalesisch">senegalesisch</option>
                        <option value="serbisch">serbisch</option>
                        <option value="seychellisch">seychellisch</option>
                        <option value="sierra-leonisch">sierra-leonisch</option>
                        <option value="simbabwisch">simbabwisch</option>
                        <option value="singapurisch">singapurisch</option>
                        <option value="slowakisch">slowakisch</option>
                        <option value="slowenisch">slowenisch</option>
                        <option value="somalisch">somalisch</option>
                        <option value="spanisch">spanisch</option>
                        <option value="sri-lankisch">sri-lankisch</option>
                        <option value="sudanesisch">sudanesisch</option>
                        <option value="surinamisch">surinamisch</option>
                        <option value="südafrikanisch">südafrikanisch</option>
                        <option value="südsudanesisch">südsudanesisch</option>
                        <option value="swasiländisch">swasiländisch</option>
                        <option value="syrisch">syrisch</option>
                        <option value="tadschikisch">tadschikisch</option>
                        <option value="taiwanisch">taiwanisch</option>
                        <option value="tansanisch">tansanisch</option>
                        <option value="thailändisch">thailändisch</option>
                        <option value="togoisch">togoisch</option>
                        <option value="tongaisch">tongaisch</option>
                        <option value="tschadisch">tschadisch</option>
                        <option value="tschechisch">tschechisch</option>
                        <option value="tunesisch">tunesisch</option>
                        <option value="turkmenisisch">turkmenisch</option>
                        <option value="tuvaluisch">tuvaluisch</option>
                        <option value="türkisch">türkisch</option>
                        <option value="ugandisch">ugandisch</option>
                        <option value="ukrainisch">ukrainisch</option>
                        <option value="ungarisch">ungarisch</option>
                        <option value="uruguayisch">uruguayisch</option>
                        <option value="usbekisch">usbekisch</option>
                        <option value="vanuatuisch">vanuatuisch</option>
                        <option value="venezuelanisch">venezuelanisch</option>
                        <option value="vietnamesisch">vietnamesisch</option>
                        <option value="vincentisch">vincentisch</option>
                        <option value="von Serbien und Montenegro">von Serbien und Montenegro</option>
                        <option value="von St. Kitts und Nevis">von St. Kitts und Nevis</option>
                        <option value="von Timor-Leste">von Timor-Leste</option>
                        <option value="von Trinidad und Tobago">von Trinidad und Tobago</option>
                        <option value="weißrussisch">weißrussisch</option>
                        <option value="rentralafrikanisch">zentralafrikanisch</option>
                        <option value="zyprisch">zyprisch</option>
				    </select>
                    <div class="invalid-feedback">
							Bitte auswählen!
                            </div>
                </div>


                <label>Staatsangehörigkeit 2: </label>               
                <div class="col">
		            <select class="form-select" name="nationality2">
                    <option disabled selected="selected" value="">Bitte wählen</option>
                    <option value="-">-</option>
					    <option value="afghanisch">afghanisch</option>
					    <option value="albanisch">albanisch</option>
					    <option value="algerisch">algerisch</option>
                        <option value="amerikanisch">amerikanisch</option>
                        <option value="andorranisch">andorranisch</option>
                        <option value="angolanisch">angolanisch</option>
                        <option value="anguillanisch">anguillanisch</option>
                        <option value="argentinisch">argentinisch</option>
                        <option value="armenisch">armenisch</option>
                        <option value="aserbaidschanisch">aserbaidschanisch</option>
                        <option value="australisch">australisch</option>
                        <option value="ägyptisch">ägyptisch</option>
                        <option value="äuatorialguineisch">äquatorialguineisch</option>
                        <option value="äthiopisch">äthiopisch</option>
                        <option value="bahamaisch">bahamaisch</option>
                        <option value="bahrainisch">bahrainisch</option>
                        <option value="bangladeschisch">bangladeschisch</option>
                        <option value="bardbadisch">bardbadisch</option>
                        <option value="belgisch">belgisch</option>
                        <option value="belizisch">belizisch</option>
                        <option value="beninisch">beninisch</option>
                        <option value="bhutanisch">bhutanisch</option>
                        <option value="bolivianisch">bolivianisch</option>
                        <option value="bosnisch-herzegowinisch">bosnisch-herzegowinisch</option>
                        <option value="botsuanisch">botsuanisch</option>
                        <option value="braslilisch">braslilisch</option>
                        <option value="britisch">britisch</option>
                        <option value="britisch (BOTC)">britisch (BOTC)</option>
                        <option value="bruneiisch">bruneiisch</option>
                        <option value="bulgarisch">bulgarisch</option>
                        <option value="burkinisch">burkinisch</option>
                        <option value="burundisch">burundisch</option>
                        <option value="chilenisch">chilenisch</option>
                        <option value="chinesisch">chinesisch</option>
                        <option value="chinesisch (Hongkong)">chinesisch (Hongkong) </option>
                        <option value="chinesisch (Macau)">chinesisch (Macau)</option>
                        <option value="costa-ricanisch">costa-ricanisch</option>
                        <option value="dänisch">dänisch</option>
                        <option value="deutsch">deutsch</option>
                        <option value="dominicanisch">dominicanisch</option>
                        <option value="dominikanisch">dominikanisch</option>
                        <option value="dschibutisch">dschibutisch</option>
                        <option value="ecuadorianisch">ecuadorianisch</option>
                        <option value="eritreisch">eritreisch</option>
                        <option value="estnisch">estnisch</option>
                        <option value="fidschianisch">fidschianisch</option>
                        <option value="finnisch">finnisch</option>
                        <option value="französisch">französisch</option>
                        <option value="gabunisch">gabunisch</option>
                        <option value="gambisch">gambisch</option>
                        <option value="georgisch">georgisch</option>
                        <option value="ghanaisch">ghanaisch</option>
                        <option value="grenadisch">grenadisch</option>
                        <option value="griechisch">griechisch</option>
                        <option value="grönlandisch">grönländisch</option>
                        <option value="guatemaltekisch">guatemaltekisch</option>
                        <option value="guineisch">guineisch</option>
                        <option value="guinea-bissauisch">guinea-bissauisch</option>
                        <option value="guyanisch">guyanisch</option>
                        <option value="haitianisch">haitianisch</option>
                        <option value="honduranisch">honduranisch</option>
                        <option value="indisch">indisch</option>
                        <option value="indonesisch">indonesisch</option>
                        <option value="irakisch">irakisch</option>
                        <option value="iranisch">iranisch</option>
                        <option value="irisch">irisch</option>
                        <option value="isländisch">isländisch</option>
                        <option value="israelisch">israelisch</option>
                        <option value="italienisch">italienisch</option>
                        <option value="ivorisch">ivorisch</option>
                        <option value="jamaikanisch">jamaikanisch</option>
                        <option value="japanisch">japaisch</option>
                        <option value="jemenitisch">jemenitisch</option>>
                        <option value="jordanisch">jordanisch</option>
                        <option value="kambodschanisch">kambodschanisch</option>
                        <option value="kamerunisch">kamerunisch</option>
                        <option value="kanadisch">kanadisch</option>
                        <option value="kasachisch">kasachisch</option>
                        <option value="katarisch">katarisch</option>
                        <option value="kenianisch">kenianisch</option>
                        <option value="kirgisisch">kirgisisch</option>
                        <option value="kiribatisch">kiribatisch</option>
                        <option value="kolumbianisch">kolumbianisch</option>
                        <option value="komorisch">komorisch</option>
                        <option value="kongolesisch">kongolesisch</option>
                        <option value="koreanisch">koreanisch</option>
                        <option value="kosovarisch">kosovarisch</option>
                        <option value="kroatisch">kroatisch</option>
                        <option value="kubanisch">kubanisch</option>
                        <option value="kuwaitisch">kuwaitisch</option>
                        <option value="laotisch">laotisch</option>
                        <option value="lesothisch">lesothisch</option>
                        <option value="lettisch">lettisch</option>
                        <option value="libanesisch">libanisch</option>
                        <option value="liberianisch">liberianisch</option>
                        <option value="libysch">libysch</option>
                        <option value="liechtensteinisch">liechtensteinisch</option>
                        <option value="litauisch">litauisch</option>
                        <option value="luxemburgisch">luxemburgisch</option>
                        <option value="madagassisch">madagassisch</option>
                        <option value="malawisch">malawisch</option>
                        <option value="malaysisch">malaysisch</option>
                        <option value="maledivisch">maledivisch</option>
                        <option value="malisch">malisch</option>
                        <option value="maltaesisch">maltaesisch</option>
                        <option value="marokkoanisch">marokkoanisch</option>
                        <option value="marshallisch">marshallisch</option>
                        <option value="mauretanisch">mauretanisch</option>
                        <option value="mauritisch">mauritisch</option>
                        <option value="mazedonisch">mazedonisch</option>
                        <option value="mexikanisch">mexikanisch</option>
                        <option value="mikronesisch">mikronesisch</option>
                        <option value="moldauisch">moldauisch</option>
                        <option value="monegassisch">monegassisch</option>
                        <option value="mongolisch">mongolisch</option>
                        <option value="montenegrinisch">montenegrinisch</option>
                        <option value="mosambikanisch">mosambikanisch</option>
                        <option value="myanmarisch">myanmarisch</option>
                        <option value="namibisch">namibisch</option>
                        <option value="nauruisch">nauruisch</option>
                        <option value="nepalesisch">nepalesisch</option>
                        <option value="neuseeländisch">neuseeländisch</option>
                        <option value="nicaraguanisch">nicaraguanisch</option>
                        <option value="niederländisch">niederländisch</option>
                        <option value="nigerianisch">nigeriansch</option>
                        <option value="nigrisch">nigrisch</option>
                        <option value="norwegisch">norwegisch</option>
                        <option value="omanisch">omanisch</option>
                        <option value="österreichisch">österreichisch</option>
                        <option value="pakistanisch">pakistanisch</option>
                        <option value="palauisch">palauisch</option>
                        <option value="panamaisch">panamaisch</option>
                        <option value="papua-neugineisch">papua-neugineisch</option>
                        <option value="paraguayisch">paraguayisch</option>
                        <option value="peruanisch">peruanisch</option>
                        <option value="philippinisch">philippinisch</option>
                        <option value="polnisch">polnisch</option>
                        <option value="portugiesisch">portugiesisch</option>
                        <option value="ruandisch">ruandisch</option>
                        <option value="rumänisch">rumänisch</option>
                        <option value="russisch">russisch</option>
                        <option value="salomonisch">salomonisch</option>
                        <option value="salvadirianisch">salvadorianisch</option>
                        <option value="sambisch">sambisch</option>
                        <option value="samoanisch">samoanisch</option>
                        <option value="san-marinesisch">san-marinesisch</option>
                        <option value="saudi-arabisch">saudi-arabisch </option>
                        <option value="são-toméisch">são-toméisch</option>
                        <option value="schwedisch">schwedisch</option>
                        <option value="schweizerisch">schweizerisch</option>
                        <option value="senegalesisch">senegalesisch</option>
                        <option value="serbisch">serbisch</option>
                        <option value="seychellisch">seychellisch</option>
                        <option value="sierra-leonisch">sierra-leonisch</option>
                        <option value="simbabwisch">simbabwisch</option>
                        <option value="singapurisch">singapurisch</option>
                        <option value="slowakisch">slowakisch</option>
                        <option value="slowenisch">slowenisch</option>
                        <option value="somalisch">somalisch</option>
                        <option value="spanisch">spanisch</option>
                        <option value="sri-lankisch">sri-lankisch</option>
                        <option value="sudanesisch">sudanesisch</option>
                        <option value="surinamisch">surinamisch</option>
                        <option value="südafrikanisch">südafrikanisch</option>
                        <option value="südsudanesisch">südsudanesisch</option>
                        <option value="swasiländisch">swasiländisch</option>
                        <option value="syrisch">syrisch</option>
                        <option value="tadschikisch">tadschikisch</option>
                        <option value="taiwanisch">taiwanisch</option>
                        <option value="tansanisch">tansanisch</option>
                        <option value="thailändisch">thailändisch</option>
                        <option value="togoisch">togoisch</option>
                        <option value="tongaisch">tongaisch</option>
                        <option value="tschadisch">tschadisch</option>
                        <option value="tschechisch">tschechisch</option>
                        <option value="tunesisch">tunesisch</option>
                        <option value="turkmenisisch">turkmenisch</option>
                        <option value="tuvaluisch">tuvaluisch</option>
                        <option value="türkisch">türkisch</option>
                        <option value="ugandisch">ugandisch</option>
                        <option value="ukrainisch">ukrainisch</option>
                        <option value="ungarisch">ungarisch</option>
                        <option value="uruguayisch">uruguayisch</option>
                        <option value="usbekisch">usbekisch</option>
                        <option value="vanuatuisch">vanuatuisch</option>
                        <option value="venezuelanisch">venezuelanisch</option>
                        <option value="vietnamesisch">vietnamesisch</option>
                        <option value="vincentisch">vincentisch</option>
                        <option value="von Serbien und Montenegro">von Serbien und Montenegro</option>
                        <option value="von St. Kitts und Nevis">von St. Kitts und Nevis</option>
                        <option value="von Timor-Leste">von Timor-Leste</option>
                        <option value="von Trinidad und Tobago">von Trinidad und Tobago</option>
                        <option value="weißrussisch">weißrussisch</option>
                        <option value="rentralafrikanisch">zentralafrikanisch</option>
                        <option value="zyprisch">zyprisch</option>
				    </select>
                </div>


                <br>
                <br>

                <h5>Heimatadresse</h5>

                

                <label>Straße & Hausnummer: </label>
                <div class="col">
                    <input class="form-control" required="" type="text" name="HomeAdress">
                    <div class="invalid-feedback">
							Bitte ausfüllen!
                            </div>
                </div>


                <label>Postleitzahl: </label>
                <div class="col">
                    <input class="form-control" pattern="[0-9]+" required="" type="text" name="HomePostcode">
                    <div class="invalid-feedback">
							Bitte ausfüllen!
                            </div>
                </div>


                <label>Wohnort: </label>
                <div class="col">
                    <input class="form-control" pattern="[a-zA-ZÄÖÜäöüß]+" required="" value="<?php echo $_SESSION['residence'] ?>" type="text" name="HomeLocation">
                    <div class="invalid-feedback">
							Bitte ausfüllen!
                            </div>
                </div>


                <label>Land: </label>               
                <div class="col">
		            <select class="form-select" required="" name="HomeCountry">
				        <option selected="selected" value="">Bitte wählen</option>	
					    <option value="Afghanistan">Afghanistan</option>
					    <option value="Akrotiri und Dhekelia">Akrotiri und Dhekelia</option>
					    <option value="Albanien">Albanien</option>
					    <option value="Algerien">Algerien</option>
                        <option value="Amerikanisch-Samoa">Amerikanisch-Samoa</option>
                        <option value="Amerikanische Jungferninseln">Amerikanische Jungferninseln</option>
                        <option value="Andorra">Andorra</option>
                        <option value="Angola">Angola</option>
                        <option value="Anguilla">Anguilla</option>
                        <option value="Antigua und Barbuda">Antigua und Barbuda</option>
                        <option value="Argentinien">Argentinien</option>
                        <option value="Argentinische Antarktis">Argentinische Antarktis</option>
                        <option value="Armenien">Armenien</option>
                        <option value="Aruba">Aruba</option>
                        <option value="Aserbaidschan">Aserbaidschan</option>
                        <option value="Ashmore- und Cartierinseln">Ashmore- und Cartierinseln</option>
                        <option value="Australien">Australien</option>
                        <option value="Australisches Antarktis-Territorium">Australisches Antarktis-Territorium</option>
                        <option value="Åland">Åland</option>
                        <option value="Ägypten">Ägypten</option>
                        <option value="Äquatorialguinea">Äquatorialguinea</option>
                        <option value="Äthiopien">Äthiopien</option>
                        <option value="Bahamas">Bahamas</option>
                        <option value="Bahrain">Bahrain</option>
                        <option value="Bangladesch">Bangladesch</option>
                        <option value="Bardbados">Bardbados</option>
                        <option value="Belgien">Belgien</option>
                        <option value="Belize">Belize</option>
                        <option value="Benin">Benin</option>
                        <option value="Bermuda">Bermuda</option>
                        <option value="Bhutan">Bhutan</option>
                        <option value="Bolivien">Bolivien</option>
                        <option value="Bonaire, Saba, St. Eustatius">Bonaire, Saba, St. Eustatius</option>
                        <option value="Bosnien und Herzegowina">Bosnien und Herzegowina</option>
                        <option value="Botsuana">Botsuana</option>
                        <option value="Bouvetinseln">Bouvetinseln</option>
                        <option value="Braslilien">Braslilien</option>
                        <option value="Britische Jungferninseln">Britische Jungerferninseln</option>
                        <option value="Britisches Überseegebiet">Britisches Überseegebiet</option>
                        <option value="Britisches Antarktis-Territorium">Britisches Antarktis-Territorium</option>
                        <option value="Britisches Territorium im indischen Ozean">Britisches Territorium im indischen Ozean</option>
                        <option value="Brunei Darussalem">Brunei Darussalem</option>
                        <option value="Bulgarien">Bulgarien</option>
                        <option value="Burkina Faso">Burkina Faso</option>
                        <option value="Burundi">Burundi</option>
                        <option value="Chile">Chile</option>
                        <option value="Chilenische Antarktis">Chilenische Antarktis</option>
                        <option value="China">China</option>
                        <option value="Clipperton">Clipperton</option>
                        <option value="Cookinseln">Cookinseln</option>
                        <option value="Costa Rica">Costa Rica</option>
                        <option value="Côte d'Ivoire">Côte d'Ivoire</option>
                        <option value="Curaçao">Curaçao</option>
                        <option value="Dänemark">Dänkemark</option>
                        <option value="Deutschland">Deutschland</option>
                        <option value="Dominica">Dominica</option>
                        <option value="Dominikanische Republik">Dominikanische Republik</option>
                        <option value="Dschibuti">Dschibuti</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="El Salvador">El Salvador</option>
                        <option value="Eritrea">Eritrea</option>
                        <option value="Estland">Estland</option>
                        <option value="Falklandinseln">Falklandinseln</option>
                        <option value="Färöer">Färöer></option>
                        <option value="Fidschi">Fidschi</option>
                        <option value="Finnland">Finnland</option>
                        <option value="Frankreich">Frankreich</option>
                        <option value="Französisch-Guayana">Französisch-Guayana</option>
                        <option value="Französisch-Polynesien">Französisch-Polynesien</option>
                        <option value="Französische Süd- und Antarktisgebiete">Französische Süd- und Antarktisgebiete</option>
                        <option value="Gabun">Gabun</option>
                        <option value="Gambia">Gambia</option>
                        <option value="Georgien">Georgien</option>
                        <option value="Ghana">Ghana</option>
                        <option value="Gibraltar">Gibraltar</option>
                        <option value="Grenada">Grenada</option>
                        <option value="Griechenland">Griechenland</option>
                        <option value="Grönland">Grönland</option>
                        <option value="Guadeloupe">Guadeloupe</option>
                        <option value="Guam">Guam</option>
                        <option value="Guatemala">Guatemala</option>
                        <option value="Guernsey">Guernsey<option>
                        <option value="Guinea">Guinea</option>
                        <option value="Guinea-Bissau">Guinea-Bissau</option>
                        <option value="Guyana">Guyana</option>
                        <option value="Haiti">Haiti</option>
                        <option value="Heard und McDonaldinseln">Heard und McDonaldinseln</option>
                        <option value="Honduras">Honduras</option>
                        <option value="Hongkong">Hongkong</option>
                        <option value="Indien">Indien</option>
                        <option value="Indonesien">Indonesien</option>
                        <option value="Insel Man">Insel Man</option>
                        <option value="Irak">Irak</option>
                        <option value="Iran">Iran</option>
                        <option value="Irland">Irland</option>
                        <option value="Island">Island</option>
                        <option value="Israel">Israel</option>
                        <option value="Italien">Italien</option>
                        <option value="Jamaika">Jamaika</option>
                        <option value="Japan">Japan</option>
                        <option value="Jemen">Jemen</option>
                        <option value="Jersey">Jersey</option>
                        <option value="Jordanien">Jordanien</option>
                        <option value="Kaimaninseln">Kaimaninseln</option>
                        <option value="Kambodscha">Kambodscha</option>
                        <option value="Kamerun">Kamerun</option>
                        <option value="Kanada">Kanada</option>
                        <option value="Kasachstan">Kasachstan</option>
                        <option value="Katar">Katar</option>
                        <option value="Kenia">Kenia</option>
                        <option value="Kirgistan">Kirgistan</option>
                        <option value="Kiribati">Kiribati</option>
                        <option value="Kokosinseln">Kokosinseln</option>
                        <option value="Kolumbien">Kolumbien</option>
                        <option value="Komoren">Komoren</option>
                        <option value="Kongo">Kongo</option>
                        <option value="Korallenmeerinseln">Korallenmeerinseln</option>
                        <option value="Korea">Korea</option>
                        <option value="Kosovo">Kosovo</option>
                        <option value="Kroatien">Kroatien</option>
                        <option value="Kuba">Kuba</option>
                        <option value="Kuwait">Kuwait</option>
                        <option value="Laos">Laos</option>
                        <option value="Lesotho">Lesotho</option>
                        <option value="Lettland">Lettland</option>
                        <option value="Libanon">Libanon</option>
                        <option value="Liberia">Liberia</option>
                        <option value="Libyen">Libyen</option>
                        <option value="Liechtenstein">Liechtenstein</option>
                        <option value="Litauen">Litauen</option>
                        <option value="Luxemburg">Luxemburg</option>
                        <option value="Macau">Macau</option>
                        <option value="Madagaskar">Madagaskar</option>
                        <option value="Malawi">Malawi</option>
                        <option value="Malaysia">Malaysia</option>
                        <option value="Malediven">Malediven</option>
                        <option value="Mali">Mali</option>
                        <option value="Malta">Malta</option>
                        <option value="Marokko">Marokko</option>
                        <option value="Marshallinseln">Marshallinseln</option>
                        <option value="Martinique">Martinique</option>
                        <option value="Mauretanien">Mauretanien</option>
                        <option value="Mauritius">Mauritius</option>
                        <option value="Mayotte">Mayotte</option>
                        <option value="Mazedonien">Mazedonien</option>
                        <option value="Mexiko">Mexiko</option>
                        <option value="Mikronesien">Mikronesien</option>
                        <option value="Moldau">Moldau</option>
                        <option value="Monaco">Monaco</option>
                        <option value="Mongolei">Mongolei</option>
                        <option value="Montenegro">Montenegro</option>
                        <option value="Montserrat">Monserrat</option>
                        <option value="Mosambik">Mosambik</option>
                        <option value="Myanmar">Myanmar</option>
                        <option value="Namibia">Namibia</option>
                        <option value="Nauru">Nauru</option>
                        <option value="Navassa">Navassa</option>
                        <option value="Nepal">Nepal</option>
                        <option value="Neukaledonien">Neukaledonien</option>
                        <option value="Neuseeland">Neuseeland</option>
                        <option value="Neuseelädnische Antarktis">Neuseelädnische Antarktis</option>
                        <option value="Nicaragua">Nicaragua</option>
                        <option value="Niederlande">Niederlande</option>
                        <option value="Niger">Niger</option>
                        <option value="Nigeria">Nigeria</option>
                        <option value="Niue">Niue</option>
                        <option value="Norfolkinseln">Norfolkinseln</option>
                        <option value="Norwegen">Norwegen</option>
                        <option value="Norwegisches Antarktis-Territorium">Norwegisches Antarktis-Territorium</option>
                        <option value="Oman">Oman</option>
                        <option value="Österreich">Österreich</option>
                        <option value="Pakistan">Pakistan</option>
                        <option value="Palau">Palau</option>
                        <option value="Palästinenische Gebiete">Palästinenische Gebiete</option>
                        <option value="Panama">Panama</option>
                        <option value="Papua-Neuginea">Papua-Neuginea</option>
                        <option value="Paraguay">Paraguay</option>
                        <option value="Peru">Peru</option>
                        <option value="Philippinen">Philippinen</option>
                        <option value="Pitcairinseln">Pitcairinseln</option>
                        <option value="Polen">Polen</option>
                        <option value="Portugal">Portugal</option>
                        <option value="Puerto Rico">Puerto Rico</option>
                        <option value="Réunion">Réunion</option>
                        <option value="Ruanda">Ruanda</option>
                        <option value="Rumänien">Rumänien</option>
                        <option value="Russland">Russland</option>
                        <option value="Salomonen">Salomonen</option>
                        <option value="Sambia">Sambia</option>
                        <option value="Samoa">Samoa</option>
                        <option value="San Marino">San Marino</option>
                        <option value="Saudi-Arabien">Saudi-Arabien</option>
                        <option value="São Tomé und Príncipe">São Tomé und Príncipe</option>
                        <option value="Schweden">Schweden</option>
                        <option value="Schweiz">Schweiz</option>
                        <option value="Senegal">Senegal</option>
                        <option value="Serbien">Serbien</option>
                        <option value="Seychellen">Seychellen</option>
                        <option value="Sierra Leone">Sierra Leone</option>
                        <option value="Simbabwe">Simbabwe</option>
                        <option value="Singapur">Singapur</option>
                        <option value="Slowakei">Slowakei</option>
                        <option value="Slowenien">Slowenien</option>
                        <option value="Somalia">Somalia</option>
                        <option value="Spanien">Spanien</option>
                        <option value="Sri Lanka">Sri Lanka</option>
                        <option value="St. Kitts und Nevis">St. Kitts und Nevis</option>
                        <option value="St. Lucia">St. Lucia</option>
                        <option value="St. Vincent und die Grenadinen">St. Vincent und die Grenadinen</option>
                        <option value="Sudan">Sudan</option>
                        <option value="Suriname">Suriname</option>
                        <option value="Südafrika">Südafrika</option>
                        <option value="Südsudan">Südafrika</option>
                        <option value="Swasiland">Südafrika</option>
                        <option value="Syrien">Syrien</option>
                        <option value="Tadschikistan">Tadschikistan</option>
                        <option value="Taiwan">Taiwan</option>
                        <option value="Tansania">Tansania</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Timor-Leste">Timor-Leste</option>
                        <option value="Togo">Togo</option>
                        <option value="Tokelau">Tokelau</option>
                        <option value="Tonga">Tonga</option>
                        <option value="Trinidad und Tobago">Trinidad und Tobago</option>
                        <option value="Tschad">Tschad</option>
                        <option value="Tschechische Republik">Tschechische Republik</option>
                        <option value="Tunesien">Tunesien</option>
                        <option value="Turkmenistan">Turkmenistan</option>
                        <option value="Tuvalu">Tuvalu</option>
                        <option value="Türkei">Türkei</option>
                        <option value="Uganda">Uganda</option>
                        <option value="Ukraine">Ukraine</option>
                        <option value="Ungarn">Ungarn</option>
                        <option value="Uruguay">Uruguay</option>
                        <option value="Usbekistan">Usbekistan</option>
                        <option value="Vanuatu">Vanuatu</option>
                        <option value="Vatikanstadt">Vatikanstadt</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="Vereinigte Arabische Emirate">Vereinigte Arabische Emirate</option>
                        <option value="Vereinigte Staaten">Vereinigte Staaten</option>
                        <option value="Vereinigtes Königreich">Vereinigtes Königreich</option>
                        <option value="Vietnam">Vietnam</option>
                        <option value="Wallis und Futuna">Wallis und Futuna</option>
                        <option value="Weihnachtsinseln">Weihnachtsinseln</option>
                        <option value="Weißrussland">Weißrussland</option>
                        <option value="Westsahara">Westsahara</option>
                        <option value="Zentralafrikanische Republik">Zentralafrikanische Republik</option>
                        <option value="Zypern">Zypern</option>
				    </select>
                    <div class="invalid-feedback">
							Bitte auswählen!
                            </div>
                </div>
           

                <label>Telefon: </label>
		        <div class="col">
		            <input class="form-control" pattern="[0-9]+" value="<?php echo $_SESSION['phone'] ?>" required="" type="text" name="HomeTel">
                    <div class="invalid-feedback">
							Bitte ausfüllen!
                            </div>
                </div>

                <label>Mobil: </label>
		        <div class="col">
		            <input class="form-control" pattern="[0-9]+" required="" type="text" name="homemobil">
                    <div class="invalid-feedback">
							Bitte ausfüllen!
                            </div>
                </div>


                <label>E-Mail:</label>
		        <div class="col">
		            <input class="form-control" value="<?php echo $_SESSION['email'] ?>" required="" type="text" name="mailadress" disabled>
                    <div class="invalid-feedback">
							Bitte ausfüllen!
                            </div>
                </div>




                <br>
                <br>

                <h5>Semesteradresse</h5>

                

                 <label>Straße & Hausnummer: </label>
                <div class="col">
                      <input class="form-control"  value="<?php echo $_SESSION['street'] ?>" required="" type="text" name="Semesterstreet">
                      <div class="invalid-feedback">
							Bitte ausfüllen!
                            </div>
                </div>


                 <label>Postleitzahl: </label>
                <div class="col">
                    <input class="form-control" pattern="[0-9]+" value="<?php echo $_SESSION['postcode'] ?>" required="" type="text" name="semesterpostcode">
                    <div class="invalid-feedback">
							Bitte ausfüllen!
                            </div>
                </div>


                <label>Wohnort: </label>
                <div class="col">
                    <input class="form-control" pattern="[a-zA-ZÄÖÜäöüß]+" required="" type="text" name="semesterlocation">
                    <div class="invalid-feedback">
							Bitte ausfüllen!
                            </div>
                </div>

                 <label>Telefon: </label>
	            <div class="col">
	            	<input class="form-control" pattern="[0-9]+" required="" type="text" name="semestertel">
                    <div class="invalid-feedback">
							Bitte ausfüllen!
                            </div>
                </div>


                <br>
                <br>

                <h5>Notfallkontakt</h5>

                <label>Vorname: </label>            
                <div class="col">
	                <input class="form-control" id="contactname" pattern="[a-zA-ZÄÖÜäöüß]+" required="" type="text" name="emergencyfirstname">
                    <div class="invalid-feedback">
							Bitte ausfüllen!
                            </div>
	            </div>

                <label>Nachname: </label>            
                <div class="col">
	                <input class="form-control" id="contactname" pattern="[a-zA-ZÄÖÜäöüß]+" required="" type="text" name="emergencylastname">
                    <div class="invalid-feedback">
							Bitte ausfüllen!
                            </div>
	            </div>

                <label>Beziehung zur BeweberIn: </label>
                <div class="col">
                    <input class="form-control" pattern="[a-zA-ZÄÖÜäöüß]+" required="" type="text" name="emergrelationship">
                    <div class="invalid-feedback">
							Bitte ausfüllen!
                            </div>
                </div>

                <label>Telefon: </label>
	            <div class="col">
	            	<input class="form-control" pattern="[0-9]+" required="" type="text" name="emergtel">
                    <div class="invalid-feedback">
							Bitte ausfüllen!
                            </div>
                </div>


                <label>E-Mail:</label>
	            <div class="col">
	            	<input class="form-control"  required="" type="text" name="emergmail">
                    <div class="invalid-feedback">
							Bitte ausfüllen!
                            </div>
                </div>     



                <br>
                <br>

                <h5>Informationen zum Studium in Bamberg</h5>

                <label>Studienfach 1: </label>
                <div class="col">
	            	<select class="form-select" required="" name="StudyCourse">
	            		<option selected="selected" value="<?php echo $_SESSION['course'] ?>"><?php echo $_SESSION['course'] ?></option>
	            		<option>B.Sc. Angewandte Informatik</option>
	            		<option>B.Sc. International Information Systems Management</option>
	            		<option>B.Sc. Software Systems Science</option>
	            		<option>B.Sc. Wirtschaftsinformatik</option>
	            		<option>B.Sc. NF Angewandte Informatik</option>
	            		<option>M.Sc. Angewandte Informatik</option>
	            		<option>M.Sc. Computing in the Humanities</option>
	            		<option>M.Sc. International Information Systems Management</option>
	            		<option>M.Sc. International Software Systems Science</option>
	            		<option>M.Sc. Wirtschaftsinformatik</option>
	            		<option>M.Sc. Wirtschaftspädagogik</option>
	            		<option>M.Sc. Virtueller Weiterbildungsstudiengang Wirtschaftsinformatik</option>
	            	</select>
                    <div class="invalid-feedback">
							Bitte auswählen!
                            </div>
                </div>
                
                <label>Studienfach 2: </label>
                <div class="col">
                    <input class="form-control" pattern="[a-zA-ZÄÖÜäöüß]+"  type="text" name="StudyCourse2">
                    
                </div>


                <label>Fachsemester: </label>
	            <div class="col">
	            	<input class="form-control" pattern="[0-9]+" value="<?php echo $_SESSION['sem'] ?>" required="" type="text" name="Semesternumber">
                    <div class="invalid-feedback">
							Bitte ausfüllen!
                            </div>
                </div>

                
                <br>
                <br>

                <h5>Angaben zur Wunschuniversität</h5>
                                                                        


                <label>Studienprogramm:</label>                        
                <div class="col">
	            	<select class="form-select" required="" name="studyprogram">
	            		<option selected="selected" value="">Bitte wählen</option>
	            		<option>Austauschprogramm</option>
	            		<option>Selbstzahler</option>
                    </select>
                    <div class="invalid-feedback">
							Bitte auswählen!
                            </div>
                </div>

                <label>Beginn:</label>                    
                <div class="col">
	            	<select class="form-select" required="" name="startyear">
	            		<option selected="selected" value="">Bitte wählen</option>
	            		<?php 
                            get_years();
                        ?>
	            	</select>
                    <div class="invalid-feedback">
							Bitte auswählen!
                            </div>
                </div>

                <label>Semester:</label>                    
                <div class="col">
	            	<select class="form-select" required="" name="startsemester">
	            		<option selected="selected" value="">Bitte wählen</option>
	            		<option>Wintersemester</option>
	            		<option>Sommersemester</option>
	            	</select>
                    <div class="invalid-feedback">
							Bitte auswählen!
                            </div>
                </div>

                <label>Dauer:</label>                    
                <div class="col">
	                <select class="form-select" required="" name="duration">
	            	    <option selected="selected" value="">Bitte wählen</option>
	            	    <option>1 Semester</option>
	            	    <option>2 Semester</option>
	                </select>
                    <div class="invalid-feedback">
							Bitte auswählen!
                            </div>
                </div>


 
                <br>
                <br>

                <h5>Kontodaten</h5>

                <label>Kontoinhaber:</label>
                <div class="col">
                    <input class="form-control" pattern="[a-zA-ZÄÖÜäöüß\s]+" required="" type="text" name="account">
                    <div class="invalid-feedback">
							Bitte ausfüllen!
                            </div>
                </div>

                <label>IBAN:</label>
                <div class="col">
                    <input class="form-control"  required="" type="text" name="iban">
                    <div class="invalid-feedback">
							Bitte ausfüllen!
                            </div>
                </div>
                <br>
                <button class="w-100 btn btn-primary" type="submit" name="save">Initialen Antrag einreichen
            </button>
                
            </div>

        </form>
</div>
                                    
                                    <!-- Ende initialer Antrag -->




								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</div>
	</main>
	<?php include("webElements/footer.php");?>

    <?php  

function save_data(){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $birth_date = $_POST['BirthDate'];
    $birth_location = $_POST['BirthLocation'];
    $birth_country = $_POST['BirthCountry'];
    $nationality1  = $_POST['nationality1'];
    $nationality2 = $_POST['nationality2'];
    $home_street = $_POST['HomeAdress'];
    $home_postcode = $_POST['HomePostcode'];
    $home_location = $_POST['HomeLocation'];
    $home_country = $_POST['HomeCountry'];
    $home_tel = $_POST['HomeTel'];
    $home_mobil = $_POST['homemobil'];
    $email = $_POST['mailadress'];
    $semester_street = $_POST['Semesterstreet'];
    $semester_postcode = $_POST['semesterpostcode'];
    $semester_location = $_POST['semesterlocation'];
    $semester_tel = $_POST['semestertel'];
    $emerg_firstname = $_POST['emergencyfirstname'];
    $emerg_lastname = $_POST['emergencylastname'];
    $emerg_rela = $_POST['emergrelationship'];
    $emerg_tel = $_POST['emergtel'];
    $emerg_email = $_POST['emergmail'];
    $subject1 = $_POST['StudyCourse'];
    $subject2 = $_POST['"StudyCourse2"'];
    $study_niveau = $_POST['studyniveau'];
    $semester = $_POST['Semesternumber'];
    $study_program = $_POST['studyprogram'];
    $start_semester = $_POST['startsemester']; 
    $start_year = $_POST['startyear'];
    $duration = (int)$_POST['duration'][0];
    $account = $_POST['account'];
    $iban = $_POST['iban'];
    

    try{
        $db = db_connection();
        $matriculation = $_SESSION['matriculation'];
        if (validate($matriculation)){  
            $sql_string = "INSERT INTO InitialRequest(Gender, Nationality, AccountHolder, IBAN, 
                        MatriculationNumber, SecNationality, Program, StartSemester, StartYear, 
                        Duration) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"; 
            $statement = $db->prepare($sql_string);
            $statement->execute(array($gender, $nationality1, $account, $iban, $matriculation, $nationality2, $study_program, $start_semester, $start_year, $duration));
            $id = $db->lastInsertId($sql_string);

            $statement = $db->prepare("INSERT INTO `HomeAddress`(`RequestID`, `location`, `Street`, `PostCode`, 
                                        `TelNumber`, `MobNumber`, `Country`) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?)");
            $statement->execute(array($id, $home_location, $home_street, $home_postcode, $home_tel, $home_mobil, $home_country));
            $statement = $db->prepare("INSERT INTO `EmergContact`(`RequestID`, `FirstName`, `LastName`, `Email`, `TelNumber`,
                                        `Relationship`) 
                                        VALUES (?, ?, ?, ?, ?, ?)");
            $statement->execute(array($id, $emerg_firstname, $emerg_lastname, $emerg_email, $emerg_tel, $emerg_rela));
        }else{
            $req_id = get_id($matriculation);
            $statement = $db->prepare("UPDATE InitialRequest SET Gender = ?, Nationality = ?, AccountHolder = ?, IBAN = ?, 
                                        SecNationality = ?, Program = ?, StartSemester = ?, StartYear = ?, Duration = ? WHERE RequestID = ?");
            $statement->execute(array($gender, $nationality1, $account, $iban, $nationality2, $study_program, $start_semester, $start_year, $duration, $req_id));

            $statement = $db->prepare("UPDATE HomeAddress SET location = ?, Street = ?, PostCode = ?, TelNumber = ?, 
                                        MobNumber =?, Country = ? WHERE RequestID = ?");
            $statement->execute(array($home_location, $home_street, $home_postcode, $home_tel, $home_mobil, $home_country, $req_id));
            
            $statement = $db->prepare("UPDATE EmergContact SET FirstName = ?, LastName = ?, Email = ?, TelNumber = ?, 
                                        Relationship = ? WHERE RequestID = ?");
            $statement->execute(array($emerg_firstname, $emerg_lastname, $emerg_email, $emerg_tel, $emerg_rela, $req_id));
        }
        $statement = $db->prepare("UPDATE Student SET Birthdate = ?, BirthLocation = ?, StudyCourse = ?, 
                                    SecStudyCourse = ?, StudyType = ?, PhoneNumber = ?, Street = ?, Residence = ?, 
                                    PostalCode = ?, Semester = ? 
                                    WHERE MatriculationNumber = ?");
        $statement->execute(array($birth_date, $birth_location, $subject1, $subject2, $study_niveau, $semester_tel, $semester_street, $semester_location, $semester_postcode, $semester, $matriculation));
        return True;
    }catch (PDOException $exception){
        return False;
    }

}

function get_years(){
    $current_year = getdate();
    if ($current_year["mon"] < 10){
        $date = new DateTime("0".$current_year["mon"]."/".$current_year["mday"]."/".$current_year["year"]);
    }else{
        $date = new DateTime($current_year["mon"]."/".$current_year["mday"]."/".$current_year["year"]);
    }
    $counter = 10;
    while ($counter > 0){
        $year = $date->format("Y");
        echo '<option>'.$year.'</option>';
        $current_year = $date->modify("+1 year");
        $counter--;
    }
}

function validate($matriculation){
    $db = db_connection();
    $statement = $db->prepare("SELECT * FROM InitialRequest WHERE MatriculationNumber = ?");
    $statement->execute(array($matriculation));

    if ($statement->rowCount() === 0){
        return True;
    }else{
        return False;
    }
}

function get_id($matriculation){
    $db = db_connection();
    $statement = $db->prepare("SELECT RequestID FROM InitialRequest WHERE MatriculationNumber = ?");
    $statement->execute(array($matriculation));

    if ($statement->rowCount() != 0){
        $value = $statement->fetch();
        return $value['RequestID'];
    }else{
        return NULL;
    }
}
?>