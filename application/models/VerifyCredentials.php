<?php

class VerifyCredentials extends CI_Model {
	
	public function __construct()
        {
                $this->load->database('krazytable');
        }

	public function restaurantLogin($value){
		$query = "select restaurant_unique_id_pk as restaurnatId, address_line_1 as addressLine1, address_line_2 as addressLine2, address_line_3 as addressLine3, city as city, state as state, country as country, pin_code as pincode, restaurant_email_id as emailId, latitude as latitude, longitude as longitude from tbl_mast_restaurant where username = ? and password = ? Limit 1";

		$returnVal = array();	
		$queryResult = $this->db->query($query, array($value['username'], $value['password']))->result();

		if(!isset($queryResult) || empty($queryResult)){
			throw new Exception("Invalid credentials", EXIT_USER_INPUT);
		}
                return $queryResult[0];
	}

	public function customerLogin($value){
                $query = "select customer_id_pk as customerId, first_name as firstName, middle_name as middleName, surname as surname, email_id as emailId, mobile_number_uk as mobileNumber from tbl_mast_customer where user_name = ? and password = ? Limit 1";

                $returnVal = array();
                $queryResult = $this->db->query($query, array($value['username'], $value['password']))->result();

                if(!isset($queryResult) || empty($queryResult)){
                        throw new Exception("Invalid credentials", EXIT_USER_INPUT);
                }
                return $queryResult[0];
        }

	public function restaurantSignup($value){
                $query = "select username from tbl_mast_restaurant where username = ? Limit 1";

                $returnVal = array();
                $queryResult = $this->db->query($query, array($value['username']))->row();

                if(isset($queryResult)){
                        throw new Exception("Username not available", EXIT_USER_INPUT);
                }

		$query = "select username from tbl_mast_restaurant where registered_email_id_pk = ? Limit 1";

                $returnVal = array();
                $queryResult = $this->db->query($query, array($value['email']))->row();

                if(isset($queryResult)){
                        throw new Exception("Email already registered", EXIT_USER_INPUT);
                }

		
		$query = "select username from tbl_mast_restaurant where registered_mobile_number = ? Limit 1";

                $returnVal = array();
                $queryResult = $this->db->query($query, array($value['mobile']))->row();
        
                if(isset($queryResult)){
                        throw new Exception("Mobile number already registered", EXIT_USER_INPUT);
                }


		$insertQuery = "INSERT INTO tbl_mast_restaurant(name, tie_up_date, registered_email_id_pk, registered_mobile_number, username, password, restaurnat_unique_id_pk) VALUES (?, date(sysdate()), ?, ?, ?, ?, ?)";

                $this->db->trans_start();
                $this->db->query($insertQuery, array($value['username'], $value['email'], $value['mobile'], $value['username'], $value['password'], $value['unique_id']));
                $this->db->trans_complete();

                if($this->db->trans_status() === FALSE)
                {
                        log_message("error", "Unable to execute query " .$insertQuery. " received error " . $this->db->_error_message());
                        throw new Exception("Unable to register", EXIT_DATABASE);
                }


                $returnVal['username']=$username;
                return $returnVal;
        }

}
