<?php
include('../config.php');
include('../model/IpFlag.php');

$myIp = $_SERVER['REMOTE_ADDR'];

if(!isset($_POST['action']) && !isset($_GET['action'])) {
	echo 'No parameters';
} else if(isset($_POST)) {
	//print_r($_POST);
	if($_POST['action']=='saveIpFlag'){
		echo IpFlag::saveFlags($_POST);
	} else if($_POST['action']=='getIpFlag'){
		$f = IpFlag::getFlags($_POST);
		if(!$f){
			echo 0;
		} else {
			echo json_encode($f);	
		}

	} else if($_GET['action']=='getFlagsLogs'){
		$fLog = IpFlag::getFlagsLogs();
		IpFlag::renderFlagLogs($fLog);

	}
}

?>