<?php  
#header('Content-Type: application/json');
class Fetch_menu_item extends CI_Controller {
		
	public function __construct()
        {
                parent::__construct();

		$this->load->helper('url_helper');
                $this->load->library('generateItemJson', '', 'generateItemJson');
                $this->load->model('getMenuItemList');
        }

	public function index(){
		show_404();
	}

	public function get_item(){
	
            	$jsonData = json_decode(file_get_contents('php://input'), true);
                
		$authKey=$jsonData['access_token'];
		
                if($authKey=='' || $authKey == null || $authKey!=AUTH_KEY){
			$errJson = array("ErrorCode" => EXIT_USER_INPUT, "ErrorMessage" => "The access token provided is invalid");
			echo json_encode($errJson, JSON_PRETTY_PRINT);
                        die;
                }
		

		$value = array();
                $value['subCategory1']=  $jsonData['subCategory1'];
                $value['restId']=  $jsonData['restaurantId'];

		if($value['subCategory1']=='' || $value['restId']=='' || $value['subCategory1']==null || $value['restId']==null){
                        $errJson = array("ErrorCode" => EXIT_USER_INPUT, "ErrorMessage" => "Missing mandatory input");
                        echo json_encode($errJson, JSON_PRETTY_PRINT);
                        die;
                }


                $result = null;
                try{
                        $result = $this->getMenuItemList->getItem($value);
                } catch(Exception $e) {
                        $errJson = array("ErrorCode" => EXIT_DATABASE, "ErrorMessage" => $e->getMessage());
                        echo json_encode($errJson, JSON_PRETTY_PRINT);
                        die;
                }

		$this->generateItemJson->setGlobals($value['subCategory1'], $value['restId']);

                foreach ($result as $row){
                        $this->generateItemJson->addItemDetail($value['subCategory1'], $row, $value['restId']);
                }

                echo $this->generateItemJson->getJson();
		die;
	}

	public function get_level_1(){

                $jsonData = json_decode(file_get_contents('php://input'), true);


                $authKey=$jsonData['access_token'];

                if($authKey=='' || $authKey == null || $authKey!=AUTH_KEY){
                        $errJson = array("ErrorCode" => EXIT_USER_INPUT, "ErrorMessage" => "The access token provided is invalid");
                        echo json_encode($errJson, JSON_PRETTY_PRINT);
                        die;
                }       
                

                $value = array();
                $value['restaurant_id']=  $jsonData['restaurantId'];

		$result = null;
                try{
                        $result = $this->getMenuItemList->getSubCategory1($value);
                } catch(Exception $e) {
                        $errJson = array("ErrorCode" => EXIT_DATABASE, "ErrorMessage" => $e->getMessage());
                        echo json_encode($errJson, JSON_PRETTY_PRINT);
                        die;
                }
	
		$jsonResult = array();
		foreach($result as $row){
			$jsonResult[] = array($row['category_1_id'] => $row['sub_category_pk2']);
		}	

		echo json_encode(array("menu_level_1" => $jsonResult), JSON_PRETTY_PRINT);
		die;
	}

}
	
