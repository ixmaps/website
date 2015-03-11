<?php
class PrivacyReportCollect
{
	public static function getPrivacyDataImport(){
		global $dbconn;

		$sql1="SELECT * FROM privacy_scores_import";
		$result1 = pg_query($dbconn, $sql1) or die('Query privacy_stars failed: ' . pg_last_error());
		$data = array();
		/*while ($line1 = pg_fetch_array($result1, null, PGSQL_ASSOC)) {
		    $data[] = $line1;
		}*/
		$data = pg_fetch_all($result1);

		pg_free_result($result1);

		print_r($data);

		pg_close($dbconn);

		return $privacy;
	}
}
?>