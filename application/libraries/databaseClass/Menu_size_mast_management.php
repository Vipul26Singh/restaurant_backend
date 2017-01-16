<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_size_mast_management{
	private $restaurant_id_pk_fk = null;
	private $size_id_pk = null;
	private $plate_size = null; 
	private $display_name = null;
	private $description = null;

	public function set_data($rest_id, $size, $size_id, $name, $desc){
		$this->restaurant_id_pk_fk = $rest_id;
		$this->size_id_pk = $size_id;
		$this->plate_size = $size;
		$this->display_name = $name;
		$this->description = $desc;

		return $this;
	}


	public function reset_data(){
		$this->restaurant_id_pk_fk = null;
                $this->size_id_pk = null;
                $this->plate_size = null;
                $this->display_name = null;
                $this->description = null;
	}

	public function set_primary_key($id){
		$this->size_id_pk = $id;
	}

	public function get_primary_key(){
		return array("size_id_pk" => $this->size_id_pk);
	}

	public function get_value($name){
        $value = null;
        if($name=='restaurant_id')
            $value = $this->restaurant_id_pk_fk;
        else if($name=='size_id')
            $value = $this->size_id_pk;
        else if($name=='size')
            $value = $this->plate_size;
        else if($name=='name')
            $value = $this->display_name;
        else if($name=='description')
            $value = $this->description;

        return $value;
    }

	public function get_associative_array(){
		return array( "restaurant_id_pk_fk" => $this->restaurant_id_pk_fk,
				"size_id_pk" => $this->size_id_pk,
				"plate_size" => $this->plate_size, 
				"display_name" => $this->display_name,
				"description" => $this->description
			    );
	}
}
