<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GetSoups{
	private $collectionImage = null;
	private $restaurantId = null;
	private $eachSoupDetail = array(); 
	private $completeJson = array();

	public function addItemDetail($data, $restId){
		//throw new Exception("Functionality not supported yet");
		$tempItem = new ItemDetail();
		$priceList = array();
		if(!isset($restaurantId)){
			$restaurantId = stripslashes( strip_tags( $restId ) );
			$collectionImage = stripslashes( strip_tags( base_url() ) ) ."/". BASE_IMAGE_PATH ."/". $restaurantId ."/". TWIG_FOR_SOUP;
		}
		if( isset( $data['ItemId'] ) ) 
			$tempItem->itemId = stripslashes( strip_tags( $data['ItemId'] ) );
		if( isset( $data['ItemName'] ) ) 
			$tempItem->itemName = stripslashes( strip_tags( $data['ItemName'] ) );
		if( isset( $data['Description'] ) ) 
			$tempItem->description = stripslashes( strip_tags( $data['Description'] ) );
		if( isset( $data['Rating'] ) ) 
			$tempItem->rating = stripslashes( strip_tags( $data['Rating'] ) );
		if( isset( $data['FullPrice'] ) ) 
			$tempItem->fullPrice = stripslashes( strip_tags( $data['FullPrice'] ) );
		if( isset( $data['HalfPrice'] ) ) 
			$tempItem->halfPrice = stripslashes( strip_tags( $data['HalfPrice'] ) );
		if( isset( $data['SmallPrice'] ) ) 
			$tempItem->smallPrice = stripslashes( strip_tags( $data['SmallPrice'] ) );
		if( isset( $data['PrepTime'] ) ) 
			$tempItem->prepTime = stripslashes( strip_tags( $data['PrepTime'] ) );
		if( isset( $restaurantId ) && isset( $tempItem->itemId ) )
			$tempItem->imageUrl = BASE_IMAGE_PATH. "/" . $restaurantId .  "/" . $tempItem->itemId;

		$eachSoupDetail[] = createFormattedArray($tempItem);  
	}

	public function getJson(){
		$completeJson = array(
                        "collectionImage" => $collectionImage,
                        "itemList" => $eachSoupDetail
                );

		return json_encode($eachSoupDetail, JSON_PRETTY_PRINT);
	}

	private function createFormattedArray($data){
		$formatted = array(
			"id" => $data->itemId, 
			"imageUrl" => $data->imageUrl,
			"title" => $data->itemName, 
			"description" => $data->description,   
			"ratings" => $data->rating, 
			"price" => array(
				"sPrice" => $data->smallPrice,
				"mPrice" => $data->halfPrice,  
				"lPrice" => $data->prepTime   
				),
			"wTime" => $data->prepTime		
		);
		return $formatted;
	}
}
