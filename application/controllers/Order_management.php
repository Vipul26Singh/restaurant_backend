<?php  
#header('Content-Type: application/json');
class Order_management extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('orderManagement');
		$this->load->helper('url_helper');
		$this->load->model('submitOrderModel');
		$this->load->library('uniqueIdGenerator', '', 'uniqueIdGenerator');

	}

	public function index(){
		show_404();
	}

	public function fetch_history(){

		$jsonData = json_decode(file_get_contents('php://input'), true); 
			$authKey=$jsonData['access_token'];

		if($authKey=='' || $authKey == null || $authKey!=AUTH_KEY){
			$errJson = array("ErrorCode" => EXIT_USER_INPUT, "ErrorMessage" => "The access token provided is invalid");
			echo json_encode($errJson, JSON_PRETTY_PRINT);
			die;
		}


		$value = array();
		$value['customer_id']=  $jsonData['customerId'];
		$value['restaurant_id']=  $jsonData['restaurantId'];

		$result = null;

		try{
			$result = $this->orderManagement->getOrderDetail($value);
		} catch(Exception $e) {
			$errJson = array("ErrorCode" => EXIT_DATABASE, "ErrorMessage" => $e->getMessage());
			echo json_encode($errJson, JSON_PRETTY_PRINT);
			die;
		}


		$jsonData = array();
		foreach ($result as $row){
			$jsonData[] = $row;
		}

		$jsonData = array("orderHistory" => $jsonData);

		echo json_encode($jsonData, JSON_PRETTY_PRINT);
		die;
	}

	public function get_invoice_detail(){
		$jsonData = json_decode(file_get_contents('php://input'), true);
		$authKey=$jsonData['access_token'];

		if($authKey=='' || $authKey == null || $authKey!=AUTH_KEY){
			$errJson = array("ErrorCode" => EXIT_USER_INPUT, "ErrorMessage" => "The access token provided is invalid");
			echo json_encode($errJson, JSON_PRETTY_PRINT);
			die;
		}


		$value = array();
		$value['invoice_no']=  $jsonData['invoiceNo'];
		$value['restaurant_id']=  $jsonData['restaurantId'];

		$finalJson = array();
		$finalJson["invoiceNo"] = $value['invoice_no'];


		$result = null;
		try{
			$result = $this->orderManagement->getTaxDetail($value);
		} catch(Exception $e) {
			$errJson = array("ErrorCode" => EXIT_DATABASE, "ErrorMessage" => $e->getMessage() . "1");
			echo json_encode($errJson, JSON_PRETTY_PRINT);
			die;
		}


		foreach($result as $row){
			$finalJson[$row['tax_id']] = $row['tax'];	
		}

		$result = null;
		try{
			$result = $this->orderManagement->getDiscountDetail($value);
		} catch(Exception $e) {
			$errJson = array("ErrorCode" => EXIT_DATABASE, "ErrorMessage" => $e->getMessage() . "2");
			echo json_encode($errJson, JSON_PRETTY_PRINT);
			die;
		}




		try{
			$finalJson['discount'] = $result[0]['discount'];        
			$value['order_id'] = $result[0]['order_id'];
		}catch(Exception $e) {
			$errJson = array("ErrorCode" => EXIT_DATABASE, "ErrorMessage" => "Corrupted data in tbl_Detail_order_invoice for " . $value['invoice_no']);
			echo json_encode($errJson, JSON_PRETTY_PRINT);
			die;
		}

		try{
			$result = $this->orderManagement->getItemDetail($value);
		} catch(Exception $e) {
			$errJson = array("ErrorCode" => EXIT_DATABASE, "ErrorMessage" => $e->getMessage() . "3");
			echo json_encode($errJson, JSON_PRETTY_PRINT);
			die;
		}

		$newItemList = array();
		foreach($result as $row){
			$imageUrl = stripslashes( strip_tags( base_url() ) ) ."/". BASE_IMAGE_PATH. "/"  .$value['restaurant_id'] .  "/" . $row['itemName'] . IMAGE_FORMAT;             
			$row['imageurl'] = $imageUrl; 
			$newItemList[] = $row;
		}

		$finalJson['list'] = $newItemList;

		echo json_encode($finalJson, JSON_PRETTY_PRINT);
		die;	
	}

	public function submit(){

		$dataJson = file_get_contents('php://input');

		$orderDetail = json_decode($dataJson, true);  
		$outputJson = null;

		$authKey=$orderDetail['access_token'];

		if($authKey=='' || $authKey == null || $authKey!=AUTH_KEY){
			$errJson = array("ErrorCode" => EXIT_USER_INPUT, "ErrorMessage" => "The access token provided is invalid");
			echo json_encode($errJson, JSON_PRETTY_PRINT);
			die;
		}


		try
		{
			if(empty($orderDetail['orderId']) && $orderDetail['status'] == "new")
			{
				$orderDetail['orderId'] = $this->uniqueIdGenerator->getPrefixedUniqueId("ORDID");
				$orderDetail['invoiceId'] = $this->uniqueIdGenerator->getPrefixedUniqueId("INVID");
				$outputJson = $this->submitOrderModel->placeOrderNew($orderDetail);
			}
			else if(!empty($orderDetail['orderId']) && $orderDetail['status'] == "new")
			{
				$orderDetail['invoiceId'] = "";				
				$outputJson = $this->submitOrderModel->placeOrderOld($orderDetail);
			}
			else{
				$errJson = array("ErrorCode" => EXIT_USER_INPUT, "ErrorMessage" => "Unsupported functionality");
				echo json_encode($errJson, JSON_PRETTY_PRINT);
				die;
			}

		}
		catch(Exception $e)
		{
			$outputJson = array('ErrorCode' => $e->getCode(),'ErrorMessage'=> 'Unable to place order');
			echo json_encode($outputJson, JSON_PRETTY_PRINT);
			die;
		}

		$outputJson =  array('ErrorCode' => EXIT_SUCCESS, "OrderId" => $orderDetail['orderId'], "InvoiceId" => $orderDetail['invoiceId']);
		echo json_encode($outputJson, JSON_PRETTY_PRINT);
	}

}



