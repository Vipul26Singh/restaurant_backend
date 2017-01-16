<?php
class AdminModel extends CI_Model
	{
		
		function __construct()
		{
			$this->load->database('krazytable');
			$this->load->helper('date');
		}
		function action($query,$data)
		{
			$query_result = $this->db->query($query, $data);
			if(!$query_result)
			{
				$error = $this->db->error();
				throw new Exception($error['message'],$error['code']);
			}
			else
			{
				return $query_result;
			}
		}
		function login($value)
		{
			$restaurant_unique_id_pk = null;
			if(empty($value['username']) || $value['username'] == null || $value['username'] == '' )
			{
				$query = "SELECT `restaurant_unique_id_pk` FROM `tbl_mast_restaurant` WHERE restaurant_email_id = ? AND password = ?";
				$data = array($value['restaurant_email_id'],$value['password']);
				$restaurant_unique_id_pk = $this->action($query,$data)->row()->restaurant_unique_id_pk;
			}
			else
			{
				$query = "SELECT `restaurant_unique_id_pk` FROM `tbl_mast_restaurant` WHERE username = ? AND password = ?";
				$data = array($value['username'],$value['password']);
				$restaurant_unique_id_pk = $this->action($query,$data)->row()->restaurant_unique_id_pk;
			}
			if($restaurant_unique_id_pk == null)
			{
				throw new Exception("No rows returned",EXIT_USER_INPUT);
			}
			return $restaurant_unique_id_pk;
		}

		function current_order_progress($value)
		{
			$query = "SELECT first_name, surname, email_id, booking_time, requirement_time, order_status FROM tbl_mast_order, tbl_mast_customer WHERE tbl_mast_order.restaurant_id_fk = ? AND tbl_mast_order.customer_id_fk = tbl_mast_customer.customer_id_pk AND (order_status = 'NEW' OR order_status = 'PROCESSING') order by `booking_time` desc";
			$data = array($value['restaurantId']);
			$result = $this->action($query,$data);
			$output = array();
			foreach ($result->result() as $row) 
			{
				$entry = array('first_name' => $row->first_name,"surname" => $row->surname,"email_id" => $row->email_id );
				$entry['booking_time'] = $row->booking_time;
				$entry['requirement_time'] = $row->requirement_time;
				$entry['order_status'] = $row->order_status;
				array_push($output, $entry);
			}
			return $output;
		}

		function current_orders($value)
		{
			$query = "SELECT order_id_pk, first_name, surname, booking_time, order_status,item_pk2_fk,quantity,raw_cost, plate_size FROM tbl_mast_order, tbl_mast_customer,tbl_detail_order WHERE tbl_mast_order.restaurant_id_fk = ? AND tbl_mast_order.customer_id_fk = tbl_mast_customer.customer_id_pk AND tbl_mast_order.order_id_pk = tbl_detail_order.order_id_pk1_fk AND (order_status = 'NEW' OR order_status = 'PROCESSING') order by order_id_pk, booking_time DESC";
			$data = array($value['restaurantId']);
			$result = $this->action($query,$data);
			$output = array();
			$order_id = null;
			$entry = array('itemList' => array());
			foreach ($result->result() as $row) 
			{
				if($order_id == null)
				{
					$order_id = $row->order_id_pk;
					$entry['first_name']=$row->first_name;
					$entry["surname"] = $row->surname ;
					$entry['booking_time'] = $row->booking_time;	
					$itemDetail = array();
					$itemDetail['itemName'] = $row->item_pk2_fk;
					$itemDetail['quantity'] = $row->quantity;
					$itemDetail['raw_cost'] = $row->raw_cost;
					$itemDetail['plate_size'] = $row->plate_size;
					array_push($entry['itemList'], $itemDetail);
				}
				else
				{
					if($order_id != $row->order_id_pk)
					{
						$order_id = $row->order_id_pk;
						array_push($output , $entry);
						$entry = array('itemList' => array());
						$entry['first_name']=$row->first_name;
						$entry["surname"] = $row->surname ;
						$entry['booking_time'] = $row->booking_time;	
						$itemDetail = array();
						$itemDetail['itemName'] = $row->item_pk2_fk;
						$itemDetail['quantity'] = $row->quantity;
						$itemDetail['raw_cost'] = $row->raw_cost;
						$itemDetail['plate_size'] = $row->plate_size;
						array_push($entry['itemList'], $itemDetail);
					}
					else
					{
						$itemDetail = array();
						$itemDetail['itemName'] = $row->item_pk2_fk;
						$itemDetail['quantity'] = $row->quantity;
						$itemDetail['raw_cost'] = $row->raw_cost;
						$itemDetail['plate_size'] = $row->plate_size;
						array_push($entry['itemList'], $itemDetail);
					}
				}
			}
			array_push($output, $entry);
			return $output;
		}

		function invoice_details($value)
		{
			$query = "SELECT invoice_no_pk,total_raw_cost, total_discount,total_tax , billed_amount FROM tbl_mast_order, tbl_detail_order_invoice WHERE tbl_mast_order.restaurant_id_fk = ? AND tbl_mast_order.order_id_pk = tbl_detail_order_invoice.order_id_fk AND (invoice_status = 'INIT' OR invoice_status ='PROCESSING' OR invoice_status = 'PARTIAL DONE' OR 'FAIL') order by invoice_date DESC";
			$data = array($value['restaurantId']);
			$result = $this->action($query,$data);
			$output = array();
			foreach ($result->result() as $row) 
			{
				$entry = array();
				$entry['invoiceNo'] = $row->invoice_no_pk;
				$entry['total_raw_cost'] = $row->total_raw_cost;
				$entry['total_bill'] = $row->billed_amount;
				$entry['total_discount'] = $row->total_discount;
				$entry['total_tax'] = $row->total_tax;
				array_push($output, $entry);
			}
			return $output;
		}
		function current_orders_restCustomer($value)
		{
			$query = "SELECT order_id_pk, first_name, surname, booking_time, order_status,item_pk2_fk,quantity,raw_cost, plate_size FROM tbl_mast_order, tbl_mast_customer,tbl_detail_order WHERE tbl_mast_order.restaurant_id_fk = ? AND tbl_mast_order.customer_id_fk = ? AND tbl_mast_order.customer_id_fk = tbl_mast_customer.customer_id_pk AND tbl_mast_order.order_id_pk = tbl_detail_order.order_id_pk1_fk AND (order_status = 'NEW' OR order_status = 'PROCESSING') order by order_id_pk, booking_time DESC";
			$data = array($value['restaurantId'],$value['customerId']);
			$result = $this->action($query,$data);
			$output = array();
			$order_id = null;
			$entry = array('itemList' => array());
			foreach ($result->result() as $row) 
			{
				if($order_id == null)
				{
					$order_id = $row->order_id_pk;
					$entry['first_name']=$row->first_name;
					$entry["surname"] = $row->surname ;
					$entry['booking_time'] = $row->booking_time;	
					$itemDetail = array();
					$itemDetail['itemName'] = $row->item_pk2_fk;
					$itemDetail['quantity'] = $row->quantity;
					$itemDetail['raw_cost'] = $row->raw_cost;
					$itemDetail['plate_size'] = $row->plate_size;
					array_push($entry['itemList'], $itemDetail);
				}
				else
				{
					if($order_id != $row->order_id_pk)
					{
						$order_id = $row->order_id_pk;
						array_push($output , $entry);
						$entry = array('itemList' => array());
						$entry['first_name']=$row->first_name;
						$entry["surname"] = $row->surname ;
						$entry['booking_time'] = $row->booking_time;	
						$itemDetail = array();
						$itemDetail['itemName'] = $row->item_pk2_fk;
						$itemDetail['quantity'] = $row->quantity;
						$itemDetail['raw_cost'] = $row->raw_cost;
						$itemDetail['plate_size'] = $row->plate_size;
						array_push($entry['itemList'], $itemDetail);
					}
					else
					{
						$itemDetail = array();
						$itemDetail['itemName'] = $row->item_pk2_fk;
						$itemDetail['quantity'] = $row->quantity;
						$itemDetail['raw_cost'] = $row->raw_cost;
						$itemDetail['plate_size'] = $row->plate_size;
						array_push($entry['itemList'], $itemDetail);
					}
				}
			}
			array_push($output, $entry);
			return $output;
		}
		function ratings($value)
		{
		$query = "SELECT * FROM `tbl_detail_item_rating` WHERE `restaurant_id_pk_fk` = ? order by `transation_time` desc ";
		$data = array($value['restaurantId']);
		$result = $this->action($query,$data);
		$output = array();
		foreach ($result->result() as $row) 
			{
			$entry = array();
			$entry['itemName'] = $row->order_item_pk_fk;
			$entry['rating_given'] = $row->rating_given;
			$entry['comments_given'] = $row->comments_given;
			$new_query = "SELECT * FROM `tbl_mast_customer` WHERE `customer_id_pk` = ?";
			$new_data = array($row->customer_id_pk_fk);
			$customer = $this->action($new_query,$new_data)->row();
			$entry['first_name'] = $customer->first_name;
			$entry["surname"] = $customer->surname ;
			array_push($output, $entry);
			}
		return $output;
		}

		function get_current_order($value)
		{
			$query = "SELECT first_name, surname,invoice_no_pk,billed_amount,table_no_fk FROM tbl_mast_order, tbl_mast_customer,tbl_detail_order_invoice WHERE tbl_mast_order.restaurant_id_fk = ? AND tbl_mast_order.customer_id_fk = tbl_mast_customer.customer_id_pk AND tbl_mast_order.order_id_pk = tbl_detail_order_invoice.order_id_fk AND (order_status = 'NEW' OR order_status = 'PROCESSING') order by booking_time DESC";
			$data = array($value['restaurantId']);
			$result = $this->action($query,$data);
			$output = array("orderlist"=>array());
			foreach ($result->result() as $row) 
			{
				$entry = array();
				$entry['invoiceNo'] = $row->invoice_no_pk;
				$entry['customerName'] = $row->first_name." ".$row->surname;
				$entry['totalBill'] = $row->billed_amount;
				$entry['tableNo'] = $row->table_no_fk;
				array_push($output['orderlist'], $entry);
			}
			return $output;	
		}
	}

?>