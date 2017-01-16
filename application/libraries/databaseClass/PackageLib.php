<?php
class PackageLib{
	private $package_id;
	private $name;
	private $description;
	private $duration;
	private $promotion_id;
	private $cost;

	public function get_value($name){
		$value = null;
		if($name==package_id)
			$value = $this->package_id;
		if($name==name)
			$value = $this->name;
		if($name==description)
			$value = $this->description;
		if($name==duration)
			$value = $this->duration;
		if($name==promotion_id)
			$value = $this->promotion_id;
		if($name==cost)
			$value = $this->cost;
		return $value;
	}

	public function get_array_value($name){
		$value = array();
		if($name=='package_id')
			$value['package_id'] =  $this->package_id;
		if($name=='name')
			$value['package_name'] =  $this->name;
		if($name=='description')
			$value['package_description'] =  $this->description;
		if($name=='duration')
			$value['package_duration'] =  $this->duration;
		if($name=='promotion_id')
			$value['promotion_id_fk'] =  $this->promotion_id;
		if($name=='cost')
			$value['package_cost'] =  $this->cost;

		return $value;
	}

	public function set_value($name, $value){
		if($name=='package_id')
			$this->package_id = $value;
		if($name=='name')
			$this->name = $value;
		if($name=='description')
			$this->description = $value;
		if($name=='duration')
			$this->duration = $value;
		if($name=='promotion_id')
			$this->promotion_id = $value;
		if($name=='cost')
			$this->cost = $value;
	}

	public function set_data($package_id,$package_name,$package_description,$package_duration,$promotion_id_fk,$package_cost){
		$this->package_id = $package_id;
		$this->name = $package_name;
		$this->description = $package_description;
		$this->duration = $package_duration;
		$this->promotion_id = $promotion_id_fk;
		$this->cost = $package_cost;
		return $this;
	}

	public function reset_data(){
		$this->package_id = null;
		$this->name = null;
		$this->description = null;
		$this->duration = null;
		$this->promotion_id = null;
		$this->cost = null;
	}

	public function set_primary_key($package_id){
		$this->package_id = package_id;
	}

	public function get_primary_key(){

		return array("package_id" => $this->package_id);
	}

	public function get_json_view(){
		return array("package_id" => $this->package_id,"name" => $this->name,"description" => $this->description,"duration" => $this->duration,"cost" => $this->cost);
	}

	public function get_array_add(){
		return array("package_id" => $this->package_id,"package_name" => $this->name,"package_description" => $this->description,"package_duration" => $this->duration,"promotion_id_fk" => $this->promotion_id,"package_cost" => $this->cost);
	}

	public function get_array_update(){
		$update_array = array();

		if($this->package_id!=NULL)
			$update_array['package_id'] = $this->package_id;
		if($this->name!=NULL)
			$update_array['package_name'] = $this->name;
		if($this->description!=NULL)
			$update_array['package_description'] = $this->description;
		if($this->duration!=NULL)
			$update_array['package_duration'] = $this->duration;
		if($this->promotion_id!=NULL)
			$update_array['promotion_id_fk'] = $this->promotion_id;
		if($this->cost!=NULL)
			$update_array['package_cost'] = $this->cost;
		return $update_array;
	}
}