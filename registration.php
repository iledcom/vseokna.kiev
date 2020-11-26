<?php
require 'admin/modules/FormHelper.php';
require 'registrationClass.php';
require 'validateClass.php';
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
$form = new FormHelper();
$validate = new Validate();
$registration = new Registration($form, $validate, $db, $server);

$registration->registrationStart();





