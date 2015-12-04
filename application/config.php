<?php
// NEW config.php: updated Dec 1, 2015

// turn ON/OFF global php error message
ini_set( "display_errors", 0);

/* Db configuration */
$dbname 	= 'ixmaps';
$dbuser		= 'ixmaps';
$dbpassword	= '';
$dbport		= '5432';

// Connecting, selecting database
$dbconn = pg_connect("host=localhost dbname=$dbname user=$dbuser password=$dbpassword")
    or die('Could not connect to DB: ' . pg_last_error());

//////////////////////////////////////////////////////////
// ANTO local
/*$webUrl = "http://localhost/mywebapps/git-website-anto";
$appRootPath = '/Users/antonio/mywebapps/git-website-anto';
$savePath = $appRootPath.'/gm-temp';
// MaxMind data
$MM_geoip_dir = "/Users/antonio/mywebapps/git-website-anto/application/geoip";
$MM_dat_dir = $MM_geoip_dir."/dat";*/

//////////////////////////////////////////////////////////
//Development
$webUrl = "https://dev.ixmaps.ca";
$appRootPath = '/var/www/dev.ixmaps.ca'; 
$savePath = $appRootPath.'/gm-temp';
// MaxMind data
$MM_geoip_dir = "/var/www/dev.ixmaps.ca/application/geoip";
$MM_dat_dir = $MM_geoip_dir."/dat";

//////////////////////////////////////////////////////////
// Production !!
/*$webUrl = "https://www.ixmaps.ca";
$appRootPath = '/var/www/www.ixmaps.ca'; // !!
$savePath = $appRootPath.'/gm-temp';
// MaxMind data
$MM_geoip_dir = "/var/www/www.ixmaps.ca/application/geoip";
$MM_dat_dir = $MM_geoip_dir."/dat";*/

//////////////////////////////////////////////////////////
/*Gather TR URI*/ // !! ANTO: added on Nov 26, 2015
$gatherTrUri = "https://www.ixmaps.ca/cgi-bin/gather-tr.cgi";

//////////////////////////////////////////////////////////
//$trNumLimit=800; // 500 is very safe num with the new approach
$trNumLimit=100; 
$ixmaps_debug_mode = true;
$ixmaps_hands_off_config = array();

//////////////////////////////////////////////////////////
$coordExclude = array(
	'60,-95',
	'38,-97'
	);
?>
