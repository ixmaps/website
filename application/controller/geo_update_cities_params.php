<?php
/*
	This script searches for the closest Geographic data (Country, Region, and city) for pair of coordinates (latitude and longitude).

	The script can be use to select different sets in ip_addr_info table

*/
header('Access-Control-Allow-Origin: *'); 
$appPath = "/var/www/ixmaps/application"; // new server
include($appPath.'/config.php');
include($appPath.'/model/IXmapsGeoCorrection.php'); 


$updateMode = true; // !!


if(isset($_GET['limit'])){ 
	$ipLimit = $_GET['limit'];
} else {
	$ipLimit = 20;
}

if(isset($_GET['offset'])){ 
	$ipOffset = $_GET['offset'];
} else {
	$ipOffset = 0;
}

if(isset($_GET['m'])){ 
	$matchLimit = $_GET['m'];
} else {
	$matchLimit = 30;
}

if(isset($_GET['asn'])){ 
	$asn = $_GET['asn'];
} else {
	$asn = 0;
}

// Get single IP
if(isset($_GET['ip'])){
	$singleIp = $_GET['ip'];
	$ipAddrData = IXmapsGeoCorrection::getIpAddrInfo(0, 2, $singleIp);
} else {
	// Get corrected IPs 
	//$ipAddrData = IXmapsGeoCorrection::getIpAddrInfo($ipLimit, 2);

	// Get ips with mm_city = '' 
	$ipAddrData = IXmapsGeoCorrection::getIpAddrInfo($ipLimit, 3, '', $ipOffset);
	
	// Get ips with mm_city = '' and asn
	//$ipAddrData = IXmapsGeoCorrection::getIpAddrInfo($ipLimit, 4, '', $ipOffset, $asn);
}

/* collect parameters if run from the command line */
//$params = getopt("f:hp:");

// check if nothing to do
if(!$ipAddrData){
	echo "\n"."Nothing to do.\n";
} else {
	// Update geodata
	foreach ($ipAddrData as $key => $ipData) {
		$ipToGeoData = array();
		$ipToGeoData = IXmapsGeoCorrection::getClosestGeoData($ipData, $matchLimit);
		
		//print_r($ipToGeoData);

		$bestMatchCountry = array ();
		$bestMatchRegion = array ();
		$bestMatchCity = array ();

		// Add distance to each match
		foreach ($ipToGeoData as $key1 => $geoLocMatch) {
			$latitudeFrom = $ipAddrData[0]['lat'];
			$longitudeFrom = $ipAddrData[0]['long'];
			$latitudeTo = $geoLocMatch['latitude'];
			$longitudeTo = $geoLocMatch['longitude'];
			$distance = IXmapsGeoCorrection::distanceBetweenCoords($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo);
			$ipToGeoData[$key1]['distance'] = $distance;

			//var_dump($geoLocMatch);
			
			// TODO add exclusion rule based on max distance

			// Exclude null Country names
			if($geoLocMatch['region']!=""){
				if(!isset($bestMatchCountry[$geoLocMatch['region']])){
					$bestMatchRegion[$geoLocMatch['region']] = 1;
				} else {
					$bestMatchRegion[$geoLocMatch['region']] += 1;	
				}
			}

			// Exclude null Region names
			if($geoLocMatch['country']!=""){
				if(!isset($bestMatchCountry[$geoLocMatch['country']])){
					$bestMatchCountry[$geoLocMatch['country']] = 1;
				} else {
					$bestMatchCountry[$geoLocMatch['country']] += 1;	
				}
			}

			// Exclude null city names
			if($geoLocMatch['city']!=""){
				if(!isset($bestMatchCity[$geoLocMatch['city']])){
					$bestMatchCity[$geoLocMatch['city']] = 1;
				} else {
					$bestMatchCity[$geoLocMatch['city']] += 1;	
				}
			}

		} // end for find best match
		
	    // add best match geoData
		arsort($bestMatchCountry);
		arsort($bestMatchRegion);
		arsort($bestMatchCity);

		//print_r($bestMatchCity);

		// add best match 
	    $ipAddrData[$key]["mm_country_update"] = key($bestMatchCountry);
	    $ipAddrData[$key]["mm_region_update"] = key($bestMatchRegion);
	    $ipAddrData[$key]["mm_city_update"] = key($bestMatchCity);

	    // add all matches: for reference
	    $ipAddrData[$key]['closest_matches'] = $ipToGeoData;

		// update 
		if($updateMode){
			$updateGeoData = IXmapsGeoCorrection::updateGeoData($ipAddrData[$key]);	
		}
		

	} // end for set of ips

	echo json_encode($ipAddrData);
	//echo "\n"."done\n";
	//print_r($ipAddrData);


} // end if



?>