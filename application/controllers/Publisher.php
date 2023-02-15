<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Publisher extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Publisher_model');
	}

	public function index(){
		$data['title'] = 'Publisher';
		$data['publishers'] = $this->Publisher_model->getAll();

		echo $this->template->render('index', $data);
	}
}
