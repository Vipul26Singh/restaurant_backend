<?php
class OrderDetailModel extends CI_Model{
	private $table_name ="tbl_dtl_order";

	public function __construct()
	{
		$this->load->database('krazytable');
	}

	public function get_data($data)
	{
		$this->db->select('order_id_fk, item_id_fk, size_id_fk, size_name, order_qty, item_name, discount_id_fk, discount_name, discount_price, payable_price, order_time, expected_delivery_time, order_status');
		$this->db->from($this->table_name);
		$this->db->where('order_id_fk', $data['order_id']);
		$this->db->order_by("expected_delivery_time desc, order_time desc");

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
