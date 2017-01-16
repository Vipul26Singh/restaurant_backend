<?php 
header('Content-Type: application/json');
class Blog extends CI_Controller {

	public function content_order()
	{
		$this->load->helper('url_helper');

		$formatted = array(
			'imageUrl' => "image1",
			'title' => "title1",
			'price' => 2000.00,
			'quantity' => 1.5
		);

		$appended = array();
		$appended[] = $formatted;


		$formatted = array(
                        'imageUrl' => "image2",
                        'title' => "title2",
                        'price' => 1200.00,
                        'quantity' => 1
                );


		$appended[] = $formatted;

		$complete = array(
			'restaurantId' => 101,
			'totalQty' => 4.5,
			'totalPrice' => 6000.00,
			'customerId' => "customerId",
			'itemList' => $appended
		);

			echo json_encode($complete, JSON_PRETTY_PRINT);

	}

	public function register()
        {
                $this->load->helper('url_helper');
		echo base_url("");
                $complete = array(
			"firstName" => "name",
			"middleName" => "name",
			"lastName" => "name",
			"mobile" => 1234567890,
			"email" => "email@gmail.com",
			"userName" => "Username",
			"password" => "password"
                );

                        echo json_encode($complete, JSON_PRETTY_PRINT);

        }
}
