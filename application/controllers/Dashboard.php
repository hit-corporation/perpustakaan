<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('member_model');
		$this->load->model('book_model');
		$this->load->library('form_validation');
		
	}

	public function index(){
		$data['user'] = $this->user_model->get_user($this->session->userdata('user')['id']);
		$data['total_member'] = count($this->user_model->get_all());
		$data['total_buku']	= count($this->book_model->get_all());

		// MENGGUNAKAN TEMPLATE ENGINE PLATES
		echo $this->template->render('index', $data);
	}
}
