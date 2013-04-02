<!doctype html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
	<title>See where your data packets go | IXmaps</title>
	
	<!-- JAVA SCRIPT -->
    
    
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	<script type="text/javascript" src="js/prototype.js"></script>
	<script type="text/javascript" src="js/scriptaculous.js?load=effects,builder"></script>
	<script type="text/javascript" src="js/lightbox.js"></script>
	<!-- <script src="/flowplayer/example/flowplayer-3.1.4.min.js"></script> -->

  	<!-- ixmaps config file -->
  	<script type="text/javaScript" src="js/underscore-1.3.1.js"></script>
	<script type="text/javascript" src="js/ixmaps.js"></script>

	<script language="JavaScript" type="text/javascript">
	//--------------- LOCALIZEABLE GLOBALS ---------------
	
	var d=new Date();
	var monthname=new Array("January","February","March","April","May","June","July","August","September","October","November","December");
	//Ensure correct for language. English is "January 1, 2004"
	var TODAY = monthname[d.getMonth()] + " " + d.getDate() + ", " + d.getFullYear();
	
	//--------------- END LOCALIZEABLE ---------------

  	</script>

  	
	<script type="text/javascript">

	</script>

	<!-- STYLESHEETS -->
	<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/ix.css" type="text/css" />
	<link rel="stylesheet" href="css/ix-explore.css" type="text/css" />

</head>
<body onload="initialize()">
<div id="wrapper"><!-- #wrapper -->	
	<header><!-- header -->
      <img src="images/headerimage.jpg" width="1000" height="138">      <!-- <img src="images/headerimg.jpg" width="932" height="200" alt=""> header image -->
</header><!-- end of header -->
	
<?php include("includes/navigation.php"); ?>

<section id="main"><!-- #main content and sidebar area -->

<section id="container"><!-- #container -->
	<section id="content"><!-- #content -->

			<h2>Explore</h2>
<div style="border:2px solid #ccc; padding: 1em;">
	<p>Testing IP Tracker... surprisingly VERY accurate geolocation</p>
<script language="JavaScript" src="http://www.ip-tracker.org/track-ip-api.php"  type="text/JavaScript"></script><br />Powered by <a href="http://www.ip-tracker.org">IP Tracker</a>

<hr/>
<script language="JavaScript" src="http://www.ip-tracker.org/ip-tracer-api.php"  type="text/JavaScript"></script><br />Powered by <a href="http://www.ip-tracker.org">IP Tracker</a>
</div>

		  	<h3>Quick Links</h3>

		  	<div id="quick-links-table">
			  	<table>
				  	<tr>
				  		<td>
				  			<button id="last-submission-button">
				  				Examine last submitted traceroute
				  			</button>
					  	</td>
					  	<td>
				  			<button id="last-24-hours-button">
				  				Examine traceroutes in the last 24 hours
				  			</button>
					  	</td>
				  	</tr>
			  		<tr>
				  		<td>
				  			<button id="all-submitters-button">
				  				Examine traceroutes by submitter
				  			</button>
					  	</td>
					  	<td>
				  			<button id="all-boomerangs-button">
				  				Examine boomerang traceroutes
				  			</button>
					  	</td>
				  	</tr>	

			  		<tr>
				  		<td>
				  			<button id="all-nsa-cities-button">
				  				Examine traceroutes going through NSA cities
				  			</button>
					  	</td>
					  	<td>
				  			<button id="submitter-destinations--button">
				  				Examine destinations suggested by submitters
				  			</button>
					  	</td>
				  	</tr>	


				</table>
			</div>

		  	<br />
		  	<!-- <h3>Advanced Querys</h3> -->
		  	<div id="filter-constraint-global">
		  		<hr/>

		  		<h4>Global Filters (Not implemented)</h4>
		  		<i>Indicate if traceroutes go through a city containing:</i>
		  		<br/> <input name="NSA" type="checkbox"/> Known or suspected NSA listening facility
				<br/> <input name="CH" type="checkbox"/> Carrier hotel exchange point
		  		<br/> <input name="google" type="checkbox"/> Google data center
		  		<br/> <input name="UC" type="checkbox"/> Under construction facility ???
		  		<br/>
		  		Submitter: <input name="sName" type="text"/>
		  		Submitter's Zip Code/Postal: <input name="sZipCode" type="text"/>
		  		
		  	</div>
		  	
		  	<hr/>
			<!-- if you change these, remember to change in the ixmaps.js as well -->
		  	<h4>Custom Filters</h4>
		  	<div id="filter-container">
			<!-- these will filled in by addFilterConstraint -->
			</div>

			<br/>
		  	<button id="add-filter-button">Add Filter Line</button>			
		  	<button id="process-filters-button">Submit</button>
		  	<br/>
		  	<button id="reset-filters-button">Reset Values</button>
			
			
			<div class="hide">
				<hr/>
			  	<h4>ISP Traffic Handoffs (Not implemented)</h4>
			  	<div class="hands-off-query">
			  		<span class="filter-item-label">Carrier/ISP: </span><input type="text" id="carrier-1"/> hands off to <span class="filter-item-label">Carrier/ISP: </span><input type="text" id="carrier-2"/> 
			  	</div>
			  	<button id="process-handoffs-button">Submit</button>	
		  	</div>

		  	<div id="filter-results" class="hide">
		  		<!-- filled in when queries are returned -->
		  	</div>

		  	<div id="loader" style="display: none">
		  		<div id="loader-mask"></div>
		  		<div class="loader-image">
		  			<img width="100px" src="images/loading2.gif"/>
		  		</div>
		  	</div>
 
		
		
	</section><!-- end of #content -->
</section><!-- end of #container -->

<?php include("includes/sidebar.php"); ?>

</section><!-- end of #main content and sidebar-->

<footer>
	<section id="footer-area">
		<section id="footer-outer-block">
			<aside id="first" class="footer-segment">
					<p>The IXmaps website is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 2.5 License.
                    
					<script language="JavaScript">
					<!-- Hide JavaScript...
						var LastUpdated = document.lastModified;
						document.writeln ("This page was last updated " + LastUpdated);
					// End Hiding -->
					</script></p>
					
					<p>Please <a href="mailto: ixmaps@utoronto.ca?subject=IXmaps Website" class="smallinks">contact the site admin</a> 
						with any questions or concerns.</p>	
                    <p>To view our privacy policy, please <a href="../privacy.php" target="_blank">click here</a>.</p> 
			</aside><!-- end of #third footer segment -->
		</section><!-- end of footer-outer-block -->
	</section><!-- end of footer-area -->
</footer>
</div><!-- #wrapper -->
</body>
</html>
