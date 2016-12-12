<?php
class IXmapsGeoCorrection
{
	
	public static function getIpAddrInfo($limit)
	{
		global $dbconn;

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

		$result1 = pg_query($dbconn, $sql1);
		$ipAddrInfo = pg_fetch_all($result1);
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
		global $dbconn;
		include('../model/IXmapsMaxMind.php'); 

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