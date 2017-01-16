<?php

class RestaurantRatingManagement extends CI_Model {
	
	public function __construct()
        {
                $this->load->database('krazytable');
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
	public function setRating($value){
		$query = null;
                $rating = "rated_".$value['rating'];
		$insertQuery = "INSERT INTO tbl_detail_restaurant_rating (restaurant_id_pk1_fk, order_id_pk2_fk, customer_id_fk, transaction_time, rating_given, comments_given) VALUES (?, ?, ?, now(), ?, ?); UPDATE tbl_summary_restaurant_rating SET total_rated = total_rated +1,
average_rating = (rated_1*1 + rated_2*2 + rated_3*3 + rated_4*4 + rated_5*5+".$value['rating'].")/total_rated,".$rating." = ".$rating." +1,last_synched = NOW( ) WHERE restaurant_id_pk_fk = ?";
                $data = array($value['restaurant_id'], $value['order_id'], $value['customer_id'], $value['rating'], $value['comment'],$value['restaurant_id']);
                $this->action($insertQuery,$data);
                
	}
}
