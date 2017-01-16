<?php 
class Min_list_files extends CI_Controller {

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

	public function list_file()
        {
                $this->load->helper('directory');
		$this->load->helper('url');
		$map = directory_map('./min/img/');
		print_r($map);
        }

	public function resize_image(){
		$config['image_library'] = 'gd2';
$config['source_image'] = './min/img/prestashop-avatar.png';
$config['create_thumb'] = TRUE;
	//$config['quality'] = '50%';

$this->load->library('image_lib', $config);
		if ( ! $this->image_lib->resize())
		{
        		echo $this->image_lib->display_errors();
		}
	}

	public function get_info(){
		echo phpinfo();
	}
}
