<?php
// Preventing access from: ixmaps.ischool.utoronto.ca or other domains
$ixHost = $_SERVER["SERVER_NAME"];
//$ixHost = $_SERVER["HTTP_HOST"];
$URI = $_SERVER["REQUEST_URI"];
$URI_FORCE = "https://www.ixmaps.ca";
/*Force redirection  either http or https*/

// forcing https and checking whether server name is diferent from www.ixmaps.ca
if ((!isset($_SERVER['HTTPS'])) || ($ixHost != 'www.ixmaps.ca')){
//if (!isset($_SERVER['HTTPS'])){
  //header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
	header("Location: ".$URI_FORCE.$URI);
 	exit();
}
?>
