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
			<h2>Linux Installation</h2>
			 
		   	To begin, <a href="http://trgen.ixmaps.ca/TrGen/tr-sub-linux-0.8.8.tar.gz" target="blank">download the software 
		   	package</a> for TrGen.	At the moment, .deb and .rpm installation files are not available, 
		    but these instructions should be straightforward and easy to follow.
		    This download link has been tested on current Debian-based distributions 
			(<a href="http://www.debian.org/distrib/" target="blank">Debian 6</a>;
			<a href="http://www.ubuntu.com/download/" target="blank">Ubuntu 11.10</a>;
			and <a href="http://www.linuxmint.com/download.php" target="blank">Linux Mint 11</a>). 
			In order to install it, extract the contents of the compressed folder 
			to a location on your computer (downloads, for example). Next, open a terminal window and type: 
			<pre><code class="blackcode">cd /home/your username/Downloads/usr/local/bin</code></pre>						
			Make sure to replace <i>your username</i> with your actual username. 
			Enter <i>ls</i> and you should see two files: tr-sub and wmtrcmd. 
			Enter the following command: 
			<pre><code class="blackcode">sudo mv tr-sub /usr/local/bin</code></pre> 
			Enter the same command, replacing <i>tr-sub</i> <i>with wmtrcmd</i>. 
			Type in <i>cd</i> and press enter to clear your location. Type: 
			<pre><code class="blackcode">cd /usr/local/bin</code></pre> Follow this by pressing ls and enter. 
			You should now see <i>tr-sub</i> and <i>wmtrcmd</i> (and probably some other files and directories). 
			Now, type: <pre><code class="blackcode">chmod 755 wmtrcmd</code></pre> Press enter, then type: 
			<pre><code class="blackcode">gksu tr-sub</code></pre> and press enter.
			This will launch the Linux version of the software, 
			and you will be able to write your own traceroutes to the IXmaps database. 
			If you choose to make a desktop or menu launcher, make sure to enter gksu in the command section, so that 
			your launch command looks like 
			<pre><code class="blackcode">gksu /usr/local/bin/tr-sub</code></pre>
        
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
