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
		<h2>Technical</h2>
		  <p>This page outlines some of the more technical aspects of the IXmaps project. All technical inquiries regarding software, the IXmaps database, or the IXmaps website should be directed <a href="mailto: ixmaps@utoronto.ca?subject=[IXmaps Technical]">here</a>.</p>
	    <h5>Geolocation</h5>
        <p><a href="documents/geolocation.pdf" target="_blank">This  document</a></a> provides greater technical detail on the geolocation process we have employed. It outlines our attempt to geolocate IP addresses (and their corresponding routers) for the IXmaps database, details the logic and methods we have employed, and provides current information about parsing specific ISP hostnames. While the geolocation process provides more accurate longitude and latitude than is often provided by Maxmind, it generally remains reliable only at a city level; many corrections place routers at a generic city location instead of in a particular building.</p>
        <h5>System</h5>
	    <p>IXmaps is hosted on servers at the University of Toronto.
		    All of our data is stored in a <a href="http://www.postgresql.org/" target="_blank">PostgreSQL</a>
	      database built by the IXmaps research team. </p>

		  <p>TRgen, the software used to write to the database, is a cross-platform, free and open source
traceroute generator built in C. </p>
				  <ul class="nobullet">
					  <li><a href="TrGen/tr-sub-0.8.6.tar.gz" target="_blank">Download source code</a>
						  for the main traceroute submission (tr-sub) program.</li>

					  <li><a href="TrGen/tr-do.tar.gz" target="_blank">Download source code</a> for the
						  wmtrcmd utility program. </li>

					  <li><a href="TrGen/doxygen/index.html" target="_blank">View program documentation</a>
						  for the main traceroute submission (tr-sub) program.</li>
				  </ul>

	    <h5>&nbsp;</h5>
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
