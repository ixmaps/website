<?php

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
/*$webUrl = "http://localhost/mywebapps/ixmaps.ca/git.test/ixmaps";
$appRootPath = '/Applications/XAMPP/htdocs/mywebapps/ixmaps.ca/git.test/ixmaps'; // !!
$savePath = $appRootPath.'/gm-temp';*/

// Development
/*$webUrl = "http://dev.ixmaps.ischool.utoronto.ca";
$appRootPath = '/var/www/dev.ixmaps.ca'; // !!
$savePath = $appRootPath.'/gm-temp';
*/
// Production !! 
$webUrl = "http://ixmaps.ca";
$appRootPath = '/var/www/www.ixmaps.ca'; // !!
$savePath = $appRootPath.'/gm-temp';

/* Number of total resuts returned when queyring db in explore page. 
1000 is a safe number */
$trNumLimit=1000; 

$ixmaps_debug_mode = false;

$coordExclude = array(
	'60,-95',
	'38,-97'
	);
?>