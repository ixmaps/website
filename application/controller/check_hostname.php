<?php
header('Access-Control-Allow-Origin: *'); 
include('../config.php');
include('../model/GatherTr.php');
if(isset($_REQUEST['ip']) && $_REQUEST['ip']!=""){
	$ip=$_REQUEST['ip'];
} else {
	$ip=0;
}
$c = GatherTr::checkHostnameChanged($ip);
?>