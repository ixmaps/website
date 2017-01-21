<?php
header('Access-Control-Allow-Origin: *'); 
$appPath = "/var/www/ixmaps/application"; // new server
include($appPath.'/config.php');
include($appPath.'/model/IXmapsGeoCorrection.php'); 

// Get corrected IPs
//$ipAddrData = IXmapsGeoCorrection::getIpAddrInfo(0, 1);

// Get test IP
$testIp = "81.46.131.0";
$ipAddrData = IXmapsGeoCorrection::getIpAddrInfo(0, 2, $testIp);

//print_r($ipAddrData);

// Update geodata
foreach ($ipAddrData as $key => $ipData) {
	IXmapsGeoCorrection::updateGeoData($ipData);
}

?>