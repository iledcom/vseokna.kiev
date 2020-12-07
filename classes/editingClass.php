<?php

class Editing {
	private $db;
	private $form;
	private $validate;
	private $inputs = array();
	
	public function __construct(FormHelper $form, Validate $validate, $db, $post){
		$this->form = $form;
		$this->validate = $validate;
		$this->db = $db;
		$this->inputs = $post;	
	}

	public function editArticle() {
		$post = $_SERVER['REQUEST_METHOD'];
		list($errors, $valid_inputs) = $this->validate->validateForm($this->inputs);
		if ($post == 'POST') {
			// Если функция validateForm () возвратит ошибки,
			// передать их функции showForm()
			if ($errors) {
				return $this->showForm($errors);
			} else {
				// Переданные данные из формы достоверны, обработать их
				return $this->selectArticle($valid_inputs);
			}
		} else {
			// Данные из формы не переданы, отобразить ее снова
			return $this->showForm($errors);
		}
	}

	private function selectArticle($valid_inputs){
		$stmt = $this->db->prepare('SELECT cat, title, description, art_text, art_date, metatitle, metadesc, metakeys, slug FROM article WHERE title = ?');
		$stmt->execute(array($valid_inputs['title']));
		$result = $stmt->fetchAll();
		if (! $result) {
			$errors[] = 'Please enter the correct title of the article.';
		}
		return $this->showForm($errors);
		
	}

	private function showForm($errors){
		$date = date('d.m.Y H:i:s');
		$defaults = array('art_date' => $date);
		$form = $this->form;
		include './elements/editing_form.php';
	}

	private function saveEditing($valid_inputs){
		$input = $valid_inputs;

		switch ($input['cat']) {
	    case 1:
	        $cat = "news";
	        break;
	    case 2:
	        $cat = "manufacturer";
	        break;
	    case 3:
	        $cat = "products";
	        break;
		}	

		try {
			$stmt = $this->db->prepare('INSERT INTO article (cat, title, description, art_text, art_date, metatitle, metadesc, metakeys, slug) VALUES (?,?,?,?,?,?,?,?,?)');
			$stmt->execute(array($cat, $input['title'], $input['description'], $input['art_text'], $input['art_date'], $input['metatitle'], $input['metadesc'], $input['metakeys'], $input['slug']));
			// сообщить пользователю о вводе изменений в базу данных
			print 'Added changes of the article ' . htmlentities($input['title']) . ' to the database.';
			$this->showForm($errors);

		} catch (PDOException $e) {
			print "Couldn't add your article to the database.";
		}
	}	
	
}