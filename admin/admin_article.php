<?php
session_start();

if($_SESSION['role'] == 1) {
	// загрузить вспомогательный класс для составления форм
	require './modules/FormHelper.php';
	require '../classes/dbClass.php';
	require '../classes/validateClass.php';
	require '../classes/articlesClass.php';
	require '../classes/articleClass.php';
	require '../classes/editingClass.php';
	require '../classes/adminArticleClass.php';

	date_default_timezone_set('Europe/Kiev');

  $db = DataBase::connect();

	$post = $_POST;
	$form = new FormHelper();
	$validate = new Validate($db);
	$admin_article = new AdminArticle($validate, $form, $db, $post);
	$admin_article->startProcess();

} else {
	$errors = array('Error 404. Page not found or does not exist');
	print $errors[0];
}