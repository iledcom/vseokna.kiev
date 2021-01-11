<?php
namespace Classes;

class AdminHeaders {
	private $db;
	private $form;
	private $validate;
	private $inputs = array();
	
	public function __construct(Validate $validate, FormHelper $form, $db, $post){
		$this->form = $form;
		$this->validate = $validate;
		$this->db = $db;
		$this->inputs = $post;
	}

	public function startProcess() {
		if($this->inputs['edit'] || $this->inputs['save']) {
			$this->editingHeaders();
		} else {
			$this->showHeaders();
		}
	}

	protected function showHeaders(){
		$headers = new Headers($this->form, $this->db);
		$headers->showHeaders();
	}

	protected function editingHeaders(){
		$edit = new EditingHeaders($this->validate, $this->db, $this->inputs);
		$edit->editHeader();
	}

}