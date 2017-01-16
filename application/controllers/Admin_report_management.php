<?php 
class Admin_report_management extends CI_Controller { 

	function __construct() {
		parent::__construct();

	}



		
	public function index() {
		show_404();
	} 



	/********************************************************************************************************
	 *
	 *                           Functionality
	 *
	 *                          Add food item
	 *
	 **********************************************************************************************************/





     public function report_detail() {
		$jsonData = json_decode(file_get_contents('php://input'), true);
		$authKey=$jsonData['access_token'];

		if($authKey=='' || $authKey == null || $authKey!=AUTH_KEY){
			$errJson = array("ErrorCode" => EXIT_USER_INPUT, "ErrorMessage" => "The access token provided is invalid");
			echo json_encode($errJson, JSON_PRETTY_PRINT);
			die;
		}          


		if($jsonData['request_type'] == SELECT_DATA){
			$json_data = file_get_contents(CACHE_PATH . "/" . $jsonData['restaurant_id'] . "/" . REPORT_JSON_FILE);	
			echo $json_data;
		}else if($jsonData['request_type'] == GENERATE_REPORT){
			$result = $this->add_restaurant_promotion($jsonData);
			echo json_encode($result, JSON_PRETTY_PRINT);
		}else{
			$errJson = array("ErrorCode" => EXIT_USER_INPUT, "ErrorMessage" => "Undefined operation");
			echo json_encode($errJson, JSON_PRETTY_PRINT);
		}
	}

}

