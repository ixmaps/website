<?php
class PrivacyReportCollect
{
	public static function getPrivacyDataImport(){
		global $dbconn;

		$sql1="SELECT * FROM privacy_scores_import";
		$result1 = pg_query($dbconn, $sql1) or die('Query privacy_scores_import failed: ' . pg_last_error());
		$dataFormated = array();
		$data = pg_fetch_all($result1);

		pg_free_result($result1);

		pg_close($dbconn);

		$c=0;
		$csvData = "";
		foreach ($data as $key => $value) {
			$c++;
			$csvData .="\n(1,".$value["asn"].",'".$value["carrier_name"]."',".$value["score1"].",'".$value["created_by"]."'),";
			$csvData .="\n(2,".$value["asn"].",'".$value["carrier_name"]."',".$value["score2"].",'".$value["created_by"]."'),";
			$csvData .="\n(3,".$value["asn"].",'".$value["carrier_name"]."',".$value["score3"].",'".$value["created_by"]."'),";
			$csvData .="\n(4,".$value["asn"].",'".$value["carrier_name"]."',".$value["score4"].",'".$value["created_by"]."'),";
			$csvData .="\n(5,".$value["asn"].",'".$value["carrier_name"]."',".$value["score5"].",'".$value["created_by"]."'),";
			$csvData .="\n(6,".$value["asn"].",'".$value["carrier_name"]."',".$value["score6"].",'".$value["created_by"]."'),";
			$csvData .="\n(7,".$value["asn"].",'".$value["carrier_name"]."',".$value["score7"].",'".$value["created_by"]."'),";
			$csvData .="\n(8,".$value["asn"].",'".$value["carrier_name"]."',".$value["score8"].",'".$value["created_by"]."'),";
			$csvData .="\n(9,".$value["asn"].",'".$value["carrier_name"]."',".$value["score9"].",'".$value["created_by"]."'),";
			$csvData .="\n(10,".$value["asn"].",'".$value["carrier_name"]."',".$value["score10"].",'".$value["created_by"]."'),";			
		}

		return $csvData;
	}

	public static function ckeckCarriers(){
		global $dbconn;

		$sql1="SELECT * FROM privacy_scores_carriers";
		$result1 = pg_query($dbconn, $sql1) or die('Query privacy_scores_carriers failed: ' . pg_last_error());
		$dataFormated = array();
		$data = pg_fetch_all($result1);

		pg_free_result($result1);

		$c=0;
		$csvData = "";
		foreach ($data as $key => $value) {

			// split asn
			$asn_report = explode(",", $value['asn_report']);

			echo "<br/>Carrier:".$value['name_report'];

			echo "<br/>ASN report:".$asn_report[0].",".$asn_report[1].",".$asn_report[2];

			// search carrier by name or asn in ixmaps database
			$sql2="SELECT * FROM as_users WHERE ";
			$sql2.="name LIKE '%".trim($value['name_report'])."%'";
			
			if($asn_report[0]!=0){
				$sql2.=" OR num = ".$asn_report[0];
			}
			if($asn_report[1]!=0){
				$sql2.=" OR num = ".$asn_report[1];
				
			}
			if($asn_report[2]!=0){
				$sql2.=" OR num = ".$asn_report[2];
			}
			
			echo "".$sql2;

			$result2 = pg_query($dbconn, $sql2) or die('Query as_users failed: ' . pg_last_error());
			$dataFormated2 = array();

			$data2 = pg_fetch_all($result2);

			if(count($data2)){
				echo "<br/>No match on as_users";
			} else {
				print_r($data2);
				// collect data from as_users and update privacy_scores_carriers table with asn_ix and name_ix 
			}
			pg_free_result($result2);

			echo "<hr/>";

		} // end for

		pg_free_result($result1);

		pg_close($dbconn);


		//return $csvData;
	}
}
?>