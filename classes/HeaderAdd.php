<?php
namespace Classes;

class HeaderAdd {

	private $db;
	private $inputs = array();
	private $validate;

	public function __construct(Validate $validate, $db, $server) {
		$this->db = $db;
		$this->inputs = $server;
		$this->validate = $validate;
	}

	public function createHeader() {
		$post = $_SERVER['REQUEST_METHOD'];
		list($errors, $valid_inputs) = $this->validate->validateForm($this->inputs);
		if ($post == 'POST') {
			// Если функция validateForm () возвратит ошибки,
			// передать их функции showForm()
			if ($errors) {
				return $this->showForm($errors);
			} else {
				// Переданные данные из формы достоверны, обработать их
				return $this->processForm($valid_inputs);
			}
		} else {
			// Данные из формы не переданы, отобразить ее снова
			return $this->showForm($errors);
		}
	}

	protected function showForm($errors) {
		$date = date('d.m.Y H:i:s');
		$defaults = array('art_date' => $date);
		// создать объект $form с надлежащими свойствами по умолчанию
		$form = new FormHelper($defaults);
		// Ради ясности весь код HTML-разметки и отображения
		// формы вынесен в отдельный файл
		include './elements/insert-header.php';
	}

	protected function processForm($valid_inputs) {
		$input = $valid_inputs;

		try {
			$stmt = $this->db->prepare('INSERT INTO header (page_name, title, description, metakeys) VALUES (?,?,?,?)');
			$stmt->execute(array($input['page_name'], $input['title'], $input['description'], $input['metakeys']));
			// сообщить пользователю о вводе блюда в базу данных
			print 'Added ' . htmlentities($input['title']) . ' to the database.';
			$this->showForm($errors);
		} catch (PDOException $e) {
			print "Couldn't add your Header to the database.";
		}
	}

}