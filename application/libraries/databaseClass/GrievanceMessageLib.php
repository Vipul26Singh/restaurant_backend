<?php
class GrievanceMessageLib{
	private $message_id;
	private $grievance_id;
	private $sender;
	private $sender_id;
	private $message;
	private $msg_date;

	public function get_value($name){
		$value = null;
		if($name=='message_id')
			$value = $this->message_id;
		if($name=='grievance_id')
			$value = $this->grievance_id;
		if($name=='sender')
			$value = $this->sender;
		if($name=='sender_id')
			$value = $this->sender_id;
		if($name=='message')
			$value = $this->message;
		if($name=='msg_date')
			$value = $this->msg_date;
		return $value;
	}

	public function get_array_value($name){
		$value = array();
		if($name=='message_id')
			$value['message_id'] =  $this->message_id;
		if($name=='grievance_id')
			$value['grievance_id_fk'] =  $this->grievance_id;
		if($name=='sender')
			$value['sender'] =  $this->sender;
		if($name=='sender_id')
			$value['sender_id'] =  $this->sender_id;
		if($name=='message')
			$value['message'] =  $this->message;
		if($name=='msg_date')
			$value['reply_date'] =  $this->msg_date;

		return $value;
	}

	public function set_value($name, $value){
		if($name=='message_id')
			$this->message_id = $value;
		if($name=='grievance_id')
			$this->grievance_id = $value;
		if($name=='sender')
			$this->sender = $value;
		if($name=='sender_id')
			$this->sender_id = $value;
		if($name=='message')
			$this->message = $value;
		if($name=='msg_date')
			$this->msg_date = $value;
	}

	public function set_data($message_id,$grievance_id_fk,$sender,$sender_id,$message,$reply_date){
		$this->message_id = $message_id;
		$this->grievance_id = $grievance_id_fk;
		$this->sender = $sender;
		$this->sender_id = $sender_id;
		$this->message = $message;
		$this->msg_date = $reply_date;
		return $this;
	}

	public function reset_data(){
		$this->message_id = null;
		$this->grievance_id = null;
		$this->sender = null;
		$this->sender_id = null;
		$this->message = null;
		$this->msg_date = null;
	}

	public function set_primary_key($message_id){
		$this->message_id = message_id;
	}

	public function get_primary_key(){

		return array("message_id" => $this->message_id);
	}

	public function get_json_view(){
		return array("sender" => $this->sender,"sender_id" => $this->sender_id,"message" => $this->message,"msg_date" => $this->msg_date);
	}

	public function get_array_add(){
		return array("grievance_id_fk" => $this->grievance_id,"sender" => $this->sender,"sender_id" => $this->sender_id,"message" => $this->message,"reply_date" => $this->msg_date);
	}

	public function get_array_update(){
		$update_array = array();

		if($this->message_id!=NULL)
			$update_array['message_id'] = $this->message_id;
		if($this->grievance_id!=NULL)
			$update_array['grievance_id_fk'] = $this->grievance_id;
		if($this->sender!=NULL)
			$update_array['sender'] = $this->sender;
		if($this->sender_id!=NULL)
			$update_array['sender_id'] = $this->sender_id;
		if($this->message!=NULL)
			$update_array['message'] = $this->message;
		if($this->msg_date!=NULL)
			$update_array['reply_date'] = $this->msg_date;
		return $update_array;
	}
}
