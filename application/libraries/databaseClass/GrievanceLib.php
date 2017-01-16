<?php
class GrievanceLib{
	private $customer_id;
	private $first_name;
	private $middle_name;
	private $surname;
	private $image_url;
	private $mobile;
	private $email;
	private $order_id;
	private $table_no;
	private $complaint_date;
	private $concern;
	private $grievance_id;

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
		if($name=='image_url')
			$value = $this->image_url;
		if($name=='mobile')
			$value = $this->mobile;
		if($name=='email')
			$value = $this->email;
		if($name=='order_id')
			$value = $this->order_id;
		if($name=='table_no')
			$value = $this->table_no;
		if($name=='complaint_date')
			$value = $this->complaint_date;
		if($name=='concern')
			$value = $this->concern;
		if($name=='grievance_id')
			$value = $this->grievance_id;
		return $value;
	}

	public function get_array_value($name){
		$value = array();
		if($name=='customer_id')
			$value['customer_id_fk'] =  $this->customer_id;
		if($name=='first_name')
			$value['first_name'] =  $this->first_name;
		if($name=='middle_name')
			$value['middle_name'] =  $this->middle_name;
		if($name=='surname')
			$value['surname'] =  $this->surname;
		if($name=='image_url')
			$value['profile_image_url'] =  $this->image_url;
		if($name=='mobile')
			$value['mobile_number_uk'] =  $this->mobile;
		if($name=='email')
			$value['email_id'] =  $this->email;
		if($name=='order_id')
			$value['order_id_fk'] =  $this->order_id;
		if($name=='table_no')
			$value['table_no_fk'] =  $this->table_no;
		if($name=='complaint_date')
			$value['complaint_date'] =  $this->complaint_date;
		if($name=='concern')
			$value['concern'] =  $this->concern;
		if($name=='grievance_id')
			$value['grievance_id'] =  $this->grievance_id;

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
		if($name=='image_url')
			$this->image_url = $value;
		if($name=='mobile')
			$this->mobile = $value;
		if($name=='email')
			$this->email = $value;
		if($name=='order_id')
			$this->order_id = $value;
		if($name=='table_no')
			$this->table_no = $value;
		if($name=='complaint_date')
			$this->complaint_date = $value;
		if($name=='concern')
			$this->concern = $value;
		if($name=='grievance_id')
			$this->grievance_id = $value;
	}

	public function set_data($customer_id_fk,$first_name,$middle_name,$surname,$profile_image_url,$mobile_number_uk,$email_id,$order_id_fk,$table_no_fk,$complaint_date,$concern,$grievance_id){
		$this->customer_id = $customer_id_fk;
		$this->first_name = $first_name;
		$this->middle_name = $middle_name;
		$this->surname = $surname;
		$this->image_url = $profile_image_url;
		$this->mobile = $mobile_number_uk;
		$this->email = $email_id;
		$this->order_id = $order_id_fk;
		$this->table_no = $table_no_fk;
		$this->complaint_date = $complaint_date;
		$this->concern = $concern;
		$this->grievance_id = $grievance_id;
		return $this;
	}

	public function reset_data(){
		$this->customer_id = null;
		$this->first_name = null;
		$this->middle_name = null;
		$this->surname = null;
		$this->image_url = null;
		$this->mobile = null;
		$this->email = null;
		$this->order_id = null;
		$this->table_no = null;
		$this->complaint_date = null;
		$this->concern = null;
		$this->grievance_id = null;
	}

	public function set_primary_key($grievance_id){
		$this->grievance_id = grievance_id;
	}

	public function get_primary_key(){

		return array("grievance_id" => $this->grievance_id);
	}

	public function get_json_view(){
		return array("customer_id" => $this->customer_id,"first_name" => $this->first_name,"middle_name" => $this->middle_name,"surname" => $this->surname,"image_url" => $this->image_url,"mobile" => $this->mobile,"email" => $this->email,"order_id" => $this->order_id,"table_no" => $this->table_no,"complaint_date" => $this->complaint_date,"concern" => $this->concern,"grievance_id" => $this->grievance_id);
	}

	public function get_array_add(){
		return array("customer_id_fk" => $this->customer_id,"first_name" => $this->first_name,"middle_name" => $this->middle_name,"surname" => $this->surname,"profile_image_url" => $this->image_url,"mobile_number_uk" => $this->mobile,"email_id" => $this->email,"order_id_fk" => $this->order_id,"table_no_fk" => $this->table_no,"complaint_date" => $this->complaint_date,"concern" => $this->concern,"grievance_id" => $this->grievance_id);
	}

	public function get_array_update(){
		$update_array = array();

		if($this->customer_id!=NULL)
			$update_array['customer_id_fk'] = $this->customer_id;
		if($this->first_name!=NULL)
			$update_array['first_name'] = $this->first_name;
		if($this->middle_name!=NULL)
			$update_array['middle_name'] = $this->middle_name;
		if($this->surname!=NULL)
			$update_array['surname'] = $this->surname;
		if($this->image_url!=NULL)
			$update_array['profile_image_url'] = $this->image_url;
		if($this->mobile!=NULL)
			$update_array['mobile_number_uk'] = $this->mobile;
		if($this->email!=NULL)
			$update_array['email_id'] = $this->email;
		if($this->order_id!=NULL)
			$update_array['order_id_fk'] = $this->order_id;
		if($this->table_no!=NULL)
			$update_array['table_no_fk'] = $this->table_no;
		if($this->complaint_date!=NULL)
			$update_array['complaint_date'] = $this->complaint_date;
		if($this->concern!=NULL)
			$update_array['concern'] = $this->concern;
		if($this->grievance_id!=NULL)
			$update_array['grievance_id'] = $this->grievance_id;
		return $update_array;
	}
}
