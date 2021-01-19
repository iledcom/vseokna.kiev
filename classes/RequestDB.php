<?php

namespace Classes;
class RequestDB {
	//private $mysqli;
	private $db;
	
	public function __construct() {
		//$this->db = \Classes\DataBase::connect();
	}


	public static function createQuery($method) {
		if(method_exists($operator))
			return $method;
		else
			throw new Exception('Method'.$method.' not exists!');
	}
		
	
	public function __destruct() {
		if (($this->db) && (!$this->db->errorInfo())) $this->db->closeCursor();
	}
}

?>