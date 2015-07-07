<!doctype html>
<html lang="en">

<head>
	<!-- META INFORMATION -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="description" content="IXmaps is an internet mapping tool that allows you to see how your personal data travels across the internet.">
	<title>See where your data packets go | IXmaps</title>

	<!-- JAVA SCRIPT -->
	<script type="text/javascript" src="/js/prototype.js"></script>
	<script type="text/javascript" src="/js/scriptaculous.js?load=effects,builder"></script>
	<script type="text/javascript" src="/js/lightbox.js"></script>
	<script type="text/javascript">
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
	<link rel="stylesheet" href="css/overwrites.css" type="text/css" />
</head>

<body>
<div id="wrapper"><!-- #wrapper -->
<header><!-- header -->
	<img src="images/headerimage.jpg" alt="IXmaps Logo" width="1000" height="138">
</header><!-- end of header -->

<?php include("includes/navigation.php"); ?>

<section id="main"><!-- #main content and sidebar area -->

<section id="container"><!-- #container -->
	<section id="content"><!-- #content -->

		<article>
			<h2>Privacy Policy</h2>
			<p>This privacy policy outlines how we may collect your personal data as a visitor to our website. Through the IXmaps website and TRgen traceroute software, we collect the following information:</p>
			<ul>
				<li>E-mail addresses from those who send inquiries to the project. We will not share, sell, or distribute your e-mail address.</li>
				<li>Usage statistics on our Web pages, page downloads, and search engine queries.</li>
				<li>If you contribute to traceroutes, we anonymize your IP address by turning the last three digits into zeroes.</li>
			</ul>
			<p>You may contact us at any time to correct or change any personal data that we hold about you (for example, if you want to change your username). You may also ask to have all data related to your activity removed from our system. To do so, please <a href="mailto:ixmaps@utoronto.ca?subject=&#91;IXmaps%20Privacy%20Policy&#93;">email us</a>.</p>
			<p>This site is governed by the <a href="//www.fippa.utoronto.ca/" target="_blank">privacy policies of the University of Toronto</a>, and hence Ontario's <a href="//www.e-laws.gov.on.ca/html/statutes/english/elaws_statutes_90f31_e.htm" target="_blank">Freedom of Information and Protection of Privacy Act (FIPPA)</a>. </p>
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