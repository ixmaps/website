<?php
include("includes/check-redirect.php");
?>
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

  <!-- STYLESHEETS -->
  <link rel="stylesheet" href="/css/ix.css" type="text/css" />
  <link rel="stylesheet" href="/css/lightbox.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="/css/overwrites.css" type="text/css" />

  <!-- include analytics -->
  <?php include("includes/analytics.php"); ?>
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
        <h2>Contribute</h2>
        <h3>Contributing to the IXmaps database</h3>
        <p>IXmaps relies on voluntary contributions of anonymized <a href="/faq.php#Traceroute">traceroute</a> data. We invite you to join over 600 other contributors who have helped to grow the database to
        <!-- Retrieve number of database routes  -->
        <?php include('application/config.php');
          $result = pg_query($dbconn, "SELECT COUNT (DISTINCT traceroute.id) FROM public.traceroute");
          if (!$result) {
            echo "more than 150000\n";
            exit;
          }
          while ($row = pg_fetch_row($result)) {
            echo "$row[0]";
          }
        ?>
        traceroutes. The more distinct the originating points, in terms of both city and ISP, and the more varied the destination targets, the better able we are to display interesting internet routings.</p>

        <p>Contributing data involves installing traceroute generating software built by the IXmaps development team. It initiates traceroute requests from your location either in batches of pre-selected <a href="https://www.ixmaps.ca/trsets/" target="_blank">target sites</a>, or to individual <a href="/faq.php#Hostname">hostnames</a> (like URLs) of your choosing. You can view the traceroutes you and others have contributed via the <a href="/explore.php">Explore page.</a></p>

        <p>To ensure the anonymity of contributors, we do not store the IP address of your personal device, but only a truncated version, with the last quad zeroed out. eg. 123.456.781.0.

        <p>For more details on the IXmapsClient software, check out <a href="https://github.com/ixmaps" target="_blank">our GitHub repo</a>.</p>

        <br />

        <h3>Installing and running the software</h3>

        <p>IXmapsClient works on <strong>Mac OS X</strong>, <strong>Linux</strong>, and <strong>Windows</strong>. As of December 7, 2015 IXmaps has moved to using <strong>IXmapsClient</strong> instead of <strong>TRgen</strong> to collect routing information. The Mac OS X, Windows, and Linux versions of <strong>TRgen</strong> are deprecated. We currently do not offer IXmapsClient for Android, iOS, or Windows Phone.</p>

        <h4>Windows</h4>
        <ul class="nobullet">
          <li>1. <a href="https://www.ixmaps.ca/IXmapsClient/IXmapsClient.1.0.6.win64.exe">Download the <strong>IXmapsClient</strong> installer IXmapsClient.1.0.6.win64.exe</a></li>
          <li>2. Double click on <strong>IXmapsClient.1.0.6.win64.exe</strong> and install the application in the directory <strong>C:\IXmapsClient</strong></li>
          <li>3. Copy the <strong>IXmapsClient-Shortcut</strong> to your Desktop</li>
          <li>4. In order to allow the <strong>IXmapsClient</strong> to run properly, you may need to authorize <strong>Windows Firewall</strong> to allow inbound connections. For a detailed guide on how to change these settings, see section on <strong>Changing Windows Firewall Settings</strong></li>
          <li>5. Double click on <strong>IXmapsClient-Shortcut</strong> to launch</li>
        </ul>
        <strong>IXmapsClient</strong> needs to be executed in a terminal with administrator's privileges. For this reason, when double clicking <strong>IXmapsClient-Shortcut</strong>, a new terminal window will be opened asking permission to run the application as an administrator; enter your admin password to proceed. The <strong>IXmapsClient</strong> interface should appear in your browser, or use your browser to go http://localhost:2040/.</p>

        <strong>Changing Windows Firewall Settings</strong>
        <p>In order to allow the <strong>IXmapsClient</strong> to collect traceroute data, Windows users may have to change the configuration of the <strong>Windows Firewall</strong>, which by default prevents the PC from receiving inbound connections. To change these default settings follow these steps:</p>
        <ul class="nobullet">
          <li>1. In <strong>Control Panel</strong>, open the <strong>Windows Firewall</strong> application and click on Advance Settings</li>
          <li>2. Click on <strong>Windows Firewall Properties</strong></li>
          <li>3. Click on the tab <strong>Private Profile</strong> and in the section <strong>Inbound Connections</strong>, select the option <strong>Allow</strong> from the dropdown menu</li>
          <li>4. Click on the tab <strong>Public Profile</strong> and in the section <strong>Inbound Connections</strong>, select the option <strong>Allow</strong> from the dropdown menu</li>
          <li>5. Finally, click the button <strong>Apply</strong> and close the <strong>Windows Firewall</strong></li>
          <!-- TODO: update this link -->
          <li>More detailed instructions are <a href="https://docs.microsoft.com/en-us/intune/deploy-use/help-protect-windows-pcs-using-windows-firewall-policies-in-microsoft-intune" target="_blank">available here</a></li>
          <li>Note: We advise that you reset your default firewall settings once you have completed traceroute collection.</li>
        </ul>

        <strong>Removing IXmapsClient</strong>
        <ul class="nobullet">
          <li>1. Delete the <strong>C:\IXmapsClient</strong> directory</li>
          <li>2. Delete the <strong>IXmapsClient-Shortcut</strong> from your <strong>Desktop</strong></li>
          <li>This will completely remove the <strong>IXmapsClient</strong> from your computer.</li>
        </ul>

        <br />

        <h4>Mac OSX</h4>
        <ul class="nobullet">
          <li>1. <a href="https://www.ixmaps.ca/IXmapsClient/IXmapsClient_v.1.0.6.macos.dmg">Download the <strong>IXmapsClient</strong> installer <strong>IXmapsClient_v.1.0.6.macos.dmg</strong></a></li>
          <li>2. Double click on the <strong>IXmapsClient.1.0.6.macos.dmg</strong> to open it</li>
          <li>3. Drag the <strong>IXmapsClient.app</strong> application to your <strong>Applications</strong> folder</li>
          <li>4. Double click on <strong>IXmapsClient.app</strong> to launch</li>
        </ul>

        <p>Depending on your Security &amp; Privacy settings, OS X may disallow installation of the <strong>IXmapsClient</strong>. This is part of OS X called “Gatekeeper.” To adjust these settings please open <strong>Apple menu > System Preferences… > Security &amp; Privacy > General tab</strong> and under the header <strong>"Allow applications downloaded from"</strong> select <strong>Anywhere.</strong></p>
        <p><strong>IXmapsClient</strong> needs to be executed in a terminal with administrator's privileges. For this reason, when double clicking <strong>IXmapsClient.app</strong>, a new terminal window will be opened asking for the administrator's password; enter your admin password to proceed. The <strong>IXmapsClient</strong> interface should then be shown in a new browser window, or use your browser to go http://localhost:2040/.</p>

        <strong>Removing IXmapsClient</strong>
        <p>Move the <strong>IXmapsClient.app</strong> application from your <strong>Applications</strong> folder to the Trash. This will completely remove the IXmaps Client from your computer</p>

        <br />

        <h4>Linux</h4>
        <ul class="nobullet">
          <li>1. <a href="https://www.ixmaps.ca/IXmapsClient/IXmapsClient.1.0.6.linux.tar.gz">Download the <strong>IXmapsClient</strong> installer <strong>IXmapsClient.1.0.6.linux.tar.gz</strong></a></li>
          <li>2. Extract the contents of the file <strong>IXmapsClient.1.0.6.linux.tar.gz</strong>, e.g. by running the following command in a terminal window: tar xzvf IXmapsClient.1.0.6.linux.tar.gz</li>
          <li>3. Drag the <strong>IXmapsClient.app</strong> application to your <strong>Applications</strong> folder</li>
          <li>4. Double click on <strong>IXmapsClient.app</strong> to launch</li>
        </ul>
        <p><strong>IXmapsClient</strong> needs to be executed in a terminal with administrator's privileges. For this reason, when double clicking <strong>IXmapsClient.app</strong>, a new terminal window will be opened asking for the administrator's password; enter your admin password to proceed. The <strong>IXmapsClient</strong> interface should then be shown in a new browser window, or use your browser to go http://localhost:2040/.</p>

        <strong>Removing IXmapsClient</strong>
        <p>Delete the <strong>IXmapsClient</strong> folder. In a Linux terminal window, navigate to the directory where <strong>IXmapsClient</strong> resides, then you run the following command:
        rm -r IXmapsClient
        This will completely remove the <strong>IXmapsClient</strong> from your computer.</p>

        <br />

        <h3>Other welcome contributions</h3>
        <h4>Correcting the location of routers</h4>
        <p>Accurately assessing the geographic location of individual routers within a traceroute is challenging. When examining traceroutes displayed on the <a href="/explore.php">Explore page</a>, you may find that some routers appear out of place, sometimes even wildly. We invite you to use the Flag option to point these out and suggest more accurate locations for the IP addresses of such routers so that we can correct it later. This can be done by clicking on the routers (dots) or hops (lines), and then the appropriate Flag button. Any information you provide about why you think the router location is inaccurate, and where it is more likely to be, is helpful in making corrections. See our FAQ page for more on <a href="/faq.php#Geolocation">geolocation</a>.</p>

        <h4>Improving our software</h4>
        <p>While we do our best to ensure that our software operates reliably and safely, and is easy to use, this is not a polished, high-end application, but rather the latest product of a on-going, unevenly funded research project. If you encounter difficulties or see obvious areas for improvement, please be patient and let us know what needs to be improved. Or better, if you have the skills, make the improvements yourself! The code used for gathering traceroutes, as well as the code for the website and various related components, is free and open source, and available <a href="https://github.com/ixmaps" target="_blank">from our GitHub repositories</a>.</p>

        <p>We welcome all feedback (critical and appreciative), technical inquiries or offers for assistance regarding IXmaps software, database, or website. Please <a href="mailto:ixmaps@utoronto.ca?subject=&#91;IXmaps%20Contribute]">email the IXmaps team.</a></p>

      </article>
    </section><!-- end of #content -->
  </section><!-- end of #container -->

</section><!-- end of #main content -->

<footer>
  <?php include("includes/footer.php"); ?>
</footer>
</div><!-- #wrapper -->
</body>
</html>