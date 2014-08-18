<?php
$ixHost = $_SERVER["SERVER_NAME"];

/*if ($ixHost!='www.ixmaps.ca'){
    header('Location: http://www.ixmaps.ca/index.php');
	exit;
}*/
?>
<!doctype html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
	<title>See where your data packets go | IXmaps</title>

	<!-- JAVASCRIPT -->
	<script type="text/javascript" src="js/prototype.js"></script>
	<script type="text/javascript" src="js/scriptaculous.js?load=effects,builder"></script>
	<script type="text/javascript" src="js/lightbox.js"></script>
	<script src="flowplayer/example/flowplayer-3.1.4.min.js"></script>

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
	<link rel="stylesheet" href="css/ix.css" type="text/css" />
	<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/overwrites.css" type="text/css" />
</head>

<body onload="initialize()">
<div id="wrapper"><!-- #wrapper -->
<header><!-- header -->
  <img src="images/headerimage.jpg" width="1000" height="138">
  <span style="float:right; background-color:yellow; padding: 3px 10px 3px 10px">Announcing upcoming RFP for software development. <a href="documents/IXmaps-RequestforProposals20140801.pdf" 
class="smallinks">Click here.</a></span>
  <!-- <img src="images/headerimg.jpg" width="932" height="200" alt=""> header image -->
</header><!-- end of header -->

<?php include("includes/navigation.php"); ?>

<section id="main"><!-- #main content and sidebar area -->

<!-- BETA VERSION MESSAGE -->
<!-- 	<span id="beta-message"><i>This beta version is being upgraded. We welcome your <a href="mailto: ixmaps@utoronto.ca?subject=IXmaps Website Home Page">feedback</a></i></span>
 -->

<section id="container"><!-- #container -->
	<section id="content"><!-- #content -->

		<article id="homepage-news">
			<p class="justreleased">Recently Released</p> <p><b>Keeping Internet Users in the Know or in the Dark:</b><br>A Report on Data Privacy Transparency of Canadian Internet Service Providers.</p><p><a href="http://ixmaps.ca/transparency.php">Read the report</a></p>
		</article>
		<article>
			<!-- <div id="player-container"></div> -->
			<!-- <img id="play-icon" src="images/play_icon.png"/> -->
<!-- 			<div id="banner-container">
				<a class="no-link-decoration" href="http://thedaywefightback.ca/" target="_blank">
					<img id="banner-img" src="images/banner-2-eng.jpg" />
				</a>
			</div> -->
			<div class="slideshow">
				<div class="index-container">
					<a class="slideshow-img-container" href="https://vimeo.com/67102223" target="_blank">
						<img class="slideshow-img" src="images/MainPage_What_Is_IXmaps.jpg"/>
						<img class="play-icon" src="images/play_icon.png"/>
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
					<a class="slideshow-img-container" href="http://www.youtube.com/embed/pvdIB5vr4cw?enablejsapi=1&autoplay=1" target="_blank">
						<img class="slideshow-img" src="images/MainPage_Whos_Looking_At_Your_Data.jpg"/>
						<img class="play-icon" src="images/play_icon.png"/>
					</a>
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
				<div class="index-container">
					<a class="slideshow-img-container" href="http://www.youtube.com/embed/F_v0VMvjcI8?enablejsapi=1&autoplay=1" target="_blank">
						<img class="slideshow-img" src="images/MainPage_What_Are_Boomerang_Routes.jpg"/>
						<img class="play-icon" src="images/play_icon.png"/>
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
					<a class="slideshow-img-container" href="http://www.youtube.com/embed/g8-NmMNGpyk?enablejsapi=1&autoplay=1" target="_blank">
						<img class="slideshow-img" src="images/MainPage_HowTo_Video_Placeholder.jpg"/>
						<img class="play-icon" src="images/play_icon.png"/>
					</a>
					<span class="slideshow-text">
						<h5>The IXmaps database</h5>
						<p>We have collected over 20000 <a href="/faq.php#Traceroute">traceroutes</a> in our IXmaps database, all generated by users like you.
						These traceroutes are then <a href="/technical.php">geolocated</a>, and the visualizations are available to browse in our <a href="/explore.php">Explore page</a>
						Given how many options are available on the page, it may be helpful to <a class="text-video-link">watch this introductory video...</a></p>
					</span>
				</div>

			</div>

			<!-- <div class="btn-container">
				<button id="news-btn">
					<span>
						<div><i> Keeping Internet Users in the Know or in the Dark 2013</i></div>
						<div>A Report on the Data Privacy Transparency of Canadian Internet Service Providers</div>
						<div>(Jan 28, 2014, preview version)</div>
					</span>
				</button>
			</div> -->

			<!-- <div class="btn-container">
				<button id="news-btn">
					<span>
						<div><i> Keeping Internet Users in the Know or in the Dark 2013</i></div>
						<div>A Report on the Data Privacy Transparency of Canadian Internet Service Providers</div>
						<div>(Jan 28, 2014, preview version)</div>
					</span>
				</button>
			</div> -->

			<!-- <div class="box btn-container">
			    <div class="box-content">
			    	<p><i> Keeping Internet Users in the Know or in the Dark 2013</i></p>
			    	<p>A Report on the Data Privacy Transparency of the Canadian Internet Service Providers</p>
			    </div>
			    <img class='ribbon' src="http://quickribbon.com/ribbon/2014/01/4635089bf318b59a00ed2901b2559dc4.gif" />
			</div> -->

			<!-- <div id="report-container">
				<div><i> Keeping Internet Users in the Know or in the Dark 2013</i></div>
				<div>A Report on the Data Privacy Transparency of the Canadian Internet Service Providers</div>
				<button id="news-btn">
					Read more...
				</button>
			</div> -->


			<!-- <div id="star-table-container">
				<img src="images/star_table_26012014.png">
			</div> -->

		</article>

<!--
		<button id="left-big-btn" class="big-btn">
			Learn more at the IXmaps Workshop on May 29, 2013 from 9am to 12am.
		</button>
		<button id="right-big-btn" class="big-btn">
			Interested in what your ISP does with your data? Read our ISP Privacy Report.
		</button>
 -->



	</section><!-- end of #content -->
</section><!-- end of #container -->


<footer>
	<?php include("includes/footer.php"); ?>
</footer>
</div><!-- #wrapper -->
</body>
</html>
