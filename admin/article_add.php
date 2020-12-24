<?php
namespace Admin\Elements;
session_start();

if($_SESSION['role'] == 1) {
// загрузить вспомогательный класс для составления форм
date_default_timezone_set('Europe/Kiev');
define('CLASS_DIR', $_SERVER['DOCUMENT_ROOT'] . '/classes/');

 
spl_autoload_register(function($class) {
  $string = explode('\\', $class);
  $last = array_pop($string);
  $fn = $last . '.php';
  $fn = CLASS_DIR . str_replace('\\', '/', $fn);
  if (file_exists($fn)) require $fn; 
}, $throw = true);


// подключиться к базе данных
$db = \Classes\DataBase::connect();


$server = $_POST;
$validate = new \Classes\Validate($db);
$article_add = new \Classes\ArticleAdd($validate, $db, $server);
$article_add->createArticle();
} else {
	$errors = array('Error 404. Page not found or does not exist');
	print $errors[0];
}