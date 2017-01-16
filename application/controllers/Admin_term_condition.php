<?php 
class Admin_term_condition extends CI_Controller { 

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





     public function get() {
		$jsonData = json_decode(file_get_contents('php://input'), true);
		$authKey=$jsonData['access_token'];

		if($authKey=='' || $authKey == null || $authKey!=AUTH_KEY){
			$errJson = array("ErrorCode" => EXIT_USER_INPUT, "ErrorMessage" => "The access token provided is invalid");
			echo json_encode($errJson, JSON_PRETTY_PRINT);
			die;
		}          


		$json_data = htmlentities(file_get_contents(CACHE_PATH . "/" . TERM_AND_CONDITION_FILE));	
		echo $json_data;
	}

}

