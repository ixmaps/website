<?php
header('Access-Control-Allow-Origin: *'); 
include('../config.php');
include('../model/IXmapsMaxMind.php'); 

$ip=$_GET['ip'];
$mm = new IXmapsMaxMind();
$geoIp = $mm->getGeoIp($ip);
//print_r($geoIp);
echo json_encode($geoIp);
$mm->closeDatFiles();
?>