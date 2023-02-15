<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Publisher_model extends CI_Model {

	public function getAll(){
		$this->db->select('*');
		$this->db->from('publishers');
		$this->db->where('deleted_at', null);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function add($data){
		$this->db->insert('publishers', $data);
		return $this->db->affected_rows();
	}

	public function update($id, $data){
		$this->db->where('id', $id);
		$this->db->update('publishers', $data);
		return $this->db->affected_rows();
	}

}
