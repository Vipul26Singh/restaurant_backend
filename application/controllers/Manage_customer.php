<?php  
#header('Content-Type: application/json');
class Manage_customer extends CI_Controller {
		
	public function __construct()
        {
                parent::__construct();
                $this->load->helper('url_helper');
		$this->load->model('customerManagement');
		$this->load->library('uniqueIdGenerator', '', 'uniqueIdGenerator');
        }

	public function index(){
		show_404();
	}


	public function register(){

		$customerDetail = json_decode(file_get_contents('php://input'), true);;


		$authKey=$customerDetail['access_token'];

                if($authKey=='' || $authKey == null || $authKey!=AUTH_KEY){
                        $errJson = array("ErrorCode" => EXIT_USER_INPUT, "ErrorMessage" => "The access token provided is invalid");
                        echo json_encode($errJson, JSON_PRETTY_PRINT);
                        die;
                }



		$customerId = NULL;

		try{
			$firstName = $customerDetail['firstName'];
			$customerId = $this->uniqueIdGenerator->getCustomerId($firstName);
			$this->customerManagement->register($customerDetail, $customerId);
		} catch(Exception $e){
			$errJson = array('ErrorCode' => $e->getCode(),
                                        'ErrorMessage' => $e->getMessage());
                        echo json_encode($errJson, JSON_PRETTY_PRINT);
                        return;
		}

		$outputJson['customerId'] = $customerId;
              echo json_encode($outputJson, JSON_PRETTY_PRINT);
	}
}
	
