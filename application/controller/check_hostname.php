<?php
header('Access-Control-Allow-Origin: *'); 
include('../config.php');
include('../model/GatherTr.php');

if(isset($_REQUEST['ip']) && $_REQUEST['ip']!=""){
	$ip=$_REQUEST['ip'];
} else {
	$ip=0;
}

$ip_data = GatherTr::getHostnames($ip);
echo "TOT: IPs analyzed:".count($ip_data);

echo "<hr/>";

echo "<br/>IP;ixmaps-hostname;new-hostname";
$c=0;
echo "<pre>";
foreach ($ip_data as $key => $ip) {
	$c++;

	$hCheck = GatherTr::checkHostnameChanged($ip['ip_addr'], $ip['hostname']);
	
/*	if($hCheck['status']==0){
		// do nothing, unless required to report no hostname look up found
	} else if($hCheck['status']==1){
		// host name is the same as existing in (last) ixmaps table
	}*/
	
	if($hCheck['status']==2){
		
		echo "\n".$ip['ip_addr'], "\t".strtolower($ip['hostname'])."\t".$hCheck['hostname'];
		// hostname has changed
	}

}
echo "</pre>";
echo "<hr/>Tot IPs changed: ".$c;
?>