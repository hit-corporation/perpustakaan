<?php

use SebastianBergmann\Type\NullType;

class Order extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model(['member_model', 'transaction_model']);
    }

    /**
     * Main View 
     *
     * @return void
     */
    public function index(): void {

        $this->template->registerFunction('set_value', function($field, $value = NULL) {
            return set_value($field, $value);
        });
        echo $this->template->render('index');

    }

    /**
     * Store new data into database
     *
     * @return void
     */
    public function store(): void {
        // input
        $code = $this->input->post('code', TRUE);
        $member = $this->input->post('member', TRUE);
        $startDate = $this->input->post('start_date', TRUE);
        $endDate = $this->input->post('end_date', TRUE);
        $books = $this->input->post('book', TRUE);

        // validation
        $members = $this->member_model->get_all();
        $validation = [
            [
                'field' => 'code',
                'label' => 'Kode Transaksi',
                'rules' => 'required'
            ],
            [
                'field'  => 'member',
                'label'  => 'Anggota',
                'rules'  => ['required', 'in_list['.implode(',', array_column($members, 'id')).']']   
            ],
            [
                'field' => 'start-date',
                'label' => 'Tanggal Peminjaman',
                'rules' => [
                    'required',
                    'callback_valid_date'
                ]
            ],
            [
                'field' => 'end-date',
                'label' => 'Tanggal Pengembalian',
                'rules' =>  'callback_valid_date'
            ]
        ];

		foreach($books as $k => $v)
		{
			$validation[] = [
				'field' => 'book['.$k.'][title]',
                'label' => 'Judul Buku',
                'rules' => 'required'
			];
			$validation[] = [
				'field' => 'book['.$k.'][return_date]',
                'label' => 'Tanggal Kembali',
                'rules' => 'callback_valid_date'
			];
		}

        $this->form_validation->set_message('valid_date', 'format {field} tidak valid');
        $this->form_validation->set_message('is_array', '{field} harus berupa larik');

        $this->form_validation->set_rules($validation);

        if(!$this->form_validation->run())
        {
            $resp = ['errors' => $this->form_validation->error_array(), 'old' => $_POST];
            $this->session->set_flashdata('error', $resp);
            redirect('order');
            return;
        }

		// INSERT START
        $this->db->trans_start();
        $trans = [
            'trans_code'    => $code,
            'member_id'     => $member
        ];
        $this->db->insert('transactions', $trans);
        $_id = $this->db->insert_id();

        foreach($books as $book)
        {
            $data = [
                'transaction_id'  => $_id,
                'book_id'         => $book['title'],
                'qty'             => 1,
                'return_date'     => $book['return_date']
            ];

            $this->transaction_model->upsert($data, ['transaction_id' => $_id, 'book_id' => $book['title']]);
			$this->db->set('qty', 'qty-1', FALSE)->where('id', $data['book_id'])->update('books');
        }
        // realase memory
        unset($trans);
        unset($books);

        // reports
        $transac = $this->transaction_model->get_by_code($code);
        foreach($transac as $trans)
        {
            $report = [
                'trans_code'    => $trans['trans_code'],
                'member_name'   => $trans['member_name'],
                'book_title'    => $trans['title'],
                'loan_date'     => $trans['trans_timestamp'],
                'return_date'   => $trans['return_date']
            ];
    
            $this->db->insert('reports', $report);
        }
        $this->db->trans_complete();
        // INSERT COMPLETE

        if($this->db->trans_status() === FALSE)
        {
            $resp = ['message' => 'Data gagal di input !!!', 'old' => $_POST];
            $this->session->set_flashdata('error', $resp);
            redirect('order');
            return;
        }

        $resp = ['message' => 'Data berhasil di input !!!'];
        $this->session->set_flashdata('success', $resp);
        redirect('order/return_order');
    }

    /**
     * **********************************************************
     * 
     *                  CUSTOM VALIDATION
     * 
     * **********************************************************
     */ 

     /**
      * validating date
      *
      * @param mixed $str
      * @param string $format
      * @return boolean
      */
	public function valid_date($str, string $format = NULL): bool {
	if(empty($format))
		$format = 'Y-m-d';
	if(!empty($str))
	{
		$tgl = DateTime::createFromFormat($format, $str);
		return $tgl && $tgl->format('Y-m-d') === $str;
	}
	
	return TRUE;
	}

	/**
     * Return Order View 
     *
     * @return void
     */
    public function return_order(): void {
		$post = $this->input->post();

		if(!empty($post))
		{
			$transaction_book_id = $this->input->post('transaction_book_id', TRUE);
			$penalty = !empty($this->input->post('denda', TRUE)) ? $this->input->post('denda', TRUE) : 0;
			$bayar = !empty($this->input->post('bayar', TRUE)) ? $this->input->post('bayar', TRUE) : 0;
			$notes = $this->input->post('notes', TRUE);
            $trans_code = $this->input->post('trans_code', TRUE);

			// update data transaction book
            $data = ['amount_penalty' => $penalty, 'amount_paid' => $bayar, 'note' => $notes, 'updated_at' => date('Y-m-d H:i:s.u'), 'actual_return' => date('Y-m-d H:i:s')];
			// $this->db->where('id', $transaction_book_id);
			$this->db->update('transaction_book', $data, ['id' => $transaction_book_id]);

			// update data book
			$this->db->set('qty', 'qty+1', FALSE)->where('id', $this->input->post('book_id', TRUE))->update('books');

			// set flashdata
			$resp = ['message' => 'Data berhasil di input !!!'];
			$this->session->set_flashdata('success', $resp);
			redirect('order/return_order');
			return;
		}
        $this->template->registerFunction('set_value', function($field, $value = NULL) {
            return set_value($field, $value);
        });
        echo $this->template->render('return_order');
    }

	/**
     * get all data
     *
     * @return void
     */
    public function get_all(): void{
        $data = $this->transaction_model->get_all();
        echo json_encode($data, JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG);
    }

    /**
     * Get All Paginated
     *
     * @return void
     */
	public function get_all_paginated(): void {
		$limit  = $this->input->get('length');
		$offset = $this->input->get('start');
        $filter = $this->input->get('columns');

        // generate data
        $data = [];
        $query = $this->transaction_model->get_all($filter, $limit, $offset);

        $date_mod = $this->settings['fines_period_value'].' '.$this->settings['fines_period_unit'];

        foreach($query as $q)
        {
            $dateDiff = (new DateTime('now'))->diff(new DateTime($q['return_date']));
            $denda = NULL;
            
            if((new DateTime('now')) > (new DateTime($q['return_date']))) 
            {
                switch($this->settings['fines_period_unit'])
                {
                    case 'days':
                        $denda = $dateDiff->days / $this->settings['fines_period_value']; 
                        break;
                    case 'weeks':
                        $denda = intval($dateDiff->days / 7) / $this->settings['fines_period_value'];
                        break;
                    case 'months':
                        $denda = $dateDiff->m / $this->settings['fines_period_value'];
                        break;
                }
                $denda = ceil($denda);
                $denda = $denda * $this->settings['fines_amount'];
            }
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

}
