<?php
$stmt = db_connection()->prepare("SELECT * FROM UniMember");
$stmt->execute();

if ($stmt->rowCount() > 0) {
  while ($row = $stmt->fetch()) {
?>
    <tr>
      <th scope="row"><?php echo $row['PersonID']; ?></th>
      <td colspan="2"><?php echo $row['FirstName'] . " " . $row['LastName']; ?></td>
      <td class="text-end"><input type="button" name="contactBtn" value="Nachricht" id="<?php echo $row["PersonID"]; ?>" class="btn btn-info btn-xs contactBtn" /></td>
    </tr>
<?php
  }
}
?>