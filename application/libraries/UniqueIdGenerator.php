<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UniqueIdGenerator{

	public function getCustomerId($prefix){
		return str_replace(".", '', uniqid($prefix, true));
	}

	public function getOrderId($cusId, $restId = false){
		$prefix = "ORD" . substr($cusId, 0, 5);
		
		if(!($restId===false))
			$prefix .= substr($restId, 0, 5);

		$prefix = strtoupper($prefix);

                return str_replace(".", '', uniqid($prefix, true));
        }

	public function getPriceQuoteId($prefix){
                return str_replace(".", '', uniqid($prefix, true));
        }

        public function getPrefixedUniqueId($prefix){
                return str_replace(".", '', uniqid($prefix, true));
        }
}
