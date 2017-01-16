<?php

class NewsletterManagement extends CI_Model {
	
	public function __construct()
        {
                $this->load->database('krazytable');
        }

	public function subscribe($email_id){
		$query = "select customer_id from tbl_detail_newsletter where customer_id = ? and (end_date >= date(sysdate()) or end_date IS NULL) Limit 1";
	
		$queryResult = $this->db->query($query, array($email_id))->row();

		if(isset($queryResult)){
			throw new Exception("Already Subscribed", EXIT_USER_INPUT);
		}

		$insertQuery = "insert into tbl_detail_newsletter(customer_id, subscription_date) values(?, date(sysdate()))";

		$this->db->trans_start();
		$this->db->query($insertQuery, array($email_id));
		$this->db->trans_complete();

		if($this->db->trans_status() === FALSE)
		{
			log_message("error", "Unable to execute query " .$insertQuery. " received error " . $this->db->_error_message());
			throw new Exception("Unable to register", EXIT_DATABASE);
		}
	}

	public function unsubscribe($email_id){
		$query = "select customer_id from tbl_detail_newsletter where customer_id = ? and (end_date >= date(sysdate()) or end_date IS NULL) Limit 1";
	
		$queryResult = $this->db->query($query, array($email_id))->row();

		if(!isset($queryResult)){
			throw new Exception("User Not Subscribed", EXIT_USER_INPUT);
		}

		$updateQuery = "update tbl_detail_newsletter set end_date = date(sysdate()) where customer_id = ? and (end_date >= date(sysdate()) or end_date IS NULL)";

		$this->db->trans_start();
		$this->db->query($updateQuery, array($email_id));
		$this->db->trans_complete();

		if($this->db->trans_status() === FALSE)
		{
			log_message("error", "Unable to execute query " .$upadteQuery. " received error " . $this->db->_error_message());
			throw new Exception("Unable to unsubscribe", EXIT_DATABASE);
		}

	}

}
