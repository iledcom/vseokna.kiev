<?php


/*
CREATE TABLE section (
sec_id INTEGER PRIMARY KEY,
sec_cat INT,
sec_title VARCHAR(255),
sec_description VARCHAR(255),
)
*/

try {
	$db = new PDO('mysql:host=localhost; dbname=test_db', 'root', '');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$q = $db->exec("CREATE TABLE section (
		sec_id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
		sec_cat INT NOT NULL,
		sec_title VARCHAR(255),
		sec_description VARCHAR(255)
	)");
	} catch (PDOException $e) {
	print "Couldn't create table: " . $e->getMessage();
}