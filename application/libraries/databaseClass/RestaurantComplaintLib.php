<?php
class RestaurantComplaintLib{
	private $complaint_id;
	private $restaurant_id;
	private $complaint_date;
	private $complaint;
	private $attachement;
	private $status;
	private $mobile_no;
	private $email_id;
	private $subject;

	public function get_value($name){
		$value = null;
		if($name=='complaint_id')
			$value = $this->complaint_id;
		if($name=='restaurant_id')
			$value = $this->restaurant_id;
		if($name=='complaint_date')
			$value = $this->complaint_date;
		if($name=='complaint')
			$value = $this->complaint;
		if($name=='attachement')
			$value = $this->attachement;
		if($name=='status')
			$value = $this->status;
		if($name=='mobile_no')
                        $value = $this->mobile_no;
		if($name=='email_id')
                        $value = $this->email_id;
		if($name=='subject')
                        $value = $this->subject;
		return $value;
	}

	public function get_array_value($name){
		$value = array();
		if($name=='complaint_id')
			$value['complaint_id'] =  $this->complaint_id;
		if($name=='restaurant_id')
			$value['restaurant_id_fk'] =  $this->restaurant_id;
		if($name=='complaint_date')
			$value['complaint_date'] =  $this->complaint_date;
		if($name=='complaint')
			$value['complaint'] =  $this->complaint;
		if($name=='attachement')
			$value['attachement_url'] =  $this->attachement;
		if($name=='status')
			$value['status'] =  $this->status;
		if($name=='mobile_no')
                        $value['mobile_no'] =  $this->mobile_no;
		if($name=='email_id')
                        $value['email_id'] =  $this->email_id;
		if($name=='subject')
                        $value['subject'] =  $this->subject;

		return $value;
	}

	public function set_value($name, $value){
		if($name=='complaint_id')
			$this->complaint_id = $value;
		if($name=='restaurant_id')
			$this->restaurant_id = $value;
		if($name=='complaint_date')
			$this->complaint_date = $value;
		if($name=='complaint')
			$this->complaint = $value;
		if($name=='attachement')
			$this->attachement = $value;
		if($name=='status')
			$this->status = $value;
		if($name=='mobile_no')
                        $this->mobile_no = $value;
                if($name=='email_id')
                        $this->email_id = $value;
                if($name=='subject')
                        $this->subject = $value;

	}

	public function set_data($complaint_id,$restaurant_id_fk,$complaint_date,$complaint,$attachement_url,$status,$mobile_no,$email_id,$subject){
		$this->complaint_id = $complaint_id;
		$this->restaurant_id = $restaurant_id_fk;
		$this->complaint_date = $complaint_date;
		$this->complaint = $complaint;
		$this->attachement = $attachement_url;
		$this->status = $status;
		$this->mobile_no = $mobile_no; 
		$this->email_id = $email_id;
		$this->subject = $subject;
		return $this;
	}

	public function reset_data(){
		$this->complaint_id = null;
		$this->restaurant_id = null;
		$this->complaint_date = null;
		$this->complaint = null;
		$this->attachement = null;
		$this->status = null;
		$this->mobile_no = null;
                $this->email_id = null;
                $this->subject = null;
	}

	public function set_primary_key($complaint_id){
		$this->complaint_id = complaint_id;
	}

	public function get_primary_key(){

		return array("complaint_id" => $this->complaint_id);
	}

	public function get_json_view(){
		return array("complaint_id" => $this->complaint_id,"complaint_date" => $this->complaint_date,"complaint" => $this->complaint,"attachement" => $this->attachement,"status" => $this->status , "mobile_no" => $this->mobile_no, "email_id" => $this->email_id, "subject" => $this->subject);
	}

	public function get_array_add(){
		return array("restaurant_id_fk" => $this->restaurant_id,"complaint_date" => $this->complaint_date,"complaint" => $this->complaint,"attachement_url" => $this->attachement,"status" => $this->status, "mobile_no" => $this->mobile_no, "email_id" => $this->email_id, "subject" => $this->subject);
	}

	public function get_array_update(){
		$update_array = array();

		if($this->complaint_id!=NULL)
			$update_array['complaint_id'] = $this->complaint_id;
		if($this->restaurant_id!=NULL)
			$update_array['restaurant_id_fk'] = $this->restaurant_id;
		if($this->complaint_date!=NULL)
			$update_array['complaint_date'] = $this->complaint_date;
		if($this->complaint!=NULL)
			$update_array['complaint'] = $this->complaint;
		if($this->attachement!=NULL)
			$update_array['attachement_url'] = KRAZYTABLE_URL . $this->attachement;
		if($this->status!=NULL)
			$update_array['status'] = $this->status;
		if($this->mobile_no!=NULL)
			$update_array['mobile_no'] = $this->mobile_no;
		if($this->email_id!=NULL)
                        $update_array['email_id'] = $this->email_id;
		if($this->mobile_no!=NULL)
                        $update_array['subject'] = $this->subject;
	
		return $update_array;
	}
}
