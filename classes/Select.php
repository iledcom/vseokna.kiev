<?php

namespace Classes;
class Select {
	
	private $db;
	private $from = "";
	private $where = "";
	private $order = "";
	private $limit = "";
	
	public function __construct($db) {
		$this->db = $db;
	}
// 

	public function from($table_name, $fields) {

		$from = "";
		if ($fields == "*") $from = "*";
		else {
			for ($i = 0; $i < count($fields); $i++) {
				if (($pos_1 = strpos($fields[$i], "(")) !== false) {
					$pos_2 = strpos($fields[$i], ")");
					$from .= substr($fields[$i], 0, $pos_1)."(".substr($fields[$i], $pos_1 + 1, $pos_2 - $pos_1 - 1)."),";
				}
				else $from .= $fields[$i].",";
			}
			$from = substr($from, 0, -1);
		}
		$from .= " FROM $table_name";
		$this->from = $from;
		return $this;
	}
	
	public function where($where, $values = array(), $and = true) {
		$where .= "=?";
		$this->where = "WHERE $where";
		if ($and) {
			$this->addWhere($and, $values);	
		}
		return $this;
	}
	
	public function whereIn($field, $values, $and = true) {
		$where = "$field IN (";
		foreach ($values as $value) {
			$where .= "?".",";
		}
		$where = substr($where, 0, -1);
		$where .= ")";
		$this->where = "WHERE $where";
		return $this;
	}
	
	public function whereFIS($col_name, $value, $and = true) {
		$where = "FIND_IN_SET (".$this->db->getSQ().", $col_name) > 0";
		return $this->where($where, array($value), $and);
	}
	
	public function order($field, $ask = true) {
		if (is_array($field)) {
			$this->order = "ORDER BY ";
			if (!is_array($ask)) {
				$temp = array();
				for ($i = 0; $i < count($field); $i++) $temp[] = $ask;
				$ask = $temp;
			}
			for ($i = 0; $i < count($field); $i++) {
				$this->order .= $field[$i];
				if (!$ask[$i]) $this->order .= " DESC,";
				else $this->order .= ",";
			}
			$this->order = substr($this->order, 0, -1);
		}
		else {
			$this->order = "ORDER BY $field";
			if (!$ask) $this->order .= " DESC";
		}
		return $this;
	}
	
	public function limit($count, $offset = 0) {
		$count = (int) $count;
		$offset = (int) $offset;
		if ($count < 0 || $offset < 0) return false;
		$this->limit = "LIMIT $offset, $count";
		return $this;
	}
	
	public function rand() {
		$this->order = "ORDER BY RAND()";
		return $this;
	}

	public function __toString() {
		if ($this->from) $sql = "SELECT ".$this->from." ".$this->where." ".$this->order." ".$this->limit;
		else $sql = "";
		return $sql;
	}
	
	private function addWhere($where, $and) {
		if ($this->where) {
			if ($and) $this->where .= " AND ";
			else $this->where .= " OR ";
			$this->where .= "$where =?";
		}
	}
}

?>