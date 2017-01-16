<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SendMailLibrary{

	public function sendMail($receiverMailId, $receiverName, $subject, $message){
		$url = KRAZYTABLE_URL . 'mailer/examples/smtp.php' ;
		$data = array('receiverMailId' => $receiverMailId, 'receiverName' => $receiverName, 'subject' => $subject, 'message' => $message, 'mailAccessCode' => 'ACCESSEAIL-5743e94b8a4c0157502066');

		$options = array(
				'http' => array(
					'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
					'method'  => 'POST',
					'content' => http_build_query($data)
					)
				);

		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context); 

		$pos = strpos($result, "Mailer Error");		

		if($pos === false){
			return "Message Sent!";	
		}else{
			throw new Exception(substr($result, $pos));
		}	
	}
}
