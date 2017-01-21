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



// Update geodata
foreach ($ipAddrData as $key => $ipData) {
	//$ipToGeoData = array();
	$ipToGeoData = IXmapsGeoCorrection::updateGeoData($ipData);
	
	// callculate distance between input geodata and estimated closest city

	$latitudeFrom = $ipAddrData[0]['lat'];
	$longitudeFrom = $ipAddrData[0]['long'];
	$latitudeTo = $ipData['latitude'];
	$longitudeTo = $ipData['longitude'];

	$distance = IXmapsGeoCorrection::distanceBetweenCoords($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo);

	$ipData['distance'] = $distance;

	echo "\n"."Nearest GeoData (Country/City) found for (IP) Set: "."\n";
	print_r($ipData);
}




?>