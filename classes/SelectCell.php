<?php

namespace Classes;

class SelectCell extends Select {
	private $rdb;
	
	public function __construct($rdb) {
		parent::__construct($this->rdb);
		$this->rdb = $rdb;
	}


	public function getCell() {
		$result_set = $this->getResultSet($select, false, true);
		if (!$result_set) return false;
		$arr = array_values($result_set->fetch(\PDO::FETCH_ASSOC));
		return $arr[0];
	}
}

?>