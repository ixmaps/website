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
	<link rel="stylesheet" href="ix.css" type="text/css" />
	<link rel="stylesheet" href="/css/lightbox.css" type="text/css" media="screen" />
</head>
<body>
<div id="wrapper"><!-- #wrapper -->	
	<header><!-- header -->
      <img src="images/headerimage.jpg" width="1000" height="138">      <!-- <img src="images/headerimg.jpg" width="932" height="200" alt=""> header image -->
</header><!-- end of header -->
	
<?php include("includes/navigation.php"); ?>

<section id="main"><!-- #main content and sidebar area -->

<section id="container"><!-- #container -->
	<section id="content"><!-- #content -->
		<article>
			<h2>Explore</h2>
			<p>At the moment, this section is under development. As the IXmaps database expands, users will be given the opportunity to submit database queries that enable individual exploration of the accumulated traceroute data. For example, a user will be able to selectively interrogate the IXmaps database by following step-by-step instructions and answering questions at each step, in order to assemble more specific queries. Users already familiar with the IXmaps database and the SQL query language will be able to enter SQL queries directly. 
<!--				<p>Currently, the IXmaps database features _________ traceroutes, from __ contributors.<br>
			  __ unique IP addresses, from _______ physical addresses, have submitted to the IXmaps database, submitting requests to ________ destinations.                 -->
		  <p>If you would like to search the database by pre-selected fields, click on one of the buttons below:</p>

		<td><form method="get" action="../../cgi-bin/tr-query.cgi">
      		<button type="submit" name="query_type" value="all_submitters">
      		Examine by Submitter
      		</button>
      		</form>        
    	</td>
    		
	   	<td>
    		<form method="get" action="../../cgi-bin/tr-query.cgi">
      		<button type="submit" name="query_type" value="all_zip_codes">
      		Examine by Zip Codes
      		</button>
      		</form>        
    	</td>

		<td>
		  <form method="get" action="../../cgi-bin/tr-query.cgi">
		    <button type="submit" name="query_type" value="boomerang">
		    Examine all Boomerang Routes
		    </button>
		    </form>        
		 </td>

<!-- I envision using this query to show routes to Turnitin, Refworks, or other ones from U of T -->
<!--
           	<td>
        		<form method="get" action="../../cgi-bin/tr-detail.cgi">
          		<button type="submit" <name="all_UTOR" value="1">
          		Examine all U of T-related Traceroutes
          		</button>
          		</form>        
        	</td>
-->
		<td>
		  <form method="get" action="../../cgi-bin/tr-query.cgi">
		    <button type="submit" name="query_type" value="just_canada">
		    Examine all Routes that remain solely in Canada
		    </button>
		  </form>        
		</td>

		<FORM
			ACTION="../../cgi-bin/tr-query.cgi"
			METHOD=POST onSubmit="return dropdown(get)">
			<SELECT NAME="query_type">
				<OPTION VALUE="all_submitters">Submitter
				<OPTION VALUE="all_zip_codes">Zip Codes
				<OPTION VALUE="traceroute_id--geek_version">Geek
				<OPTION VALUE="just_canada">Canadian Routes
				<OPTION VALUE="origin">Origin
				<OPTION VALUE="destination">Destination
				<OPTION VALUE="nsa">NSA
				<OPTION VALUE="boomerang">Boomerang
				<OPTION VALUE="as">AS#
			</SELECT>
			<INPUT TYPE=SUBMIT VALUE="Go">
		</FORM>
		<br>
		
		<form name="myform" action="../../cgi-bin/tr-query.cgi">
			Query by location (Country; City): <input type='text' name='query' />
			<a href="javascript: submitform()">
			<INPUT TYPE=SUBMIT VALUE="Show"></a>
		</form>
		<script type="text/javascript">
		function submitform() 
		{
			if(document.myform.onsubmit &&
			!document.myform.onsubmit())
			{
    			return;
			}
		  document.myform.submit();
		}
		</script>
		<form name="myform" action="../../cgi-bin/tr-query.cgi">
			Refine results by IP address: <input type='text' name='query' />
			<a href="javascript: submitform()">
			<INPUT TYPE=SUBMIT VALUE="Show"></a>
		</form>
		<script type="text/javascript">
		function submitform() 
		{
			if(document.myform.onsubmit &&
			!document.myform.onsubmit())
			{
    			return;
			}
		  document.myform.submit();
		}
		</script>
		<br>
		
			<?php

			$conn = pg_connect("host=localhost port=5432 dbname=ixmaps");
			if (!$conn) {
			  echo "An error occured.\n";
			  exit;
			}
			
			$result = pg_query($conn, "SELECT traceroute.id FROM public.traceroute WHERE traceroute.submitter = 'Nancy-Glendon'");
			if (!$result) {
			  echo "An error occured.\n";
			  exit;
			}
			
			while ($row = pg_fetch_row($result)) {
			  echo "ID numbers for routes done by user Nancy-Glendon... this is a test!: $row[0]";
			  echo "<br />\n";
			}
			 
			?>
		
		
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
