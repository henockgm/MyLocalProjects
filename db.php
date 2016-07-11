<?php
try {
	$dbh = new PDO('mysql:host=localhost;dbname=your_db_name', '','your_password');
} catch (Exception $e) {
	print "Error!: " . $e->getMessage(). '</br>';
	die();
}


