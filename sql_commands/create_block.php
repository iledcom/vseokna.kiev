<?php


/*
CREATE TABLE block (
blc_id INTEGER PRIMARY KEY,
blc_sec_cat INT,
blc_title VARCHAR(255),
blc_description VARCHAR(255),
)
*/

try {
	$db = new PDO('mysql:host=localhost; dbname=test_db', 'root', '');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$q = $db->exec("CREATE TABLE block (
		blc_id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
		blc_sec_cat INT NOT NULL,
		blc_title VARCHAR(255),
		blc_description VARCHAR(255)
	)");
	} catch (PDOException $e) {
	print "Couldn't create table: " . $e->getMessage();
}