<?php


/*
CREATE TABLE article (
art_id INTEGER PRIMARY KEY,
art_cat INT,
art_title VARCHAR(255),
art_description VARCHAR(255),
art_text TEXT,
art_date DATETIME,
art_metatitle VARCHAR(255),
art_metadesc VARCHAR(255),
art_metakeys VARCHAR(255),
art_slug VARCHAR(255)
)
*/

try {
	$db = new PDO('mysql:host=localhost; dbname=test_db', 'root', '');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$q = $db->exec("CREATE TABLE article (
		art_id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
		cat INT NOT NULL,
		title VARCHAR(255),
		description VARCHAR(255),
		art_text TEXT,
		art_date DATETIME,
		metatitle VARCHAR(255),
		metadesc VARCHAR(255),
		metakeys VARCHAR(255),
		slug VARCHAR(255)
	)");
	} catch (PDOException $e) {
	print "Couldn't create table: " . $e->getMessage();
}