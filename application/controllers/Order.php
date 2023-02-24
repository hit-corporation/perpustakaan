<?php 

class Order extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Main View 
     *
     * @return void
     */
    public function index(): void {
        echo $this->template->render('index');
    }
}