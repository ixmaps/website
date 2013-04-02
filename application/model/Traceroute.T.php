<?php
// anto test
class Traceroute
{
	/**

	*/
	public static function distance($lat1, $lng1, $lat2, $lng2, $miles = true)
	{
		$pi80 = M_PI / 180;
		$lat1 *= $pi80;
		$lng1 *= $pi80;
		$lat2 *= $pi80;
		$lng2 *= $pi80;
	 
		$r = 6372.797; // mean radius of Earth in km
		$dlat = $lat2 - $lat1;
		$dlng = $lng2 - $lng1;
		$a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlng / 2) * sin($dlng / 2);
		$c = 2 * atan2(sqrt($a), sqrt(1 - $a));
		$km = $r * $c;
	 
		return ($miles ? ($km * 0.621371192) : $km);
	}

	/**
	
	*/
	public static function strip_only($str, $tags, $stripContent = false) 
	{
	    $content = '';
	    if(!is_array($tags)) {
	        $tags = (strpos($str, '>') !== false ? explode('>', str_replace('<', '', $tags)) : array($tags));
	        if(end($tags) == '') array_pop($tags);
	    }
	    foreach($tags as $tag) {
	        if ($stripContent)
	             $content = '(.+</'.$tag.'[^>]*>|)';
	         $str = preg_replace('#</?'.$tag.'[^>]*>'.$content.'#is', '', $str);
	    }
	    return $str;
	} // end function

	
	/**
	
	*/
	public static function getHop($trId, $hopeType) 
	{

		global $dbconn;

		if($hopeType=='first') {
			
			$sql = "select * from tr_item where traceroute_id = ".$trId." ORDER BY hop LIMIT 1 OFFSET 0;";
		} else if($hopeType=='last') {
			// use destination as last hop
			$sql = "select * from tr_item where traceroute_id = ".$trId." ORDER BY hop DESC LIMIT 1 OFFSET 0;";

		}

		echo '<hr/>'.$sql;

		$result = pg_query($dbconn, $sql) or die('Query failed: ' . pg_last_error());

		$data = array();

		// Printing results in HTML
		$htmlResult = "<table border='1'>";
		while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
		    $data[]=$line;
		    $htmlResult.= "\t<tr>\n";
		    foreach ($line as $col_value) {
		        $htmlResult.= "\t\t<td>$col_value</td>\n";
		    }
		    $htmlResult.= "\t</tr>\n";
		}
		$htmlResult.= "</table>\n";

		echo $htmlResult;

		print_r($data);

		// Free resultset
		pg_free_result($result);

		// Closing connection
		pg_close($dbconn);
	
	} // end fnc

	/**
	
	*/
	public static function buildWhere($c,$doesNotChk=false) 
	{

		global $dbconn, $ixmaps_debug_mode;
		$trSet = array();
		$w ='';
		$table='';

		$constraint_value = trim($c['constraint4']);
		// apply some default formating to constraint's value

/*		$selector_s='LIKE';
		$selector_i='=';
*/
		if($c['constraint1']=='does' || $doesNotChk==true)
		{
			$selector_s='LIKE';
			$selector_i='=';

		} else {
			$selector_s='NOT LIKE';
			$selector_i='<>';
		}

		if($c['constraint5']=='')
		{
			$operand='AND';
		} else  {
			$operand=$c['constraint5'];
		}

		/* setting constraints associated to table ip_addr_info */
		if($c['constraint3']=='country') {
			$constraint_value = strtoupper($constraint_value);
			$table = 'ip_addr_info';
			$field='mm_country';
		} else if($c['constraint3']=='region') {
			$constraint_value = strtoupper($constraint_value);
			$table = 'ip_addr_info';
			$field='mm_region';
		} else if($c['constraint3']=='city') {
			$constraint_value = ucwords(strtolower($constraint_value));
			$table = 'ip_addr_info';
			$field='mm_city';
		} else if($c['constraint3']=='ISP') {
			//$constraint_value = ucwords(strtolower($constraint_value));
			$constraint_value = $constraint_value;
			$table = 'as_users';
			$field='name';
		} else if($c['constraint3']=='NSA') {
			$table = 'ip_addr_info';
			$field='mm_city';
		} else if($c['constraint3']=='zipCode') {
			//$constraint_value = strtoupper($constraint_value);
			$table = 'ip_addr_info';
			$field='mm_postal';
		} else if($c['constraint3']=='asnum') {
			$table = 'ip_addr_info';
			$field='asnum';
		} else if($c['constraint3']=='submitter') {
			$table = 'traceroute';
			$field='submitter';
		} else if($c['constraint3']=='zipCodeSubmitter') {
			$table = 'traceroute';
			$field='zip_code';
		} else if($c['constraint3']=='destHostName') {
			$table = 'traceroute';
			$field='dest';
		} else if($c['constraint3']=='ipAddr') {
			$table = 'ip_addr_info';
			$field='ip_addr';
		} else if($c['constraint3']=='trId') {
			$table = 'traceroute';
			$field='id';
		} else if($c['constraint3']=='hostName') {
			$table = 'ip_addr_info';
			$field='hostname';

		}
		

			if($c['constraint2']=='originate')
			{
				$w.=" AND tr_item.hop = 1 AND tr_item.attempt = 1";

			} else if($c['constraint2']=='terminate') {

				//$w.=" AND (traceroute.dest_ip=ip_addr_info.ip_addr) AND tr_item.attempt = 1 AND tr_item.hop > 1";

				$w.=" AND (traceroute.dest_ip=ip_addr_info.ip_addr) AND tr_item.attempt = 1 AND tr_item.hop > 1";

			} else if($c['constraint2']=='goVia') {
				
				// this is a wrong assumption. 
				//The destination ip is not always the last hop
				//$w.=" AND tr_item.attempt = 1 AND tr_item.hop > 1 AND (traceroute.dest_ip<>ip_addr_info.ip_addr)";

				$w.=" AND tr_item.attempt = 1 AND tr_item.hop > 1 ";

				// FIX ME. need to exclude last ip.


			} else if($c['constraint2']=='contain') {

				$w.=" AND tr_item.attempt = 1 ";

			}

			/* string of int ? */
			if (($field=='asnum') || ($field=='id'))
			{
				$w.=" AND $table.$field $selector_i $constraint_value";
				//$w.="  $selector $table.$field $operand_i $constraint_value";
			} else if ($field=='ip_addr') {
				$w.=" AND $table.$field $selector_i '".$constraint_value."'";
			} else {
				$w.=" AND $table.$field $selector_s '%".$constraint_value."%'";
			}

		return $w;

	}
	/**
	
	*/
	public static function getLastHop($trId)
	{
		global $dbconn;
		$result = array();
		$sql = "select hop from tr_item where traceroute_id = ".$trId." ORDER BY hop DESC LIMIT 1 OFFSET 0;";

		$result = pg_query($dbconn, $sql) or die('Query failed: ' . pg_last_error());

		while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
			//print_r($line);
			return $line['hop'];
		}

	}

	/**
		Get TR data for a given sql query
	*/
	public static function getTrSet($sql)
	{
		//$sql = "SELECT as_users.num, tr_item.traceroute_id, traceroute.id, ip_addr_info.mm_city, ip_addr_info.ip_addr, ip_addr_info.asnum FROM as_users, tr_item, traceroute, ip_addr_info WHERE (tr_item.traceroute_id=traceroute.id) AND (ip_addr_info.ip_addr=tr_item.ip_addr) AND (as_users.num=ip_addr_info.asnum) AND tr_item.attempt = 1";
		
		//echo '<hr/>EX<br/>'.$sql;

		global $dbconn;
		$trSet = array();
		$result = pg_query($dbconn, $sql) or die('Query failed: ' . pg_last_error());
		$data = array();
		//$data1 = array();
		$id_last = 0;

		$in_nsa_city = array();
		
		$c = 0;
		while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
		    $c++;
		    $id=$line['id'];
		    $city = $line['mm_city'];
		    if($id!=$id_last){
		    	$data[]=$id;
			}
/*
			echo '<br>'.$city;

			// check if current city is in chotel set
			$chotel_data = array();

			$chotel_data = Traceroute::checkNSA($city);

			//print_r($chotel_data);


			if(in_array($city,$chotel_data,true)) 
			{
		    	echo "<br/>City:"." : <b>".$city." </b> found in chotel set.";
		    }*/ 

			//$data1[]=$id;
		    $id_last=$id;
		}
		// just in case 
		$data1 = array_unique($data);
		//print_r($data);

		//echo "<br/>Records (unique): <b>".count($data1).'</b>';
		echo " | Traceroutes: <b>".count($data1).'</b>';
		//echo " | Hops: ".$c;
		// Free resultset
		pg_free_result($result);
		// Closing connection
		//pg_close($dbconn);

		//echo '<hr/>getTrSet: '.memory_get_usage();
		unset($data);
		//echo '<hr/>getTrSet: '.memory_get_usage();

		return $data1;
	}

	/**
		Check if in a given city there is an NSA
		Load chotel data
	*/
	public static function checkNSA($locationKey)
	{
		global $dbconn;
		//$sql = "select * from chotel where address like '%".$locationKey."%' order by type, nsa";
		$sql = "select * from chotel order by type, nsa";

		$c = 0;
		$data = array();

		
		$result = pg_query($dbconn, $sql) or die('Query failed: ' . pg_last_error());

		while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
			$c++;
			$id = $line['id'];
			$address = explode(',', $line['address']);
			
			//echo '<hr/>';
			//print_r($address);


			$t=count($address);
			$city = '';
			$region = '';

			//$city = trim($line['city']);
			//$region = trim($line['region']);

			// update new fields

			if(isset($address[$t-2]) && isset($address[$t-1])) {
				$city = trim($address[$t-2]);
				$region = trim($address[$t-1]);
				$aa = ord($city);

				$c_array = str_split($city);

				foreach ($c_array as $c_char) 
				{
					echo '<br>'.'"'.$c_char.'" : "'.ord($c_char).'"';

				}

				//echo '<br/>ASCII: '.$aa.'';

				// clean up strange characters
				$city=str_replace(chr(194), '', $city);
				$city=str_replace(chr(160), '', $city);
				//$city=utf8_encode($city);
				$city=trim($city);
				
				//$region=str_replace(chr(194), '', $region);

				$update = "UPDATE chotel SET city = '".$city."', region='".$region."' WHERE id = ".$id;
				echo '<br/>'.$update;
				echo '<hr/>';
				pg_query($dbconn, $update) or die('Query failed: ' . pg_last_error());
			}

			//$m[] = $line['address'];
			//$m[] = $line['address'];
			//$data[] = $line;
			
			if($line['type']=='NSA') {
				$data['NSA'][] = array($city,$region);
			} else if ($line['type']=='CH') {
				$data['CH'][] = array($city,$region);
			} else if ($line['type']=='google') {
				$data['google'][] = array($city,$region);
			} else if ($line['type']=='UC') {
				$data['UC'][] = array($city,$region);
			} 
		}

		pg_free_result($result);


		//return array('total'=>$c, 'matches'=>$m);
		//print_r($data);
	}

	/**

	*/
	public static function getTraceRoute($data)
	{
		global $dbconn;
		$result = array();
		$trSets = array();
		$conn = 0;
		$limit1 = 4500;
		$limit2 = 5000;
		$offset = 0;
		$doesNotChk = false;

		// loop constraints
		foreach($data as $constraint)
		{
		//if($ixmaps_debug_mode) {
			echo '<br><b>'.$constraint['constraint1'].' : '.$constraint['constraint2'].' : '.$constraint['constraint3'].' : '.$constraint['constraint4'].' : '.$constraint['constraint5'].'</b>';
		//}

			$w = '';
			$sql = '';

				$sql = "SELECT as_users.num, tr_item.traceroute_id, traceroute.id, ip_addr_info.mm_city, ip_addr_info.ip_addr, ip_addr_info.asnum FROM as_users, tr_item, traceroute, ip_addr_info WHERE (tr_item.traceroute_id=traceroute.id) AND (ip_addr_info.ip_addr=tr_item.ip_addr) AND (as_users.num=ip_addr_info.asnum)";

				$sqlOrder = ' order by tr_item.traceroute_id, tr_item.hop, tr_item.attempt';

			/*
				
			*/
			$aa = 0;
			// adding exception for doesnot cases
			if($constraint['constraint1']=='doesNot' && $constraint['constraint2']!='originate' && $constraint['constraint2']!='terminate') 
			{

 				$oppositeSet = array();
 				$positiveSet = array();

				$w.=''.Traceroute::buildWhere($constraint);
				$sqlTemp = $sql;
				$sqlTemp.=$w.$sqlOrder;
				$positiveSet = Traceroute::getTrSet($sqlTemp);
				
				/*echo '<br/><i>'.$sqlTemp.'</i>';
				echo '<br/>positiveSet: '.count($positiveSet);*/

				$doesNotChk = true;


				// getting oposite set for diff comparison
				$sqlOposite = $sql;
				$sqlOposite .= Traceroute::buildWhere($constraint,$doesNotChk);
				$sqlOposite .= $sqlOrder;
				$oppositeSet = Traceroute::getTrSet($sqlOposite);
				
				//echo '<br/><i>'.$sqlOposite.'</i>';
				//echo '<br/>Opposite Set: '.count($oppositeSet);

				$trSets[$conn] = array_diff($positiveSet,$oppositeSet);
				//echo '<hr/>'.count($trSets[$conn]);
				
				$doesNotChk = false;
 				unset($oppositeSet);
 				unset($positiveSet);
 				//unset($diff);

			} else {

				$w.=''.Traceroute::buildWhere($constraint);
				$sql .=$w.$sqlOrder;
				$trSets[$conn] = Traceroute::getTrSet($sql);
				$operands[$conn]=$constraint['constraint5'];
				//echo '<br/><i>'.$sql.'</i>';
			}

			//echo " | Traceroutes: <b>".count($trSets[$conn]).'</b>';

			//echo '<hr>';
			//print_r($constraint);
			
			//$sql .=$w.' and traceroute.id between '.$limit1.' AND '.$limit2.' order by tr_item.traceroute_id, tr_item.hop, tr_item.attempt';

			
			//LIMIT '.$limit.' OFFSET '.$offset.''

			

			//$newTrSet = array(Traceroute::getTrSet($constraint), $operand);
			

			//print_r($trSets[$conn]);
			//$trSets[$conn]=$newTrSet;

			//$sql.= " ".Traceroute::buildWhere($constraint);

			$conn++;

		} // end for each

		$trSetResult = array();

		//echo '<hr/>';

		for($i=0;$i<$conn;$i++)
		{
			$trSetResultTemp = array();
			// only one constraint
			if($i==0)
			{
				//$trSetResult=$trSets[0];
				$trSetResult = array_merge($trSetResult, $trSets[0]);

			// all in between 
			} else if ($i>0){
				if($data[$i-1]['constraint5']=='OR')
				{
				
/*					echo '<br/>OR case. Merging';
					echo '<br/>ToT trSetResult: '.count($trSetResult);
					echo '<br/>ToT trSets['.$i.']: '.count($trSets[$i]);
*/				

					$trSetResultTemp = array_merge($trSetResult,$trSets[$i]);
					//$trSetResultTemp = array_merge($trSets[$i-1],$trSets[$i]);
					$trSetResultTemp = array_unique($trSetResultTemp);

					//echo '<br/>ToT trSetResultTemp: '.count($trSetResultTemp);
					$trSetResult =  array_merge($trSetResult, $trSetResultTemp);

				} else {
					
					/*echo '<br/>AND case. Intersecting';
					echo '<br/>ToT trSetResult: '.count($trSetResult);
					echo '<br/>ToT trSets['.$i.']: '.count($trSets[$i]);*/

					//$trSetResultTemp = array_intersect($trSetResult,$trSets[$i]);
					$trSetResultTemp = array_intersect($trSetResult,$trSets[$i]);

					//echo '<br/>ToT trSetResultTemp: '.count($trSetResultTemp);					
				}

				$trSetResult =  array();
				$empty = array();
				$trSetResult = array_merge($empty, $trSetResultTemp);
				//$trSetResult =  array_merge($trSetResult, $trSetResultTemp);
			}

			//echo '<br/>--- ToT trSetResult: ['.$i.'] '.count($trSetResult);

		} // end for
			$trSetResultLast =  array_unique($trSetResult);

		//$trSetResult = array_intersect($trSets[0],$trSets[1],$trSets[2]);

		echo '<br/>Total traceroutes : <b>'.count($trSetResultLast)."</b>";

		//echo '<hr/>getTraceRoute: '.memory_get_usage();
		unset($trSetResult);
		unset($trSetResultTemp);
		unset($trSets);
		//echo '<hr/>getTraceRoute: '.memory_get_usage();

		return $trSetResultLast;

	} 

	/**
	
	*/
	// process the quicklinks with canned SQL
	public static function processQuickLink($qlArray)
	{
		// base sql 
		$sql = "SELECT as_users.num, tr_item.traceroute_id, traceroute.id, ip_addr_info.mm_city, ip_addr_info.ip_addr, ip_addr_info.asnum FROM as_users, tr_item, traceroute, ip_addr_info WHERE (tr_item.traceroute_id=traceroute.id) AND (ip_addr_info.ip_addr=tr_item.ip_addr) AND (as_users.num=ip_addr_info.asnum)";

		if ($qlArray[0]['constraint2']=="lastSubmission") {
			echo "Processing last submission request";
			//will get you the id of the last traceroute submitted
			$sql = "select id from traceroute order by sub_time desc limit 1"; 
			//echo '<hr/>'.$qlArray[0]['constraint2'].'<br/>SQL: '.$sql;
			return Traceroute::getTrSet($sql);
		} else if ($qlArray[0]['constraint2']=="recentRoutes") {
			echo "Processing last 50 submitted traceroutes";
  			$sql = 'select id from traceroute order by id desc limit 50';
  			
  			//echo '<hr/>'.$qlArray[0]['constraint2'].'<br/>SQL: '.$sql;
  			return Traceroute::getTrSet($sql);
		} else if ($qlArray[0]['constraint2']=="myCity") {
			echo "Processing my city request";

			// using MaxMind to find the city of client IP address
			$myIp = $_SERVER['REMOTE_ADDR'];

			$gi1 = geoip_open("../geoip/dat/GeoLiteCity.dat",GEOIP_STANDARD);
			$record1 = geoip_record_by_addr($gi1,$myIp);
			$myCity = ''.$record1->city;
			geoip_close($gi1);

			echo '<br/>My IP: '.$myIp;
			echo '<br/>My City: '.$myCity;
			echo "<br/><i>Using MaxMind's GeoLiteCity Database</i><br/>";
			
			$sql .= " AND ip_addr_info.mm_city LIKE '%".$myCity."%'";
			//echo '<hr/>'.$qlArray[0]['constraint2'].'<br/>SQL: '.$sql;
			if($myCity!='')
			{
				return Traceroute::getTrSet($sql);
			} else {
				return array();
			}
			
		} else {
			return array();
		}

	}

	/**
		Get long and lat for a tr set 
	*/

	public static function getIxMapsData($data)
	{
		global $dbconn, $trNumLimit;
		$result = array();
		$totTrs = count($data);
		//echo '<br/>Tot: '.$totTrs;

		// set index increase if total traceroutes is > $trNumLimit
		if($totTrs>$trNumLimit)
		{
			$indexJump = $totTrs/$trNumLimit;
			$indexJump = intval($indexJump)+1;
		} else {
			$indexJump = 1;
		}
		//echo '<br/>indexJump: '.$indexJump;
		//echo '<br/>Displaying the following traceroutes IDs: <br/>';

		$longLatArray = array();

		$wTrs = '';
		$trCoordinates = '';
		$trCollected = array();

		$c=0;
		// build SQL where for the given TR set
		//foreach ($data as $trId)
		for ($i=0; $i<$totTrs; $i+=$indexJump)
		// as $trId)
		{
			$trCollected[]=$data[$i];
			//echo ''.$data[$i].' | ';
			if($c==0)
			{
				$wTrs.=' traceroute.id='.$data[$i];

			} else {
				$wTrs.=' OR traceroute.id='.$data[$i];
			}
			$c++;
		}

		if($totTrs>$trNumLimit){
			echo '<p style="color:red;">
			Showing a sample of <b>'.$c.' traceroutes</b>.</p>';
		}
/*
		echo '<hr/>Showing the followng TRids:';
		foreach ($trCollected as $value) {
		 	echo ', '.$value;
		 } */


		// free some memory
		unset($data);

		$sql = "SELECT 
		tr_item.traceroute_id, tr_item.hop, tr_item.rtt_ms, 
		
		traceroute.id, traceroute.dest, traceroute.dest_ip, traceroute.submitter, traceroute.sub_time, 

		ip_addr_info.ip_addr, ip_addr_info.lat, ip_addr_info.long, ip_addr_info.mm_country, ip_addr_info.mm_city, ip_addr_info.gl_override, 
		
		as_users.num, as_users.name 

		FROM tr_item, traceroute, ip_addr_info, as_users WHERE (tr_item.traceroute_id=traceroute.id) AND (ip_addr_info.ip_addr=tr_item.ip_addr) AND (as_users.num=ip_addr_info.asnum) AND tr_item.attempt = 1 AND (".$wTrs.") order by tr_item.traceroute_id, tr_item.hop, tr_item.attempt";

		//echo '<textarea>'.$sql.'</textarea>';

		// free some memory
		$wTrs='';

		$result = pg_query($dbconn, $sql) or die('Query failed: ' . pg_last_error());
		//$tot = pg_num_rows($result);
		// get all data in a single array
		$trArr = pg_fetch_all($result);

		return $trArr;
		
		//return $trCollected;


	}

	/**
	
	*/
	public static function getAsNames()
	{
		global $dbconn, $as_num_color;
		$resultArray = array();

		$c=0;
		$sql = 'SELECT num, name FROM as_users where ';
		$w = '';

		foreach($as_num_color as $id => $val)
		{
			$resultArray[$id]['color']=$val;

			$c++;
			if($c==1)
			{
				$w .= ' num = '.$id;
			} else {
				$w .= ' OR num = '.$id;
			}
		}

		$sql .= ''.$w;

		//echo $sql;

		$result = pg_query($dbconn, $sql) or die('Query failed: ' . pg_last_error());

		//$data = pg_fetch_all($result);

		
		while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) 
		{
			//echo '<br/>'.$line['name'];
			$resultArray[$line['num']]['name'] = $line['name'];
		}

		///print_r($resultArray);

		$html='<table border="1" cellspacing="1" cellpadding="2" style="width: 300px">';
		foreach($resultArray as $asNum=>$asArray)
		{
			if($asArray['color']!='676A6B')
			{
				$html.='
			<tr><td>'.$asArray['name'].'</td><td style="background-color:'.$asArray['color'].'; width: 25px;"></td></tr>';
			}

		}
		$html.='</table>';

		echo $html;

	}
	/**

	*/
	public static function writeGmStart ($file,$fh) {

		$mapJs="

      function initializeMap() {
        var myLatLng = new google.maps.LatLng(44, -99);
        var mapOptions = {
		    scrollwheel: true,
		    navigationControl: true,
		    mapTypeControl: false,
		    scaleControl: true,
		    draggable: true,
          	zoom: 4,
          	center: myLatLng,
          	mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);

		";
		//$fh = fopen($file, 'w') or die("can't open file");
		fwrite($fh, $mapJs);
		//fclose($fh);
	}

	/**
	
	*/
	public static function writeGmEnd ($file,$fh,$jsonData) {

		$mapJs="

		document.location.href='#tot-trs';

		google.maps.event.addListener(map, 'click', function(event){
			//if(!mouse_in_polyline) {
				m_lat = event.latLng.lat();
				m_lng = event.latLng.lng()
		   		console.log('Lat: ' + m_lat + ' Lng: ' + m_lng);
		   		addCollectedCoord(m_lat,m_lng);
		   	//}
		});

      } // end initializeMap()

      var ixMapsData = '".$jsonData."';
      var ixMapsDataJson;

      loadMapData();

";

		//$mapJs.='<div id="map_canvas"></div>';

		//$fh = fopen($file, 'w') or die("can't open file");
		fwrite($fh, $mapJs);
		fclose($fh);
		
	}

	/**
	
	*/
	public static function generateGoogleMapsJs (
		$data, 
		$addPolylines=false, 
		$addMarkers=false, $showHopNums=false, 
		$addInfoWin=false)
	{
		global $coordExclude, $webUrl, $savePath, $webUrl, $as_num_color;
		
		$trDataToJson = array();

		$date = md5(date('d-m-o_G-i-s'));
		$gmFile = $date.".js";
		$myFile = $savePath."/".$gmFile;
		$fh = fopen($myFile, 'w') or die("can't open file");

		Traceroute::writeGmStart($myFile,$fh);

		$gMapJs = '';
		$markers = '';
		$infoWin ='';
		$infoWinTmpl ='<div></div>';
		$icon_01 = "";
		$trIdsCounter = 0;

		// loop TRids
		foreach($data as $trId => $hops)
		{
			$trIdsCounter++;
			$totHops = count($hops);
			$c = 0;
			
			$trCoordinates = '';
			
			// loop hops in a TRid
			for($r=0;$r<count($hops);$r++)
			{
				$c++;
/*				echo '<hr/>';
				print_r($hop);

*/
				// new approach: use for loopinging in a way that previous hops' data can be accessed easily 

				// minimal data for map generation
				$ip = $hops[$r][0];
				$hopN = $hops[$r][1];
				$lat = $hops[$r][2];
				$long = $hops[$r][3];
				$id = $hops[$r][4];
				$asNum = $hops[$r][5];
				$asName = $hops[$r][6];
				$cEx = "$lat,$long";

				$mm_city = $hops[$r][10];
				$mm_city = str_replace("'"," ",$mm_city);
				//$mm_city = "";

				$gl_override = $hops[$r][14];

				//$gl_override = 'hola';
				
				// FIXME: need to exclude the 
/*				if($gl_override==null || $gl_override=="" || $gl_override=="null"){
					$gl_override="0";
				}
*/
				// full data to export to json
				$trDataToJson[$id][$hopN]=array(
					'asNum'=>$asNum,
					'asName'=>$asName,
					'ip'=>$ip,
					'lat'=>$lat,
					'long'=>$long,
					'mm_city'=>$mm_city,
					'mm_country'=>$hops[$r][11],
					//'sub_time'=>$hops[$r][12],
					'rtt_ms'=>$hops[$r][13],
					'gl_override'=>$gl_override,
					'dist_from_origin'=>$hops[$r][15],
					'imp_dist'=>$hops[$r][16],
					'time_light'=>$hops[$r][17],
					'latOrigin'=>$hops[$r][18],
					'longOrigin'=>$hops[$r][19],
				);

/*
				$ip, 0
				$hop, 1
				$lat, 2
				$long, 3
				$trId, 4
				$num, 5
				$name, 6
				$trArr[$i]['dest'], 7
				$trArr[$i]['dest_ip'], 8
				$trArr[$i]['submitter'], 9
				$trArr[$i]['mm_city'], 10
				$trArr[$i]['mm_country'], 11
				$trArr[$i]['sub_time'], 12
				$trArr[$i]['rtt_ms'], 13
				$trArr[$i]['gl_override'] 14
				$dist_from_origin, 15
				$imp_dist, 16
				$time_light_will_do, 17
*/

// determne geo-precision 
				/*
       if ip_dict[ip]['override']:

            #this is a little different than tr-detail, maybe FIX?
            lat_digits = len(str(d['lat'])) - str(d['lat']).find('.') - 1
            long_digits = len(str(d['long'])) - str(d['long']).find('.') - 1
            if lat_digits >= 5 or long_digits >= 5:
                ip_dict[ip]['geo_precision'] = 'building level'
            elif lat_digits <= 2 or long_digits <= 2:
                ip_dict[ip]['geo_precision'] = 'city level'
            else:
                ip_dict[ip]['geo_precision'] = 'Maxmind'

				*/
				// this is experimental: not really accurate
				//if($lat!=0 && $long!=0 && (!in_array($cEx, $coordExclude))) 
				//if($lat!=0 && $long!=0) 
				
				// collecting all
				if($lat) 
				{
/*					$trDataToJson[$id][$hopN]=array(
						'asNum'=>$asNum,
						'asName'=>$asName,
						'ip'=>$ip,
						'lat'=>$lat,
						'long'=>$long,
						'rtt_ms'=>
					);*/

				}

				// ANTO's way: show all, even if it is inaccurate
				//if($lat!=0 && $long!=0)
				if($ip)
				//if($cEx) 
				{
					// match ISP name for colouring

					// new approach each hop is represented as a unique polyline

					//	1. exclude first hop
					if($r!=0)
					{
						//NOT working very well when excluding inaccurate coordinates of pevious hop
						// TODO: we need a record of the hops skipped so there are no holes in the path.

						$lat1 = $hops[$r-1][2];
						$long1 = $hops[$r-1][3];
						$lat2 = $hops[$r][2];
						$long2 = $hops[$r][3];
						$cEx1 = "$lat1,$long1";
						$cEx2 = "$lat2,$long2";

						
						// testing excluding methods, still a long way to go ;)

						//if($lat1!=0 && $long1!=0 && $lat2!=0 && $long2!=0 && (!in_array($cEx1, $coordExclude)) && (!in_array($cEx2, $coordExclude)) ) {

						// (NEW!) exclude the construction of a polyline object when the two poins are the same coordinates. This saves a lot of innecesary/invisible segments

						//if($lat1!=0 && $long1!=0 && $lat2!=0 && $long2!=0 && ($lat1!=$lat2 && $long1!=$long2) && (!in_array($cEx1, $coordExclude)) && (!in_array($cEx2, $coordExclude))) 
						if($lat1!=0 && $long1!=0 && $lat2!=0 && $long2!=0 && ($lat1!=$lat2 && $long1!=$long2) && (!in_array($cEx1, $coordExclude)) && (!in_array($cEx2, $coordExclude))) 
						{

/*							$trDataToJson[$id][$hopN]=array(
								'asNum'=>$asNum,
								'asName'=>$asName,
								'ip'=>$ip,
								'lat'=>$lat,
								'long'=>$long
							);*/

							$hopCoordinates = '
							new google.maps.LatLng('.$lat1.', '.$long1.'),
							new google.maps.LatLng('.$lat2.', '.$long2.')';

							// get colour
							//)
							if(!isset($as_num_color[$hops[$r-1][5]]))
							{
								$hopC = '#676A6B';
							} else {

								$hopC = '#'.$as_num_color[$asNum];
							}
							
							if($addPolylines) {

								// build Hop polyline obj
								$hopCoordinatesObj = "
							    var hopRoute_".$id."_".$hopN." = [".$hopCoordinates."
							    ];

							    var hopRoutePath_".$id."_".$hopN." = new google.maps.Polyline({
							      path: hopRoute_".$id."_".$hopN.",
							      strokeColor: '".$hopC."',
							      strokeOpacity: 0.6,
							      strokeWeight: 6.0
							    });

								trCollection.push(hopRoutePath_".$id."_".$hopN.");

							    hopRoutePath_".$id."_".$hopN.".setMap(map);
							    ";

							    // adding event listener to polyline object
							    $hopCoordinatesObj .="
								google.maps.event.addListener(hopRoutePath_".$id."_".$hopN.", 'click', function() {
								  trHopClick(".$id.",".$hopN.");
								});

								google.maps.event.addListener(hopRoutePath_".$id."_".$hopN.", 'mouseover', function() {
									trHopMouseover(".$id.",".$hopN.");
								});

								google.maps.event.addListener(hopRoutePath_".$id."_".$hopN.", 'mouseout', function() {
									trHopMouseout(".$id.",".$hopN.");
								});
							    ";

							    // add hopCoordinatesObj
				        		fwrite($fh, $hopCoordinatesObj);
				        	}

						///////////
					} // end if exclude wrong coordinates
				} // end exclude first hop

					if($c==$totHops) // last hop
					{
						$trCoordinates .= '
					new google.maps.LatLng('.$lat.', '.$long.','.$id.')';
					} else {
					// 	'.$ip.' : '.$hopN.'
						$trCoordinates .= '
					new google.maps.LatLng('.$lat.', '.$long.','.$id.'),';
					}

					if($addMarkers) {

						// get icon colour
						if(!isset($as_num_color[$asNum])){
							$iconColour = '676A6B';
						} else {
							$iconColour = $as_num_color[$asNum];
						}

						// add marker
						$markers.= "
						var tr_".$id.'_H'.$hopN." = new google.maps.LatLng(".$lat.",".$long.")
						var marker".$id.'_H'.$hopN." = new google.maps.Marker({
					      position: tr_".$id.'_H'.$hopN.",
					      map: map,";
					      if(!$showHopNums) {
						      $markers.= "
						      icon: {
						        path: google.maps.SymbolPath.CIRCLE,
						        fillOpacity: 0.5,
						        fillColor: '#".$iconColour."',
						        strokeOpacity: 1.0,
						        strokeColor: '#000000',
						        strokeWeight: 1.0,
						        scale: 7,
						      	},";
							}
					      $markers.= "
					      title:'".$ip."'
							});";
						
						if($showHopNums) {
						// set icon
							$markers.= "marker".$id.'_H'.$hopN.".setIcon('".$webUrl."/images/"."hop".$hopN.".png');";
						}

					} // end if markers

					// add info window
					if($addInfoWin) {
						$infoWin .="
						var infoC_".$id.'_H'.$hopN." = '<div class=\"info-win-text\">IP: <b>".$ip."</b> | (".$lat.",".$long.")<br/>TRid: <b>".$id."</b> | hop: <b>".$hopN."</b><br/>AS: <b>".$asNum."</b> <br/>Carrier: <b>".$asName."</b><br/><a href=\"javascript: viewTrDetails(".$id.")\">Traceroute Detail</a></div>';

						var infoW_".$id.'_H'.$hopN." = new google.maps.InfoWindow({
						    content: infoC_".$id.'_H'.$hopN.",
						});

						google.maps.event.addListener(marker".$id.'_H'.$hopN.", 'click', function() {
						  infoW_".$id.'_H'.$hopN.".open(map,marker".$id.'_H'.$hopN.");
						});";
					} // end if infowin

				} // end geoprecision exclude

			} // end loop 2


			/*old approach, not used for now 
			we now build a polyline for each pair*/

			// build polyline obj
			$trCoordinatesObj = "
		    var traceRoute".$trId." = [".$trCoordinates."
		    ];

		    var traceRoutePath".$trId." = new google.maps.Polyline({
		      path: traceRoute".$trId.",
		      strokeColor: '".Traceroute::getColor()."',
		      strokeOpacity: 1.0,
		      strokeWeight: 3
		    });

		    traceRoutePath".$trId.".setMap(map);

		    ";

	        // add traceroute to js
	        //$gMapJs .=''.$trCoordinatesObj;

	        // write to file
	        //fwrite($fh, $trCoordinatesObj);
	        
	        if($addMarkers) {
	        	fwrite($fh, $markers);
	        }
	        if($addInfoWin) {
	        	fwrite($fh, $infoWin);
	    	}

	        // reset variables
	        $trCoordinatesObj = '';
	        $markers = '';
	        $infoWin = '';


		} // end loop 1

		// add markers
		//$gMapJs.=''.$markers;

		// add info window and click event listeners
		//$gMapJs.=''.$infoWin;

		//echo '<textarea>'.$gMapJs.''.$infoWin.'</textarea>';
		//$date = date('d ');

		$trDataToJsonS = json_encode($trDataToJson);
		//$trDataToJsonS = "";
		
		unset($trDataToJson);
		
		Traceroute::writeGmEnd($myFile, $fh, $trDataToJsonS);
		
		unset($trDataToJsonS);

		//fclose($fh);

		//Traceroute::renderMap($gMapJs);

		echo '<script src="'.$webUrl.'/gm-temp/'.$gmFile.'"></script>
		
		<div style="clear: both;">

		';
	}


	/**
	Not used: new approach writes js
	*/
	public static function renderMap($gMapJs)
	{
		$mapJs="
    <script>

    </script>
		";

		$mapJs.='<div id="map_canvas"></div>';

		echo $mapJs;

		//echo '<textarea>'.$mapJs.'</textarea>';
	}

	/**
	
	*/
	public static function dataTransform($trArr)
	{
		global $savePath, $webUrl;
/*		echo '<textarea>';
		print_r($trArr);
		echo '</textarea>';*/
		$date = md5(date('d-m-o_G-i-s'));
		$myLogFile = $savePath."/"."_log_".$date.".csv";
		$myLogFileWeb = $webUrl.'/gm-temp/_log_'.$date.".csv";
		//$fhLog = fopen($myLogFile, 'w') or die("can't open file");

		$dist_from_origin=0;
		$latOrigin = 0;
		$longOrigin = 0;
		$originAsn = 0;
		$imp_dist = 0;
		$imp_dist_txt = '"Trid";"Hop";"Country";"City";"ASN";"IP";"Latency";"Time SoL";"Distance From Origin (KM)";"gl_override";"Origin Lat";"Origin Long"; "Origin ASN"
';
		//fwrite($fhLog, $imp_dist_txt);

		$time_light_will_do = 0;


		$trData = array();

		// distance speed of light in KM per 1 milsec
		$SL = 200;
		//$SL = 86;
		

		for($i=0;$i<count($trArr);$i++)
		{
			$dist_from_origin=0;
			//$latOrigin = 0;
			//$longOrigin = 0;
			$imp_dist = 0;
			$imp_dist_txt = '';
			$time_light_will_do = 0;

			$trId = $trArr[$i]['id'];
			$hop = $trArr[$i]['hop'];
			$ip = $trArr[$i]['ip_addr'];
/*			$lat = $trArr[$i]['mm_lat'];
			$long = $trArr[$i]['mm_long'];
*/
			$lat = $trArr[$i]['lat'];
			$long = $trArr[$i]['long'];

			$num = $trArr[$i]['num'];
			$name = $trArr[$i]['name'];

			$rtt_ms = $trArr[$i]['rtt_ms'];

			// calclulate first hop for first hop available: note this is not 100% acurate
			//if($i==0){
			if($hop==1){
				$latOrigin = $lat;
				$longOrigin = $long;
				$originAsn = $num;
			} else {
				// calculate distance from origin
				$dist_from_origin = Traceroute::distance($latOrigin, $longOrigin, $lat, $long, false);
				$time_light_will_do = $dist_from_origin/$SL;
				$time_light_will_do *= 2;
		
				// is it an imposible time? distance?
				if($rtt_ms<$time_light_will_do){
					$imp_dist = 1;
					//$imp_dist_txt = '<b>YES!</b>';
				}
			}

			$trData[$trId][]=array(
				$ip,
				$hop,
				$lat,
				$long,
				$trId,
				$num,
				$name,
				$trArr[$i]['dest'],
				$trArr[$i]['dest_ip'],
				$trArr[$i]['submitter'],
				$trArr[$i]['mm_city'],
				$trArr[$i]['mm_country'],
				$trArr[$i]['sub_time'],
				$trArr[$i]['rtt_ms'],
				$trArr[$i]['gl_override'],
				$dist_from_origin,
				$imp_dist,
				$time_light_will_do,
				$latOrigin,
				$longOrigin
			);

			// write impossible distances to a file: this method seems to be more secure that jQuery
			if($imp_dist==1){
				$impDistanceLog = ''.$trId.';'.$hop.';"'.$trArr[$i]['mm_country'].'";"'.$trArr[$i]['mm_city'].'";'.$num.';"'.$ip.'";'.$trArr[$i]['rtt_ms'].';'.$time_light_will_do.';"'.$dist_from_origin.'";'.$trArr[$i]['gl_override'].';"'.$latOrigin.'";"'.$longOrigin.'";"'.$originAsn.'"
';
				//echo '<br/>'.$imp_dist_txt.$impDistanceLog;

				//fwrite($fhLog, $impDistanceLog);
			}

		} // end for 

		//fclose($fhLog);
		//echo '<br/>Impossible Distances log saved at <a href="'.$myLogFileWeb.'">_log_'.$date.'.csv</a>';
		unset($trArr);
		return $trData;

		//unset($trData);
		
/*		echo '<hr/><textarea>';
		print_r($trData);
		echo '</textarea>';
*/
	}

	/**

	*/
	public static function renderTrSets($data)
	{
		$html = '
		<div id="tr-list-ids" class="map-info-containers-- tr-list-result">
		<table id="tr-list-table" class="tablesorter">
		<thead> 
		<tr>
			<th>ID</th>
			<th>Submitter</th>
			<th>Date</th>
			<th>Country</th>
			<th>Origin city</th>
			<th>Destination city</th>
			<th>Destination URL</th>
			<th>Destination IP</th>
		</tr>
		</thead> 
		<tbody>
		';
		foreach($data as $trId => $trIdData)
		{
			//print_r($trIdData);
			//$onMouseOver = " onmouseover='showThisTr(".$trId.")'";
			$onMouseOver = " onmouseout='removeTr()' onmouseover='renderTr2(".$trId.")' onfocus='showThisTr(".$trId.")'";
			//$onMouseOver = "";
			//$onClick = "javascript: viewTrDetails(".$trId.");";
			$onClick = "javascript: showThisTr(".$trId.");";

/*			$active="";
			if(in_array($trId, $collected)){
				$active = " tr-item-active";
			}*/
			$lastHopIdx = count($trIdData);
			$html .='
			<tr>

				<td><a id="tr-a-'.$trId.'" class="tr-list-ids-item '.$active.'" href="'.$onClick.'" '.$onMouseOver.'>'.$trId.'</td></a>
				<td>'.$trIdData[0][9].'</td>
				<td>'.$trIdData[0][12].'</td>
				<td>'.$trIdData[0][11].'</td>
				<td>'.$trIdData[0][10].'</td>
				<td>'.$trIdData[$lastHopIdx-1][10].'</td>
				<td>'.$trIdData[0][7].'</td>
				<td>'.$trIdData[0][8].'</td>
			</tr>
			';
		}
		$html .= '
		</tbody>
		</table>
		</div>';
		unset($data);

		echo $html;
		unset($html);

	}
	/**

	*/
	public static function saveSearch($qArray)
	{
		global $dbconn;
		$data_json = json_encode($qArray);
		$sql = "INSERT INTO s_log (timestamp, log) VALUES (NOW(),'".$data_json."');";
		//echo '<hr/>'.$sql;
		pg_query($dbconn, $sql) or die('Error! Insert Log failed: ' . pg_last_error());
		//pg_free_result($result);
		//pg_close($dbconn);
	}

	/**

	*/
	public static function testArrays()
	{
		$a = array(1,2,3,4,5,6);
		$b = array(2,4,10);

		$c =  array_merge($a, $b);
		$d = array_unique($c);

		print_r($c);

		print_r($d);
	}	

	public static function testSqlUnique($sql)
	{
		global $dbconn;

		echo '<hr/>'.$sql;

		$trSet = array();
		$result = pg_query($dbconn, $sql) or die('Query failed: ' . pg_last_error());
		$data = array();
		$data1 = array();
		$id_last = 0;
		$c = 0;
		while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
		    //$c++;
		    $id=$line['id'];  
/*		    
		    if($id!=$id_last){
		    	$data[]=$id;
			}
*/
			$data[]=$id;
		    //$id_last=$id;
		}
		$data1 = array_unique($data);
		//print_r($data);

		echo " | Traceroutes: <b>".count($data1).'</b>';
		echo " | Hops: ".count($data);
		// Free resultset
		pg_free_result($result);

		return $data1;
		// Closing connection
		pg_close($dbconn);
	}	

	public static function destinationLastHopCk()
	{
		global $dbconn;
		
		$ips = array();

		$sql = "select ip_addr, hostname from ip_addr_info order by hostname";
		$result = pg_query($dbconn, $sql) or die('Query failed: ' . pg_last_error());
				
		$c = 0;
		while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
		   
		    $ip=$line['ip_addr'];  
		    $hostname=$line['hostname'];  
			
		    //$id_last=$id;
			$sql1 = "select COUNT(*) from ip_addr_info where hostname = '".$hostname."'";
			//echo '<br/>'.$sql1;
		
			$result1 = pg_query($dbconn, $sql1) or die('Query failed: ' . pg_last_error());
			//print_r($result1);
			$c1 = 0;
			while ($line1 = pg_fetch_array($result1, null, PGSQL_ASSOC)) {

				$c1++;
			}
			echo '<br>--'.$c1.' : '.$ip.' : '. $hostname;

/*			if($c1>1)
			{	
				$c++;
				echo '<br>'.$c1.' : '.$ip.' : '. $hostname;
			}
*/			
		}
		//$data1 = array_unique($data);
		//print_r($data);
		echo '<hr>Tot hostnames with more than one ip: '.$c;
		pg_free_result($result);

		//return $data1;
		// Closing connection
		pg_close($dbconn);
	}	

	public static function renderSearchLog()
	{
		global $dbconn;
		$html = '<table border="1">';
		$c = 0;
		$sql = "select * from s_log order by id DESC";
		$result = pg_query($dbconn, $sql) or die('Query failed: ' . pg_last_error());
		while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
		    $id=$line['id']; 
		    $timestamp=$line['timestamp'];
		    $log=$line['log'];
		    $log=str_replace('"[', '[', $log); 
		    $log=str_replace(']"', ']', $log); 
		    $logToArray = json_decode($log, true);

		    $c++;
			
			$html .= '<tr>';
			$html .= '<td><a href="#">'.$id.'</a></td>';
			$html .= '<td>'.$timestamp.'</td>';

			$q = '<td>';
			foreach ($logToArray as $constraint) {
				$q .='<br/> | '
				.$constraint['constraint1'].' | '
				.$constraint['constraint2'].' | '
				.$constraint['constraint3'].' | '
				.$constraint['constraint4'].' | '
				.$constraint['constraint5'].' | ';
				//print_r($constraint);
			}

			//$q .= $log.'<hr/>'.$queryOp.'</td>';
			$q .= '</td>';
			$html .= ''.$q;
			
			$html .= '</tr>';
		}
		$html .= '</table>';
		pg_free_result($result);
		pg_close($dbconn);
		echo 'Tot queries: '.$c.'<hr/>';
		echo $html;
	}


	public static function getColor()
	{
		$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
		$color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
		return $color;
	}

	// functions for Auto-complete ajax calls
	public static function getAutoCompleteData($sField, $sKeyword)
	{
		global $dbconn;
		// query ip_add_info table 
		$minL = 0;
		
		// proceed only if lenght is > $minL

		if(strlen($sKeyword)>$minL)
		{
			$tColumn = "";
			$tTable = "ip_addr_info";
			$tOrder = "";
			$tWhere = "";
			$tSelect = 'SELECT';

			if($sField=="country")
			{
				$tColumn = 'mm_country';
				$sKeyword = strtoupper($sKeyword);
				$tOrder = $tColumn;

			} else if($sField=="region") {
				$tColumn = 'mm_region';
				$sKeyword = ucwords(strtolower($sKeyword));
				$tOrder = $tColumn;

			} else if($sField=="city") {
				$tColumn = 'mm_city';
				$sKeyword = ucwords(strtolower($sKeyword));
				$tOrder = $tColumn;
			} else if($sField=="zipCode") {
				$tColumn = 'mm_postal';
				$sKeyword = ucwords(strtolower($sKeyword));
				$tOrder = $tColumn;
			} else if($sField=="ISP") {
				$tColumn = 'num, name';
				$sKeyword = ucwords(strtolower($sKeyword));
				$tOrder = "name";
				$tTable = "as_users";
				$tWhere = "WHERE short_name is not null";
			} else if($sField=="submitter") {
				$tSelect = 'SELECT distinct';
				$tColumn = 'submitter';
				$sKeyword = $sKeyword;
				$tOrder = "submitter";
				$tTable = "traceroute";
				$tWhere = "";//WHERE submitter NOT LIKE '%$%'";
				//select distinct submitter from traceroute order by submitter 
			}
			

			//$sql = "SELECT $tColumn FROM ip_addr_info WHERE $tColumn LIKE '$sKeyword%' ORDER BY $tColumn";

			// loading all approach
			$sql = "$tSelect $tColumn FROM $tTable $tWhere ORDER BY $tOrder";
			//echo '<hr/>';

			$result = array();
			$autoC = array();
			$result = pg_query($dbconn, $sql) or die('Query failed: ' . pg_last_error());
			while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
		    	if($sField=="ISP") {
		    		$autoC[$line['num']]=$line['name'];
		    	} else {
		    		$autoC[]=$line[$tColumn]; 
		    	}
			}			
			$unique = array_unique($autoC);
			sort($unique);
			pg_free_result($result);
			pg_close($dbconn);			
			
			//print_r($autoC);
			//print_r($unique);
/*			echo '<hr/><b>';
			foreach ($unique as $r) {
				echo ''.$r.', ';
			}
			echo '<hr/></b>';
*/
			return json_encode($unique);

		} else {
			echo 'keyword is too short';
		}// end if

	}

} // end class

$as_num_color = array (
	 "174"  => "E431EB",
	 "3356"  => "EB7231",
	 "7018"  => "42EDEA",
	 "7132"  => "42EDEA",
	 "-1"  => "676A6B",
	 "577"  => "3D49EB",
	 "1239"  => "ECF244",
	 "6461"  => "E3AEEB",
	 "6327"  => "9C6846",
	 "6453"  => "676A6B",
	 "3561"  => "676A6B",
	 "812"  => "ED0924",
	 "20453"  => "ED0924",
	 "852"  => "4BE625",
	 "13768"  => "419C6B",
	 "3257"  => "676A6B",
	 "1299"  => "676A6B",
	 "22822"  => "676A6B",
	 "6939"  => "676A6B",
	 "376"  => "676A6B",
	 "32613"  => "676A6B",
	 "6539"  => "3D49EB",
	 "15290"  => "676A6B",
	 "5769"  => "676A6B",
	 "855"  => "676A6B",
	 "26677"  => "676A6B",
	 "271"  => "676A6B",
	 "6509"  => "676A6B",
	 "3320"  => "676A6B",
	 "23498"  => "676A6B",
	 "549"  => "676A6B",
	 "239"  => "676A6B",
	 "11260"  => "676A6B",
	 "1257"  => "676A6B",
	 "20940"  => "676A6B",
	 "23136"  => "676A6B",
	 "5645"  => "676A6B",
	 "21949"  => "676A6B",
	 "8111"  => "676A6B",
	 "13826"  => "676A6B",
	 "16580"  => "676A6B",
	 "9498"  => "676A6B",
	 "802"  => "676A6B",
	 "19752"  => "676A6B",
	 "11854"  => "676A6B",
	 "7992"  => "676A6B",
	 "17001"  => "676A6B",
	 "611"  => "676A6B",
	 "19080"  => "676A6B",
	 "26788"  => "676A6B",
	 "12021"  => "676A6B",
	 "33554"  => "676A6B",
	 "30528"  => "676A6B",
	 "16462"  => "676A6B",
	 "11700"  => "676A6B",
	 "14472"  => "676A6B",
	 "13601"  => "676A6B",
	 "11032"  => "676A6B",
	 "12093"  => "676A6B",
	 "10533"  => "676A6B",
	 "26071"  => "676A6B",
	 "32156"  => "676A6B",
	 "5764"  => "676A6B",
	 "27168"  => "676A6B",
	 "33361"  => "676A6B",
	 "32489"  => "676A6B",
	 "15296"  => "676A6B",
	 "10400"  => "676A6B",
	 "10965"  => "676A6B",
	 "18650"  => "676A6B",
	 "36522"  => "676A6B",
	 "19086"  => "676A6B"
);
?>


