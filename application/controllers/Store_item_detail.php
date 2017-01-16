<?php  
#header('Content-Type: application/json');
class Store_item_detail extends CI_Controller {
		
	public function __construct()
        {
                parent::__construct();
                $this->load->helper('url_helper');
		//$this->load->library( array('RestaurantMenuItem/getMainCourse', 'RestaurantMenuItem/getSalads', 'RestaurantMenuItem/getSoups', 'RestaurantMenuItem/getStarters', 'RestaurantMenuItem/itemDetail', 'RestaurantMenuItem/foodItemFactory') );

		$this->load->model('RestaurantMenuItem/interactWithDB', 'interactWithDB');
        }

	public function index(){
		show_404();
	}

	public function set_current_order(){
		$dataJson = file_get_contents('php://input');
		
		if($dataJson =='' || $dataJson == null){
			$errJson = array("ErrorCode" => EXIT_USER_INPUT, "ErrorMessage" => "Empty Input Json");
                        echo json_encode($errJson, JSON_PRETTY_PRINT);
			return;
		}


		$orderList = json_decode($dataJson, true);		

		

		$columnList = "A.menu_item_pk2_fk as ItemId, A.display_name as ItemName, A.display_content as Description, B.average_rating as
Rating, A.full_plate_price as FullPrice, A.half_plate_price as HalfPrice, A.small_plate_price as SmallPrice, A.preparation_time as PrepTime";
		$tableList = "tbl_mast_restaurant_menu_item A, tbl_summary_restaurant_rating B";
		$whereClause = "A.restaurant_email_id_pk1_fk = B.restaurant_email_id_pk_fk and A.sub_category_1 = '" .$subCategory1. "' and A.restaurant_email_id_pk1_fk = '" . $restId . "'";

		$dbRespnse = null;
		try{
			$dbRespnse = $this->interactWithDB->setDBDetail($tableName, $columnList, $valueList);
		} catch(Exception $e) {
			$errJson = array("ErrorCode" => EXIT_DATABASE, "ErrorMessage" => $e->getMessage());
			echo json_encode($errJson, JSON_PRETTY_PRINT);
			return;
		}


		if($dbRespnse == TRUE)
			$response = "success";
		else
			$response = "fail";

		$respJson = array('status' => $response);
		echo json_encode($respJson, JSON_PRETTY_PRINT);;
	}
}
	
