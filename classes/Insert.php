<?php

namespace Classes;

class Insert {
	private $rdb;
	private $table_name;
	private $row;

	public function __construct($rdb, $table_name, $row) {
		$this->rdb = \Classes\DataBase::connect();
		$this->table_name = $table_name;
		$this->row = $row;
	}

	public function insert() {
		$table_name = $this->table_name;
		$row = $this->row;
		if (count($row) == 0) return false;
		$fields = "(";
		$values = "VALUES (";
		$params = array();
		foreach ($row as $key => $value) {
			$fields .= "$key,";
			$params[] = $value;
		}
		$fields = substr($fields, 0, -1);
		for ($i=0; $i < count($params); $i++) { 
			$values .= '?,';
		}
		$values = substr($values, 0, -1);
		$fields .= ")";
		$values .= ")";
		$query = "INSERT INTO $table_name $fields $values";
		$stmt = $this->rdb->prepare($query);

		return $stmt->execute($params);
	}

}

?>