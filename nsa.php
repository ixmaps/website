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
	<link rel="stylesheet" href="css/overwrites.css" type="text/css" />	
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
			<h2>NSA Listening Posts</h2>
	      <p>Description: The U.S. National Security Agency (NSA) warrantless surveillance controversy was brought to light by former AT&amp;T technician Mark Klein. Klein claims that several internet service providers (ISPs) in the United States have allowed the NSA to install devices which mirror all traffic passing through selected routers. This copied data is then inspected by Narus computers and routed back to NSA headquarters. Klein has described in detail a 'secret spy room&quot; at 611 Folsom St. in San Francisco - Room 641A - and knows of other such rooms in Los Angeles, San Diego, Seattle, San Jose and Atlanta (see his book Wiring Up The Big Brother Machine... And Fighting It, p.98). The NSA is strongly suspected of having installed a total of 15-20 similar spy rooms at major internet exchange points across the country (e.g Chicago, New York).

<a target="_blank" href="../cgi-bin/ge-render.cgi?show_nsa_listening_posts=true">View a map of these suspected NSA splitter locations.</a></p>

            <p>Thanks to former AT&amp;T technical Mark Klein, the best documented NSA eavesdropping site is at 611 Folsom Street, San Francisco, CA. <a href="../cgi-bin/tr-detail.cgi?traceroute_id=1859"> View a map of a traceroute from a home in Toronto to the San Francisco    Art Institute that passes through AT&amp;T's internet switching   facility  at  611 Folsom (TR#1859).</a> Note that this traceroute also goes through Chicago, another suspected site of NSA eavesdropping. </p>


            <table border="0">
              <tbody>
                <tr>
                  <th width="40">id</th>
                  <th width="110">origin</th>
                  <th>destination</th>
                  <th>description</th>
                </tr>
                <tr>
                  <td><a href="../cgi-bin/tr-detail.cgi?traceroute_id=1859" target="_blank">1859</a></td>
                  <td>Toronto, ON</td>
                  <td>San Francisco Art Institute (sfai.edu)</td>
                  <td>This route passes through a known NSA listening post at 611 Folsom st. in San Francisco</td>
                </tr>
                <tr>
                  <td><a href="../cgi-bin/tr-detail.cgi?traceroute_id=1751" target="_blank">1751</a></td>
                  <td>Austin, TX</td>
                  <td>San Francisco Law Library (sflawlib.ci.sf.ca.us)</td>
                  <td>This route passes through a suspected NSA listening post location in Los Angeles (as well as San Francisco)</td>
                </tr>
                <tr>
                  <td><a href="../cgi-bin/tr-detail.cgi?traceroute_id=1842" target="_blank">1842</a></td>
                  <td>Cambridge, ON</td>
                  <td>University of Washington (washington.edu)</td>
                  <td>This route passes through a suspected NSA listening post in Seattle.     It also passes through a location in Chicago that is suspected of     having an NSA listening post</td>
                </tr>
                <tr>
                  <td><a href="../cgi-bin/tr-detail.cgi?traceroute_id=3445" target="_blank">3445</a></td>
                  <td>New York, NY</td>
                  <td>CNet (cnet.com)</td>
                  <td>This route passes through a suspected NSA listening post in Atlanta</td>
                </tr>
              </tbody>
            </table>
		</article>
		<article>
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
