<?php 
class Admin_complaint_management extends CI_Controller { 

	function __construct() {
		parent::__construct();

	}
		
	public function index() {
		show_404();
	} 

	private function select_complaint_list($jsonData)
        {
                $result = array();
		$this->load->model('restaurantComplaintModel');
		$this->load->library('databaseClass/restaurantComplaintLib', '', 'restaurantComplaintLib');
                $out_object = $this->restaurantComplaintModel->get_data(array('restaurant_id' => $jsonData['restaurant_id']));
		$temp_result = null;

                foreach ($out_object as $row)
                {
                        $this->restaurantComplaintLib->reset_data();
                        $this->restaurantComplaintLib->set_data($row['complaint_id',$row['restaurant_id_fk'],$row['complaint_date'],$row['complaint'],$row['attachement_url'],$row['status'], $row['mobile_no'], $row['email_id'], $row['subject']);
                        $result[] = $this->restaurantComplaintLib->get_json_view();

                }

                return $result;
         }

	private function add_complaint($jsonData){
		$this->load->model('restaurantComplaintModel');
                $this->load->library('databaseClass/restaurantComplaintLib', '', 'restaurantComplaintLib');


		$elem = $jsonData;
		$output_data = array();

		try{
			$this->restaurantComplaintLib->reset_data();

			$this->restaurantComplaintLib->set_value('complaint_date', date('Y-m-d H:i:s'));
			$this->restaurantComplaintLib->set_value('restaurant_id', $jsonData['restaurant_id']);
			$this->restaurantComplaintLib->set_value('complaint', $jsonData['complaint']);
			$this->restaurantComplaintLib->set_value('mobile_no', $jsonData['mobile_no']);
			$this->restaurantComplaintLib->set_value('email_id', $jsonData['email_id']);
			$this->restaurantComplaintLib->set_value('subject', $jsonData['subject']);

			$cmp_id = $this->restaurantComplaintModel->add_data($this->restaurantComplaintLib->get_array_add());

			$this->restaurantComplaintLib->set_value('complaint_id', $cmp_id);

			$output_data[] = array("id"=>$cmp_id, "ErrorCode"=>EXIT_SUCCESS, "ErrorMessage"=>null);
		}catch(Exception $e) {
			$output_data[] = array("id"=>$cmp_id, "ErrorCode"=>EXIT_DATABASE, "ErrorMessage"=>"Unable to send complaint");
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
		}else if($jsonData['request_type'] == ADD_DATA){
			$result = $this->add_complaint($jsonData);
			echo json_encode($result, JSON_PRETTY_PRINT);
		}else{
			$errJson = array("ErrorCode" => EXIT_USER_INPUT, "ErrorMessage" => "Undefined operation");
			echo json_encode($errJson, JSON_PRETTY_PRINT);
		}
	}

}

