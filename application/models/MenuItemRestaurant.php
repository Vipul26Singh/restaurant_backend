<?php
class MenuItemRestaurant extends CI_Model {
    private $table_name = "tbl_mast_restaurant_menu_item";
	public function __construct()
	{
		$this->load->database('krazytable');
	}

	public function get_data($data)
	{   
        $this->db->select('restaurant_id_pk1_fk, item_unique_id, menu_item_pk2_fk, display_content, cuisine, veg_status, sub_category_1, image_relative_url, item_sequence, availability');
        $this->db->from($this->table_name);
        $this->db->where('restaurant_id_pk1_fk', $data['restaurant_id']);
        $this->db->order_by('(SELECT sequence_pk3 FROM tbl_detail_display_restaurant_menu_cuisine WHERE cuisine_id = sub_category_1), (select sequence_pk3 from tbl_detail_display_restaurant_menu_sub_category_1 where category_1_id = sub_category_1), item_sequence');

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
		        log_message("error", "Unable to add menu item " . print_r($array_object, true) . " due to " . print_r($this->db->error(), true));
		        throw new Exception("Unable to add menu item " . print_r($array_object, true) . " due to " . print_r($this->db->error(), true), EXIT_DATABASE);
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
        	$this->db->delete("tbl_detail_restaurant_menu_price", array("item_unique_id_fk" => $array_object['item_unique_id']));
		$this->db->delete($this->table_name, $array_object);
        	$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
                {
                        log_message("error", "Unable to delete menu item " . print_r($array_object) . " due to " . print_r($this->db->error(), true));
                        print_r($this->db->error());
                        throw new Exception("Unable to delete menu item ", EXIT_DATABASE);
                }

        }

}
