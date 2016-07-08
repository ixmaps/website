<?php
// Preventing access from: ixmaps.ischool.utoronto.ca or ixmaps.ca
$ixHost = $_SERVER["SERVER_NAME"];
//$ixHost = $_SERVER["HTTP_HOST"];
$URI = $_SERVER["REQUEST_URI"];

/*Force redirection  either http or https*/

if ($ixHost != 'www.ixmaps.ca' && $ixHost != 'dev.ixmaps.ca') {
	//header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
 	header("Location: https://www.ixmaps.ca" . $URI);
 	exit();
}


// forcing https and checking whether server name is diferent from www.ixmaps.ca
if (!isset($_SERVER['HTTPS'])){
  //header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
	header("Location: https://www.ixmaps.ca" . $URI);
 	exit();
}
?>
