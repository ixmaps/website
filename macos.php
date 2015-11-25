<!doctype html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
	<title>See where your data packets go | IXmaps</title>

	<!-- JAVA SCRIPT -->
	<script type="text/javascript" src="/js/prototype.js"></script>
	<script type="text/javascript" src="/js/scriptaculous.js?load=effects,builder"></script>
	<script type="text/javascript" src="/js/lightbox.js"></script>
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
			<h2>Mac OS Installation</h2>

		   	<p>To install the Mac OS version of IXmapsClient (1.0), download the installer
			<a href = "https://www.ixmaps.ca/TrGen/IXmapsClient_v.1.0.dmg">from here</a>
			and	follow the instructions in ReadMe file. You will need administrator privileges
			to run and install the software. This version of the software has been tested on the following versions of Mac OS:</p>
			<ul>
				<li>10.6.8</li>
				<li>10.7.5</li>
				<li>10.8</li>
                                <li>10.10</li>
			</ul>
        <!-- <p>We are currently working on an updated version.</p> -->
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
