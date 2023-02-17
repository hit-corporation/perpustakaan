<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Book_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_all(?array $filter=NULL, ?int $limit=NULL, int $offset=NULL): array 
	{
		if(!empty($limit) && !is_null($offset))
			$this->db->limit($limit, $offset);
		
		$query = $this->db->get('books');
		return $query->result_array();
	}

}
