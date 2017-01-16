<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Restaurant_cuisine_management{
	private $restaurant_id_pk_fk = null;
	private $cuisine_pk2 = null;
	private $sequence_pk3 = null; 
	private $cuisine_id = null;
    private $cuisine_description = null;
    private $image_relative_path = null;
    
    public function set_data($rest_id, $cuisine, $seq, $cus_id, $desc, $image_path){
        $this->restaurant_id_pk_fk = $rest_id;
        $this->cuisine_pk2 = $cuisine;
        $this->sequence_pk3 = $seq;
        $this->cuisine_id = $cus_id;
        $this->cuisine_description = $desc;
        $this->image_relative_path = $image_path;
        
        return $this;
    }
    
   
    public function reset_data(){
        $this->restaurant_id_pk_fk = null;
        $this->cuisine_pk2 = null;
        $this->sequence_pk3 = null;
        $this->cuisine_id = null;
        $this->cuisine_description = null;
        $this->image_relative_path = null;
    }

    public function set_image_path($val=null){
        $this->image_relative_path = $val;
    }
    
    public function set_primary_key($id){
        $this->cuisine_id = $id;
    }
    
    public function get_primary_key(){
        return array("cuisine_id" => $this->cuisine_id);
    }

    public function get_value($name){
        $value = null;
        if($name=='restaurant_id')
            $value = $this->restaurant_id_pk_fk;
        else if($name=='title')
            $value = $this->cuisine_pk2;
        else if($name=='sequence')
            $value = $this->sequence_pk3;
        else if($name=='cuisine_id')
            $value = $this->cuisine_id;
        else if($name=='description')
            $value = $this->cuisine_description;
        else if($name=='relative_url')
            $value = $this->image_relative_path;

        return $value;
    }
    
    public function get_associative_array(){
        return array( "restaurant_id_pk_fk" => $this->restaurant_id_pk_fk,
                       "cuisine_pk2" => $this->cuisine_pk2,
                       "sequence_pk3" => $this->sequence_pk3, 
                        "cuisine_id" => $this->cuisine_id,
                        "cuisine_description" => $this->cuisine_description,
                        "image_relative_path" => $this->image_relative_path
                    );
    }
}
