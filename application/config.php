<?php
ini_set( "display_errors", 1);

/* Db configuration */

/*$dbname 	= 'ixmaps';
$dbuser		= 'postgres';
$dbpassword	= '';
$dbport		= '5432';
*/
$dbname 	= 'ixmaps';
$dbuser		= 'ixmaps';
$dbpassword	= '';
$dbport		= '5432';

// Connecting, selecting database
$dbconn = pg_connect("host=localhost dbname=$dbname user=$dbuser password=$dbpassword")
    or die('Could not connect to DB: ' . pg_last_error());

// ANTO local
//$webUrl = "http://localhost/mywebapps/ixmaps.ca/dev.ixmaps.ca";
//$savePath = '/Applications/XAMPP/htdocs/mywebapps/ixmaps.ca/dev.ixmaps.ca/gm-temp';

// development
//$webUrl = "http://dev.ixmaps.ca";
//$savePath = '/var/www/dev.ixmaps.ca/gm-temp';

// production
/*$webUrl = "https://dev.ixmaps.ca";
$appRootPath = '/var/www/dev.ixmaps.ca'; // !!
$savePath = $appRootPath.'/gm-temp';*/

//ADD ONCE POSTGRES IS SET UP
$webUrl = "http://www.ixmaps.ca";
$appRootPath = '/var/www/www.ixmaps.ca'; // !!
$savePath = $appRootPath.'/gm-temp';

//$trNumLimit=800; // 500 is very safe num with the new approach
$trNumLimit=100;

$ixmaps_debug_mode = true;

$ixmaps_hands_off_config = array(

);

$coordExclude = array(
	'60,-95',
	'38,-97'
	);

//print_r($as_num_color);
?>
