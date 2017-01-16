<?php 

class Get_content extends CI_Controller{

	public function index(){
		$siteaddressAPI = "http://localhost/index.php/blog/noindex";
		$dataJson = file_get_contents($siteaddressAPI);
		$data = json_decode($dataJson, true);

		echo count($data['itemList']);
		echo $data['itemList'][0]['imageUrl'];
	}
}	
