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
			jQuery('.slideshow')
			.after('<div id="pager">')
			.cycle({
				fx: 'fade',
				// pause: 1,
				timeout: 7000,
				pager: '#pager'
			});
		});
	</script>
	<script src="http://www.youtube.com/iframe_api"></script>


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
			<div id="player-container"></div>
			<img id="play-icon" src="images/play_icon.png"/>		
			<div class="slideshow">			
				<div class="index-container">
					<a class="slideshow-img-container" href="https://vimeo.com/67102223" target="_blank">
						<img class="slideshow-img" src="images/MainPage_What_Is_IXmaps.jpg"/>
					</a>
					<span class="slideshow-text">
						<h5>What is IXmaps?</h5>
						<p>IXmaps is an internet mapping tool that allows you to see how your personal data travels across the internet.
						Every time you go online, your computer exchanges "<a href="/faq.php#Packet">packets</a>" of information with the
						destination website, email server, etc. Along the way, your data is routed through switching centres,
						where it is potentially subject to surveillance by carriers or security agencies. Our research attempts to make
						this routing as well its privacy risks more visible and comprehensible. <a href="https://vimeo.com/67102223" target="_blank">Learn more about IXmaps...</a></p>
					</span>
				</div>
				<div class="index-container" id="pvdIB5vr4cw">
					<div class="slideshow-img-container video-img">
						<img class="slideshow-img" src="images/MainPage_Whos_Looking_At_Your_Data.jpg"/>
					</div>
					<span class="slideshow-text">
						<h5>Who's looking at your data?</h5>
						<p>The U.S. <a href="/nsa.php">National Security Agency (NSA)</a> engages in warrantless internet surveillance.
						Mark Klein, a former AT&T technician turned whistleblower has revealed that the NSA has
						installed <a href="/faq.php#Spy Room (6th Floor)">surveillance equipment</a> at AT&T’s main switching centre in San Francisco capable
						of intercepting all the data passing through it. The NSA is strongly suspected of operating 
						similar spying facilities in 15-20 other U.S. cities. For example, <a class="explore-route-1859">one of our routes</a> shows that data packets from Toronto to
						the San Francisco Art Institute pass through several such suspected sites. <a class="text-video-link">Learn more about who's looking at your data...</a></p>
					</span>
				</div>
				<div class="index-container" id="F_v0VMvjcI8">
					<a class="slideshow-img-container video-img">
						<img class="slideshow-img" src="images/MainPage_What_Are_Boomerang_Routes.jpg"/>
					</a>
					<span class="slideshow-text">
						<h5>What are 'boomerang' routes?</h5>
						<p>A boomerang route is a data packet path that starts and ends in Canada, but travels through the USA for part of the journey.
						We’ve found that a lot of Canadian internet traffic is routed this way, even when starting and ending in the same city.
						What’s more, much of this boomerang traffic passes though suspected U.S. National Security Agency (NSA)
						surveillance sites. Canadians who value their privacy may be concerned about boomerang routing
						because it means our personal data to the USA PATRIOT Act. <a class="text-video-link">Learn more about boomerang routes...</a></p>
					</span>
				</div>
				<div class="index-container" id="g8-NmMNGpyk">
					<a class="slideshow-img-container video-img">
						<img class="slideshow-img" src="images/MainPage_HowTo_Video_Placeholder.jpg"/>
					</a>
					<span class="slideshow-text">
						<h5>The IXmaps database</h5>
						<p>We have collected over 20000 <a href="/faq.php#Traceroute">traceroutes</a> in our IXmaps database, all generated by users like you.
						These traceroutes are then <a href="/technical.php">geolocated</a>, and the visualizations are available to browse in our <a href="/explore.php">Explore page</a>
						Given how many options are available on the page, it may be helpful to <a class="text-video-link">watch this introductory video...</a></p>
					</span>
				</div>

			</div>
			
		</article>

<!-- 
		<button id="left-big-btn" class="big-btn">
			Learn more at the IXmaps Workshop on May 29, 2013 from 9am to 12am.
		</button>
		<button id="right-big-btn" class="big-btn">
			Interested in what your ISP does with your data? Read our ISP Privacy Report.
		</button>
 -->
		<div class="btn-container">
			<button id="news-btn">
				New: Canadian Carriers Transparency and Privacy Report (Interim)
				<!-- <img id="news-btn-img" src="images/MainPage_HowTo_Video_Placeholder.jpg"/> do we want to add a small starred img here? -->
			</button>
		</div>

				
	</section><!-- end of #content -->
</section><!-- end of #container -->
			

<footer>
	<?php include("includes/footer.php"); ?>
</footer>
</div><!-- #wrapper -->
</body>
</html>
