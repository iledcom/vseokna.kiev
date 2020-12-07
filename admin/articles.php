<?php

// загрузить вспомогательный класс для составления форм
require './modules/FormHelper.php';
require '../classes/ArticlesClass.php';
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
$form = new FormHelper();
$articles = new Articles($form, $db);

$articles->displayArticle();
