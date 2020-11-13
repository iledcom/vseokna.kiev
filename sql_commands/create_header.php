<?php

try {
	$db = new PDO('mysql:host=localhost; dbname=test_db', 'root', '');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$q = $db->exec("CREATE TABLE article (
		head_id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
		head_title VARCHAR(255),
		head_description VARCHAR(255),
		head_info VARCHAR(255),
		phone_1 VARCHAR(255),
		phone_2 VARCHAR(255),
		head_delivery VARCHAR(255),
		head_payment VARCHAR(255),
		head_agreement VARCHAR(255)
	)");
	} catch (PDOException $e) {
	print "Couldn't create table: " . $e->getMessage();
}

?>