<?php 
class Admin_order_management extends CI_Controller { 

	function __construct() {
		parent::__construct();

	}
		
	public function index() {
		show_404();
	} 

	private function get_order_list($jsonData)
        {
                $result = array();
                $this->load->model('orderMastModel');
		$this->load->model('orderDetailModel');
		$this->load->model('taxDetailModel');
		$this->load->model('discountDetailModel');
		$this->load->model('paymentDetailModel');
                $this->load->library('databaseClass/orderMastLib', '', 'orderMastLib');
		$this->load->library('databaseClass/orderDetailLib', '', 'orderDetailLib');
		$this->load->library('databaseClass/discountDetailLib', '', 'discountDetailLib');
		$this->load->library('databaseClass/taxDetailLib', '', 'taxDetailLib');
		$this->load->library('databaseClass/paymentDetailLib', '', 'paymentDetailLib');

		$find['restaurant_id'] = $jsonData['restaurant_id'];
		$find['order_modification_time'] = "curdate()";

		if(isset($jsonData['customer_id'])){
			$find['customer_id'] = $jsonData['customer_id'];
		}

                $out_object = $this->orderMastModel->get_data($find);
		$temp_result = null;

                foreach ($out_object as $row)
                {
			$order_list = array();
			$this->orderMastLib->reset_data();
                        
			$this->orderMastLib->set_data($row['order_id_pk'], $row['restaurant_id_fk'], $row['unbilled_amount'], $row['total_item_discount'], $row['unbilled_discounted_amount'], $row['additional_discount'], $row['payable_amount'], $row['total_tax'], $row['billed_amount'], $row['order_date'], $row['delivery_date'], $row['expected_delivery_time'], $row['table_no_fk'], $row['order_type'], $row['order_status'], $row['customer_id_fk'], $row['customer_name'], $row['customer_image_url'], $row['order_modification_time'], $row['customer_mobile_fk'], $row['customer_email_id_fk'], $row['invoice_no_fk']);

                        $temp_result = $this->orderMastLib->get_json_view();

                        $detail_object = $this->orderDetailModel->get_data(array('order_id' => $row['order_id_pk']));

                        foreach ($detail_object as $detail_row)
                                {
                                        $this->orderDetailLib->reset_data();
                                	$this->orderDetailLib->set_data($detail_row['order_id_fk'],$detail_row['item_id_fk'],$detail_row['size_id_fk'],$detail_row['size_name'],$detail_row['order_qty'],$detail_row['item_name'],$detail_row['discount_id_fk'],$detail_row['discount_name'],$detail_row['discount_price'],$detail_row['payable_price'],$detail_row['order_time'],$detail_row['expected_delivery_time'],$detail_row['order_status']);
                                	$order_list[] =  $this->orderDetailLib->get_json_view();

                                }

                        $temp_result['menu_list'] = $order_list;

			// add discount, tax and payment summary
			if(isset($row['invoice_no_fk']) && ($row['order_status'] == 'REJECTED' || $row['order_status'] == 'COMPLETED' )){
				
				$discount_object = $this->discountDetailModel->get_data(array('invoice_id' => $row['invoice_no_fk']));	
				$discount_list = array();			

				foreach ($discount_object as $discount_row)
                                {
                                        $this->discountDetailLib->reset_data();
                                        $this->discountDetailLib->set_data($discount_row['disount_id_fk'],$discount_row['invoice_id_fk'],$discount_row['restaurant_id_fk'],$discount_row['discount_name'],$discount_row['discount_amount'],$discount_row['vendor_note']);
	
                                        $discount_list[] =  $this->discountDetailLib->get_json_view();
                                }	
	
				$temp_result['discount_list'] = $discount_list;
			
				$tax_object = $this->taxDetailModel->get_data(array('invoice_id' => $row['invoice_no_fk']));
                                $tax_list = array();

                                foreach ($tax_object as $tax_row)
                                {
                                        $this->taxDetailLib->reset_data();
                                        $this->taxDetailLib->set_data($tax_row['invoice_id_fk'],$tax_row['restaurant_id_fk'],$tax_row['tax_id_fk'],$tax_row['tax_name'],$tax_row['tax_amount'],$tax_row['tax_percent']);

                                        $tax_list[] =  $this->taxDetailLib->get_json_view();
                                }

                                $temp_result['tax_list'] = $tax_list;


				$payment_object = $this->paymentDetailModel->get_data(array('invoice_id' => $row['invoice_no_fk']));
                                $payment_list = array();

                                foreach ($payment_object as $payment_row)
                                {
                                        $this->paymentDetailLib->reset_data();
                                        $this->paymentDetailLib->set_data($payment_row['payment_id'],$payment_row['invoice_id_fk'],$payment_row['currency_id_fk'],$payment_row['conversion_rate'],$payment_row['payable_amount_local_currency'],$payment_row['payable_amount'],$payment_row['payment_method'],$payment_row['payment_module'],$payment_row['payment_date'],$payment_row['amount_paid'],$payment_row['amount_pending']);

                                        $payment_list[] =  $this->paymentDetailLib->get_json_view();
                                }

                                $temp_result['payment_list'] = $payment_list;	
				
			}

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
			$result_list = $this->get_order_list($jsonData);
                        echo json_encode(array("ErrorCode" => EXIT_SUCCESS, "order_list" => $result_list), JSON_PRETTY_PRINT);
		}
		else{
			$errJson = array("ErrorCode" => EXIT_USER_INPUT, "ErrorMessage" => "Undefined operation");
			echo json_encode($errJson, JSON_PRETTY_PRINT);
		}
	}

}

