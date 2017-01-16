<?php  
#header('Content-Type: application/json');
class Manage_newsletter extends CI_Controller {
		
	public function __construct()
        {
                parent::__construct();
				$this->load->model('newsletterManagement');
				$this->load->helper('email');
        }

	public function index(){
		show_404();
	}


	public function subscribe(){

		$customer_email=$this->input->get_post('email_id');

		if($customer_email =='' || $customer_email == null || !valid_email($customer_email)){
				$data['message'] = "Invalid Email Id";
				$this->load->view('newsletterview', $data);
				return;
		}

		try{
			$this->newsletterManagement->subscribe($customer_email);
		} catch(Exception $e){
			$data['message'] = $e->getMessage();
			$this->load->view('newsletterview', $data);
			return;
		}
        $data['message'] = "Subscribed Successfully!!";
		$this->load->view('newsletterview', $data);
	}

	public function unsubscribe(){

		$customer_email=$this->input->get_post('email_id');

		if($customer_email =='' || $customer_email == null || !valid_email($customer_email)){
				$data['message'] = "Invalid Email Id";
				$this->load->view('newsletterview', $data);
				return;
		}

		try{
			$this->newsletterManagement->unsubscribe($customer_email);
		} catch(Exception $e){
			$data['message'] = $e->getMessage();
			$this->load->view('newsletterview', $data);
			return;
		}
        $data['message'] = "Unsubscribed!!";
		$this->load->view('newsletterview', $data);
	}
}
	
