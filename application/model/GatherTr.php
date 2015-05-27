<?php
class GatherTr
{

	/**
		Save incomming traceroute data (Header)
	*/
	public static function saveTrContribution($data) 
	{
		global $dbconn, $ixmaps_debug_mode;

		$sql = "INSERT INTO tr_contributions (traceroute_id, sub_time, dest, dest_ip, city, country, submitter, submitter_ip, submitter_os, postal_code, privacy, timeout, queries, maxhops, tr_flag) VALUES (NULL, NOW(), $1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13) RETURNING tr_c_id;";

		$trData = array($data['dest'], $data['dest_ip'], $data['city'], $data['country'], $data['submitter'], $data['submitter_ip'], $data['os'], $data['postal_code'], $data['privacy'], $data['timeout'], $data['queries'], $data['maxhops'], 0);

		$result = pg_query_params($dbconn, $sql, $trData) or die('saveTrContribution: Query failed: incorrect parameters'.pg_last_error());
		//$result = pg_query($dbconn, $sql1) or die('saveContribution: Query failed: incorrect parameters'.pg_last_error());
		$lastId = pg_fetch_all($result);
		$tr_c_id = $lastId[0]['tr_c_id'];
		pg_free_result($result);
		return $tr_c_id;
	}

	/**
		Save incomming traceroute data (Contributions)
	*/
	public static function saveTrContributionData($data, $tr_c_id) 
	{
		global $dbconn, $ixmaps_debug_mode;

		foreach ($data['traceroute_submissions'] as $key => $trDataItem) {

			if(is_array($trDataItem['tr_data'])){				
				$trDataItem['tr_data'] = json_encode($trDataItem['tr_data']);
				$trDataItem['data_type'] = "json";
			} else {
				$trDataItem['data_type'] = "txt";
			}

			$sql = "INSERT INTO tr_contribution_data (tr_c_id, sub_time, client, protocol, data_type, tr_invocation, tr_data, tr_flag) VALUES (".$tr_c_id.", NOW(), $1, $2, $3, $4, $5, $6)";
			
			$trData = array($trDataItem['client'], $trDataItem['protocol'], $trDataItem['data_type'],'...cmd', $trDataItem['tr_data'], 0);

			$result = pg_query_params($dbconn, $sql, $trData) or die('saveContributionData: Query failed: incorrect parameters'.pg_last_error());
		}

		pg_free_result($result);

		return 1;

	}

	//TODO: optimize! evaluate SQL vs non-SQL storage 
	/**
		Get TR contribution
	*/
	public static function getTrContribution($tr_c_id) 
	{
		global $dbconn, $ixmaps_debug_mode;
		
		$sql1 = "SELECT tr_contributions.* FROM tr_contributions WHERE tr_c_id=$1;";
		$sql2 = "SELECT tr_contribution_data.* FROM tr_contribution_data WHERE tr_c_id=$1;";
		$sqlParams1 = array($tr_c_id);
		$sqlParams2 = array($tr_c_id);
		$result1 = pg_query_params($dbconn, $sql1, $sqlParams1) or die('getTrContribution: tr_contributions failed');
		$result2 = pg_query_params($dbconn, $sql2, $sqlParams2) or die('getTrContribution: tr_contribution_data failed');
		$dataArr1 = pg_fetch_all($result1);
		$dataArr2 = pg_fetch_all($result2);
		$dataArr1[0]['traceroute_submissions'] = $dataArr2;

		pg_free_result($result1);
		pg_free_result($result2);
		
		return $dataArr1[0];
	}

	/**
		Format TR data 
		This function assumes that the ixnode data is structured as follows:
		[tr_data][pass][hop-query]
	*/
	public static function formatTrData($data) 
	{
		$TrByHop = array();

		// submissions
		foreach ($data['traceroute_submissions'] as $key1 => $submission) {

			// check contribution type
			if($submission['data_type']=='json'){
				$trDataPasses = json_decode($submission['tr_data'], true); 
				
				// passes
				foreach ($trDataPasses as $key2 => $trPass) {

					// hops
					foreach ($trPass as $key3 => $passHop) {
						//collect hops and latencies from all passes
						$TrByHop[$passHop['hop']][]=$passHop;

					} // end hops
			
				} //end passes
				//echo '\n\n';
				//print_r($TrByHop);
				return $TrByHop;

			} else if($submission['data_type']=='txt'){
				//echo "\nis txt";
				//$data = GatherTr::analyzeRawTracerouteTxt();		
				//return 0;

			} else {
				return 0;	
			}
			
		}

	}

	/**
		Analyze TR data. 
		This function assumes that the tr data is structured as follows:
		[tr_data][hop][queries]
	*/
	public static function analyzeTrData($trHops) 
	{
		$TR = array();
				
		//hops
		foreach ($trHops as $key2 => $hop) {
			$hopNum = $key2;
			$latencies = array();
			$ip_rank = array();

			// queries/passes
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
					// error at this hop
				}

			} // end queries

			sort($latencies);
			arsort($ip_rank);					
			$keys=array_keys($ip_rank);
			$winnerIp = $keys[0];

			//echo "\nWinner IP: ".$winnerIp;

			$TR['hops'][$hopNum]['latencies'] = $latencies;
			$TR['hops'][$hopNum]['winIp'] = $winnerIp;
			
		} //end hop
		//print_r($TR);
		//$data['ip_analysis'] = $TR;
		return $TR;

	}
	/**
		Analyze TR data. 
		This function assumes that the tr data is structured as follows:
		[tr_data][hop][queries]
	*/
	public static function analyzeTrDataOld($tr_c_id) 
	{
		global $dbconn;
		$data = GatherTr::getTrContribution($tr_c_id);
		//print_r($data);

		$TR = array();
		// submissions
		foreach ($data['traceroute_submissions'] as $key1 => $submission) {
			
			// check contribution type
			if($submission['data_type']=='json'){				
				$trHops = json_decode($submission['tr_data'], true);
				$totHops = count($trHops);
				//print_r($trHops);
				
				//hops
				foreach ($trHops as $key2 => $hop) {
					$hopNum = $key2+1;
					$latencies = array();
					$ip_rank = array();

					// queries
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
							// error at this hop
						}

						//

					} // end queries

					sort($latencies);
					arsort($ip_rank);					
					$keys=array_keys($ip_rank);
					$winnerIp = $keys[0];

					//echo "\nWinner IP: ".$winnerIp;

					$TR['hops'][$hopNum]['latencies'] = $latencies;
					$TR['hops'][$hopNum]['winIp'] = $winnerIp;
					
				} //end hop
				//print_r($TR);
				$data['ip_analysis'] = $TR;
				return $data;

			} else if($submission['data_type']=='txt'){
				//echo "\nis txt";
				//$data = GatherTr::analyzeRawTracerouteTxt();		
				return 0; // TODO:

			} else {
				return 0;	
			}
			
		}

	}
	/**
	Publish TR data 
	*/
	public static function publishTraceroute($data) 
	{
		global $dbconn, $ixmaps_debug_mode;

		$URI = "http://www.ixmaps.ca/cgi-bin/gather-tr.cgi";
		$trSubString = "";

		$trString ="";
		
		/*check tr status: does the TR reach its destination?*/
		end($data['ip_analysis']['hops']);
		$lastKey = key($data['ip_analysis']['hops']);
		$lastIp = $data['ip_analysis']['hops'][$lastKey]['winIp'];
		//echo "LastIP: ".$lastIp;

		if($data['dest_ip']==$lastIp){
			$trStatus = "c";
		} else {
			$trStatus = "i";
		}

		//echo "\nProtocol: ".$data['traceroute_submissions'][0]['protocol'];

		// FIXME: assume no order in the contributions
		if($data['traceroute_submissions'][0]['protocol']=="icmp"){
			$protocol = "i";
		} else if($data['traceroute_submissions'][0]['protocol']=="udp"){ 
			$protocol = "u";
		} else if($data['traceroute_submissions'][0]['protocol']=="tcp"){ 
			$protocol = "t";
		}		

		// TODO: check for null fields

		// convert timeout to seconds 
		$data['timeout'] = round($data['timeout']/1000);

		$trString = "dest=".$data['dest']."&dest_ip=".$data['dest_ip']."&submitter=".urlencode($data['submitter'])."&zip_code=".urlencode($data['postal_code'])."&client=".urlencode($data['traceroute_submissions'][0]['client'])."&cl_ver=1.0&privacy=8&timeout=".$data['timeout']."&protocol=".$protocol."&maxhops=".$data['maxhops']."&attempts=".$data['queries']."&status=".$trStatus;
		
		$hopCount=0;

		$foundFirstValidIp = false;
		
		// hops
		foreach ($data['ip_analysis']['hops'] as $key => $hop) {

			// skip local ips
			if(!GatherTr::checkIpIsPrivate($hop['winIp']) || $hop['winIp']==""){

				// anonimize first valid ip
				if(!$foundFirstValidIp && $hop['winIp']!=""){
					$foundFirstValidIp=true;
					//echo "\n First Valid IP: ".$hop['winIp'];
					$ipQuads = explode('.', $hop['winIp']);
					$ipAmonim = "";

					for ($i=0; $i < count($ipQuads); $i++) { 
						if($i==count($ipQuads)-1){
							$ipAmonim.=".0";

						} else if ($i==0) {
							$ipAmonim.= "".$ipQuads[$i];

						} else {
							$ipAmonim.= ".".$ipQuads[$i];
						}
					}
					$hop['winIp'] = $ipAmonim;
				}

				$hopCount++;
				$latencyCount = 0;
				// latencies
				foreach ($hop['latencies'] as $key1 => $latency) {
					$latencyCount++;
					
					$rtt_ms=0;
					
					if($latency==-1)
					{
						$status="t";
					} else {
						$status="r";
					}

					$trString .= "&status_".$hopCount."_".$latencyCount."=".$status."&ip_addr_".$hopCount."_".$latencyCount."=".$hop['winIp']."&rtt_ms_".$hopCount."_".$latencyCount."=".round($latency);
				}

			} else {
				//echo "\n skiping ip: ".$hop['winIp'];
			} // end skip ip

		}
		$totItems = $hopCount*$data['queries'];
		$trString .= "&n_items=".$totItems;
		
		//echo "\n".$trString."";

		// publish data
		$trResult = file_get_contents($URI."?".$trString);
		
		//echo "\n\n".$trResult;

		$search      = "new traceroute ID";
		//$lines       = file('example.txt');
		$line_number = false;
		$tr_id_arr = explode("\n", $trResult);
		while (list($key, $line) = each($tr_id_arr) and !$line_number) {
		   $line_number = (strpos($line, $search) !== FALSE) ? $key + 1 : $line_number;
		}
		$tr_id_line = explode("=", $tr_id_arr[$line_number-1]);

		//echo "\nTR ID: ".$tr_id_line[1];

		if(count($tr_id_line)==2 && $tr_id_line[1]!=0){
			return $tr_id_line[1];	
		} else {
			return 0;
		}

	}

	/**
		...
	*/

	public static function analyzeRawTracerouteTxt($data) 
	{

	}

	/**
		...
	*/

	public static function showTrContribution($data) 
	{

	}

	/**
	Determine if the IP is Private/Reserved
	*/

	public static function checkIpIsPrivate($ip) 
	{
		if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
			return true;
		} else {
			return false;
		}
	}

	/**
	Flag TR contribution
	*/

	public static function flagContribution($tr_c_id, $traceroute_id)
	{
		global $dbconn;
		if($tr_c_id!=0 && $traceroute_id!=0){
			$sql = "UPDATE tr_contributions SET traceroute_id = $traceroute_id, tr_flag=1 WHERE tr_c_id = $tr_c_id";
			$result = pg_query($dbconn, $sql) or die('flagContribution: Query failed'.pg_last_error());
			pg_free_result($result);
			return true;
		} else {
			return false;
		}		
	}
		
}
?>