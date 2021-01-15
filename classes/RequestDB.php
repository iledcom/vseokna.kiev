<?php

namespace Classes;
class RequestDB {
	//private $mysqli;
	private $db;
	private $prefix = false;
	
	public function __construct() {
		$this->db = \Classes\DataBase::connect();
	}

	public function getQuery($query, $params) {
		if ($params) {

			for ($i = 0; $i < count($params); $i++) {
				$pos = strpos($query, $offset);
				if (is_null($params[$i])) $arg = "NULL";
				else $arg = "'".$this->db->prepare($params[$i])."'";
				$query = substr_replace($query, $arg, $pos);
				$offset = $pos + strlen($arg);
			}
		}
		return $query;
	}
	
	public function select(Select $select) {
		$result_set = $this->getResultSet($select, true, true);
		if (!$result_set) return false;
		$array = array();
		while (($row = $result_set->fetch_assoc()) != false)
			$array[] = $row;
		return $array;
	}
	
	public function selectRow(Select $select) {
		$result_set = $this->getResultSet($select, false, true);
		if (!$result_set) return false;
		return $result_set->fetch_assoc();
	}
	
	public function selectCol(Select $select) {
		$result_set = $this->getResultSet($select, true, true);
		if (!$result_set) return false;
		$array = array();
		while (($row = $result_set->fetch_assoc()) != false) {
			foreach ($row as $value) {
				$array[] = $value;
				break;
			}
		}
		return $array;
	}
	
	public function selectCell(Select $select) {
		$result_set = $this->getResultSet($select, false, true);
		if (!$result_set) return false;
		$arr = array_values($result_set->fetch_assoc());
		return $arr[0];
	}
	
	public function insert($table_name, $row) {
		if (count($row) == 0) return false;
		$table_name = $this->getTableName($table_name);
		$fields = "(";
		$values = "VALUES (";
		$params = array();
		foreach ($row as $key => $value) {
			$fields .= "$key,";
			$params[] = $value;
		}
		$fields = substr($fields, 0, -1);
		$values = substr($values, 0, -1);
		$fields .= ")";
		$values .= ")";
		$query = "INSERT INTO $table_name $fields $values";
		return $this->query($query, $params);
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
	
	public function delete($table_name, $where = false, $params = array()) {
		$table_name = $this->getTableName($table_name);
		$query = "DELETE FROM $table_name";
		if ($where) $query .= " WHERE $where";
		return $this->query($query, $params);
	}
	
	public function getTableName($table_name) {
		return $this->prefix.$table_name;
	}
	
	private function query($query, $params = false) {
		$success = $this->mysqli->query($this->getQuery($query, $params));
		if (!$success) return false;
		if ($this->mysqli->insert_id === 0) return true;
		return $this->mysqli->insert_id;
	}
	
	private function getResultSet(Select $select, $zero, $one) {

		$stmt = $db->prepare($select);  // использовать вместо переменной $db переменную $pdo ?
    $stmt->execute($ex_param);
    $result = $stmt->fetch(\PDO::FETCH_ASSOC);

		if (!$result) return false;
		if ((!$zero) && ($result->rowCount() == 0)) return false;
		if ((!$one) && ($result->rowCount() == 1)) return false;
		return $result;
	}
	
	public function __destruct() {
		if (($this->db) && (!$this->db->errorInfo())) $this->db->closeCursor();
	}
}

?>