<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Book_model');
		$this->load->library('form_validation');

		if(!$this->session->userdata('user')){
			redirect(base_url('login'));
		}
	}

	public function index(){
		$data['books'] = $this->Book_model->get_all_books();

		$this->load->view('header');
		$this->load->view('book/index', $data);
		$this->load->view('footer');
	}
}
