<?php
header('Access-Control-Allow-Origin: *'); 
include('../config.php');
include('../model/IXmapsMaxMind.php'); 
include('../model/IXmapsGeoCorrection.php'); 

$ip=$_GET['ip'];
$mm = new IXmapsMaxMind();
$geoIp = $mm->getGeoIp($ip);
//print_r($geoIp);
$mm->closeDatFiles();

if($geoIp['geoip']['city']==null){
	$ipData = array(
		"lat"=>$geoIp['geoip']['latitude'],
		"long"=>$geoIp['geoip']['longitude']
		);
	$matchLimit = 10;
	$ipToGeoData = IXmapsGeoCorrection::getClosestGeoData($ipData, $matchLimit);
	$geoIp['matches']=$ipToGeoData;

echo json_encode($geoIp);
?>