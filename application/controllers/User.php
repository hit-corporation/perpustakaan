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

		if(isset($post['save'])){
			$data = [
				'user_name' => $post['user_name'],
				'full_name' => $post['full_name'],
				'email' => $post['email'],
				'user_pass' => $post['password'],
				'role_id' => $post['user_role'],
				'status' => $post['status']
			];
			$res = $this->User_model->insert($data);
			if($res){
				$this->session->set_flashdata('success', 'User added successfully');
			}else{
				$this->session->set_flashdata('error', 'Something went wrong');
			}
		}

		if(isset($post['update'])){
			$data = [
				'user_name' => $post['user_name'],
				'full_name' => $post['full_name'],
				'email' => $post['email'],
				'user_pass' => isset($post['changePassword']) ? password_hash($post['password'], PASSWORD_DEFAULT) : $post['password'], // if changePassword is set, then change password, else keep the old password (password_hash() is used to encrypt the password
				'role_id' => $post['user_role'],
				'status' => $post['status']
			];
			$res = $this->User_model->update($post['id'], $data);
			if($res){
				$this->session->set_flashdata('success', 'User updated successfully');
			}else{
				$this->session->set_flashdata('error', 'Something went wrong');
			}
		}

		if(isset($post['delete'])){
			$res = $this->User_model->delete($post['id']);
			if($res){
				$this->session->set_flashdata('success', 'User deleted successfully');
			}else{
				$this->session->set_flashdata('error', 'Something went wrong');
			}
		}

		$data['users'] = $this->User_model->get_all_users();
		$data['user_role'] = $this->User_model->get_user_role();

		echo $this->template->render('index', $data);
	}

	public function delete(){
		$id = $this->uri->segment(3);
		$this->User_model->delete($id);
		redirect(base_url('user'));
	}
}
