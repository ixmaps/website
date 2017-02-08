<?php
header('Access-Control-Allow-Origin: *'); 

$appPath = "/var/www/ixmaps/application"; // new server
//$appPath = "/Users/antonio/mywebapps/git-website-live/application"; // Anto Local


include($appPath.'/config.php');
//include('../model/IXmapsMaxMind.php'); 
include($appPath.'/model/IXmapsGeoCorrection.php'); 

$limit = 100;
$ipAddrData = IXmapsGeoCorrection::getIpAddrInfo($limit);
var_dump($ipAddrData);
/*$lastIp = IXmapsGeoCorrection::insertLogIpAddrInfo($ipAddrData);
echo "\n Last Ip: ".$lastIp."\n";*/
?>