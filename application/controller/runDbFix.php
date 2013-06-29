<?php
include('../config.php');
$sql = "";
//pg_query($dbconn, $sql) or die('Error! Insert Log FIX failed: ' . pg_last_error());
//pg_close($dbconn);
//echo 'Nothing to do for now.';

$sql="update privacy_scores set score = 0.5 where id = 149;";
$result = pg_query($dbconn, $sql) or die('Query failed: ' . pg_last_error());
pg_free_result($result);
pg_close($dbconn);
echo '<h1>data updated</h1>'.$sql;
?>