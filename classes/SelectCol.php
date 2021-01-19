<?php

namespace Classes;

class SelectCol extends Select {
	private $rdb;
	
	public function __construct($rdb) {
		parent::__construct($this->rdb);
		$this->rdb = $rdb;
	}


	public function getCol() {
		$result_set = $this->getResultSet($select, true, true);
		if (!$result_set) return false;
		$array = array();
		while (($row = $result_set->fetch(\PDO::FETCH_ASSOC)) != false) {
			foreach ($row as $value) {
				$array[] = $value;
				break;
			}
		}
		return $array;
	}
}

?>