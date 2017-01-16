<?php

class OrderManagement extends CI_Model {

	public function __construct()
	{
		$this->load->database('krazytable');
		$this->load->helper('date');
	}


	public function placeOrder($orderList, $orderId){
		$query = null;
		$datestring = '%Y-%m-%d %H:%i:%s';

		$orderType = "NEW";
		$bookingType = "Table Booking";

		$queryMast = "insert into tbl_mast_order(order_id_pk, customer_id_fk, order_status, order_type, booking_time) values(?, ?, ?, ?, ?)";

		$queryDetail = "insert into tbl_detail_order(order_id_pk1_fk, item_pk2_fk, restaurant_id_fk, quantity, raw_cost) values (?, ?, ?, ?, ?)";
		$restId = $orderList['restaurantId'];
		$this->db->trans_start();
		$time = time();
		$this->db->query($queryMast, array($orderId, $orderList['customerId'], $orderType, $bookingType, mdate($datestring, $time)));

		for($i=0; $i<count($orderList['itemList']); $i++)
		{
			$itemName = $orderList['itemList'][$i]['title'];
			$itemPrice = $orderList['itemList'][$i]['price'];
			$itemQuatity = $orderList['itemList'][$i]['quantity'];

			$this->db->query($queryDetail, array($orderId, $itemName, $restId, $itemQuatity, $itemPrice));	
		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
		{
			log_message("error", "Unable to execute query while placing order received error " . $this->db->_error_message());
			throw new Exception("Unable to place order", EXIT_DATABASE);
		}
	}

	public function getOrderDetail($value){
		$query = null;

		$query = "select C.invoice_no_pk as invoiceNo, A.booking_time as dateTime, concat_ws(char(10 using utf8), B.address_line_1, B.address_line_1, B.address_line_3, B.city) as address,  A.order_status as orderStatus, C.billed_amount as totalVal from tbl_mast_order A, tbl_mast_restaurant B, tbl_detail_order_invoice C where A.restaurant_id_fk = B.restaurant_unique_id_pk and A.order_id_pk = C.order_id_fk and A.customer_id_fk = ? and A.restaurant_id_fk = ?";
	
		$queryResult = $this->db->query($query, array($value['customer_id'], $value['restaurant_id']))->result();

		if(empty($queryResult)){
			throw new Exception('No rows returned', EXIT_DATABASE);
		}else {
			return $queryResult;
		}
	}

	public function getTaxDetail($value){
                $query = null;

                $query = "select tax_name_pk2_fk as tax_id, tax_amount as tax from tbl_detail_order_tax where invoice_no_pk1_fk = ?";

                $queryResult = $this->db->query($query, array($value['invoice_no']))->result_array();

                if(empty($queryResult)){
                        throw new Exception('No rows returned', EXIT_DATABASE);
                }else {
                        return $queryResult;
                }
        }

	public function getDiscountDetail($value){
                $query = null;

                $query = "select total_discount as discount, order_id_fk as order_id from tbl_detail_order_invoice where invoice_no_pk = ?";

                $queryResult = $this->db->query($query, array($value['invoice_no']))->result_array();

                if(empty($queryResult)){
                        throw new Exception('No rows returned', EXIT_DATABASE);
                }else {
                        return $queryResult;
                }
        }

	public function getItemDetail($value){
                $query = null;

                $query = "select B.display_name as itemName, A.quantity as qty, A.plate_size as plateSize, A.raw_cost as price, B.display_content as description from tbl_detail_order A, tbl_mast_restaurant_menu_item B where A.order_id_pk1_fk = ? and A.item_pk2_fk = B.menu_item_pk2_fk and B.restaurant_id_pk1_fk = ?";

                $queryResult = $this->db->query($query, array($value['order_id'], $value['restaurant_id']))->result_array();

                if(empty($queryResult)){
                        throw new Exception('No rows returned', EXIT_DATABASE);
                }else {
                        return $queryResult;
                }
        }

}
