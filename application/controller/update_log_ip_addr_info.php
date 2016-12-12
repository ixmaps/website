<?php
header('Access-Control-Allow-Origin: *'); 
include('../config.php');
//include('../model/IXmapsMaxMind.php'); 
include('../model/IXmapsGeoCorrection.php'); 

$limit = 200;
$ipAddrData = IXmapsGeoCorrection::getIpAddrInfo($limit);
$lastIp = IXmapsGeoCorrection::insertLogIpAddrInfo($ipAddrData);
//echo "\n Last Ip: ".$lastIp;
?>