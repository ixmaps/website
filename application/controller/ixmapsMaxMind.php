<?php
header('Access-Control-Allow-Origin: *'); 
include('../config.php');
include('../model/IXmapsMaxMind.php'); 


//$ip='200.3.149.136'; // CO/BTA
//$ip='157.253.1.91';
//$ip='142.150.149.197';
$ip=$_GET['ip'];
$mm = new IXmapsMaxMind();
$geoIp = $mm->getGeoIp($ip);
print_r($geoIp);

$mm->closeDatFiles();

?>