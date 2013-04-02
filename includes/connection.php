<?php
  $conn = pg_connect("host=localhost port=5432 dbname=ixmaps user=ixmaps password=Utor1939");
	if (!$conn) {
  		echo "An error occured.\n";
  		exit;
	}
?> 