<?php  
#header('Content-Type: application/json');
#json for login
/**
  {
  "username": "name",
  "password": "password"
  }

 **/


class Load_pricing_quote extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('loadPricingQuote');
		$this->load->library('uniqueIdGenerator', '', 'uniqueIdGenerator');
	}

	public function index(){
		show_404();
	}


	public function load(){
		$value = array();
		$value['firstName']=$this->input->get_post('first_name');
		$value['lastName']=$this->input->get_post('last_name');
		$value['email_id']=$this->input->get_post('email');
		$value['mobile_no']=$this->input->get_post('phone');
		$value['address']=$this->input->get_post('address');
		$value['city']=$this->input->get_post('city');
		$value['state']=$this->input->get_post('state');
		$value['zip']=$this->input->get_post('zip');
		$value['website']=$this->input->get_post('website');
		$value['billing_exist']=$this->input->get_post('hosting');
		$value['queries']=$this->input->get_post('comment');
		$value['uniqueId']=$this->uniqueIdGenerator->getPriceQuoteId($value['mobile_no']);


		log_message('debug', $value['firstName']);

		try{
			$this->loadPricingQuote->addQuote($value);
		} catch(Exception $e){
			$data = $e->getMessage();
			echo $data;
			return;
		}
		$data = 'Hi, '. $value['firstName']. ' , Your quotation id is '. $value['uniqueId'];
		echo $data;
	}
}

