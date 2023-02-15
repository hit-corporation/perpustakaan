<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Publisher_model extends CI_Model {

	public function getAll(){
		$this->db->select('*');
		$this->db->from('publishers');
		$this->db->where('deleted', null);
		$query = $this->db->get();
		return $query->result_array();
	}

}
