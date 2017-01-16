<?php
class MenuCategory1 extends CI_Model {
    private $table_name = "tbl_detail_display_restaurant_menu_sub_category_1";
    
	public function __construct()
	{
		$this->load->database('krazytable');
	}

	public function get_data($data)
	{   
        $this->db->select("category_1_id as id, sub_category_pk2 as title, category_1_description as description, sequence_pk3 as sequence, concat('".htmlspecialchars(KRAZYTABLE_URL)."', image_relative_path)  as image_url_relative");
        $this->db->from($this->table_name);
        $this->db->where('restaurant_id_pk_fk', $data['restaurant_id']);
        $this->db->order_by('sequence_pk3', 'ASC');
        
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
                        log_message("error", "Unable to add category " . print_r($array_object, true) . " due to " . print_r($this->db->error(), true));
                        throw new Exception("Unable to add category", EXIT_DATABASE);
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
                log_message("error", "Unable to replace category " . print_r($array_object, true) . " due to " . print_r($this->db->error(), true));
                throw new Exception("Unable to replace category", EXIT_DATABASE);
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
                        log_message("error", "Unable to delete category " . print_r($array_object, true) . " due to " . print_r($this->db->error(), true));
                        throw new Exception("Unable to delete category", EXIT_DATABASE);
                }

	}
}
