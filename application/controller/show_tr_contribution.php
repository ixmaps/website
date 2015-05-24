<?php
header('Access-Control-Allow-Origin: *'); 
//ini_set( "display_errors", 0); // use only in production 
include('../config.php');
include('../model/GatherTr.php');


if(isset($_REQUEST['tr_c_id']) && $_REQUEST['tr_c_id']!="")
{
	
	// use only for debugging 
	
	$c = GatherTr::getTrContribution($_REQUEST['tr_c_id']);
	//echo "TR Data saved!\n\n";
	// fix json return: assume now not order in the contributions
	for ($i=0; $i < count($c['traceroute_submissions']); $i++) { 
		if($c['traceroute_submissions'][$i]['data_type']=="json"){
			$c['traceroute_submissions'][$i]['tr_data']= json_decode($c['traceroute_submissions'][$i]['tr_data']);
		}
	}
	echo json_encode($c);

} else {
	echo 'No tr_c_id sent.';
}
?>