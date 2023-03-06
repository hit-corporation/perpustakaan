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

	public function get_all(?array $filter = NULL, ?int $limit=NULL, ?int $offset=NULL): array {
        
		if(!empty($filter[1]['search']['value']))
		$this->db->where('LOWER(member_name) LIKE \'%'.trim(strtolower($filter[1]['search']['value'])).'%\'', NULL, FALSE);
	
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
							END as jumlah_hari_terlambat,
							CASE WHEN CURRENT_DATE > transaction_book.return_date::date 
									AND ((CURRENT_DATE - transaction_book.return_date::date)::integer * (SELECT fines_amount FROM settings WHERE settings.id=1)::integer) <=
										(SELECT fines_maximum FROM settings WHERE settings.id=1)
									THEN (CURRENT_DATE - transaction_book.return_date::date)::integer * (SELECT fines_amount FROM settings WHERE settings.id=1)::integer
								WHEN CURRENT_DATE > transaction_book.return_date::date 
								 		AND ((CURRENT_DATE - transaction_book.return_date::date)::integer * (SELECT fines_amount FROM settings WHERE settings.id=1)::integer) >=
									 	(SELECT fines_maximum FROM settings WHERE settings.id=1)
									THEN (SELECT fines_maximum FROM settings WHERE settings.id=1)
								ELSE 0 
							END as denda', FALSE);
        $this->db->from('transactions');
		$this->db->join('transaction_book', 'transactions.id = transaction_book.transaction_id');
		$this->db->join('books', 'transaction_book.book_id = books.id');
		$this->db->join('members', 'transactions.member_id = members.id');

		return $this->db->get()->result_array();
    }

	public function count_all(?array $filter = NULL){
        $query = $this->db->get('transactions');
        return $query->num_rows();
    }
}
