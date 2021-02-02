<?php
namespace Classes;

class TestGetArticles {
	private $form;
	private $title;
	private $request;

	public function __construct(FormHelper $form, RequestDB $request) {
		$this->form = $form;
		$this->request = $request;
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
		$request = $this->request;
		$table_name = 'article';
		$fields = array('art_id', 'cat', 'title', 'description', 'art_text', 'art_date', 'metatitle', 'metadesc', 'metakeys', 'slug');
		$where = false;
		$params = array(0);
		$and = false;
		$in = false;
		$result = $request->select($table_name, $fields, $where, $params, $and, $in);
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