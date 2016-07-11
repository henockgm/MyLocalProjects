<?php
require_once 'db.php';

$tobedeleted = $_POST['tobedeleted'];

$command = " DELETE FROM sites WHERE id=:id LIMIT 1";
  $stmt = $dbh ->prepare($command);
  $stmt->bindParam(':id', $tobedeleted , PDO::PARAM_INT);
  $stmt->execute();

?>
