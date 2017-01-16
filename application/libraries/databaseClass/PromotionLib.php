<?php
class PromotionLib{
	private $id;
	private $name;
	private $description;

	public function get_value($name){
		$value = null;
		if($name==id)
			$value = $this->id;
		if($name==name)
			$value = $this->name;
		if($name==description)
			$value = $this->description;
		return $value;
	}

	public function get_array_value($name){
		$value = array();
		if($name=='id')
			$value['promotion_id'] =  $this->id;
		if($name=='name')
			$value['promotion_name'] =  $this->name;
		if($name=='description')
			$value['promotion_description'] =  $this->description;

		return $value;
	}

	public function set_value($name, $value){
		if($name=='id')
			$this->id = $value;
		if($name=='name')
			$this->name = $value;
		if($name=='description')
			$this->description = $value;
	}

	public function set_data($promotion_id,$promotion_name,$promotion_description){
		$this->id = $promotion_id;
		$this->name = $promotion_name;
		$this->description = $promotion_description;
		return $this;
	}

	public function reset_data(){
		$this->id = null;
		$this->name = null;
		$this->description = null;
	}

	public function set_primary_key($promotion_id){
		$this->id = id;
	}

	public function get_primary_key(){

		return array("promotion_id" => $this->id);
	}

	public function get_json_view(){
		return array("id" => $this->id,"name" => $this->name,"description" => $this->description);
	}

	public function get_array_add(){
		return array("promotion_id" => $this->id,"promotion_name" => $this->name,"promotion_description" => $this->description);
	}

	public function get_array_update(){
		$update_array = array();

		if($this->id!=NULL)
			$update_array['promotion_id'] = $this->id;
		if($this->name!=NULL)
			$update_array['promotion_name'] = $this->name;
		if($this->description!=NULL)
			$update_array['promotion_description'] = $this->description;
		return $update_array;
	}
}