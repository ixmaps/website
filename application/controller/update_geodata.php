<?php
header('Access-Control-Allow-Origin: *'); 
include($appPath.'/config.php');
include($appPath.'/model/IXmapsGeoCorrection.php'); 

// Get corrected IPs
$ipAddrData = IXmapsGeoCorrection::getIpAddrInfo($limit, 1);

// Update geodata
foreach ($ipAddrData as $key => $ipData) {
	IXmapsGeoCorrection::updateGeoData($ipData['ip_addr'], $ipData['lat'], $ipData['long']);
}

?>