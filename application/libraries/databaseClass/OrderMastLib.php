<?php
class OrderMastLib{
	private $order_id;
	private $restaurant_id;
	private $unbilled_amount;
	private $total_item_discount;
	private $unbilled_discounted_amount;
	private $additional_discount;
	private $payable_amount;
	private $total_tax;
	private $billed_amount;
	private $order_date;
	private $delivery_date;
	private $expected_delivery_time;
	private $table_no;
	private $order_type;
	private $order_status;
	private $customer_id;
	private $customer_name;
	private $customer_image_url;
	private $order_modification_time;
	private $customer_mobile;
	private $customer_email_id;
	private $invoice_no;

	public function get_value($name){
		$value = null;
		if($name=='order_id')
			$value = $this->order_id;
		if($name=='restaurant_id')
			$value = $this->restaurant_id;
		if($name=='unbilled_amount')
			$value = $this->unbilled_amount;
		if($name=='total_item_discount')
			$value = $this->total_item_discount;
		if($name=='unbilled_discounted_amount')
			$value = $this->unbilled_discounted_amount;
		if($name=='additional_discount')
			$value = $this->additional_discount;
		if($name=='payable_amount')
			$value = $this->payable_amount;
		if($name=='total_tax')
			$value = $this->total_tax;
		if($name=='billed_amount')
			$value = $this->billed_amount;
		if($name=='order_date')
			$value = $this->order_date;
		if($name=='delivery_date')
			$value = $this->delivery_date;
		if($name=='expected_delivery_time')
			$value = $this->expected_delivery_time;
		if($name=='table_no')
			$value = $this->table_no;
		if($name=='order_type')
			$value = $this->order_type;
		if($name=='order_status')
			$value = $this->order_status;
		if($name=='customer_id')
			$value = $this->customer_id;
		if($name=='customer_name')
			$value = $this->customer_name;
		if($name=='customer_image_url')
			$value = $this->customer_image_url;
		if($name=='order_modification_time')
			$value = $this->order_modification_time;
		if($name=='customer_mobile')
			$value = $this->customer_mobile;
		if($name=='customer_email_id')
			$value = $this->customer_email_id;
		if($name == 'invoice_no')
			$value = $this->invoice_no;
		return $value;
	}

	public function get_array_value($name){
		$value = array();
		if($name=='order_id')
			$value['order_id_pk'] =  $this->order_id;
		if($name=='restaurant_id')
			$value['restaurant_id_fk'] =  $this->restaurant_id;
		if($name=='unbilled_amount')
			$value['unbilled_amount'] =  $this->unbilled_amount;
		if($name=='total_item_discount')
			$value['total_item_discount'] =  $this->total_item_discount;
		if($name=='unbilled_discounted_amount')
			$value['unbilled_discounted_amount'] =  $this->unbilled_discounted_amount;
		if($name=='additional_discount')
			$value['additional_discount'] =  $this->additional_discount;
		if($name=='payable_amount')
			$value['payable_amount'] =  $this->payable_amount;
		if($name=='total_tax')
			$value['total_tax'] =  $this->total_tax;
		if($name=='billed_amount')
			$value['billed_amount'] =  $this->billed_amount;
		if($name=='order_date')
			$value['order_date'] =  $this->order_date;
		if($name=='delivery_date')
			$value['delivery_date'] =  $this->delivery_date;
		if($name=='expected_delivery_time')
			$value['expected_delivery_time'] =  $this->expected_delivery_time;
		if($name=='table_no')
			$value['table_no_fk'] =  $this->table_no;
		if($name=='order_type')
			$value['order_type'] =  $this->order_type;
		if($name=='order_status')
			$value['order_status'] =  $this->order_status;
		if($name=='customer_id')
			$value['customer_id_fk'] =  $this->customer_id;
		if($name=='customer_name')
			$value['customer_name'] =  $this->customer_name;
		if($name=='customer_image_url')
			$value['customer_image_url'] =  $this->customer_image_url;
		if($name=='order_modification_time')
			$value['order_modification_time'] =  $this->order_modification_time;
		if($name=='customer_mobile')
			$value['customer_mobile_fk'] =  $this->customer_mobile;
		if($name=='customer_email_id')
			$value['customer_email_id_fk'] =  $this->customer_email_id;
		if($name=='invoice_no')
			$value['invoice_no_fk'] = $this->invoice_no;
		

		return $value;
	}

	public function set_value($name, $value){
		if($name=='order_id')
			$this->order_id = $value;
		if($name=='restaurant_id')
			$this->restaurant_id = $value;
		if($name=='unbilled_amount')
			$this->unbilled_amount = $value;
		if($name=='total_item_discount')
			$this->total_item_discount = $value;
		if($name=='unbilled_discounted_amount')
			$this->unbilled_discounted_amount = $value;
		if($name=='additional_discount')
			$this->additional_discount = $value;
		if($name=='payable_amount')
			$this->payable_amount = $value;
		if($name=='total_tax')
			$this->total_tax = $value;
		if($name=='billed_amount')
			$this->billed_amount = $value;
		if($name=='order_date')
			$this->order_date = $value;
		if($name=='delivery_date')
			$this->delivery_date = $value;
		if($name=='expected_delivery_time')
			$this->expected_delivery_time = $value;
		if($name=='table_no')
			$this->table_no = $value;
		if($name=='order_type')
			$this->order_type = $value;
		if($name=='order_status')
			$this->order_status = $value;
		if($name=='customer_id')
			$this->customer_id = $value;
		if($name=='customer_name')
			$this->customer_name = $value;
		if($name=='customer_image_url')
			$this->customer_image_url = $value;
		if($name=='order_modification_time')
			$this->order_modification_time = $value;
		if($name=='customer_mobile')
			$this->customer_mobile = $value;
		if($name=='customer_email_id')
			$this->customer_email_id = $value;
		if($name=='invoice_no')
			$this->invoice_no = $value;
	}

	public function set_data($order_id_pk,$restaurant_id_fk,$unbilled_amount,$total_item_discount,$unbilled_discounted_amount,$additional_discount,$payable_amount,$total_tax,$billed_amount,$order_date,$delivery_date,$expected_delivery_time,$table_no_fk,$order_type,$order_status,$customer_id_fk,$customer_name,$customer_image_url,$order_modification_time,$customer_mobile_fk,$customer_email_id_fk,$invoice_no_fk){
		$this->order_id = $order_id_pk;
		$this->restaurant_id = $restaurant_id_fk;
		$this->unbilled_amount = $unbilled_amount;
		$this->total_item_discount = $total_item_discount;
		$this->unbilled_discounted_amount = $unbilled_discounted_amount;
		$this->additional_discount = $additional_discount;
		$this->payable_amount = $payable_amount;
		$this->total_tax = $total_tax;
		$this->billed_amount = $billed_amount;
		$this->order_date = $order_date;
		$this->delivery_date = $delivery_date;
		$this->expected_delivery_time = $expected_delivery_time;
		$this->table_no = $table_no_fk;
		$this->order_type = $order_type;
		$this->order_status = $order_status;
		$this->customer_id = $customer_id_fk;
		$this->customer_name = $customer_name;
		$this->customer_image_url = $customer_image_url;
		$this->order_modification_time = $order_modification_time;
		$this->customer_mobile = $customer_mobile_fk;
		$this->customer_email_id = $customer_email_id_fk;
		$this->invoice_no = $invoice_no_fk;
		return $this;
	}

	public function reset_data(){
		$this->order_id = null;
		$this->restaurant_id = null;
		$this->unbilled_amount = null;
		$this->total_item_discount = null;
		$this->unbilled_discounted_amount = null;
		$this->additional_discount = null;
		$this->payable_amount = null;
		$this->total_tax = null;
		$this->billed_amount = null;
		$this->order_date = null;
		$this->delivery_date = null;
		$this->expected_delivery_time = null;
		$this->table_no = null;
		$this->order_type = null;
		$this->order_status = null;
		$this->customer_id = null;
		$this->customer_name = null;
		$this->customer_image_url = null;
		$this->order_modification_time = null;
		$this->customer_mobile = null;
		$this->customer_email_id = null;
		$this->invoice_no = null;
	}

	public function set_primary_key($order_id_pk){
		$this->order_id = order_id;
	}

	public function get_primary_key(){

		return array("order_id_pk" => $this->order_id);
	}

	public function get_json_view(){
		return array("order_id" => $this->order_id,"restaurant_id" => $this->restaurant_id,"payable_amount" => $this->payable_amount,"billed_amount" => $this->billed_amount,"order_date" => $this->order_date,"expected_delivery_time" => $this->expected_delivery_time,"table_no" => $this->table_no,"order_status" => $this->order_status,"customer_id" => $this->customer_id,"customer_name" => $this->customer_name,"customer_image_url" => KRAZYTABLE_URL . $this->customer_image_url,"order_modification_time" => $this->order_modification_time,"customer_mobile" => $this->customer_mobile,"customer_email_id" => $this->customer_email_id, "invoice_no" => $this->invoice_no);
	}

	public function get_array_add(){
		return array("order_id_pk" => $this->order_id,"restaurant_id_fk" => $this->restaurant_id,"unbilled_amount" => $this->unbilled_amount,"total_item_discount" => $this->total_item_discount,"unbilled_discounted_amount" => $this->unbilled_discounted_amount,"additional_discount" => $this->additional_discount,"payable_amount" => $this->payable_amount,"total_tax" => $this->total_tax,"billed_amount" => $this->billed_amount,"order_date" => $this->order_date,"delivery_date" => $this->delivery_date,"expected_delivery_time" => $this->expected_delivery_time,"table_no_fk" => $this->table_no,"order_type" => $this->order_type,"order_status" => $this->order_status,"customer_id_fk" => $this->customer_id,"customer_name" => $this->customer_name,"customer_image_url" => $this->customer_image_url,"order_modification_time" => $this->order_modification_time,"customer_mobile_fk" => $this->customer_mobile,"customer_email_id_fk" => $this->customer_email_id, "invoice_no_fk" => $this->invoice_no);
	}

	public function get_array_update(){
		$update_array = array();

		if($this->order_id!=NULL)
			$update_array['order_id_pk'] = $this->order_id;
		if($this->restaurant_id!=NULL)
			$update_array['restaurant_id_fk'] = $this->restaurant_id;
		if($this->unbilled_amount!=NULL)
			$update_array['unbilled_amount'] = $this->unbilled_amount;
		if($this->total_item_discount!=NULL)
			$update_array['total_item_discount'] = $this->total_item_discount;
		if($this->unbilled_discounted_amount!=NULL)
			$update_array['unbilled_discounted_amount'] = $this->unbilled_discounted_amount;
		if($this->additional_discount!=NULL)
			$update_array['additional_discount'] = $this->additional_discount;
		if($this->payable_amount!=NULL)
			$update_array['payable_amount'] = $this->payable_amount;
		if($this->total_tax!=NULL)
			$update_array['total_tax'] = $this->total_tax;
		if($this->billed_amount!=NULL)
			$update_array['billed_amount'] = $this->billed_amount;
		if($this->order_date!=NULL)
			$update_array['order_date'] = $this->order_date;
		if($this->delivery_date!=NULL)
			$update_array['delivery_date'] = $this->delivery_date;
		if($this->expected_delivery_time!=NULL)
			$update_array['expected_delivery_time'] = $this->expected_delivery_time;
		if($this->table_no!=NULL)
			$update_array['table_no_fk'] = $this->table_no;
		if($this->order_type!=NULL)
			$update_array['order_type'] = $this->order_type;
		if($this->order_status!=NULL)
			$update_array['order_status'] = $this->order_status;
		if($this->customer_id!=NULL)
			$update_array['customer_id_fk'] = $this->customer_id;
		if($this->customer_name!=NULL)
			$update_array['customer_name'] = $this->customer_name;
		if($this->customer_image_url!=NULL)
			$update_array['customer_image_url'] = $this->customer_image_url;
		if($this->order_modification_time!=NULL)
			$update_array['order_modification_time'] = $this->order_modification_time;
		if($this->customer_mobile!=NULL)
			$update_array['customer_mobile_fk'] = $this->customer_mobile;
		if($this->customer_email_id!=NULL)
			$update_array['customer_email_id_fk'] = $this->customer_email_id;
		if($this->invoice_no!=NULL)
			$update_array['invoice_no_fk'] = $this->invoice_no;
		return $update_array;
	}
}
