<?php include '../../config/Error.php'; ?>

<?php
if (isset($_POST['filter-Btn'])) {

  try {
    $uniID = $_POST['uniID'];
    $uniName = $_POST['uniName'];
    $uniLand = $_POST['uniLand'];
    $uniRegion = $_POST['uniRegion'];
    $uniAbschluss = $_POST['filterDegree'];
    $uniSemester = $_POST['filterSemester'];

    if ($uniID != "") {
      $uniID = validateInteger($uniID);
    }
    if ($uniName != "") {
      $uniName = validateInput($uniName);
    }
    if ($uniLand != "") {
      $uniLand = validateInput($uniLand);
    }
    if ($uniRegion != "") {
      $uniregion = validateInput($uniRegion);
    }

    if (
      $uniID != "" || $uniName != "" || $uniLand != "" || $uniRegion != "" || $uniAbschluss != "" || $uniSemester != ""
    ) {
      $sqlQuery = getQuery($uniID, $uniName, $uniLand, $uniRegion, $uniAbschluss, $uniSemester);
      $stmt = db_connection()->prepare($sqlQuery);
      $stmt->execute();
      if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch()) {
?>
          <tr>
            <th scope="row"><?php echo $row['UniID']; ?></th>
            <td>
              <span class="d-inline-block text-truncate" style="max-width: 150px;"><?php echo $row['Name']; ?></span>
            </td>
            <td>
              <span class="d-inline-block text-truncate" style="max-width: 100px;"><?php echo $row['Country']; ?></span>
            </td>
            <td>
              <span class="d-inline-block text-truncate" style="max-width: 250px;"><?php echo $row['Location']; ?></span>
            </td>
            <td><button class="btn btn-info btn-sm editBtn" type="submit" id="editProfBtn" name="editProfBtn">
                <a id="editLink" href="update.php?uniID=<?php echo $row['UniID']; ?>">anpassen</a></button>
              <button class="btn btn-danger btn-sm deleteProfBtn" type="submit" id="deleteProfBtn" name="deleteProfBtn">
                <a id="deleteLink" href="delete.php?uniID=<?php echo $row['UniID']; ?>" onclick="return confirm('Sind Sie sicher, das zu löschen?')">löschen</a></button>
            </td>
          </tr>

        <?php // Ende von whileschileife
        }; ?>
      <?php //Ende von 3. if 
      } else {
        echo "<div class='alert alert-primary' role='alert'>
                 Kein passendes Ergebniss gefunden! ->$uniID
                  </div>";;
      }; ?>
      <?php //Ende von 2. if 
    } elseif ($uniID == "" && $uniName == "" && $uniLand == "" && $uniRegion == "") {
      $stmt = db_connection()->prepare("SELECT * FROM University");
      $stmt->execute();
      while ($row = $stmt->fetch()) { ?>
        <tr>
          <th scope="row"><?php echo $row['UniID']; ?></th>
          <td>
            <span class="d-inline-block text-truncate" style="max-width: 150px;"><?php echo $row['Name']; ?></span>
          </td>
          <td>
            <span class="d-inline-block text-truncate" style="max-width: 100px;"><?php echo $row['Country']; ?></span>
          </td>
          <td>
            <span class="d-inline-block text-truncate" style="max-width: 250px;"><?php echo $row['Location']; ?></span>
          </td>
          <td><button class="btn btn-info btn-sm editBtn" type="submit" id="editProfBtn" name="editProfBtn">
              <a id="editLink" href="update.php?uniID=<?php echo $row['UniID']; ?>">anpassen</a></button>
            <button class="btn btn-danger btn-sm deleteProfBtn" type="submit" id="deleteProfBtn" name="deleteProfBtn">
              <a id="deleteLink" href="delete.php?uniID=<?php echo $row['UniID']; ?>" onclick="return confirm('Sind Sie sicher, das zu löschen?')">löschen</a></button>
          </td>
        </tr>

      <?php //Ende von 2 While Schliefe
      }; ?>
    <?php }; ?>
  <?php //Ende von 3. if 
  } catch (InvalidArgumentException $e) {
    print_result($e->getMessage(), false);
  }
} else {
  $stmt = db_connection()->prepare("SELECT * FROM University");
  $stmt->execute();
  while ($row = $stmt->fetch()) {
  ?> <tr>
      <th scope="row"><?php echo $row['UniID']; ?></th>
      <td>
        <span class="d-inline-block text-truncate" style="max-width: 150px;"><?php echo $row['Name']; ?></span>
      </td>
      <td>
        <span class="d-inline-block text-truncate" style="max-width: 100px;"><?php echo $row['Country']; ?></span>
      </td>
      <td>
        <span class="d-inline-block text-truncate" style="max-width: 250px;"><?php echo $row['Location']; ?></span>
      </td>
      <td><button class="btn btn-info btn-sm editBtn" type="submit" id="editProfBtn" name="editProfBtn">
          <a id="editLink" href="update.php?uniID=<?php echo $row['UniID']; ?>">anpassen</a></button>
        <button class="btn btn-danger btn-sm deleteProfBtn" type="submit" id="deleteProfBtn" name="deleteProfBtn">
          <a id="deleteLink" href="delete.php?uniID=<?php echo $row['UniID']; ?>" onclick="return confirm('Sind Sie sicher, das zu löschen?')">löschen</a></button>
      </td>
    </tr>
<?php };
}; ?>


<?php
// Diese Funktion sorgt dafür die Query dynamisch anzupassen, damit 
// eine Suche nach mehr als 2 Suchkriterien möglich ist.
function getQuery($id, $name, $land, $region, $abschluss, $semester)
{
  $query = "SELECT * FROM University ";
  $passedValue = array();

  if (!empty($id)) {
    $passedValue[] = "UniID='$id'";
  }
  if (!empty($name)) {
    $passedValue[] = "Name LIKE '%$name%'";
  }
  if (!empty($land)) {
    $passedValue[] = "Country LIKE '%$land%'";
  }
  if (!empty($region)) {
    $passedValue[] = "Location LIKE '%$region%'";
  }
  if (!empty($abschluss)) {
    $passedValue[] = "Degree ='$abschluss'";
  }
  if (!empty($semester)) {
    $passedValue[] = "Semester ='$semester'";
  }
  $sql = $query;
  if (count($passedValue) > 0) {
    $sql .= "WHERE " . implode(' AND ', $passedValue);
  }
  return $sql;
}

?>