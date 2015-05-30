<?php
header('Access-Control-Allow-Origin: *'); 
include('../config.php');
include('../model/GatherTr.php');

if(isset($_REQUEST['ip']) && $_REQUEST['ip']!=""){
	$ip=$_REQUEST['ip'];
} else {
	$ip=0;
}

$ip_data = GatherTr::getHostnames($_REQUEST['ip'],$_REQUEST['t']);
echo "TOT: IPs analyzed:".count($ip_data);

echo "<hr/>";


$c=0;
echo "<pre>";
echo "IP\tixmaps-hostname\tnew-hostname\tStatus";
foreach ($ip_data as $key => $ip) {
	$c++;

	$hCheck = GatherTr::checkHostnameChanged($ip['ip_addr'], $ip['hostname']);
	
	if(isset($hCheck['status']){		
		echo "\n".$ip['ip_addr'], "\t".strtolower($ip['hostname'])."\t".$hCheck['hostname']."\t".$hCheck['status'];
	}

}
echo "</pre>";
//echo "<hr/>Tot IPs changed: ".$c;
?>