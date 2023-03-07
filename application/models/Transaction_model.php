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

	/**
	 * Get All Data With Generator 
	 *
	 * @param array|null $filter
	 * @param integer|null $limit
	 * @param integer|null $offset
	 * @return Generator
	 */
	public function get_all(?array $filter = NULL, ?int $limit=NULL, ?int $offset=NULL): Generator 
	{
        
		if(!empty($filter[1]['search']['value']))
		$this->db->where('LOWER(member_name) LIKE \'%'.trim(strtolower($filter[1]['search']['value'])).'%\'', NULL, FALSE);

		if(!empty($filter[2]['search']['value'])){
			// PARSING DATE RANGE
			$date_range = explode(' - ', $filter[2]['search']['value']);

			$this->db->where('date(transactions.created_at) >=', $date_range[0]);
			$this->db->where('date(transactions.created_at) <=', $date_range[1]);
		}

		if(!empty($filter[3]['search']['value'])){
			if($filter[3]['search']['value'] == 'belum')
				$this->db->where('transaction_book.actual_return IS NULL', NULL, FALSE);
			else
				$this->db->where('transaction_book.actual_return IS NOT NULL', NULL, FALSE);
		}
	
		if(!empty($limit) && !is_null($offset))
		$this->db->limit($limit, $offset);
        
		$this->db->select('transactions.*, transaction_book.id, transaction_book.book_id, transaction_book.qty, 
						   transaction_book.return_date, transaction_book.updated_at, transaction_book.amount_paid, 
						   transaction_book.note, books.title, members.member_name, 
						   AGE(transaction_book.return_date::date, trans_timestamp::date) AS jumlah_hari_pinjam,
						   CASE 
						   		WHEN (CURRENT_DATE > transaction_book.return_date::date) and (transaction_book.actual_return IS NULL)
						   			THEN AGE(CURRENT_DATE, transaction_book.return_date::date)
								WHEN (CURRENT_DATE > transaction_book.return_date::date) and (transaction_book.actual_return IS NOT NULL)
									THEN AGE(transaction_book.actual_return::date, transaction_book.return_date::date)
								ELSE NULL
							END as jumlah_hari_terlambat', FALSE);
        $this->db->from('transactions');
		$this->db->join('transaction_book', 'transactions.id = transaction_book.transaction_id');
		$this->db->join('books', 'transaction_book.book_id = books.id');
		$this->db->join('members', 'transactions.member_id = members.id');

		$results = $this->db->get()->result_array();
		
		foreach($results as $res => $val)
		{
			yield $res => $val;
		}
    }

	public function count_all(?array $filter = NULL): int {
        $query = $this->db->get('transactions');
        return $query->num_rows();
    }
}
