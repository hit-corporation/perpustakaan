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
		$data['total_member'] = count($this->member_model->get_all());
		$data['total_book'] = count($this->book_model->get_all());
		$data['total_borrow_book']	= count($this->book_model->get_all_borrow());
		$data['late_borrow'] = count($this->book_model->get_late_borrow());
		$data['top_book_borrow'] = $this->book_model->get_top_borrow();
		$data['percentage_book_borrow'] = $this->book_model->get_percentage_borrow();
		$data['top_member_borrow'] = $this->member_model->get_top_borrow();
		$data['daily_borrow'] = $this->book_model->get_daily_borrow();

		// MENGGUNAKAN TEMPLATE ENGINE PLATES
		echo $this->template->render('index', $data);
	}
}
