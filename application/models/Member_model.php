<?php

class Member_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

	public function get_all(?array $filter = NULL, ?int $limit=NULL, ?int $offset=NULL): array {
        
		if(!empty($filter[1]['search']['value']))
		$this->db->where('LOWER(member_name) LIKE \'%'.trim(strtolower($filter[1]['search']['value'])).'%\'', NULL, FALSE);
	
		if(!empty($limit) && !is_null($offset))
		$this->db->limit($limit, $offset);
        
		$this->db->where('deleted_at IS NULL');
        $query = $this->db->get('members');
        return $query->result_array();
    }

	public function count_all(?array $filter = NULL){
        $query = $this->db->get('members');
        return $query->num_rows();
    }

	public function get_top_borrow(): array {
		// date range 30 days postgresql
		$this->db->select('m.member_name, count(m.member_name) as total');
		$this->db->from('transactions t');
		$this->db->join('members m', 'm.id = t.member_id');
		$this->db->join('transaction_book tb', 'tb.transaction_id = t.id');
		$this->db->where('t.trans_timestamp >= now() - interval \'30 days\'');
		$this->db->group_by('m.member_name');
		$this->db->order_by('total', 'DESC');
		$this->db->limit(10);
		$query = $this->db->get();
		return $query->result_array();
	}
}
