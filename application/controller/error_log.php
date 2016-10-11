<?php
header('Access-Control-Allow-Origin: *'); 
include('../config.php');
include('../model/GatherTr.php');
if(isset($_REQUEST['id'])){
	$errorId = $_REQUEST['id'];
} else {
	$errorId=0;
}
$a = GatherTr::getError($errorId);
//print_r($a);
$b = json_decode($a[0]['error'], true);
$c = array(
	"id"=>$a[0]['id'],
	"log_date"=>$a[0]['log_date'],
	"error"=>$b
	);
echo json_encode($c);
?>