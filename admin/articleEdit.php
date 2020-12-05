<?php

// загрузить вспомогательный класс для составления форм
require './modules/FormHelper.php';
require '../classes/validateClass.php';
require '../classes/editingClass.php';
date_default_timezone_set('Europe/Kiev');

// подключиться к базе данных
try {
	$db = new PDO('mysql:host=localhost; dbname=test_db', 'root', '');
} catch (PDOException $e) {
	print "Can't connect: " . $e->getMessage();
	exit();
}
// установить исключения при ошибках в базе данных
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// Основная логика функционирования страницы:
// - Если форма передана на обработку, проверить достоверность
// данных, обработать их и снова отобразить форму.
// - Если форма не передана на обработку, отобразить ее снова

$server = $_POST;
$validate = new Validate($db);
$edit = new Editing($validate, $db, $server);

$edit->editArticle();
