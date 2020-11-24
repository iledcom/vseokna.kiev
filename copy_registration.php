<?php
require 'admin/modules/FormHelper.php';
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Если функция validate_form() возвратит ошибки,
	// передать их функции show_form()
	list($errors, $inputs) = validate_form();
	if ($errors) {
		show_form($errors);
	} else {
		// Переданные данные из формы достоверны, обработать их
		process_form($inputs);
	}
} else {
	// Данные из формы не переданы, отобразить ее снова
	show_form();
}

function show_form($errors = array()) {
	// Собственные значения, устанавливаемые по умолчанию,
	// отсутствуют, поэтому и нечего передавать конструктору
	// класса FormHelper
	$form = new FormHelper();
	// построить HTML-таблицу из сообщений об ошибках для
	// последующего применения
	if ($errors) {
		$errorHtml = '<ul><li>';
		$errorHtml .= implode('</li><li>',$errors);
		$errorHtml .= '</li></ul>';
	} else {
		$errorHtml = '';
	}

	include 'registration_form.php';
}

function validateDate($date, $format = 'd.m.Y') {
  $d = DateTime::createFromFormat($format, $date);
  return $d && $d->format($format) == $date;
}

function validate_form() {
	$inputs = array();
	$errors = array();

	$inputs = $_POST;

	foreach ($inputs as $input => &$value) {
		$value = trim($value);
		if (! strlen($value)) {
			$errors[] = "Please enter the $input.";
		}
		if ($input == 'dob') {
			if (!validateDate($inputs['dob'])) {
				$errors[] = 'Please enter the correct Date of Birth.';
			}
		}
	}
		unset($value);
		return array($errors, $inputs);
}

function process_form($inputs) {
	// получить в этой функции доступ к глобальной переменной $db
	global $db;

	try {
		$stmt = $db->prepare('INSERT INTO users (user_login, user_password, user_name, user_surname, user_phone, dob, delivery_address) VALUES (?,?,?,?,?,?,?)');
		$stmt->execute(array($inputs['user_login'], $inputs['user_password'], $inputs['user_name'], $inputs['user_surname'], $inputs['user_phone'], $inputs['dob'], $inputs['delivery_address']));

		print 'Added ' . htmlentities($inputs['user_login']) . ' to the database.';
		show_form();
	} catch (PDOException $e) {
		print "Couldn't add new user to the database.";
	}

	// ввести имя пользователя в сеанс
	$_SESSION['username'] = $inputs['user_name'];
	print "Welcome, $_SESSION[username]";
}