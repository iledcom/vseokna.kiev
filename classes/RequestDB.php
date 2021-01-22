<?php

namespace Classes;
class RequestDB {
	private $db;
	
	public function __construct() {
		$this->db = \Classes\DataBase::connect();
	}

	

	public function insert($table_name, $row) {
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
		$stmt = $this->db->prepare($query);

		return $stmt->execute($params);
	}

	public function update($table_name, $row, $where = false, $params = array()) {
		//$params - параметр для подстановки вместо знака вопроса в запросе WHERE $where = ?
		if (count($row) == 0) return false;
		$query = "UPDATE $table_name SET ";
		$params_add = array();
		foreach ($row as $key => $value) {
			$query .= "$key = "." ?,";
			$params_add[] = $value;
		}
		$query = substr($query, 0, -1);
		if ($where) {
			$params = array_merge($params_add, $params);
			$query .= " WHERE $where = ?";
		}
		$stmt = $this->db->prepare($query);

		return $stmt->execute($params);
	}

	public function delete($table_name, $where = false, $params = array()) {
		$query = "DELETE FROM $table_name";
		if ($where) $query .= " WHERE $where =?";
		$stmt = $this->db->prepare($query);
		print_r($stmt);
		return $stmt->execute($params);
	}

	public function select($table_name, $fields, $where = false, $values = false, $and = false) {
		$select = new Select($this->db);
		$select->from($table_name, $fields);
		if($where) $select->where($where, $values, $and);
		print $select;
		$stmt = $this->db->prepare($select);
		$stmt->execute($params);
		$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		
		//print_r($result);
		return $result;
	}
		
	
	public function __destruct() {
		if (($this->db) && (!$this->db->errorInfo())) $this->db->closeCursor();
	}
}

?>