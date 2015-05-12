<?php
ini_set( "display_errors", 0);
include('../config.php');
include('../model/GatherTr.php');

// MaxMind Include Files
/*include('../geoip/geoip.inc');
include('../geoip/geoipcity.inc');
include('../geoip/geoipregionvars.php');


$dbQueryHtml = '';

// vars for calculating excecution time 
$mtime = microtime(); 
$mtime = explode(" ",$mtime); 
$mtime = $mtime[1] + $mtime[0]; 
$starttime = $mtime; 

// using MaxMind to find the city/country of client's IP address
$myIp = $_SERVER['REMOTE_ADDR'];
$myCity = '';
$gi1 = geoip_open("../geoip/dat/GeoLiteCityv6.dat",GEOIP_STANDARD);
$record1 = geoip_record_by_addr_v6($gi1,"::".$myIp);
$_REQUEST['myCity'] = ''.$record1->city;
$_REQUEST['myCountry'] = ''.$record1->country;
geoip_close($gi1);*/

//echo json_encode($_REQUEST);

// add extra data 
$_REQUEST['city'] = '..';
$_REQUEST['country'] = '..';
$_REQUEST['privacy'] = 8;
$_REQUEST['submitter_ip'] = "10.10.0.1";
$_REQUEST['status'] = "c";


if(isset($_REQUEST['dest_ip']) && $_REQUEST['dest_ip']!="")
{
	//print_r($_REQUEST);	
	$tr_c_id = GatherTr::saveContribution($_REQUEST);
	echo "\ntr_c_id: ". $tr_c_id;
	$b = GatherTr::saveContributionData($_REQUEST,$tr_c_id);
	if($b==1){
		$c = GatherTr::getContribution($tr_c_id);
		//print_r($c);
		$d = GatherTr::processTrData($tr_c_id); 
	} else {
		// undo transaction...
	}

} else {
	echo '<br/><hr/>No parameters sent.';
}
?>