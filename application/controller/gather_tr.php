<?php
header('Access-Control-Allow-Origin: *'); 
//ini_set( "display_errors", 0); // use only in production 
include('../config.php');
include('../model/GatherTr.php');

// MaxMind Include Files
include('../geoip/geoip.inc');
include('../geoip/geoipcity.inc');
include('../geoip/geoipregionvars.php');

// using MaxMind to find the city/country of client's IP address
//$myIp='201.245.56.136';
$myIp = $_SERVER['REMOTE_ADDR'];

$_POST['submitter_ip'] = $myIp;
$gi1 = geoip_open("../geoip/dat/GeoLiteCity.dat",GEOIP_STANDARD);
$record1 = geoip_record_by_addr($gi1,$myIp);
$city = ''.$record1->city;
$_POST['city'] = mb_convert_encoding($city, "UTF-8"); // Convert city name to UTF-8 encoding
$_POST['country'] = ''.$record1->country_code;
geoip_close($gi1);

//echo json_encode($_POST);

// TODO: Analysis of Legacy code
$_POST['privacy'] = 8;
$_POST['client'] = "";
$_POST['cl_version'] = "";

//print_r($_POST);

/*
	TODO: add  exahustive check for consistency and completness of the TR data 
	Requires discussion with tests on the TrGen client
*/
if(isset($_POST['dest_ip']) && $_POST['dest_ip']!="")
{
	//print_r($_POST);	
	$tr_c_id = GatherTr::saveTrContribution($_POST);
	//echo "\ntr_c_id: ". $tr_c_id."\n";
	$b = GatherTr::saveTrContributionData($_POST,$tr_c_id);
	
	$trData = GatherTr::getTrContribution($tr_c_id);
	//print_r($rawTrData);
	
	$trByHop = GatherTr::formatTrData($trData); 
	//print_r($d);
	
	if($trByHop==0){
		// analyis of TR failed or not implemented yet

	} else {
		$trAnalyzed = GatherTr::analyzeTrData($trByHop); 
		$trData['ip_analysis']=$trAnalyzed;

		//print_r($trData);
		
		$trId = GatherTr::publishTraceroute($trData);

		$f = GatherTr::flagContribution($tr_c_id, $trId); 
		$result = array("TRid"=>$trId, "tr_c_id"=>$tr_c_id );
		echo json_encode($result);
	}

} else {
	echo 'No parameters sent.';
}
?>