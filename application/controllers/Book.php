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

	public function index()
	{
		echo $this->template->render('index');
	}

	public function get_all_paginated()
	{
		
	}

	public function store()
	{

	}
}
