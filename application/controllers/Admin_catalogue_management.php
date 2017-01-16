<?php 
class Admin_catalogue_management extends CI_Controller { 

	function __construct() {
		parent::__construct();

	}


	/********************************************************************************************************
	 *
	 *                           Functionality
	 *
	 *                          Cuisine Management  
	 *
	 *
	 *
	 *
	 **********************************************************************************************************/


	private function insert_cuisine($jsonData){
		$this->load->library('databaseClass/restaurant_cuisine_management', '', 'restaurant_cuisine_management');    
		$this->load->helper('file');
		$this->load->helper('url');
		$this->load->library('uniqueIdGenerator', '', 'uniqueIdGenerator');
		$this->load->model('menuCuisine');
		$err_count =0;
		$curr_index =0;
		$err_index = null;

		$array_list = $jsonData['cuisine'];
		$output_data = array();
		foreach($array_list as $elem){
			$this->restaurant_cuisine_management->reset_data();
			$image_path=null;
			$image_path_name = null;
			$image_ext = null;
			$temp_error_code = EXIT_SUCCESS;
			$temp_error_message = null;


			$cuisine_id = $this->uniqueIdGenerator->getPrefixedUniqueId('CUSID' . substr($jsonData['restaurant_id'], 0, 5) .  substr($elem['title'], 0, 5));

			try{
				if(isset($elem['image'])){
					$image_path = BASE_IMAGE_PATH . "/". $jsonData['restaurant_id'] . "/";	
					$image_ext = IMAGE_TYPE_ALLOWED;
					$image_path_name = $image_path.$cuisine_id. "." . $image_ext;
					$elem['image'] = str_replace(IMAGE_PREFIX, "", $elem['image']);
					$decoded=base64_decode($elem['image']);

					if ( file_put_contents($image_path_name , $decoded) == "false")
					{
						$temp_error_code = EXIT_USER_INPUT;
						$temp_error_message = "and Unable to uplaod image for item " . $elem['title'];
						$err_count +=1;                     
						$err_index =  $err_index . ',' .$curr_index;                     
					}
				}

				$this->restaurant_cuisine_management->set_data($jsonData['restaurant_id'], $elem['title'], $elem['sequence'], $cuisine_id, $elem['description'], $image_path_name);
				$this->menuCuisine->add_data($this->restaurant_cuisine_management->get_associative_array());

				$output_data[] = array("id"=>$cuisine_id, "image_url"=>KRAZYTABLE_URL.$image_path_name, "ErrorCode"=>$temp_error_code, "ErrorMessage"=>"Details are uploaded " . $temp_error_message);

			}catch(Exception $e) {
				$output_data[] = array("id"=>$cuisine_id, "ErrorCode"=>EXIT_DATABASE, "ErrorMessage"=>"Details not upladed for ". $elem['title'] . $temp_error_message);
				$err_count +=1;                     
				$err_index =  $err_index . ',' .$curr_index;
				if(isset($elem['image'])){
					try{
						delete_files($image_path_name);
					}catch (Exception $e){
						null;
					}
				}
			}   
			$curr_index+=1;
		}   
		return array("ErrorCode" => $err_count, "ErrorIndex" =>  $err_index, "id" => $output_data);
	}

	private function delete_cuisine($jsonData){
		$this->load->library('databaseClass/restaurant_cuisine_management', '', 'restaurant_cuisine_management');    
		$this->load->helper('file');
		$this->load->model('menuCuisine');

		$array_list = $jsonData['cuisine'];
		$output_data = array();
		$err_count =0;
		$curr_index =0;
		$err_index = null;
		$image_ext = null;

		foreach($array_list as $elem){
			$this->restaurant_cuisine_management->reset_data();
			$image_path = BASE_IMAGE_PATH . "/". $jsonData['restaurant_id'] . "/";	
			$image_ext = IMAGE_TYPE_ALLOWED;
			$image_path_name = $image_path.$elem['id']. "." . $image_ext;


			$this->restaurant_cuisine_management->set_primary_key($elem['id']); 

			try{
				$this->menuCuisine->delete_data($this->restaurant_cuisine_management->get_primary_key());
				$output_data[] = array("id"=>$elem['id'], "ErrorCode"=>EXIT_SUCCESS, "ErrorMessage"=>"");

				/** delete image file from server **/
				delete_files($image_path_name);
			}catch(Exception $e) {
				$output_data[] = array("id"=>$elem['id'], "ErrorCode"=>EXIT_DATABASE, "ErrorMessage"=>"Unable to delete item ");
				$err_count +=1;                     
				$err_index =  $err_index . ',' .$curr_index;
			}   
			$curr_index+=1;
		}   
		return array("ErrorCode" => $err_count, "ErrorIndex" =>  $err_index, "id" => $output_data);  
	}

	private function replace_cuisine($jsonData){
		$this->load->library('databaseClass/restaurant_cuisine_management', '', 'restaurant_cuisine_management');    
		$this->load->helper('file');
		$this->load->model('menuCuisine');

		$array_list = $jsonData['cuisine'];
		$output_data = array();
		$err_count =0;
		$curr_index =0;
		$err_index = null;
		$image_ext = IMAGE_TYPE_ALLOWED;

		foreach($array_list as $elem){
			$this->restaurant_cuisine_management->reset_data();
			$image_path=null;
			$image_path_name = null;           
			$temp_error_message = null; 
			$temp_error_code = NULL;

			try{

				if(isset($elem['image'])){

					$elem['image'] = str_replace(IMAGE_PREFIX, "", $elem['image']);
					
					$image_path = BASE_IMAGE_PATH . "/". $jsonData['restaurant_id'] . "/";	
					$image_ext = IMAGE_TYPE_ALLOWED;
					$image_path_name = $image_path.$elem['id']. "." . $image_ext;

					$elem['image'] = str_replace(IMAGE_PREFIX, "", $elem['image']);
					
					$decoded=base64_decode($elem['image']);

					if ( file_put_contents($image_path_name , $decoded) == "false")
					{
						$temp_error_code = EXIT_USER_INPUT;
						$temp_error_message = "Unable to update image for item " . $elem['title'];
						$err_count +=1;                     
						$err_index =  $err_index . ',' .$curr_index;                     
					}
				}

				$this->restaurant_cuisine_management->set_data($jsonData['restaurant_id'], $elem['title'], $elem['sequence'], $elem['id'], $elem['description'], $image_path_name);

				$update_detail = array();
				if(isset($elem['image']))
					$update_detail['image_relative_path'] = $image_path_name;
 				if(isset($elem['title']))
 					$update_detail['cuisine_pk2'] = $this->restaurant_cuisine_management->get_value('title');  
 				if(isset($elem['sequence']))
 					$update_detail['sequence_pk3'] = $this->restaurant_cuisine_management->get_value('sequence'); 
 				if(isset($elem['description']))
 					$update_detail['cuisine_description'] = $this->restaurant_cuisine_management->get_value('description');  
 				$primary_key = $this->restaurant_cuisine_management->get_primary_key();

				$this->menuCuisine->replace_data($update_detail, $primary_key);

				if(!isset($elem['image']))
					$output_data[] = array("id"=>$elem['id'], "ErrorCode"=>$temp_error_code, "ErrorMessage"=>$temp_error_message);
				else
					$output_data[] = array("id"=>$elem['id'], "image_url"=>KRAZYTABLE_URL.$image_path_name, "ErrorCode"=>$temp_error_code, "ErrorMessage"=>$temp_error_message);
			}catch(Exception $e) {
				$output_data[] = array("id"=>$elem['id'], "ErrorCode"=>EXIT_DATABASE, "ErrorMessage"=>"Unable to update menu ". $elem['title']);
				$err_count +=1;                     
				$err_index =  $err_index . ',' .$curr_index;
				if(isset($elem['image'])){
                                        try{
                                                delete_files($image_path_name);
                                        }catch (Exception $e){
                                                null;
                                        }
                                }
			}  
			$curr_index+=1;
		}   

		return array("ErrorCode" => $err_count, "ErrorIndex" =>  $err_index, "id" => $output_data);

	}

	public function index() {
		show_404();
	} 

	public function cuisine_management() {
		$jsonData = json_decode(file_get_contents('php://input'), true);
		$authKey=$jsonData['access_token'];

		if($authKey=='' || $authKey == null || $authKey!=AUTH_KEY){
			$errJson = array("ErrorCode" => EXIT_USER_INPUT, "ErrorMessage" => "The access token provided is invalid");
			echo json_encode($errJson, JSON_PRETTY_PRINT);
			die;
		}          


		if($jsonData['request_type'] == SELECT_DATA){
			try{
				$this->load->model('menuCuisine');
				$result_cuisine = $this->menuCuisine->get_data($jsonData);
				echo json_encode(array("ErrorCode" => EXIT_SUCCESS, "cuisine" => $result_cuisine), JSON_PRETTY_PRINT);
			}catch(Exception $e) {
				$errJson = array("ErrorCode" => EXIT_DATABASE, "ErrorMessage" => $e->getMessage());
				echo json_encode($errJson, JSON_PRETTY_PRINT);
				die;
			}
		}else if($jsonData['request_type'] == INSERT_DATA){
			$result = $this->insert_cuisine($jsonData);
			echo json_encode($result, JSON_PRETTY_PRINT);
		}else if($jsonData['request_type'] == REPLACE_DATA){
			$result = $this->replace_cuisine($jsonData);
			echo json_encode($result, JSON_PRETTY_PRINT);
		}else if($jsonData['request_type'] == REMOVE_DATA){
			$result = $this->delete_cuisine($jsonData);
			echo json_encode($result, JSON_PRETTY_PRINT);
		}else{
			$errJson = array("ErrorCode" => EXIT_USER_INPUT, "ErrorMessage" => "Undefined operation");
			echo json_encode($errJson, JSON_PRETTY_PRINT);
		}
	}



	/********************************************************************************************************
	 *
	 *                           Functionality
	 *
	 *                          Category Management  
	 *
	 *
	 *
	 *
	 **********************************************************************************************************/

	private function insert_category_1($jsonData){
		$this->load->library('databaseClass/restaurant_category_1_management', '', 'restaurant_category_1_management');    
		$this->load->helper('file');
		$this->load->library('uniqueIdGenerator', '', 'uniqueIdGenerator');
		$this->load->model('menuCategory1');
		$err_count =0;
		$curr_index =0;
		$err_index = null;

		$array_list = $jsonData['category'];
		$output_data = array();
		foreach($array_list as $elem){
			$this->restaurant_category_1_management->reset_data();
			$image_path=null;
			$image_path_name = null;
			$image_ext = null;
			$temp_error_code = EXIT_SUCCESS;
			$temp_error_message = null;


			$category_1_id = $this->uniqueIdGenerator->getPrefixedUniqueId('CUSID' . substr($jsonData['restaurant_id'], 0, 5) .  substr($elem['title'], 0, 5));


			try{
				if(isset($elem['image'])){
					$image_path = BASE_IMAGE_PATH . "/". $jsonData['restaurant_id'] . "/";
					$image_ext = IMAGE_TYPE_ALLOWED;
					$image_path_name = $image_path.$category_1_id. "." . $image_ext;
					$elem['image'] = str_replace(IMAGE_PREFIX, "", $elem['image']);
					$decoded=base64_decode($elem['image']);

					if ( file_put_contents($image_path_name , $decoded) == "false")
					{
						$temp_error_code = EXIT_USER_INPUT;
						$temp_error_message = "and Unable to uplaod image for item " . $elem['title'];
						$err_count +=1;
						$err_index =  $err_index . ',' .$curr_index;
					}
				}

				$this->restaurant_category_1_management->set_data($jsonData['restaurant_id'], $elem['title'], $elem['sequence'], $category_1_id, $elem['description'], $image_path_name);
				$this->menuCategory1->add_data($this->restaurant_category_1_management->get_associative_array());

				$output_data[] = array("id"=>$category_1_id, "image_url"=>KRAZYTABLE_URL.$image_path_name, "ErrorCode"=>$temp_error_code, "ErrorMessage"=>"Details are uploaded " . $temp_error_message);

			}catch(Exception $e){
				$output_data[] = array("id"=>$category_1_id, "ErrorCode"=>EXIT_DATABASE, "ErrorMessage"=>"Details not upladed for ". $elem['title'] . $temp_error_message);
				$err_count +=1;
				$err_index =  $err_index . ',' .$curr_index;
				if(isset($elem['image'])){
                                        try{
                                                delete_files($image_path_name);
                                        }catch (Exception $e){
                                                null;
                                        }
                                }

			}
			$curr_index+=1;
		}
		return array("ErrorCode" => $err_count, "ErrorIndex" =>  $err_index, "id" => $output_data);
	}

	private function delete_category_1($jsonData){
		$this->load->library('databaseClass/restaurant_category_1_management', '', 'restaurant_category_1_management');    
		$this->load->helper('file');
		$this->load->model('menuCategory1');

		$array_list = $jsonData['category'];
		$output_data = array();
		$err_count =0;
		$curr_index =0;
		$err_index = null;
		$image_ext = null;

		foreach($array_list as $elem){
			$this->restaurant_category_1_management->reset_data();
			$image_path = BASE_IMAGE_PATH . "/". $jsonData['restaurant_id'] . "/";
			$image_ext = IMAGE_TYPE_ALLOWED;
			$image_path_name = $image_path.$elem['id']. "." . $image_ext;


			$this->restaurant_category_1_management->set_primary_key($elem['id']);

			try{
				$this->menuCategory1->delete_data($this->restaurant_category_1_management->get_primary_key());
				$output_data[] = array("id"=>$elem['id'], "ErrorCode"=>EXIT_SUCCESS, "ErrorMessage"=>"");

				/** delete image file from server **/
				delete_files($image_path_name);
			}catch(Exception $e) {
				$output_data[] = array("id"=>$elem['id'], "ErrorCode"=>EXIT_DATABASE, "ErrorMessage"=>"Unable to add item ". $elem['title']);
				$err_count +=1;
				$err_index =  $err_index . ',' .$curr_index;
			}
			$curr_index+=1;
		}
		return array("ErrorCode" => $err_count, "ErrorIndex" =>  $err_index, "id" => $output_data);
	}

	private function replace_category_1($jsonData){
		$this->load->library('databaseClass/restaurant_category_1_management', '', 'restaurant_category_1_management');    
		$this->load->helper('file');
		$this->load->model('menuCategory1');

		$array_list = $jsonData['category'];
		$output_data = array();
		$err_count =0;
		$curr_index =0;
		$image_ext = IMAGE_TYPE_ALLOWED;
		$err_index = null;

		foreach($array_list as $elem){
			$this->restaurant_category_1_management->reset_data();
			$image_path=null;
			$image_path_name = null;
			$temp_error_message = null;
			$temp_error_code = null;

			try{
				
				if(isset($elem['image'])){
					$elem['image'] = str_replace(IMAGE_PREFIX, "", $elem['image']);
					$image_path_name = $image_path.$elem['id']. "." . $image_ext;
					$image_path = BASE_IMAGE_PATH . "/". $jsonData['restaurant_id'] . "/";
					$image_ext = IMAGE_TYPE_ALLOWED;
					$image_path_name = $image_path.$elem['id']. "." . $image_ext;
					$elem['image'] = str_replace(IMAGE_PREFIX, "", $elem['image']);
					$decoded=base64_decode($elem['image']);

					if ( file_put_contents($image_path_name , $decoded) == "false")
					{
						$temp_error_code = EXIT_USER_INPUT;
						$temp_error_message = "and Unable to delete image for item " . $elem['title'];
						$err_count +=1;
						$err_index =  $err_index . ',' .$curr_index;
					}
				}

				$this->restaurant_category_1_management->set_data($jsonData['restaurant_id'], $elem['title'], $elem['sequence'], $elem['id'], $elem['description'], $image_path_name);
				$update_detail = array();
				$primary_key = $this->restaurant_category_1_management->get_primary_key();

				if(isset($elem['image']))
					$update_detail['image_relative_path'] = $image_path_name;
 				if(isset($elem['title']))
 					$update_detail['sub_category_pk2'] = $this->restaurant_category_1_management->get_value('title');  
 				if(isset($elem['sequence']))
 					$update_detail['sequence_pk3'] = $this->restaurant_category_1_management->get_value('sequence'); 
 				if(isset($elem['description']))
 					$update_detail['category_1_description'] = $this->restaurant_category_1_management->get_value('description');  

				$this->menuCategory1->replace_data($update_detail, $primary_key);

				if(!isset($elem['image']))
					$output_data[] = array("id"=>$elem['id'], "ErrorCode"=>$temp_error_code, "ErrorMessage"=>"Details are replaced " . $temp_error_message);
				else
					$output_data[] = array("id"=>$elem['id'], "image_url"=>KRAZYTABLE_URL.$image_path_name, "ErrorCode"=>$temp_error_code, "ErrorMessage"=>"Details are replaced " . $temp_error_message);
			}catch(Exception $e) {
				$output_data[] = array("id"=>$elem['id'], "ErrorCode"=>EXIT_DATABASE, "ErrorMessage"=>"Unable to add item ". $elem['title']);
				$err_count +=1;
				$err_index =  $err_index . ',' .$curr_index;
				if(isset($elem['image'])){
                                        try{
                                                delete_files($image_path_name);
                                        }catch (Exception $e){
                                                null;
                                        }
                                }
			}
			$curr_index+=1;
		}
		return array("ErrorCode" => $err_count, "ErrorIndex" =>  $err_index, "id" => $output_data);

	}



	public function category_1_management() {
		$jsonData = json_decode(file_get_contents('php://input'), true);
		$authKey=$jsonData['access_token'];

		if($authKey=='' || $authKey == null || $authKey!=AUTH_KEY){
			$errJson = array("ErrorCode" => EXIT_USER_INPUT, "ErrorMessage" => "The access token provided is invalid");
			echo json_encode($errJson, JSON_PRETTY_PRINT);
			die;
		}          


		if($jsonData['request_type'] == SELECT_DATA){
			try{
				$this->load->model('menuCategory1');
				$result_category = $this->menuCategory1->get_data($jsonData);
				echo json_encode(array("ErrorCode" => EXIT_SUCCESS, "category" => $result_category), JSON_PRETTY_PRINT);
			}catch(Exception $e) {
				$errJson = array("ErrorCode" => EXIT_DATABASE, "ErrorMessage" => $e->getMessage());
				echo json_encode($errJson, JSON_PRETTY_PRINT);
				die;
			}
		}else if($jsonData['request_type'] == INSERT_DATA){
			$result = $this->insert_category_1($jsonData);
			echo json_encode($result, JSON_PRETTY_PRINT);
		}else if($jsonData['request_type'] == REPLACE_DATA){
			$result = $this->replace_category_1($jsonData);
			echo json_encode($result, JSON_PRETTY_PRINT);
		}else if($jsonData['request_type'] == REMOVE_DATA){
			$result = $this->delete_category_1($jsonData);
			echo json_encode($result, JSON_PRETTY_PRINT);
		}else{
			$errJson = array("ErrorCode" => EXIT_USER_INPUT, "ErrorMessage" => "Undefined operation");
			echo json_encode($errJson, JSON_PRETTY_PRINT);
		}
	}




	/********************************************************************************************************
	 *
	 *                           Functionality
	 *
	 *                          Size Management  
	 *
	 *
	 *
	 *
	 **********************************************************************************************************/

	private function insert_size_mast($jsonData){
		$this->load->library('databaseClass/menu_size_mast_management', '', 'menu_size_mast_management');    
		$this->load->library('uniqueIdGenerator', '', 'uniqueIdGenerator');
		$this->load->model('menuSizeMast');
		$err_count =0;
		$curr_index =0;
		$err_index = null;

		$array_list = $jsonData['size'];
		$output_data = array();
		foreach($array_list as $elem){
			$this->menu_size_mast_management->reset_data();
			$size_id = $this->uniqueIdGenerator->getPrefixedUniqueId('CATID' . substr($jsonData['restaurant_id'], 0, 5) .  substr($elem['name'], 0, 5));

			$this->menu_size_mast_management->set_data($jsonData['restaurant_id'], $elem['size'], $size_id, $elem['name'], $elem['description']); 

			try{
				$this->menuSizeMast->add_data($this->menu_size_mast_management->get_associative_array());
				$output_data[] = array("id"=>$size_id, "ErrorCode"=>EXIT_SUCCESS, "ErrorMessage"=>"");
			}catch(Exception $e) {
				$output_data[] = array("id"=>$size_id, "ErrorCode"=>EXIT_DATABASE, "ErrorMessage"=>"Unable to add item ". $elem['name']);
				$err_count +=1;                     
				$err_index =  $err_index . ',' .$curr_index;
			}   
			$curr_index+=1;
		}   
		return array("ErrorCode" => $err_count, "ErrorIndex" =>  $err_index, "id" => $output_data);
	}

	private function delete_size_mast($jsonData){
		$this->load->library('databaseClass/menu_size_mast_management', '', 'menu_size_mast_management');    
		$this->load->model('menuSizeMast');

		$array_list = $jsonData['size'];
		$output_data = array();
		$err_count =0;
		$curr_index =0;
		$err_index = null;
		foreach($array_list as $elem){
			if($this->menuSizeMast->get_size_count($elem['id'])>0){
				$output_data[] = array("id"=>$elem['id'], "ErrorCode"=>EXIT_DATABASE, "ErrorMessage"=>"Restaurant is using this size ");
					$err_count +=1;                     
					$err_index = $err_index . ',' .$curr_index;
			}else{
				$this->menu_size_mast_management->reset_data();
				$this->menu_size_mast_management->set_primary_key($elem['id']); 

				try{
					$this->menuSizeMast->delete_data($this->menu_size_mast_management->get_primary_key());
					$output_data[] = array("id"=>$elem['id'], "ErrorCode"=>EXIT_SUCCESS, "ErrorMessage"=>"");
				}catch(Exception $e) {
					$output_data[] = array("id"=>$elem['id'], "ErrorCode"=>EXIT_DATABASE, "ErrorMessage"=>"Unable to add item ");
					$err_count +=1;                     
					$err_index =  $err_index . ',' .$curr_index;
				}  
			} 
			$curr_index+=1;
		}   
		return array("ErrorCode" => $err_count, "ErrorIndex" =>  $err_index, "id" => $output_data);  
	}

	private function replace_size_mast($jsonData){
		$this->load->library('databaseClass/menu_size_mast_management', '', 'menu_size_mast_management');    
		$this->load->model('menuSizeMast');

		$array_list = $jsonData['size'];
		$output_data = array();
		$err_count =0;
		$curr_index =0;
		$err_index = null;
		foreach($array_list as $elem){
				$this->menu_size_mast_management->reset_data();         

				$this->menu_size_mast_management->set_data($jsonData['restaurant_id'], $elem['size'], $elem['id'], $elem['name'], $elem['description']); 

				try{
					$update_detail = array();
				if(isset($elem['size']))
					$update_detail['plate_size'] = $this->menu_size_mast_management->get_value('size');
 				if(isset($elem['name']))
 					$update_detail['display_name'] = $this->menu_size_mast_management->get_value('name');  
 				if(isset($elem['description']))
 					$update_detail['description'] = $this->menu_size_mast_management->get_value('descrition'); 

 				$primary_key = $this->menu_size_mast_management->get_primary_key();

					$this->menuSizeMast->replace_data($update_detail, $primary_key);
					$output_data[] = array("id"=>$elem['id'], "ErrorCode"=>EXIT_SUCCESS, "ErrorMessage"=>"");
				}catch(Exception $e) {
					$output_data[] = array("id"=>$elem['id'], "ErrorCode"=>EXIT_DATABASE, "ErrorMessage"=>"Unable to add item ". $elem['title']);
					$err_count +=1;                     
					$err_index =  $err_index . ',' .$curr_index;
				}
			
			$curr_index+=1;
		}   
		return array("ErrorCode" => $err_count, "ErrorIndex" =>  $err_index, "id" => $output_data);
	}

	public function size_management() {
		$jsonData = json_decode(file_get_contents('php://input'), true);
		$authKey=$jsonData['access_token'];

		if($authKey=='' || $authKey == null || $authKey!=AUTH_KEY){
			$errJson = array("ErrorCode" => EXIT_USER_INPUT, "ErrorMessage" => "The access token provided is invalid");
			echo json_encode($errJson, JSON_PRETTY_PRINT);
			die;
		}          


		if($jsonData['request_type'] == SELECT_DATA){
			try{
				$this->load->model('menuSizeMast');
				$result_size = $this->menuSizeMast->get_data($jsonData);
				echo json_encode(array("ErrorCode" => EXIT_SUCCESS, "size" => $result_size), JSON_PRETTY_PRINT);
			}catch(Exception $e) {
				$errJson = array("ErrorCode" => EXIT_DATABASE, "ErrorMessage" => $e->getMessage());
				echo json_encode($errJson, JSON_PRETTY_PRINT);
				die;
			}
		}else if($jsonData['request_type'] == INSERT_DATA){
			$result = $this->insert_size_mast($jsonData);
			echo json_encode($result, JSON_PRETTY_PRINT);
		}else if($jsonData['request_type'] == REPLACE_DATA){
			$result = $this->replace_size_mast($jsonData);
			echo json_encode($result, JSON_PRETTY_PRINT);
		}else if($jsonData['request_type'] == REMOVE_DATA){
			$result = $this->delete_size_mast($jsonData);
			echo json_encode($result, JSON_PRETTY_PRINT);
		}else{
			$errJson = array("ErrorCode" => EXIT_USER_INPUT, "ErrorMessage" => "Undefined operation");
			echo json_encode($errJson, JSON_PRETTY_PRINT);
		}
	}



	/***********************************************************************************************
	 *
	 *
	 *	Functionality: Get all catalogue in one view
	 *
	 *
	 ***********************************************************************************************/
	public function get_catalogue() {
		$jsonData = json_decode(file_get_contents('php://input'), true);
		$authKey=$jsonData['access_token'];

		if($authKey=='' || $authKey == null || $authKey!=AUTH_KEY){
			$errJson = array("ErrorCode" => EXIT_USER_INPUT, "ErrorMessage" => "The access token provided is invalid");
			echo json_encode($errJson, JSON_PRETTY_PRINT);
			die;
		}


		if($jsonData['request_type'] == SELECT_DATA){
			try{
				$this->load->model('menuCuisine');
				$this->load->model('menuCategory1');
				$this->load->model('menuSizeMast');
				$result_size = $this->menuSizeMast->get_data($jsonData);
				$result_cuisine = $this->menuCuisine->get_data($jsonData);
				$result_category = $this->menuCategory1->get_data($jsonData);
				echo json_encode(array("ErrorCode" => EXIT_SUCCESS, "cuisine" => $result_cuisine, "category" => $result_category, "size" => $result_size), JSON_PRETTY_PRINT);
			}catch(Exception $e) {
				$errJson = array("ErrorCode" => EXIT_DATABASE, "ErrorMessage" => $e->getMessage());
				echo json_encode($errJson, JSON_PRETTY_PRINT);
				die;
			}
		}else{
			$errJson = array("ErrorCode" => EXIT_USER_INPUT, "ErrorMessage" => "Undefined operation");
			echo json_encode($errJson, JSON_PRETTY_PRINT);
		}
	}


	/********************************************************************************************************
	 *
	 *                           Functionality
	 *
	 *                          Add food item
	 *
	 **********************************************************************************************************/

	 private function select_restaurant_menu($jsonData)
	 {
	 	$result = array();
	 	$this->load->model('menuItemRestaurant');
	 	$this->load->model('menuPriceItem');
	 	$this->load->library('databaseClass/restaurant_menu_item', '', 'restaurant_menu_item');
	 	$this->load->library('databaseClass/restaurant_menu_price', '', 'restaurant_menu_price');
	 	$out_object = $this->menuItemRestaurant->get_data($jsonData);

	 	foreach ($out_object as $row)
		{
				$price_list = array();
				$this->restaurant_menu_item->reset_data();
		        $this->restaurant_menu_item->set_data($row['restaurant_id_pk1_fk'], $row['item_unique_id'], $row['menu_item_pk2_fk'], $row['display_content'], $row['cuisine'], $row['veg_status'], $row['sub_category_1'], $row['image_relative_url'], $row['item_sequence'], "YES");

		        $temp_result = $this->restaurant_menu_item->get_json_view();
		        $price_object = $this->menuPriceItem->get_data(array('item_id' => $row['item_unique_id']));

		        foreach ($price_object as $price_row)
				{
					$this->restaurant_menu_price->reset_data();
		        	$this->restaurant_menu_price->set_data($price_row['size_id'], $price_row['price'], $row['item_unique_id']);
		        	$price_list[] =  $this->restaurant_menu_price->get_associative_array();

				}

		        $temp_result['price_list'] = $price_list;
		        $result[] = $temp_result;
		}

		return $result;
	 } 


	 private function insert_restaurant_menu($jsonData){
	 	$this->load->model('menuItemRestaurant');
	 	$this->load->model('menuPriceItem');
	 	$this->load->library('databaseClass/restaurant_menu_item', '', 'restaurant_menu_item');
	 	$this->load->library('databaseClass/restaurant_menu_price', '', 'restaurant_menu_price');

		$this->load->helper('file');
		$this->load->helper('url');
		$this->load->library('uniqueIdGenerator', '', 'uniqueIdGenerator');

		$err_count =0;
		$curr_index =0;
		$err_index = null;

		$array_list = $jsonData['menu_list'];
		$output_data = array();

		foreach($array_list as $elem){
			$this->restaurant_menu_item->reset_data();
			$image_path=null;
			$image_path_name = null;
			$image_ext = null;
			$temp_error_code = EXIT_SUCCESS;
			$temp_error_message = null;

			$item_id = $this->uniqueIdGenerator->getPrefixedUniqueId('MNITM' . substr($jsonData['restaurant_id'], 0, 5) .  substr($elem['item_name'], 0, 10));

			try{
				if(isset($elem['image'])){
					$image_path = BASE_IMAGE_PATH . "/". $jsonData['restaurant_id'] . "/" . "menu_item" . "/";	
					$image_ext = IMAGE_TYPE_ALLOWED;
					$image_path_name = $image_path.$item_id. "." . $image_ext;
					$elem['image'] = str_replace(IMAGE_PREFIX, "", $elem['image']);
					$decoded=base64_decode($elem['image']);

					if ( file_put_contents($image_path_name , $decoded) == "false")
					{
						$temp_error_code = EXIT_USER_INPUT;
						$temp_error_message = "and Unable to uplaod image for item " . $elem['title'];
						$err_count +=1;                     
						$err_index =  $err_index . ',' .$curr_index;                     
					}
				}

				$this->restaurant_menu_item->set_value('restaurant_id', $elem['restaurant_id']);
				$this->restaurant_menu_item->set_value('item_id', $item_id);
				$this->restaurant_menu_item->set_value('item_name', $elem['item_name']);
				$this->restaurant_menu_item->set_value('content', $elem['content']);
				$this->restaurant_menu_item->set_value('cuisine_id', $elem['cuisine_id']);
				$this->restaurant_menu_item->set_value('veg_status', $elem['veg_status']);
				$this->restaurant_menu_item->set_value('category_1_id', $elem['category_1_id']);
				$this->restaurant_menu_item->set_value('image_url', $image_path_name);
				$this->restaurant_menu_item->set_value('item_sequence', $elem['item_sequence']);
				$this->restaurant_menu_item->set_value('availability', $elem['availability']);

				$this->menuItemRestaurant->add_data($this->restaurant_menu_item->get_array_add());


				foreach($elem['price_list'] as $price_elem){
					$this->restaurant_menu_price->reset_data();
					$this->restaurant_menu_price->set_value('size_id', $price_elem['size_id']);
					$this->restaurant_menu_price->set_value('item_id', $price_elem['item_id']);
					$this->restaurant_menu_price->set_value('price', $price_elem['price']);

					$this->menuPriceItem->add_data($this->restaurant_menu_price->get_array_add());
				}
				$output_data[] = array("id"=>$elem['id'], "image_url"=> KRAZYTABLE_URL.$image_path_name, "ErrorCode"=>$temp_error_code, "ErrorMessage"=>$temp_error_message);
			}catch(Exception $e) {
				$output_data[] = array("id"=>$item_id, "ErrorCode"=>EXIT_DATABASE, "ErrorMessage"=>"Details not upladed for ". $elem['item_name'] . $temp_error_message);
				$err_count +=1;                     
				$err_index =  $err_index . ',' .$curr_index;
				if(isset($elem['image'])){
					try{
						delete_files($image_path_name);
					}catch (Exception $e){
						null;
					}
				}
			}   
			$curr_index+=1;
		}   
		return array("ErrorCode" => $err_count, "ErrorIndex" =>  $err_index, "id" => $output_data);
	}


	private function replace_restaurant_menu($jsonData){
		$this->load->model('menuItemRestaurant');
	 	$this->load->model('menuPriceItem');
	 	$this->load->library('databaseClass/restaurant_menu_item', '', 'restaurant_menu_item');
	 	$this->load->library('databaseClass/restaurant_menu_price', '', 'restaurant_menu_price');

		$array_list = $jsonData['menu_list'];
		$output_data = array();
		$err_count =0;
		$curr_index =0;
		$err_index = null;
		$image_ext = IMAGE_TYPE_ALLOWED;

		foreach($array_list as $elem){
			$this->restaurant_menu_item->reset_data();
			$image_path=null;
			$image_path_name = null;           
			$temp_error_message = null; 
			$temp_error_code = NULL;

			try{

				if(isset($elem['image'])){

					$elem['image'] = str_replace(IMAGE_PREFIX, "", $elem['image']);
					
					$image_path = BASE_IMAGE_PATH . "/". $jsonData['restaurant_id'] . "/";	
					$image_ext = IMAGE_TYPE_ALLOWED;
					$image_path_name = $image_path.$elem['id']. "." . $image_ext;

					$elem['image'] = str_replace(IMAGE_PREFIX, "", $elem['image']);
					
					$decoded=base64_decode($elem['image']);

					if ( file_put_contents($image_path_name , $decoded) == "false")
					{
						$temp_error_code = EXIT_USER_INPUT;
						$temp_error_message = "Unable to update image for item " . $elem['title'];
						$err_count +=1;                     
						$err_index =  $err_index . ',' .$curr_index;                     
					}
				}

				$this->restaurant_menu_item->set_value('restaurant_id', $elem['restaurant_id']);
				$this->restaurant_menu_item->set_value('item_id', $item_id);

				if(isset($elem['item_name']))
					$this->restaurant_menu_item->set_value('item_name', $elem['item_name']);
				if(isset($elem['content']))
					$this->restaurant_menu_item->set_value('content', $elem['content']);
				if(isset($elem['cuisine_id']))
					$this->restaurant_menu_item->set_value('cuisine_id', $elem['cuisine_id']);
				if(isset($elem['veg_status']))
					$this->restaurant_menu_item->set_value('veg_status', $elem['veg_status']);
				if(isset($elem['category_1_id']))
					$this->restaurant_menu_item->set_value('category_1_id', $elem['category_1_id']);
				if(isset($elem['image']))
					$this->restaurant_menu_item->set_value('image_url', $image_path_name);
				if(isset($elem['item_sequence']))
					$this->restaurant_menu_item->set_value('item_sequence', $elem['item_sequence']);
				if(isset($elem['availability']))
					$this->restaurant_menu_item->set_value('availability', $elem['availability']);

				$this->menuItemRestaurant->replace_data($this->restaurant_menu_item->get_array_update(), $this->restaurant_menu_item->get_primary_key());


				foreach($elem['price_list'] as $price_elem){
					$this->restaurant_menu_price->reset_data();

					if(isset($price_elem['size_id']))
						$this->restaurant_menu_price->set_value('size_id', $price_elem['size_id']);
					if(isset($price_elem['item_id']))
						$this->restaurant_menu_price->set_value('item_id', $price_elem['item_id']);
					if(isset($price_elem['price']))
						$this->restaurant_menu_price->set_value('price', $price_elem['price']);

					$this->menuPriceItem->replace_data($this->restaurant_menu_price->get_array_update(), $this->restaurant_menu_price->get_primary_key());
				}

				if(isset($elem['image']))
					$output_data[] = array("id"=>$elem['id'], "image_url"=> KRAZYTABLE_URL.$image_path_name, "ErrorCode"=>$temp_error_code, "ErrorMessage"=>$temp_error_message);
				else
					$output_data[] = array("id"=>$elem['id'], "ErrorCode"=>$temp_error_code, "ErrorMessage"=>$temp_error_message);
				
			}catch(Exception $e) {
				$output_data[] = array("id"=>$elem['id'], "ErrorCode"=>EXIT_DATABASE, "ErrorMessage"=>"Unable to update menu ". $elem['title']);
				$err_count +=1;                     
				$err_index =  $err_index . ',' .$curr_index;
				if(isset($elem['image'])){
                                        try{
                                                delete_files($image_path_name);
                                        }catch (Exception $e){
                                                null;
                                        }
                                }
			}  
			$curr_index+=1;
		}   
		return array("ErrorCode" => $err_count, "ErrorIndex" =>  $err_index, "id" => $output_data);

	}

	private function delete_restaurant_menu($jsonData){
		$this->load->model('menuItemRestaurant');
	 	$this->load->model('menuPriceItem');
	 	$this->load->library('databaseClass/restaurant_menu_item', '', 'restaurant_menu_item');
	 	$this->load->library('databaseClass/restaurant_menu_price', '', 'restaurant_menu_price');
    
		$this->load->helper('file');

		$array_list = $jsonData['menu_list'];
		$output_data = array();
		$err_count =0;
		$curr_index =0;
		$err_index = null;
		$image_ext = null;

		foreach($array_list as $elem){
			$this->restaurant_menu_item->reset_data();
			$image_path = BASE_IMAGE_PATH . "/". $jsonData['restaurant_id'] . "/";	
			$image_ext = IMAGE_TYPE_ALLOWED;
			$image_path_name = $image_path.$elem['id']. "." . $image_ext;


			$this->restaurant_menu_item->set_primary_key($elem['id']); 

			try{
				$this->menuCuisine->delete_data($this->restaurant_menu_item->get_primary_key());
				$output_data[] = array("id"=>$elem['id'], "ErrorCode"=>EXIT_SUCCESS, "ErrorMessage"=>"");

				/** delete image file from server **/
				delete_files($image_path_name);
			}catch(Exception $e) {
				$output_data[] = array("id"=>$elem['id'], "ErrorCode"=>EXIT_DATABASE, "ErrorMessage"=>"Unable to delete item ");
				$err_count +=1;                     
				$err_index =  $err_index . ',' .$curr_index;
			}   
			$curr_index+=1;
		}   
		return array("ErrorCode" => $err_count, "ErrorIndex" =>  $err_index, "id" => $output_data);  
	}

     public function food_item_management() {
		$jsonData = json_decode(file_get_contents('php://input'), true);
		$authKey=$jsonData['access_token'];

		if($authKey=='' || $authKey == null || $authKey!=AUTH_KEY){
			$errJson = array("ErrorCode" => EXIT_USER_INPUT, "ErrorMessage" => "The access token provided is invalid");
			echo json_encode($errJson, JSON_PRETTY_PRINT);
			die;
		}          


		if($jsonData['request_type'] == SELECT_DATA){
			$result_size = $this->select_restaurant_menu($jsonData);
			echo json_encode(array("ErrorCode" => EXIT_SUCCESS, "menu_list" => $result_size), JSON_PRETTY_PRINT);
		}else if($jsonData['request_type'] == INSERT_DATA){
			$result = $this->insert_restaurant_menu($jsonData);
			echo json_encode($result, JSON_PRETTY_PRINT);
		}else if($jsonData['request_type'] == REPLACE_DATA){
			$result = $this->replace_restaurant_menu($jsonData);
			echo json_encode($result, JSON_PRETTY_PRINT);
		}else if($jsonData['request_type'] == REMOVE_DATA){
			$result = $this->delete_restaurant_menu($jsonData);
			echo json_encode($result, JSON_PRETTY_PRINT);
		}else{
			$errJson = array("ErrorCode" => EXIT_USER_INPUT, "ErrorMessage" => "Undefined operation");
			echo json_encode($errJson, JSON_PRETTY_PRINT);
		}
	}

}

