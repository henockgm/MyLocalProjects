<?php
require_once 'db.php';

header('Content-Type: application/json');
$tobeupdated = $_POST['tobeupdated'];


  $stmt = $dbh->prepare('SELECT * from sites where id='. $tobeupdated);
  $stmt->execute();

  while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
    echo json_encode(array('site_name' =>  $rs->sitename, 'site_type' =>  $rs->sitetype, 'site_link' =>  $rs->sitelink ));
  }

  $dbh = null;

    
?>