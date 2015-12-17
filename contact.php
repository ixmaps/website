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
      <h2>Contact</h2>
      <p>We encourage all feedback from visitors as to what they find interesting, confusing, boring or inaccessible, and welcome helpful suggestions for further refinement.</p>
      <p>For inquiries, comments or suggestions regarding the IXmaps project, please contact:</p>
      <ul id="contact-list">
        <li><a href="mailto:ixmaps@utoronto.ca?subject=&#91;IXmaps%20Comments&93;">IXmaps Comments</a></li>
        <li><a href="mailto:ixmaps@utoronto.ca?subject=&#91;IXmaps%20Media&93;">Media Inquiries</a></li>
        <li><a href="mailto:ixmaps@utoronto.ca?subject=&#91;IXmaps%20Inquiries&#93;">Research and Researcher Inquiries</a></li>
        <li><a href="mailto:ixmaps@utoronto.ca?subject=&#91;IXmaps%20Technical&#93;">Technical Inquiries</a></li>
      </ul>
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