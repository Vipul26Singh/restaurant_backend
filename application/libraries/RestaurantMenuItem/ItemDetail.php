<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ItemDetail{
	public $itemId=null;
	public $imageUrl=null;
	public $itemName=null;
	public $description=null;
	public $rating=null;
	public $fullPrice=null;
	public $halfPrice=null;
	public $smallPrice=null;
	public $prepTime=null;

	public function setItemId($data){
		$this->itemId = stripslashes(strip_tags($data));
	}

	public function setImageUrl($data){
		$this->imageUrl = stripslashes(strip_tags($data));
	}

	public function setItemName($data){
		$this->itemName = stripslashes(strip_tags($data));
	}

	public function setDescription($data){
		$this->description = stripslashes(strip_tags($data));
	}

	public function setRating($data){
		$this->rating = stripslashes(strip_tags($data));
	}

	public function setFullPrice($data){
		$this->fullPrice = stripslashes(strip_tags($data));
	}


	public function setHalfPrice($data){
		$this->halfPrice = stripslashes(strip_tags($data));
	}

	public function setSmallPrice($data){
		$this->smallPrice = stripslashes(strip_tags($data));
	}

	public function setPrepTime($data){
		$this->prepTime = stripslashes(strip_tags($data));
	}

	public function getItemId(){
		return $this->itemId;
	}

	public function getImageUrl(){
		return $this->imageUrl;
	}

	public function getItemName(){
		return $this->itemName;
	}

	public function getDescription(){
		return $this->description;
	}

	public function getRating(){
		return $this->rating;
	}

	public function getFullPrice(){
		return $this->fullPrice;
	}


	public function getHalfPrice(){
		return $this->halfPrice;
	}

	public function getSmallPrice(){
		return $this->smallPrice;
	}

	public function getPrepTime(){
		return $this->prepTime;
	}
}
