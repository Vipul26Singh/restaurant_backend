<?php
class ItemRatingSummaryLib{
	private $menu_item_id;
	private $restaurant_id;
	private $average_rating;
	private $total_rater;
	private $rated_1;
	private $rated_2;
	private $rated_3;
	private $rated_4;
	private $rated_5;
	private $last_synched;

	public function get_value($name){
		$value = null;
		if($name=='menu_item_id')
			$value = $this->menu_item_id;
		if($name=='restaurant_id')
			$value = $this->restaurant_id;
		if($name=='average_rating')
			$value = $this->average_rating;
		if($name=='total_rater')
			$value = $this->total_rater;
		if($name=='rated_1')
			$value = $this->rated_1;
		if($name=='rated_2')
			$value = $this->rated_2;
		if($name=='rated_3')
			$value = $this->rated_3;
		if($name=='rated_4')
			$value = $this->rated_4;
		if($name=='rated_5')
			$value = $this->rated_5;
		if($name=='last_synched')
			$value = $this->last_synched;
		return $value;
	}

	public function get_array_value($name){
		$value = array();
		if($name=='menu_item_id')
			$value['menu_item_pk1_fk'] =  $this->menu_item_id;
		if($name=='restaurant_id')
			$value['restaurant_id_pk2_fk'] =  $this->restaurant_id;
		if($name=='average_rating')
			$value['average_rating'] =  $this->average_rating;
		if($name=='total_rater')
			$value['total_rater'] =  $this->total_rater;
		if($name=='rated_1')
			$value['rated_1'] =  $this->rated_1;
		if($name=='rated_2')
			$value['rated_2'] =  $this->rated_2;
		if($name=='rated_3')
			$value['rated_3'] =  $this->rated_3;
		if($name=='rated_4')
			$value['rated_4'] =  $this->rated_4;
		if($name=='rated_5')
			$value['rated_5'] =  $this->rated_5;
		if($name=='last_synched')
			$value['last_synched'] =  $this->last_synched;

		return $value;
	}

	public function set_value($name, $value){
		if($name=='menu_item_id')
			$this->menu_item_id = $value;
		if($name=='restaurant_id')
			$this->restaurant_id = $value;
		if($name=='average_rating')
			$this->average_rating = $value;
		if($name=='total_rater')
			$this->total_rater = $value;
		if($name=='rated_1')
			$this->rated_1 = $value;
		if($name=='rated_2')
			$this->rated_2 = $value;
		if($name=='rated_3')
			$this->rated_3 = $value;
		if($name=='rated_4')
			$this->rated_4 = $value;
		if($name=='rated_5')
			$this->rated_5 = $value;
		if($name=='last_synched')
			$this->last_synched = $value;
	}

	public function set_data($menu_item_pk1_fk,$restaurant_id_pk2_fk,$average_rating,$total_rater,$rated_1,$rated_2,$rated_3,$rated_4,$rated_5,$last_synched){
		$this->menu_item_id = $menu_item_pk1_fk;
		$this->restaurant_id = $restaurant_id_pk2_fk;
		$this->average_rating = $average_rating;
		$this->total_rater = $total_rater;
		$this->rated_1 = $rated_1;
		$this->rated_2 = $rated_2;
		$this->rated_3 = $rated_3;
		$this->rated_4 = $rated_4;
		$this->rated_5 = $rated_5;
		$this->last_synched = $last_synched;
		return $this;
	}

	public function reset_data(){
		$this->menu_item_id = null;
		$this->restaurant_id = null;
		$this->average_rating = null;
		$this->total_rater = null;
		$this->rated_1 = null;
		$this->rated_2 = null;
		$this->rated_3 = null;
		$this->rated_4 = null;
		$this->rated_5 = null;
		$this->last_synched = null;
	}

	public function set_primary_key($menu_item_pk1_fk,$restaurant_id_pk2_fk){
		$this->menu_item_id = menu_item_id;
		$this->restaurant_id = restaurant_id;
	}

	public function get_primary_key(){

		return array("menu_item_pk1_fk" => $this->menu_item_id,"restaurant_id_pk2_fk" => $this->restaurant_id);
	}

	public function get_json_view(){
		return array("menu_item_id" => $this->menu_item_id,"restaurant_id" => $this->restaurant_id,"average_rating" => $this->average_rating);
	}

	public function get_array_add(){
		return array("menu_item_pk1_fk" => $this->menu_item_id,"restaurant_id_pk2_fk" => $this->restaurant_id,"average_rating" => $this->average_rating,"total_rater" => $this->total_rater,"rated_1" => $this->rated_1,"rated_2" => $this->rated_2,"rated_3" => $this->rated_3,"rated_4" => $this->rated_4,"rated_5" => $this->rated_5,"last_synched" => $this->last_synched);
	}

	public function get_array_update(){
		$update_array = array();

		if($this->menu_item_id!=NULL)
			$update_array['menu_item_pk1_fk'] = $this->menu_item_id;
		if($this->restaurant_id!=NULL)
			$update_array['restaurant_id_pk2_fk'] = $this->restaurant_id;
		if($this->average_rating!=NULL)
			$update_array['average_rating'] = $this->average_rating;
		if($this->total_rater!=NULL)
			$update_array['total_rater'] = $this->total_rater;
		if($this->rated_1!=NULL)
			$update_array['rated_1'] = $this->rated_1;
		if($this->rated_2!=NULL)
			$update_array['rated_2'] = $this->rated_2;
		if($this->rated_3!=NULL)
			$update_array['rated_3'] = $this->rated_3;
		if($this->rated_4!=NULL)
			$update_array['rated_4'] = $this->rated_4;
		if($this->rated_5!=NULL)
			$update_array['rated_5'] = $this->rated_5;
		if($this->last_synched!=NULL)
			$update_array['last_synched'] = $this->last_synched;
		return $update_array;
	}
}