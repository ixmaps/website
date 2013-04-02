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
<h2>Showcase Routes</h2>

<p>To view this data graphically, you must have 
<a href="http://earth.google.com/download-earth.html" target="_blank">Google Earth</a> downloaded and installed. Further instructions
	can be <a href="../instructions.php" target="_blank">found here</a>.</p>
<li>Click on any id number (eg 1859).</li>
<li>From the <a href="../cgi-bin/tr-detail.cgi?traceroute_id=1859" target="_blank"> traceroute detail page</a>, click on the
	 <span style="color: blue;">Open in Google Earth</span> link <i>at the top right</i> of the page and the visualization will automatically launch in Google Earth.</li>
<li>If you click on a node, a popup with further information will emerge over top of selected hops.</li>
			    
        <p>The following <a href="../faq.php#Traceroute" target="_blank">traceroutes</a> have been selected to demonstrate some of   the  more interesting aspects of internet traffic routing (as highlighted   by  IXmaps). These features include:</p>

		<ul class="nobullet">
			<li><a href="#NSA">NSA Internet Surveillance</a></li>
			<li><a href="#Sovereignty">Canadian Network Sovereignty (&quot;Boomerang Routes&quot;)</a></li>
			<li><a href="#Ownership">Connections through IXPs with Interesting Ownership</a></li>
		</ul>
		</article>
        
        <article>				
        <h5 id="NSA">NSA Internet Surveillance</h5>
		<p>The U.S. National Security Agency (NSA) warrantless surveillance practices occurring under the Bush Administration were brought to light by retired AT&T technician Mark Klein. Klein worked at the AT&T internet switching centre at 611 Folsom Street, San Francisco, where a <a href="../faq.php#Splitter Cabinet (7th Floor)" target="_blank">splitter cabinet</a> was installed to divert a copy of all gateway traffic to NSA computers for inspection. The NSA is strongly suspected of having installed 15-20 similar spy rooms at other locations across the country (e.g. Los Angeles, New York).</p>
<p><a href="../cgi-bin/tr-detail.cgi?traceroute_id=1859" target="_blank">View a map of a traceroute from a home in Toronto to the San Francisco Art Institute that passes through AT&amp;T's internet switching facility at    611 Folsom (TR#1859).</a> Note that this traceroute also goes through Chicago, another suspected site of NSA eavesdropping.</p>
<p>For more on NSA surveillance, <a href="nsa.php">click here</a>.</p>
		</article>

		<article>
        <h5 id="Sovereignty">Canadian Network Sovereignty (&quot;Boomerang Routes&quot;)</h5>
<p>As a result of a variety of technical, economic and policy choices made principally by private corporations, Canadian internet traffic is often routed through the US, even when both origin and destination are within Canada. These "boomerang routes" prompt concerns regarding Canadian network sovereignty, since Canadians' packets passing through routers in the US are subject to US interests, such as surveillance under provisions of the USA Patriot Act or the NSA's warrantless surveillance program described elsewhere.</p>
<p>One example of a boomerang route is traceroute <a href="../cgi-bin/tr-detail.cgi?traceroute_id=4168" target="_blank">4168</a>, which originates in Toronto, and is destined for the Hockey Hall of Fame website, also in Toronto, but goes to Chicago and back.</p>
<p>For more on Canadian network sovereignty, <a href="sovereignty.php">click here</a>.</p>
		</article>

		<article>
        <h5 id="Ownership">Connections Through IXPs with Interesting Ownership</h5>
<p>Internet traffic changes hands from one network to another at internet exchange points (IXPs) or <a href="../faq.php#Carrier Hotel" target="_blank">carrier hotels</a>, usually located in large office buildings. Typically, these buildings are owned by major public and private equity real-estate holding companies, several of which have controversial connections. One prominent carrier hotel owner is the Carlyle Group, among the world's largest private equity firms, with close ties to former senior politicians and the defense industry. For example, traceroute <a href="../cgi-bin/tr-detail.cgi?traceroute_id=1250" target="_blank">1250</a>, originating in Nanaimo, BC and destined for UC San Diego passes through 1 Wilshire Blvd, a carrier hotel in LA that was owned by The Carlyle Group before being sold in 2007 to Hines REIT.</p>
<p>For more on IXPs with interesting ownership, <a href="ownership.php">click here</a>.</p>
</article>
	
    </section><!-- end of #content -->

</section><!-- end of #container -->

<?php include("includes/sidebar.php"); ?>

</section><!-- end of #main content and sidebar-->

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
