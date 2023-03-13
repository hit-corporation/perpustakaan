<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(['stock_model', 'book_model']);
		$this->load->library('form_validation');
	}

	/**
	 * Views default
	 *
	 * @method GET
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
	 * Store new data to database
	 *
	 * @method POST
	 * @return void
	 */
	public function store(): void 
	{
		try
		{
			$book = $this->input->post('book', TRUE);
			$stocks = $this->input->post('stock_codes', TRUE);

			// Vaidations
			$validations = 
			[
				[
					'field' => 'book',
					'label' => 'Buku',
					'rules' => 'required|in_list['.implode(',', array_column($this->book_model->get_all(), 'id')).']'
				],
				[
					'field' => 'stock_codes',
					'label' => 'Kode Stok',
					'rules' => 'is_array'
				]
			];

			$i=0;
			foreach($stocks as $stock)
			{
				$validations[] = [
					'field' => 'stock_codes['.$i.']',
					'label' => 'Kode Stok',
					'rules' => 'required|is_unique[stocks.stock_code]'
				];
				$i++;
			}
			$this->form_validation->set_message('is_array', 'Tipe data dari {field} harus berupa larik (array)');
			$this->form_validation->set_rules($validations);
			// Check Valiations
			if(!$this->form_validation->run())
			{
				$errors = ['errors' => $this->form_validation->error_array(), 'old' => $_POST, 'is_stockform' => true];
				$this->session->set_flashdata('error', $errors);
				redirect($_SERVER['HTTP_REFERER']);
				return;
			}

			// INSert
			$this->db->trans_start();
			foreach($stocks as $stock)
			{
				$data = [
					'stock_code'	=> $stock,
					'book_id'	 	=> $book,
					'is_available' 	=> 1
				];

				$this->db->insert('stocks', $data);
			}
			$this->db->trans_complete();

			if($this->db->trans_status() === FALSE)
			{
				$resp = ['message' => 'Data gagal di input !!!', 'old' => $_POST, 'is_stockform' => TRUE];
				$this->session->set_flashdata('error', $resp);
				redirect($_SERVER['HTTP_REFERER']);
				return;
			}
	
			$resp = ['message' => 'Data berhasil di input !!!'];
			$this->session->set_flashdata('success', $resp);
			redirect($_SERVER['HTTP_REFERER']);

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
