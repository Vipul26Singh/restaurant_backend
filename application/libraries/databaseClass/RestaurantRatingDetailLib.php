<?php
class RestaurantRatingDetailLib{
	private $restaurant_id;
	private $order_id;
	private $customer_id;
	private $transaction_time;
	private $rating;
	private $comment;

	public function get_value($name){
		$value = null;
		if($name=='restaurant_id')
			$value = $this->restaurant_id;
		if($name=='order_id')
			$value = $this->order_id;
		if($name=='customer_id')
			$value = $this->customer_id;
		if($name=='transaction_time')
			$value = $this->transaction_time;
		if($name=='rating')
			$value = $this->rating;
		if($name=='comment')
			$value = $this->comment;
		return $value;
	}

	public function get_array_value($name){
		$value = array();
		if($name=='restaurant_id')
			$value['restaurant_id_pk1_fk'] =  $this->restaurant_id;
		if($name=='order_id')
			$value['order_id_pk2_fk'] =  $this->order_id;
		if($name=='customer_id')
			$value['customer_id_fk'] =  $this->customer_id;
		if($name=='transaction_time')
			$value['transaction_time'] =  $this->transaction_time;
		if($name=='rating')
			$value['rating_given'] =  $this->rating;
		if($name=='comment')
			$value['comments_given'] =  $this->comment;

		return $value;
	}

	public function set_value($name, $value){
		if($name=='restaurant_id')
			$this->restaurant_id = $value;
		if($name=='order_id')
			$this->order_id = $value;
		if($name=='customer_id')
			$this->customer_id = $value;
		if($name=='transaction_time')
			$this->transaction_time = $value;
		if($name=='rating')
			$this->rating = $value;
		if($name=='comment')
			$this->comment = $value;
	}

	public function set_data($restaurant_id_pk1_fk,$order_id_pk2_fk,$customer_id_fk,$transaction_time,$rating_given,$comments_given){
		$this->restaurant_id = $restaurant_id_pk1_fk;
		$this->order_id = $order_id_pk2_fk;
		$this->customer_id = $customer_id_fk;
		$this->transaction_time = $transaction_time;
		$this->rating = $rating_given;
		$this->comment = $comments_given;
		return $this;
	}

	public function reset_data(){
		$this->restaurant_id = null;
		$this->order_id = null;
		$this->customer_id = null;
		$this->transaction_time = null;
		$this->rating = null;
		$this->comment = null;
	}

	public function set_primary_key($restaurant_id_pk1_fk,$customer_id_fk){
		$this->restaurant_id = restaurant_id;
		$this->customer_id = customer_id;
	}

	public function get_primary_key(){

		return array("restaurant_id_pk1_fk" => $this->restaurant_id,"customer_id_fk" => $this->customer_id);
	}

	public function get_json_view(){
		return array("restaurant_id" => $this->restaurant_id,"order_id" => $this->order_id,"customer_id" => $this->customer_id,"transaction_time" => $this->transaction_time,"rating" => $this->rating,"comment" => $this->comment);
	}

	public function get_array_add(){
		return array("restaurant_id_pk1_fk" => $this->restaurant_id,"order_id_pk2_fk" => $this->order_id,"customer_id_fk" => $this->customer_id,"transaction_time" => $this->transaction_time,"rating_given" => $this->rating,"comments_given" => $this->comment);
	}

	public function get_array_update(){
		$update_array = array();

		if($this->restaurant_id!=NULL)
			$update_array['restaurant_id_pk1_fk'] = $this->restaurant_id;
		if($this->order_id!=NULL)
			$update_array['order_id_pk2_fk'] = $this->order_id;
		if($this->customer_id!=NULL)
			$update_array['customer_id_fk'] = $this->customer_id;
		if($this->transaction_time!=NULL)
			$update_array['transaction_time'] = $this->transaction_time;
		if($this->rating!=NULL)
			$update_array['rating_given'] = $this->rating;
		if($this->comment!=NULL)
			$update_array['comments_given'] = $this->comment;
		return $update_array;
	}
}