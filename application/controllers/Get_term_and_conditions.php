<?php  
#header('Content-Type: application/json');
class Get_term_and_conditions extends CI_Controller {
		
	public function __construct()
        {
                parent::__construct();
        }

	public function index(){
		show_404();
	}

	public function table_app(){
		$jsonData = json_decode(file_get_contents('php://input'), true);


                $authKey=$jsonData['access_token'];

                if($authKey=='' || $authKey == null || $authKey!=AUTH_KEY){

                        $errJson = array("ErrorCode" => EXIT_USER_INPUT, "ErrorMessage" => "The access token provided is invalid");
                        echo json_encode($errJson, JSON_PRETTY_PRINT);
                        die;
                }

		$term = '<html><h1>Krazy Table Terms of Service</h1><h2>Welcome to Krazy Table!</h2><p>Thanks for using our products and services . The Services are provided by Krazy Table.<p>By using our Services, you are agreeing to these terms. Please read them carefully.</p>Our Services are very diverse, so sometimes additional terms or product requirements (including age requirements) may apply. Additional terms will be available with the relevant Services, and those additional terms become part of your agreement with us if you use those Services.<h2>Using our Services</h2><p>You must follow any policies made available to you within the Services.<p>Don’t misuse our Services. For example, don’t interfere with our Services or try to access them using a method other than the interface and the instructions that we provide. You may use our Services only as permitted by law, including applicable export and re-export control laws and regulations. We may suspend or stop providing our Services to you if you do not comply with our terms or policies or if we are investigating suspected misconduct.<p>Using our Services does not give you ownership of any intellectual property rights in our Services or the content you access. You may not use content from our Services unless you obtain permission from its owner or are otherwise permitted by law. These terms do not grant you the right to use any branding or logos used in our Services. Don’t remove, obscure, or alter any legal notices displayed in or along with our Services.<p>Our Services display some content that is not Krazytable’s. This content is the sole responsibility of the entity that makes it available. We may review content to determine whether it is illegal or violates our policies, and we may remove or refuse to display content that we reasonably believe violates our policies or the law. But that does not necessarily mean that we review content, so please don’t assume that we do.
<p>In connection with your use of the Services, we may send you service announcements, administrative messages, and other information. You may opt out of some of those communications.<p>Some of our Services are available on mobile devices. Do not use such Services in a way that distracts you and prevents you from obeying traffic or safety laws.</html>';	
		$json_array = array("<html>" => $term);
		echo json_encode($json_array);
	}

}
	
