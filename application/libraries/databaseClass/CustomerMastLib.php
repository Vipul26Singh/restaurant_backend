<?php
class CustomerMastLib{
	private $customer_id;
	private $first_name;
	private $middle_name;
	private $surname;
	private $user_name;
	private $password;
	private $email_id;
	private $mobile_number;
	private $password_modification_date;
	private $default_address_id;
	private $image_url;
	private $resgistration_date;

	public function get_value($name){
		$value = null;
		if($name=='customer_id')
			$value = $this->customer_id;
		if($name=='first_name')
			$value = $this->first_name;
		if($name=='middle_name')
			$value = $this->middle_name;
		if($name=='surname')
			$value = $this->surname;
		if($name=='user_name')
			$value = $this->user_name;
		if($name=='password')
			$value = $this->password;
		if($name=='email_id')
			$value = $this->email_id;
		if($name=='mobile_number')
			$value = $this->mobile_number;
		if($name=='password_modification_date')
			$value = $this->password_modification_date;
		if($name=='default_address_id')
			$value = $this->default_address_id;
		if($name=='image_url')
			$value = $this->image_url;
		if($name=='resgistration_date')
			$value = $this->resgistration_date;
		return $value;
	}

	public function get_array_value($name){
		$value = array();
		if($name=='customer_id')
			$value['customer_id_pk'] =  $this->customer_id;
		if($name=='first_name')
			$value['first_name'] =  $this->first_name;
		if($name=='middle_name')
			$value['middle_name'] =  $this->middle_name;
		if($name=='surname')
			$value['surname'] =  $this->surname;
		if($name=='user_name')
			$value['user_name'] =  $this->user_name;
		if($name=='password')
			$value['password'] =  $this->password;
		if($name=='email_id')
			$value['email_id'] =  $this->email_id;
		if($name=='mobile_number')
			$value['mobile_number_uk'] =  $this->mobile_number;
		if($name=='password_modification_date')
			$value['last_password_modification_date'] =  $this->password_modification_date;
		if($name=='default_address_id')
			$value['default_address_id_fk'] =  $this->default_address_id;
		if($name=='image_url')
			$value['profile_image_url'] =  $this->image_url;
		if($name=='resgistration_date')
			$value['resgistration_date'] =  $this->resgistration_date;

		return $value;
	}

	public function set_value($name, $value){
		if($name=='customer_id')
			$this->customer_id = $value;
		if($name=='first_name')
			$this->first_name = $value;
		if($name=='middle_name')
			$this->middle_name = $value;
		if($name=='surname')
			$this->surname = $value;
		if($name=='user_name')
			$this->user_name = $value;
		if($name=='password')
			$this->password = $value;
		if($name=='email_id')
			$this->email_id = $value;
		if($name=='mobile_number')
			$this->mobile_number = $value;
		if($name=='password_modification_date')
			$this->password_modification_date = $value;
		if($name=='default_address_id')
			$this->default_address_id = $value;
		if($name=='image_url')
			$this->image_url = $value;
		if($name=='resgistration_date')
			$this->resgistration_date = $value;
	}

	public function set_data($customer_id_pk,$first_name,$middle_name,$surname,$user_name,$password,$email_id,$mobile_number_uk,$last_password_modification_date,$default_address_id_fk,$profile_image_url,$resgistration_date){
		$this->customer_id = $customer_id_pk;
		$this->first_name = $first_name;
		$this->middle_name = $middle_name;
		$this->surname = $surname;
		$this->user_name = $user_name;
		$this->password = $password;
		$this->email_id = $email_id;
		$this->mobile_number = $mobile_number_uk;
		$this->password_modification_date = $last_password_modification_date;
		$this->default_address_id = $default_address_id_fk;
		if(isset($profile_image_url) && strlen($profile_image_url) > 3)
			$this->image_url = $profile_image_url;
		$this->resgistration_date = $resgistration_date;
		return $this;
	}

	public function reset_data(){
		$this->customer_id = null;
		$this->first_name = null;
		$this->middle_name = null;
		$this->surname = null;
		$this->user_name = null;
		$this->password = null;
		$this->email_id = null;
		$this->mobile_number = null;
		$this->password_modification_date = null;
		$this->default_address_id = null;
		$this->image_url = null;
		$this->resgistration_date = null;
	}

	public function set_primary_key($customer_id_pk){
		$this->customer_id = customer_id;
	}

	public function get_primary_key(){

		return array("customer_id_pk" => $this->customer_id);
	}

	public function get_json_view(){
		$url = null;
		if(isset($this->image_url)){
			$url = KRAZYTABLE_URL . $this->image_url;	
		}
		return array("customer_id" => $this->customer_id,"first_name" => $this->first_name,"middle_name" => $this->middle_name,"surname" => $this->surname,"user_name" => $this->user_name,"email_id" => $this->email_id,"mobile_number" => $this->mobile_number, "image_url" => $url);
	}

	public function get_array_add(){
		return array("customer_id_pk" => $this->customer_id,"first_name" => $this->first_name,"middle_name" => $this->middle_name,"surname" => $this->surname,"user_name" => $this->user_name,"password" => $this->password,"email_id" => $this->email_id,"mobile_number_uk" => $this->mobile_number,"last_password_modification_date" => $this->password_modification_date,"default_address_id_fk" => $this->default_address_id,"profile_image_url" => $this->image_url,"resgistration_date" => $this->resgistration_date);
	}

	public function get_array_update(){
		$update_array = array();

		if($this->customer_id!=NULL)
			$update_array['customer_id_pk'] = $this->customer_id;
		if($this->first_name!=NULL)
			$update_array['first_name'] = $this->first_name;
		if($this->middle_name!=NULL)
			$update_array['middle_name'] = $this->middle_name;
		if($this->surname!=NULL)
			$update_array['surname'] = $this->surname;
		if($this->user_name!=NULL)
			$update_array['user_name'] = $this->user_name;
		if($this->password!=NULL)
			$update_array['password'] = $this->password;
		if($this->email_id!=NULL)
			$update_array['email_id'] = $this->email_id;
		if($this->mobile_number!=NULL)
			$update_array['mobile_number_uk'] = $this->mobile_number;
		if($this->password_modification_date!=NULL)
			$update_array['last_password_modification_date'] = $this->password_modification_date;
		if($this->default_address_id!=NULL)
			$update_array['default_address_id_fk'] = $this->default_address_id;
		if($this->image_url!=NULL)
			$update_array['profile_image_url'] = $this->image_url;
		if($this->resgistration_date!=NULL)
			$update_array['resgistration_date'] = $this->resgistration_date;
		return $update_array;
	}
}
