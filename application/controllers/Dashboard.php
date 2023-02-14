<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('User_model');
		$this->load->library('form_validation');

		// if(!$this->session->userdata('user')){
		// 	redirect(base_url('login'));
		// }
	}

	public function index(){
		$data['user'] = $this->User_model->get_user($this->session->userdata('user')['id']);

		// $this->load->view('header');
		// $this->load->view('dashboard/index', $data);
		// $this->load->view('footer');

		// MENGGUNAKAN TEMPLATE ENGINE PLATES
		echo $this->template->render('index', ['user' => $data['user']]);
	}
}
