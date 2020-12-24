<?php
namespace Classes;

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
		$srm = $_SERVER['REQUEST_METHOD'];
		if ($srm == 'POST'  && $this->inputs['edit']) {
			return $this->startEdit($srm);
		} else {
			return $this->saveEdit($srm);
		}
	}

	private function startEdit($srm){ 
		$article = new Article($this->db, $this->inputs);
		$art_id = $this->inputs['art_id'];
		$this->setArtId($art_id);
		list($errors, $valid_inputs) = $this->validate->validateForm($article);
		if ($srm == 'POST'  && $this->inputs['edit']) {
			return $this->showForm($valid_inputs);
		} else {
			// Данные из формы не переданы, отобразить ее снова
			return $this->showForm($errors);
		}
	}

	private function saveEdit($srm) {
		list($errors, $valid_inputs) = $this->validate->validateForm($this->inputs);
		if ($srm == 'POST'  && $this->inputs['save']) {
			if ($errors) {
				return $this->showForm($errors);
			} else {
			 	return $this->saveEditing($valid_inputs);
			}
		} else {
			// Данные из формы не переданы, отобразить ее снова
			return $this->showForm($errors);
		}
	}

	private function setArtId($art_id) {
		$_SESSION['art_id'] = $art_id;
	}

	private function showForm($article){
		$date = date('d.m.Y H:i:s');
		$defaults = array('art_date' => $date);
		$form = new FormHelper($defaults);
		include './elements/editing_form.php';
	}

	private function saveEditing($valid_inputs){
		$input = $valid_inputs;
		$art_id = $_SESSION['art_id'];


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

			$stmt = $this->db->prepare('UPDATE article SET cat = ?, title = ?, description = ?, art_text = ?, art_date = ?, metatitle = ?, metadesc = ?, metakeys = ?, slug = ? WHERE art_id = ?');
			$stmt->execute(array($cat, $input['title'], $input['description'], $input['art_text'], $input['art_date'], $input['metatitle'], $input['metadesc'], $input['metakeys'], $input['slug'], $art_id));
			
			// сообщить пользователю о вводе изменений в базу данных
			print 'Added changes of the article ' . htmlentities($input['title']) . ' to the database.';
			$this->showForm($input);

		} catch (PDOException $e) {
			print $e . "Couldn't add your article to the database.";
		}
	}	
	
}