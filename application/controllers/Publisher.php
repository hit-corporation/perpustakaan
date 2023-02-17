<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Publisher extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('publisher_model');
	}

    /**
     * get all data
     *
     * @return void
     */
    public function get_all(): void {
        $data = $this->publisher_model->get_all();
        echo json_encode($data, JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG);
    }

	/**
     * get all paginated data and send as json for datatable consume
     *
     * @return void
     */
	public function get_all_paginated(): void
	{
		$limit  = $this->input->get('length');
		$offset = $this->input->get('start');
        $filter = $this->input->get('columns');

        $dataTable = [
            'draw'            => $this->input->get('draw') ?? NULL,
            'data'            => $this->publisher_model->get_all($filter, $limit, $offset),
            'recordsTotal'    => $this->db->count_all_results('categories'),
            'recordsFiltered' => $this->publisher_model->count_all($filter)
        ];

        echo json_encode($dataTable, JSON_HEX_AMP | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT);
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
		$data['publishers'] = $this->publisher_model->get_all();

		echo $this->template->render('index', $data);
	}
}
