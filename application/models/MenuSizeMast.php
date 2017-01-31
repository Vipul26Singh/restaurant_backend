<?php
class MenuSizeMast extends CI_Model {
    private $table_name = "tbl_mast_menu_size";
    private $table_name_price = "tbl_detail_restaurant_menu_price";
	public function __construct()
	{
		$this->load->database('krazytable');
	}

	public function get_data($data)
	{   
        $this->db->select('size_id_pk as id, plate_size as Size, display_name as Name, description as Description');
        $this->db->from($this->table_name);
        $this->db->where('restaurant_id_pk_fk', $data['restaurant_id']);
        $this->db->order_by('size_id_pk', 'ASC');
        
		$query = $this->db->get();
		return $query->result_array();
	}

    public function get_size_count($size_id)
    {   
        $this->db->select('size_id_fk');
        $this->db->from($this->table_name_price);
        $this->db->where('size_id_fk', $size_id);
        
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function add_data($array_object)
	{   

        //$this->db->set($object);
	$this->db->trans_start();
        $this->db->insert($this->table_name, $array_object);
	$this->db->trans_complete();

                if ($this->db->trans_status() === FALSE)
                {
                        log_message("error", "Unable to add size " . print_r($array_object, true) . " due to " . print_r($this->db->error(), true));
                        throw new Exception("Unable to add size" . print_r($array_object, true) . " due to " . print_r($this->db->error(), true), EXIT_DATABASE);
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
                        log_message("error", "Unable to delete size " . print_r($array_object) . " due to " . print_r($this->db->error(), true));
                        throw new Exception("Unable to delete size", EXIT_DATABASE);
                }

	}
}
