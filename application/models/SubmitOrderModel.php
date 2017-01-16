<?php
	class SubmitOrderModel extends CI_Model
	{
		
		function __construct()
		{
			$this->load->database('krazytable');
			$this->load->helper('date');
		}
		function insert($data,$table)
		{
			if(!$this->db->insert($table, $data))
			{
				$error = $this->db->error();
				throw new Exception($error['message'],$error['code']);
			}
		}
		function detailOrder($orderId,$val)
		{
			$cost = 0;
			if($val['largecount'])
				{
						$data_large = array(
							'order_id_pk1_fk' => $orderId,
							'plate_size' => "large",
							'quantity' => $val['largecount'],
							'raw_cost' => $val['largeprice'],
							'item_pk2_fk' => $val['itemId'],
							'status' => 'pending'
						);
						$this->db->set('order_time', 'NOW()', FALSE);
						$cost = $cost + ($val['largeprice']*$val['largecount']);
						$this->insert($data_large, "tbl_detail_order");
				}
				if($val['mediumcount'])
				{
						$data_medium = array(
							'order_id_pk1_fk' => $orderId,
							'plate_size' => "medium",
							'quantity' => $val['mediumcount'],
							'raw_cost' => $val['mediumprice'],
							'item_pk2_fk' => $val['itemId'],
							'status' => 'pending'
						);
						$cost =$cost + ($val['mediumprice']*$val['mediumcount']);
						$this->db->set('order_time', 'NOW()', FALSE);
						$this->insert($data_medium, "tbl_detail_order");
				}
				if($val['smallcount'])
				{
						$data_small = array(
							'order_id_pk1_fk' => $orderId,
							'plate_size' => "small",
							'quantity' => $val['smallcount'],
							'raw_cost' => $val['smallprice'],
							'item_pk2_fk' => $val['itemId'],
							'status' => 'pending'
						);
						$cost  = $cost + ($val['smallprice']*$val['smallcount']);
						$this->db->set('order_time', 'NOW()', FALSE);
						$this->insert($data_small, "tbl_detail_order");
				}
				return $cost;
		}
		function placeOrderOld($value)
		{
			$cost = 0;
			foreach ($value['orderList'] as $val) {
				$cost = $cost + $this->detailOrder($value['orderId'],$val);
			}
		}
		function placeOrderNew($value)
		{
			$data = array(
					'customer_id_fk' => $value['customerId'],
					'restaurant_id_fk' => $value['restaurantId'],
					'order_id_pk' => $value['orderId'],
					'order_status' => $value['status'],
					'order_type' => $value['type'],
					'requirement_time' => null,
					'delivery_time' => null
					);
			$this->db->set('booking_time', 'NOW()', FALSE);
			
			$this->insert($data, "tbl_mast_order");

			$cost = 0;
			foreach ($value['orderList'] as $val) {
				$cost = $cost + $this->detailOrder($value['orderId'],$val);
			}


			$data_invoice = array(
					"invoice_no_pk" => $value['invoiceId'],
					"customer_id_fk" => $value['customerId'],
					'order_id_fk' => $value['orderId'],
					"total_raw_cost" => $cost,
					"invoice_status" => 'init'
				);
			$this->db->set('invoice_date', 'NOW()', FALSE);
			$this->insert($data_invoice, "tbl_detail_order_invoice");
		}
	}
?>

