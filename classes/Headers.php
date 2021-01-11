<?php
namespace Classes;

class Headers {
	private $form;
	private $title;
	private $db;

	public function __construct(FormHelper $form, $db) {
		$this->form = $form;
		$this->db = $db;
	}

	public function showHeaders() {
		list($errors, $inputs) = $this->selectHeader();
		if ($errors) {
				return $this->showBlockHeaders($errors);
		} else {
			// Переданные данные из формы достоверны, обработать их
			return $this->showBlockHeaders($inputs);
		}
	}

	private function selectHeader(){
		$stmt = $this->db->prepare('SELECT id, page_name, title, description, metakeys FROM header');
		$stmt->execute();
		// знак косой черты "\" перед PDO нужен для объявления глобального пространства имён
		$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		if (!$result) {
			$errors[] = 'Check your database connection.';
		}
		return array($errors, $result);
		
	}


	private function showBlockHeaders($headers){
		$form = $this->form;
		include './elements/headers_block.php';


	}

}