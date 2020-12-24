<?php
namespace Site;
session_start();

define('CLASS_DIR', __DIR__ . '/classes/');
 
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
$form = new \Classes\FormHelper();
$validate = new \Classes\Validate($db);
$authorization = new \Classes\Authorization($form, $validate, $db, $server);

$authorization->authorizationStart();





