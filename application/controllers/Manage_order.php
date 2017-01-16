<?php  
#header('Content-Type: application/json');
class Manage_customer extends CI_Controller {
		
	public function __construct()
        {
                parent::__construct();
		$this->load->model('orderManagement');
		$this->load->library('uniqueIdGenerator', '', 'uniqueIdGenerator');
        }

	public function index(){
		show_404();
	}


	public function register(){

		$dataJson = file_get_contents('php://input');

                if($dataJson =='' || $dataJson == null){
                        $errJson = array('errorCode' => EXIT_USER_INPUT,
					'status' => "fail",
					'reason' => "Empty JSON");
                        echo json_encode($errJson, JSON_PRETTY_PRINT);
                        return;
                }

                $orderDetail = json_decode($dataJson, true);  
		$orderId = null;

		try{
			$orderId = $this->uniqueIdGenerator->getOrderId($orderDetail['customerId'], $orderDetail['restaurantId']);
			$this->orderManagement->placeOrder($orderDetail, $orderId);
		} catch(Exception $e){
			$errJson = array('errorCode' => $e->getCode(),
                                        'status' => "fail",
                                        'reason' => $e->getMessage());
                        echo json_encode($errJson, JSON_PRETTY_PRINT);
                        return;
		}

		$outputJson = array('status' => "success",
                                        'orderId' => $orderId);
              echo json_encode($outputJson, JSON_PRETTY_PRINT);
	}
}
	
