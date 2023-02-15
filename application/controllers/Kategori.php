<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('kategori_model');
		$this->load->library('form_validation');
	}

    /**
     * function for view
     *
     * @return void
     */
	public function index(): void
	{
		echo $this->template->render('index');
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
            'data'            => $this->kategori_model->get_all($filter, $limit, $offset),
            'recordsTotal'    => $this->db->count_all_results('categories'),
            'recordsFiltered' => $this->kategori_model->count_all($filter)
        ];

        echo json_encode($dataTable, JSON_HEX_AMP | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT);
	}

    /**
     * get all data
     *
     * @return void
     */
    public function get_all(): void
    {
        $data = $this->kategori_model->get_all();
        echo json_encode($data, JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG);
    }

    /**
     * Storing submitted Data to database
     *
     * @return void
     */
    public function store(): void
    {
        $name   = $this->input->post('category_name');
        $parent = $this->input->post('category_parent');

        $this->form_validation->set_rules('category_name', 'Nama Kategori', 'required|callback_check_name_unique');
        $this->form_validation->set_rules('category_parent', 'Induk Kategori', 'required');

        if(!$this->form_validation->run())
        {
            http_response_code(422);
            echo json_encode(validation_errors());
            return;
        }

        $data = [
            'category_name' => $name,
            'category_parent' => $parent
        ];

        if(!$this->db->insert('categories', $data))
        {
            http_response_code(422);
            echo json_encode(['success' => false, 'message' => 'Data Gagal Di Simpan']);
            return;
        }
       
        echo json_encode(['success' => true, 'message' => 'Data Berhasil Di Simpan !!!']);
    }


    /**
     * *******************************************************************************************
     *                                  CALLBACK REGION
     * *******************************************************************************************
     */

    // check unique username
    public function check_name_unique($str): bool
    {
        if($this->db->get_where('categories', ['category_name' => $str, 'deleted_at' => NULL])->num_rows() > 0)
            return FALSE;
        return TRUE;
    }


}
