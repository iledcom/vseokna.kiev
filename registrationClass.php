<?php

class Registration {

	private $form;
	private $db;
	private $inputs = array();
	private $validate;

	public function __construct (FormHelper $form, Validate $validate, $db, $server) {
		$this->form = $form;
		$this->db = $db;
		$this->inputs = $server;
		$this->validate = $validate->validateForm($this->inputs);
	}

	public function registrationStart() {
		$post = $_SERVER['REQUEST_METHOD'];
		list($errors, $valid_inputs) = $this->validate;
		if ($post == 'POST') {
			// Если функция validate_form() возвратит ошибки,
			// передать их функции show_form()
			if ($errors) {
				return $this->show_form($errors);
			} else {
				// Переданные данные из формы достоверны, обработать их
				return $this->process_form($valid_inputs);
			}
		} else {
			// Данные из формы не переданы, отобразить ее снова
			return $this->show_form($errors);
		}
	}

	protected function show_form($errors) {
		$form = $this->form;
		if ($errors) {
			$errorHtml = '<ul><li>';
			$errorHtml .= implode('</li><li>',$errors);
			$errorHtml .= '</li></ul>';
		} else {
			$errorHtml = '';
		}
		include 'registration_form.php';
	}

/*
	protected function validate_form() {
		$inputs = $this->inputs;
		$errors = array();
		foreach ($inputs as $input => &$value) {
			$value = trim($value);
			if (! strlen($value)) {
				$errors[] = "Please enter the $input.";
			}
			if ($input == 'dob') {
				if (!$this->validateDate($inputs['dob'])) {
					$errors[] = 'Please enter the correct Date of Birth.';
				}
			}
		}
			return array($errors, $inputs);
	}
*/
	protected function process_form($valid_inputs) {
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
/*
	private function validateDate($date, $format = 'd.m.Y') {
	  $d = DateTime::createFromFormat($format, $date);
	  return $d && $d->format($format) == $date;
	}
*/
}