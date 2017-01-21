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

$ipToGeoData = array();

// Update geodata
foreach ($ipAddrData as $key => $ipData) {
	$ipToGeoData[] = IXmapsGeoCorrection::updateGeoData($ipData);
}

echo "\n"."Nearest GeoData (Country/City) found for (IP) Set: "."\n";
print_r($ipToGeoData);


?>