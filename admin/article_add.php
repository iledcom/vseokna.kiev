<?php

// загрузить вспомогательный класс для составления форм
require './modules/FormHelper.php';
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
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// Если функция validate_form() возвратит ошибки,
// передать их функции show_form()
	list($errors, $input) = validate_form();
	if($errors) {
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
	// установить свои значения по умолчанию:

	$date = date('d-m-Y H:i:s');
	$defaults = array('art_date' => $date);
	// создать объект $form с надлежащими свойствами по умолчанию
	$form = new FormHelper($defaults);
	// Ради ясности весь код HTML-разметки и отображения
	// формы вынесен в отдельный файл
	include './elements/insert-form.php';
}

function validate_form() {
	$input = array();
	$errors = array();

	// обязательное название категории
	$input['cat'] = trim($_POST['cat'] ?? '');
	if (! strlen($input['cat'])) {
		$errors[] = 'Please enter the cat.';
	}
	// обязательный заголовок статьи
	$input['title'] = trim($_POST['title'] ?? '');
	if (! strlen($input['title'])) {
		$errors[] = 'Please enter the title.';
	}
	// обязательный анонс статьи
	$input['description'] = trim($_POST['description'] ?? '');
	if (! strlen($input['description'])) {
		$errors[] = 'Please enter the description.';
	}
	// обязательный текст статьи
	$input['art_text'] = trim($_POST['art_text'] ?? '');
	if (! strlen($input['art_text'])) {
		$errors[] = 'Please enter the article text.';
	}
	// обязательный мета заголовок (нужен для СЕО)
	$input['metatitle'] = trim($_POST['metatitle'] ?? '');
	if (! strlen($input['metatitle'])) {
		$errors[] = 'Please enter the metatitle.';
	}

	// обязательное мета описание страницы
	$input['metadesc'] = trim($_POST['metadesc'] ?? '');
	if (! strlen($input['metadesc'])) {
		$errors[] = 'Please enter the metadesc.';
	}

	// обязательные ключевые слова для поиска страницы
	$input['metakeys'] = trim($_POST['metakeys'] ?? '');
	if (! strlen($input['metakeys'])) {
		$errors[] = 'Please enter the metakeys.';
	}

	$input['slug'] = trim($_POST['slug'] ?? '');
	if (! strlen($input['slug'])) {
		$errors[] = 'Please enter the slug.';
	}

	// цена должна быть указана достоверным положительным числом
	// с плавающей точкой
	function validateDate($date, $format = 'd-m-Y H:i:s') {
	  $d = DateTime::createFromFormat($format, $date);
	  return $d && $d->format($format) == $date;
	}

	$input['art_date'] = trim($_POST['art_date'] ?? '');
	if (!validateDate($input['art_date'])) {
		$errors[] = 'Please enter a valid date.';
	}

	return array($errors, $input);
}

function process_form($input) {
	// получить в этой функции доступ к глобальной переменной $db
	global $db;
/*
	if ($input['cat'] == 1) {
    $cat = 'news';
	} elseif ($input['cat'] == 2) {
    	$cat = 'manufacturer';
	} else {
	    $cat = 'products';
	}
*/
	switch ($input['cat']) {
    case 1:
        $cat = "news";
        break;
    case 2:
        $cat = "manufacturer";
        break;
    case 3:
        $cat = "products";
        break;
	}	


	// ввести новое блюдо в таблицу базы данных
	try {
		$stmt = $db->prepare('INSERT INTO article (cat, title, description, art_text, art_date, metatitle, metadesc, metakeys, slug) VALUES (?,?,?,?,?,?,?,?,?)');
		$stmt->execute(array($cat, $input['title'], $input['description'], $input['art_text'], $input['art_date'], $input['metatitle'], $input['metadesc'], $input['metakeys'], $input['slug']));
		// сообщить пользователю о вводе блюда в базу данных
		print 'Added ' . htmlentities($input['title']) . ' to the database.';
		show_form();
	} catch (PDOException $e) {
		print "Couldn't add your article to the database.";
	}
}
