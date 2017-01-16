<?php
class OrderDetailLib{
	private $order_id;
	private $item_id;
	private $size_id;
	private $size_name;
	private $order_qty;
	private $item_name;
	private $discount_id;
	private $discount_name;
	private $discount_price;
	private $payable_price;
	private $order_time;
	private $expected_delivery_time;
	private $order_status;

	public function get_value($name){
		$value = null;
		if($name=='order_id')
			$value = $this->order_id;
		if($name=='item_id')
			$value = $this->item_id;
		if($name=='size_id')
			$value = $this->size_id;
		if($name=='size_name')
			$value = $this->size_name;
		if($name=='order_qty')
			$value = $this->order_qty;
		if($name=='item_name')
			$value = $this->item_name;
		if($name=='discount_id')
			$value = $this->discount_id;
		if($name=='discount_name')
			$value = $this->discount_name;
		if($name=='discount_price')
			$value = $this->discount_price;
		if($name=='payable_price')
			$value = $this->payable_price;
		if($name=='order_time')
			$value = $this->order_time;
		if($name=='expected_delivery_time')
			$value = $this->expected_delivery_time;
		if($name=='order_status')
			$value = $this->order_status;
		return $value;
	}

	public function get_array_value($name){
		$value = array();
		if($name=='order_id')
			$value['order_id_fk'] =  $this->order_id;
		if($name=='item_id')
			$value['item_id_fk'] =  $this->item_id;
		if($name=='size_id')
			$value['size_id_fk'] =  $this->size_id;
		if($name=='size_name')
			$value['size_name'] =  $this->size_name;
		if($name=='order_qty')
			$value['order_qty'] =  $this->order_qty;
		if($name=='item_name')
			$value['item_name'] =  $this->item_name;
		if($name=='discount_id')
			$value['discount_id_fk'] =  $this->discount_id;
		if($name=='discount_name')
			$value['discount_name'] =  $this->discount_name;
		if($name=='discount_price')
			$value['discount_price'] =  $this->discount_price;
		if($name=='payable_price')
			$value['payable_price'] =  $this->payable_price;
		if($name=='order_time')
			$value['order_time'] =  $this->order_time;
		if($name=='expected_delivery_time')
			$value['expected_delivery_time'] =  $this->expected_delivery_time;
		if($name=='order_status')
			$value['order_status'] =  $this->order_status;

		return $value;
	}

	public function set_value($name, $value){
		if($name=='order_id')
			$this->order_id = $value;
		if($name=='item_id')
			$this->item_id = $value;
		if($name=='size_id')
			$this->size_id = $value;
		if($name=='size_name')
			$this->size_name = $value;
		if($name=='order_qty')
			$this->order_qty = $value;
		if($name=='item_name')
			$this->item_name = $value;
		if($name=='discount_id')
			$this->discount_id = $value;
		if($name=='discount_name')
			$this->discount_name = $value;
		if($name=='discount_price')
			$this->discount_price = $value;
		if($name=='payable_price')
			$this->payable_price = $value;
		if($name=='order_time')
			$this->order_time = $value;
		if($name=='expected_delivery_time')
			$this->expected_delivery_time = $value;
		if($name=='order_status')
			$this->order_status = $value;
	}

	public function set_data($order_id_fk,$item_id_fk,$size_id_fk,$size_name,$order_qty,$item_name,$discount_id_fk,$discount_name,$discount_price,$payable_price,$order_time,$expected_delivery_time,$order_status){
		$this->order_id = $order_id_fk;
		$this->item_id = $item_id_fk;
		$this->size_id = $size_id_fk;
		$this->size_name = $size_name;
		$this->order_qty = $order_qty;
		$this->item_name = $item_name;
		$this->discount_id = $discount_id_fk;
		$this->discount_name = $discount_name;
		$this->discount_price = $discount_price;
		$this->payable_price = $payable_price;
		$this->order_time = $order_time;
		$this->expected_delivery_time = $expected_delivery_time;
		$this->order_status = $order_status;
		return $this;
	}

	public function reset_data(){
		$this->order_id = null;
		$this->item_id = null;
		$this->size_id = null;
		$this->size_name = null;
		$this->order_qty = null;
		$this->item_name = null;
		$this->discount_id = null;
		$this->discount_name = null;
		$this->discount_price = null;
		$this->payable_price = null;
		$this->order_time = null;
		$this->expected_delivery_time = null;
		$this->order_status = null;
	}

	public function set_primary_key($order_id_fk,$item_id_fk,$size_id_fk){
		$this->order_id = order_id;
		$this->item_id = item_id;
		$this->size_id = size_id;
	}

	public function get_primary_key(){

		return array("order_id_fk" => $this->order_id,"item_id_fk" => $this->item_id,"size_id_fk" => $this->size_id);
	}

	public function get_json_view(){
		return array("order_id" => $this->order_id,"item_id" => $this->item_id,"size_id" => $this->size_id,"size_name" => $this->size_name,"order_qty" => $this->order_qty,"item_name" => $this->item_name,"discount_id" => $this->discount_id,"discount_name" => $this->discount_name,"discount_price" => $this->discount_price,"payable_price" => $this->payable_price,"order_time" => $this->order_time,"expected_delivery_time" => $this->expected_delivery_time,"order_status" => $this->order_status);
	}

	public function get_array_add(){
		return array("order_id_fk" => $this->order_id,"item_id_fk" => $this->item_id,"size_id_fk" => $this->size_id,"size_name" => $this->size_name,"order_qty" => $this->order_qty,"item_name" => $this->item_name,"discount_id_fk" => $this->discount_id,"discount_name" => $this->discount_name,"discount_price" => $this->discount_price,"payable_price" => $this->payable_price,"order_time" => $this->order_time,"expected_delivery_time" => $this->expected_delivery_time,"order_status" => $this->order_status);
	}

	public function get_array_update(){
		$update_array = array();

		if($this->order_id!=NULL)
			$update_array['order_id_fk'] = $this->order_id;
		if($this->item_id!=NULL)
			$update_array['item_id_fk'] = $this->item_id;
		if($this->size_id!=NULL)
			$update_array['size_id_fk'] = $this->size_id;
		if($this->size_name!=NULL)
			$update_array['size_name'] = $this->size_name;
		if($this->order_qty!=NULL)
			$update_array['order_qty'] = $this->order_qty;
		if($this->item_name!=NULL)
			$update_array['item_name'] = $this->item_name;
		if($this->discount_id!=NULL)
			$update_array['discount_id_fk'] = $this->discount_id;
		if($this->discount_name!=NULL)
			$update_array['discount_name'] = $this->discount_name;
		if($this->discount_price!=NULL)
			$update_array['discount_price'] = $this->discount_price;
		if($this->payable_price!=NULL)
			$update_array['payable_price'] = $this->payable_price;
		if($this->order_time!=NULL)
			$update_array['order_time'] = $this->order_time;
		if($this->expected_delivery_time!=NULL)
			$update_array['expected_delivery_time'] = $this->expected_delivery_time;
		if($this->order_status!=NULL)
			$update_array['order_status'] = $this->order_status;
		return $update_array;
	}
}
