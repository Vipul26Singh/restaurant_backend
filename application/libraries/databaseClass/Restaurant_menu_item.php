<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Restaurant_menu_item{
	private $restaurant_id = null;
	private $item_id = null;
	private $item_name = null;
	private $display_content = null; 
	private $cuisine_id = null;
	private $veg_status = null;
	private $sub_category_id = null;
	private $image_url = null;
	private $sequence_id = null;
	private $availability = null;
	private $item_sequence = null;

	public function get_value($name){
        $value = null;
		if($name=='restaurant_id')
			$value = $this->restaurant_id;
		else if($name=='item_id')
			$value = $this->item_id;
		else if($name=='item_name')
			$value = $this->item_name;
		else if($name=='content')
			$value = $this->display_content;
		else if($name=='cuisine_id')
			$value = $this->cuisine_id;
		else if($name=='veg_status')
			$value = $this->veg_status;
		else if($name=='category_1_id')
			$value = $this->sub_category_id;
		else if($name=='image_url')
			$value = $this->image_url;
		else if($name=='item_sequence')
			$value = $this->sequence_id;
		else if($name=='availability')
        	$value = $this->availability;

		return $value;
	}

	public function get_array_value($name){
		$value = array();
		if($name=='restaurant_id')
			$value['restaurant_id_pk1_fk'] = $this->restaurant_id;
		else if($name=='item_id')
			$value['item_unique_id'] = $this->item_id;
		else if($name=='item_name')
			$value['menu_item_pk2_fk'] = $this->item_name;
		else if($name=='content')
			$value['display_content'] = $this->display_content;
		else if($name=='cuisine_id')
			$value['cuisine'] = $this->cuisine_id;
		else if($name=='veg_status')
			$value['veg_status'] = $this->veg_status;
		else if($name=='category_1_id')
			$value['sub_category_1'] = $this->sub_category_id;
		else if($name=='image_url')
			$value['image_relative_url'] = $this->image_url;
		else if($name=='item_sequence')
			$value['item_sequence'] = $this->sequence_id;
		else if($name=='availability')
        	$value['availability'] = $this->availability;
        
		return $value;
	}

	public function set_value($name, $value){
		
		if($name=='restaurant_id')
			$this->restaurant_id = $value;
		else if($name=='item_id')
			$this->item_id = $value;
		else if($name=='item_name')
			$this->item_name = $value;
		else if($name=='content')
			$this->display_content = $value;
		else if($name=='cuisine_id')
			$this->cuisine_id = $value;
		else if($name=='veg_status'){
			$value = strtoupper($value);			
			if($value=='VEG' OR $value=='NON-VEG'){
				$this->veg_status = $value;
			}
			else{
				throw new exception("Veg status neeed to be 'VEG' or 'NON-VEG'");
			}
		}
		else if($name=='category_1_id')
			$this->sub_category_id = $value;
		else if($name=='image_url')
			$this->image_url = $value;
		else if($name=='item_sequence')
			$this->sequence_id = $value;
		else if($name=='availability')
        	$this->availability = $value;
        
		return $value;
	}

	public function set_data($restaurant_id_pk1_fk, $item_unique_id, $menu_item_pk2_fk, $display_content, $cuisine, $veg_status, $sub_category_1, $image_relative_url, $item_sequence, $availability){
		$this->restaurant_id = $restaurant_id_pk1_fk;
		$this->item_id = $item_unique_id;
		$this->item_name = $menu_item_pk2_fk;
		$this->display_content = $display_content;
		$this->cuisine_id = $cuisine;

		$veg_status = strtoupper($veg_status);

		if($veg_status=='VEG' OR $veg_status=='NON-VEG'){
			$this->veg_status = $veg_status;
		}
		else{
			throw new exception("Veg status neeed to be 'VEG' or 'NON-VEG'");
		}
		$this->sub_category_id = $sub_category_1;
		$this->image_url = $image_relative_url;
		$this->sequence_id = $item_sequence;
        $this->availability = $availability;

		return $this;
	}


	public function reset_data(){
		$this->restaurant_id = null;
		$this->item_id = null;
		$this->item_name = null;
		$this->display_content = null;
		$this->cuisine_id = null;
		$this->sub_category_id = null;
		$this->image_url = null;
		$this->sequence_id = null;
        $this->veg_status = null;
        $this->availability = null;
	}

	public function set_primary_key($id){
		$this->item_id = $id;
	}

	public function get_primary_key(){
		return array("item_unique_id" => $this->item_id);
	}

	public function get_json_view(){
		return array( "item_id" => $this->item_id,
				"item_name" => $this->item_name,
				"content" => $this->display_content, 
				"cuisine_id" => $this->cuisine_id,
				"category_1_id" => $this->sub_category_id,
				"image_url" => $this->image_url,
				"sequence" => $this->sequence_id,
				"veg_status" => $this->veg_status,
				"availability" => $this->availability 
			    );
	}

	public function get_array_add(){
		return array( "item_unique_id" => $this->item_id,
				"menu_item_pk2_fk" => $this->item_name,
				"restaurant_id_pk1_fk" => $this->restaurant_id,
				"display_content" => $this->display_content, 
				"cuisine" => $this->cuisine_id,
				"sub_category_1" => $this->sub_category_id,
				"image_relative_url" => $this->image_url,
				"item_sequence" => $this->sequence_id,
				"veg_status" => $this->veg_status,
				"availability" => $this->availability 
			    );
	}


	public function get_array_update(){
		$update_array = array();

		if($this->item_id!=NULL)
			$update_array['item_unique_id'] = $this->item_id;
		if($this->item_name!=NULL)
				$update_array['menu_item_pk2_fk'] = $this->item_name;
		if($this->restaurant_id!=NULL)
				$update_array['restaurant_id_pk1_fk'] = $this->restaurant_id;
		if($this->display_content!=NULL)
				$update_array['display_content'] = $this->display_content; 
		if($this->cuisine_id!=NULL)
				$update_array['cuisine'] = $this->cuisine_id;
		if($this->sub_category_id!=NULL)
				$update_array['sub_category_1'] = $this->sub_category_id;
		if($this->image_url!=NULL)
				$update_array['image_relative_url'] = $this->image_url;
		if($this->sequence_id!=NULL)
				$update_array['item_sequence'] = $this->sequence_id;
		if($this->veg_status!=NULL)
				$update_array['veg_status'] = $this->veg_status;
		if($this->availability!=NULL)
				$update_array['availability'] = $this->availability; 
			    
		return $update_array;
	}
}
