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
	list($errors, $input) = validate_form();
	if ($errors) {
		show_form($errors);
	} else {
		// Переданные данные из формы достоверны, обработать их
		process_form($input);
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

/*
function validate_form() {
	global $db;
	$input = array();
	$errors = array();
	// В этой переменной устанавливается логическое значение true
	// только в том случае, если предъявленный пароль подходит
	$password_ok = false;
	$input['username'] = $_POST['username'] ?? '';
	$submitted_password = $_POST['password'] ?? '';
	$stmt = $db->prepare('SELECT password FROM users WHERE username = ?');
	$stmt->execute($input['username']);
	$row = $stmt->fetch();
	// Если в таблице отсутствует искомая строка, имя
	// пользователя не найдено ни в одной из строк таблицы
	if ($row) {
		$password_ok = password_verify($submitted_password, $row[0]);
	}
	if (! $password_ok) {
		$errors[] = 'Please enter a valid username and password.';
	}
		return array($errors, $input);
}
*/

function validate_form() {
	$input = array();
	$errors = array();

	$input['user_login'] = trim($_POST['user_login'] ?? '');
	if (! strlen($input['user_login'])) {
		$errors[] = 'Please enter the login.';
	}

	$input['user_password'] = trim($_POST['user_password'] ?? '');
	if (! strlen($input['user_password'])) {
		$errors[] = 'Please enter the password.';
	}

	$input['user_name'] = trim($_POST['user_name'] ?? '');
	if (! strlen($input['user_name'])) {
		$errors[] = 'Please enter the name.';
	}

	$input['user_surname'] = trim($_POST['user_surname'] ?? '');
	if (! strlen($input['user_surname'])) {
		$errors[] = 'Please enter the article surname.';
	}

	$input['user_phone'] = trim($_POST['user_phone'] ?? '');
	if (! strlen($input['user_phone'])) {
		$errors[] = 'Please enter the phone number.';
	}

	$input['delivery_address'] = trim($_POST['delivery_address'] ?? '');
	if (! strlen($input['delivery_address'])) {
		$errors[] = 'Please enter the delivery address.';
	}

	function validateDate($date, $format = 'd.m.Y') {
	  $d = DateTime::createFromFormat($format, $date);
	  return $d && $d->format($format) == $date;
	}

	$input['dob'] = trim($_POST['dob'] ?? '');
	if (!validateDate($input['dob'])) {
		$errors[] = 'Please enter the Date of Birth.';
	}

	$input['status'] = trim($_POST['status'] ?? '');
	if (! strlen($input['status'])) {
		$input['status'] = 1;
	}

	$input['role'] = trim($_POST['role'] ?? '');
	if (! strlen($input['role'])) {
		$input['role'] = 1;
	}

	return array($errors, $input);
}

/*
function process_form($input) {
	// ввести имя пользователя в сеанс
	$_SESSION['username'] = $input['username'];
	print "Welcome, $_SESSION[username]";
}
*/

function process_form($input) {
	// получить в этой функции доступ к глобальной переменной $db
	global $db;

	try {
		$stmt = $db->prepare('INSERT INTO users (user_login, user_password, user_name, user_surname, user_phone, dob, delivery_address, status, role) VALUES (?,?,?,?,?,?,?,?,?)');
		$stmt->execute(array($input['user_login'], $input['user_password'], $input['user_name'], $input['user_surname'], $input['user_phone'], $input['dob'], $input['delivery_address'], $input['status'], $input['role']));

		print 'Added ' . htmlentities($input['user_login']) . ' to the database.';
		show_form();
	} catch (PDOException $e) {
		print "Couldn't add new user to the database.";
	}
}