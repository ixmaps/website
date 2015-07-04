<!doctype html>
<html lang="en">

<head>
	<!-- META INFORMATION -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="description" content="IXmaps is an internet mapping tool that allows you to see how your personal data travels across the internet.">
	<title>See where your data packets go | IXmaps</title>

	<!-- JAVASCRIPT -->
	<script type="text/javascript" src="js/prototype.js"></script>
	<script type="text/javascript" src="js/scriptaculous.js?load=effects,builder"></script>
	<script type="text/javascript" src="js/lightbox.js"></script>
	<script src="flowplayer/example/flowplayer-3.1.4.min.js"></script>

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
			<h2>News</h2>
			<h3>2015</h3>
			<ul>
				<li>June 26, 2015<br />CIRA <a href="https://cira.ca/blog/building-a-stronger-national-internet-part-1-local-peering" target="_blank">blog post</a> discussing the role of local peering in a national internet mentions the IXmaps project.</li>
				<li>March 27, 2015<br />TechVibes highlights the importance of data privacy and transparency <a href="http://www.techvibes.com/blog/canadian-internet-providers-transparent-protecting-consumer-data-2014-03-27" target="_blank">through a discussion of the recent Transparency report</a>.</li>
				<li>March 12, 2015<br />The IXmaps project is proud to announce the release of the its 2014 report on the Data Privacy Transparency of Canadian Internet Service Providers titled <a href="/transparency.php" target="_blank">Keeping Internet Users in the Know of in the Dark</a>.</li>
				<li>February 04, 2015<br />Toronto Star profiled IXmaps as part of the <a href="http://whatsyourtech.ca/2012/10/11/canadian-live-tech-demo-shows-your-data-on-the-internet/" target="_blank">newspaper's segment on privacy</a>.</li>
			</ul>

			<h3>2014</h3>
			<ul>
				<li>May 30, 2014<br />IXmaps receives funding through the Canadian Internet Registration Authority's (CIRA) <a href="https://cira.ca/news/cira-invests-28-ways-advance-canadas-internet" target="_blank">Community Investment Program</a> to further develop its on-line platform for visualizing the physical and organizational aspects of Canadian internet routing.</li>
				<li>April 01, 2014<br />Computer Dealer News covers IXmaps and the transparency report <a href="/transparency.php" target="_blank">Keeping Internet Users in the Know or in the Dark</a> in a <a href="http://www.computerdealernews.com/news/canadian-isps-need-to-be-more-transparent-u-of-t-report/32674" target="_blank">recent article</a>.</li>
				<li><p>February 11, 2014<br />IXmaps endorses <a href="https://thedaywefightback.org/" target="_blank">The Day We Fight Back: Mass Surveillance Must Stop</a>.</li>
			</ul>

			<h3>2012</h3>
				<ul>
					<li>October 11, 2012<br />Lee Rickwood discusses IXmaps at the <a href="http://whatsyourtech.ca/2012/10/11/canadian-live-tech-demo-shows-your-data-on-the-internet/" target="_blank">Ontario Science Centre's 'Canadian Live Tech Demo'</a>.</li>
					<li>September 12, 2012<br />CIRA publishes <a href="https://cira.ca/sites/default/files/attachments/publications/toward-efficiencies-in-canadian-internet-traffic-exchange.pdf" target="_blank">Towards Efficiencies in Canadian Internet Traffic Exchange</a> which discusses what we term 'boomerang routing.'</li>
					<li>August 29, 2012<br />Mediacaster mentions <a href="https://web.archive.org/web/20130923222528/http://www.mediacastermagazine.com/news/lack-of-internet-capacity-threatens-canadian-data-transmissions/1001653656/" target="_blank">IXmaps and its members (archived)</a> while covering CIRA's concerns with Canadian IXPs and boomerang traffic.</li>
					<li>July 31, 2012<br />Lee Rickwood's <a href="https://web.archive.org/web/20120810002047/http://www.calgaryherald.com/technology/Mapping+privacy+concerns+Your+data+crosses+borders+without+your+knowledge/7018373/story.html" target="_blank">Calgary Herald article (archived)</a> focuses on IXmaps and boomerang routing.</li>
					<li>July 10, 2012<br />Florence de Borja's thoughtful discussion of <a href="http://www.cloudtweaks.com/2012/07/how-are-canadians-affected-by-the-usa-patriot-act-and-cloud-computing/" target="_blank">How Are Canadians Affected By The USA Patriot Act And Cloud Computing?</a> emphasizes many issues that the IXmaps project has hoped to expose.</li>
					<li>June 2012 - The IXmaps team is greatly saddened by the unexpected passing of our dear friend and colleague, Erik "Possum" Stewart. Erik was a talented and fiercely intelligent member of our team, who possessed a considerable breadth of knowledge and experience. He will be greatly missed.</li>
					<li>April 26, 2012<br />Democracy Now!'s <a href="http://www.democracynow.org/2012/4/26/targeted_hacker_jacob_appelbaum_on_cispa" target="_blank">interview with Jacob Appelbaum</a> references IXmaps.</li>
				</ul>

			<h2>Research Papers</h2>
			<p>Clement, A. "NSA Surveillance: Exploring the Geographies of Internet Interception", Proceedings of the iConference 2014, Berlin, Mar 4-7, 2014:
			<a href="https://dl.dropboxusercontent.com/u/8140293/Publications/Clement%2C%20A.%20%282014%29%20NSA%20Surveillance-%20Exploring%20the%20geographies%20of%20internet%20interception%20iConf2014%20Jan2.pdf">
			available here</a></p>
			<p>Obar, J.A. & Clement, A. "Internet surveillance and boomerang routing: A call for Canadian network sovereignty".
			Proceedings of the Technology and Emerging Media Division, Canadian Communication Association Conference, 2013, available at:
			<a href="http://papers.ssrn.com/sol3/papers.cfm?abstract_id=2311792"> available here</a>
			*Included on the Harvard Nieman Lab's 'What's new in digital scholarship' list:
			<a href="http://www.niemanlab.org/2013/08/whats-new-in-digital-scholarship-reporters-ignoring-technology-the-continuing-power-of-print-and-booze-on-facebook/"> available here</a></p>

			<p>Obar, J.A. "Phantom data sovereigns: Walter Lippmann, big data and the fallacy of personal data sovereignty", under review.</p>

			<p>Clement, A. “IXmaps – Tracking your personal data through the NSA’s warrantless wiretapping sites” IEEE - ISTAS conference, Toronto,
			June 26-27, 2013: <a href="https://www.dropbox.com/s/9y4xtavova2qtj4/ISTAS13%20paper%2026%20IXmaps%20%E2%80%93%20Tracking%20May%2022.pdf">available here</a></p>

			<p>Paterson, N. “Veillances: protocols & network surveillance”, IEEE - ISTAS conference, Toronto, June 26-27, 2013:
			<a href="https://www.dropbox.com/s/elejw106elrckse/Nancy%20final-for-conf-MSW_A4_format-14.doc"> available here</a></p>

			<h2>Presentations</h2>
			<p>Clement, A. "Privacy, NSA surveillance and Canadian internet 'boomerang' traffic: Policy implications for Canadian businesses and public institutions",
			presented at International Privacy Day, Toronto, January 28, 2014. A video of the presentation is available
			<a href="http://www.realprivacy.ca/index.php/ambassador/andrew-clement/">here</a>
			and slides are available <a href="https://dl.dropboxusercontent.com/u/8140293/Public%20talks/2014%20IPD%20Privacy%2C%20NSA%20surveillance%20%26%20%27boomerang%27%20traffic%20Jan28.pdf">here</a></p>

			<p>Obar, J.A., Shade, L.R. & Clement, A. "The strength of a broad-based coalition: How Canadian media reformists defeated Bill C-30".
			Presented at the Strategies for Media Reform: International Perspectives pre-conference, International Communication Association Conference, London, UK, 2013.</p>

			<p>Obar, J.A. & Clement, A. "The IXmaps project: Confronting the mounting threats to Canadian network sovereignty". Presented at the Canadian Communication Association
			Conference, Victoria, BC, 2013.</p>

			<p>Obar, J.A. “Big data and the fallacy of personal data sovereignty”, the Canadian Civil Liberties Association’s RightsWatch Conference, Ryerson University, 2013.</p>

			<p>Obar, J.A. “Strategies for media reform: A call to action”, the Strategies for Media Reform: International Perspectives pre-conference, International Communication Association Conference, London, UK, 2013.</p>

			<p>Obar, J.A. “Big data and the fallacy of personal data sovereignty”, the Technology and Intellectual Property Group Annual Conference, University of Toronto Law School, 2013.</p>

			<p>IXmaps is in the Hot Zone at the
			<a href="http://ontariosciencecentre.ca/Calendar/108/" target="_blank">
			Ontario Science Centre</a>.<br />
			<b>Event date:</b> Oct 13, 2012</p>

			<p>IXmaps research was presented in the Surveillant Geographies session at
			<a href="http://www.rgs.org/WhatsOn/ConferencesAndSeminars/Annual+International+Conference/Programme/" target="_blank">
			the Royal Geographical Society's annual conference in Edinburgh </a><br />
			<b>Event dates:</b> July 3 - July 5, 2012</p>

			<p>IXmaps hosted an Alternative Event Session at the
			<a href="http://www.ischools.org/iConference12/2012index/" target="_blank">
			2012 iConference, hosted by the Faculty of Information at the University of Toronto</a>. A copy of the presentation can be
			<a href="documents/iConference2012_Presentation_Feb9.pdf" target="_blank">found here</a><br />
			</p>

			<p>A copy of a presentation given at the Centre for Innovation Law and Policy's
			<em>Cloud Computing Conference: Law and Policy Issues in the Cloud</em>, from October, 2011, can be
			<a href="documents/ixmaps_presentation_cloudlaw_Oct14.pdf" target="_blank">found here</a>.</p>

			<p>IXmaps was presented at <a href="http://www.digitallymediatedsurveillance.ca/?page_id=212" target="_blank">
			Cyber Surveillance in Everyday Life: An International Workshop</a>, held May 12 - 15, 2011,
			at the University of Toronto</p>

			<p>To view a presentation on the IXmaps project (in .pdf format) at the <em>Global Surveillance Society</em>
			conference, City University, London, UK, April, 2010, please
			<a href="documents/ixmaps_presentation_april14.pdf" target="_blank">click here</a>.</p>
			<p>For a revised version of the paper presented at that conference, titled <em>IXmaps:
			Interactively mapping NSA surveillance points in the internet &ldquo;cloud&rdquo;, </em>
			please <a href="documents/interactively_mapping_paper.pdf" target="_blank">  click here</a></p>

			<p>IXmaps debuted at <a href="http://www.munkschool.utoronto.ca/news/view/25" target="_blank">
			Securing the Cyber Commons: A Global Dialogue</a>, a cyber security forum held on Monday,
			March 28, 2011, at the Munk School of Global Affairs, University of Toronto.</p>

			<p>To download an IXmaps poster, <a href="http://ixmaps.ischool.utoronto.ca/documents/ixmaps_nsa_poster.pdf">click here</a></p>

			<h2>Supporting Links</h2>
			<p>Projects that are similar in scope to IXmaps include the <a href="http://www.netdimes.org/new/" target="_blank">DIMES project</a> from Tel Aviv University, the
			<a href="http://www.caida.org/tools/visualization/gtrace/" target="_blank">CAIDA Gtrace</a> project, the <a href="http://sourceforge.net/projects/geotrace/" target="_blank">
			Geographical Traceroute</a> project and the <a href="http://www.cs.washington.edu/research/networking/rocketfuel/" target="_blank">University of Washington toolset </a> (Rocketfuel, IPlace, Hubble, etc.)

			<p><STRONG>General Resources </STRONG></p>
			<p><SPAN LANG="en-CA">List  of telecom switches based on location (address/zip/LL) or CLLI. Many  of these switches are data centers or IXPs - <A HREF="http://www.telcodata.us/">http://www.telcodata.us/</A></SPAN><BR>
			</p>
			<p><SPAN LANG="en-CA">A  great reverse lookup site - <A HREF="http://fixedorbit.com/search.htm">http://fixedorbit.com/search.htm</A></SPAN></p>
			<p><SPAN LANG="en-CA">Huge  list of hostname codes. Useful for parsing hostnames. Slightly out of  date - <A HREF="http://www.sarangworld.com/TRACEROUTE/showdb.php">http://www.sarangworld.com/TRACEROUTE/showdb.php</A></SPAN></p>
			<p><SPAN LANG="en-CA">Another  list of hostname codes. If it's not in Sarangworld, try here - <A HREF="http://ecee.colorado.edu/%7Emathys/ecen1200/hwcl05/router_acronyms.html">http://ecee.colorado.edu/~mathys/ecen1200/hwcl05/router_acronyms.html</A></SPAN></p>
			<p><SPAN LANG="en-CA">A  community generated list of IXPs with exact addresses. Very useful  for IXPs, occasionally datacentres - <A HREF="https://www.peeringdb.com/">https://www.peeringdb.com/</A></SPAN></p>
			<p><SPAN LANG="en-CA">A  non-profit listing of IXPs, with supporting stats like traffic  volume. Also other useful sections, with papers, utilities, etc. - <A HREF="https://prefix.pch.net/applications/ixpdir/">https://prefix.pch.net/applications/ixpdir/</A></SPAN></p>
			<p><SPAN LANG="en-CA">Another  list of IXPs and data centers, and properties. This one is for  profit, less exact locational information, larger total number of  listings - <A HREF="http://www.datacentermap.com/">http://www.datacentermap.com/</A></SPAN><BR>
			</p>
			<p><SPAN LANG="en-CA">A  list of all of our competitors - <A HREF="http://www.caida.org/tools/utilities/netgeo/">http://www.caida.org/tools/utilities/netgeo/</A></SPAN></p>
			<p><SPAN LANG="en-CA">Huge  list of looking glass sites. Useful for determining what cities an  ISP has a POP in - <A HREF="http://www.bgp4.as/looking-glasses">http://www.bgp4.as/looking-glasses</A></SPAN></p>
			<p><SPAN LANG="en-CA">Internet/networks/ISPs  forum - <A HREF="http://www.dslreports.com/">http://www.dslreports.com</A></SPAN></p>
			<p><SPAN LANG="en-CA">Large  list of useful links related to ISPs, IXPs, internet architecture,  etc. - <A HREF="http://navigators.com/isp.html">http://navigators.com/isp.html</A></SPAN></p>
			<p LANG="en-CA"><SPAN LANG="en-CA">AT&amp;T's  network monitoring site. Gives current and averaged info on latency,  loss, jitter, etc for routes between major listed hubs - <A HREF="http://ipnetwork.bgtmo.ip.att.net/pws/network_delay.html">http://ipnetwork.bgtmo.ip.att.net/pws/network_delay.html</A></SPAN></p>
			<p LANG="en-CA"><SPAN LANG="en-CA">Needs  Java. Has free trail - <A HREF="http://www.visualroute.com/detail.html">http://www.visualroute.com/detail.html</A></SPAN></p>
			<p LANG="en-CA"><SPAN LANG="en-CA">Pretty  ancient, but a solid resource on how hostnames and IP can lead to  geographic location. Used as a last resort of Sarangworld and other  failed. Note: some stuff is out of date - <A HREF="http://www.private.org.il/IP2geo.html">http://www.private.org.il/IP2geo.htm</A></SPAN></p>
			<p><STRONG><SPAN LANG="en-CA">Graphics</SPAN></STRONG></p>
			<p><SPAN LANG="en-CA">Visualizations  of various network types - <A HREF="http://internetgeography.blogspot.com/">http://internetgeography.blogspot.com/</A></SPAN></p>
			<p><SPAN LANG="en-CA">Central  offices - <A HREF="http://www.co-buildings.com/">http://www.co-buildings.com/</A></SPAN></p>
			<p><SPAN LANG="en-CA">Switches,  but generally only the old school kind (phone, etc) - <A HREF="http://www.montagar.com/%7Epatj/phone-switches.htm">http://www.montagar.com/~patj/phone-switches.htm</A></SPAN></p>
			<p><STRONG>Source articles</STRONG></p>
			<p><SPAN LANG="en-CA">Article on  peering, US ISP mergers - <A HREF="http://www.renesys.com/blog/2005/12/peering_the_fundamental_archit.shtml">http://www.renesys.com/blog/2005/12/peering_the_fundamental_archit.shtml</A></SPAN></p>
			<p>Has some handy primers about  internet architecture - <A HREF="http://www.isoc.org/">http://www.isoc.org/</A></p>
			<p>Original memo about Autonomous  Systems - <A HREF="http://tools.ietf.org/html/rfc1930">http://tools.ietf.org/html/rfc1930</A></p>
			<p><STRONG>IP, ASN, WhoIs, Lookups,  etc.</STRONG></p>
			<p>IP lookup, also gives ownership,  long/lat, IP ranges, contact info, etc. - <A HREF="http://www.whatismyipaddress.com/">http://www.whatismyipaddress.com</A></p>
			<p>Firefox extension that displays  AS# for current URL - <A HREF="http://www.asnumber.networx.ch/">http://www.asnumber.networx.ch/</A></p>
			<p>IP lookup, public registry of  routing information for networks - <A HREF="http://www.radb.net/about.html">http://www.radb.net/about.html</A></p>
			<p>AS# lookup, link to ownership and  address - <A HREF="http://enc.com.au/itools/aut-num.php">http://enc.com.au/itools/aut-num.php</A></p>
			<p>IANA registry of AS numbers - <A HREF="http://www.iana.org/assignments/as-numbers/as-numbers.xml">http://www.iana.org/assignments/as-numbers/as-numbers.xml</A></p>
			<p>ARIN whois  lookup for AS numbers - <A HREF="https://ws.arin.net/whois/">https://ws.arin.net/whois/</A></p>
			<p>Good for  finding peers - <A HREF="http://www.fixedorbit.com/">http://www.fixedorbit.com/</A></p>
			<p><STRONG>Carrier hotels</STRONG></p>
			<p>Aggregation of recent news on  DCs... good search feature -  - <A HREF="http://www.datacenterknowledge.com/">http://www.datacenterknowledge.com</A></p>
			<p>Listing of carrier hotels for rent  - <A HREF="http://www.carrierhotels.com/colo_home.php">http://www.carrierhotels.com/colo_home.php</A></p>
			<p>Internet exchange directory - <A HREF="https://prefix.pch.net/applications/ixpdir/">https://prefix.pch.net/applications/ixpdir/</A></p>
			<p>Another IXP directory - <A HREF="http://www.bgp4.as/internet-exchanges">http://www.bgp4.as/internet-exchanges</A></p>
			<p>Ditto - <A HREF="http://en.wikipedia.org/wiki/List_of_Internet_exchange_points">http://en.wikipedia.org/wiki/List_of_Internet_exchange_points</A></p>
			<p>Ditto - <A HREF="http://www.datacentermap.com/ixps.html">http://www.datacentermap.com/ixps.html</A></p>
			<p>Blurb about Peer 1 data centre in  Toronto - <A HREF="http://www.peer1.com/hosting/toronto_data_center.php">http://www.peer1.com/hosting/toronto_data_center.php</A></p>
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