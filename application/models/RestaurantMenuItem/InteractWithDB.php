<?php

class InteractWithDB extends CI_Model {
	
	public function __construct()
        {
                $this->load->database('krazytable');
        }

	public function getDBDetail($columnList, $tableList=false , $whereClause=false){
		$query = null;

		if($columnList == '' || $columnList == null)
			$columnList = "*";

		if($tableList===false)
			throw new Exception('Invalid table');

		if($whereClause === false || $whereClause == '' || $whereClause == null)
			$query = "select " . $columnList . " from " . $tableList;
		else{
			$query = "select " . $columnList . " from " . $tableList . " where " . $whereClause; 
		}
	
		$queryResult = $this->db->query($query)->result();

		if(empty($queryResult)){
			#$dbError = $this->db->error();
			#throw new Exception($dbError['message']);
			throw new Exception('No rows returned');
		}else {
			return $queryResult;
		}

	}

	public function setDBDetail($tableName, $columnList, $valueList){
                $query = null;

                if($columnList == '' || $columnList == null || $tableName == '' || $tableName == null || $valueList == '' || $valueList == null)
                        throw new Exception('Missing Reuired Value - Internal Error');

                $query = "insert into " . $tableName . " (" .$columnList . " ) values " . $valueList;

                $queryResult = $this->db->query($query);

                if($queryResult == FALSE){
                        $dbError = $this->db->error();
                        throw new Exception($dbError['message']);
                }else {
                        return $queryResult;
                }

        }

}
