<?php
class TaxDetailLib{
	private $invoice_id;
	private $restaurant_id;
	private $tax_id;
	private $tax_name;
	private $tax_amount;
	private $tax_percent;

	public function get_value($name){
		$value = null;
		if($name=='invoice_id')
			$value = $this->invoice_id;
		if($name=='restaurant_id')
			$value = $this->restaurant_id;
		if($name=='tax_id')
			$value = $this->tax_id;
		if($name=='tax_name')
			$value = $this->tax_name;
		if($name=='tax_amount')
			$value = $this->tax_amount;
		if($name=='tax_percent')
			$value = $this->tax_percent;
		return $value;
	}

	public function get_array_value($name){
		$value = array();
		if($name=='invoice_id')
			$value['invoice_id_fk'] =  $this->invoice_id;
		if($name=='restaurant_id')
			$value['restaurant_id_fk'] =  $this->restaurant_id;
		if($name=='tax_id')
			$value['tax_id_fk'] =  $this->tax_id;
		if($name=='tax_name')
			$value['tax_name'] =  $this->tax_name;
		if($name=='tax_amount')
			$value['tax_amount'] =  $this->tax_amount;
		if($name=='tax_percent')
			$value['tax_percent'] =  $this->tax_percent;

		return $value;
	}

	public function set_value($name, $value){
		if($name=='invoice_id')
			$this->invoice_id = $value;
		if($name=='restaurant_id')
			$this->restaurant_id = $value;
		if($name=='tax_id')
			$this->tax_id = $value;
		if($name=='tax_name')
			$this->tax_name = $value;
		if($name=='tax_amount')
			$this->tax_amount = $value;
		if($name=='tax_percent')
			$this->tax_percent = $value;
	}

	public function set_data($invoice_id_fk,$restaurant_id_fk,$tax_id_fk,$tax_name,$tax_amount,$tax_percent){
		$this->invoice_id = $invoice_id_fk;
		$this->restaurant_id = $restaurant_id_fk;
		$this->tax_id = $tax_id_fk;
		$this->tax_name = $tax_name;
		$this->tax_amount = $tax_amount;
		$this->tax_percent = $tax_percent;
		return $this;
	}

	public function reset_data(){
		$this->invoice_id = null;
		$this->restaurant_id = null;
		$this->tax_id = null;
		$this->tax_name = null;
		$this->tax_amount = null;
		$this->tax_percent = null;
	}

	public function set_primary_key($invoice_id_fk,$restaurant_id_fk,$tax_id_fk){
		$this->invoice_id_fk = invoice_id_fk;
		$this->restaurant_id = restaurant_id;
		$this->tax_id = tax_id;
	}

	public function get_primary_key(){

		return array("invoice_id_fk" => $this->invoice_id_fk,"restaurant_id_fk" => $this->restaurant_id,"tax_id_fk" => $this->tax_id);
	}

	public function get_json_view(){
		return array("invoice_id" => $this->invoice_id,"restaurant_id" => $this->restaurant_id,"tax_id" => $this->tax_id,"tax_name" => $this->tax_name,"tax_amount" => $this->tax_amount,"tax_percent" => $this->tax_percent);
	}

	public function get_array_add(){
		return array("invoice_id_fk" => $this->invoice_id,"restaurant_id_fk" => $this->restaurant_id,"tax_id_fk" => $this->tax_id,"tax_name" => $this->tax_name,"tax_amount" => $this->tax_amount,"tax_percent" => $this->tax_percent);
	}

	public function get_array_update(){
		$update_array = array();

		if($this->invoice_id!=NULL)
			$update_array['invoice_id_fk'] = $this->invoice_id;
		if($this->restaurant_id!=NULL)
			$update_array['restaurant_id_fk'] = $this->restaurant_id;
		if($this->tax_id!=NULL)
			$update_array['tax_id_fk'] = $this->tax_id;
		if($this->tax_name!=NULL)
			$update_array['tax_name'] = $this->tax_name;
		if($this->tax_amount!=NULL)
			$update_array['tax_amount'] = $this->tax_amount;
		if($this->tax_percent!=NULL)
			$update_array['tax_percent'] = $this->tax_percent;
		return $update_array;
	}
}