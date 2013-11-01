<?php

/* Db configuration */

// anto local
/*$dbname 	= 'ixmaps';
$dbuser		= 'postgres';
$dbpassword	= 'anto123';
$dbport		= '5432';
*/
// ixmaps server
$dbname 	= 'ixmaps';
$dbuser		= 'ixmaps';
$dbpassword	= 'Utor1939';
$dbport		= '5432';

// Connecting, selecting database
$dbconn = pg_connect("host=localhost dbname=$dbname user=$dbuser password=$dbpassword")
    or die('Could not connect to DB: ' . pg_last_error());

// ANTO local
//$webUrl = "http://localhost/mywebapps/ixmaps.ca/git.test/ixmaps";
//$savePath = '/Applications/XAMPP/htdocs/mywebapps/ixmaps.ca/git.test/ixmaps/gm-temp';

// development
//$webUrl = "http://dev.ixmaps.ischool.utoronto.ca";
//$savePath = '/var/www/dev.ixmaps.ca/gm-temp';

// production
$savePath = '/var/www/www.ixmaps.ca/gm-temp';
$webUrl = "http://www.ixmaps.ca";

$trNumLimit=1200; // 1000 is a safe num with the new approach

$ixmaps_debug_mode = true;

$ixmaps_hands_off_config = array(	
		
);

$coordExclude = array(
	'60,-95',
	'38,-97'
	);

//print_r($as_num_color);
?>
