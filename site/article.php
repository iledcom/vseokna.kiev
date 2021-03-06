<?php
namespace Admin;
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

	$post = $_POST;
	$request = new \Classes\RequestDB();
	$view_article = new \Classes\ViewArticle($request, $post);
	$view_article->showArticle();

} else {
	$errors = array('Error 404. Page not found or does not exist');
	print $errors[0];
}