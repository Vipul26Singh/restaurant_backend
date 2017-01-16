<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FoodItemFactory{
	public static function GetInstance($type){
		switch (strtoupper( $type )){
			case "SALADS":
				return new GetSalads();
			case "MAINCOURSE":
				return new GetMainCourse();
			case "SOUPS":
				return new GetSoups();
			case "STARTERS":
				return new GetStarters();
			default:
				throw new Exception("Currently food item " . $type . "is not supported. Please contact admin");	
		}

	}

}
