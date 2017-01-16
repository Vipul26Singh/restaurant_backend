<?php
class RestaurantCustomerDetailLib{
	private $restaurant_id;
	private $customer_id;
	private $total_purchase;
	private $last_visited;
	private $total_visit;

	public function get_value($name){
		$value = null;
		if($name=='restaurant_id')
			$value = $this->restaurant_id;
		if($name=='customer_id')
			$value = $this->customer_id;
		if($name=='total_purchase')
			$value = $this->total_purchase;
		if($name=='last_visited')
			$value = $this->last_visited;
		if($name=='total_visit')
			$value = $this->total_visit;
		return $value;
	}

	public function get_array_value($name){
		$value = array();
		if($name=='restaurant_id')
			$value['restaurant_id_fk'] =  $this->restaurant_id;
		if($name=='customer_id')
			$value['customer_id_fk'] =  $this->customer_id;
		if($name=='total_purchase')
			$value['total_purchase'] =  $this->total_purchase;
		if($name=='last_visited')
			$value['last_visited'] =  $this->last_visited;
		if($name=='total_visit')
			$value['total_visit'] =  $this->total_visit;

		return $value;
	}

	public function set_value($name, $value){
		if($name=='restaurant_id')
			$this->restaurant_id = $value;
		if($name=='customer_id')
			$this->customer_id = $value;
		if($name=='total_purchase')
			$this->total_purchase = $value;
		if($name=='last_visited')
			$this->last_visited = $value;
		if($name=='total_visit')
			$this->total_visit = $value;
	}

	public function set_data($restaurant_id_fk,$customer_id_fk,$total_purchase,$last_visited,$total_visit){
		$this->restaurant_id = $restaurant_id_fk;
		$this->customer_id = $customer_id_fk;
		$this->total_purchase = $total_purchase;
		$this->last_visited = $last_visited;
		$this->total_visit = $total_visit;
		return $this;
	}

	public function reset_data(){
		$this->restaurant_id = null;
		$this->customer_id = null;
		$this->total_purchase = null;
		$this->last_visited = null;
		$this->total_visit = null;
	}

	public function set_primary_key($restaurant_id_fk,$customer_id_fk){
		$this->restaurant_id = restaurant_id;
		$this->customer_id = customer_id;
	}

	public function get_primary_key(){

		return array("restaurant_id_fk" => $this->restaurant_id,"customer_id_fk" => $this->customer_id);
	}

	public function get_json_view(){
		return array("restaurant_id" => $this->restaurant_id,"customer_id" => $this->customer_id,"total_purchase" => $this->total_purchase,"last_visited" => $this->last_visited,"total_visit" => $this->total_visit);
	}

	public function get_array_add(){
		return array("restaurant_id_fk" => $this->restaurant_id,"customer_id_fk" => $this->customer_id,"total_purchase" => $this->total_purchase,"last_visited" => $this->last_visited,"total_visit" => $this->total_visit);
	}

	public function get_array_update(){
		$update_array = array();

		if($this->restaurant_id!=NULL)
			$update_array['restaurant_id_fk'] = $this->restaurant_id;
		if($this->customer_id!=NULL)
			$update_array['customer_id_fk'] = $this->customer_id;
		if($this->total_purchase!=NULL)
			$update_array['total_purchase'] = $this->total_purchase;
		if($this->last_visited!=NULL)
			$update_array['last_visited'] = $this->last_visited;
		if($this->total_visit!=NULL)
			$update_array['total_visit'] = $this->total_visit;
		return $update_array;
	}
}