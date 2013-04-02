<?php
class Traceroute
{
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


	public static function buildWhere($c) 
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
		if($c['constraint1']=='does')
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
			$constraint_value = ucwords(strtolower($constraint_value));
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
		

		// add here camel format

		//if($ixmaps_debug_mode) {
			echo '<br><b>'.$c['constraint1'].' : '.$c['constraint2'].' : '.$c['constraint3'].' : '.$c['constraint4'].' : '.$c['constraint5'].'</b>';
		//}

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
		Get TR id for a given sql query
	*/
	public static function getTrSet($sql)
	{
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
		$data_array = json_decode($data, ture);
		$trSets = array();
		$conn = 0;
		$limit1 = 4500;
		$limit2 = 5000;
		$offset = 0;

		// loop constraints
		foreach($data_array as $constraint)
		{
			$w = '';
			$sql = '';

				$sql = "SELECT as_users.num, tr_item.traceroute_id, traceroute.id, ip_addr_info.mm_city, ip_addr_info.ip_addr, ip_addr_info.asnum FROM as_users, tr_item, traceroute, ip_addr_info WHERE (tr_item.traceroute_id=traceroute.id) AND (ip_addr_info.ip_addr=tr_item.ip_addr) AND (as_users.num=ip_addr_info.asnum)";

			$w.=''.Traceroute::buildWhere($constraint);
			//$sql .=$w.' and traceroute.id between '.$limit1.' AND '.$limit2.' order by tr_item.traceroute_id, tr_item.hop, tr_item.attempt';

			$sql .=$w.' order by tr_item.traceroute_id, tr_item.hop, tr_item.attempt';
			//LIMIT '.$limit.' OFFSET '.$offset.''

			//echo '<br/><i>'.$sql.'</i>';

			//$newTrSet = array(Traceroute::getTrSet($constraint), $operand);
			$trSets[$conn] = Traceroute::getTrSet($sql);

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

				if($data_array[$i-1]['constraint5']=='OR')
				{
				/*
					echo '<br/>OR case. Merging';
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

		echo '<hr/><a name="tot-trs" id="tot-trs"></a>Total traceroutes : <b>'.count($trSetResultLast)."</b>";

		//echo '<hr/>getTraceRoute: '.memory_get_usage();
		unset($trSetResult);
		unset($trSetResultTemp);
		unset($trSets);
		//echo '<hr/>getTraceRoute: '.memory_get_usage();

		return $trSetResultLast;
	} 

	/**
		Get long and lat for a tr set 
	*/

	public static function getLongLat($data)
	{
		global $dbconn, $trNumLimit;
		$result = array();
		
		$longLatArray = array();

		$wTrs = '';
		$trCoordinates = '';

		$c=0;

		// build SQL where for the given TR set
		foreach ($data as $trId)
		{
			if($c==0){
				$wTrs.=' traceroute.id='.$trId;

			} else {
				$wTrs.=' OR traceroute.id='.$trId;
			}
			$c++;
			if($c==$trNumLimit){
				echo '<p style="color:red;">The number of traceroutes exceeded the limit. <br/>Displaying the first <b>'.$trNumLimit.' records</b>. 
				<br/> Please add new parameters to your Custom Filter.</p>';
				break;
			}

		}

		// free some memory here
		unset($data);

		// ANTO says: only one query to the db is the way!
//		$sql = "SELECT tr_item.traceroute_id, tr_item.hop, traceroute.id, ip_addr_info.ip_addr, ip_addr_info.mm_lat, ip_addr_info.mm_long FROM tr_item, traceroute, ip_addr_info WHERE (tr_item.traceroute_id=traceroute.id) AND (ip_addr_info.ip_addr=tr_item.ip_addr) AND tr_item.attempt = 1 AND (".$wTrs.") order by tr_item.traceroute_id, tr_item.hop, tr_item.attempt";

		$sql = "SELECT tr_item.traceroute_id, tr_item.hop, traceroute.id, ip_addr_info.ip_addr, ip_addr_info.lat, ip_addr_info.long, as_users.num, as_users.name FROM tr_item, traceroute, ip_addr_info, as_users WHERE (tr_item.traceroute_id=traceroute.id) AND (ip_addr_info.ip_addr=tr_item.ip_addr) AND (as_users.num=ip_addr_info.asnum) AND tr_item.attempt = 1 AND (".$wTrs.") order by tr_item.traceroute_id, tr_item.hop, tr_item.attempt";

		//echo '<textarea>'.$sql.'</textarea>';

		$wTrs='';

		$result = pg_query($dbconn, $sql) or die('Query failed: ' . pg_last_error());
		//$tot = pg_num_rows($result);
		// get all data in a single array
		$trArr = pg_fetch_all($result);

		//return $trArr;
		Traceroute::dataTrensform($trArr);
	}

	public static function writeGmStart ($file,$fh) {

		$mapJs="
      function initializeMap() {
        var myLatLng = new google.maps.LatLng(44, -99);
        var mapOptions = {
          zoom: 3,
          center: myLatLng,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);

		";
		//$fh = fopen($file, 'w') or die("can't open file");
		fwrite($fh, $mapJs);
		//fclose($fh);
	}
	
	public static function writeGmEnd ($file,$fh) {

		$mapJs="

		document.location.href='#tot-trs';
      }
";

		//$mapJs.='<div id="map_canvas"></div>';

		//$fh = fopen($file, 'w') or die("can't open file");
		fwrite($fh, $mapJs);
		fclose($fh);
		
	}
	public static function generatePolylineObject ($data, $addMarkers=true, $addInfoWin=true)
	{
		global $coordExclude, $webUrl, $savePath, $webUrl;

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

		foreach($data as $trId => $hops)
		{
			$totHops = count($hops);
			$c = 0;
			
			$trCoordinates = '';
			

			foreach($hops as $hop)
			{
				$c++;
/*				echo '<hr/>';
				print_r($hop);
*/
				$ip = $hop[0];
				$hopN = $hop[1];
				$lat = $hop[2];
				$long = $hop[3];
				$id = $hop[4];
				$asNum = $hop[5];
				$asName = $hop[6];

				$cEx = "$lat,$long";


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
				if($lat!=0 && $long!=0 && (!in_array($cEx, $coordExclude)))
				{
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
						// add marker
						$markers.= "
						var tr_".$id.'_H'.$hopN." = new google.maps.LatLng(".$lat.",".$long.")
						var marker".$id.'_H'.$hopN." = new google.maps.Marker({
					      position: tr_".$id.'_H'.$hopN.",
					      map: map,
					      title:'".$ip."'
							});";
						
						// set icon
						$markers.= "marker".$id.'_H'.$hopN.".setIcon('".$webUrl."/images/"."hop".$hopN.".png');";
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
	        fwrite($fh, $trCoordinatesObj);
	        
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

		Traceroute::writeGmEnd($myFile, $fh);

		//fclose($fh);

		//Traceroute::renderMap($gMapJs);

		echo '<script src="'.$webUrl.'/gm-temp/'.$gmFile.'"></script>
		<div id="map_canvas"></div>';


	}


	public static function renderMap($gMapJs)
	{
		$mapJs="
    <script>

      function initializeMap() {
        var myLatLng = new google.maps.LatLng(44, -99);
        var mapOptions = {
          zoom: 3,
          center: myLatLng,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
		".$gMapJs."

		//jQuery('#tot-trs').focus();
		document.location.href='#tot-trs';
      }
    </script>
		";

		$mapJs.='<div id="map_canvas"></div>';

		echo $mapJs;

		//echo '<textarea>'.$mapJs.'</textarea>';
	}

	public static function dataTrensform($trArr)
	{
		$trData = array();

		for($i=0;$i<count($trArr);$i++)
		{
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

			$trData[$trId][]=array($ip,$hop,$lat,$long,$trId,$num,$name);

		} // end for 
		unset($trArr);

		Traceroute::generatePolylineObject($trData);

		unset($trData);
		
/*		echo '<hr/><textarea>';
		print_r($trData);
		echo '</textarea>';
*/
	}

	/**

	*/
	public static function renderTrSets($data)
	{
		if(count($data)!=0)
		{
			Traceroute::getLongLat($data);
		}

		$html = '<hr/>';
		foreach($data as $trId)
		{

			$html .=' | <a href="javascript: viewTrDetails('.$trId.');">'.$trId.'</a>';

		}
		unset($data);

		echo $html;

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
} // end class
?>