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
	<link rel="stylesheet" href="/css/ix.css" type="text/css" />
	<link rel="stylesheet" href="/css/lightbox.css" type="text/css" media="screen" />
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
		<h2>About the IXmaps Project</h2>
	    <p>IXmaps is an interactive tool that enables internet users and researchers to study the route(s) that data packets 
	    take across North America, with 'interesting' sites highlighted along the way. It has been under development since 2008 with
	    research funding from 
	    <a href="http://www.sshrc-crsh.gc.ca/funding-financement/programs-programmes/itst/research_grants-subventions_recherche-eng.aspx" target="_blank">
	    Social Sciences and Humanities Research Council of Canada's Image, Text, Sound and Technology  program</a>.</p>
	   	<p>IXmaps is affiliated with the <a href="http://www.sscqueens.org/projects/the-new-transparency/about" 
	   	target="_blank">New Transparency Project</a> and the <a href="http://iprp.ischool.utoronto.ca/" target="_blank">
	   	Information Policy Research Program</a> at the <a href="http://www.ischool.utoronto.ca/" target="_blank">
	   	Faculty of Information</a>, <a href="http://www.utoronto.ca/" target="_blank">University of Toronto</a>.</p>
	   	<h5>Current Project Team</h5>
		<ul>
		    <li><a href="http://www.ischool.utoronto.ca/users/andrewclement" target="_blank">
		    Andrew Clement, PhD</a>, Professor, Faculty of Information, University of Toronto</li>
		   	<li><a href="http://www.vacuumwoman.com/" target="_blank">
		   	Nancy Paterson, PhD</a>, Associate Professor, OCAD University</li>
		    <li><a href="http://www.linkedin.com/pub/colin-mccann/27/867/820" target="_blank">
		    Colin McCann, MI</a>, Faculty of Information, University of Toronto</li>
		    <li><a href="http://www.ischool.utoronto.ca/students/gabby-resch" target="_blank">
		    Gabby Resch, PhD Student</a>, Faculty of Information, University of Toronto</li>
		    <li><a href="http://www.ischool.utoronto.ca/students/antonio-gamba-bari" target="_blank">
		    Antonio Gamba, PhD Student</a>, Faculty of Information, University of Toronto</li>
		    <li><a href="http://tc.msu.edu/users/jonathan-obar" target="_blank">
		    Jonathan Obar, Post Doc</a>, Faculty of Information, University of Toronto</li>
		    <li><a href="http://www.linkedin.com/in/johnharrisstevenson" target="_blank">
		    John Stevenson, PhD</a>, University of Toronto</li>
		    <li><a href="ca.linkedin.com/pub/lauren-dimonte/27/15/169" target="_blank">
		    Lauren Di Monte, Graduate student</a>, Faculty of Information, University of Toronto</li>
		</ul>
        <h5>Former Members</h5>
		<ul>
		    <li><a href="http://www.ischool.utoronto.ca/users/davidjphillips" target="_blank">David J. Phillips, PhD</a>, Associate Professor, Faculty of Information, University of Toronto</li>
		    <li><a href="/erik.php" target="_blank">
		    Erik Stewart</a>, Programmer, Toronto</li>
		    <li>Steve Harvey, Software Developer, Toronto</li>
		    <li>Yannet Lathrop, MI, Faculty of Information, University of Toronto</li>
		    <br><br>
            <img src="images/logos.jpg" width="650" height="175"></p>
	        </li>
        </ul>
	  </article>
	</section>
	<!-- end of #content -->
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
