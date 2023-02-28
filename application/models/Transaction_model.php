<?php

class Transaction_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

	/**
	 * Insert or update
	 *
	 * @param array $data
	 * @param array $where
	 * @return void
	 */
    public function upsert($data, $where) {

        if($this->db->get_where('transaction_book', $where)->num_rows() > 0)
            return $this->db->update('transaction_book', $data, $where);
        else
            return $this->db->insert('transaction_book', $data);
    }
}
