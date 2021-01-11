<?php

try {
	$db = new PDO('mysql:host=localhost; dbname=test_db', 'root', '');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$q = $db->exec("CREATE TABLE header (
		id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
		page_name VARCHAR(255) UNIQUE,
		title VARCHAR(255),
		description VARCHAR(255),
		metakeys VARCHAR(255)
	)");
	} catch (PDOException $e) {
	print "Couldn't create table: " . $e->getMessage();
}

?>