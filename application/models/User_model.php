<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function insert($data){
		$this->db->insert('users', $data);
	}

	public function login($data){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('username', $data['username']);
		$this->db->where('password', $data['password']);
		$this->db->where('status', 'active');
		$this->db->where('deleted', 'false');
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_all_users(){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('deleted', 'false');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_user($id){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function update($data){
		$this->db->where('id', $data['id']);
		$this->db->update('users', $data);
	}

	public function delete($id){
		$this->db->where('id', $id);
		$this->db->delete('users');
	}

}
