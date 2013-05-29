<?php
include('../config.php');

if(!isset($_POST) || count($_POST)==0)
{
	echo '<br/><hr/>No parameters sent.';
} else {

	/* XML approach */
	/*$nsaData = file_get_contents('../../data/nsa.kml');
	$nsaArray = new SimpleXMLElement($nsaData);
	$nsaCoords=$nsaArray->Document->Folder->Placemark;
	//echo $nsaData;
	$pointsArr = array();
	foreach ($nsaCoords as $key => $value) {
		$name = (string)$value->name;
		$description = 'Likely NSA listening post located in<br/><br/>'.(string)$value->description;
		$coordinates = (string)$value->Point->coordinates;
		if($name=='611 Folsom St., San Francisco, CA'){
			$icon=$webUrl.'/images/nsa_class_A.png';
		} else {
			$icon=$webUrl.'/images/nsamedium.png';
		}
		$pointsArr[]=array(
			'name'=>$name,
			'description'=>$description,
			'coordinates'=>$coordinates,
			'icon'=>$icon
		);
	}
	echo json_encode($pointsArr);*/
}

getChotelData();

function getChotelData(){
	global $dbconn;
	$sql="select * from chotel";
	$result = pg_query($dbconn, $sql) or die('Query failed: ' . pg_last_error());
	$dataArr = pg_fetch_all($result);
	//return $dataArr;
	echo json_encode($dataArr);
}
?>