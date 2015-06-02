<?php
header('Access-Control-Allow-Origin: *'); 
include('../config.php');
include('../model/GatherTr.php');

// MaxMind Include Files
include('../geoip/geoip.inc');
include('../geoip/geoipcity.inc');
include('../geoip/geoipregionvars.php');
$gi1 = geoip_open("../geoip/dat/GeoLiteCity.dat",GEOIP_STANDARD);


if(isset($_REQUEST['ip']) && $_REQUEST['ip']!=""){
	$ip=$_REQUEST['ip'];
} else {
	$ip=0;
}

$ip_data = GatherTr::getHostnames($_REQUEST['ip'],$_REQUEST['t']);
echo "TOT: IPs analyzed:".count($ip_data);

echo "<hr/>";


$c=0;
echo "<pre>";
//echo "IP\tixmaps-hostname\tnew-hostname\tStatus";
foreach ($ip_data as $key => $ip) {
	$c++;

	// current IXmaps data
	echo "IXmaps IP: ".$ip['ip_addr'];
	echo "\n";
	print_r($ip);
	// Checking MaxMind Data
	$record1 = geoip_record_by_addr($gi1,$ip['ip_addr']);
	echo "\nMaxMind Data:";
	echo "\n";
	print_r($record1);
/*	$city = ''.$record1->city;
	$_POST['city'] = mb_convert_encoding($city, "UTF-8"); // Convert city name to UTF-8 encoding
	$_POST['country'] = ''.$record1->country_code;
*/
	//$hCheck = GatherTr::checkHostnameChanged($ip['ip_addr'], $ip['hostname']);
	//echo "\n".$ip['ip_addr'], "\t".strtolower($ip['hostname']);
	
	/*echo "\nIpInfoIo:";
	echo "\n";
	$ipInfo = GatherTr::getIpDataIpInfoIo($ip['ip_addr']);
	print_r($ipInfo);*/
	
	/*if(isset($hCheck['status'])){		
		echo "\n".$ip['ip_addr'], "\t".strtolower($ip['hostname'])."\t".$hCheck['hostname']."\t".$hCheck['status'];
	}*/
	echo "\n\n";

}
geoip_close($gi1);
echo "</pre>";
//echo "<hr/>Tot IPs changed: ".$c;
?>