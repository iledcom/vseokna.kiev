<?php
namespace Classes;

class ViewArticle {


	private $request;
	private $inputs = array();

	public function __construct(RequestDB $request, $inputs = array()) {
		$this->request = $request;
		$this->inputs = $inputs;
	}

	public function showArticle() {
		list($errors, $data) = $this->selectArticle();
		if ($errors) {
				return $this->viewArticles($errors);
		} else {
			// Переданные данные из формы достоверны, обработать их
			return $this->viewArticles($data);
		}
	}

	private function selectArticle(){
		$request = $this->request;
		$table_name = 'article';
		$fields = array('art_id', 'cat', 'title', 'description', 'art_text', 'art_date', 'metatitle', 'metadesc', 'metakeys', 'slug');
		$where = 'art_id';
		$inputs = $this->inputs;
		$array = array();
		foreach ($inputs as $input => $value) {
			$array[] = $value;
		}
		$params = array($array[0]);
		$and = false;
		$in = false;
		$result = $request->select($table_name, $fields, $where, $params, $and, $in);
		/*$stmt = $this->db->prepare('SELECT cat, title, description, art_text, art_date, metatitle, metadesc, metakeys, slug FROM article WHERE art_id = ?');
		$stmt->execute(array($valid_inputs['art_id']));
		$result = $stmt->fetch(\PDO::FETCH_ASSOC);
		*/
		if (!$result) {
			$errors[] = 'Please enter the correct title of the article.';
			return $errors;
		} else {
			return $result;
		}
	}

	private function viewArticles($article){
		include '../view/view_article.php';
	}


} ?>