<?php 

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
        $member = $this->input->post('member', TRUE);
        $startDate = $this->input->post('start_date', TRUE);
        $endDate = $this->input->post('end_date', TRUE);
        $books = $this->input->post('book', TRUE);

        // validation
        $members = $this->member_model->get_all();
        $validation = [
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
            ],
            [
                'field' => 'book[]',
                'label' => 'Buku',
                'rules' => 'required|is_array'
            ]
        ];

        $this->form_validation->set_message('valid_date', '{field} bukan format tanggal yang valid');
        $this->form_validation->set_message('is_array', '{field} harus berupa larik');

        $this->form_validation->set_rules($validation);

        if(!$this->form_validation->run())
        {
            $resp = ['errors' => $this->form_validation->error_array(), 'old' => $_POST];
            $this->session->set_flashdata('error', $resp);
            redirect('order');
            return;
        }

        $this->db->trans_start();
        $trans = [
            'member_id' => $member
        ];
        $this->db->insert('transactions', $trans);
        $_id = $this->db->insert_id();

        foreach($books as $book)
        {
            $data = [
                'transaction_id'  => $_id,
                'book_id'         => $book['title'],
                'qty'             => $book['qty'],
            ];

            $this->transaction_model->upsert($data, ['transaction_id' => $_id, 'book_id' => $book['title']]);
        }

        $this->db->trans_complete();

        if($this->db->trans_status() === FALSE)
        {
            $resp = ['message' => 'Data gagal di input !!!', 'old' => $_POST];
            $this->session->set_flashdata('error', $resp);
            redirect('order');
            return;
        }

        $resp = ['message' => 'Data berhasil di input !!!'];
        $this->session->set_flashdata('success', $resp);
        redirect('order');
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

     

}