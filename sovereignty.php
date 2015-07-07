<!doctype html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
	<title>See where your data packets go | IXmaps</title>

	<!-- JAVA SCRIPT -->
	<script type="text/javascript" src="/js/prototype.js"></script>
	<script type="text/javascript" src="/js/scriptaculous.js?load=effects,builder"></script>
	<script type="text/javascript" src="/js/lightbox.js"></script>
  <script src="/js/index.js"></script>
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

	<!-- STYLESHEETS -->
	<link rel="stylesheet" href="css/ix.css" type="text/css" />
	<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="/css/overwrites.css" type="text/css" />
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
			<h2><span class="style3">Canadian Network Sovereignty <br>
		    (&quot;Boomerang Routes&quot;)</span><br />
            </h2>
            <p>Description: due to current technical, economic and policy choices made principally by private corporations, Canadian internet traffic is often routed through the US. Thus, packets originating in Ottawa and terminating in Winnipeg may pass through routers in New York and Chicago before reaching their destination. This is sometimes referred to as a &quot;boomerang route,&quot; and frequently  occurs despite the fact that the route is longer through the US than  through Canada. These boomerang routes have also prompted concerns regarding Canadian network sovereignty, where Canadian packets passing through routers in the US  may be subject to unknown types of inspection or filtering.</p>
            <table border="0">
                <tbody>
                    <tr>
                        <th width="40">id</th>
                        <th width="110">origin</th>
                        <th>destination</th>
                        <th>description</th>
                    </tr>
                    <tr>
                        <td height="42"><a class="explore-target-route" data-route-id="4168">4168</a></td>
                        <td>Toronto, ON</td>
                        <td>Hockey Hall of Fame (hhof.ca)</td>
                        <td>This route's origin and destination are both in Toronto, yet it passes through the US.</td>
                    </tr>
                    <tr>
                        <td><a class="explore-target-route" data-route-id="1827">1827</a></td>
                        <td>Cambridge, ON</td>
                        <td>University of Toronto (utoronto.ca)</td>
                        <td>This route boomerangs from Kitchener to Chicago to Toronto<br /></td>
                    </tr>
                    <tr>
                        <td><a class="explore-target-route" data-route-id="1486">1486</a></td>
                        <td>Abbotsford, BC</td>
                        <td>Dalhousie University (dal.ca)</td>
                        <td>This route begins on the West coast of Canada and ends on the East coast, yet the majority of the routing is through the US <br /></td>
                    </tr>
                    <tr>
                        <td><a class="explore-target-route" data-route-id="1474">1474</a></td>
                        <td>Abbotsford, BC</td>
                        <td>Lakehead University (lakehead.ca)</td>
                        <td>This route begins in British Columbia and ends in Canada, yet is routed through San Jose, San Francisco, Kansas City and Chicago <br /></td>
                    </tr>
                    <tr>
                        <td><a class="explore-target-route" data-route-id="6896">6896</a></td>
                        <td>Toronto, ON</td>
                        <td>Ontario Student Assistance Program (osap.gov.on.ca)</td>
                        <td>While the origin and destination of this route are in Toronto, it also traverses New York and Chicago</td>
                    </tr>
                    <tr>
                        <td><a class="explore-target-route" data-route-id="6163">6163</a></td>
                        <td>Toronto, ON</td>
                        <td>Ontario Government (ontario.ca)</td>
                        <td>Traffic to this important Canadian site can be routed through New York and Chicago, depending on the particularities of peering agreements</td>
                    </tr>
                    <tr>
                        <td><a class="explore-target-route" data-route-id="6904">6904</a></td>
                        <td>Toronto, ON</td>
                        <td>Health Canada (www.hc-sc.gc.ca)</td>
                        <td>This route boomerangs from Toronto to New York and then to Montreal before heading towards Ottawa</td>
                    </tr>
                </tbody>
            </table>
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
