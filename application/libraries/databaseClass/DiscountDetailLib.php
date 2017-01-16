<?php
class DiscountDetailLib{
	private $disount_id;
	private $invoice_id;
	private $restaurant_id;
	private $discount_name;
	private $discount_amount;
	private $vendor_note;

	public function get_value($name){
		$value = null;
		if($name=='disount_id')
			$value = $this->disount_id;
		if($name=='invoice_id')
			$value = $this->invoice_id;
		if($name=='restaurant_id')
			$value = $this->restaurant_id;
		if($name=='discount_name')
			$value = $this->discount_name;
		if($name=='discount_amount')
			$value = $this->discount_amount;
		if($name=='vendor_note')
			$value = $this->vendor_note;
		return $value;
	}

	public function get_array_value($name){
		$value = array();
		if($name=='disount_id')
			$value['disount_id_fk'] =  $this->disount_id;
		if($name=='invoice_id')
			$value['invoice_id_fk'] =  $this->invoice_id;
		if($name=='restaurant_id')
			$value['restaurant_id_fk'] =  $this->restaurant_id;
		if($name=='discount_name')
			$value['discount_name'] =  $this->discount_name;
		if($name=='discount_amount')
			$value['discount_amount'] =  $this->discount_amount;
		if($name=='vendor_note')
			$value['vendor_note'] =  $this->vendor_note;

		return $value;
	}

	public function set_value($name, $value){
		if($name=='disount_id')
			$this->disount_id = $value;
		if($name=='invoice_id')
			$this->invoice_id = $value;
		if($name=='restaurant_id')
			$this->restaurant_id = $value;
		if($name=='discount_name')
			$this->discount_name = $value;
		if($name=='discount_amount')
			$this->discount_amount = $value;
		if($name=='vendor_note')
			$this->vendor_note = $value;
	}

	public function set_data($disount_id_fk,$invoice_id_fk,$restaurant_id_fk,$discount_name,$discount_amount,$vendor_note){
		$this->disount_id = $disount_id_fk;
		$this->invoice_id = $invoice_id_fk;
		$this->restaurant_id = $restaurant_id_fk;
		$this->discount_name = $discount_name;
		$this->discount_amount = $discount_amount;
		$this->vendor_note = $vendor_note;
		return $this;
	}

	public function reset_data(){
		$this->disount_id = null;
		$this->invoice_id = null;
		$this->restaurant_id = null;
		$this->discount_name = null;
		$this->discount_amount = null;
		$this->vendor_note = null;
	}

	public function set_primary_key($disount_id_fk,$invoice_id_fk,$restaurant_id_fk){
		$this->disount_id_fk = disount_id_fk;
		$this->invoice_id = invoice_id;
		$this->restaurant_id = restaurant_id;
	}

	public function get_primary_key(){

		return array("disount_id_fk" => $this->disount_id_fk,"invoice_id_fk" => $this->invoice_id,"restaurant_id_fk" => $this->restaurant_id);
	}

	public function get_json_view(){
		return array("disount_id" => $this->disount_id,"invoice_id" => $this->invoice_id,"restaurant_id" => $this->restaurant_id,"discount_name" => $this->discount_name,"discount_amount" => $this->discount_amount,"vendor_note" => $this->vendor_note);
	}

	public function get_array_add(){
		return array("disount_id_fk" => $this->disount_id,"invoice_id_fk" => $this->invoice_id,"restaurant_id_fk" => $this->restaurant_id,"discount_name" => $this->discount_name,"discount_amount" => $this->discount_amount,"vendor_note" => $this->vendor_note);
	}

	public function get_array_update(){
		$update_array = array();

		if($this->disount_id!=NULL)
			$update_array['disount_id_fk'] = $this->disount_id;
		if($this->invoice_id!=NULL)
			$update_array['invoice_id_fk'] = $this->invoice_id;
		if($this->restaurant_id!=NULL)
			$update_array['restaurant_id_fk'] = $this->restaurant_id;
		if($this->discount_name!=NULL)
			$update_array['discount_name'] = $this->discount_name;
		if($this->discount_amount!=NULL)
			$update_array['discount_amount'] = $this->discount_amount;
		if($this->vendor_note!=NULL)
			$update_array['vendor_note'] = $this->vendor_note;
		return $update_array;
	}
}