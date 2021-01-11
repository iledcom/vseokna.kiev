<?php
namespace Classes;

class Header implements \ArrayAccess {


	private $db;
	private $inputs = array();
	private $header = array();

	public function __construct($db, $inputs = array()) {
		$this->db = $db;
		$this->inputs = $inputs;
		$this->header = $this->selectHeader($this->inputs);
	}

	private function selectHeader($valid_inputs){
		$stmt = $this->db->prepare('SELECT id, page_name, title, description, metakeys FROM header WHERE id = ?');
		$stmt->execute(array($valid_inputs['id']));
		$result = $stmt->fetch(\PDO::FETCH_ASSOC);
		if (! $result) {
			$errors[] = 'Please enter the correct title of the header.';
			return $errors;
		} else {
			return $result;	
		}
	}

	public function offsetSet($offset, $value) {
      if (is_null($offset)) {
          $this->header[] = $value;
      } else {
          $this->header[$offset] = $value;
      }
    }

  public function offsetExists($offset) {
      return isset($this->header[$offset]);
  }

  public function offsetUnset($offset) {
      unset($this->header[$offset]);
  }

  public function offsetGet($offset) {
      return isset($this->header[$offset]) ? $this->header[$offset] : null;
  }


} ?>