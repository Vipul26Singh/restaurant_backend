<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GenerateItemJson{
	private $collectionImage = null;
	private $restaurantId = null;
	private $eachSoupDetail = array(); 
	private $completeJson = array();


	public function setGlobals($subCategory, $restId){
		$this->restaurantId = stripslashes( strip_tags( $restId ) );
                        $this->collectionImage = stripslashes( strip_tags( base_url() ) ) ."/". BASE_IMAGE_PATH ."/". $this->restaurantId ."/". $subCategory . IMAGE_FORMAT;
	}

	public function addItemDetail($subCategory, $data, $restId){
		//throw new Exception("Functionality not supported yet");
		//$tempItem = new ItemDetail();
		$priceList = array();
		$itemId = null;
		$itemName = null;
		$description = null;
		$rating = null;
		$fullPrice = null;
		$halfPrice = null;
		$smallPrice = null;
		$prepTime = null;
		$imageUrl = null;
		
		if( isset( $data->ItemId ) ) 
			$itemId = stripslashes( strip_tags( $data->ItemId ) );
		if( isset( $data->ItemName ) ) 
			$itemName = stripslashes( strip_tags( $data->ItemName ) );
		if( isset( $data->Description ) ) 
			$description = stripslashes( strip_tags( $data->Description ) );
		if( isset( $data->Rating ) ) 
			$rating = stripslashes( strip_tags( $data->Rating ) );
		if( isset( $data->FullPrice ) ) 
			$fullPrice = stripslashes( strip_tags( $data->FullPrice ) );
		if( isset( $data->HalfPrice ) ) 
			$halfPrice = stripslashes( strip_tags( $data->HalfPrice ) );
		if( isset( $data->SmallPrice ) ) 
			$smallPrice = stripslashes( strip_tags( $data->SmallPrice ) );
		if( isset( $data->PrepTime ) ) 
			$prepTime = stripslashes( strip_tags( $data->PrepTime ) );
		if( isset( $this->restaurantId ) && isset( $itemId ) )
			$imageUrl = stripslashes( strip_tags( base_url() ) ) ."/". BASE_IMAGE_PATH. "/"  .$this->restaurantId .  "/" . $itemId . IMAGE_FORMAT;

		$this->eachSoupDetail[] = array(
                        "id" => $itemId,
                        "imageUrl" => $imageUrl,
                        "title" => $itemName,
                        "description" => $description,
                        "ratings" => $rating,
                        "price" => array(
                                "sPrice" => $smallPrice,
                                "mPrice" => $halfPrice,
                                "lPrice" => $fullPrice
                                ),
                        "wTime" => $prepTime
                );  
	}

	public function getJson(){
		$this->completeJson = array(
                        "collectionImage" => $this->collectionImage,
                        "itemList" => $this->eachSoupDetail
                );

		return json_encode($this->completeJson, JSON_PRETTY_PRINT);
	}
}
