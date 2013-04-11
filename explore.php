<?php
// MaxMind Include Files needed to grab user's city 
include('application/geoip/geoip.inc');
include('application/geoip/geoipcity.inc');
include('application/geoip/geoipregionvars.php');

// using MaxMind to find the city of client IP address
$myIp = $_SERVER['REMOTE_ADDR'];

$gi1 = geoip_open("application/geoip/dat/GeoLiteCityv6.dat",GEOIP_STANDARD);
$record1 = geoip_record_by_addr_v6($gi1,"::".$myIp);
$myCity = ''.$record1->city;
geoip_close($gi1);
?>
<!doctype html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
	
	<title>See where your data packets go | IXmaps</title>


    <!-- Needed for skin of various UI components -->
    <link rel="stylesheet" href="jquery-ui-1.10.1/development-bundle/themes/base/jquery-ui.css" />
    <!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" /> -->

	<!-- jQuery  -->

	<!-- Get here latest jQuery: using a fixed version now for testing ... -->
    <script src="jquery-ui-1.10.1/js/jquery-1.9.1.js"></script>
    <script src="jquery-ui-1.10.1/js/jquery-ui-1.10.1.custom.js"></script>


  	<!-- These are needed to enable table sorter -->
    <script src="js/jquery.metadata.js"></script>
    <script src="js/jquery.tablesorter.min.js"></script>
    <link rel="stylesheet" href="css/tables.sorter.css" />
    <link rel="stylesheet" href="css/themes/blue/style.css" />

	<!-- Google Maps API  -->
	<!-- 
	<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
	 -->
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&v=3&libraries=geometry"></script>
  	
  	<!-- jQuery Utils  -->
	<script type="text/javaScript" src="js/underscore-min.js"></script>

  	<!-- IXmaps config files -->
	<script type="text/javascript" src="js/ixmaps.js"></script>
	<script type="text/javascript" src="js/ixmaps.gm.js"></script>
	
	<script>
	var myIp = '<?php echo $myIp; ?>';
	var myCity = '<?php echo $myCity; ?>';
    jQuery(function() {
	  jQuery("#tabs").tabs();
	  jQuery("#map-actions").tabs();
    });
    </script>

    <script type="text/javascript">
      var script = '<script type="text/javascript" src="http://google-maps-' +
          'utility-library-v3.googlecode.com/svn/trunk/infobubble/src/infobubble';
      if (document.location.search.indexOf('compiled') !== -1) {
        script += '-compiled';
      }
      script += '.js"><' + '/script>';
      document.write(script);
    </script>

	<script language="JavaScript" type="text/javascript">
	
	//--------------- LOCALIZEABLE GLOBALS ---------------
	var d=new Date();
	var monthname=new Array("January","February","March","April","May","June","July","August","September","October","November","December");
	//Ensure correct for language. English is "January 1, 2004"
	var TODAY = monthname[d.getMonth()] + " " + d.getDate() + ", " + d.getFullYear();
	
	//--------------- END LOCALIZEABLE ---------------

  	</script>

	<!-- STYLESHEETS -->
	<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />

	<!-- <link rel="stylesheet" href="css/ix.redefined.css" type="text/css" /> -->
	<link rel="stylesheet" href="css/ix.css" type="text/css" />
	<link rel="stylesheet" href="css/ix-explore.css" type="text/css" />

	<!-- this realy old stuff: NOT TO BE USED -->
	<!-- 
	<link rel="stylesheet" href="css/jquery-ui-1.8.24.custom.css"></script>
	-->

</head>
<body onload="initialize()">
<div id="wrapper"><!-- #wrapper -->	
	<header><!-- header -->
	      <img src="images/headerimage.jpg" width="1000" height="138">      <!-- <img src="images/headerimg.jpg" width="932" height="200" alt=""> header image -->
	</header><!-- end of header -->
		
	<nav><!-- top nav -->
		<div class="menu">
			<ul>
				<li><a href="../index.php">Home</a></li>
				<li><a href="../tour.php">Showcase Routes</a></li>
				<li><a href="../explore.php">Explore</a></li>
				<li><a href="../research.php">Resources</a></li>
				<li><a href="../contribute.php">Contribute</a></li>
				<li><a href="../technical.php">Technical</a></li>
				<li><a href="../faq.php">FAQ</a></li>
				<li><a href="../about.php">About</a></li>
				<li><a href="../contact.php">Contact</a></li>
			</ul>
		</div>
	</nav><!-- end of top nav -->


	<div style="clear: both;"></div>
	 <div id="explore-content">
		 <!-- tabs --> 
		 <div id="tabs">
		    <ul>
		        <li><a href="#tabs-0">Quick Links</a></li>
		        <li><a href="#tabs-1">Custom Filters</a></li>
		        <li><a href="#tabs-2">Selected Traceroutes</a></li>
		        <li><a href="#tabs-3">Map Options</a></li>
		        <li><a href="#tabs-4">Help</a></li>
		    </ul>

		    <!-- tabs-0 -->
		    <div id="tabs-0">
				<h4>Quick Links:</h4>					
					<table>
					  	<tr>
					  		<td>
						  		<form>
						  			<button type="button" class="ql-button" id="last-submission-button">
						  				Examine last submitted traceroute
						  			</button>
						  		</form>
						  	</td>
						  	<td>
						  		<form>
						  			<button type="button" class="ql-button" id="recent-routes-button">
						  				Examine last 50 submitted traceroutes
						  			</button>
						  		</form>
						  	</td>
					  	</tr>
				  		<tr>
					  		<td>
						  	</td>
						  	<td> 
<!-- 			  					<form>
						  			<button type="button" class="ql-button" id="ix-geocorrect-button">
						  				Examine traceroutes containing geo-corrections
						  			</button>
						  		</form> -->
						  	</td>
					  	</tr>
					  	<tr>
					  		<td>
						  		<form method="get" action="../../cgi-bin/tr-query.cgi">
						  			<button type="submit" class="ql-button" name="query_type" value="all_submitters">
						  				Examine traceroutes by submitter
						  			</button>
						  		</form>
						  	</td>
						  	<td>
						  		<form method="get" action="../../cgi-bin/tr-query.cgi">
						  			<button type="submit" class="ql-button" name="query_type" value="all_zip_codes">
						  				Examine routes by postal codes/zip codes
						  			</button>
						  		</form>
						  	</td>
					  	</tr>
					</table>

		    </div>
		    <!-- /tabs-0 -->
		    
		    <!-- /tabs-1 -->
		    <div id="tabs-1">
				  	<h3>Custom Filter Examples</h3>
				  	<table>
				  		<tr>
					  		<td>
						  		<form>
						  			<button type="button" class="ql-button" id="all-boomerangs-button">
						  				Examine boomerang traceroutes
						  			</button>
						  		</form>
						  	</td>
						  	<td>
						  		<form>
						  			<button type="button" class="ql-button" id="non-CA-button">
						  				Examine routes that do not go via Canada
						  			</button>
						  		</form>
						  	</td>
					  	</tr>

				  		<tr>
					  		<td>
						  		<form>
						  			<button type="button" class="ql-button" id="contain-NSA-button">
						  				Examine routes that contain NSA cities
						  			</button>
						  		</form>
						  	</td>
						  	<td>
						  		<form>
						  			<button type="button" class="ql-button" id="non-US-button">
						  				Examine routes that do not go via the US
						  			</button>
						  		</form>
						  	</td>
					  	<tr>
				  			<td>
						  		<form>
						  			<button type="button" class="ql-button" id="my-city-button">
						  				Examine traceroutes from my city
						  			</button>
		  						</form>
				  			</td>

					  	</tr>

					</table>
					<br/>
			  	<h3>Custom Filters</h3>
			  	<!-- autocomplete data -->
			  	<div id="autocomplete-data" class="hide"></div>

			  	<div id="filter-container">
					<!-- these will filled in by addFilterConstraint -->
				</div>
				<div>
					<div style="float: left;">
					  	<button id="reset-filters-button">Reset Values</button>
				  	</div>
				  	<div style="margin-left: 20px;">
				  		<button id="process-filters-button"><b>Submit</b></button>
				  	</div>
				</div>
		    </div>
		    <!-- /tabs-1 -->

		    <!-- /tabs-2 -->
		    <div id="tabs-2">
		    	<h3>Selected Traceroutes</h3>
				<p class="warning">... add here direct links to showcase TRs, so that they can be rendered in GM using only one click.</p>
				<p class="warning">Also, we can add images and descriptions of each selected TR.</p>
		    </div>
		    <!-- /tabs-2 -->

		    <!-- tabs-3 -->
		    <div id="tabs-3">
				<h3>Enable</h3>
				<div id="map-op-0" class="map-actions-controls">								
					<input id="map-allow-multiple" class="map-tool-off" type="button" onMouseDown="setAllowMultipleTrs()" value="Multiple TRs"/> 
					<input id="map-allow-recenter" class="map-tool-on" type="button" onMouseDown="setAllowRecenter()" value="Re-center"/> 
				</div>

				<br/>
				<h3>Display</h3>
				<div id="map-op-1" class="map-actions-controls">
					<input id="map-show-hops" class="map-tool-on" type="button" onMouseDown="setShowHops()" value="Hops"/> 
					<input id="map-show-routers" class="map-tool-on" type="button" onMouseDown="setShowRouters()" value="Routers"/> 
					<input id="map-show-marker-origin" class="map-tool-off" type="button" onMouseDown="setAddMarkerInOrigin()" value="Marker in Origin"/> 
					<input id="map-show-info-global" class="map-tool-off" type="button" onMouseDown="setShowInfoGlobal()" value="Advanced Log"/> 
				</div>

				<br/>
				<h3>Exclude Routers</h3>
				<div id="map-op-2" class="map-actions-controls">
					<input id="map-exclude-a" class="map-tool-on" type="button" onMouseDown="excludeA()" value="Lat/Long = 0"/>
					<input id="map-exclude-b" class="map-tool-on" type="button" onMouseDown="excludeB()" value="Generic Locations"/>
					<input id="map-exclude-d" class="map-tool-on" type="button" onMouseDown="excludeD()" value="Reserved AS"/>
					<input id="map-exclude-c" class="map-tool-on" type="button" onMouseDown="excludeC()" value="Impossible Distances"/>
					<input id="map-exclude-e" class="map-tool-off" type="button" onMouseDown="excludeE()" value="User-flagged"/>
					
				</div>
			</div>
		    <!-- /tabs-3 -->

			<!-- tabs-4 -->
		    <div id="tabs-4">
		    	<h3>Help</h3>
				<p>
					If you're a <i>new user</i>, it may be easiest to begin with some of our canned queries in the Quick Links section.
					For example, if you've just generated a traceroute, you'll be able to find it be clicking on 'Examine last submitted traceroute'
					or by clicking on 'Examine routes by submitter' and locating your submitter name.
				</p>

				<div>
					For users more comfortable with querying databases, the Custom Filters section allows dynamic, extensible queries based
					on many of the data fields collected by the traceroute generator program <a id="custom-filters-more-button">[more]</a>
				</div>
				<div class="expandable hide">
					<div>For example, to view routes that neither start nor end in Canada, a user could query:</div>
					<div><b>| Does not | Originate in | Country | CA | AND | +</b></div>
					<div><b>| Does not | Terminate in | Country | CA |</b></div>
					<div>Or, to browse routes ending in Toronto or Ottawa, a user could query:</div>
					<div><b>| Does | Terminate in | City | Toronto | OR | +</b></div>
					<div><b>| Does | Terminate in | City | Ottawa |</b></div>
					<div>
						Note that, while the query is performed on the entire IXmaps database, due to computational and bandwidth limitations
						the server only returns the first 200 results. If you do not see the route you were looking for, it is best to add additional
						filter constraints (e.g. Submitter).
					</div>
				</div>	
		    </div>
		    <!-- /tabs-4 -->

		</div>
		<!-- /tabs --> 

			  	<!-- <div id="quick-links-table"></div>		   -->

				<div style="clear: both"></div>

			  	<!-- Map  options -->
			  	<!-- FIXME add all this calls to javascript functions in jquery -->
			  	<a name="tot-trs" id="tot-trs"></a>
				<div id="map-container" class="hide">
					<div id="map-core-controls" class="hide" style="float:right;">
						<div id="map-status-info" class="" style="float:left;">
							<span id="map-loading-status"></span>
						</div>
						<div style="float:left;">
							<input class="map-tool-off" type="button" onMouseDown="addAllTrs()" value="Add All"/>
							<input class="map-tool-off" type="button" onMouseDown="removeAllTrs()" value="Remove All"/> 

							<!-- <input id="map-render-stop-play" class="map-tool-off" type="button" onMouseDown="stopRender()" value="Stop (Experimental)"/>  -->
						</div>
					</div>
				
					<div id="filter-results-log"></div>

					<div id="map-stats-container">				
						<!-- Check the css for this, some not used now  -->
						<div id="map-info-global" class="map-info-containers hide">
							<span id="map-info-total">map-info-total</span>
							<br/>
							<span id="map-router-exclusion">map-router-exclusion</span>
							<br/>
							<span id="map-impossible-distance-log"></span>
						</div>	
					</div>
					<!-- / map-stats-container -->
				</div>
				<!-- / map-container -->

				<div style="clear:both;"></div>

				<!-- map-canvas-container -->
				<div id="map-canvas-container" class="hide">
					<div style="float:left;">
						<div id="map-tr-active" class="map-info-containers">map-tr-active</div>
						<div id="map_canvas" class="map-canvas"></div>
						<div id="map-info" class="map-info-containers">map-mouse-actions</div>
					</div>
					<div style="">
						<div id="map-legend" class="map-info-containers--">map-legend</div>
					</div>
				</div>
				<!-- /map-canvas-container -->

				<div style="clear:both;"></div>

			  	<div id="filter-results" class="hide">
			  		<!-- filled in when queries are returned -->
			  	</div>
			  	<div id="filter-results-ixmaps-data" class="hide">
			  		<!-- filled in when queries are returned -->
			  	</div>

			  	<div id="loader" style="display: none">
			  		<div id="loader-mask"></div>
			  		<div class="loader-image">
			  			<img width="100px" src="images/loading2.gif"/>
			  		</div>
			  	</div>

	</div><!-- #content -->
	
</div><!-- #wrapper -->
<br/>
	<?php //include("includes/sidebar.php"); ?>
	<div id="tr-details" class="hide">
		<div id="tr-details-close">
			<a href="javascript:closeTrDetails();">
				<img src="images/icon-close.png">
			</a>
		</div>

		<div id="tr-details-data">
			<iframe id="tr-details-iframe" src=""></iframe>
		</div>
	</div>
</body>
</html>
