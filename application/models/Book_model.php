<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Book_model extends CI_Model {

	public function insert($data){
		$this->db->insert('books', $data);
	}

	public function get_all_books(){
		$this->db->select('*');
		$this->db->from('books');
		$this->db->where('deleted', 'false');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_book($id){
		$this->db->select('*');
		$this->db->from('books');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function update($data){
		$this->db->where('id', $data['id']);
		$this->db->update('books', $data);
	}

	public function delete($id){
		$this->db->where('id', $id);
		$this->db->delete('books');
	}
}
