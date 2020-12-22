<?php

class Article implements ArrayAccess {


	private $db;
	private $inputs = array();
	private $article = array();

	public function __construct($db, $inputs = array()) {
		$this->db = $db;
		$this->inputs = $inputs;
		$this->article = $this->selectArticle($this->inputs);
	}

	private function selectArticle($valid_inputs){
		$stmt = $this->db->prepare('SELECT cat, title, description, art_text, art_date, metatitle, metadesc, metakeys, slug FROM article WHERE art_id = ?');
		$stmt->execute(array($valid_inputs['art_id']));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		if (! $result) {
			$errors[] = 'Please enter the correct title of the article.';
			return $errors;
		} else {
			return $result;
		}
	}

	public function offsetSet($offset, $value) {
      if (is_null($offset)) {
          $this->article[] = $value;
      } else {
          $this->article[$offset] = $value;
      }
    }

  public function offsetExists($offset) {
      return isset($this->article[$offset]);
  }

  public function offsetUnset($offset) {
      unset($this->article[$offset]);
  }

  public function offsetGet($offset) {
      return isset($this->article[$offset]) ? $this->article[$offset] : null;
  }


} ?>