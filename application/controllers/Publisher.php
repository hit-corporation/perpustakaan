<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Publisher extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Publisher_model');
	}

	public function index(){
		$post = $this->input->post();

		if (isset($post['save'])) {
			$data = [
				'publisher_name' => $post['publisher_name'],
				'address' => $post['address'],
				'created_at' => date('Y-m-d H:i:s'),
			];
			$res = $this->Publisher_model->add($data);
			if ($res) {
				$this->session->set_flashdata('success', 'Data berhasil ditambahkan');
			} else {
				$this->session->set_flashdata('error', 'Data gagal ditambahkan');
			}
		}

		if (isset($post['update'])){
			$data = [
				'publisher_name' => $post['publisher_name'],
				'address' => $post['address'],
				'updated_at' => date('Y-m-d H:i:s'),
			];
			$res = $this->Publisher_model->update($post['id'], $data);
			if ($res) {
				$this->session->set_flashdata('success', 'Data berhasil diubah');
			} else {
				$this->session->set_flashdata('error', 'Data gagal diubah');
			}
		}

		if (isset($post['delete'])){
			$data = [
				'deleted_at' => date('Y-m-d H:i:s'),
			];
			$res = $this->Publisher_model->update($post['id'], $data);
			if ($res) {
				$this->session->set_flashdata('success', 'Data berhasil dihapus');
			} else {
				$this->session->set_flashdata('error', 'Data gagal dihapus');
			}
		}

		$data['title'] = 'Publisher';
		$data['publishers'] = $this->Publisher_model->getAll();

		echo $this->template->render('index', $data);
	}
}
