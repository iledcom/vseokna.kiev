<?php

namespace Classes;

class Delete {
	private $rdb;

	public function __construct($rdb) {
		$this->rdb = $rdb;
	}

	public function delete($table_name, $where = false, $params = array()) {
		$table_name = $this->getTableName($table_name);
		$query = "DELETE FROM $table_name";
		if ($where) $query .= " WHERE $where";
		return $this->query($query, $params);
	}
	
	public function getTableName($table_name) {
		return $this->prefix.$table_name;
	}
	
	private function query($sql, $params = false) {
		$success = $this->db->query($this->getQuery($sql, $params));
		if (!$success) return false;
		if ($this->db->lastInsertId() === 0) return true;
		return $this->db->lastInsertId();
	}

	
	
}

?>