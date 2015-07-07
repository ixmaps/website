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
			<h2><span class="style3">Other Sites of Interest</span><br />
          </h2>
	      <p>The following traceroutes have been selected because they feature interesting hops or routes - Canadian financial information traveling through the suspected NSA listening posts, for example. This section is currently under development. Please check back in the future to see more sites that we find interesting. </p>
          <table border="0">
            <tbody>
              <tr>
                <th width="40">id</th>
                <th width="110">origin</th>
                <th>destination</th>
                <th>description</th>
              </tr>
              <tr>
                <td><a href="../cgi-bin/tr-detail.cgi?traceroute_id=6915" target="_blank">6915</a></td>
                <td>Toronto, ON</td>
                <td>CIBC (cibconline.cibc.com)</td>
                <td>Canadian bank.</td>
              </tr>
              <tr>
                <td><a href="../cgi-bin/tr-detail.cgi?traceroute_id=6921" target="_blank">6921</a></td>
                <td>Toronto, ON</td>
                <td>UFile (ufile.ca)</td>
                <td>Online income tax filing software. The route passes through Atlanta, which has a suspected NSA listening post. <br /></td>
              </tr>
            </tbody>
          </table>
          <p>&nbsp;</p>
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

