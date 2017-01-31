<?php
class MenuPriceItem extends CI_Model {
    private $table_name = "tbl_detail_restaurant_menu_price";
	public function __construct()
	{
		$this->load->database('krazytable');
	}

	public function get_data($data)
	{   
        $this->db->select('size_id_fk as size_id, price as price');
        $this->db->from($this->table_name);

	if(isset($data['item_id'])){
		$this->db->where('item_unique_id_fk', $data['item_id']);
	}
        
		$query = $this->db->get();
		return $query->result_array();
	}

	public function add_data($array_object)
	{   

        //$this->db->set($object);
		$this->db->trans_start();
		$this->db->insert($this->table_name, $array_object);
		$this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
                log_message("error", "Unable to add menu price " . print_r($array_object, true) . " due to " . print_r($this->db->error(), true));
                throw new Exception("Unable to add menu price " . print_r($array_object, true) . " due to " . print_r($this->db->error(), true), EXIT_DATABASE);
        }

	}

	public function replace_data($array_object, $primary_key)
	{   
        //$this->db->set($object);
	$this->db->trans_start();
        $this->db->where($primary_key);
        $this->db->update($this->table_name, $array_object);
	$this->db->trans_complete();

                if ($this->db->trans_status() === FALSE)
                {
                        log_message("error", "Unable to replace size " . print_r($array_object, true) . " due to ". print_r($this->db->error(), true));
                        throw new Exception("Unable to replace size", EXIT_DATABASE);
                }

	}


	public function delete_data($array_object)
        {
        //$this->db->set($object);

        $this->db->trans_start();
        $this->db->delete($this->table_name, $array_object);
        $this->db->trans_complete();

                if ($this->db->trans_status() === FALSE)
                {
                        log_message("error", "Unable to delete menu " . print_r($array_object) . " due to " . print_r($this->db->error(), true));
                        throw new Exception("Unable to delete menu", EXIT_DATABASE);
                }

        }


}
