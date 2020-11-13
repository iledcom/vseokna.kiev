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


function process_form($input) {
	// ввести имя пользователя в сеанс
	$_SESSION['username'] = $input['username'];
	print "Welcome, $_SESSION[username]";
}