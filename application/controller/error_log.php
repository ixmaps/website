<?php
header('Access-Control-Allow-Origin: *'); 
include('../config.php');
include('../model/GatherTr.php');

if(isset($_REQUEST['id'])){
	$errorId = $_REQUEST['id'];
} else {
	$errorId=0;
}

if(isset($_REQUEST['o'])){
	$offset = $_REQUEST['o'];
} else {
	$offset=0;
}

if(isset($_REQUEST['l'])){
	$limit = $_REQUEST['l'];
} else {
	$limit=20;
}

//getError($errorId=0, $offset=0, $limit=0)
$a = GatherTr::getError($errorId, $offset, $limit);
//print_r($a);
$c = array();

foreach ($a as $key => $error) {
	$b = json_decode($error['error'], true);
	$c[] = array(
		"id"=>$error['id'],
		"log_date"=>$error['log_date'],
		"error"=>$b
	);
}
echo json_encode($c);
?>