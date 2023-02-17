<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends MY_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('member_model');
		$this->load->library('form_validation');
	}

	 /**
     * function for view
     *
     * @return void
     */
	public function index(): void {
		echo $this->template->render('index');
	}

	public function get_all_paginated(): void {
		$limit  = $this->input->get('length');
		$offset = $this->input->get('start');
        $filter = $this->input->get('columns');

        $dataTable = [
            'draw'            => $this->input->get('draw') ?? NULL,
            'data'            => $this->member_model->get_all($filter, $limit, $offset),
            'recordsTotal'    => $this->db->count_all_results('members'),
            'recordsFiltered' => $this->member_model->count_all($filter)
        ];

        echo json_encode($dataTable, JSON_HEX_AMP | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT);
	}

	/**
     * get all data
     *
     * @return void
     */
    public function get_all(): void{
        $data = $this->member_model->get_all();
        echo json_encode($data, JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG);
    }

	/**
     * Storing submitted Data to database
     *
     * @return void
     */
    public function store(): void
    {
        $member_name   	= $this->input->post('member_name');
        $no_induk 	= $this->input->post('no_induk');
        $email 		= $this->input->post('email');
        $address 	= $this->input->post('address');
        $phone 		= $this->input->post('phone');

        $this->form_validation->set_rules('no_induk', 'Nomor Induk', 'required');

        if(!$this->form_validation->run())
        {
            $return = ['success' => false, 'errors' => $this->form_validation->error_array(), 'old' => $_POST];
            $this->session->set_flashdata('error', $return);
            redirect($_SERVER['HTTP_REFERER']);
        }

        $data = [
            'member_name' 			=> $member_name,
            'no_induk' 				=> $no_induk,
            'email' 				=> $email,
            'address' 				=> $address,
            'phone' 				=> $phone,
			'created_at' 			=> date('Y-m-d H:i:s'),
        ];

        if(!$this->db->insert('members', $data))
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
        $id     		= trim($this->input->post('member_id', TRUE));
        $member_name   	= trim($this->input->post('member_name', TRUE));
        $no_induk   	= trim($this->input->post('no_induk', TRUE));
        $email   		= trim($this->input->post('email', TRUE));
        $address   		= trim($this->input->post('address', TRUE));
        $phone   		= trim($this->input->post('phone', TRUE));

		$this->form_validation->set_rules('no_induk', 'Nomor Induk', 'required');
		$this->form_validation->set_rules('member_name', 'Nama Member', 'required');

        if(!$this->form_validation->run())
        {
            $return = ['success' => false, 'errors' => $this->form_validation->error_array(), 'old' => $_POST];
            $this->session->set_flashdata('error', $return);
            redirect($_SERVER['HTTP_REFERER']);
        }

        $data = [
            'member_name' => $member_name,
            'no_induk' => $no_induk,
            'email' => $email,
            'address' => $address,
            'phone' => $phone,
        ];

        if(!$this->db->update('members', $data, ['id' => $id]))
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
        if(!$this->db->update('members', ['deleted_at' => date('Y-m-d H:i:s')], ['id' => $id]))
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
