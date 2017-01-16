<?php

class LoadPricingQuote extends CI_Model {
	
	public function __construct()
        {
                $this->load->database('krazytable');
        }

	public function addQuote($value){

		$insertQuery = "INSERT INTO tbl_detail_pricing_quote(first_name, last_name, email_id, mobile_no, address, city, state, zip_code, website_name, billing_system_exist, queries, transaction_time, communicated, Unique_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, sysdate(), 'NO', ?)";

		$this->db->trans_start();
		$this->db->query($insertQuery, array($value['firstName'], $value['lastName'], $value['email_id'], $value['mobile_no'], $value['address'], $value['city'], $value['state'], $value['zip'], $value['website'], $value['billing_exist'], $value['queries'], $value['uniqueId']));
		$this->db->trans_complete();

		if($this->db->trans_status() === FALSE)
		{
			log_message("error", "Unable to execute query " .$insertQuery. " received error " . $this->db->_error_message());
			throw new Exception("Unable to add your quote", EXIT_DATABASE);
		}
	}
}
