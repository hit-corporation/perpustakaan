<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Book extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Book_model');
		$this->load->library('form_validation');

		// if (!$this->session->userdata('user')) {
		// 	redirect(base_url('login'));
		// }
	}

	public function index()
	{
		echo $this->template->render('index');
	}
}
