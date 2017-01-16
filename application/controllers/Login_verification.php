<?php  
#header('Content-Type: application/json');
#json for login
/**
  {
  "username": "name",
  "password": "password"
  }

**/


class Login_verification extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('verifyCredentials');
		$this->load->library('uniqueIdGenerator', '', 'uniqueIdGenerator');
	}

	public function index(){
		show_404();
	}


	public function login(){
		$username=$this->input->get_post('login_username');
		$password=$this->input->get_post('password');
		$row = null;
		if($username=='' || $username==null || $password=='' || $password==null){
			$data = "Empty input";
			echo $data;
			return;
		}

		$value = array();

		$value[] = $username;
		$value[] = $password;

		try{
			$row = $this->verifyCredentials->restaurantLogin($username, $password);
		} catch(Exception $e){
			$data = $e->getMessage();
			echo $data;
			return;
		}
		$data = "Successful login";
		session_start();
		$_SESSION['username'] = $row['username'];
		echo $data;

	}

	public function restaurant_login(){
		$jsonData = json_decode(file_get_contents('php://input'), true);
                $authKey=$jsonData['access_token'];

                $value = array();
                $value['username']=  $jsonData['username'];
                $value['password']=  $jsonData['password'];

                $result = null;

                try{
                        $result = $this->verifyCredentials->restaurantLogin($value);
                } catch(Exception $e) {
                        $errJson = array("ErrorCode" => EXIT_DATABASE, "ErrorMessage" => $e->getMessage());
                        echo json_encode($errJson, JSON_PRETTY_PRINT);
                        die;
                }

                echo json_encode($result, JSON_PRETTY_PRINT);
                die;

	}

	public function customer_login(){
                $jsonData = json_decode(file_get_contents('php://input'), true);
                $authKey=$jsonData['access_token'];

                $value = array();
                $value['username']=  $jsonData['username'];
                $value['password']=  $jsonData['password'];

                $result = null;

                try{
                        $result = $this->verifyCredentials->customerLogin($value);
                } catch(Exception $e) {
                        $errJson = array("ErrorCode" => EXIT_DATABASE, "ErrorMessage" => $e->getMessage());
                        echo json_encode($errJson, JSON_PRETTY_PRINT);
                        die;
                }

                echo json_encode($result, JSON_PRETTY_PRINT);
                die;

        }
}

