<?php
namespace Classes;

class AdminArticle {
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
			$this->editingArticle();
		} else {
			$this->showArticles();
		}
	}

	protected function showArticles(){
		$articles = new Articles($this->form, $this->db);
		$articles->showArticle();
	}

	protected function editingArticle(){
		$edit = new Editing($this->validate, $this->db, $this->inputs);
		$edit->editArticle();
	}

}