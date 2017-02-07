<?php
header('Access-Control-Allow-Origin: *'); 
$appPath = "/var/www/ixmaps/application"; // new server
include($appPath.'/config.php');
include($appPath.'/model/IXmapsGeoCorrection.php'); 

// Get test IP
if(isset($_GET['ip'])){
	$testIp = $_GET['ip'];
	$ipAddrData = IXmapsGeoCorrection::getIpAddrInfo(0, 2, $testIp);
} else {
	// Get corrected IPs 
	$ipAddrData = IXmapsGeoCorrection::getIpAddrInfo(0, 1);
}

echo "\n"."Selected (IP) Set: "."\n";
print_r($ipAddrData);
echo "\n--------"."\n";

// Update geodata
foreach ($ipAddrData as $key => $ipData) {
	$ipToGeoData = array();
	//$ipToGeoData = IXmapsGeoCorrection::updateGeoData($ipData); // old
	$ipToGeoData = IXmapsGeoCorrection::analyzeClosestGeoData($ipData, 5);
	
	//print_r($ipToGeoData);

	$bestMatchIndex = 0;
	$bestMatchCity = array ();
	$bestMatchCountry = array ();
	$bestMatchRegion = array ();
	// Add distance to each match
	foreach ($ipToGeoData as $key1 => $geoLocMatch) {
		$latitudeFrom = $ipAddrData[0]['lat'];
		$longitudeFrom = $ipAddrData[0]['long'];
		$latitudeTo = $geoLocMatch['latitude'];
		$longitudeTo = $geoLocMatch['longitude'];
		$distance = IXmapsGeoCorrection::distanceBetweenCoords($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo);
		$ipToGeoData[$key1]['distance'] = $distance;
		if(!isset($bestMatchCity[$geoLocMatch['city']])){
			$bestMatchCity[$geoLocMatch['city']] = 0;
		} else {
			$bestMatchCity[$geoLocMatch['city']] += 1;	
		}

	}
	
	echo "\n"."Nearest GeoData (Country/City) found for (IP) Set: "."\n";
	print_r($ipToGeoData);
	print_r($bestMatchCity);
}




?>