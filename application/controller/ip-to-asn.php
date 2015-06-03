<?php
//header('Content-type: application/json');
//header('Access-Control-Allow-Origin: *'); 
include('../config.php');
include('../model/GatherTr.php');

$ip = $_REQUEST['ip'];

/*
  Check ip IP for geolocation purposes
 */

  // dev display
  $asn_carrier = GatherTr::getIpForAsn($ip);
  echo "<hr/>getIpForAsn...";
  echo "<pre>";
  print_r($asn_carrier);
  echo "</pre>";

  echo "<hr/>getHostnameForIp...";
  $hostname_new = GatherTr::getHostnameForIp($ip);
  echo "<pre>";
  print_r($hostname_new);
  echo "</pre>";

  echo "<hr/>ipInIXmaps...";
  $ixmaps_data = GatherTr::ipInIXmaps($ip);
  echo "<pre>";
  print_r($ixmaps_data);
  echo "</pre>";


  // display
  /*echo "<br/>netmask: ".$asn_carrier[0]['netmask'];
  echo "<br/>asn: ".$asn_carrier[0]['asn'];
  echo "<br/>Carrier: ".$asn_carrier[0]['name'];*/

?>