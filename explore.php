<?php
$ixHost = $_SERVER["SERVER_NAME"];
if ($ixHost != 'www.ixmaps.ca' && $ixHost != 'dev.ixmaps.ca') {
  header('Location: https://www.ixmaps.ca/explore.php');
  exit;
}

// MaxMind Include Files needed to grab user's city
include('application/geoip/geoip.inc');
include('application/geoip/geoipcity.inc');
include('application/geoip/geoipregionvars.php');

// using MaxMind to find the city of client IP address
$myIp = $_SERVER['REMOTE_ADDR'];
//$myIp = '174.119.164.221';
$gi1 = geoip_open("application/geoip/dat/GeoLiteCityv6.dat",GEOIP_STANDARD);
$record1 = geoip_record_by_addr_v6($gi1,"::".$myIp);
$myCity = ''.$record1->city;
$myCountry = ''.$record1->country_code;
geoip_close($gi1);
?>
<!doctype html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>

  <title>See where your data packets go | IXmaps</title>


  <!-- Needed for skin of various UI components -->
  <link rel="stylesheet" href="jquery-ui-1.10.1/development-bundle/themes/base/jquery-ui.css" />
  <!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" /> -->

  <!-- jQuery  -->
  <script src="jquery-ui-1.10.1/js/jquery-1.9.1.js"></script>
  <script src="jquery-ui-1.10.1/js/jquery-ui-1.10.1.custom.js"></script>

  <!-- Tablesorter library -->
  <script src="js/jquery.metadata.js"></script>
  <script src="js/jquery.tablesorter.min.js"></script>
  <link rel="stylesheet" href="css/tables.sorter.css" />
  <link rel="stylesheet" href="css/themes/blue/style.css" />

  <!-- Toast library -->
  <script src="jquery-toast-plugin/jquery.toast.min.js"></script>
  <link rel="stylesheet" href="jquery-toast-plugin/jquery.toast.min.css" />

  <!-- Google Maps API  -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script> -->
  <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false&v=3&libraries=geometry"></script>

  <!-- jQuery Utils  -->
  <script type="text/javaScript" src="js/underscore-min.js"></script>

  <!-- IXmaps config files -->
  <script type="text/javascript" src="js/config.js"></script>
  <script type="text/javascript" src="js/ixmaps.js"></script>
  <script type="text/javascript" src="js/ixmaps.gm.js"></script>

  <script>
    var myIp = '<?php echo $myIp; ?>';
    var myCity = '<?php echo $myCity; ?>';
    var myCountry = '<?php echo $myCountry; ?>';

    jQuery(document).ready(function() {
      getChotel();
      getPrivacyReport();
      <?php
      if(isset($_GET['trid'])){
      ?>
      submitCustomQuery(<?php echo $_GET['trid']; ?>);
      <?php
      } else if($_GET && isset($_GET['data'])){
      ?>
      var postedData = '<?php echo $_GET['data'];?>';
      processpostedData(postedData);
      <?php
      }
      ?>
      jQuery('#news-btn').click(function() {
        window.open("/documents/Keeping_Internet_Users_Summ_review_App_final_Jan_27.pdf","_newtab");
      });
    });
  </script>

  <script type="text/javascript">
    var script = '<script type="text/javascript" src="///google-maps-' +
        'utility-library-v3.googlecode.com/svn/trunk/infobubble/src/infobubble';
    if (document.location.search.indexOf('compiled') !== -1) {
      script += '-compiled';
    }
    script += '.js"><' + '/script>';
    document.write(script);
  </script>

  <!-- ISSUES WITH SSL, DISABLING FOR NOW -->
  <script type="text/javascript">
    // var _gaq = _gaq || [];
    // _gaq.push(['_setAccount', 'UA-24555700-1']);
    // _gaq.push(['_setDomainName', 'none']);
    // _gaq.push(['_setAllowLinker', true]);
    // _gaq.push(['_trackPageview']);

    // (function() {
    //   var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    //   ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    //   var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    // })();
  </script>

  <script language="JavaScript" type="text/javascript">
    //--------------- LOCALIZEABLE GLOBALS ---------------
    var d = new Date();
    var monthname = new Array("January","February","March","April","May","June","July","August","September","October","November","December");
    //Ensure correct for language. English is "January 1, 2004"
    var TODAY = monthname[d.getMonth()] + " " + d.getDate() + ", " + d.getFullYear();
    //--------------- END LOCALIZEABLE ---------------
  </script>

  <!-- STYLESHEETS -->
  <link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />

  <!-- <link rel="stylesheet" href="css/ix.redefined.css" type="text/css" /> -->
  <link rel="stylesheet" href="css/ix.css" type="text/css" />
  <link rel="stylesheet" href="css/ix-explore.css" type="text/css" />
  <link rel="stylesheet" href="css/overwrites.css" type="text/css" />

</head>
<body onload="initialize()">
  <div id="wrapper"><!-- #wrapper -->
    <header><!-- header -->
      <img src="images/headerimage.jpg" width="1000" height="138">
    </header><!-- end of header -->

    <?php include("includes/navigation.php"); ?>
<!--     <div id="beta-message-ok"><i>This beta version is being upgraded. We welcome your <a href="mailto: ixmaps@utoronto.ca?subject=IXmaps Explore Page">feedback</a></i></div> -->

    <div style="clear: both;"></div>

    <div class="announcement">Note: The location accuracy of routers mapped here varies considerably. If you believe a router is incorrectly located, <span href="#" title="This should explain how flagging is done. What do we think of these tool tips?">please flag it</span></div>

    <div id="explore-content">
      <div id="loader" style="display: none">
        <div id="loader-mask"></div>
        <div class="loader-image">
          <img width="100px" src="images/loading2.gif"/>
          <br/><br/>
          <div id="cancel-query-div">
            <button id="cancel-query">Cancel</button>
          </div>
        </div>
      </div>

      <!-- map-canvas-container -->
      <div id="map-canvas-container">
        <span id="map-output-container" style="float:left;">
          <div id="map_canvas" class="map-canvas"></div>
          <img id="options-btn" src="images/icon-gear.png" class="hidden"></img>
          <div id="options-container" class="map-icon-popup-container hidden">
            <img class="map-icon-close-btn" src="images/icon-close.png"></img>
            <h3>Options</h3>
            <div id="map-op-0" class="map-actions-controls">
              <h4>Router Mapping</h4>
              <input id="map-allow-multiple" class="map-tool-off" type="button" onMouseDown="setAllowMultipleTrs()" value="Multiple TRs"/>
              <input id="map-allow-recenter" class="map-tool-on" type="button" onMouseDown="setAllowRecenter()" value="Re-center"/>
            </div>
            <div id="map-op-1" class="map-actions-controls">
              <h4>Display</h4>
              <input id="map-show-hops" class="map-tool-on" type="button" onMouseDown="setShowHops()" value="Hops"/>
              <input id="map-show-routers" class="map-tool-on" type="button" onMouseDown="setShowRouters()" value="Routers"/>
              <input id="map-show-marker-origin" class="map-tool-off" type="button" onMouseDown="setAddMarkerInOrigin()" value="Marker in Origin"/>
            </div>
            <div id="map-op-2" class="map-actions-controls">
              <h4>Exclude Routers</h4>
              <input id="map-exclude-a" class="map-tool-on" type="button" onMouseDown="excludeA()" value="Lat/Long = 0"/>
              <input id="map-exclude-b" class="map-tool-on" type="button" onMouseDown="excludeB()" value="Generic Locations"/>
              <input id="map-exclude-d" class="map-tool-on" type="button" onMouseDown="excludeD()" value="Reserved AS"/>
              <input id="map-exclude-e" class="map-tool-on" type="button" onMouseDown="excludeE()" value="User-flagged"/>
            </div>
          </div>
          <img id="layers-btn" src="images/icon-layers.png" class="hidden"></img>
          <div id="layers-container" class="map-icon-popup-container hidden">
            <img class="map-icon-close-btn" src="images/icon-close.png"></img>
            <div id="map-op-3" class="map-actions-controls">
              <h3>Layers</h3>
              <input id="map-show-nsa" class="map-tool-off" type="button" onMouseDown="setShowNsa()" value="NSA"/>
              <input id="map-show-hotel" class="map-tool-off" type="button" onMouseDown="setShowHotel()" value="Hotel"/>
              <input id="map-show-google" class="map-tool-off" type="button" onMouseDown="setShowGoogle()" value="Google"/>
              <input id="map-show-uc" class="map-tool-off" type="button" onMouseDown="setShowUc()" value="Undersea Cable Landing Site"/>
            </div>
          </div>
          <img id="help-btn" src="images/icon-help.png" class="hidden"></img>
          <div id="help-container" class="map-icon-popup-container hidden">
            <img class="map-icon-close-btn" src="images/icon-close.png"></img>
            <h3>Help</h3>
            <p>
              If you're a <i>new user</i>, it may be easiest to begin with some of our canned queries in the Quick Searches section. For example, if you've just generated a route, you'll be able to find it be clicking on 'Examine last submitted route' or by clicking on 'Submitted By...' and entering your submitter name.
            </p>
            <div>
              For users more comfortable with querying databases, the Custom Filters section allows dynamic, extensible queries based on many of the data fields collected by the route generator program
            </div>
            <div>
              <div>For example, to view routes that neither start nor end in Canada, a user could query:</div>
              <div><b>| Does not | Originate in | Country | CA | AND | +</b></div>
              <div><b>| Does not | Terminate in | Country | CA |</b></div>
              <div>Or, to browse routes ending in Toronto or Ottawa, a user could query:</div>
              <div><b>| Does | Terminate in | City | Toronto | OR | +</b></div>
              <div><b>| Does | Terminate in | City | Ottawa |</b></div>
              <div>
                Note that while the query is performed on the entire IXmaps database, due to computational and bandwidth limitations the server only returns the first 200 results. If you do not see the route you were looking for, it is best to add additional filter constraints (e.g. Submitter).
              </div>
            </div>
            <br/>
            <div id="legend">
              <h3>Map Legend</h3>
              <div><span class="legend-img-container"><img class="legend-img" src="/images/carrierhotel_small.png" /></span><span>Carrier hotel</span></div>
              <div><span class="legend-img-container"><img class="legend-img" src="/images/google.png" /></span><span>Google data center</span></div>
              <div><span class="legend-img-container"><img class="legend-img" src="/images/undersea1.png" /></span><span>Undersea cable landing point</span></div>
              <div><span class="legend-img-container"><img class="legend-img" src="/images/nsa_class_A.png" /></span><span>NSA listening post (high level of certainty)</span></div>
              <div><span class="legend-img-container"><img class="legend-img" src="/images/nsamedium.png" /></span><span>NSA listening post (medium level of certainty)</span></div>
            </div>
          </div>
        </span>
        <span id="traceroutes-found-container" style="float:right;">
          <div id="traceroutes-found-title-container">
            <span><h3 style="display: inline">Traceroutes Found</h3></span>
            <span style="float: right">
              <button id="add-all-trs-btn">Map All</button>
              <button id="remove-all-trs-btn">Remove All</button>
            </span>
          </div>
          <div id="filter-results-log"></div>
          <div style="clear: both"></div>
          <div id="filter-results">
            <!-- filled in when queries are returned -->
          </div>
          <h3 style="margin-top: 15px">Carrier Summary</h3>
          <div id="filter-results-ixmaps-data">
            <!-- filled in when queries are returned -->
          </div>
          <div id="map-legend" class="map-info-containers"></div>
        </span>
      </div>
      <!-- /map-canvas-container -->

      <span id="search-container" style="float:left">
        <h3>Search</h3>
        <!-- autocomplete data -->
        <div id="autocomplete-data" class="hidden"></div>
        <div id="filter-container">
          <!-- these will filled in by addFilterConstraint -->
        </div>
        <div id="filter-results-summary-container" style="float: left;">Search results details...</div>
        <div style="float: right;">
          <span>
            <button id="reset-filters-button" class="action-button">Reset Values</button>
          </span>
          <span>
            <button id="process-filters-button" class="action-button"><b>Submit</b></button>
          </span>
        </div>
        <div style="clear: both;"></div>
        <div id="filter-results-summary" class="hidden" style="float: left;"></div>
      </span>

      <!-- tables? for real!? -->
      <span id="quick-search-container" style="float: right">
        <h3>Quick Searches</h3>
        <table>
          <tr>
            <td>
              <form>
                <button type="button" class="ql-button" id="last-submission-button">
                  Last submitted
                </button>
              </form>
            </td>
            <td>
              <form>
                <button type="button" class="ql-button" id="recent-routes-button">
                  Last 50 submitted
                </button>
              </form>
            </td>
          </tr>
          <tr>
            <td>
              <form>
                <button type="button" class="ql-button" id="all-boomerangs-button">
                  Boomerangs
                </button>
              </form>
            </td>
            <td>
              <form>
                <button type="button" class="ql-button" id="contain-NSA-button">
                  Containing NSA Cities
                </button>
              </form>
            </td>
          </tr>
          <tr>
            <td>
              <form>
                <button type="button" class="ql-button" id="destination-ixmaps">
                  Destination IXmaps.ca
                </button>
              </form>
            </td>
            <td>
              <form>
                <button type="button" class="ql-button" id="non-US-button">
                  Not Via US
                </button>
              </form>
            </td>
          <tr>
            <td>
              <form>
                <button type="button" class="ql-button" id="my-city-button">
                  From My City
                </button>
              </form>
            </td>
            <td>
              <form>
                <button type="button" class="ql-button" id="my-country-button">
                  From My Country
                </button>
              </form>
            </td>
          </tr>
          <tr>
            <td>
              <form>
                <button type="button" class="ql-button" id="submitted-by-button">
                  Submitted By...
                </button>
              </form>
            </td>
            <td>
              <form>
                <button type="button" class="ql-button" id="submitted-from-button">
                  Submitted From...
                </button>
              </form>
            </td>
          </tr>
        </table>
      </span>

    </div><!-- #content -->
    <footer>
      <?php include("includes/footer.php"); ?>
    </footer>
  </div><!-- #wrapper -->
  <br/>

  <div id="tr-details" class="hidden">
    <img id="tr-details-close-btn" class="map-icon-close-btn" src="images/icon-close.png">

    <div id="tr-details-data">
      <iframe id="tr-details-iframe" src=""></iframe>
    </div>
  </div>

  <div id="privacy-details" class="hidden">
    <img id="privacy-details-close-btn" class="map-icon-close-btn" src="images/icon-close.png">
    <div id="carrier-title"></div>
    <div style="clear: both;"></div>
    <div id="privacy-details-data">privacy-details-data</div>
  </div>

  <div id="ip-flags" class="ui-draggable hidden">
    <img id="close-ip-flags" src="images/icon-close.png">

    <div id="ip-flag-active"></div>
    <div>
      <div id="ip-flag-info">
        <div>Traceroute: <span id="ip-flag-tr-id"></span>Router: <span id="ip-flag-router"></span>
        <div id="ip-flag-hostname"></div>
        <div><span id="ip-flag-location"></span><span id="ip-flag-lat-long"></span></div>
        <div style="clear:both" />
        <div><span id="ip-flag-asn-name"></span><span id="ip-flag-star-rating"></span></div>
        <div style="clear:both" />
        <div id="ip-flag-gl-override"></div>
        <!-- <div id="ip-flag-ip-address"></div> -->
      </div>
    </div>
    <div id="ip-flags-title">
      <h3>Flag Router as Incorrect</h3>
      If you believe this router is wrongly located, please so indicate, offering a more accurate location if possible.
    </div>
    <div id="ip-flag-insert">
      <input id="user_nick" type="text" placeholder="Username"/>
      <input id="ip_new_loc" type="text" placeholder="Suggested Location"/>
      <input id="user_msg" type="text" placeholder="Additional Comments..."/>
      <input type="button" id="submit-ip-flag" value="Submit" onclick="saveIpFlag()"/>
    </div>
    <div id="ip-flags-data" class="hidden">
      <h3>Previous Flagging Reports</h3>
      <div id="ip-flags-data-list"></div>
    </div>
  </div>

</body>
</html>
