<?php
namespace Classes;

class Articles {
	private $form;
	private $title;
	private $db;

	public function __construct(FormHelper $form, $db) {
		$this->form = $form;
		$this->db = $db;
	}

	public function showArticle() {
		list($errors, $inputs) = $this->selectArticle();
		if ($errors) {
				return $this->showBlockArticles($errors);
		} else {
			// Переданные данные из формы достоверны, обработать их
			return $this->showBlockArticles($inputs);
		}
	}

	private function selectArticle(){
		$stmt = $this->db->prepare('SELECT art_id, cat, title, description, art_text, art_date, metatitle, metadesc, metakeys, slug FROM article');
		$stmt->execute();
		// знак косой черты "\" перед PDO нужен для объявления глобального пространства имён
		$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		
		if (!$result) {
			$errors[] = 'Check your database connection.';
		}
		return array($errors, $result);
		
	}


	private function showBlockArticles($articles){
		$form = $this->form;
		include './elements/articles_block.php';


	}

}