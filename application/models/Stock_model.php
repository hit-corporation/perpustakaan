<?php

class Stock_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Get All Data
	 *
	 * @return array
	 */
	public function get_all(array $filter = NULL, int $limit = NULL, int $offset = NULL): array {

		$query = $this->db->select('a.stock_code, a.is_available, a.book_id, a.created_at, b.title, b.cover_img, b.author')
						  ->from('stocks a, books b')
						  ->where('a.book_id=b.id');

		return $query->get()->result_array();
	}
}

