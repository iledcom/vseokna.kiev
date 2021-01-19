<?php

namespace Classes;

class SelectRow extends Select {
	private $rdb;
	
	public function __construct($rdb) {
		parent::__construct($this->rdb);
		$this->rdb = $rdb;
	}


	public function getRow() {
		$result_set = parent::getResultSet($select, false, true);
		if (!$result_set) return false;
		return $result_set->fetch(\PDO::FETCH_ASSOC);
	}
}