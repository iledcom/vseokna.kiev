<?php
namespace Site;
session_start();

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
$registration = new \Classes\Registration($validate, $db, $server);

$registration->registrationStart();




