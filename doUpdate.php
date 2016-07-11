<?php
require_once 'db.php';

$id = $_POST['update_site_id'];
$site_name = $_POST['update_site_name'];
$site_type = $_POST['update_site_type'];
$site_link = $_POST['update_site_link'];



if($dbh) {
  $query = "UPDATE sites SET sitename=:site_name, sitetype=:site_type, sitelink=:site_link where id=:id LIMIT 1";

  $stmt = $dbh->prepare($query);
  
  $stmt->bindParam(':site_name', $site_name);
  $stmt->bindParam(':site_type', $site_type);
  $stmt->bindParam(':site_link', $site_link);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);

  $stmt->execute();

   //echo  $sitename = $_POST['update_sitename'];

  $dbh = null;

}
    
?>

