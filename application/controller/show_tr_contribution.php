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
	echo json_encode($c);

} else {
	echo 'No tr_c_id sent.';
}
?>