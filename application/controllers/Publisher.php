<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Publisher extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('publisher_model');
		$this->load->library('form_validation');
	}

	public function index(): void
	{
		echo $this->template->render('index');
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
            'recordsTotal'    => $this->db->count_all_results('publishers'),
            'recordsFiltered' => $this->publisher_model->count_all($filter)
        ];

        echo json_encode($dataTable, JSON_HEX_AMP | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT);
	}

	/**
     * Storing submitted Data to database
     *
     * @return void
     */
    public function store(): void
    {
        $publisher_name   = $this->input->post('publisher_name');
        $address   = $this->input->post('address');

        $this->form_validation->set_rules('publisher_name', 'Nama Penerbit', 'required');

        if(!$this->form_validation->run())
        {
            $return = ['success' => false, 'errors' => $this->form_validation->error_array(), 'old' => $_POST];
            $this->session->set_flashdata('error', $return);
            redirect($_SERVER['HTTP_REFERER']);
        }

        $data = [
            'publisher_name' => $publisher_name,
            'address' => $address,
			'created_at' => date('Y-m-d H:i:s'),
        ];

        if(!$this->db->insert('publishers', $data))
        {
            $return = ['success' => false, 'message' =>  'Data Gagal Di Simpan', 'old' => $_POST];
            $this->session->set_flashdata('error', $return);
            redirect($_SERVER['HTTP_REFERER']);
        }
       
       $return = ['success' => true, 'message' =>  'Data Berhasil Di Simpan'];
       $this->session->set_flashdata('success', $return);
       redirect($_SERVER['HTTP_REFERER']);
    }

	/**
     * Editing data in database
     *
     * @return void
     */
    public function edit(): void
    {
        $id     		= trim($this->input->post('publisher_id', TRUE));
        $publisher_name	= trim($this->input->post('publisher_name', TRUE));
        $address 		= trim($this->input->post('address', TRUE));

        $this->form_validation->set_rules('publisher_name', 'Nama Penerbit', 'required');

        if(!$this->form_validation->run())
        {
            $return = ['success' => false, 'errors' => $this->form_validation->error_array(), 'old' => $_POST];
            $this->session->set_flashdata('error', $return);
            redirect($_SERVER['HTTP_REFERER']);
        }

        $data = [
            'publisher_name'   => $publisher_name,
            'address' => $address,
            'updated_at'      => date('Y-m-d H:i:s')  
        ];

        if(!$this->db->update('publishers', $data, ['id' => $id]))
        {
            $return = ['success' => false, 'message' =>  'Data Gagal Di Simpan', 'old' => $_POST];
            $this->session->set_flashdata('error', $return);
            redirect($_SERVER['HTTP_REFERER']);
        }
       
       $return = ['success' => true, 'message' =>  'Data Berhasil Di Simpan'];
       $this->session->set_flashdata('success', $return);
       redirect($_SERVER['HTTP_REFERER']);
    }

	/**
     * Delete data in db
     *
     * @return void
     */
    public function erase(int $id): void {
        if(!$this->db->update('publishers', ['deleted_at' => date('Y-m-d H:i:s')], ['id' => $id]))
        {
            $return = ['success' => false, 'message' =>  'Data Gagal Di Hapus'];
            $this->session->set_flashdata('error', $return);
            redirect($_SERVER['HTTP_REFERER']);
        }

        $return = ['success' => true, 'message' =>  'Data Berhasil Di Hapus'];
        $this->session->set_flashdata('success', $return);
        redirect($_SERVER['HTTP_REFERER']);
    }
	
}
