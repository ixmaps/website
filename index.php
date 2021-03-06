<?php
include("includes/check-redirect.php");
?>
<!doctype html>
<html lang="en">

<head>
	<!-- META INFORMATION -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="description" content="IXmaps is an internet mapping tool that allows you to see how your personal data travels across the internet.">
	<title>See where your data packets go | IXmaps</title>

	<!-- JAVASCRIPT -->
	<script type="text/javascript" src="js/prototype.js"></script>
	<script type="text/javascript" src="js/scriptaculous.js?load=effects,builder"></script>
	<script type="text/javascript" src="js/lightbox.js"></script>

	<script type="text/javascript">
		//--------------- LOCALIZEABLE GLOBALS ---------------
		var d=new Date();
		var monthname=new Array("January","February","March","April","May","June","July","August","September","October","November","December");
		//Ensure correct for language. English is "January 1, 2004"
		var TODAY = monthname[d.getMonth()] + " " + d.getDate() + ", " + d.getFullYear();
		//--------------- END LOCALIZEABLE ---------------
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
				timeout: 12000,
				pager: '#pager'
			});
		});
	</script>
	<script src="//www.youtube.com/iframe_api"></script>

	<!-- STYLESHEETS -->
	<link rel="stylesheet" href="css/ix.css" type="text/css" />
	<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/overwrites.css" type="text/css" />

	<!-- include analytics -->
	<?php include("includes/analytics.php"); ?>
</head>

<body onload="initialize()">
<div id="wrapper"><!-- #wrapper -->
<header><!-- header -->
	<img src="images/headerimage.jpg" width="1000" height="138">
</header><!-- end of header -->

<?php include("includes/navigation.php"); ?>

<section id="main"><!-- #main content and sidebar area -->

<section id="container"><!-- #container -->
	<section id="content"><!-- #content -->
		<article>
		<div class="announcement">Please try out the <a href="https://dev.ixmaps.ca">beta version</a> of the re-designed the IXmaps website. We welcome your feedback!</div>
			<div class="slideshow">
				<div class="index-container">
					<a class="slideshow-img-container" href="https://vimeo.com/67102223" target="_blank">
						<img class="slideshow-img" src="images/MainPage_What_Is_IXmaps.jpg"/>
						<img class="play-icon" src="images/play_icon.png" alt="Play Video icon" />
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
				<div class="index-container">
					<a class="slideshow-img-container" href="https://www.youtube.com/embed/pvdIB5vr4cw?enablejsapi=1&autoplay=1" target="_blank">
						<img class="slideshow-img" src="images/MainPage_Whos_Looking_At_Your_Data.jpg" />
						<img class="play-icon" src="images/play_icon.png" alt="Play Video icon" />
					</a>
					<span class="slideshow-text">
						<h5>Who's looking at your data?</h5>
						<p>The U.S. <a href="/nsa.php">National Security Agency (NSA)</a> engages in warrantless internet surveillance.
						Mark Klein, a former AT&amp;T technician turned whistleblower has revealed that the NSA has
						installed <a href="/faq.php#Spy Room (6th Floor)">surveillance equipment</a> at AT&amp;T’s main switching centre in San Francisco capable
						of intercepting all the data passing through it. The NSA is strongly suspected of operating
						similar spying facilities in 15-20 other U.S. cities. For example, <a class="explore-route-1859">one of our routes</a> shows that data packets from Toronto to
						the San Francisco Art Institute pass through several such suspected sites. <a class="text-video-link">Learn more about who's looking at your data...</a></p>
					</span>
				</div>
				<div class="index-container">
					<a class="slideshow-img-container" href="https://www.youtube.com/embed/F_v0VMvjcI8?enablejsapi=1&autoplay=1" target="_blank">
						<img class="slideshow-img" src="images/MainPage_What_Are_Boomerang_Routes.jpg"/>
						<img class="play-icon" src="images/play_icon.png" alt="Play Video icon" />
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
				<div class="index-container">
					<a class="slideshow-img-container" href="https://www.youtube.com/embed/_K_WIquGGbk?enablejsapi=1&autoplay=1" target="_blank">
						<img class="slideshow-img" src="images/MainPage_HowTo_Video_Placeholder.jpg"/>
						<img class="play-icon" src="images/play_icon.png" alt="Play Video icon" />
					</a>
					<span class="slideshow-text">
						<h5>The IXmaps database</h5>
						<p>We have collected over 50000 <a href="/faq.php#Traceroute">traceroutes</a> in our IXmaps database, all generated by users like you.
						These traceroutes are then <a href="/faq.php#Geolocation">geolocated</a>, and the visualizations are available to browse in our <a href="/explore.php">Explore page</a>
						Given how many options are available on the page, it may be helpful to <a class="text-video-link" href="https://www.youtube.com/embed/_K_WIquGGbk?enablejsapi=1&autoplay=1" target="_blank">watch this introductory video...</a></p>
					</span>
				</div>
			</div>
		</article>

		<br />

		<article id="homepage-news">
			<p><strong>Keeping Internet Users in the Know or in the Dark:</strong>
				<br />2014 Report on Data Privacy Transparency of Canadian Internet Service Providers.</p>
			<p><a href="https://ixmaps.ca/transparency.php"> Read the 2014 Report</a></p>
		</article>

	</section><!-- end of #content -->
</section><!-- end of #container -->

</section><!-- end of #content -->

<footer>
	<?php include("includes/footer.php"); ?>
</footer>
</div><!-- #wrapper -->
</body>
</html>
