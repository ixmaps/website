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


  <!-- STYLESHEETS -->
  <link rel="stylesheet" href="/css/ix.css" type="text/css" />
  <link rel="stylesheet" href="/css/lightbox.css" type="text/css" media="screen" />
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
      <h2>About the IXmaps Project</h2>
        <p>The IXmaps research project was created to develop an interactive mapping tool that enables internet users and researchers to study the routes that data packets take across the internet, with surveillance and other 'interesting' features highlighted along the way. It also annually reports on the privacy transparency ratings of internet carriers that route Canadian traffic.
        Beginning in 2008, the project has received funding from
        <a href="http://www.sshrc-crsh.gc.ca/funding-financement/programs-programmes/itst/research_grants-subventions_recherche-eng.aspx" target="_blank">
        Social Sciences and Humanities Research Council of Canada (SSHRC)</a>, <a href="http://www.priv.gc.ca/index_e.asp" target="_blank">Office of the Privacy Commissioner of Canada (OPC)</a> and <a href="http://www.cira.ca/" target="_blank">Canadian Internet Registration Authority (CIRA)</a>.
        The views expressed herein are those of the author(s) and do not necessarily reflect those of the funders.
        </p>
      <h5>Current Project Team</h5>
      <ul>
        <li><a href="http://current.ischool.utoronto.ca/faculty/andrew-clement" target="_blank">Andrew Clement, PhD</a>, Professor, Faculty of Information, University of Toronto</li>
        <li><a href="http://www.linkedin.com/pub/colin-mccann/27/867/820" target="_blank">Colin McCann, MI</a>, Faculty of Information, University of Toronto</li>
        <li><a href="http://current.ischool.utoronto.ca/students/antonio-gamba-bari" target="_blank">Antonio Gamba, PhD Student</a>, Faculty of Information, University of Toronto</li>
        <li><a href="http://tc.msu.edu/users/jonathan-obar" target="_blank">Jonathan Obar, PhD</a>, Faculty of Social Science and Humanities, University of Ontario Institute of Technology</li>
        <li>David Mason, Software Developer</a>, Montreal</li>
        <li>Dawn Walker, MI Student</a>, Faculty of Information, University of Toronto</li>
      </ul>
      <h5>Former Members</h5>
      <ul>
        <li><a href="http://www.vacuumwoman.com/" target="_blank">Nancy Paterson, PhD</a>, Associate Professor, OCAD University</li>
        <li><a href="http://www.ischool.utoronto.ca/faculty/david-j-phillips" target="_blank">David J. Phillips, PhD</a>, Associate Professor, Faculty of Information, University of Toronto</li>
        <li>Erik Stewart, Programmer, Toronto</li>
        <li><a href="//ca.linkedin.com/pub/lauren-dimonte/27/15/169" target="_blank">Lauren Di Monte, MI, MA</a>, Faculty of Information, University of Toronto</li>
        <li>Alex Goel, MI</a>, Faculty of Information, University of Toronto</li>
        <li>Steve Harvey, Software Developer, Toronto</li>
        <li>Yannet Lathrop, MI, Faculty of Information, University of Toronto</li>
        <li><a href="http://www.ischool.utoronto.ca/students/gabby-resch" target="_blank">Gabby Resch, PhD Student</a>, Faculty of Information, University of Toronto</li>
        <li><a href="//www.linkedin.com/in/johnharrisstevenson" target="_blank">John Stevenson, PhD</a>, University of Toronto</li>
      </ul>

      <h2>Contact</h2>
      <p>We encourage all feedback from visitors as to what they find interesting, confusing, boring or inaccessible, and welcome helpful suggestions for further refinement. For inquiries, comments or suggestions regarding the IXmaps project, please contact:</p>
      <ul id="contact-list">
        <li><a href="mailto:ixmaps@utoronto.ca?subject=&#91;IXmaps%20Comments&#93;">IXmaps Comments</a></li>
        <li><a href="mailto:ixmaps@utoronto.ca?subject=&#91;IXmaps%20Media&#93;">Media Inquiries</a></li>
        <li><a href="mailto:ixmaps@utoronto.ca?subject=&#91;IXmaps%20Inquiries&#93;">Research and Researcher Inquiries</a></li>
        <li><a href="mailto:ixmaps@utoronto.ca?subject=&#91;IXmaps%20Technical&#93;">Technical Inquiries</a></li>
      </ul>

      <br />

      <p>IXmaps is affiliated with the
      <a href="http://www.sscqueens.org/projects/the-new-transparency/about" target="_blank">New Transparency Project</a> and the <a href="http://iprp.ischool.utoronto.ca/" target="_blank">Information Policy Research Program</a> at the
      <a href="http://www.ischool.utoronto.ca/" target="_blank">Faculty of Information</a>,
      <a href="http://www.utoronto.ca/" target="_blank">University of Toronto</a>.
      </p>
      <p style="text-align:center">
        <img src="images/logos.jpg" alt="Affiliated institutions logos: utoronto, IPRP, utoronto faculty of information, OCAD" width="434" height="116">
      </p>

    </article>
  </section>
  <!-- end of #content -->
</section><!-- end of #container -->

</section><!-- end of #main content and sidebar-->

<footer>
  <?php include("includes/footer.php"); ?>
</footer>
</div><!-- #wrapper -->
</body>
</html>
