<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Restaurant_menu_price{
	private $size_id = null;
	private $price = null;
	private $item_id = null;

	public function set_data($size_id, $price, $item_id){
		$this->size_id = $size_id; 
		$this->price = $price;
		$this->item_id = $item_id;

		return $this;
	}

	public function get_array_add(){
		return array( "size_id_fk" => $this->size_id,
				"price" => $this->price,
				"item_unique_id_fk" => $this->item_id
			    );
	}

	public function set_value($name, $value){
		
		if($name=='size_id')
			$this->size_id = $value;
		else if($name=='item_id')
			$this->item_id = $value;
		else if($name=='price')
			$this->price = $value;

		return $value;
	}

	public function get_array_update(){
		$update_array = array();

		if($this->item_id!=NULL)
			$update_array['item_unique_id_fk'] = $this->item_id;
		if($this->price!=NULL)
				$update_array['price'] = $this->price;
		if($this->size_id!=NULL)
			$update_array['size_id_fk'] = $this->size_id;
			    
		return $update_array;
	}


	public function reset_data(){
		$this->size_id = null; 
		$this->price = null;
		$this->item_id = null;
	}

	public function set_primary_key($size_id, $item_id){
		$this->size_id = $size_id;
		$this->item_id = $item_id;
	}

	public function get_primary_key(){
		return array("size_id_fk" => $this->size_id, "item_unique_id_fk" => $this->item_id);
	}

	public function get_associative_array(){
		return array( 	"size_id" => $this->size_id,  
				"price" => $this->price
			    );
	}


	public function get_value($name){
        $value = null;
		if($name=='size_id')
			$value = $this->size_id;
		else if($name=='item_id')
			$value = $this->item_id;
		else if($name=='price')
			$value = $this->price;
		return $value;
	}

	public function get_array_value($name){
		 $value = array();
		if($name=='size_id')
			$value['size_id_fk'] = $this->size_id;
		else if($name=='item_id')
			$value['item_unique_id_fk'] = $this->item_id;
		else if($name=='price')
			$value['price'] = $this->price;
        
		return $value;
	}
}
