<?php 
class Admin_customer_management extends CI_Controller { 

	function __construct() {
		parent::__construct();

	}
		
	public function index() {
		show_404();
	} 

	private function get_customer_list($jsonData)
        {
                $result = array();
                $this->load->model('restaurantCustomerDetailModel');
		$this->load->model('customerMastModel');
		$this->load->model('taxDetailModel');
		$this->load->model('discountDetailModel');
		$this->load->model('paymentDetailModel');
		$this->load->model('restaurantRatingDetailModel');
                $this->load->library('databaseClass/restaurantCustomerDetailLib', '', 'restaurantCustomerDetailLib');
		$this->load->library('databaseClass/customerMastLib', '', 'customerMastLib');
		$this->load->library('databaseClass/discountDetailLib', '', 'discountDetailLib');
		$this->load->library('databaseClass/taxDetailLib', '', 'taxDetailLib');
		$this->load->library('databaseClass/paymentDetailLib', '', 'paymentDetailLib');
		$this->load->library('databaseClass/restaurantRatingDetailLib', '', 'restaurantRatingDetailLib');

		$find['restaurant_id'] = $jsonData['restaurant_id'];

                $out_object = $this->restaurantCustomerDetailModel->get_data($find);
		$temp_result = null;

                foreach ($out_object as $row)
                {
			$customer_list = array();
			$this->restaurantCustomerDetailLib->reset_data();
                        
			$this->restaurantCustomerDetailLib->set_data($row['restaurant_id_fk'],$row['customer_id_fk'],$row['total_purchase'],$row['last_visited'],$row['total_visit']);

                        $temp_result = $this->restaurantCustomerDetailLib->get_json_view();

                        $customer_object = $this->customerMastModel->get_data(array('customer_id' => $row['customer_id_fk']));

                        foreach ($customer_object as $customer_row)
                                {
                                        $this->customerMastLib->reset_data();
                                	$this->customerMastLib->set_data($customer_row['order_id'],$_row['item_id_fk'],$detail_row['size_id_fk'],$detail_row['size_name'],$detail_row['order_qty'],$detail_row['item_name'],$detail_row['discount_id_fk'],$detail_row['discount_name'],$detail_row['discount_price'],$detail_row['payable_price'],$detail_row['order_time'],$detail_row['expected_delivery_time'],$detail_row['order_status']);
                                	$customer_list[] =  $this->customerMastLib->get_json_view();

                                }

                        $temp_result[] = $order_list;

			// add rating and order id
		
			$find = null;
			$find['restaurant_id'] = $jsonData['restaurant_id']; 
			$find['customer_id'] = 
			$rating_object = $this->restaurantRatingDetailModel->get_data(array('customer_id' => $row['customer_id_fk']));

                        foreach ($customer_object as $customer_row)
                                {
                                        $this->customerMastLib->reset_data();
                                        $this->customerMastLib->set_data($detail_row['order_id_fk'],$detail_row['item_id_fk'],$detail_row['size_id_fk'],$detail_row['size_name'],$detail_row['order_qty'],$detail_row['item_name'],$detail_row['discount_id_fk'],$detail_row['discount_name'],$detail_row['discount_price'],$detail_row['payable_price'],$detail_row['order_time'],$detail_row['expected_delivery_time'],$detail_row['order_status']);
                                        $customer_list[] =  $this->customerMastLib->get_json_view();

                                }

                        $temp_result[] = $order_list;


			$result[] = $temp_result;
                }

                return $result;
         }

	/********************************************************************************************************
	 *
	 *                           Functionality
	 *
	 *                          Add food item
	 *
	 **********************************************************************************************************/

     public function get_list() {
		$jsonData = json_decode(file_get_contents('php://input'), true);
		$authKey=$jsonData['access_token'];

		if($authKey=='' || $authKey == null || $authKey!=AUTH_KEY){
			$errJson = array("ErrorCode" => EXIT_USER_INPUT, "ErrorMessage" => "The access token provided is invalid");
			echo json_encode($errJson, JSON_PRETTY_PRINT);
			die;
		}          


		if($jsonData['request_type'] == SELECT_DATA){
			$result_list = $this->get_customer_list($jsonData);
                        echo json_encode(array("ErrorCode" => EXIT_SUCCESS, "customer_list" => $result_list), JSON_PRETTY_PRINT);
		}
		else{
			$errJson = array("ErrorCode" => EXIT_USER_INPUT, "ErrorMessage" => "Undefined operation");
			echo json_encode($errJson, JSON_PRETTY_PRINT);
		}
	}

}

