<?php  
#header('Content-Type: application/json');

#curl http://localhost/krazytable_api/index.php/mail_sending_api/process_contact_us -H "Content-Type: application/json" -X POST -d '{"sender":"Vipul Singh", "email":"vipul26singh1992@gmail.com", "access_token":"Auth-57419670a71b8491911330", "mobile":"9717077728", "query":"I am trying to test contact us API. Please let me know if you have received this mail."}'

class Mail_sending_api extends CI_Controller {
		
	public function __construct()
        {
                parent::__construct();
		$this->load->library('uniqueIdGenerator', '', 'uniqueIdGenerator');
                $this->load->library('sendMailLibrary', '', 'sendMailLibrary');
        }

	public function index(){
		show_404();
	}

	public function process_contact_us(){
	
            	$jsonData = json_decode(file_get_contents('php://input'), true); 

                $authKey=$jsonData['access_token'];
                
		if($authKey=='' || $authKey == null || $authKey!=AUTH_KEY){
			$errJson = array("ErrorCode" => EXIT_USER_INPUT, "ErrorMessage" => "The access token provided is invalid");
			echo json_encode($errJson, JSON_PRETTY_PRINT);
                        die;
                }
		

                $senderName=  $jsonData['senderName'];
                $senderEmail=  $jsonData['email'];
		$senderMobile = $jsonData['mobile'];
		$message = $jsonData['query'];
		$messageId =  $this->uniqueIdGenerator->getPrefixedUniqueId('MSGID');

                try{
			$subject = 'Message Id = ' . $messageId . ' Sender = '  . $senderName . ' ' . $senderMobile . ' ' . $senderEmail;
			$this->sendMailLibrary->sendMail('team@krazytable.in', 'Krazy Table', $subject, $message);
			echo "sended";
                } catch(Exception $e) {
                        $errJson = array("ErrorCode" => EXIT_ERROR, "ErrorMessage" => $e->getMessage());
                        echo json_encode($errJson, JSON_PRETTY_PRINT);
                        die;
                }


		try{
                        $subject = 'Thank you for contacting Krazy Table';
			$confiramationMessage =  "Your message is delivered successfully to Krazy Table. Your message id is " . $messageId . " Please let us know at team@krazyatble.in, if you are not intended receiptent";
                        $this->sendMailLibrary->sendMail($senderEmail, $senderName, $subject, $confiramationMessage);
                } catch(Exception $e) {
                        $errJson = array("ErrorCode" => EXIT_ERROR, "ErrorMessage" => $e->getMessage());
                        echo json_encode($errJson, JSON_PRETTY_PRINT);
                        die;
                }
		
		$errJson = array("ErrorCode" => EXIT_SUCCESS, "ErrorCode" => "Mail delivered successfully");
                echo json_encode($errJson, JSON_PRETTY_PRINT);
		
		die;
	}

}
	
