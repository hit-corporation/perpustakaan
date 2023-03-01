<?php

class Setting extends MY_Controller {

    public function __construct() {
        parent::__construct();
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
        echo $this->template->render('return_date');
    }
}