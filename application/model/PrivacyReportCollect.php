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

	public static function checkCarriers(){
		global $dbconn;

		$sql1="SELECT * FROM privacy_scores_carriers";
		$result1 = pg_query($dbconn, $sql1) or die('Query privacy_scores_carriers failed: ' . pg_last_error());
		$dataFormated = array();
		$data = pg_fetch_all($result1);

		//pg_free_result($result1);

		$c=0;
		$csvData = "";
		foreach ($data as $key => $value) {

			// split asn
			$asn_report = explode(",", $value['asn_report']);

			echo "<br/>Carrier:".$value['name_report'];

			echo "<br/>ASN report:".$asn_report[0].",".$asn_report[1].",".$asn_report[2];

			// search carrier by name or asn in ixmaps database
			$sql2="SELECT * FROM as_users WHERE ";
			//$sql2.="name LIKE '%".trim($value['name_report'])."%'";

			$asn_non_0 = array();

			if($asn_report[0]!=0){
				$asn_non_0[]=$asn_report[0];
			}
			if($asn_report[1]!=0){
				$asn_non_0[]=$asn_report[1];
			}
			if($asn_report[2]!=0){
				$asn_non_0[]=$asn_report[2];
			}

			$totAs = 0;

			foreach ($asn_non_0 as $key1 => $asnNum) {
				$totAs++;

				if($totAs==1){
					$sql2.=" num = ".$asnNum;
				} else {
					$sql2.=" OR num = ".$asnNum;

				}
			}
			//echo "<br/>".$sql2;

			// test only if we have any ASN
			//if(count($asn_non_0!=0))
			if($value['asn_report']!="0,0,0")
			{
				$result2 = pg_query($dbconn, $sql2) or die('Query as_users failed: ' . pg_last_error());
				$dataFormated2 = array();

				$data2 = pg_fetch_all($result2);

				if(count($data2)==0){
					echo "<br/>No match on as_users";
				} else {
					//print_r($data2);
					$asn_in_ix_c = 0;
					$asn_in_ix = "";
					$name_in_ix = "";
					// collect data from as_users and update privacy_scores_carriers table with asn_ix and name_ix
					foreach ($data2 as $key2 => $valueDb) {
						$asn_in_ix_c++;
						if($asn_in_ix_c==1){
							$asn_in_ix.=$valueDb['num']."";
							$name_in_ix .= "".$valueDb['name'];
						} else {
							$asn_in_ix.=",".$valueDb['num']."";
							$name_in_ix .= "@@".$valueDb['name'];
						}
					} // end for
				} // end if ASN data

				// clean up ' char
				$name_in_ix = str_replace("'","\'", $name_in_ix);
				// update
				$update_privacy_scores_carriers = "UPDATE privacy_scores_carriers SET name_ix ='".$name_in_ix."', asn_ix='".$asn_in_ix."' WHERE id = ".$value['id'];
				echo "<br/>".$update_privacy_scores_carriers;
				$result3 = pg_query($dbconn, $update_privacy_scores_carriers) or die('Updating privacy_scores_carriers failed: ' . pg_last_error());
				pg_free_result($result3);


				// check if TR data exists on any of these carriers

				pg_free_result($result2);

			} else {
				echo "<br/><b>No ASN for this carrier</b>";
			}

			echo "<hr/>";

		} // end for

		pg_free_result($result1);

		pg_close($dbconn);


		//return $csvData;
	}
}
?>