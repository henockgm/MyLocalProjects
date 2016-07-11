<?php

require_once 'db.php';

$sitename = $_POST['sitename'];
$sitetype = $_POST['sitetype'];
$sitelink = $_POST['sitelink'];


if($dbh) {
	$sql = "INSERT INTO sites (`sitename` , `sitetype`, `sitelink`)  VALUES (?,?,?)" ;

	$stmt = $dbh->prepare($sql);

	$stmt->bindValue(1, $sitename);
	$stmt->bindValue(2, $sitetype);
   	$stmt->bindValue(3, $sitelink);

	if($stmt->execute()) echo 'Saved';

	$dbh = null;

}


 ?>
