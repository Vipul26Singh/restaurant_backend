<?php

class CustomerManagement extends CI_Model {
	
	public function __construct()
        {
                $this->load->database('krazytable');
        }

	public function validateUserName($userName){
                $query = null;

                if($userName == '' || $userName == null)
                        throw new Exception("Missing User Name", EXIT_USER_INPUT);

                $query = "select * from tbl_mast_customer where user_name = ?";

                $queryResult = $this->db->query($query, array($userName));

		$row = $queryResult->row();

		if (!isset($row))
		{
        		return TRUE;
		}else{
			throw new Exception("UserName already exists", EXIT_USER_INPUT);
		}
        }

	public function validateMobileNumber($mobileNumber){
                $query = null;

                if($mobileNumber == '' || $mobileNumber == null)
                        throw new Exception("Missing Mobile Number", EXIT_USER_INPUT);

                $query = "select * from tbl_mast_customer where mobile_number_uk = ?";

                $queryResult = $this->db->query($query, array($mobileNumber));

                $row = $queryResult->row();

                if (!isset($row))
                {
                        return TRUE;
                }else{
                        throw new Exception("Mobile Number Already regisetered", EXIT_USER_INPUT);
                }
        }

	public function validateEmailId($emailId){
                $query = null;

                if($emailId == '' || $emailId == null)
                        throw new Exception("Missing Email Id", EXIT_USER_INPUT);

                $query = "select * from tbl_mast_customer where email_id = ?";

                $queryResult = $this->db->query($query, array($emailId));

                $row = $queryResult->row();

                if (!isset($row))
                {
                        return TRUE;
                }else{
                        throw new Exception("Email Id Already regisetered", EXIT_USER_INPUT);
                }
        }


	public function register($customerDetail, $newCustomerId){
                $query = null;
		$this->validateUserName($customerDetail['userName']);
                $this->validateMobileNumber($customerDetail['mobile']);
                $this->validateEmailId($customerDetail['email']);


                if($customerDetail['password'] == '' || $customerDetail['password'] == null || $customerDetail['firstName'] == '' || $customerDetail['firstName'] == null)
                        throw new Exception("Missing Mandatory Value", EXIT_USER_INPUT);

                $query = "insert into tbl_mast_customer(customer_id_pk, first_name, middle_name, surname, user_name, password, email_id, mobile_number_uk)
values(?, ?, ?, ?, ?, ?, ?, ?)";

		$this->db->trans_start();
		$this->db->query($query, array($newCustomerId, $customerDetail['firstName'], $customerDetail['middleName'], $customerDetail['lastName'], $customerDetail['userName'], $customerDetail['password'], $customerDetail['email'], $customerDetail['mobile']));
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
		{
			log_message("error", "Unable to execute query ".$query. " received error ". $this->db->_error_message());
			throw new Exception("Unable to create register", EXIT_DATABASE);
		}

	}

}
