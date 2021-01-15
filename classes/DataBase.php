<?php
namespace Classes;

abstract class DataBase {

	static public $link;

	private function __construct() {

	}

	static public function connect() {
		$config = require_once (CLASS_DIR . '../admin/config.php');
		$host = $config['host'];
		$db_name = $config['db_name'];
		$username = $config['username'];
		$password = $config['password'];
		$charset = $config['charset'];
		$dsn = 'mysql:host=' . $host . '; dbname=' . $db_name . ';charset=' . $charset .'';
		try {
			// знак косой черты "\" перед PDO нужен для объявления глобального пространства имён
			self::$link = new \PDO($dsn, $username, $password);
		} catch (PDOException $e) {
			print "Can't connect: " . $e->getMessage();
			exit();
		}

		self::$link->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		
		return self::$link;
	}



}
