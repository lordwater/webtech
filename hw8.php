<?php
	$xml = simplexml_load_file($_GET["url"]);
	//convert xml to json
	$resultJson = array('ack'=>"No results found");
	if($xml->paginationOutput->totalEntries!="0"){
		//result fixed part
		$resultJson['ack']=(string)$xml->ack;
		$resultJson['resultCount']=(string)$xml->paginationOutput->totalEntries;
		$resultJson['pageNumber']=(string)$xml->paginationOutput->pageNumber;
		$resultJson['itemCount']=(string)$xml->paginationOutput->entriesPerPage;
		//different parts
		$i = 0;
		foreach ($xml->searchResult->item as $item) {
			$key = 'item'.$i;
			$resultJson[$key]['basicInfo']= array(
				'title' => (string)$item->title,
				'viewItemURL' => (string)$item->viewItemURL,
				'galleryURL' => (string)$item->galleryURL,
				'pictureURLSuperSize' => (string)$item->pictureURLSuperSize,
				'convertedCurrentPrice' => (string)$item->sellingStatus->convertedCurrentPrice,
				'shippingServiceCost' => (string)$item->shippingInfo->shippingServiceCost,
				'conditionDisplayName' => (string)$item->condition->conditionDisplayName,
				'listingType' => (string)$item->listingInfo->listingType,
				'location' => (string)$item->location,
				'categoryName' => (string)$item->primaryCategory->categoryName,
				'topRatedListing' => (string)$item->topRatedListing
			);
			$resultJson[$key]['sellerInfo']=array(
				'sellerUserName' => (string)$item->sellerInfo->sellerUserName,
				'feedbackScore' => (string)$item->sellerInfo->feedbackScore,
				'positiveFeedbackPercent' => (string)$item->sellerInfo->positiveFeedbackPercent,
				'feedbackRatingStar' => (string)$item->sellerInfo->feedbackRatingStar,
				'topRatedSeller' => (string)$item->sellerInfo->topRatedSeller,
				'sellerStoreName' => (string)$item->storeInfo->storeName,
				'sellerStoreURL' => (string)$item->storeInfo->storeURL
			);
			$locations ="";
			foreach($item->shippingInfo->shipToLocations as $location)
			{	if ($locations ==""){
					$locations.=$location;}
				else{
					$locations.=",".$location;}
			}
			$resultJson[$key]['shippingInfo']=array(
				'shippingType' => (string)$item->shippingInfo->shippingType,
				'shipToLocations'=> (string)$locations,
				'expeditedShipping' => (string)$item->shippingInfo->expeditedShipping,
				'oneDayShippingAvailable' => (string)$item->shippingInfo->oneDayShippingAvailable,
				'returnsAccepted' => (string)$item->returnsAccepted,
				'handlingTime' => (string)$item->shippingInfo->handlingTime
			);
			$i++;
		}
	}
	$return = json_encode($resultJson);
	echo $return;
?>