<?php
class IXmapsGeoCorrection
{
	
	public static function getIpAddrInfo($limit, $type=0, $ip='')
	{
		global $dbconn;

		// select last ip
		if($type==0){

			// check last ip
			$sql = "SELECT ip_addr FROM log_ip_addr_info ORDER BY ip_addr DESC LIMIT 1";
			$result = pg_query($dbconn, $sql);
			$lastIp = pg_fetch_all($result);
			//var_dump($lastIp);

			if($lastIp==false){
				$sql1 = "SELECT * FROM ip_addr_info ORDER BY ip_addr LIMIT $limit";
			} else {
				$sql1 = "SELECT * FROM ip_addr_info WHERE ip_addr > '".$lastIp[0]['ip_addr']."' ORDER BY ip_addr LIMIT $limit";
			}

		} else if($type==1){
			$sql1 = "SELECT ip_addr, lat, long, mm_country, mm_region, mm_city FROM ip_addr_info WHERE p_status='G';";
		}

		$result1 = pg_query($dbconn, $sql1);
		$ipAddrInfo = pg_fetch_all($result1);
		//print_r($ipAddrInfo);
		return $ipAddrInfo;
	}

	public static function getLogIpAddrInfo()
	{
		global $dbconn;

		// select HE ips
		$sql = "SELECT ip_addr FROM log_ip_addr_info WHERE asnum = 6939 ORDER BY ip_addr";

		$result = pg_query($dbconn, $sql);
		$ipAddrInfo = pg_fetch_all($result);
		//print_r($ipAddrInfo);
		return $ipAddrInfo;
	}


	/**
	* Update IP address LOG. 
		This function performs the following for each ip on ip_addr_info:

		1) Gets current lat, long, mm_lat, mm_log from ip_addr_info table
		2) Queries MM latest DB and extracts geo-data: lat, long, city, country, ... etc
		3) Calculates geo-location and geo-correction distance between 3 points.
			a. old MM 
			b. current geo data in IXmaps db
			c. latest geo data MM db 
	*/
	public static function insertLogIpAddrInfo($data)
	{
		global $dbconn, $appPath;
		include($appPath.'/model/IXmapsMaxMind.php'); 

		$mm = new IXmapsMaxMind();
		//print_r($data);

		$columns = array('ip_addr', 'asnum', 'mm_lat', 'mm_long', 'hostname', 'mm_country', 'mm_region', 'mm_city', 'mm_postal', 'mm_area_code', 'mm_dma_code', 'p_status', 'lat', 'long', 'gl_override', 'flagged', 'date_created', 'date_modified', 'updated_asn', 'updated_mm_lat', 'updated_mm_long', 'updated_mm_country', 'updated_mm_region', 'updated_mm_city', 'updated_mm_postal', 'updated_mm_area_code', 'updated_mm_dma_code', 'updated_mm_asn', 'dis_mm_first_updated', 'dis_mm_first_corrected', 'dis_mm_updated_corrected');

		$sql = "INSERT INTO logip_addr_info ";

		foreach ($data as $key => $ip) {

			$sql = "INSERT INTO log_ip_addr_info (ip_addr, asnum, mm_lat, mm_long, hostname, mm_country, mm_region, mm_city, mm_postal, mm_area_code, mm_dma_code, p_status, lat, long, gl_override, flagged, date_created, date_modified, updated_asn, updated_hostname, updated_mm_lat, updated_mm_long, updated_mm_country, updated_mm_region, updated_mm_city, updated_mm_postal, updated_mm_area_code, updated_mm_dma_code, dis_mm_first_updated, dis_mm_first_corrected, dis_mm_updated_corrected) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, $14, $15, $16, $17, $18, $19, $20, $21, $22, $23, $24, $25, $26, $27, $28, $29, $30, $31);";

			// Get geo data
			$geoIp = $mm->getGeoIp($ip['ip_addr']);
			//print_r($geoIp);

			/*$geoIp['geoip']['country_code'];
			$geoIp['geoip']['region'];
			$geoIp['geoip']['city'];
			$geoIp['geoip']['latitude'];
			$geoIp['geoip']['longitude'];
			$geoIp['geoip']['area_code'];
			$geoIp['geoip']['dma_code'];
			$geoIp['geoip']['postal_code'];			
			$geoIp['asn'];
			$geoIp['hostname'];*/
			/*
				Notice: Undefined index: city in /var/www/ixmaps/application/model/IXmapsGeoCorrection.php on line 78
PHP Notice:  Undefined index: postal_code in /var/www/ixmaps/application/model/IXmapsGeoCorrection.php on line 79


			*/
			$ip['updated_asn'] = $geoIp['asn'];
			$ip['updated_hostname'] = $geoIp['hostname'];

			$ip['updated_mm_lat'] = $geoIp['geoip']['latitude'];
			$ip['updated_mm_long'] = $geoIp['geoip']['longitude'];
			$ip['updated_mm_country'] = $geoIp['geoip']['country_code'];
			$ip['updated_mm_region'] = $geoIp['geoip']['region'];
			$ip['updated_mm_city'] = $geoIp['geoip']['city'];
			$ip['updated_mm_postal'] = $geoIp['geoip']['postal_code'];
			$ip['updated_mm_area_code'] = $geoIp['geoip']['area_code'];
			$ip['updated_mm_dma_code'] = $geoIp['geoip']['dma_code'];

			$ip['dis_mm_first_updated'] = round(IXmapsGeoCorrection::distanceBetweenCoords(
				$ip['mm_lat'], $ip['mm_long'], $geoIp['geoip']['latitude'], $geoIp['geoip']['longitude']));

			$ip['dis_mm_first_corrected'] = round(IXmapsGeoCorrection::distanceBetweenCoords(
				$ip['mm_lat'], $ip['mm_long'], $ip['lat'], $ip['long']));

			$ip['dis_mm_updated_corrected']  = round(IXmapsGeoCorrection::distanceBetweenCoords(
				$geoIp['geoip']['latitude'], $geoIp['geoip']['longitude'], $ip['lat'], $ip['long']));

		$sqlParams = array ($ip['ip_addr'], $ip['asnum'], $ip['mm_lat'], $ip['mm_long'], $ip['hostname'], $ip['mm_country'], $ip['mm_region'], $ip['mm_city'], $ip['mm_postal'], $ip['mm_area_code'], $ip['mm_dma_code'], $ip['p_status'], $ip['lat'], $ip['long'], $ip['gl_override'], $ip['flagged'], $ip['datecreated'], $ip['datemodified'], $ip['updated_asn'], $ip['updated_hostname'],  $ip['updated_mm_lat'], $ip['updated_mm_long'], $ip['updated_mm_country'], $ip['updated_mm_region'], $ip['updated_mm_city'], $ip['updated_mm_postal'], $ip['updated_mm_area_code'], $ip['updated_mm_dma_code'], $ip['dis_mm_first_updated'], $ip['dis_mm_first_corrected'], $ip['dis_mm_updated_corrected']);


			//$ip['updated_asn'], $ip['updated_mm_lat'], $ip['updated_mm_long'], $ip['updated_mm_country'], $ip['updated_mm_region'], $ip['updated_mm_city'], $ip['updated_mm_postal'], $ip['updated_mm_area_code'], $ip['updated_mm_dma_code'], $ip['updated_mm_asn'], $ip['dis_mm_first_updated'], $ip['dis_mm_first_corrected'], $ip['dis_mm_updated_corrected,
		
			//echo "\n".$sql ;
			//print_r($sqlParams);


			$result = pg_query_params($dbconn, $sql, $sqlParams) or die('insertLogIpAddrInfo failed'.pg_last_error());

			pg_free_result($result);

			$lastIp = $ip['ip_addr'];

		} // end foreach

		$mm->closeDatFiles();
		return $lastIp;
	}

	/**
	 * Updates country, region, and city for an geo corrected ip address. 
	 * Uses MM city locations db and finds the closest city for a latitide/longitude pair.
	 */
	public static function updateGeoData($ipData) 
	{
		global $dbconn;

		// Get closest geodata for lat/long
		$sql = "SELECT country, region, city FROM geolite_city_location ORDER BY location <-> st_setsrid(st_makepoint(".$ipData['long'].",".$ipData['lat']."),4326) LIMIT 1;";
		$result = pg_query($dbconn, $sql) or die('updateGeoData failed'.pg_last_error());
		$geodata = pg_fetch_all($result);

		print_r($ipData);
		echo "\n";
		print_r($geodata);

		// Update geo data for ip
		$sql1 = "UPDATE ip_addr_info SET mm_country = '".$geodata[0]['country']."', mm_region = '".$geodata[0]['region']."',  mm_city = '".$geodata[0]['city']."', p_status = 'C' WHERE ip_addr = '".$ipData['ip_addr']."';";
		echo "\n".$sql1."\n";

		// $updateIp = pg_query($dbconn, $sql, $sqlParams) or die('updateGeoData failed'.pg_last_error());

		pg_free_result($result);
		//pg_free_result($updateIp);

	}


	/**
	 * Updates arin whois data on table log_ip_addr_info
	 */
	public static function updateArinWhois($ipData) 
	{
		global $dbconn;

		// Update geo data for ip
		/*
		*/
		$sql = "UPDATE log_ip_addr_info SET arin_name='".$ipData['arin_name']."', arin_country = '".$ipData['arin_country']."', arin_city = '".$ipData['arin_city']."',  arin_extra = '".$ipData['arin_extra']."' WHERE ip_addr = '".$ipData['ip_addr']."';";
		echo "\n".$sql."\n";

		// $result = pg_query($dbconn, $sql, $sqlParams) or die('updateGeoData failed'.pg_last_error());

		pg_free_result($result);
		//pg_free_result($updateIp);

	}

	/**
	 * Queries WHOIS db and extract all: Name, Country-Code, and City data
	 * @param inet $ip IP address
	 * @return array of country and city data
	 */
	public static function getWhoisData($ip, $whoisHost="")
	{
	  $whoisOutput = shell_exec('whois '.$ip);
	  $whoisOutputArr = explode("\n", $whoisOutput);
	  //echo '\n'.$whoisOutput;
	  
	  // replace double spaces ?

	  $conn = 0;
	  $dataArray = array();
	  $contactCounter = 0;
	  $itemArray = array(
  		"ip_addr"=>$ip,
  		"arin_net_name"=>"",
  		"arin_country"=>"",
  		"arin_city"=>"",
  		"contact" => array()
  		);
	  foreach ($whoisOutputArr as $key => $line) {
	  	
        if (strpos($line, 'NetName: ') !== false) {
        	echo "\n".$line;
        	//NetName:        LINODE-US
        	$dArray = explode(":", $line);
        	$data = $dArray[0];
        	print_r($data);
        	$data = trim($data);
        	$itemArray["arin_net_name"] = $data;
        }

        if (strpos($line, 'Country: ') !== false) {
        	echo "\n".$line;
        	// Country:        US
        	$dArray = explode(":", $line);
        	$data = $dArray[0];
        	print_r($data);
        	$data = trim($data);
        	$itemArray["arin_country"] = $data;
        }

        if (strpos($line, 'City: ') !== false) {
        	echo "\n".$line;
        	//City:           Galloway
        	$dArray = explode(":", $line);
        	$data = $dArray[0];
        	$data = trim($data);
        	$itemArray["arin_city"] = $data;
        }
        //contact:Name:
        //contact:Company:

        if (strpos($line, 'contact:Name:') !== false) {
        	echo "\n".$line;
        	$dArray = explode(":", $line);
        	$data = $dArray[2];
        	$data = trim($data);
        	$itemArray["contact"][$contactCounter]['name'] = $data;
        	$contactCounter++; //!!
        }

        if (strpos($line, 'contact:Company:') !== false) {
        	echo "\n".$line;
        	$dArray = explode(":", $line);
        	$data = $dArray[2];
        	$data = trim($data);
        	$itemArray["contact"][$contactCounter]['company'] = $data;
        }

        if (strpos($line, 'contact:Country-Code:') !== false) {
        	echo "\n".$line;
        	$dArray = explode(":", $line);
        	$data = $dArray[2];
        	$data = trim($data);
        	$itemArray["contact"][$contactCounter]['country'] = $data;
        }

        if (strpos($line, 'contact:City:') !== false) {
        	$dArray = explode(":", $line);
        	$data = $dArray[2];
        	$data = trim($data);
        	$itemArray["contact"][$contactCounter]['city'] = $data;
        }
        //print_r($itemArray);
        //$dataArray[]=$itemArray;
	  }
	  echo "\n----------------";
	  print_r($itemArray);

	  return $itemArray;

	}

	/**
	 * Calculates the great-circle distance between two points, with
	 * the Haversine formula.
	 * @param float $latitudeFrom Latitude of start point in [deg decimal]
	 * @param float $longitudeFrom Longitude of start point in [deg decimal]
	 * @param float $latitudeTo Latitude of target point in [deg decimal]
	 * @param float $longitudeTo Longitude of target point in [deg decimal]
	 * @param float $earthRadius Mean earth radius in [m]
	 * @return float Distance between points in [m] (same as earthRadius)
	 */
	public static function distanceBetweenCoords(
	  $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
	{
	  // convert from degrees to radians
	  $latFrom = deg2rad($latitudeFrom);
	  $lonFrom = deg2rad($longitudeFrom);
	  $latTo = deg2rad($latitudeTo);
	  $lonTo = deg2rad($longitudeTo);

	  $latDelta = $latTo - $latFrom;
	  $lonDelta = $lonTo - $lonFrom;

	  $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
	    cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
	  return $angle * $earthRadius;
	}
}
?>