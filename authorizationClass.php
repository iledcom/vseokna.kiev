<?php

class Authorization {

	private $form;
	private $db;
	private $inputs = array();
	private $validate;

	public function __construct (FormHelper $form, Validate $validate, $db, $server) {
		$this->form = $form;
		$this->db = $db;
		$this->inputs = $server;
		$this->validate = $validate;
	}

	public function authorizationStart() {
		$post = $_SERVER['REQUEST_METHOD'];
		if ($post == 'POST') {
			list($errors, $valid_inputs) = $this->validate->validatePass($this->inputs);
			
			// Если функция validate_form() возвратит ошибки,
			// передать их функции show_form()
			if ($errors) {
				return $this->showAuthorizationForm($errors);
			} else {
				// Переданные данные из формы достоверны, обработать их
				return $this->process_form($valid_inputs);
			}
		} else {
			// Данные из формы не переданы, отобразить ее снова
			return $this->showAuthorizationForm($errors);
		}
	}

	protected function showAuthorizationForm($errors) {
		$form = $this->form;
		if ($errors) {
			$errorHtml = '<ul><li>';
			$errorHtml .= implode('</li><li>',$errors);
			$errorHtml .= '</li></ul>';
		} else {
			$errorHtml = '';
		}
		include 'authorization_form.php';
	}

	protected function showUnsetForm($errors, $inputs) {
		$form = $this->form;
		if ($errors) {
			$errorHtml = '<ul><li>';
			$errorHtml .= implode('</li><li>',$errors);
			$errorHtml .= '</li></ul>';
		} else {
			$errorHtml = '';
		}
		include 'unset_form.php';
	}


	protected function process_form($valid_inputs) {
		$db = $this->db;
		$inputs = $valid_inputs;
		$_SESSION['username'] = $inputs['user_login'];
		$this->showUnsetForm($errors, $inputs);
	}

	public function unsetAuthorization() {
		$server_method = $_SERVER['REQUEST_METHOD'];
		$inputs = $_POST;

		if ($server_method == 'POST' && $inputs['unset']) {
			
			unset($_SESSION['username']);
		}
	}

}