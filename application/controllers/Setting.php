<?php

class Setting extends MY_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->model('setting_model');
		$this->load->library('form_validation');
		$this->load->helper('form');

        // function register
        // $this->template->registerFunction('set_value', function(string $value, string $default = NULL, bool $escape = TRUE) {
        //     return set_value($value, $default, $escape);
        // });
    }

    /**
     * Main Setting View
     *
     * @return void
     */
    public function index(): void {
        echo $this->template->render('index');
    }

    /**
     * return date default setting
     *
     * @return void
     */
    public function return_date(): void {

        $data['due_date'] = $this->setting_model->get_by_field('due_date');

		if($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			$number = $this->input->post('nilai', TRUE);
			$unit = $this->input->post('unit', TRUE);

			$this->form_validation->set_rules('nilai', 'Nilai', 'trim|required|integer');
			$this->form_validation->set_rules('unit', 'Unit', 'trim|required|alpha_numeric');

            if(!$this->form_validation->run())
            {
                $errors = ['errors' => $this->form_validation->error_array(), 'old' => $_POST];
                $this->session->set_flashdata('error', $errors);
                echo $this->template->render('return_date');
                return;
            }

            $this->db->trans_start();
            $this->db->update('settings', ['value' => $number], ['field' => 'due_date', 'key' => 'nilai']);
            $this->db->update('settings', ['value' => $unit], ['field' => 'due_date', 'key' => 'unit']);
            $this->db->trans_complete();

            if(!$this->db->trans_status())
                $this->session->set_flashdata('error', ['message' => 'Data gagal di simpan']);
            else
                $this->session->set_flashdata('success', ['message' => 'Data berhasil di simpan']);
		}

        
        echo $this->template->render('return_date', $data);
    }

	public function test()
	{
		$model = $this->setting_model->get_by_field('due_date');
		header('Content-Type: application/json');
		echo json_encode($model, JSON_PRETTY_PRINT);
	}
}
