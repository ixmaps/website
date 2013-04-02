<?php
include('../config.php');
include('../model/Traceroute.php');

// MaxMind Include Files
include('../geoip/geoip.inc');
include('../geoip/geoipcity.inc');
include('../geoip/geoipregionvars.php');

$gi1 = geoip_open("../geoip/dat/GeoLiteCityv6.dat",GEOIP_STANDARD);
$record1 = geoip_record_by_addr_v6($gi1,"::".$myIp);
$myCity = ''.$record1->city;
geoip_close($gi1);


if(!isset($_POST) || count($_POST)==0)
{
	echo '<br/><hr/>No parameters sent.';
} else {
	//echo '<br/><h3>Traceroute Results</h3>';
/*	echo '<textarea>';
	print_r($_POST);
	echo '</textarea>';
*/	//foreach()
	//echo '<br/>Tot filter:'.count($_REQUEST);
	$totFilters = count($_POST);
	//unset($_REQUEST['__utma']);
	//unset($_REQUEST['__utmz']);

	$dataArray = array();
	//for($i=1;$i<=$totFilters;$i++)

	/**

	*/
	foreach($_POST as $constraint)
	{	
		$dataArray[] = $constraint;
	}
	//echo 'parameters sent: <br/>';
	//print_r($dataArray);
	//echo '</pre>';

	if ($dataArray[0]['constraint1']=="quickLink") {
		/*echo '<textarea>';
		print_r($dataArray);
		echo '</textarea>';*/
		
		$b = Traceroute::processQuickLink($dataArray);

	} else {
		$b = Traceroute::getTraceRoute($dataArray);
	}

	$data = json_encode($dataArray);
	Traceroute::saveSearch($data);
	
	//print_r($data);
	if(count($b)!=0)
	{
		
		
		$ixMapsData = Traceroute::getIxMapsData($b);
		//print_r($ixMapsData);
		
		$ixMapsDataT = Traceroute::dataTransform($ixMapsData);
		//print_r($ixMapsDataT);
		Traceroute::generateGoogleMapsJs($ixMapsDataT);
		Traceroute::renderTrSets($ixMapsDataT);
	}

}