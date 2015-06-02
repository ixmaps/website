
<?php
//#!/usr/bin/php -q

// This code demonstrates how to lookup the country, region, city,
// postal code, latitude, and longitude by IP Address.
// It is designed to work with GeoIP/GeoLite City

// Note that you must download the New Format of GeoIP City (GEO-133).
// The old format (GEO-132) will not work.

include("geoip.inc");
include("geoipcity.inc");
include("geoipregionvars.php");

if(isset($_POST['ip']))
{
	$ip=$_POST['ip'];

/*	print $recordIx->country_code . " " . $record->country_code3 . " " . $record->country_name . "<br/>";
	print $recordIx->region . " " . $GEOIP_REGION_NAME[$record->country_code][$record->region] . "<br/>";
	print $recordIx->city . "<br/>";
	print $recordIx->postal_code . "<br/>";
	print $recordIx->latitude . "<br/>";
	print $recordIx->longitude . "<br/>";
	print $recordIx->metro_code . "<br/>";
	print $recordIx->area_code . "<br/>";
	print $recordIx->continent_code . "<br/>";
*/	

} else {
	//$ip = '';
	$ip=$_SERVER['REMOTE_ADDR'];
}

$giIx = geoip_open("dat/GeoLiteCity.dat",GEOIP_STANDARD);
$recordIx = geoip_record_by_addr($giIx,$ip);
$lat = $recordIx->latitude;
$long = $recordIx->longitude;
geoip_close($giIx);

?>


<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Locate IP</title>
    <!-- <link href="google-maps.css" rel="stylesheet"> -->
    
    <STYLE type="text/css">
		#map_canvas {
		/*  position: absolute;
		  top: 0;
		  left: 0;
		*/  height: 500px;
		  width: 680px;
		}
 	</STYLE>
    
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script language="JavaScript">

      function initialize() {
      	<?php 
      	if($ip!='')
      	{
      	?>
        var myLatLng = new google.maps.LatLng(<?php echo $lat.','.$long;?>);
        var mapOptions = {
          zoom: 6,
          center: myLatLng,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
////////
		var ip_IXmaps = new google.maps.LatLng(<?php echo $lat.','.$long;?>)
		var marker_IXmaps = new google.maps.Marker({
	      position: ip_IXmaps,
	      map: map,
	      title:'<?php echo $ip;?>'
			});
		//marker_IXmaps.setIcon('http://localhost/mywebapps/ixmaps.ca/dev.ixmaps.ca/images/hop1.png');
///////
	<?php } ?>

      }
    </script>
  </head>
  <body onload="initialize()">
  	<div id="main" style="float: left;">
		<form action="index.php" method="post">
		IP: <input name="ip" type"text" value="<?php echo $ip;?>"/> <input type="submit" value="Geocode"/>
		</form>
<?php
if($ip!='') 
{
	echo '<hr/>'.$ip.' ('.$lat.' , '.$long.')';
	echo '<hr/><b>Using GeoIP.dat</b><br/>';
	$gi0 = geoip_open("dat/GeoIP.dat",GEOIP_STANDARD);

	echo geoip_country_code_by_addr($gi0, $ip) . "\t" .
	     geoip_country_name_by_addr($gi0, $ip) . "<br/>";

	geoip_close($gi0);

	// uncomment for Shared Memory support
	// geoip_load_shared_mem("/usr/local/share/GeoIP/GeoIPCity.dat");
	// $gi = geoip_open("/usr/local/share/GeoIP/GeoIPCity.dat",GEOIP_SHARED_MEMORY);

	//$gi = geoip_open("/usr/local/share/GeoIP/GeoLiteCityv6.dat",GEOIP_STANDARD);
	

	// ASN
	echo '<hr/><b>Using GeoIPASNum.dat</b><br/>';
	$giasn = geoip_open("dat/GeoIPASNum.dat", GEOIP_STANDARD);
	$asn = geoip_name_by_addr($giasn, $ip);
	echo "<br/>ASN: ".$asn;
	geoip_close($giasn);	

	echo '<hr/><b>Using GeoLiteCityv6.dat</b><br/>';
	$gi = geoip_open("dat/GeoLiteCityv6.dat",GEOIP_STANDARD);
	//$record = geoip_record_by_addr_v6($gi,"::24.24.24.24");
	$record = geoip_record_by_addr_v6($gi,"::".$ip);
	print $record->country_code . " " . $record->country_code3 . " " . $record->country_name . "<br/>";
	print $record->region . " " . $GEOIP_REGION_NAME[$record->country_code][$record->region] . "<br/>";
	print $record->city . "<br/>";
	print $record->postal_code . "<br/>";
	print $record->latitude . "<br/>";
	print $record->longitude . "<br/>";
	print $record->metro_code . "<br/>";
	print $record->area_code . "<br/>";
	print $record->continent_code . "<br/>";
	geoip_close($gi);



/*	include("geoipcity.inc");
	include("geoipregionvars.php");
*/
	// uncomment for Shared Memory support
	// geoip_load_shared_mem("/usr/local/share/GeoIP/GeoIPCity.dat");
	// $gi = geoip_open("/usr/local/share/GeoIP/GeoIPCity.dat",GEOIP_SHARED_MEMORY);

	echo '<hr/><b>Using GeoLiteCity.dat</b><br/>';
	$gi1 = geoip_open("dat/GeoLiteCity.dat",GEOIP_STANDARD);
	$record1 = geoip_record_by_addr($gi1,$ip);
	print $record1->country_code . " " . $record->country_code3 . " " . $record->country_name . "<br/>";
	print $record1->region . " " . $GEOIP_REGION_NAME[$record->country_code][$record->region] . "<br/>";
	print $record1->city . "<br/>";
	print $record1->postal_code . "<br/>";
	print $record1->latitude . "<br/>";
	print $record1->longitude . "<br/>";
	print $record1->metro_code . "<br/>";
	print $record1->area_code . "<br/>";
	print $record1->continent_code . "<br/>";
	geoip_close($gi1);
}
?>
	</div>
    <div id="map_canvas" style="float: right;"></div>
  </body>
</html>
