<?php


/*
CREATE TABLE users (
user_id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
user_login VARCHAR(36),
user_password INTEGER(16),
user_name VARCHAR(36),
user_surname VARCHAR(36),
user_phone INTEGER,
dob VARCHAR(42),
delivery_address VARCHAR(255)
)
*/

try {
	$db = new PDO('mysql:host=localhost; dbname=test_db', 'root', '');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$q = $db->exec("CREATE TABLE users (
user_id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
user_login VARCHAR(36) UNIQUE,
user_password VARCHAR(255),
user_name VARCHAR(36),
user_surname VARCHAR(36),
user_phone INTEGER UNIQUE,
dob VARCHAR(42),
delivery_address VARCHAR(255)
)");
	} catch (PDOException $e) {
	print "Couldn't create table: " . $e->getMessage();
}

//Добавить поле

ALTER TABLE `users` ADD `status` INT(1) NULL DEFAULT NULL AFTER `delivery_address`;