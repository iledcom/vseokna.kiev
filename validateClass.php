<?php

class Validate {

	private $db;
	private $inputs;

	public function __construct () {
	}

	public function validateForm($inputs) {

		$errors = array();
		foreach ($inputs as $input => &$value) {
			$value = trim($value);
			if (!strlen($value)) {
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

	private function validateDate($date, $format = 'd.m.Y') {
	  $d = DateTime::createFromFormat($format, $date);
	  return $d && $d->format($format) == $date;
	}

	public function validatePass($db, $inputs) {

		$stmt = $db->prepare('SELECT user_password FROM users WHERE user_login = ?');
		$stmt->execute(array($inputs['user_login']));
		$row = $stmt->fetch();
		$password = $inputs['user_password'];
	
	// Если в таблице отсутствует искомая строка, имя
	// пользователя не найдено ни в одной из строк таблицы
		if ($row) {
			$password_ok = password_verify($password, $row[0]);
		}
		if (! $password_ok) {
			$errors[] = 'Please enter a valid login and password.';
		}
		return array($errors, $inputs);
	
	}


}

