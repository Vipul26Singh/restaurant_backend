<?php
class PaymentDetailLib{
	private $payment_id;
	private $invoice_id;
	private $currency_id;
	private $conversion_rate;
	private $payable_amount_local_currency;
	private $payable_amount;
	private $payment_method;
	private $payment_module;
	private $payment_date;
	private $amount_paid;
	private $amount_pending;

	public function get_value($name){
		$value = null;
		if($name=='payment_id')
			$value = $this->payment_id;
		if($name=='invoice_id')
			$value = $this->invoice_id;
		if($name=='currency_id')
			$value = $this->currency_id;
		if($name=='conversion_rate')
			$value = $this->conversion_rate;
		if($name=='payable_amount_local_currency')
			$value = $this->payable_amount_local_currency;
		if($name=='payable_amount')
			$value = $this->payable_amount;
		if($name=='payment_method')
			$value = $this->payment_method;
		if($name=='payment_module')
			$value = $this->payment_module;
		if($name=='payment_date')
			$value = $this->payment_date;
		if($name=='amount_paid')
			$value = $this->amount_paid;
		if($name=='amount_pending')
			$value = $this->amount_pending;
		return $value;
	}

	public function get_array_value($name){
		$value = array();
		if($name=='payment_id')
			$value['payment_id'] =  $this->payment_id;
		if($name=='invoice_id')
			$value['invoice_id_fk'] =  $this->invoice_id;
		if($name=='currency_id')
			$value['currency_id_fk'] =  $this->currency_id;
		if($name=='conversion_rate')
			$value['conversion_rate'] =  $this->conversion_rate;
		if($name=='payable_amount_local_currency')
			$value['payable_amount_local_currency'] =  $this->payable_amount_local_currency;
		if($name=='payable_amount')
			$value['payable_amount'] =  $this->payable_amount;
		if($name=='payment_method')
			$value['payment_method'] =  $this->payment_method;
		if($name=='payment_module')
			$value['payment_module'] =  $this->payment_module;
		if($name=='payment_date')
			$value['payment_date'] =  $this->payment_date;
		if($name=='amount_paid')
			$value['amount_paid'] =  $this->amount_paid;
		if($name=='amount_pending')
			$value['amount_pending'] =  $this->amount_pending;

		return $value;
	}

	public function set_value($name, $value){
		if($name=='payment_id')
			$this->payment_id = $value;
		if($name=='invoice_id')
			$this->invoice_id = $value;
		if($name=='currency_id')
			$this->currency_id = $value;
		if($name=='conversion_rate')
			$this->conversion_rate = $value;
		if($name=='payable_amount_local_currency')
			$this->payable_amount_local_currency = $value;
		if($name=='payable_amount')
			$this->payable_amount = $value;
		if($name=='payment_method')
			$this->payment_method = $value;
		if($name=='payment_module')
			$this->payment_module = $value;
		if($name=='payment_date')
			$this->payment_date = $value;
		if($name=='amount_paid')
			$this->amount_paid = $value;
		if($name=='amount_pending')
			$this->amount_pending = $value;
	}

	public function set_data($payment_id,$invoice_id_fk,$currency_id_fk,$conversion_rate,$payable_amount_local_currency,$payable_amount,$payment_method,$payment_module,$payment_date,$amount_paid,$amount_pending){
		$this->payment_id = $payment_id;
		$this->invoice_id = $invoice_id_fk;
		$this->currency_id = $currency_id_fk;
		$this->conversion_rate = $conversion_rate;
		$this->payable_amount_local_currency = $payable_amount_local_currency;
		$this->payable_amount = $payable_amount;
		$this->payment_method = $payment_method;
		$this->payment_module = $payment_module;
		$this->payment_date = $payment_date;
		$this->amount_paid = $amount_paid;
		$this->amount_pending = $amount_pending;
		return $this;
	}

	public function reset_data(){
		$this->payment_id = null;
		$this->invoice_id = null;
		$this->currency_id = null;
		$this->conversion_rate = null;
		$this->payable_amount_local_currency = null;
		$this->payable_amount = null;
		$this->payment_method = null;
		$this->payment_module = null;
		$this->payment_date = null;
		$this->amount_paid = null;
		$this->amount_pending = null;
	}

	public function set_primary_key($payment_id){
		$this->payment_id = payment_id;
	}

	public function get_primary_key(){

		return array("payment_id" => $this->payment_id);
	}

	public function get_json_view(){
		return array("payment_id" => $this->payment_id,"invoice_id" => $this->invoice_id,"payable_amount" => $this->payable_amount,"payment_method" => $this->payment_method,"payment_date" => $this->payment_date,"amount_paid" => $this->amount_paid,"amount_pending" => $this->amount_pending);
	}

	public function get_array_add(){
		return array("payment_id" => $this->payment_id,"invoice_id_fk" => $this->invoice_id,"currency_id_fk" => $this->currency_id,"conversion_rate" => $this->conversion_rate,"payable_amount_local_currency" => $this->payable_amount_local_currency,"payable_amount" => $this->payable_amount,"payment_method" => $this->payment_method,"payment_module" => $this->payment_module,"payment_date" => $this->payment_date,"amount_paid" => $this->amount_paid,"amount_pending" => $this->amount_pending);
	}

	public function get_array_update(){
		$update_array = array();

		if($this->payment_id!=NULL)
			$update_array['payment_id'] = $this->payment_id;
		if($this->invoice_id!=NULL)
			$update_array['invoice_id_fk'] = $this->invoice_id;
		if($this->currency_id!=NULL)
			$update_array['currency_id_fk'] = $this->currency_id;
		if($this->conversion_rate!=NULL)
			$update_array['conversion_rate'] = $this->conversion_rate;
		if($this->payable_amount_local_currency!=NULL)
			$update_array['payable_amount_local_currency'] = $this->payable_amount_local_currency;
		if($this->payable_amount!=NULL)
			$update_array['payable_amount'] = $this->payable_amount;
		if($this->payment_method!=NULL)
			$update_array['payment_method'] = $this->payment_method;
		if($this->payment_module!=NULL)
			$update_array['payment_module'] = $this->payment_module;
		if($this->payment_date!=NULL)
			$update_array['payment_date'] = $this->payment_date;
		if($this->amount_paid!=NULL)
			$update_array['amount_paid'] = $this->amount_paid;
		if($this->amount_pending!=NULL)
			$update_array['amount_pending'] = $this->amount_pending;
		return $update_array;
	}
}