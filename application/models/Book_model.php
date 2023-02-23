<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Book_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Get All Data
	 *
	 * @param array|null $filter
	 * @param integer|null $limit
	 * @param integer|null $offset
	 * @return array
	 */
	public function get_all(?array $filter=NULL, ?int $limit=NULL, int $offset=NULL): array 
	{

		$this->db->join('categories', 'books.category_id=categories.id');
		$this->db->join('publishers', 'books.publisher_id=publishers.id');

		$this->db->where('books.deleted_at IS NULL');

		if(!empty($limit) && !is_null($offset))
			$this->db->limit($limit, $offset);
		
		$query = $this->db->get('books');
		return $query->result_array();
	}

	/**
	 * Count All Results With Filters
	 *
	 * @param array|null $filter
	 * @return integer
	 */
	public function count_all(?array $filter=NULLL): int 
	{
		$this->db->join('categories', 'books.category_id=categories.id');
		$this->db->join('publishers', 'books.publisher_id=publishers.id');

		$this->db->where('books.deleted_at IS NULL');

		if(!empty($filters))
		{

		}
		$query = $this->db->get('books');
		return $query->num_rows();
	}

	/**
	 * Get a record by id
	 *
	 * @param int $id
	 * @return array
	 */
	public function get_one($id): ?array
	{
		$this->db->join('categories', 'books.category_id=categories.id');
		$this->db->join('publishers', 'books.publisher_id=publishers.id');
		return $this->db->get_where('books', ['books.id' => $id, 'books.deleted_at' => NULL])->row_array();
	}
}
