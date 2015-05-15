<?php

class GatherTr
{

	/**
		Saves all incomming traceroute data from TRgen V.2 into a temporary table (Parent)
	*/
	public static function saveContribution($data) 
	{
		global $dbconn, $ixmaps_debug_mode;

		// FIXMEL: check if all mandatory fields are set

		$sql = "INSERT INTO tr_contributions (traceroute_id, sub_time, dest, dest_ip, city, country, submitter, submitter_ip, submitter_os, postal_code, privacy, timeout, queries, maxhops, tr_flag) VALUES (NULL, NOW(), $1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13) RETURNING tr_c_id;";

		$trData = array($data['dest'], $data['dest_ip'], $data['city'], $data['country'], $data['submitter'], $data['submitter_ip'], $data['os'], $data['postal_code'], $data['privacy'], $data['timeout'], $data['queries'], $data['maxhops'], 0);

		//echo $sql;

		//print_r($trData);

		$result = pg_query_params($dbconn, $sql, $trData) or die('saveContribution: Query failed: incorrect parameters'.pg_last_error());
		$lastId = pg_fetch_all($result);
		$tr_c_id = $lastId[0]['tr_c_id'];
		pg_free_result($result);
		return $tr_c_id;
	}

	/**
		Saves all incomming traceroute data from TRgen V.2 into a temporary table (child data)
	*/
	public static function saveContributionData($data, $tr_c_id) 
	{
		global $dbconn, $ixmaps_debug_mode;

		// FIXME!	check if all mandatory fields are set and return error
		
		// insert a new record for each $data['traceroute_submissions']
		foreach ($data['traceroute_submissions'] as $key => $trDataItem) {

			if(is_array($trDataItem['tr_data'])){				
				$trDataItem['tr_data'] = json_encode($trDataItem['tr_data']);
				$trDataItem['data_type'] = "json";
			} else {
				$trDataItem['data_type'] = "txt";
			}

			$sql = "INSERT INTO tr_contribution_data (tr_c_id, sub_time, client, protocol, data_type, tr_invocation, tr_data, tr_flag) VALUES (".$tr_c_id.", NOW(), $1, $2, $3, $4, $5, $6)";
			
			$trData = array($trDataItem['client'], $trDataItem['protocol'], $trDataItem['data_type'],'...cmd', $trDataItem['tr_data'], 0);

			//print_r($trData);

			// FIXME: debug if SQL error
			$result = pg_query_params($dbconn, $sql, $trData) or die('saveContributionData: Query failed: incorrect parameters'.pg_last_error());

		}

		pg_free_result($result);

		return 1;

	}

	/**
		Get TR contribution
	*/
	public static function getContribution($tr_c_id) 
	{
		global $dbconn, $ixmaps_debug_mode;
		
		$sql1 = "SELECT tr_contributions.* FROM tr_contributions WHERE tr_c_id=$1;";
		$sql2 = "SELECT tr_contribution_data.* FROM tr_contribution_data WHERE tr_c_id=$1;";
		$sqlParams1 = array($tr_c_id);
		$sqlParams2 = array($tr_c_id);
		$result1 = pg_query_params($dbconn, $sql1, $sqlParams1) or die('getContribution: Query1 failed');
		$result2 = pg_query_params($dbconn, $sql2, $sqlParams2) or die('getContribution: Query2 failed');
		$dataArr1 = pg_fetch_all($result1);
		$dataArr2 = pg_fetch_all($result2);
		$dataArr1[0]['traceroute_submissions'] = $dataArr2;

		//print_r($dataArr1[0]);
		//print_r($dataArr2);
		//print_r($contribArr);

		pg_free_result($result1);
		pg_free_result($result2);
		
		return $dataArr1[0];
	}

	/**
		Analyze TR data and return formated array for official submision
	*/
	public static function processTrData($tr_c_id) 
	{
		global $dbconn, $ixmaps_debug_mode;
		$data = GatherTr::getContribution($tr_c_id);
		//print_r($data);

		$TR = array();

		//$TR['header'] = $data;

		foreach ($data['traceroute_submissions'] as $key1 => $submission) {
			
			// parse tr_data: ixnode raw-sockets
			if($submission['data_type']=='json'){
				//echo "\n  json";
				//echo "\n queries: ".$data['queries'];
				
				$TrHops = json_decode($submission['tr_data'], true);
				
				//print_r($TrHops);

				$totHops = count($TrHops);

				//$TR['totHops'] = $totHops;

				//echo "\n Total Hops: ".$totHops."\n";

				foreach ($TrHops as $key2 => $hop) {
					$hopNum = $key2+1;

					//echo "\n Hop: ".$hopNum."\n";
					//print_r($hop);

					$latencies = array();
					$ip_rank = array();

					// loop passes/queries
					foreach ($hop as $key3 => $hopPass) {
						
						//$hopPass['rtt'] = $hopPass['rtt']*100;
						$latencies[] = $hopPass['rtt'];
						$ip_latencies[$hopPass['ip']][]  = $hopPass['rtt'];
						
						// prevent ip !set
						if(isset($hopPass['ip'])){
							if(!isset($ip_rank[$hopPass['ip']]))
							{
								$ip_rank[$hopPass['ip']] = 1;	
							} else {
								$ip_rank[$hopPass['ip']] += 1;
							}
						} else {
							// error at this pass/hop
						}

						//

					} // end pass/hop


					sort($latencies);
					//print_r($latencies);
					arsort($ip_rank);
					//print_r($ip_rank);
					//reset($ip_rank);
					
					$keys=array_keys($ip_rank);
					$winnerIp = $keys[0];

					//echo "\nWinner IP: ".$winnerIp;

					$TR['hops'][$hopNum]['latencies'] = $latencies;
					$TR['hops'][$hopNum]['winIp'] = $winnerIp;
					
					//$TR['hops'][$hopNum]['ip_rtt'] = $ip_latencies;
					

				} //end hop

				//echo "\n";
				print_r($TR);
				//return $TR;

			} else if($submission['data_type']=='txt'){
				//echo "\nis txt";

			}
			
		}

	}

	public static function saveTraceroute($data) 
	{
		global $dbconn, $ixmaps_debug_mode;

		$URI = "";
		$TrString = "";

		foreach ($data as $key => $value) {
			# code...
		}

	}
}
?>