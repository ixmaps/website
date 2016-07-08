<?php
// Old redirection, preventing access from a ixmaps.ischool.utoronto.ca
$ixHost = $_SERVER["SERVER_NAME"];
if ($ixHost != 'www.ixmaps.ca' && $ixHost != 'dev.ixmaps.ca') {
  header("Location: http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
  exit();
}

/*Force redirection  either http or https*/

// forcing http
if(isset($_SERVER['HTTPS'])){
  header("Location: http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
  exit();
}

// forcing https
/*if(!isset($_SERVER['HTTPS'])){
  header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
  exit();
}*/
?>