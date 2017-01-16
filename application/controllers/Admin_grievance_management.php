<?php 
class Admin_grievance_management extends CI_Controller { 

	function __construct() {
		parent::__construct();

	}
		
	public function index() {
		show_404();
	} 

	private function select_complaint_list($jsonData)
        {
                $result = array();
                $this->load->model('grievanceModel');
		$this->load->model('grievanceMessageModel');
                $this->load->library('databaseClass/grievanceLib', '', 'grievanceLib');
		$this->load->library('databaseClass/grievanceMessageLib', '', 'grievanceMessageLib');
                $out_object = $this->grievanceModel->get_data(array('restaurant_id' => $jsonData['restaurant_id']));
		$temp_result = null;

                foreach ($out_object as $row)
                {
                                $message_list = array();
                                $this->grievanceLib->reset_data();
                        $this->grievanceLib->set_data($row['customer_id_fk'], $row['first_name'], $row['middle_name'], $row['surname'], $row['profile_image_url'], $row['mobile_number_uk'], $row['email_id'], $row['order_id_fk'], $row['table_no_fk'], $row['complaint_date'], $row['concern'], $row['grievance_id']);

                        $temp_result = $this->grievanceLib->get_json_view();
                        $message_object = $this->grievanceMessageModel->get_data(array('grievance_id' => $row['grievance_id']));

                        foreach ($message_object as $message_row)
                                {
                                        $this->grievanceMessageLib->reset_data();
                                	$this->grievanceMessageLib->set_data($message_row['message_id'], $message_row['grievance_id_fk'], $message_row['sender'], $message_row['sender_id'], $message_row['message'], $message_row['reply_date']);
                                	$message_list[] =  $this->grievanceMessageLib->get_json_view();

                                }

                        $temp_result['message_list'] = $message_list;
                        $result[] = $temp_result;
                }

                return $result;
         }

	private function add_grievance_message($jsonData){
		$this->load->model('grievanceMessageModel');
		$this->load->library('databaseClass/grievanceMessageLib', '', 'grievanceMessageLib');

		$err_count =0;
		$curr_index =0;
		$err_index = null;

		$elem = $jsonData;
		$output_data = array();

		try{
			$this->grievanceMessageLib->reset_data();
			$temp_error_code = EXIT_SUCCESS;
			$temp_error_message = null;

			$this->grievanceMessageLib->set_value('grievance_id', $elem['grievance_id']);
			$this->grievanceMessageLib->set_value('sender', $elem['sender']);
			$this->grievanceMessageLib->set_value('sender_id', $elem['sender_id']);
			$this->grievanceMessageLib->set_value('message', $elem['message']);
			$this->grievanceMessageLib->set_value('msg_date', date('Y-m-d H:i:s'));

			$msg_id = $this->grievanceMessageModel->add_data($this->grievanceMessageLib->get_array_add());

			$this->grievanceMessageLib->set_value('message_id', $msg_id);

			$output_data = array("id"=>$msg_id, "ErrorCode"=>EXIT_SUCCESS, "ErrorMessage"=>null);
		}catch(Exception $e) {
			$output_data = array("id"=>$msg_id, "ErrorCode"=>EXIT_DATABASE, "ErrorMessage"=>"Unable to send message please try later");
		}

		return $output_data;
	}

	/********************************************************************************************************
	 *
	 *                           Functionality
	 *
	 *                          Add food item
	 *
	 **********************************************************************************************************/

     public function customer_complaint() {
		$jsonData = json_decode(file_get_contents('php://input'), true);
		$authKey=$jsonData['access_token'];

		if($authKey=='' || $authKey == null || $authKey!=AUTH_KEY){
			$errJson = array("ErrorCode" => EXIT_USER_INPUT, "ErrorMessage" => "The access token provided is invalid");
			echo json_encode($errJson, JSON_PRETTY_PRINT);
			die;
		}          


		if($jsonData['request_type'] == SELECT_DATA){
			$result_list = $this->select_complaint_list($jsonData);
                        echo json_encode(array("ErrorCode" => EXIT_SUCCESS, "complaint_list" => $result_list), JSON_PRETTY_PRINT);
		}else if($jsonData['request_type'] == INSERT_DATA){
			$result = $this->add_grievance_message($jsonData);
			echo json_encode($result, JSON_PRETTY_PRINT);
		}else{
			$errJson = array("ErrorCode" => EXIT_USER_INPUT, "ErrorMessage" => "Undefined operation");
			echo json_encode($errJson, JSON_PRETTY_PRINT);
		}
	}

}

