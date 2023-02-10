<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('User_model');
		$this->load->library('form_validation');

		if(!$this->session->userdata('user')){
			redirect(base_url('login'));
		}
	}

	public function index(){
		$post = $this->input->post();

		if(isset($post['submit'])){
			$data = [
				'id' => $post['id'],
				'username' => $post['userName'],
				'full_name' => $post['fullName'],
				'email' => $post['email'],
				'password' => (isset($post['changePassword'])) ? md5($post['password']) : $post['password'],
				'role' => $post['role'],
				'status' => $post['status']
			];
			$this->User_model->update($data);
			redirect(base_url('user'));
			
		}

		$data['users'] = $this->User_model->get_all_users();

		$this->load->view('header');
		$this->load->view('user/index', $data);
		$this->load->view('footer');
	}

	public function delete(){
		$id = $this->uri->segment(3);
		$this->User_model->delete($id);
		redirect(base_url('user'));
	}
}
