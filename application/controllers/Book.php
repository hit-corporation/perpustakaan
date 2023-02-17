<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Book extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('book_model');
		$this->load->library('form_validation');

	}

	/**
	 * View
	 *
	 * @return void
	 */
	public function index()
	{
		echo $this->template->render('index');
	}

	/**
	 * Get All Data with Pagination
	 *
	 * @return void
	 */
	public function get_all_paginated(): void
	{
		
	}

	/**
	 * Store new data to database
	 *
	 * @return void
	 */
	public function store(): void
	{

	}
}
