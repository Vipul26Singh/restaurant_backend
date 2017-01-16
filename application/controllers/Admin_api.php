<?php
header('Content-Type: application/json');
class Admin_api extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('adminModel');

	}
	public function index()
	{
		show_404();
	}
	public function check_input($jsonData)
	{
		$authKey = $jsonData['access_token'];

		if($authKey=='' || $authKey == null || $authKey!=AUTH_KEY){
			$errJson = array("ErrorCode" => EXIT_USER_INPUT, "ErrorMessage" => "The access token provided is invalid");
			echo json_encode($errJson, JSON_PRETTY_PRINT);
            die;
        }
	}
	public function login()
	{
		$jsonData = json_decode(file_get_contents('php://input'), true);
		$this->check_input($jsonData);
		try{
			$value = array();
			$value['password'] = $jsonData['password'];
			if(empty($jsonData['username']))
			{
				$value['restaurant_email_id'] = $jsonData['restaurant_email_id'];
			}
			else
			{
				$value['username'] = $jsonData['username'];	
			}
			$outputJson = array("restaurantId" =>$this->adminModel->login($value));
			echo json_encode($outputJson, JSON_PRETTY_PRINT);
		}
		catch(Exception $e)
		{
			$outputJson = array('ErrorCode' => $e->getCode(),'ErrorMessage'=> $e->getMessage());
          	echo json_encode($outputJson, JSON_PRETTY_PRINT);
		}
	}


	public function current_order_progress()
	{
		$jsonData = json_decode(file_get_contents('php://input'), true);
		$this->check_input($jsonData);
		try
		{
			$value = array("restaurantId" => $jsonData['restaurantId']);
			$outputJson = $this->adminModel->current_order_progress($value);
			echo json_encode($outputJson, JSON_PRETTY_PRINT);
		}
		catch(Exception $e)
		{
			$outputJson = array('ErrorCode' => $e->getCode(),'ErrorMessage'=> $e->getMessage());
          	echo json_encode($outputJson, JSON_PRETTY_PRINT);
		}
	}

	public function current_orders()
	{

		$jsonData = json_decode(file_get_contents('php://input'), true);
		$this->check_input($jsonData);
		try
		{
			$value = array("restaurantId" => $jsonData['restaurantId']);
			$outputJson = $this->adminModel->current_orders($value);
			echo json_encode($outputJson, JSON_PRETTY_PRINT);
		}
		catch(Exception $e)
		{
			$outputJson = array('ErrorCode' => $e->getCode(),'ErrorMessage'=> $e->getMessage());
          	echo json_encode($outputJson, JSON_PRETTY_PRINT);
		}
	}


	public function ratings()
	{
		$jsonData = json_decode(file_get_contents('php://input'), true);
		$this->check_input($jsonData);
		try
		{
			$value = array("restaurantId" => $jsonData['restaurantId']);
			$outputJson = $this->adminModel->ratings($value);
			echo json_encode($outputJson, JSON_PRETTY_PRINT);
		}
		catch(Exception $e)
		{
			$outputJson = array('ErrorCode' => $e->getCode(),'ErrorMessage'=> $e->getMessage());
          	echo json_encode($outputJson, JSON_PRETTY_PRINT);
		}
	}
	public function invoice_details()
	{
		$jsonData = json_decode(file_get_contents('php://input'), true);
		$this->check_input($jsonData);
		try
		{
			$value = array("restaurantId" => $jsonData['restaurantId']);
			$outputJson = $this->adminModel->invoice_details($value);
			echo json_encode($outputJson, JSON_PRETTY_PRINT);
		}
		catch(Exception $e)
		{
			$outputJson = array('ErrorCode' => $e->getCode(),'ErrorMessage'=> $e->getMessage());
          	echo json_encode($outputJson, JSON_PRETTY_PRINT);
		}
	}
	public function current_orders_restCustomer()
	{
		$jsonData = json_decode(file_get_contents('php://input'), true);
		$this->check_input($jsonData);
		try
		{
			$value = array("restaurantId" => $jsonData['restaurantId'],"customerId" => $jsonData['customerId']);
			$outputJson = $this->adminModel->current_orders_restCustomer($value);
			echo json_encode($outputJson, JSON_PRETTY_PRINT);
		}
		catch(Exception $e)
		{
			$outputJson = array('ErrorCode' => $e->getCode(),'ErrorMessage'=> $e->getMessage());
          	echo json_encode($outputJson, JSON_PRETTY_PRINT);
		}
	}

	public function get_current_order()
	{
		$jsonData = json_decode(file_get_contents('php://input'), true);
		$this->check_input($jsonData);
		try
		{
			$value = array("restaurantId" => $jsonData['restaurantId']);
			$outputJson = $this->adminModel->get_current_order($value);
			echo json_encode($outputJson, JSON_PRETTY_PRINT);
		}
		catch(Exception $e)
		{
			$outputJson = array('ErrorCode' => $e->getCode(),'ErrorMessage'=> $e->getMessage());
          	echo json_encode($outputJson, JSON_PRETTY_PRINT);
		}
	}
	
}
?>