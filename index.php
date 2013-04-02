<!doctype html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
	<title>See where your data packets go | IXmaps</title>
	
	<!-- JAVA SCRIPT -->
	<script type="text/javascript" src="/js/prototype.js"></script>
	<script type="text/javascript" src="/js/scriptaculous.js?load=effects,builder"></script>
	<script type="text/javascript" src="/js/lightbox.js"></script>
	<script src="/flowplayer/example/flowplayer-3.1.4.min.js"></script>
	<script language="JavaScript" type="text/javascript">
	//--------------- LOCALIZEABLE GLOBALS ---------------
	var d=new Date();
	var monthname=new Array("January","February","March","April","May","June","July","August","September","October","November","December");
	//Ensure correct for language. English is "January 1, 2004"
	var TODAY = monthname[d.getMonth()] + " " + d.getDate() + ", " + d.getFullYear();
	//--------------- END LOCALIZEABLE ---------------
  	</script>
	<script type="text/javascript">
	  
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-24555700-1']);
		_gaq.push(['_setDomainName', 'none']);
		_gaq.push(['_setAllowLinker', true]);
		_gaq.push(['_trackPageview']);

		(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();

	</script>

	<!-- STYLESHEETS -->
	<link rel="stylesheet" href="/css/ix.css" type="text/css" />
	<link rel="stylesheet" href="/css/lightbox.css" type="text/css" media="screen" />
</head>

<body>
<div id="wrapper"><!-- #wrapper -->	
<header><!-- header -->
  <img src="images/headerimage.jpg" width="1000" height="138">      
  <!-- <img src="images/headerimg.jpg" width="932" height="200" alt=""> header image -->
</header><!-- end of header -->
	
<?php include("includes/navigation.php"); ?>
	
<section id="main"><!-- #main content and sidebar area -->
	
<section id="container"><!-- #container -->
	<section id="content"><!-- #content -->
		<article>
			<h2>Welcome to IXmaps</h2>
			<p>IXmaps is an interactive tool that permits internet users to 
			see the route(s) their data packets take across North America, with 
			'interesting' sites highlighted along the way. </p>

			<h5>Getting Started</h5>
			<p>Click on the right-hand side of the map image below and then use the NEXT button to take a brief visual tour of a sample
				traceroute from Toronto to San Francisco. The routes passes through the buildings shown below, including 611 Folsom
				Street, where the NSA installed its surveillance equipment.<p>

			<p align="center" id="img">
			<a href="images/folsom_route.jpg" rel="lightbox[sandbox]"
			title="This traceroute, from Toronto, ON, Canada to the San Francisco Art Institute, 
			passes through a known NSA listening post at 611 Folsom st. in San Francisco.">
			<img src="images/thumbnails/folsom_route.jpg" width="657" height="253" /></a> 
		
			<a href="images/toronto.jpg" rel="lightbox[sandbox]" 
			title="Originating in Toronto, this traceroute passes through 151 Front Street, 
			a major carrier hotel that houses over 100 telecommunications companies, 
			and is Canada's premier telecommunications hub.">
			<img src="images/thumbnails/front.jpg"/></a>
		
			<a href="images/chi.jpg" rel="lightbox[sandbox]" 
			title="Crossing the Great Lakes, this traceroute passes through the Lakeside Technology 
			Center at 350 E. Cermak Rd in Chicago, a 1.1 million square foot multi-tenant data center hub."> 
			<img src="images/thumbnails/chicago.jpg" class="maincontent1" /> </a>
		
			<a href="images/chi_att.jpg" rel="lightbox[sandbox]" 
			title="After Peer 1 hands over the packets to SBC/AT&T, they are routed through one of its 
			Chicago data centers, where the NSA is suspected to have surveillance operations.">
			<img src="images/thumbnails/cloud_gate.jpg" class="maincontent1" /> </a>
	
			<a href="images/folsom.jpg" rel="lightbox[sandbox]" 
			title="Near the end of its path, this traceroute passes through 611 Folsom Street, in San Francisco, 
			a known NSA listening post. The existence of room 641A, an intercept facility operated by AT&T for 
			the NSA, was documented by former network engineer and whistleblower, Mark Klein.">
			<img src="images/thumbnails/folsom.jpg" class="maincontent1" /> </a>
	
			<a href="images/sfai.jpg" rel="lightbox[sandbox]" 
			title="This traceroute's terminal point is at the San Francisco Art Institute.">
			<img src="images/thumbnails/sfai.jpg" alt="q" class="maincontent1" /></a></p>
		</article>

		<h5>The Internet is not a Cloud!</h5>
		<p>Explore our <a href="tour.php">Showcase Routes section</a> to view a number of selected routes that reveal various
		interesting features of the North American internet backbone. For example, a group of chosen routes highlight where
		packets pass through suspected sites of NSA warrantless eavesdropping, while another group focuses on routes
		that begin and end in Canada but pass through the United States.</p>

		<h5>Geolocation</h5>
		<p>In determining the geographical location of traceroute IP addresses, the IXmaps 
		project team draws on GeoLite data provided by <a href="http://maxmind.com" target="_blank">MaxMind</a>, 
		supplemented by a substantial amount of our own independent research. We have taken considerable 
		effort to provide accurate data, but acknowledge that in this ever-changing field errors remain. 
		For more information on this, please consult the <a href="technical.php">technical page</a>.</p>

        <p>IXmaps is currently under development. We welcome your 
        <a href="mailto: ixmaps@utoronto.ca?subject=IXmaps Feedback" class="smallinks">feedback.</a></p>			
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
