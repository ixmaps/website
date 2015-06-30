<?php
class GatherTr
{

	/**
		Save incomming traceroute data (Header)
	*/
	public static function saveTrContribution($data) 
	{
		global $dbconn, $ixmaps_debug_mode;

		$sql = "INSERT INTO tr_contributions (traceroute_id, sub_time, dest, dest_ip, city, country, submitter, submitter_ip, submitter_os, postal_code, privacy, timeout, queries, maxhops, tr_flag, error_log, client_params) VALUES (NULL, NOW(), $1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, $14, $15) RETURNING tr_c_id;";

		if(!isset($data['error'])){
			$data['error'] = "";
		}

		if(!isset($data['client_params'])){
			$data['client_params'] = "";
		}

		$trData = array($data['dest'], $data['dest_ip'], $data['city'], $data['country'], $data['submitter'], $data['submitter_ip'], $data['os'], $data['postal_code'], $data['privacy'], $data['timeout'], $data['queries'], $data['maxhops'], 0, $data['error'], $data['client_params']);

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
			
			if(!isset($trDataItem['tr_invocation'])){
				$trDataItem['tr_invocation'] = '...cmd';
			}
			$trData = array($trDataItem['client'], $trDataItem['protocol'], $trDataItem['data_type'],$trDataItem['tr_invocation'], $trDataItem['tr_data'], 0);

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
				
				// prevent ip !set
				if(isset($hopPass['ip'])){
					$ip_latencies[$hopPass['ip']][]  = $hopPass['rtt'];
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

			// Complete a max of 4 latencies
			$totLatencies = count($latencies);
			if($totLatencies<4){
				for ($i=$totLatencies; $i < 4; $i++) { 
					$latencies[]=-1;
				}
			}
			
			sort($latencies);
			arsort($ip_rank);					
			$keys=array_keys($ip_rank);
			
			if(isset($keys[0])){
				$winnerIp = $keys[0];
			} else {
				$winnerIp = "";
			}
			
			/*Preventing the submission of more that 4 attempts/queries
			Note: this needs further discussion. In this case submitting the lowest 4 latencies. */
			/*$totQueries = count($latencies);
			if($totQueries>4) {
				for($i=4; $i < $totQueries; $i++){
					if(isset($latencies[$i])){
						unset($latencies[$i]);
					}
				}
			}*/
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

		// FIXME: move this to config.php
		$URI = "https://www.ixmaps.ca/cgi-bin/gather-tr.cgi";
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
		

		// FIXED! collecting the protocol used in the submission data_type = json
		foreach ($data['traceroute_submissions'] as $sub_data) {
			if($sub_data['data_type']=="json"){
				// convert to lowercase before comparison
				$sub_data['protocol'] = strtolower($sub_data['protocol']);
				if($sub_data['protocol']=="icmp"){
					$protocol = "i";
				} else if($sub_data['protocol']=="udp"){ 
					$protocol = "u";
				} else if($sub_data['protocol']=="tcp"){ 
					$protocol = "t";
				}		
			}
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

		// adding exceptions for SSL certificate
		$arrContextOptions=array(
		    "ssl"=>array(
		        "verify_peer"=>false,
		        "verify_peer_name"=>false,
		    ),
		);  

		// publish data
		$trResult = file_get_contents($URI."?".$trString, false, stream_context_create($arrContextOptions));
		
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

	/**
	Get hostname using getent hosts [ip]
	*/

	public static function getHostnameForIp($ip)
	{
		$cmd = 'getent hosts '.$ip;
		$output = shell_exec($cmd);
		$hostname_data = explode(' ', $output);
		$hostname= trim($hostname_data[count($hostname_data)-1]);
		$host_r = array(
			'hostname'=>$hostname);
		return $host_r;
	}

	public static function ipInIXmaps($ip)
	{
		global $dbconn;
		$sql = "SELECT ip_addr, asnum, hostname FROM ip_addr_info WHERE ip_addr = $1";
		$params = array($ip);
		$result = pg_query_params($dbconn, $sql, $params) or die('ipInIXmaps: Query failed: incorrect parameters'.pg_last_error());
		$data = pg_fetch_all($result);
		pg_free_result($result);
		return $data;
	}

	/**
	Attempts a hostname lookup for a given IP address.
	If a hostname is found, compares if the current hostname is different from the old in the IXmaps DB
	*/

	public static function checkHostnameChanged($ip, $hostnameIX)
	{
		$cmd = 'getent hosts '.$ip;
		//echo "<br/>Finding hosthame for: ".$ip;
		$output = shell_exec($cmd);
		$response = array(
				"status"=>0,
				"hostname"=>""
				);

		if($output==""){
			//echo "<br/>No hostname found";
			return $response;
		} else {

			$spaces = '';

			//echo "<pre>$output</pre>";
			$hostname_data = explode(' ', $output);
			
			//print_r($hostname_data);

			// remove spaces before comparison
			$hostnameNew= trim($hostname_data[count($hostname_data)-1]);
			$hostnameIX = trim($hostnameIX);

			// normanize to lowerCase
			$hostnameNew = strtolower($hostnameNew);
			$hostnameIX = strtolower($hostnameIX);

			if($hostnameIX==$hostname_data[1]){
				$response['status']=1;
				$response['hostname']=$hostnameNew;
				return $response;
			
			} else if($hostnameIX!=$hostnameNew){
				$response['status']=2;
				$response['hostname']=$hostnameNew;
				return $response;
			}
		}
	}
	
	
	/**
		Get geodata, hostname and ASnum from ipinfo.io
		NOTE: 1000 max requests per day
	*/
	public static function getIpDataIpInfoIo($ip=''){
		$cmd = 'curl ipinfo.io/'.$ip;
		$output = shell_exec($cmd);
		$hostname_data = json_decode($output, true);
		return $hostname_data;
	}

	/**
		Get a ASN for an IP: Using local DBs
	*/
	public static function getIpForAsn($ip=''){
		global $dbconn, $ixmaps_debug_mode;
		$sql = "SELECT asn_netmask.*, asn_carrier.name FROM asn_netmask, asn_carrier WHERE (asn_carrier.num=asn_netmask.asn) AND asn_netmask.netmask >>= inet('".$ip."');";
		//echo $sql;
		//$trParams = array($ip);
		//$result = pg_query_params($dbconn, $sql, $trParams) or die('getIpForAsn: Query failed'.pg_last_error());
		$result = pg_query($dbconn, $sql) or die('getIpForAsn: Query failed'.pg_last_error());
		$asnData = pg_fetch_all($result);
		//print_r($asnData);
		pg_free_result($result);
		return $asnData;
	}

	/**
		Get MaxMind Geolocation data for an IP: Using local MM .dat files
	*/
	public static function getMaxMindData($ip=''){

	}

	/**
		Get ip addresses from IXmaps DB
	*/
	public static function getHostnames($ip='', $total=100){
		global $dbconn;
		$fields = " ip_addr, hostname, mm_lat, mm_long, lat, long, mm_city, mm_country, gl_override ";
		//$sql = "SELECT ip_addr, hostname, asnum FROM ip_addr_info where ip_addr >= '".$ip."' order by ip_addr LIMIT ".$total;

		// process ALL
		//$sql = "SELECT ip_addr, hostname, asnum FROM ip_addr_info order by ip_addr";


		// Cognet
		//$sql ="SELECT ip_addr, hostname FROM ip_addr_info where asnum = 2149 or asnum = 174 order by ip_addr";
		
		//"AboveNet/Zayo"
		//$sql ="SELECT ip_addr, hostname FROM ip_addr_info where asnum = 17025 or asnum = 6461 order by ip_addr";

		//"AT&T"
		//$sql ="SELECT ip_addr, hostname FROM ip_addr_info where asnum = 4466 or asnum = 5730 or asnum = 7018 order by ip_addr";

		//"Hurricane Electric"
		//$sql ="SELECT ip_addr, hostname FROM ip_addr_info where asnum = 6939 order by ip_addr";

		//"Level 3"
		//$sql ="SELECT ip_addr, hostname FROM ip_addr_info where asnum = 30686 or asnum = 3356 or asnum = 3549 order by ip_addr";

		//"Rogers"
		$sql ="SELECT ".$fields." FROM ip_addr_info where asnum = 812 or asnum = 3602 order by ip_addr";

		//"Teksavvy"
		//"5645,20375,0"

		//"Telus"
		// "852,7861,54719"

		//"Verizon" 
		//"702,703,701"


		
		echo $sql;

		$result = pg_query($dbconn, $sql) or die('getHostnames: Query failed'.pg_last_error());
		$ip_host_data = pg_fetch_all($result);
		pg_free_result($result);
		return $ip_host_data;
	}
		
}
?>