<?php
require 'admin/modules/FormHelper.php';
require 'classes/registrationClass.php';
require 'classes/validateClass.php';
session_start();



// подключиться к базе данных
try {
	$db = new PDO('mysql:host=localhost; dbname=test_db', 'root', '');
} catch (PDOException $e) {
	print "Can't connect: " . $e->getMessage();
	exit();
}
// установить исключения при ошибках в базе данных
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$server = $_POST;
$validate = new Validate($db);
$registration = new Registration($validate, $db, $server);

$registration->registrationStart();




