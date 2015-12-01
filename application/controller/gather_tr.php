<?php
header('Access-Control-Allow-Origin: *'); 
include('../config.php');
include('../model/GatherTr.php');
include('../model/IXmapsMaxMind.php'); 

$myIp = $_SERVER['REMOTE_ADDR'];
//$myIp='200.3.149.136'; // CO/BTA

$mm = new IXmapsMaxMind();
$geoIp = $mm->getGeoIp($myIp);

$_POST['metadata']=json_encode(array("HTTP_USER_AGENT"=>$_SERVER['HTTP_USER_AGENT']));
$_POST['submitter_ip'] = $myIp;
$_POST['city'] = $geoIp['geoip']['city'];
$_POST['country'] = ''.$geoIp['geoip']['country_code'];
$_POST['submitter_asnum'] = ''.$geoIp['asn'];
$_POST['privacy'] = 8;
$_POST['client'] = "";
$_POST['cl_version'] = "";

$mm->closeDatFiles();
/*
	TODO: add  exahustive check for consistency and completness of the TR data 
	Requires discussion with tests on the IXmapsClient client
*/
if(isset($_POST['dest_ip']) && $_POST['dest_ip']!="")
{
	$tr_c_id = GatherTr::saveTrContribution($_POST);
	//echo "\ntr_c_id: ". $tr_c_id."\n";
	$b = GatherTr::saveTrContributionData($_POST,$tr_c_id);	
	$trData = GatherTr::getTrContribution($tr_c_id);
	$trByHop = GatherTr::analyzeIfInconsistentPasses($trData); 

	// Exclude contributions with less than 2 hops
	if(count($trByHop['tr_by_hop'])<2){
		$trData['tr_flag'] = 4;
		$trGatherMessage = "Insufficient Traceroute responses. (Contribution id: ".$tr_c_id.")"; 
		$trId = 0;

	} else {
		$trGatherMessage = "";		
		$trAnalyzed = GatherTr::selectBestIp($trByHop['tr_by_hop']); 
		$trData['ip_analysis']=$trAnalyzed;
		$trData['tr_flag']=$trByHop['tr_flag'];

		/*echo "\n\n ------- trData['ip_analysis']:";
		print_r($trData['ip_analysis']);*/
		//print_r($trData);

		$publishResult = GatherTr::publishTraceroute($trData);

		if (!$publishResult['publishControl']) {
			$trData['tr_flag'] = 4;
			$trGatherMessage = "Insufficient Traceroute responses. (Contribution id: ".$tr_c_id.")"; 
		} else if($publishResult['publishControl'] && $publishResult['trId']==0) {
			$trData['tr_flag'] = 5;
			$trGatherMessage = "Error publishing Traceroute responses. (Contribution id: ".$tr_c_id.")";
		} else if($publishResult['publishControl'] && $publishResult['trId']!=0) {
			// Success: tr_flag = 2 or 3
			$trGatherMessage = "Traceroute data saved successfully.";
			$trId = $publishResult['trId'];
			/*TODO*/
			// return number of hops: e.g. 15 hops were found
			// Grab ASN from MaxMind -> as_users
		}
	}

	$f = GatherTr::flagContribution($tr_c_id, $trId, $trData['tr_flag']); 
	$result = array(
		"TRid"=>$trId, 
		"tr_c_id"=>$tr_c_id, 
		"message"=> $trGatherMessage, 
		"tr_flag"=>$trData['tr_flag']);
	
	echo json_encode($result);

	//print_r($result);
	//print_r($trData);

} else {
	echo 'No parameters sent.';
}
?>