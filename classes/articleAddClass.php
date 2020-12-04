<?php

class ArticleAdd {

	private $form;
	private $db;
	private $inputs = array();
	private $validate;

	public function __construct(Validate $validate, $db, $server) {
		$this->db = $db;
		$this->inputs = $server;
		$this->validate = $validate;
	}

	public function createArticle() {
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
		include './elements/insert-form.php';
	}

	protected function processForm($valid_inputs) {
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
			// сообщить пользователю о вводе блюда в базу данных
			print 'Added ' . htmlentities($input['title']) . ' to the database.';
			$this->showForm($errors);
			//Важно !!! Нужно создать форму для редактирования уже добавленных статей и выводить её после добавления статьи
		} catch (PDOException $e) {
			print "Couldn't add your article to the database.";
		}
	}

}