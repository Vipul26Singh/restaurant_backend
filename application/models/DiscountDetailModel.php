<?php
class DiscountDetailModel extends CI_Model{
	private $table_name ="tbl_dtl_invoice_discount";

	public function __construct()
	{
		$this->load->database('krazytable');
	}

	public function get_data($data)
	{
		$this->db->select('disount_id_fk, invoice_id_fk, restaurant_id_fk, discount_name, discount_amount, vendor_note');
		$this->db->from($this->table_name);
		$this->db->where('invoice_id_fk', $data['invoice_id']);
		$this->db->order_by("invoice_id desc");

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
