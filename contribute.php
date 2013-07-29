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
	<link rel="stylesheet" href="css/ix.css" type="text/css" />
	<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="/css/overwrites.css" type="text/css" />
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
			<h2>Contribute</h2>
			
			<h3>Contributing to the IXmaps database</h3>
			
			<p>IXmaps relies on voluntary contributions to its database. Mainly this involves installing <b>TrGen</b>,
			a traceroute generating software application built by the IXmaps development team, and initiating
			traceroute requests targeted either at batches of selected sites across North America, or at individual
			URLs of a user's choosing. The more distinct the originating points, in terms of both geographic locale
			and ISP, the better able we are to map the locations of backbone routers. We also welcome corrections to
			our geo-location of IP addresses (i.e. via Flag this IP on the Explore page), and appreciate any information
			(including photos) about the various facilities we refer to.</p>
			
			At the moment, TrGen works on <b>Linux</b>, <b>Windows</b> and <b>Mac OSX</b> operating systems.<br />

			To install the Windows version, follow the instructions <a href = "/windows.php">listed here.</a><br />
			To install the Linux version, follow the instructions <a href = "/linux.php">listed here.</a><br />
			To install the Mac OSX version, follow the instructions <a href = "/macos.php">listed here.</a><br />
			
			<p>Please note that, due to how Mac handles OS updates, the listed TrGen may not be compatible with
			all OSX versions. If you would like to help with updating the Mac version 
			<a href="mailto: ixmaps@utoronto.ca?subject=[IXmaps Contribute]">please get in touch</a></p>
			
			<p>The source code for each of these versions of TrGen can be found <a href = "/technical.php">here</a></p>
			
			
			<h3>Contributing Knowledge</h3>
			
			<p>A fundamental component of the IXmaps project is the involvement of contributors, especially those who
			work in the datacentre industry, network management, or internet security. If you have specific information
			relevant to any of the subjects and themes outlined on this website and are interested in contributing, we
			encourage you to <a href="mailto: ixmaps@utoronto.ca?subject=[IXmaps Contribute]">please get in touch</a>.</p>
			
        </article>
        
	</section><!-- end of #content -->
</section><!-- end of #container -->

</section><!-- end of #main content and sidebar-->

<footer>
	<?php include("includes/footer.php"); ?>
</footer>
</div><!-- #wrapper -->
</body>
</html>
