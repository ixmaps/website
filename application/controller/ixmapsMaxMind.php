<?php
header('Access-Control-Allow-Origin: *'); 
include('../config.php');
include('../model/IXmapsMaxMind.php'); 

$ip=$_GET['ip'];
$mm = new IXmapsMaxMind();
$geoIp = $mm->getGeoIp($ip);
//print_r($geoIp);
$mm->closeDatFiles();


if($geoIp['geoip']['city']==null){
	echo "city is null";
}
echo json_encode($geoIp);
?>