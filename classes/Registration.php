<?php
namespace Classes;

class Registration {


	private $db;
	private $inputs = array();
	private $validate;

	public function __construct (Validate $validate, $db, $server) {
		$this->db = $db;
		$this->inputs = $server;
		$this->validate = $validate;
	}

	public function registrationStart() {
		$post = $_SERVER['REQUEST_METHOD'];
		list($errors, $valid_inputs) = $this->validate->validateForm($this->inputs);
		if ($post == 'POST') {
			// Если функция validate_form() возвратит ошибки,
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
		$form = new \Classes\FormHelper();
		if ($errors) {
			$errorHtml = '<ul><li>';
			$errorHtml .= implode('</li><li>',$errors);
			$errorHtml .= '</li></ul>';
		} else {
			$errorHtml = '';
		}
		include 'registration_form.php';
	}


	protected function processForm($valid_inputs) {
		$db = $this->db;
		$inputs = $valid_inputs;
		$inputs['user_password'] = password_hash($inputs['user_password'], PASSWORD_DEFAULT);

		try {
			$stmt = $db->prepare('INSERT INTO users (user_login, user_password, user_name, user_surname, user_phone, dob, delivery_address) VALUES (?,?,?,?,?,?,?)');
			$stmt->execute(array($inputs['user_login'], $inputs['user_password'], $inputs['user_name'], $inputs['user_surname'], $inputs['user_phone'], $inputs['dob'], $inputs['delivery_address']));

			print 'Added ' . htmlentities($inputs['user_login']) . ' to the database.';
			// ввести имя пользователя в сеанс
			$_SESSION['username'] = $inputs['user_name'];
		} catch (PDOException $e) {
			print "Couldn't add new user to the database.";
		}	
	}

}