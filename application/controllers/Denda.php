<?php

class Denda extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Views 
	 *
	 * @return void
	 */
	public function index(): void {
		echo $this->template->render('fines', [], 'setting');
	}

	/**
	 * Store data into database
	 *
	 * @return void
	 */
	public function store(): void {

	}
}
