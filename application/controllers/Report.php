<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('transaction_model');
		$this->load->model('book_model');
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

        // generate data
        $data = [];
        $query = $this->transaction_model->get_all($filter, $limit, $offset);

        $date_mod = $this->settings['fines_period_value'].' '.$this->settings['fines_period_unit'];

        foreach($query as $q)
        {
            $denda = (new DateTime('now')) > (new DateTime($q['return_date'])) ? 
                          ((new DateTime('now'))->diff(new DateTime($q['return_date'])))->days * $this->settings['fines_amount'] : NULL;
            $q['denda'] = $denda >= $this->settings['fines_maximum'] ? $this->settings['fines_maximum'] : $denda;
            $data[] = $q;
        }

        $dataTable = [
            'draw'            => $this->input->get('draw') ?? NULL,
            'data'            => $data,
            'recordsTotal'    => $this->db->count_all_results('transactions'),
            'recordsFiltered' => $this->transaction_model->count_all($filter)
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
        $data = $this->transaction_model->get_all();
        echo json_encode($data, JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG);
    }

	 /**
     * function for view book report
     *
     * @return void
     */
	public function book(): void
	{
		echo $this->template->render('report/book_report');
	}

	/**
	 * get all books data
	 *
	 * @return void
	 */
	public function get_all_book(): void
	{
		$data = $this->book_model->get_all_book();
		echo json_encode($data, JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG);
	}

	/**
	 * get all paginated data and send as json for datatable consume
	 *
	 * @return void
	 */
	public function get_all_book_paginated(): void{
		$limit  = $this->input->get('length');
		$offset = $this->input->get('start');
		$filter = $this->input->get('columns');

		// generate data
		$data = $this->book_model->get_all_book($filter, $limit, $offset);

		$dataTable = [
			'draw'            => $this->input->get('draw') ?? NULL,
			'data'            => $data,
			'recordsTotal'    => $this->db->count_all_results('books'),
			'recordsFiltered' => $this->book_model->count_all_book($filter)
		];

		echo json_encode($dataTable, JSON_HEX_AMP | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT);
	}

	/**
     * function for view penalty report
     *
     * @return void
     */
	public function penalty(): void{
		echo $this->template->render('report/penalty_report');
	}

}

?>
