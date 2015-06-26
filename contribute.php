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
	<script src="/flowplayer/example/flowplayer-3.1.4.min.js"></script>
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
	<link rel="stylesheet" href="/css/ix.css" type="text/css" />
	<link rel="stylesheet" href="/css/lightbox.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="/css/overwrites.css" type="text/css" />
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
			<div id="announcement">Please try out a preview version of our updated TrGen software for 
			<a href="/TrGen/ixmapsNode.v.2.0_linux.tgz" title="ixmapsNode-2.0.1-linux.tgz">Linux</a> and 
			<a href="/TrGen/ixmapsNode.v.2.0_osx.dmg" title="ixmapsNode-2.0.1-osx.dmg">Mac OS X</a>, and let us know what you think. 
			<br />You can view the <a href="https://github.com/ixmaps/ixnode" title="Github ixmaps/ixnode repository" target="_blank">source code on GitHub</a> 
			and <a href="https://github.com/ixmaps/ixnode/issues" title="IXmaps ixnode issue tracker" target="_blank">report any issues on our issue tracker</a> or 
			<a href="mailto:ixmaps@utoronto.ca?subject=&#91;IXmaps%202.0.1%20Feedback]">email us</a>.
			</div>
			
			<h2>Contribute</h2>
			<h3>Contributing to the IXmaps database</h3>
			<p>IXmaps relies on voluntary contributions of anonymized data. We invite you to join over 300 other 
			contributors who have helped grow the main database to 
			<!-- Retrieve number of database routes  -->
			<?php include('application/config.php');
				$result = pg_query($dbconn, "SELECT COUNT (DISTINCT traceroute.id) FROM public.traceroute");
				if (!$result) {
				  echo "more than 30000\n";
				  exit;
				}
				while ($row = pg_fetch_row($result)) {
				  echo "$row[0]";
				}
			?>
			traceroutes. The more distinct the originating points, in terms of both geographic locale and ISP, 
			and the more the destination targets, the better able we are to display internet routings.</p>

			<p>Contributing mainly involves installing <strong>TrGen</strong>, a <a href="/faq.php#Traceroute">traceroute</a> 
			generating software application built by the IXmaps development team, and initiating traceroute 
			requests from your location targeted either at batches of selected sites, or at individual 
			hostnames (like URLs) of your choosing. You can view the traceroutes you and others have 
			contributed via the <a href="/explore.php">Explore page.</a></p>

			<h3>TrGen</h3>
			<p>At the moment, TrGen 0.8.8 works on <strong>Linux</strong>, <strong>Windows</strong> and <strong>Mac OSX</strong> operating systems.<br />
			<ul class="nobullet">
				<li>To install the Windows version, follow the instructions <a href="/windows.php">listed here.</a></li>
				<li>To install the Linux version, follow the instructions <a href="/linux.php">listed here.</a></li>
				<li>To install the Mac OSX version, follow the instructions <a href="/macos.php">listed here.</a></li>
			</ul>
			<p>The source code for these versions of TrGen 0.8.8 can be found <a href="/technical.php">here</a>.</p>

			<p>Please note that due to how Mac handles OS updates, the listed TrGen may not be compatible with all OSX versions. 
			If you would like to help with updating the Mac version <a href="mailto:ixmaps@utoronto.ca?subject=&#91;IXmaps%20Contribute]">please get in touch</a>.</p>

			<p>We also welcome corrections to our geo-location of IP addresses (i.e. via Flag this IP on the Explore page), and appreciate any 
			information (including photos) about the various facilities we refer to. 
			<a href="mailto:ixmaps@utoronto.ca?subject=&#91;IXmaps%20Contribute]">Email the IXmaps team</a>.</p>
        </article>

	</section><!-- end of #content -->
</section><!-- end of #container -->

</section><!-- end of #main content -->

<footer>
	<?php include("includes/footer.php"); ?>
</footer>
</div><!-- #wrapper -->
</body>
</html>