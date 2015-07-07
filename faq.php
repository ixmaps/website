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
  <img src="images/headerimage.jpg" alt="IXmaps Logo" width="1000" height="138">
</header><!-- end of header -->

<?php include("includes/navigation.php"); ?>

<section id="main"><!-- #main content and sidebar area -->

<section id="container"><!-- #container -->
	<section id="content"><!-- #content -->
		<article>
			<h2>Frequently Asked Questions and Glossary</h2>
        <h3>Frequently Asked Questions</h3>
          <ul class="nobullet">
            <li><a href="#faq-sovereignty">What is network sovereignty?</a></li>
            <li><a href="#faq-listeningpost">What are NSA listening posts?</a></li>
            <li><a href="#faq-sources">Who are our some of our principal sources of research related to the NSA?</a></li>
            <li><a href="#faq-telecomresources">What kinds of resources did we use on telecommunications infrastructures?</a></li>
            <li><a href="#faq-geolocate">How do we geolocate routers?</a></li>
          </ul>
        <dl id="faq-list">
          <dt id="faq-sovereignty">What is network sovereignty?</dt>
          <dd>When a Canadian internet user communicates sensitive data with a secure Canadian server, it often passes through exchanges points in the United States and is thus subject to Patriot Act incursions by U.S. authorities. Why is it important?
          <br />See <a href="sovereignty.php">our Showcase Routes section on network sovereignty</a> for more details.</dd>

          <dt id="faq-listeningpost">What are NSA listening posts?</dt>
          <dd>The U.S. National Security Agency (NSA), is strongly suspected of having installed &lsquo;splitter rooms&rsquo; in 15-20 major internet exchange points.
          <br /><a href="https://spreadsheets.google.com/spreadsheet/ccc?key=0Aiub6gMLPmfYdGp3VzBRWU1kSnNhbWNqaHRFVlNCcWc&hl=en_US&authkey=CMeo8ZkG" target="_blank">View a summary</a> of the evidence supporting our claims regarding NSA splitter locations.</dd>

          <dt id="faq-sources">Who are our some of our principal sources of research related to the NSA?</dt>
          <dd>Both <a href="https://en.wikipedia.org/wiki/Mark_Klein" target="_blank">Mark Klein</a> and <a href="https://en.wikipedia.org/wiki/James_Bamford" target="_blank">James Bamford</a> have been instrumental in spotlighting the activities of the NSA. The <a href="https://www.eff.org/" target="_blank">Electronic Frontier Foundation</a> has been at the forefront of promoting transparency. This information has also been reviewed in an article from <a href="https://www.salon.com/news/feature/2006/06/21/att_nsa/print.html" target="_blank">Salon</a> and discussed in a <a href="https://www.pbs.org/wgbh/pages/frontline/homefront/interviews/klein.html" target="_blank">PBS documentary</a></dd>

          <dt id="faq-telecomresources">What kinds of resources did we use on telecommunications infrastructures?</dt>
          <dd>Although harder to find these days, we have located several AT&amp;T fibre 'backbone maps'. These range in date from 2000 to 2008, covering the relevant time span in regards to the NSA.
            See <a href="http://www.corp.att.com/globalnetworking/media/network_map.swf" target="_blank">1</a>, <a href="http://www.planetdds.com/downloads/ATT_IDC_Irvine.pdf" target="_blank">2</a>, <a href="http://personalpages.manchester.ac.uk/staff/m.dodge/cybergeography/atlas/att_backbone_large.gif" target="_blank">3</a>.
            We also looked at several sources regarding the largest cable hubs in North America, such as <a href="http://www.sciencedaily.com/releases/2002/11/021126072153.htm" target="_blank">this</a> article. Finally, we looked at several sites that measure performance/latency, managed by <a href="http://www.akamai.com/html/technology/dataviz1.html" target="_blank">Akamai</a> and <a href="http://ipnetwork.bgtmo.ip.att.net/pws/current_network_performance.shtml" target="_blank">AT&amp;T.</a> We also mapped <a href="//ixmaps.ca/cgi-bin/ge-render.cgi?show_landing_sites=true">undersea cable sites</a>.</dd>

          <dt id="faq-geolocate">How do we geolocate routers?</dt>
          <dd>In order to map the generated traceroutes on Google Earth, we must ascertain the physical location of the routers that generate the IP addresses in the route. When a traceroute is run, our software assigns locations to the IP addresses using a commercial service called <a href="http://www.maxmind.com" target="_blank">Maxmind</a>. This is often sufficient to geolocate the router to within about 5km of the target. However, Maxmind tends to work best when locating edge routers; its success rate when attempting to geolocate core routers drops to nearly zero. Therefore, we have adopted a layered strategy to manually assign physical locations to core routers. This methodology is explained in some technical detail <a href="technical.php">here</a>.
        </dl>
	     <br />
       <h3>Glossary</h3><br>
          <ul class="nobullet">
            <li><a href="#Traceroute">Traceroute</a></li>
            <li><a href="#Carrier">Carrier</a></li>
            <li><a href="#CarrierHotel">Carrier Hotel</a></li>
            <li><a href="#Colocation">Colocation</a></li>
            <li><a href="#Datacentre">Datacentre</a></li>
            <li><a href="#InternetExchangePoint">Internet Exchange Point</a></li>
            <li><a href="#InternetBackbone">Internet Backbone</a></li>
            <li><a href="#IP+Address">IP Address</a></li>
            <li><a href="#ASNumber">ASN</a></li>
            <li><a href="#Hostname">Hostname</a></li>
            <li><a href="#Packet">Packet</a></li>
            <li><a href="#Hop">Hop</a></li>
            <li><a href="#Latency">Latency</a></li>
            <li><a href="#Min.+Latency">Minimum Latency</a></li>
            <li><a href="#CLLICode">CLLI Code</a></li>
            <li><a href="#Spy Room (6th Floor)">Spy Room (6th Floor)</a></li>
            <li><a href="#Splitter Cabinet (7th Floor)">Splitter Cabinet (7th Floor)</a></li>
          </ul>
          <dl id="glossary">
            <dt id="Traceroute">Traceroute</dt>
            <dd>A traceroute measures the route path and transit times of packets across an Internet Protocol (IP) network. For more information see
            <a href="https://en.wikipedia.org/wiki/Traceroute">traceroute</a></dd>

            <dt id="Carrier">Carrier</dt>
            <dd>A common carrier is a company that offers its services to the general public under license or authority provided by a regulatory body. In the context of the telecommunications industry in the United States, telecommunications providers are regulated by the Federal Communications Commission. While internet service providers have successfully argued against being classified as common carriers, they are treated like common carriers in many respects. For more information see <a href="https://en.wikipedia.org/wiki/Common_carrier">common carrier</a></dd>

            <dt id="CarrierHotel">Carrier Hotel</dt>
            <dd>A carrier hotel, also known as a colocation centre, is a datacentre that provides colocation services, enabling multiple customers to locate networking equipment under the same roof. For more information see <a href="https://en.wikipedia.org/wiki/Colocation_centre">colocation centre</a></dd>

            <dt id="Colocation">Colocation</dt>
            <dd>Allows multiple customers to locate network, server, and storage gear, while connecting connect them to a variety of telecommunications and network service providers. For more information see <a href="https://en.wikipedia.org/wiki/Colocation">colocation</a></dd>

            <dt id="Datacentre">Datacentre</dt>
            <dd>A facility used to house computer systems and associated components, such as telecommunications and storage systems. Datacentres are classified according to a tier structure, with Tier 1 signifying the simplest configuration (basically a server room) and Tier 4 signifying the most complex operations (designed to host mission critical computer systems). For more information see <a href="https://en.wikipedia.org/wiki/Data_center">data center</a></dd>

            <dt id="InternetExchangePoint">Internet Exchange Point</dt>
            <dd>A physical infrastructure through which service providers exchange internet traffic between their networks, designed to enable service providers to reduce their traffice which must be delivered by upstream transit providers, reducing the average delivery cost of their services. For more information see <a href="https://en.wikipedia.org/wiki/Internet_exchange_point">internet exchange point</a></dd>

            <dt id="InternetBackbone">Internet Backbone</dt>
            <dd>Refers to the principal data routes between large, strategically interconnected networks and core routers in the internet. These data routes are hosted by commercial, government, academic and other high-capacity network centers, internet exchange points and network access points, that interchange internet traffic between the countries, continents and across the oceans of the world. For more information see <a href="https://en.wikipedia.org/wiki/Internet_backbone">internet backbone</a></dd>

            <dt id="IP+Address">IP Address</dt>
            <dd>An Internet Protocol address (IP address) is a numerical label assigned to each device participating in a computer network that uses the Internet Protocol for communication. IP addresses serve two key functions: host or network interface identification and location addressing. For more information see <a href="https://en.wikipedia.org/wiki/IP_address">IP address</a></dd>

            <dt id="ASNumber">ASN</dt>
            <dd>An Autonomous System Number (ASN) is the unique number of an Autonomous System (AS), which is a collection of connected Internet Protocol (IP) routing prefixes under the control of one or more network operators that presents a common, clearly defined routing policy to the internet. While there may be multiple Autonomous Systems supported by an ISP, the Internet only sees the routing policy of the ISP. That ISP must have an officially registered Autonomous System Number for use in BGP routing. ASNs are important because they uniquely identifies each network on the Internet. For more information see <a href="https://en.wikipedia.org/wiki/Autonomous_system_(Internet)">autonomous system</a></dd>

            <dt id="Hostname">Hostname</dt>
            <dd>A hostname is a label that is assigned to a device connected to a computer network and that is used to identify the device in various forms of electronic communication. Hostnames may be simple names consisting of a single word or phrase, or they may have appended the name of a Domain Name System (DNS) domain, separated from the host specific label by a full stop (dot). In the latter form, a hostname is also called a domain name. For more information see <a href="https://en.wikipedia.org/wiki/Hostname">hostname</a></dd>

            <dt id="Packet">Packet</dt>
            <dd>In computer networking, a packet is a formatted unit of data carried by a packet mode computer network. All communication on the internet involves packets. For example, every Web page that you receive comes as a series of packets, and every e-mail you send leaves as a series of packets. Networks that ship data around in small packets are called packet switched networks. For more information see <a href="https://en.wikipedia.org/wiki/Network_packet">network packet</a></dd>

            <dt id="Hop">Hop</dt>
            <dd>A hop represents one portion of the path between a source and its destination. As data is transmitted along a path, passing throughrouters and other devices, each device causes data to hop from one point-to-point connection to another. For more information see <a href="https://en.wikipedia.org/wiki/Hop_(telecommunications)">hop</a></dd>

            <dt id="Latency">Latency</dt>
            <dd>Refers to a range of delays incurred in the processing of networking data. A low latency connection features short delay times, while a high latency connection suffers from long delays. For more information see <a href="https://en.wikipedia.org/wiki/Latency_(engineering)">latency</a></dd>

            <dt id="Min.+Latency">Minimum Latency</dt>
            <dd>Tracerouting programs often send multiple packets to the same IP address in an attempt to correct for random error. Minimum latency refers to the amount of time that the fastest packet took to reach a node. For more information see <a href="https://en.wikipedia.org/wiki/Latency_(engineering)">latency</a></dd>

            <dt id="CLLICode">CLLI Code</dt>
            <dd>CLLI codes are assigned and used by the North American telecom industry to designate location and type of hardware used at a particular location. Thus, a CLLI code can occasionally be used to geolocate a router. For more information see <a href="https://en.wikipedia.org/wiki/CLLI_code">CLLI code</a></dd>

            <dt id="Spy Room (6th Floor)">Spy Room (6th Floor)</dt>
            <dd>Room 641A is an intercept facility operated by AT&amp;T for the U.S. National Security Agency, beginning in 2003. Room 641A is located in a building at 611 Folsom Street, San Francisco, three floors of which were occupied by AT&amp;T before SBC purchased AT&amp;T. The room was referred to in internal AT&amp;T documents as the SG3 [Study Group 3] Secure Room. It is fed by fiber optic lines from beam splitters installed in fiber optic trunks carrying internet backbone traffic and, therefore, presumably has access to all internet traffic that passes through the building. The existence of the room was revealed by former AT&amp;T technician, Mark Klein, and was the subject of a 2006 class action lawsuit by the Electronic Frontier Foundation against AT&amp;T. For more information see <a href="https://en.wikipedia.org/wiki/Room_641A">room 641A</a></dd>

            <dt id="Splitter Cabinet (7th Floor)">Splitter Cabinet (7th Floor)</dt>
            <dd>A fiber optic circuit can be split using splitting equipment to divide the light signal and to divert a portion of the signal into each of two fiber optic cables. While both signals will have a reduced signal strength, after the split both signals still contain the same information, effectively duplicating the communications that pass through the splitter. Starting in February 2003, the "splitter cabinet" split (and diverted to the SG3 Secure Room) the light signals that contained the communications in transit to and from AT&amp;T's Peering Links with the following Internet networks and Internet exchange points: ConXion, Verio, XO, Genuity, Qwest, PAIX, Allegiance, Abovenet. Global Crossing, C&amp;W, UUNET, Level 3, Sprint, Telia, PSINet, and MAE-WEST. MAE-WEST is an Internet nodal point and one of the largest "Internet exchange points" in the United States. PAIX, the Palo Alto Internet Exchange, is another significant Internet exchange point. Internet exchange points are facilities at which large numbers of major Internet service providers interconnect their equipment in order to facilitate the exchange of communications among their respective networks. Through the "splitter cabinet," the content of all the electronic voice and data communications going across the Peering Links [listed above] was transferred from the WorldNet Internet room's fiber optical circuits into the SG3 Secure Room. According to Mark Klein, such "splitter cabinets" were being installed in other cities, including Seattle, San Jose, Los Angeles, and San Diego. For more information see <a href="https://ensites.google.com/site/markklein2009/Home">Mark Klein's description</a></dd>
          </dl>
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