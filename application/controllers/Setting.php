<?php

class Setting extends MY_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->model('setting_model');
		$this->load->library('form_validation');
		$this->load->helper('form');
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

		if($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			$number = $this->input->post('bilangan', TRUE);
			$unit = $this->input->post('unit', TRUE);

			$this->form_validation->set_rules('bilangan', 'Nilai', 'trim|required|integer');
		}

        echo $this->template->render('return_date');
    }

	public function test()
	{
		$model = $this->setting_model->get_by_field('due_date');
		header('Content-Type: application/json');
		echo json_encode($model, JSON_PRETTY_PRINT);
	}
}
