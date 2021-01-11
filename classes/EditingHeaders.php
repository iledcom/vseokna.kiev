<?php
namespace Classes;

class EditingHeaders {
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

	public function editHeader() {
		$srm = $_SERVER['REQUEST_METHOD'];
		if ($srm == 'POST'  && $this->inputs['edit']) {
			return $this->startEdit($srm);
		} else {
			return $this->saveEdit($srm);
		}
	}

	private function startEdit($srm){ 
		$header = new Header($this->db, $this->inputs);
		$id = $this->inputs['id'];
		$this->setId($id);
		list($errors, $valid_inputs) = $this->validate->validateForm($header);
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

	private function setId($id) {
		$_SESSION['header_id'] = $id;
	}

	private function showForm($header){
		$form = new FormHelper();
		include './elements/editingheaders_form.php';
	}

	private function saveEditing($valid_inputs){
		$input = $valid_inputs;
		$id = $_SESSION['header_id'];

		try {

			$stmt = $this->db->prepare('UPDATE header SET page_name = ?, title = ?, description = ?, metakeys = ?, slug = ? WHERE art_id = ?');
			$stmt->execute(array($input['page_name'], $input['title'], $input['description'], $input['metakeys'], $id));
			
			// сообщить пользователю о вводе изменений в базу данных
			print 'Added changes of the Header ' . htmlentities($input['title']) . ' to the database.';
			$this->showForm($input);

		} catch (PDOException $e) {
			print $e . "Couldn't add your Header to the database.";
		}
	}	
	
}