<?php
class RestaurantRatingDetailModel extends CI_Model{
	private $table_name ="tbl_detail_restaurant_rating";
	private $limit = null;

	
	
	public function __construct()
	{
		$this->load->database('krazytable');
	}

	public function set_limit($lim){
                $this->limit = $lim;
        }

	public function get_data($data)
	{
		$this->db->select('restaurant_id_pk1_fk, order_id_pk2_fk, customer_id_fk, transaction_time, rating_given, comments_given');
		$this->db->from($this->table_name);
		if(isset($data['restaurant_id_pk1_fk']))
			$this->db->where('restaurant_id_pk1_fk', $data['restaurant_id']);
		if(isset($data['order_id_pk2_fk']))
			$this->db->where('order_id_pk2_fk', $data['order_id']);
		if(isset($data['customer_id_fk']))
			$this->db->where('customer_id_fk', $data['customer_id']);
		$this->db->order_by("transaction_time desc");
	
		if(isset($this->limit) && $this->limit!=null){
                        $this->db->limit($this->limit);
                }

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
