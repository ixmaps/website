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

  <!-- Piwik -->
  <script type="text/javascript">
    var _paq = _paq || [];
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    (function() {
    var u="//ixmaps.piwikpro.com//";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', 1]);
    var d=document, g=d.createElement('script'),
    s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true;
    g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
    })();
  </script>
  <noscript>
    <p><img src="//ixmaps.piwikpro.com/piwik.php?idsite=1" style="border:0;" alt="" /></p>
  </noscript>
  <!-- End Piwik Code -->

  <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
  <script type="text/javascript">
      $.noConflict();
      // jquery and prototype fight for the $
  </script>

  <!-- STYLESHEETS -->
  <link rel="stylesheet" href="css/ix.css" type="text/css" />
  <link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="css/overwrites.css" type="text/css" media="screen" />
</head>

<body onload="initialize()">
<div id="wrapper"><!-- #wrapper -->
<header><!-- header -->
  <img src="images/headerimage.jpg" width="1000" height="138">
  <!-- <img src="images/headerimg.jpg" width="932" height="200" alt=""> header image -->
</header><!-- end of header -->

<?php include("includes/navigation.php"); ?>

<section id="main"><!-- #main content and sidebar area -->

<section id="container"><!-- #container -->
  <section id="content"><!-- #content -->
    <article id="tour-container">
      <h2><i>Welcome to IXmaps! You may be interested in...</i></h2>
      <ul class="tour-index nobullet">
        <li><a href="#how-data-travels-across">#1 How Data Travels Across the Internet</a></li>
        <li><a href="#exploring-the-ixmaps-traceroute">#2 Exploring the IXmaps Traceroute Collection</a></li>
        <li><a href="#revealing-nsa-internet-surveillance">#3 Revealing NSA Internet Surveillance</a></li>
        <li><a href="#boomerang-routing">#4 Boomerang Routing</a></li>
        <li><a href="#canadian-network-sovereignty">#5 Canadian Network Sovereignty</a></li>
        <li><a href="#where-your-own-data">#6 Where Your Own Data Goes</a></li>
        <li><a href="#who-carries-your-data">#7 Who Carries Your Data</a></li>
        <li><a href="#privacy-transparency-of-internet">#8 Privacy Transparency of Internet Service Providers (ISPs) and Carriers</a></li>
        <li><a href="#public-internet-exchange-points">#9 Public Internet Exchange Points (IXPs)</a></li>
        <li><a href="#volunteer-contributors">#10 Volunteer Contributors</a></li>
      </ul>

      <div class="tour-container">
        <div id="how-data-travels-across" class="tour-img-container">
          <h5>#1 How Data Travels Across the Internet</h5>
          <img class="tour-img tour-img-portrait" src="images/TourPage_1_HowDataTravelsAcrossTheInternet.png"/>
        </div>
        <div class="tour-text-container">
          <p>As your data is carried across the internet between you and a website, or other target destination, routing devices direct it to the next <a href="/faq.php#Router">router</a> along the path in a series of "<a href="/faq.php#Hop">hops</a>." You can discover these routers and the hops between them using <a href="/faq.php#Traceroute">traceroute</a> software. IXmaps collects traceroute data generated by contributors from around the globe, locates the routers geographically and then maps the routes to show how data actually travels. If you go to the <a href="/explore.php">Explore page</a>, you will see the path followed by the most recent traceroute contribution. Hover your mouse over a dot to see more about that router, and click on the < and > arrows to hop your way along the path. Click on a line (i.e. hop) to see more details about that traceroute as a whole. You can use the various search features there to explore the over one hundred thousand routes that volunteers have contributed.</p>
        </div>
      </div>

      <div class="tour-container">
        <div id="exploring-the-ixmaps-traceroute" class="tour-img-container">
          <h5>#2 Exploring the IXmaps Traceroute Collection</h5>
          <img class="tour-img" src="images/TourPage_2_ExploringTheTracerouteCollection.png"/>
        </div>
        <div class="tour-text-container">
          <p>There are many ways to explore the IXmaps database. The easiest way is to use the Quick Search buttons in the lower right side of the <a href="/explore.php">Explore page</a>. For example, you can map all of the 50 most recent traceroutes by clicking the "Last 50 submitted" button, and then the "Map All" button near the top. Similarly, other buttons enable you to map traceroutes from your ISP, traceroutes from your city, 'boomerang' routes (see below), etc. To learn more about searching and mapping traceroutes, view the <a class="text-video-link" href="https://www.youtube.com/embed/_K_WIquGGbk?enablejsapi=1&autoplay=1" target="_blank">How to Search IXmaps video</a>.</p>
        </div>
      </div>

      <div class="tour-container">
        <div id="revealing-nsa-internet-surveillance" class="tour-img-container">
          <h5>#3 Revealing NSA Internet Surveillance</h5>
          <img class="tour-img" src="images/TourPage_3_RevealingNSAInternetSurveillance.png"/>
        </div>
        <div class="tour-text-container">
          <p><a class="explore-target-route" data-route-id="1859">This is traceroute #1859</a>. TR1859 shows the route taken by data travelling from a home computer in Toronto to the San Francisco Art Institute's website. Along this route, we see that the data passes through a known <a href="/faq.php#faq-mass-surveillance">NSA mass surveillance</a> operation at AT&T's internet switching facility in San Francisco. All traffic passing through this site is copied to NSA computers for inspection and storage. The NSA is strongly suspected of having installed similar spy rooms in 15-20 other cities across the United States, including Los Angeles, New York and Chicago. You can see the 18 U.S. cities we estimate as most likely to contain NSA splitter operations, shown as <img src="images/nsamedium.png" class="tour-icon-img"/>, by turning on the 'NSA layer' via the Layers popup <img src="images/icon-layers.png" class="tour-icon-img"/> of the <a href="/explore.php">Explore page</a>. For more on NSA interception activities, see our <a href="/nsa.php">NSA surveillance page</a>.</p>
        </div>
      </div>

      <div class="tour-container">
        <div id="boomerang-routing" class="tour-img-container">
          <h5>#4 Boomerang Routing</h5>
          <img class="tour-img" src="images/TourPage_4_BoomerangRouting.png"/>
        </div>
        <div class="tour-text-container">
          <p><a class="explore-target-route" data-route-id="3381">This is traceroute #3381</a>. TR3381 shows data packets travelling from a home computer in Toronto to a local news and entertainment website. Along this route, we see that data <a href="/faq.php#Packet">packets</a> that begin and end in their travels in Toronto pass through Chicago and New York, two cities most strongly suspected NSA surveillance. We call this type of internet traffic "<a href=/faq#BoomerandRouting>boomerang routing</a>" - traffic that is routed through the US even when both origin and destination are within Canada. The reasons for boomerang routing are complex - the result of many technical, economic and policy choices made principally by private corporations. Over 25% of the intra-Canadian routes in the IXmaps database follow a boomerang path. To view other boomerang routes, click on the "Boomerangs" button in the Quick Search area of the Explore page. To view other boomerang routes that start and end in Toronto, modify the search created by the "Boomerangs" Quick Search button, replacing Country|CA with City|Toronto in the search parameters.
        </div>
      </div>

      <div class="tour-container">
        <div id="canadian-network-sovereignty" class="tour-img-container">
          <h5>#5 Canadian Network Sovereignty</h5>
          <img class="tour-img" src="images/TourPage_5_CanadianNetworkSovereignty.png"/>
        </div>
        <div class="tour-text-container">
          <p>The prevalence of "<a href=/faq#BoomerandRouting>boomerang routes</a>" raises the issue of <a href="/sovereignty.php">Canadian network sovereignty</a>, since Canadians' data leaving the country loses its legal and constitutional protections. Further, when passing through routers in the US, data becomes  subject to US jurisdiction and is at risk of <a href="/faq.php#faq-mass-surveillance">NSA mass surveillance</a>. This is especially concerning in cases when Canadians are communicating with their governments’ websites. The image shown here is only a sample of the more than 1000 boomerang routes in the database involving Canadians communicating with the federal government (Search term: <b>Does|Contain|Destination Hostname|.gc.ca</b> - i.e. Government of Canada). This highlights the fact that Canada does not control key aspects of internet infrastructure vital for the economic, political, cultural and social security of the nation and unnecessarily deprives Canadians of protection under the Charter of Rights and Freedoms.</p>
        </div>
      </div>

      <div class="tour-container">
        <div id="where-your-own-data" class="tour-img-container">
          <h5>#6 Where Your Own Data Goes</h5>
          <img class="tour-img tour-img-portrait" src="images/TourPage_6_WhereYourOwnDataGoes.png"/>
        </div>
        <div class="tour-text-container">
          <p>Interested in where your own data travels across the internet and who has access to it along the way? You first need to generate traceroutes from your own location. Go to the <a href="/contribute.php">Contribute page</a>, then download, install and run the IXmaps Client application. You’ll need to provide a name (or pseudonym) so you can find your personal routes later. You can generate traceroutes in batches to a variety of pre-selected <a href="/trsets">target sites</a>, or to individual <a href="/faq.php#Hostname">hostnames</a> (like URLs) of your choosing (e.g. cbc.ca). The more routes you contribute, the richer your options and the more valuable you make the database for others.</p>
        </div>
      </div>

      <div class="tour-container">
        <div id="who-carries-your-data" class="tour-img-container">
          <h5>#7 Who Carries Your Data</h5>
          <img class="tour-img tour-img-portrait" src="images/TourPage_7_WhoCarriesYourData.png"/>
        </div>
        <div class="tour-text-container">
          <p>When connecting to a website, it is rare that your local internet service provider (ISP) will carry your data all the way to its destination.  Much more typical is that your ISP hands your data over to another network carrier, which in turn passes it on yet to another carrier before reaching its destination. It is not uncommon for half a dozen carriers to be involved behind the scenes. A handful of very large global networking companies, few of which are recognized household names, carry most of the world's long distance internet traffic. You can see who is carrying your data in the Carrier table on the right side of the <a href="/explore.php">Explore page</a>. The more prominent carriers (handling Canadians’ data) appear with distinctive colours, which correspond to the colours of the routers (dots) and hops (lines) in the map. You can click on carrier names with dashed underlining to find out more about them. </p>
        </div>
      </div>

      <div class="tour-container">
        <div id="privacy-transparency-of-internet" class="tour-img-container">
          <h5>#8 Privacy Transparency of Internet Service Providers (ISPs) and Carriers</h5>
          <img class="tour-img tour-img-portrait" src="images/TourPage_8_PrivacyTransparencyofISPs.png"/>
        </div>
        <div class="tour-text-container">
          <p>All the carriers that help connect you to your internet destinations are in possession of your data, at least briefly, and have a responsibility to protect your privacy. However we have recent evidence suggesting some may be even secretly provide government agencies access to your data. It is very hard for an average user to tell how well these carriers respect privacy. To help make ISP privacy policies more visible, the IXmaps project has produced a series of Privacy Transparency reports that assess what ISPs say about how they protect user privacy, rating them in 10 categories and awarding stars where deserved. You can find further details by clicking on carrier names with dashed underlining in the Carrier table or going to the <a href="/transparency.php">Transparency page</a> for the full Keeping Users in the Know or in the Dark reports.</p>
        </div>
      </div>

      <div class="tour-container">
        <div id="public-internet-exchange-points" class="tour-img-container">
          <h5>#9 Public Internet Exchange Points (IXPs)</h5>
          <img class="tour-img" src="images/TourPage_9_PublicInternetExchangePoints.png"/>
        </div>
        <div class="tour-text-container">
          <p>One of the principal ways of keeping internet routing closer to home and avoid boomerang routing, is for carriers to exchange traffic at local <a href="/faq.php#InternetExchangePoint">internet exchange points (IXPs)</a>. This helps avoid unnecessary loss of legal and constitutional protections, and can also improve bandwidth while reducing internet transit costs and delays (i.e. lower latency), bringing economic as well as privacy benefits.  With the assistance of the <a href="https://cira.ca/" target="blank">Canadian Internet Registration Authority (CIRA)</a>, Canada now has 7 not-for-profit IXPs spanning the country. Each are shown as an <img src="images/IX_ca.png" class="tour-icon-img"/> by turning on the <b>Public Internet Exchange Point (IXP) - Canada</b> layer, via the Layers popup <img src="images/icon-layers.png" class="tour-icon-img"/> of the Explore page.</p>
        </div>
      </div>

      <div class="tour-container">
        <div id="volunteer-contributors" class="tour-img-container">
          <h5>#10 Volunteer Contributors</h5>
          <img class="tour-img tour-img-portrait" src="images/TourPage_10_VolunteerContributors.png"/>
        </div>
        <div class="tour-text-container">
          <p>The IXmaps database relies on crowdsourcing for its collection of traceroutes. We appreciate the over 600 volunteer contributors who have generated traceroutes to 3951 different web destinations. Shown here are the top 10 contributors. We aim to develop a collection of traceroutes that represents well the diversity of internet users and their web destination interests (initially focussing on Canada). We invite you add to our collection by going to the <a href="/contribute.php">Contribute page</a> and downloading our traceroute generation software. </p>
        </div>
      </div>

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
