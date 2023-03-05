<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('stock_model');
	}

	/**
	 * Views default
	 *
	 * @return void
	 */
	public function index(): void {

		try
		{
			echo $this->template->render('stock', [], 'book');
		}
		catch(Exception $e)
		{
			log_message('error', $e->__toString());
		}
	}

	/**
	 * view all data
	 *
	 * @return void
	 */
	public function get_all(): void {
		$model = $this->stock_model->get_all();
		echo json_encode($model);
	}
}
