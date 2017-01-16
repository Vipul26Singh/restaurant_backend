<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Test{
	private $table_name =test_table;

	public function __construct()
	{
		$this->load->database('krazytable');
	}

	public function get_data($data)
	{
		$this->db->select('table_col1, table_col2, table_col3');
		$this->db->from($this->table_name);
		$this->db->where('table_col1', $data['api_col1']);
		$this->db->where('table_col2', $data['api_col2']);
		$this->db->order_by(string_order_by);

		$query = $this->db->get();
		return $query->result_array();
	}

	public function add_data($array_object)
	{
		$this->db->trans_start();
		$this->db->insert($this->table_name, $array_object);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
		{
			log_message("error", "Error in file" . __FILE__ . "at line" . __LINE__ .  print_r($array_object, true) . " due to " . print_r($this->db->error(), true));
			throw new Exception("Error in file" . __FILE__ . "at line" . __LINE__, EXIT_DATABASE);
		}
	}

	public function replace_data($array_object, $primary_key)
	{
		$this->db->trans_start();
		$this->db->where($primary_key);
		$this->db->update($this->table_name, $array_object);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
		{
			log_message("error", "Error in file" . __FILE__ . "at line" . __LINE__   . print_r(, true) . " due to ". print_r($this->db->error(), true));
			throw new Exception("Error in file" . __FILE__ . "at line" . __LINE__, EXIT_DATABASE);
		}
	}
}
