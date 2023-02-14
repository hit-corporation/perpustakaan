<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('User_model');
	}

	public function index(){
		$post = $this->input->post();

		if(isset($post['submit'])){
			$data = [
				'user_name' => $post['userName'],
				'user_pass' => password_verify($post['password'], PASSWORD_DEFAULT)
			];


			$user = $this->User_model->login($data);

			if (password_verify($post['password'], $user['user_pass'])) {
				$this->session->set_userdata('user', $user);
				redirect(base_url('dashboard'));
			} else {
				$this->session->set_flashdata('error', 'Username or password is incorrect');
			}

		}

		$this->load->view('login/index');
	}

	public function register(){
		$post = $this->input->post();
		
		if(isset($post['submit'])){
			$this->form_validation->set_rules('userName', 'User Name', 'required');
			$this->form_validation->set_rules('fullName', 'Full Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('repeatPassword', 'Repeat Password', 'required|matches[password]');

			if($this->form_validation->run() == TRUE){
				$data = [
					'user_name' => $post['userName'],
					'full_name' => $post['fullName'],
					'email' => $post['email'],
					'user_pass' => password_hash($post['password'], PASSWORD_DEFAULT),
					'role' => 'user',
					'status' => 'active'
				];
				$this->User_model->insert($data);
				redirect(base_url('login'));
			}
		}

		$this->load->view('login/register');
	}

	public function forgot_password(){
		$this->load->view('login/forgot_password');
	}

	public function logout(){
		$this->session->unset_userdata('user');
		redirect(base_url('login'));
	}
}
