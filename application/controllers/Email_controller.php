<?php 
   class Email_controller extends CI_Controller { 
 
      function __construct() { 
         parent::__construct(); 
         $this->load->library('session'); 
         $this->load->helper('form'); 
      } 
		
      public function index() { 
	
         $this->load->helper('form'); 
         $this->load->view('email_form'); 
      } 
  
      public function send_mail() { 
         $from_email = "vipul26singh@yahoo.com"; 
         $to_email = $this->input->post('vipul26singh1992@gmail.com'); 
   
         //Load email library 
         $this->load->library('email'); 
   
         $this->email->from($from_email, 'vipul26singh@yahoo.com'); 
         $this->email->to($to_email);
         $this->email->subject('Email Test'); 
         $this->email->message('Testing the email class.'); 
   
         //Send mail 
         if($this->email->send()) 
         	echo "Email sent successfully."; 
         else 
         	echo "Error in sending Email."; 
      } 
   } 
?>
