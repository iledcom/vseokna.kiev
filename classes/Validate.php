<?php
namespace Classes;

class Validate {

	private $db;

	public function __construct ($db) {
		$this->db = $db;
	}

	public function validateForm($inputs) {
		$errors = array();
		foreach ($inputs as $input => &$value) {
			$value = trim($value);
			if (!strlen($value)) {
				$errors[] = "Please enter the $input.";
			}
			if ($input == 'dob') {
				if (!$this->validateDOB($inputs['dob'])) {
					$errors[] = 'Please enter the correct Date of Birth.';
				}
			} elseif($input == 'art_date') {
				if (!$this->validateDate($inputs['art_date'])) {
					$errors[] = 'Please enter a valid date.';
				}
			}
		}
			return array($errors, $inputs);
	}


	private function validateDOB($date, $format = 'd.m.Y') {
	  $d = DateTime::createFromFormat($format, $date);
	  return $d && $d->format($format) == $date;
	}

	private function validateDate($date, $format = 'd.m.Y H:i:s') {
	  $d = DateTime::createFromFormat($format, $date);
	  return $d && $d->format($format) == $date;
	}


	public function validatePass($inputs) {
		$stmt = $this->db->prepare('SELECT user_password, user_name, role FROM users WHERE user_login = ?');
		$stmt->execute(array($inputs['user_login']));
		$row = $stmt->fetch();
		if ($row) {
			$password_ok = password_verify($inputs['user_password'], $row[0]);
			$inputs['user_name'] = $row[1];
			$inputs['role'] = $row[2];
		}
		if (! $password_ok) {
			$errors[] = 'Please enter a valid login and password.';
		}
		return array($errors, $inputs);
	
	}


}

