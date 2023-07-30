<div class="modal fade " id="profilAnlegen" tabindex="-1" data-bs-backdrop="static" aria-labelledby="profilAnlegen" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="profilAnlegen"><b>Neues Profil anlegen</b></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="change_border_color();"></button>
      </div>
      <div class="modal-body" id="profErstellen">
        <form method="post" onsubmit="validate_info(event)" action="uploader.php" id="newProf" name="newProf" enctype="multipart/form-data">
          <div class="row input-group mb-3">
            <label for="uniName" class="col-form-label col-sm-3">Name</label>
            <div class="col-sm-9">
              <input class="form-control " type="text" id="uniname" name="uniName">
            </div>
          </div>
          <div class="row input-group mb-3">
            <label for="uniOrt" class="col-form-label col-sm-3">Ort</label>
            <div class="col-sm-9"><input type="text" class="form-control" id="unilocation" name="uniLocation"> </div>
          </div>
          <div class="row input-group mb-3"><label for="uniLand" class="col-form-label col-sm-3">Land</label>
            <div class="col-sm-9"> <input type="text" class="form-control" id="unicountry" name="uniLand"> </div>
          </div>
          <div class="row input-group mb-3"><label for="UniAnsprechpartner" class="col-form-label col-sm-3">Ansprechpartner</label>
            <div class="col-sm-9"> <input type="text" class="form-control" id="unicontact" name="uniAnsPart"> </div>
          </div>
          <div class=" row input-group mb-3"><label for="uniNotendurchschnitt" class="col-form-label col-sm-3">Notendurchschnitt</label>
            <div class="col-sm-9"> <input type="text" class="form-control" id="unigrade" name="notenSchnitt"> </div>
          </div>

          <div class="row input-group mb-3 ">
            <label for="uniSemester" class="col-form-label col-sm-3">Semester</label>
            <div class="col-sm-9">
              <select name="uniSemester" id="uniSemester" class="form-control" aria-label="Default select example" required>
                <option selected>Bitte Semester auswählen</option>
                <option value="Sommersemester">Sommersemeseter</option>
                <option value="Wintersemester">Wintersemester</option>
                <option value="beides">Beides</option>
              </select>
            </div>
          </div>

          <div class="row input-group mb-3 ">
            <label for="uniAbschluss" class="col-form-label col-sm-3">Abschluss</label>
            <div class="col-sm-9">
              <select name="uniAbschluss" id="uniAbschluss" class="form-control" aria-label="Default select example" required>
                <option selected>Bitte Abschluss auswählen</option>
                <option value="Bachelor">Bachelor</option>
                <option value="Master">Master</option>
              </select>
            </div>

          </div>

          <div class="row input-group mb-3"><label for="uniLink" class="col-form-label col-sm-3">Link</label>
            <div class="col-sm-9"> <input type="url" class="form-control" id="unilink" name="uniLink"> </div>

          </div>
          <div class="row input-group mb-3 ">
            <label for="uniLogo" class="col-form-label col-sm-3">Logo</label>
            <div class="col-sm-9"> <input type="file" class="form-control" id="unilogo" name="uniLogo"> </div>

          </div>
          <div class="row input-group mb-3"><label for="uniFotos" class="col-form-label col-sm-3">Fotos</label>
            <div class="col-sm-9"> <input type="file" class="form-control" id="unifotos" name="uniFoto[]" multiple> </div>

          </div>
          <div class="row input-group mb-3"><label for="uniKurzbeschreibung" class="col-form-label col-sm-3">Kurzbeschreibung</label>
            <div class="col-sm-9 "> <textarea class="form-control mx-0 " id="kurzBeschreibung" name="uniDescription" rows="5"> </textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="change_border_color();">Close</button>
            <button type="submit" form="newProf" class="btn btn-primary" name="newProfBtn">Erstellen</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>