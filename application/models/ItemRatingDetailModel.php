<?php
class ItemRatingDetailModel extends CI_Model{
	private $table_name ="tbl_detail_item_rating";

	public function __construct()
	{
		$this->load->database('krazytable');
	}

	public function get_data($data)
	{
		$this->db->select('restaurant_id_pk_fk, order_id_pk_fk, customer_id_pk_fk, transaction_time, order_item_pk_fk, rating_given, comments_given');
		$this->db->from($this->table_name);
		if(isset($data['restaurant_id']))
			$this->db->where('restaurant_id_pk_fk', $data['restaurant_id']);
		if(isset($data['order_id']))
			$this->db->where('order_id_pk_fk', $data['order_id']);
		if(isset($data['customer_id']))
			$this->db->where('customer_id_pk_fk', $data['customer_id']);
		if(isset($data['order_item']))
			$this->db->where('order_item_pk_fk', $data['order_item']);
		$this->db->order_by("transaction_time desc");

		$query = $this->db->get();
		return $query->result_array();
	}

	public function add_data($array_object)
	{
		$this->db->trans_start();
		$this->db->insert($this->table_name, $array_object);
		$id = $this->db->insert_id();
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
		{
			log_message("error", "Error in file" . __FILE__ . "at line" . __LINE__ .  print_r($array_object, true) . " due to " . print_r($this->db->error(), true));
			throw new Exception("Error in file" . __FILE__ . "at line" . __LINE__, EXIT_DATABASE);
		}
		return $id;
	}

	public function replace_data($array_object, $primary_key)
	{
		$this->db->trans_start();
		$this->db->where($primary_key);
		$this->db->update($this->table_name, $array_object);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
		{
			log_message("error", "Error in file" . __FILE__ . "at line" . __LINE__   . print_r($array_object, true) . " due to ". print_r($this->db->error(), true));
			throw new Exception("Error in file" . __FILE__ . "at line" . __LINE__, EXIT_DATABASE);
		}
	}
}
