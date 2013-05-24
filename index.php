<!doctype html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
	<title>See where your data packets go | IXmaps</title>
	
	<!-- JAVASCRIPT -->
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
	<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript">
	    $.noConflict();
	    // jquery and prototype fight for the $
	</script>	
	<script type="text/javascript" src="js/jquery.cycle.all.js"></script>
	<script type="text/javascript" src="js/index.js"></script>

	<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery('.slideshow').cycle({
				fx: 'fade',
				pauseOnPagerHover: 0,
				timeout: 10000,
			});
		});
	</script>



	<!-- STYLESHEETS -->
	<link rel="stylesheet" href="/css/ix.css" type="text/css" />
	<link rel="stylesheet" href="/css/lightbox.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="/css/overwrites.css" type="text/css" />
</head>

<body onload="initialize()">
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

			<div class="slideshow">
				<div>
					<a id="slideshow-img-container" href="about.php">
						<img class="slideshow-img" src="images/thumbnails/folsom_route.jpg"/>
					</a>
					<span id="slideshow-text">
						<h5>What is IXmaps?</h5>
						<p>IXmaps is an internet mapping tool that allows you to see how your personal data travels across the internet.
						Every time you go online, your computer sends bits of information across the web to the sites that you visit.
						These bits of information are called "<a href="">data packets</a>", and they contain information that can used to identify you, your location and your browsing habits.
						We thing that it's important to know where your personal data goes, and who be looking at it along the way.
						<a href="">Learn more about IXmaps...</a></p>
					</span>
				</div>
				<div>
					<a id="slideshow-img-container" href="about.php">
						<img class="slideshow-img" src="temp_img_1.png"/>
					</a>
					<span id="slideshow-text">
						<h5>Lorumy title</h5>
						<p>Lorum Ipsom</p>
					</span>
				</div>
				<div>
					<a id="slideshow-img-container" href="about.php">
						<img class="slideshow-img" src="images/thumbnails/folsom_route.jpg"/>
					</a>
					<span id="slideshow-text">
						<h5>Lorumy title v2</h5>
						<p>Lorum Ipsom v2</p>
					</span>
				</div>
				<div>
					<a id="slideshow-img-container" href="about.php">
						<img class="slideshow-img" src="temp_img_1.png"/>
					</a>
					<span id="slideshow-text">
						<h5>Lorumy title v3</h5>
						<p>Lorum Ipsom v3</p>
					</span>
				</div>
			</div>
			
		</article>

		<button id="left-big-btn" class="big-btn">
			Learn more at the IXmaps Workshop on May 29, 2013 from 9am to 12am.
		</button>
		<button id="right-big-btn" class="big-btn">
			Interested in what your ISP does with your data? Read our ISP Privacy Report.
		</button>		
	</section><!-- end of #content -->
</section><!-- end of #container -->
			

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
