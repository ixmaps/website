<?php

ini_set( "display_errors", 0);
include('../config.php');
include('../model/Traceroute.php');

// MaxMind Include Files
include('../geoip/geoip.inc');
include('../geoip/geoipcity.inc');
include('../geoip/geoipregionvars.php');


$dbQueryHtml = '';

// vars for calculating execution time
$mtime = microtime();
$mtime = explode(" ",$mtime);
$mtime = $mtime[1] + $mtime[0];
$starttime = $mtime;

// using MaxMind to find the city of client IP address
$myIp = $_SERVER['REMOTE_ADDR'];
$myCity = '';
$gi1 = geoip_open($MM_dat_dir."/GeoLiteCityv6.dat",GEOIP_STANDARD);
$record1 = geoip_record_by_addr_v6($gi1,"::".$myIp);
$myCity = ''.$record1->city;
geoip_close($gi1);

//
//$a = Traceroute::testSqlUnique($sql);

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
	$saveLog = Traceroute::saveSearch($data);
	//Traceroute::saveSearch($data);

	// get IXmaps geographic data and prepare the response into a json format
	//print_r($data);
	if(count($b)!=0) {
		$ixMapsData = Traceroute::getIxMapsData($b);
		//print_r($ixMapsData);

		$ixMapsDataT = Traceroute::dataTransform($ixMapsData);
		//print_r($ixMapsDataT);

		$ixMapsDataStats = Traceroute::generateDataForGoogleMaps($ixMapsDataT);

		$trHtmlTable = Traceroute::renderTrSets($ixMapsDataT);
	}

		// end calculation of execution time
		$mtime = microtime();
		$mtime = explode(" ",$mtime);
		$mtime = $mtime[1] + $mtime[0];
		$endtime = $mtime;
		$totaltime = ($endtime - $starttime);
		$totaltime = number_format($totaltime,2);
		//echo "<hr/>This page was created in <b>".$totaltime."</b> seconds";

		// add db query results/errors
		$ixMapsDataStats['querySummary']=$dbQuerySummary;
		$ixMapsDataStats['queryLogs']=$dbQueryHtml;

		//$ixMapsDataStats['queryLogs']=.$dbQueryHtml.'<hr/>'.$saveLog;


		// add excec time
		$ixMapsDataStats['execTime']=$totaltime;

		// add server side renerated table;
		$ixMapsDataStats['trsTable']=$trHtmlTable;

		//print_r($ixMapsDataStats);

/*		if(count($ixMapsDataT)==0){
			echo 0;
		} else {
			// pack results in a json file
			echo json_encode($ixMapsDataStats);
		}*/

		echo json_encode($ixMapsDataStats);

//	}

}