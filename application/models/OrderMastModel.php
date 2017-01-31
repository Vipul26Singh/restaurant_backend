<?php
class OrderMastModel extends CI_Model{
	private $table_name ="tbl_mast_order";
	private $limit = null;

	public function __construct()
	{
		$this->load->database('krazytable');
	}


	public function set_limit($lim){
		$this->limit = $lim;
	}

	public function get_data($data = null)
	{
		$this->db->select('order_id_pk, restaurant_id_fk, unbilled_amount, total_item_discount, unbilled_discounted_amount, additional_discount, payable_amount, total_tax, billed_amount, order_date, delivery_date, expected_delivery_time, table_no_fk, order_type, order_status, customer_id_fk, customer_name, customer_image_url, order_modification_time, customer_mobile_fk, customer_email_id_fk, invoice_no_fk');
		$this->db->from($this->table_name);

		if(isset($data['restaurant_id']))
			$this->db->where('restaurant_id_fk', $data['restaurant_id']);
		
		if(isset($data['order_modification_time']))
			$this->db->where('order_modification_time < ', $data['order_modification_time'], FALSE);   // ecpecting  > curdate() or similar

		if(isset($data['customer_id']))
                        $this->db->where('customer_id_fk', $data['customer_id']);

		$this->db->order_by("order_modification_time desc");

		if(isset($this->limit) && $this->limit!=null){
			$this->db->limit($this->limit);	
		}
		
		$query = $this->db->get();
		//print_r($this->db);
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
