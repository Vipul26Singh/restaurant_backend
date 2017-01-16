<?php
class RestaurantPackageLib{
	private $restaurant_id;
	private $package_id;
	private $promotion_id;
	private $request_id;
	private $description;
	private $start_date;
	private $end_date;

	public function get_value($name){
		$value = null;
		if($name=='restaurant_id')
			$value = $this->restaurant_id;
		if($name=='package_id')
			$value = $this->package_id;
		if($name=='promotion_id')
			$value = $this->promotion_id;
		if($name=='request_id')
			$value = $this->request_id;
		if($name=='description')
			$value = $this->description;
		if($name=='start_date')
			$value = $this->start_date;
		if($name=='end_date')
			$value = $this->end_date;
		return $value;
	}

	public function get_array_value($name){
		$value = array();
		if($name=='restaurant_id')
			$value['restaurant_id_fk'] =  $this->restaurant_id;
		if($name=='package_id')
			$value['package_id_fk'] =  $this->package_id;
		if($name=='promotion_id')
			$value['promotion_id_fk'] =  $this->promotion_id;
		if($name=='request_id')
			$value['request_id'] =  $this->request_id;
		if($name=='description')
			$value['restaurant_request_description'] =  $this->description;
		if($name=='start_date')
			$value['start_date'] =  $this->start_date;
		if($name=='end_date')
			$value['end_date'] =  $this->end_date;

		return $value;
	}

	public function set_value($name, $value){
		if($name=='restaurant_id')
			$this->restaurant_id = $value;
		if($name=='package_id')
			$this->package_id = $value;
		if($name=='promotion_id')
			$this->promotion_id = $value;
		if($name=='request_id')
			$this->request_id = $value;
		if($name=='description')
			$this->description = $value;
		if($name=='start_date')
			$this->start_date = $value;
		if($name=='end_date')
			$this->end_date = $value;
	}

	public function set_data($restaurant_id_fk,$package_id_fk,$promotion_id_fk,$request_id,$restaurant_request_description,$start_date,$end_date){
		$this->restaurant_id = $restaurant_id_fk;
		$this->package_id = $package_id_fk;
		$this->promotion_id = $promotion_id_fk;
		$this->request_id = $request_id;
		$this->description = $restaurant_request_description;
		$this->start_date = $start_date;
		$this->end_date = $end_date;
		return $this;
	}

	public function reset_data(){
		$this->restaurant_id = null;
		$this->package_id = null;
		$this->promotion_id = null;
		$this->request_id = null;
		$this->description = null;
		$this->start_date = null;
		$this->end_date = null;
	}

	public function set_primary_key($request_id){
		$this->request_id = request_id;
	}

	public function get_primary_key(){

		return array("request_id" => $this->request_id);
	}

	public function get_json_view(){
		return array("restaurant_id" => $this->restaurant_id,"package_id" => $this->package_id,"promotion_id" => $this->promotion_id,"description" => $this->description,"start_date" => $this->start_date,"end_date" => $this->end_date);
	}

	public function get_array_add(){
		return array("restaurant_id_fk" => $this->restaurant_id,"package_id_fk" => $this->package_id,"promotion_id_fk" => $this->promotion_id,"request_id" => $this->request_id,"restaurant_request_description" => $this->description,"start_date" => $this->start_date,"end_date" => $this->end_date);
	}

	public function get_array_update(){
		$update_array = array();

		if($this->restaurant_id!=NULL)
			$update_array['restaurant_id_fk'] = $this->restaurant_id;
		if($this->package_id!=NULL)
			$update_array['package_id_fk'] = $this->package_id;
		if($this->promotion_id!=NULL)
			$update_array['promotion_id_fk'] = $this->promotion_id;
		if($this->request_id!=NULL)
			$update_array['request_id'] = $this->request_id;
		if($this->description!=NULL)
			$update_array['restaurant_request_description'] = $this->description;
		if($this->start_date!=NULL)
			$update_array['start_date'] = $this->start_date;
		if($this->end_date!=NULL)
			$update_array['end_date'] = $this->end_date;
		return $update_array;
	}
}
