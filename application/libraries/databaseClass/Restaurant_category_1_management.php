<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Restaurant_category_1_management{
	private $restaurant_id_pk_fk = null;
	private $sub_category_pk2 = null;
	private $sequence_pk3 = null; 
	private $category_1_id = null;
    private $category_1_description = null;
    private $image_relative_path = null;
    
    public function set_data($rest_id, $category, $seq, $cus_id, $desc, $image_path){
        $this->restaurant_id_pk_fk = $rest_id;
        $this->sub_category_pk2 = $category;
        $this->sequence_pk3 = $seq;
        $this->category_1_id = $cus_id;
        $this->category_1_description = $desc;
        $this->image_relative_path = $image_path;
        
        return $this;
    }
    
   
    public function reset_data(){
        $this->restaurant_id_pk_fk = null;
        $this->sub_category_pk2 = null;
        $this->sequence_pk3 = null;
        $this->category_1_id = null;
        $this->category_1_description = null;
        $this->image_relative_path = null;
    }

    public function set_image_path($val=null){
        $this->image_relative_path = $val;
    }
    
    public function set_primary_key($id){
        $this->category_1_id = $id;
    }
    
    public function get_primary_key(){
        return array("category_1_id" => $this->category_1_id);
    }

    public function get_value($name){
        $value = null;
        if($name=='restaurant_id')
            $value = $this->restaurant_id_pk_fk;
        else if($name=='title')
            $value = $this->sub_category_pk2;
        else if($name=='sequence')
            $value = $this->sequence_pk3;
        else if($name=='cuisine_id')
            $value = $this->category_1_id;
        else if($name=='description')
            $value = $this->category_1_description;
        else if($name=='relative_url')
            $value = $this->image_relative_path;

        return $value;
    }
    
    public function get_associative_array(){
        return array( "restaurant_id_pk_fk" => $this->restaurant_id_pk_fk,
                       "sub_category_pk2" => $this->sub_category_pk2,
                       "sequence_pk3" => $this->sequence_pk3, 
                        "category_1_id" => $this->category_1_id,
                        "category_1_description" => $this->category_1_description,
                        "image_relative_path" => $this->image_relative_path
                    );
    }

}
