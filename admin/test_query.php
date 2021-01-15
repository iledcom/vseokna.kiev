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
//$db = \Classes\DataBase::connect();


	$post = $_POST;
	$form = new \Classes\FormHelper();
	$validate = new \Classes\Validate($db);
	$request = new \Classes\RequestDB();
	$select = new \Classes\Select($request);
	$fields = array('cat', 'title', 'description');
	$request->getQuery();
	


} else {
	$errors = array('Error 404. Page not found or does not exist');
	print $errors[0];
}