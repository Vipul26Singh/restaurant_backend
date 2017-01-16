<?php 
class Admin_promotion_management extends CI_Controller { 

	function __construct() {
		parent::__construct();

	}



		
	public function index() {
		//show_404();
		echo "Hello";
	} 



	/********************************************************************************************************
	 *
	 *                           Functionality
	 *
	 *                          Add food item
	 *
	 **********************************************************************************************************/

	 private function select_promotion($jsonData){
	 	$result = array();
	 	$this->load->model('promotionModel');
	 	$this->load->model('packageModel');
	 	$this->load->library('databaseClass/packageLib', '', 'packageLib');
	 	$this->load->library('databaseClass/promotionLib', '', 'promotionLib');

	 	$out_object = $this->promotionModel->get_data($jsonData);

	 	foreach ($out_object as $row)
		{
				$promotion_list = array();
				$package_list = array();
				$this->promotionLib->reset_data();

		        $this->promotionLib->set_value('id', $row['promotion_id']);
		        $this->promotionLib->set_value('name', $row['promotion_name']);
		        $this->promotionLib->set_value('description', $row['promotion_description']);

		        $temp_result = $this->promotionLib->get_json_view();

		        $package_object = $this->packageModel->get_data(array('promotion_id_fk' => $row['promotion_id']));


		        foreach ($package_object as $package_row)
				{
					$this->packageLib->reset_data();
					$this->packageLib->set_value('package_id', $package_row['package_id']);
					$this->packageLib->set_value('name', $package_row['package_name']);
					$this->packageLib->set_value('description', $package_row['package_description']);
					$this->packageLib->set_value('duration', $package_row['package_duration']);
					$this->packageLib->set_value('promotion_id', $package_row['promotion_id_fk']);
					$this->packageLib->set_value('cost', $package_row['package_cost']);

		        	$package_list[] =  $this->packageLib->get_json_view();


				}

		        $temp_result['package_list'] = $package_list;
		        $result[] = $temp_result;
		}

		return $result;
	 } 


	 private function add_restaurant_promotion($jsonData){
	 	$this->load->model('restaurantPackageModel');
	 	$this->load->library('databaseClass/restaurantPackageLib', '', 'restaurantPackageLib');

		$this->load->helper('url');
		$this->load->library('uniqueIdGenerator', '', 'uniqueIdGenerator');

		$err_count =0;
		$curr_index =0;
		$err_index = null;

		$elem = $jsonData;
		$output_data = array();

		try{
			$this->restaurantPackageLib->reset_data();
			$temp_error_code = EXIT_SUCCESS;
			$temp_error_message = null;

			$request_id = $this->uniqueIdGenerator->getPrefixedUniqueId('PRMTN' . substr($elem['restaurant_id'], 0, 5) .  substr($elem['promotion_id'], 0, 5) . substr($elem['package_id'], 0, 5));


			$this->restaurantPackageLib->set_value('restaurant_id', $elem['restaurant_id']);
			//$this->restaurantPackageLib->set_value('request_id', $request_id);
			$this->restaurantPackageLib->set_value('package_id', $elem['package_id']);
			$this->restaurantPackageLib->set_value('promotion_id', $elem['promotion_id']);
			$this->restaurantPackageLib->set_value('description', $elem['description']);
			$this->restaurantPackageLib->set_value('start_date', $elem['start_date']);
			$this->restaurantPackageLib->set_value('end_date', $elem['end_date']);

			$this->restaurantPackageModel->add_data($this->restaurantPackageLib->get_array_add());
			

			$output_data = array("id"=>$request_id, "ErrorCode"=>EXIT_SUCCESS, "ErrorMessage"=>null);
		}catch(Exception $e) {
			echo $e->getMessage();
			$output_data = array("id"=>$request_id, "ErrorCode"=>EXIT_DATABASE, "ErrorMessage"=>"We are unable to process your request. Please contact the team");
		}   
		   
		return $output_data;
	}



     public function promotion() {
		$jsonData = json_decode(file_get_contents('php://input'), true);
		$authKey=$jsonData['access_token'];

		if($authKey=='' || $authKey == null || $authKey!=AUTH_KEY){
			$errJson = array("ErrorCode" => EXIT_USER_INPUT, "ErrorMessage" => "The access token provided is invalid");
			echo json_encode($errJson, JSON_PRETTY_PRINT);
			die;
		}          


		if($jsonData['request_type'] == SELECT_DATA){
			$result_size = $this->select_promotion($jsonData);
			echo json_encode(array("ErrorCode" => EXIT_SUCCESS, "promotion_list" => $result_size), JSON_PRETTY_PRINT);
		}else if($jsonData['request_type'] == INSERT_DATA){
			$result = $this->add_restaurant_promotion($jsonData);
			echo json_encode($result, JSON_PRETTY_PRINT);
		}else{
			$errJson = array("ErrorCode" => EXIT_USER_INPUT, "ErrorMessage" => "Undefined operation");
			echo json_encode($errJson, JSON_PRETTY_PRINT);
		}
	}

}

