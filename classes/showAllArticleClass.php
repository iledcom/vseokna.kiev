<?php

class showArticles {
	$title;

	pablis function __construct() {

	}

	private function getArticle($inputs){
		$stmt = $this->db->prepare('SELECT cat, title, description, art_text, art_date, metatitle, metadesc, metakeys, slug FROM article WHERE title = ?');
		$stmt->execute(array($inputs['title']));
		$result = $stmt->fetchAll();
		if (! $result) {
			$errors[] = 'Please enter the correct title of the article.';
		}
		return array($errors, $result);
		
	}
}

	private function showTable($errors){
		$form = new FormHelper($defaults);
		include './elements/articles.php';
	}