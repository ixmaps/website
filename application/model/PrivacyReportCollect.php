<?php
class PrivacyReportCollect
{
	public static function getPrivacyDataImport(){
		global $dbconn;

		$sql1="SELECT * FROM privacy_scores_import";
		$result1 = pg_query($dbconn, $sql1) or die('Query privacy_stars failed: ' . pg_last_error());
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
}
?>