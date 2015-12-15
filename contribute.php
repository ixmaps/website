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
		/*var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-24555700-1']);
		_gaq.push(['_setDomainName', 'none']);
		_gaq.push(['_setAllowLinker', true]);
		_gaq.push(['_trackPageview']);

		(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();*/
	</script>

	<!-- Piwik -->
	<script type="text/javascript">
	    var _paq = _paq || [];
	    _paq.push(['trackPageView']);
	    _paq.push(['enableLinkTracking']);
	    (function() {
	    var u="//ixmaps.piwikpro.com//";
	    _paq.push(['setTrackerUrl', u+'piwik.php']);
	    _paq.push(['setSiteId', 1]);
	    var d=document, g=d.createElement('script'), 
	    s=d.getElementsByTagName('script')[0];
	    g.type='text/javascript'; g.async=true; 
	    g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
	    })();
	    </script>
	<noscript><p>
	  <img src="//ixmaps.piwikpro.com/piwik.php?idsite=1" 
	  style="border:0;" alt="" /></p>
	  </noscript>
	<!-- End Piwik Code -->

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
<!-- 			<div class="announcement">Please try out a preview version of our updated TrGen software for
			<a href="/TrGen/ixmapsNode.v.2.0_linux.tgz" title="ixmapsNode-2.0.1-linux.tgz">Linux</a> and
			<a href="/TrGen/ixmapsNode.v.2.0_osx.dmg" title="ixmapsNode-2.0.1-osx.dmg">Mac OS X</a>, and let us know what you think.
			<br />You can view the <a href="https://github.com/ixmaps/ixnode" title="Github ixmaps/ixnode repository" target="_blank">source code on GitHub</a>
			and <a href="https://github.com/ixmaps/ixnode/issues" title="IXmaps ixnode issue tracker" target="_blank">report any issues on our issue tracker</a> or
			<a href="mailto:ixmaps@utoronto.ca?subject=&#91;IXmaps%202.0.1%20Feedback]">email us</a>.
			</div> -->

			<h2>Contribute</h2>
			<h3>Contributing to the IXmaps database anonymously</h3>
			<p>IXmaps relies on voluntary contributions of anonymized <a href="/faq.php#Traceroute">traceroute</a> data. We invite you to join over 400 other contributors who have helped to grow the database to
			<!-- Retrieve number of database routes  -->
			<?php include('application/config.php');
				$result = pg_query($dbconn, "SELECT COUNT (DISTINCT traceroute.id) FROM public.traceroute");
				if (!$result) {
				  echo "more than 40000\n";
				  exit;
				}
				while ($row = pg_fetch_row($result)) {
				  echo "$row[0]";
				}
			?>
			traceroutes. The more distinct the originating points, in terms of both city and ISP,
			and the more varied the destination targets, the better able we are to display interesting internet routings.</p>

			<p>Contributing data involves installing the <strong>IXmaps Client</strong> traceroute
			generating software built by the IXmaps development team. It initiates traceroute
			requests from your location either at batches of pre-selected <a href="https://www.ixmaps.ca/trsets/" target="_blank">target sites</a>, or at individual <a href="/faq.php#Hostname">hostnames</a> (like URLs) of your choosing. You can view the traceroutes you and others have contributed via the <a href="/explore.php">Explore page.</a></p>

			<p>To ensure the anonymity of contributors, we do not store the IP address of your personal device, but only a truncated version, with the last quad zeroed out. eg. 123.456.781.0. To verify this, check out our free and open source code on <a href="https://github.com/ixmaps/ixnode" target="_blank">GitHub</a>. See our <a href="/privacy.php">Privacy page</a>, for more on how we anonymize your IP address and protect your privacy.</p>

			<br />

			<h3>Installing and running the IXmaps Client</h3>
			<p>IXmaps Client currently works on most current computers and popular versions of the <strong>Mac OSX</strong>, <strong>Windows</strong> and <strong>Linux</strong> operating systems. We currently do not offer IXmaps Client for Android, iOS or Windows Phone.</p>
			<h4>System requirements:</h4>
			<ul class="nobullet">
				<li>Intel processor</li>
				<li>Mac OS X v10.6 or higher (tested on 10.6.8, 10.7.5, 10.8, 10.10. If you would like to help with updating the Mac version please <a href="mailto:ixmaps@utoronto.ca?subject=&#91;IXmaps%20Contribute]">get in touch</a>)<li>
				<li>1GB of RAM</li>
			</ul>
			<h4>Mac OSX installation</h4>
			<p><a href="https://www.ixmaps.ca/TrGen/IXmapsClient_v.1.0.1.dmg">Download the installer from here - IXmapsClient_v.1.0.1.dmg</a> and follow the instructions in the ReadMe file. You will need administrator privileges to run and install the software. You may also need to adjust your privacy and security settings to allow installing applications downloaded from the internet.</p>

			<h4>Linux installation</h4>
			<p><a href="https://www.ixmaps.ca/TrGen/IXmapsClient_linux_v.1.0.zip">Download the installer from here - IXmapsClient_linux_v.1.0.zip</a> and follow the instructions in the ReadMe file. You will need administrator privileges to run and install the software. </p>

			<h4>Windows installation</h4>
			<p>To install (an older) version of our traceroute generator (TrGen), <a href="https://www.ixmaps.ca/TrGen/trgen-0.8.8.msi">download the Windows installer from here</a> and follow the instructions. You will not need administrator privileges to run the software once installed, but you may need to be logged into an administrator account to install it. (We welcome help from those with Windows installation experience in creating a Windows package for the latest version of IXmaps Client software.)</p>

			<br />

			<h3>Other welcome contributions</h3>
			<h4>Correcting the location of routers</h4>
			<p>Locating accurately the individual routers that switch data packets along the way to their destination is challenging. You may find when examining traceroutes displayed on the Explore page that some routers appear out of place, sometimes even wildly. We invite you to use the Flag option on the Explore page to point these out and suggest more accurate locations for the IP addresses of such routers. See our FAQ page for more on <a href="/faq.php#Geolocation">geolocation</a>.</p>

			<h4>Improving our software</h4>
			<p>The code used for gathering traceroutes, as well as the code for the website and various related components, is free and open source, and available <a href="https://github.com/ixmaps" target="_blank">from our github repositories</a>.</p>
			<p>We welcome all feedback, technical inquiries or offers for assistance regarding IXmaps software, database, or website. Please <a href="mailto:ixmaps@utoronto.ca?subject=&#91;IXmaps%20Contribute]">email the IXmaps team.</a></p>

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