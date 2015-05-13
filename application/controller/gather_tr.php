<?php
ini_set( "display_errors", 0);
include('../config.php');
include('../model/GatherTr.php');

// MaxMind Include Files
include('../geoip/geoip.inc');
include('../geoip/geoipcity.inc');
include('../geoip/geoipregionvars.php');

$dbQueryHtml = '';

// vars for calculating excecution time 
$mtime = microtime(); 
$mtime = explode(" ",$mtime); 
$mtime = $mtime[1] + $mtime[0]; 
$starttime = $mtime; 

// using MaxMind to find the city/country of client's IP address
$myIp='201.245.56.136';
//$myIp = $_SERVER['REMOTE_ADDR'];
$gi1 = geoip_open("../geoip/dat/GeoLiteCity.dat",GEOIP_STANDARD);
$record1 = geoip_record_by_addr($gi1,"::".$myIp);
$_REQUEST['city'] = ''.$record1->city;
$_REQUEST['country'] = ''.$record1->country;
geoip_close($gi1);

//echo json_encode($_REQUEST);

// FIXMW: add extra data 
$_REQUEST['privacy'] = 8;
$_REQUEST['submitter_ip'] = $myIp;


//print_r($_REQUEST);
//echo "<hr/>";

$tr_data = $_REQUEST['tr-stringify'];
$tr_data = str_replace("\\", "", $tr_data);
echo $tr_data;
$tr_data_arr = json_decode($tr_data, true);

print_r($tr_data_arr);
/*
if(isset($_REQUEST['dest_ip']) && $_REQUEST['dest_ip']!="")
{
	//print_r($_REQUEST);	
	$tr_c_id = GatherTr::saveContribution($_REQUEST);
	echo "\ntr_c_id: ". $tr_c_id."\n";
	$b = GatherTr::saveContributionData($_REQUEST,$tr_c_id);
	if($b==1){
		$c = GatherTr::getContribution($tr_c_id);
		print_r($c);
		//$d = GatherTr::processTrData($tr_c_id); 
	} else {
		// undo transaction...
	}

} else {
	echo '<br/><hr/>No parameters sent.';
}*/
?>