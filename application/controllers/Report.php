<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('transaction_model');
		$this->load->library('form_validation');
	}

    /**
     * function for view
     *
     * @return void
     */
	public function index(): void
	{
		echo $this->template->render('report/order_report');
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

}

?>
