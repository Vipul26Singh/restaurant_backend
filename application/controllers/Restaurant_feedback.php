<?php  
#header('Content-Type: application/json');
class Restaurant_feedback extends CI_Controller {
		
	public function __construct()
        {
                parent::__construct();

                $this->load->model('restaurantRatingManagement');
        }

	public function index(){
		show_404();
	}

	public function submit(){
	
            	$jsonData = json_decode(file_get_contents('php://input'), true); 

                $authKey=$jsonData['access_token'];

                if($authKey=='' || $authKey == null || $authKey!=AUTH_KEY){
			$errJson = array("ErrorCode" => EXIT_USER_INPUT, "ErrorMessage" => "The access token provided is invalid");
			echo json_encode($errJson, JSON_PRETTY_PRINT);
                        die;
                }
		
		$value = array();
                $value['restaurant_id']=  $jsonData['restaurantId'];
                $value['customer_id']=  $jsonData['customerId'];
		$value['order_id']=  $jsonData['orderId'];
		$value['rating']=  $jsonData['rating'];
		$value['comment']=  $jsonData['comment'];


                $result = null;
                try{
                        $result = $this->restaurantRatingManagement->setRating($value);
                } catch(Exception $e) {
                        $errJson = array("ErrorCode" => EXIT_DATABASE, "ErrorMessage" => $e->getMessage());
                        echo json_encode($errJson, JSON_PRETTY_PRINT);
                        die;
                }

                $errJson = array("ErrorCode" => EXIT_SUCCESS, "ErrorCode" => "Submit Successfully");
                echo json_encode($errJson, JSON_PRETTY_PRINT);

                die;
	}

}
	
