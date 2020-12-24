<?php
namespace Classes;

class User {

	private $login;
	private $password;
	private $name;
	private $surname;
	private $phone;
	private $dob;
	private $delivery_address;
	private $status;
	private $role;
	private $valid_pass;
	private $server;

	public function __construct(Validate $validate, $server) {
		$this->server = $server;
		$this->valid_pass = $validate->validatePass($this->server);
	}

	public function registration() {

	}

	public function authorization() {
		list($errors, $valid_inputs) = $this->valid_pass;
		if($errors) {
			print implode($errors);
		} else {
			$_SESSION['username'] = $valid_input['user_login'];
		}
	}

	public function unsetAuthorization() {
		$server_method = $_SERVER['REQUEST_METHOD'];
		$inputs = $_POST;

		if ($server_method == 'POST' && $inputs['unset']) {
			
			unset($_SESSION['username']);
		}
	}
}