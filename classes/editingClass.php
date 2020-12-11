<?php

class Editing {
	private $db;
	private $form;
	private $validate;
	private $inputs = array();
	
	public function __construct(Validate $validate, $db, $post){
		$this->form = $form;
		$this->validate = $validate;
		$this->db = $db;
		$this->inputs = $post;	
	}

	public function editArticle() {
		$post = $_SERVER['REQUEST_METHOD'];
		list($errors, $valid_inputs) = $this->validate->validateForm($this->inputs);
		if ($post == 'POST'  && $this->inputs['edit']) {
			// Если функция validateForm () возвратит ошибки,
			// передать их функции showForm()
			if ($errors) {
				return $this->showForm($errors);
			} else {
			 	$article = new Article($this->db, $valid_inputs);
			 	return $this->showForm($article);
			}
		} elseif($this->inputs['save']) {
			//сохранить изменения в базу данных
			return $this->saveEditing($valid_inputs);
		} else {
			// Данные из формы не переданы, отобразить ее снова
			return $this->showForm($errors);
		}
	}

	private function showForm($article){
		$date = date('d.m.Y H:i:s');
		$defaults = array('art_date' => $date);
		$form = new FormHelper($defaults);
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
			$stmt = $this->db->prepare('UPDATE article 
				SET 
					cat=:cat, 
					title=:title, 
					description=:description, 
					art_text=:art_text, 
					art_date=:art_date,
					metatitle:=metatitle, 
					metadesc=:metadesc, 
					metakeys=:metakeys, 
					slug=:slug
				WHERE art_id = :art_id');

			$stmt->bindParam(":cat", $cat);
			$stmt->bindParam(":title", $input['title']);
			$stmt->bindParam(":description", $input['description']);
			$stmt->bindParam(":art_text", $input['art_text']);
			$stmt->bindParam(":art_date", $input['art_date']);
			$stmt->bindParam(":metatitle", $input['metatitle']);
			$stmt->bindParam(":metadesc", $input['metadesc']);
			$stmt->bindParam(":metakeys", $input['metakeys']);
			$stmt->bindParam(":slug", $input['slug']);
			$stmt->bindParam(":art_id", $input['art_id']);

			$stmt->execute();
			// сообщить пользователю о вводе изменений в базу данных
			print 'Added changes of the article ' . htmlentities($input['title']) . ' to the database.';
			$this->showForm($errors);

		} catch (PDOException $e) {
			print $e . "Couldn't add your article to the database.";
		}
	}	
	
}