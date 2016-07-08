<?php
// Preventing access from: ixmaps.ischool.utoronto.ca or ixmaps.ca
$ixHost = $_SERVER["SERVER_NAME"];
/*if ($ixHost != 'www.ixmaps.ca' && $ixHost != 'dev.ixmaps.ca') {
  header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
  exit();
}*/

/*Force redirection  either http or https*/

// forcing http
/*if (isset($_SERVER['HTTPS'])){
  header("Location: http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
  exit();
}*/

// forcing https
if (!isset($_SERVER['HTTPS']) || $ixHost == "www.ixmaps.ca"){
  //header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
	header("Location: https://www.ixmaps.ca" . $_SERVER["REQUEST_URI"]);
 	exit();
}
?>
