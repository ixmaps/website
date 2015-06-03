<?php
//header('Content-type: application/json');
//header('Access-Control-Allow-Origin: *'); 
include('../config.php');
include('../model/GatherTr.php');

$ip = $_REQUEST['ip'];

/*
  IP to AS using DB:
 */

  $asn_carrier = GatherTr::getIpForAsn($ip);
  echo "<hr/>getIpForAsn...";
  echo "<br/>netmask: ".$asn_carrier[0]['netmask'];
  echo "<br/>asn: ".$asn_carrier[0]['asn'];
  echo "<br/>Carrier: ".$asn_carrier[0]['name'];

  echo "<hr/>getHostname...";
  $hostname_new = GatherTr::getHostname($ip);
  echo "<br/>Current hostname: ".$hostname_new;

?>