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
			<h2>Connections Through IXPs with Interesting Ownership</h2>
			<p>Description:  A &ldquo;carrier hotel&rdquo; is an office building that is    tailored to  network operators. These
buildings and data centers are where internet  traffic changes hands from one network to another.    Carrier hotels have  separate real estate &lsquo;owners&rsquo; and
technical &lsquo;operators&rsquo; for the  inter-networking taking place inside. Typically    they are owned by large  public and private equity real-estate holding
 companies such as Hines  REIT (Real Estate investment trust), Carlyle    (CRG West - Carlyle Real  Estate West) and Digital Realty Trust.</p>

              <p>Another example of a carrier hotel with interesting ownership is the NAP of the Americas in Miami. This data center is one of the major
gateways for traffic to and from South and Central America. The site is owned by Terremark a carrier hotel operator, who have been recently acquired by Verizon which is a
large backbone operator. Since Verizon acquired Terremark people are wondering if we should be concerned that this incumbent backbone operator may have other plans regarding
internet traffic control.</p>
            <table border="0">
              <tbody>
                <tr>
                  <th width="40">id</th>
                  <th width="110">origin</th>
                  <th>destination</th>
                  <th>description</th>
                </tr>
                
                <tr>
                  <td><a href="../cgi-bin/tr-detail.cgi?traceroute_id=1250" target="_blank">1250</a></td>
                  <td>Nanaimo, BC</td>
                  <td>UC San Diego (ucsd.edu)</td>
                  <td>This route goes through 1 Wilshire, a carrier hotel in LA that was owned by The Carlyle Group but was recently sold to Hines REIT. In Sept 2010
Carlyle renamed its carrier hotel operations firm 'Coresite' and transformed from private to public equity.
</td>
                </tr>
                <tr>
                  <td><a href="../cgi-bin/tr-detail.cgi?traceroute_id=1577" target="_blank">1577</a></td>
                  <td>Honolulu, HI</td>
                  <td>University of Prince Edward Island (upei.ca)</td>
                  <td>This route passes through a large data center located at 600 West     7th St. in Los Angeles. The owner of the interconnection is Equinix.</td>
                </tr>
                <tr>
                  <td><a href="../cgi-bin/tr-detail.cgi?traceroute_id=4236" target="_blank">4236</a></td>
                  <td>Toronto, ON</td>
                  <td>Seattle Glassblowing Studio (seattleglassblowing.com)</td>
                  <td>This route passes through the largest carrier hotel in the world, at     350 East Cermak Rd. in Chicago. The site is owned by Digital Reality     Trust, America's largest operator of data center facilities.</td>
                </tr>
                <tr>
                  <td><a href="../cgi-bin/tr-detail.cgi?traceroute_id=1602" target="_blank">1602</a></td>
                  <td>Austin, TX</td>
                  <td>University of Windsor (uwindsor.ca)</td>
                  <td>This route goes through a data center at 1275 K St. in Washington. The site is owned by the Carlyle Group and run by CoreSite.</td>
                </tr>
                <tr>
                  <td><a href="../cgi-bin/tr-detail.cgi?traceroute_id=1018" target="_blank">1018</a></td>
                  <td>Toronto, ON</td>
                  <td>UC Berkeley (berkeley.edu)</td>
                  <td>This route passes through a data center at 55 Market St. in San Jose. It is also owned by the Carlyle Croup and run by CoreSite.</td>
                </tr>
                <tr>
                  <td><a href="../cgi-bin/tr-detail.cgi?traceroute_id=32" target="_blank">32</a></td>
                  <td>Toronto, ON</td>
                  <td>University of Miami (miami.edu)</td>
                  <td>This route passes through NAP of the Americas, a data center at 50     North East 9th St. in Miami. The site is     owned by Terremark, who are, in turn, owned by Verizon.</td>
                </tr>
              </tbody>
            </table>
            <p><br />
    	</article>
	</section><!-- end of #content -->
</section><!-- end of #container -->

<?php include("includes/sidebar.php"); ?>

</section><!-- end of #main content and sidebar-->

<footer>
	<?php include("includes/footer.php"); ?>
</footer>
</div><!-- #wrapper -->
</body>
</html>
