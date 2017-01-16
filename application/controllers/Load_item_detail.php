<?php  
#header('Content-Type: application/json');
class Load_item_detail extends CI_Controller {
		
	public function __construct()
        {
                parent::__construct();

		$this->load->helper('url_helper');
                $this->load->library('RestaurantMenuItem/generateItemList', '', 'generateItemList');
                $this->load->library('RestaurantMenuItem/itemDetail', '', 'itemDetail');
                $this->load->model('RestaurantMenuItem/interactWithDB', 'interactWithDB');

        }

	public function index(){
		show_404();
	}

	public function get($subCategory1=null, $restId=null){
		if($subCategory1=='' || $restId=='' || $subCategory1==null || $restId==null){
                        $errJson = array("ErrorCode" => EXIT_USER_INPUT, "ErrorMessage" => "Missing value of Item or Restaurnat ID");
                        echo json_encode($errJson, JSON_PRETTY_PRINT);
                        return;
                }

                $columnList = "A.menu_item_pk2_fk as ItemId, A.display_name as ItemName, A.display_content as Description, B.average_rating as
Rating, A.full_plate_price as FullPrice, A.half_plate_price as HalfPrice, A.small_plate_price as SmallPrice, A.preparation_time as PrepTime";
                $tableList = "tbl_mast_restaurant_menu_item A, tbl_summary_item_rating B";
                $whereClause = "A.restaurant_email_id_pk1_fk = B.restaurant_email_id_pk2_fk and A.sub_category_1 = '" .$subCategory1. "' and A.menu_item_pk2_fk = B.menu_item_pk1_fk and A.restaurant_email_id_pk1_fk = '" . $restId . "'";

                $result = null;
                try{
                        $result = $this->interactWithDB->getDBDetail($columnList ,$tableList , $whereClause);
                } catch(Exception $e) {
                        $errJson = array("ErrorCode" => EXIT_DATABASE, "ErrorMessage" => $e->getMessage());
                        echo json_encode($errJson, JSON_PRETTY_PRINT);
                        return;
                }

		$this->generateItemList->setGlobals($subCategory1,  $restId);
                foreach ($result as $row){
                        $this->generateItemList->addItemDetail($subCategory1, $row, $restId);
                }
                echo $this->generateItemList->getJson();
	}
}
	
