<?php
include('../config.php');
include('../model/Traceroute.php');

/* Testing ... */

// Colin all boomerang
//$sql="select traceroute_id as \"ID\", hop as \"Hop\", ip_addr as \"IP Address\", hostname as \"Hostname\", asnum as \"AS#\", mm_lat, mm_long, lat as \"Longitude\", long as \"Longitude\", mm_city as \"City\", mm_region as \"Region\", mm_country as \"Country\", mm_postal as \"Postal code\", dest as \"Destination\", dest_ip as \"Destination IP\" from ( select temp_full_routes_large.* from ( select TI.traceroute_id, TI.hop, IP.ip_addr, IP.hostname, IP.asnum, IP.mm_lat, IP.mm_long, IP.lat, IP.long,IP.mm_city, IP.mm_region, IP.mm_country, IP.mm_postal, TR.dest, TR.dest_ip from ip_addr_info IP, tr_item TI, traceroute TR where ( IP.ip_addr=TI.ip_addr and TR.id = TI.traceroute_id and attempt = 1 ) ) temp_full_routes_large join ( select traceroute_id from ( select * from ( select temp1.*, traceroute.dest, traceroute.dest_ip from ( select t.traceroute_id, t.hop, i.ip_addr, i.hostname, i.asnum, i.mm_lat, i.mm_long, i.lat, i.long,i.mm_city, i.mm_region, i.mm_country, i.mm_postal from ip_addr_info as i join tr_item as t on i.ip_addr=t.ip_addr where attempt=1 ) temp1 join traceroute on temp1.traceroute_id=traceroute.id ) temp_full_routes_large where hop=1 and mm_country='CA' ) temp_ca_origin join ( select id, dest, mm_country from traceroute join ip_addr_info on dest_ip=ip_addr where mm_country='CA' ) temp_ca_destination on traceroute_id=id order by traceroute_id ) temp3 on temp_full_routes_large.traceroute_id=temp3.traceroute_id order by temp_full_routes_large.traceroute_id ) temp_ca_origin_and_destination join ( select distinct traceroute_id as id from ( select temp_full_routes_large.* from ( select TI.traceroute_id, TI.hop, IP.ip_addr, IP.hostname, IP.asnum, IP.mm_lat, IP.mm_long, IP.lat, IP.long,IP.mm_city, IP.mm_region, IP.mm_country, IP.mm_postal, TR.dest, TR.dest_ip from ip_addr_info IP, tr_item TI, traceroute TR where ( IP.ip_addr=TI.ip_addr and TR.id = TI.traceroute_id and attempt = 1 ) ) temp_full_routes_large join ( select traceroute_id from ( select * from ( select temp1.*, traceroute.dest, traceroute.dest_ip from ( select t.traceroute_id, t.hop, i.ip_addr, i.hostname, i.asnum, i.mm_lat, i.mm_long, i.lat, i.long,i.mm_city, i.mm_region, i.mm_country, i.mm_postal from ip_addr_info as i join tr_item as t on i.ip_addr=t.ip_addr where attempt=1 ) temp1 join traceroute on temp1.traceroute_id=traceroute.id ) temp_full_routes_large where hop=1 and mm_country='CA' ) temp_ca_origin join ( select id, dest, mm_country from traceroute join ip_addr_info on dest_ip=ip_addr where mm_country='CA' ) temp_ca_destination on traceroute_id=id order by traceroute_id ) temp3 on temp_full_routes_large.traceroute_id=temp3.traceroute_id order by temp_full_routes_large.traceroute_id ) temp_ca_origin_and_destination where mm_country='US' ) temp4 on temp_ca_origin_and_destination.traceroute_id=temp4.id order by temp_ca_origin_and_destination.traceroute_id,hop";

//echo '<hr/>'.$urlHopImg;

//$a = Traceroute::testSqlUnique($sql);

if(!isset($_POST) || count($_POST)==0)
{
	echo '<br/><hr/>No parameters sent.';
} else {
	echo '<br/><br/><h3>Traceroute Results</h3>';
	//print_r($_POST);
	//foreach()
	//echo '<br/>Tot filter:'.count($_REQUEST);
	$totFilters = count($_POST);
	//unset($_REQUEST['__utma']);
	//unset($_REQUEST['__utmz']);

	$dataArray = array();
	//for($i=1;$i<=$totFilters;$i++)
	foreach($_POST as $constraint)
	{	
		$dataArray[] = $constraint;
	}
	//echo 'parameters sent: <br/>';
	//print_r($dataArray);
	//echo '</pre>';


	//$data='[{"constraint1":"does","constraint2":"originate","constraint3":"city","constraint4":"Halifax","constraint5":"AND"},{"constraint1":"does","constraint2":"goesVia","constraint3":"city","constraint4":"Toronto","constraint5":"AND"},{"constraint1":"does","constraint2":"terminate","constraint3":"city","constraint4":"Chicago","constraint5":""}]';

	// two
	//$data='[{"constraint1":"does","constraint2":"originate","constraint3":"city","constraint4":"Toronto","constraint5":"AND"},{"constraint1":"does","constraint2":"goesVia","constraint3":"city","constraint4":"Miami","constraint5":"AND"}]';

	$data = json_encode($dataArray);
	// one
	//$data='[{"constraint1":"does","constraint2":"originate","constraint3":"city","constraint4":"Toronto","constraint5":"AND"}]';

	Traceroute::saveSearch($data);

	//Traceroute::testArrays();
	$b = Traceroute::getTraceRoute($data);

/*	if(count($b)>1000) {
		echo '<p>The number of traceroutes found is greather than 1000. <br/>Please add new constraints to your query.</p>';

	} else {
		Traceroute::renderTrSets($b);
	}*/

	Traceroute::renderTrSets($b);
	//Traceroute::buildWhere($data);

	//$trId = 1813;
	//echo 'TR id: '.$trId.' : Last Hop: '.Traceroute::getLastHop($trId); 
	//Traceroute::getHop($trId, 'last');

}


// testing
/*
$c = array_diff($a, $b);
echo '<hr/>Difference: <b>'.count($c).'</b>';
//print_r($c);
Traceroute::renderTrSets($c);

$d = array_intersect($a, $b);
echo '<hr/>Intersects: : <b>'.count($d).'</b>';
//print_r($d);
Traceroute::renderTrSets($d);
*/

?>