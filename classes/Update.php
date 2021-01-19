<?php

namespace Classes;

class Update {
	private $rdb;

	public function __construct($rdb) {
		$this->rdb = $rdb;
	}

	public function update($table_name, $row, $where = false, $params = array()) {
		if (count($row) == 0) return false;
		$table_name = $this->getTableName($table_name);
		$query = "UPDATE $table_name SET ";
		$params_add = array();
		foreach ($row as $key => $value) {
			$query .= "$key = ".",";
			$params_add[] = $value;
		}
		$query = substr($query, 0, -1);
		if ($where) {
			$params = array_merge($params_add, $params);
			$query .= " WHERE $where";
		}
		return $this->query($query, $params);
	}

	
	
}

?>