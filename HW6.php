<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN"
"http://www.w3.org/TR/REC-html40/strict.dtd">
<html>
	<head>
		<style type="text/css">
			table td
				{
				border-bottom:1px #D0D0D0 solid;
				}
		</style>
		<script type="text/javascript">
		var keywords_i = ""
		function check(){
			//alert("Key words is required!");
			var myform = document.getElementById("form");
			if (myform.Keywords.value == ""){
				alert("Please enter value for key words");
			}
			if (parseInt(myform.MinPrice.value) >  parseInt(myform.MaxPrice.value)){
				alert("min price has to be less than max price");
			}
			if (parseInt(myform.MaxHandlingTime.value) < 1){
				alert("Maximum handling time should be larger than 1 day!");
			}
		}
		function clearform(){
			var clearelements = document.getElementById("form").elements;
			for (var i = 0;i<clearelements.length;i++){
					if (clearelements[i].type == "text"){
						clearelements[i].value ="";
					}
					else if (clearelements[i].type == "checkbox"){
						clearelements[i].checked =false;
					}
					else if (clearelements[i].tagName == "SELECT"){
						for(var j = 0;j<clearelements[i].options.length;j++){
								clearelements[i].options[j].selected = false;
						}
					}
					
			}
		}
		</script >
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<?php
			$keywords_v = $minprice_v = $maxprice_v =$Sort1_v=$Sort2_v=$Sort3_v=$Sort4_v=$Per1_v=$Per2_v=$Per3_v=$Per4_v=$maxday_v="";
			if ($_SERVER["REQUEST_METHOD"] == "POST"){
							$keywords_v = $_POST["Keywords"];
							$minprice_v = $_POST["MinPrice"];
							$maxprice_v = $_POST["MaxPrice"];
							$maxday_v = $_POST["MaxHandlingTime"];
							switch ($_POST["Sort"]){
								case "BestMatch":
									$Sort1_v = "selected='selected'";break;
								case "HighestFirst":
									$Sort2_v = "selected='selected'";break;
								case "P_S_HighestFirst":
									$Sort3_v = "selected='selected'";break;
								case "P_S_lowestFirst":
									$Sort4_v = "selected='selected'";break;
							}
							switch ($_POST["PerPage"]){
								case "5":
									$Per1_v = "selected='selected'";break;
								case "10":
									$Per2_v = "selected='selected'";break;
								case "15":
									$Per3_v = "selected='selected'";break;
								case "20":
									$Per4_v = "selected='selected'";break;
							}
			}
		?>
	</head>
	<body >
		<div  style="border:1px #000000 solid; padding:50px;margin:0 auto;">
			<div align="center"><img src=ebay.jpg align = "middle">Shopping</div><br>
			<form id="form" name="search_info" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" onsubmit ="check(this)" >
				<table style="border:3px #000000 solid;padding:5px;" align="center">
					<tr><td >Key Words* </td><td><input type="text" name="Keywords" size="60" value = "<?php echo $keywords_v;?>"></input></td>
					<tr><td>Price Range: </td><td>from $<input type="text" name="MinPrice" size="5" value ="<?php echo $minprice_v;?>" >
												  to $<input type="text" name="MaxPrice" size="5" value ="<?php echo $maxprice_v;?>">
										<?php?></td>
					<tr><td>Condition: </td><td><input type="checkbox" name="New" value="1000" <?php if(isset($_POST["New"])) echo "checked='checked'";?>>New
												<input type="checkbox" name="Used" value="3000" <?php if(isset($_POST["Used"])) echo "checked='checked'";?>>Used
												<input type="checkbox" name="VeryGood" value="4000" <?php if(isset($_POST["VeryGood"])) echo "checked='checked'";?>>Very Good
												<input type="checkbox" name="Good" value="5000" <?php if(isset($_POST["Good"])) echo "checked='checked'";?>>Good
												<input type="checkbox" name="Acceptable" value="6000" <?php if(isset($_POST["Acceptable"])) echo "checked='checked'";?>>Acceptable
	 				<tr><td>Buying formats: </td><td><input type="checkbox" name="BuyItNow" value="FixedPrice" <?php if(isset($_POST["BuyItNow"])) echo "checked='checked'";?>>Buy It Now
													<input type="checkbox" name="Auction" value="Auction" <?php if(isset($_POST["Auction"])) echo "checked='checked'";?>>Auction
													<input type="checkbox" name="ClassifiedAds" value="Classified" <?php if(isset($_POST["ClassifiedAds"])) echo "checked='checked'";?>>Classified Ads
												</td>
					<tr><td>Seller: </td><td><input type="checkbox" name="ReturnsAcceptedOnly" value="true" <?php if(isset($_POST["ReturnsAcceptedOnly"])) echo "checked='checked'";?>>Return Accepted
					<tr><td>Shipping:</td><td><input type="checkbox" name="FreeShippingOnly" value="true" <?php if(isset($_POST["FreeShippingOnly"])) echo "checked='checked'";?>>Free Shipping<br>
											  <input type="checkbox" name="ExpeditedShippingType" value="Expedited" <?php if(isset($_POST["ExpeditedShippingType"])) echo "checked='checked'";?>>Expedited shipping available<br>
											  Max handing time(days): <input type="text" name="MaxHandlingTime" size="10" value ="<?php echo $maxday_v;?>">
											</td>
					<tr ><td>Sort by: </td><td><select name="Sort" size="1"><option value="BestMatch" <?php echo $Sort1_v?>>Best Match
																		  <option value="CurrentPriceHighest" <?php echo $Sort2_v?>>Price: highest first
																		  <option value="PricePlusShippingHighest" <?php echo $Sort3_v?>>Price + Shipping: highest first
																		  <option value="PricePlusShippingLowest" <?php echo $Sort4_v?>>Price + Shipping: lowest first
											  </select></td>
					<tr><td style="border:0px">Results Per Page: </td><td style="border:0px"><select name="PerPage" size="1"><option value="5" <?php echo $Per1_v?> >5
																		  <option value="10" <?php echo $Per2_v?>>10
																		  <option value="15" <?php echo $Per3_v?>>15
																		  <option value="20" <?php echo $Per4_v?>>20
											 		 </select></td>
					<tr><td style="border:0px"></td><td align="right" style="border:0px"><input type="button" name="reset" value="clear" onclick="clearform(this)" /><input type="submit" name="submit" value="search" /></td>
				</table>
			</form>
			<?php
				if ($_SERVER["REQUEST_METHOD"] == "POST"){
					$key = urlencode($_POST["Keywords"]);
					$filter=array("MinPrice","MaxPrice","New","Used","VeryGood","Good","Acceptable","BuyItNow","Auction","ClassifiedAds","ReturnsAcceptedOnly","FreeShippingOnly","ExpeditedShippingType","MaxHandlingTime");
					$url ="http://svcs.eBay.com/services/search/FindingService/v1?siteid=0&SECURITY-APPNAME=Universi-c3d5-4862-9617-9c14dda84df0&OPERATION-NAME=findItemsAdvanced&SERVICE-VERSION=1.0.0&RESPONSE-DATA-FORMAT=XML&keywords="
					.$key."&paginationInput.entriesPerPage=".$_POST["PerPage"]."&sortOrder=".$_POST["Sort"];
					#handle with url using for loop
					$items = "";$k2 =$k3 = $rec =0;$name_helper = "";
					for ($k =0;$k<count($filter);$k++){
						if(isset($_POST[$filter[$k]])&& !($_POST[$filter[$k]]=== null)&&$_POST[$filter[$k]]!= false){
							if(1<$k && $k < 7){$name_helper = "Condition";}
							else if(6<$k && $k < 10){$name_helper ="ListingType";} 
							if($name_helper == ""){
								$items =$items."&itemFilter[".$k2."].name=".$filter[$k]."&itemFilter[".$k2."].value=".$_POST[$filter[$k]];
								$k2++;
								$rec = $k2;
							}else{
								if($k3 == 0){
									$items =$items."&itemFilter[".$k2."].name=".$name_helper."&itemFilter[".$k2."].value[".$k3."]=".$_POST[$filter[$k]];
									$rec ++;#add rec to return to $k2
								}
								else
									{$items =$items."&itemFilter[".$k2."].value[".$k3."]=".$_POST[$filter[$k]];}
								$k3++;
							}
						
						}

						if($k == 6 ||$k == 9){
							$name_helper = "";$k3 = 0;$k2 = $rec;
						}
					}
					$url = $url.$items;
					echo $url."<br>";
					$xmlback= simplexml_load_file($url);
					#parsing xml from ebay
					if($xmlback->paginationOutput->totalEntries == "0"){
						echo "<p align = center><b><font size=10>No results found</font></b></p>";
					}else{	#add table caption
							$htmlback = "<p align= center><b>".$xmlback->paginationOutput->totalEntries." Results for  ".$_POST["Keywords"]."</b></p>";
							$htmlback = $htmlback."<table border = 1 align = center>";
							foreach ($xmlback->searchResult->item as $item){
								$htmlback = $htmlback."<tr><td><img src=".$item->galleryURL." width= 200px height=150px alt='There is no picture'></td>";
								$htmlback = $htmlback."<td><a href='".$item->viewItemURL."'>".$item->title."</a><br>";
								$htmlback = $htmlback."<b>Condition:</b>".$item->condition->conditionDisplayName;
								if ($item->topRatedListing=="true"){$htmlback = $htmlback.'<img align="middle" src="itemTopRated.jpg" width=50px height=40px>';}
								$htmlback = $htmlback."<br>";
								if($item->listingInfo->listingType=="FixedPrice"||$item->listingInfo->listingType=="StoreInventory"){$htmlback = $htmlback."Buy It Now";}
								else if($item->listingInfo->listingType=="Classified"){$htmlback = $htmlback."Classified Ad";}
								else {$htmlback = $htmlback.$item->listingInfo->listingType;}
								$htmlback = $htmlback."<br>";
								if ($item->returnsAccepted){$htmlback = $htmlback."Seller Accepts return<BR>";}	
								if ($item->shippingInfo->shippingServiceCost=="0.0"){$htmlback = $htmlback."FREE Shipping ";}
								else {$htmlback = $htmlback."Shipping Not FREE ";}
								if ($item->shippingInfo->expeditedShipping){$htmlback = $htmlback."-- Expedited Shipping Available ";}
								$htmlback = $htmlback." -- Handled for shipping in ". $item->shippingInfo->handlingTime." day(s)<br><br>";
								$htmlback = $htmlback."<b>Price : $</b>".$item->sellingStatus->convertedCurrentPrice;
								if( $item->shippingInfo->shippingServiceCost && $item->shippingInfo->shippingServiceCost!="0.0"){
									$htmlback = $htmlback."(+ $".$item->shippingInfo->shippingServiceCost." for shipping)";
								}
								$htmlback = $htmlback."<i> From ".$item->location."</i></td>";
							}
							$htmlback = $htmlback."</table>";
							echo $htmlback;
					}				
				}
			?>
		</div>
	</body>
</html>