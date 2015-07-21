<?php
$ixHost = $_SERVER["SERVER_NAME"];
if ($ixHost!='www.ixmaps.ca') {
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

  <!-- Get here latest jQuery: using a fixed version now for testing ... -->
  <script src="jquery-ui-1.10.1/js/jquery-1.9.1.js"></script>
  <script src="jquery-ui-1.10.1/js/jquery-ui-1.10.1.custom.js"></script>


  <!-- These are needed to enable table sorter -->
  <script src="js/jquery.metadata.js"></script>
  <script src="js/jquery.tablesorter.min.js"></script>
  <link rel="stylesheet" href="css/tables.sorter.css" />
  <link rel="stylesheet" href="css/themes/blue/style.css" />

  <!-- Google Maps API  -->
  <!--
  <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
   -->
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

    jQuery(function() {
      jQuery("#tabs").tabs();
      jQuery("#map-actions").tabs();
    });

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
    <div id="beta-message-ok"><i>This beta version is being upgraded. We welcome your <a href="mailto: ixmaps@utoronto.ca?subject=IXmaps Explore Page">feedback</a></i></div>

    <div style="clear: both;"></div>

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
      <!-- tabs -->
      <div id="tabs">
        <ul>
          <li><a href="#tabs-0">Quick Links</a></li>
          <li><a href="#tabs-1">Custom Filters</a></li>
          <li><a href="#tabs-2">Selected Routes</a></li>
          <li><a href="#tabs-3">Map Options</a></li>
          <li><a href="#tabs-4">Help</a></li>
        </ul>

        <!-- tabs-0 -->
        <div id="tabs-0">
          <h4>Quick Links:</h4>
          <table>
            <tr>
              <td>
                <form>
                  <button type="button" class="ql-button" id="last-submission-button">
                    Last submitted route
                  </button>
                </form>
              </td>
              <td>
                <form>
                  <button type="button" class="ql-button" id="recent-routes-button">
                    Last 50 submitted routes
                  </button>
                </form>
              </td>
            </tr>
            <tr>
              <td>
              </td>
              <td>
              </td>
            </tr>
          </table>
        </div>
        <!-- /tabs-0 -->

        <!-- /tabs-1 -->
        <div id="tabs-1">
          <h3>Custom Filter Examples</h3>
          <table>
            <tr>
              <td>
                <form>
                  <button type="button" class="ql-button" id="all-boomerangs-button">
                    Boomerang routes
                  </button>
                </form>
              </td>
              <td>
                <form>
                  <button type="button" class="ql-button" id="non-CA-button">
                    Routes that do not go via Canada
                  </button>
                </form>
              </td>
            </tr>

            <tr>
              <td>
                <form>
                  <button type="button" class="ql-button" id="contain-NSA-button">
                    Routes that contain NSA cities
                  </button>
                </form>
              </td>
              <td>
                <form>
                  <button type="button" class="ql-button" id="non-US-button">
                    Routes that do not go via the US
                  </button>
                </form>
              </td>
            <tr>
              <td>
                <form>
                  <button type="button" class="ql-button" id="my-city-button">
                    Routes from my city
                  </button>
                </form>
              </td>
              <td>
                <form>
                  <button type="button" class="ql-button" id="my-country-button">
                    Routes from my Country
                  </button>
                </form>
              </td>
            </tr>
          </table>

          <br/>
          <h3>Custom Filters</h3>
          <!-- autocomplete data -->
          <div id="autocomplete-data" class="hide"></div>
          <div id="filter-container">
            <!-- these will filled in by addFilterConstraint -->
          </div>
          <div>
            <div style="float: left;">
                <button id="reset-filters-button" class="action-button">Reset Values</button>
              </div>
              <div>
                <button id="process-filters-button" class="action-button"><b>Submit</b></button>
              </div>
          </div>
        </div>
        <!-- /tabs-1 -->

        <!-- /tabs-2 -->
        <div id="tabs-2">
          <h3>Selected Routes</h3>
          <br/>
          <a href="javascript:submitCustomQuery(1859);">Toronto to San Francisco (#1859)</a><br/>
          <a href="javascript:submitCustomQuery(1486);">Vancouver to Halifax (#1486)</a><br/>
          <a href="javascript:submitCustomQuery(1474);">Vancouver to Thunder Bay (#1474)</a><br/>
          <a href="javascript:submitCustomQuery(3445);">New York to San Francisco (#3445)</a><br/>
          <a href="javascript:submitCustomQuery(1751);">Austin to San Francisco (#1751)</a><br/>
          <a href="javascript:submitCustomQuery(1577);">Honolulu to Prince Edward Island (#1577)</a>
          <br/>
          <br/>
          <a href="javascript:showTestedCarriers();">Show Carriers TR Sample</a>
        </div>
        <!-- /tabs-2 -->

        <!-- tabs-3 -->
        <div id="tabs-3">
          <div id="map-op-0" class="map-actions-controls">
            <h3>Enable</h3>
            <input id="map-allow-multiple" class="map-tool-off" type="button" onMouseDown="setAllowMultipleTrs()" value="Multiple TRs"/>
            <input id="map-allow-recenter" class="map-tool-on" type="button" onMouseDown="setAllowRecenter()" value="Re-center"/>
          </div>
          <div id="map-op-1" class="map-actions-controls">
            <h3>Display</h3>
            <input id="map-show-hops" class="map-tool-on" type="button" onMouseDown="setShowHops()" value="Hops"/>
            <input id="map-show-routers" class="map-tool-on" type="button" onMouseDown="setShowRouters()" value="Routers"/>
            <input id="map-show-marker-origin" class="map-tool-off" type="button" onMouseDown="setAddMarkerInOrigin()" value="Marker in Origin"/>
            <input id="map-show-info-global" class="map-tool-off" type="button" onMouseDown="setShowInfoGlobal()" value="Advanced Log"/>
          </div>
          <div id="map-op-2" class="map-actions-controls">
            <h3>Exclude Routers</h3>
            <input id="map-exclude-a" class="map-tool-on" type="button" onMouseDown="excludeA()" value="Lat/Long = 0"/>
            <input id="map-exclude-b" class="map-tool-on" type="button" onMouseDown="excludeB()" value="Generic Locations"/>
            <input id="map-exclude-d" class="map-tool-on" type="button" onMouseDown="excludeD()" value="Reserved AS"/>
            <!-- <input id="map-exclude-c" class="map-tool-on" type="button" onMouseDown="excludeC()" value="Impossible Distances"/> -->
            <input id="map-exclude-e" class="map-tool-on" type="button" onMouseDown="excludeE()" value="User-flagged"/>
          </div>
          <div id="map-op-3" class="map-actions-controls">
            <h3>IXmaps Layers</h3>
            <input id="map-show-nsa" class="map-tool-off" type="button" onMouseDown="setShowNsa()" value="NSA"/>
            <input id="map-show-hotel" class="map-tool-off" type="button" onMouseDown="setShowHotel()" value="Hotel"/>
            <input id="map-show-google" class="map-tool-off" type="button" onMouseDown="setShowGoogle()" value="Google"/>
            <input id="map-show-uc" class="map-tool-off" type="button" onMouseDown="setShowUc()" value="Undersea Cable Landing Site"/>
          </div>
        </div>
        <!-- /tabs-3 -->

        <!-- tabs-4 -->
        <div id="tabs-4">
          <h3>Help</h3>
          <p>
            If you're a <i>new user</i>, it may be easiest to begin with some of our canned queries in the Quick Links section.
            For example, if you've just generated a route, you'll be able to find it be clicking on 'Examine last submitted route'
            or by clicking on 'Examine routes by submitter' and locating your submitter name.
          </p>

          <div>
            For users more comfortable with querying databases, the Custom Filters section allows dynamic, extensible queries based
            on many of the data fields collected by the route generator program
          </div>
          <div class="expandable- hide-">
            <div>For example, to view routes that neither start nor end in Canada, a user could query:</div>
            <div><b>| Does not | Originate in | Country | CA | AND | +</b></div>
            <div><b>| Does not | Terminate in | Country | CA |</b></div>
            <div>Or, to browse routes ending in Toronto or Ottawa, a user could query:</div>
            <div><b>| Does | Terminate in | City | Toronto | OR | +</b></div>
            <div><b>| Does | Terminate in | City | Ottawa |</b></div>
            <div>
              Note that, while the query is performed on the entire IXmaps database, due to computational and bandwidth limitations
              the server only returns the first 200 results. If you do not see the route you were looking for, it is best to add additional
              filter constraints (e.g. Submitter).
            </div>
          </div>
        </div>
        <!-- /tabs-4 -->

      </div>
      <!-- /tabs -->


      <div style="clear: both"></div>
      <br/>
      <div id="filter-results-log" class="hide"></div>
      <!-- Map  options -->
      <!-- FIXME add all this calls to javascript functions in jquery -->
      <a name="tot-trs" id="tot-trs"></a>
      <div id="map-container" class="hide">
        <div class="announcement" style="margin-bottom: 5px;">Note: The location accuracy of routers mapped here varies considerably. If you believe a router is incorrectly located, please flag it, so it can be corrected.</div>
        <div id="map-core-controls" class="hide" style="float:right;">
          <div id="map-status-info" class="" style="float:left;">
            <span id="map-loading-status"></span>
          </div>
          <div style="float:left;">
            <input class="map-tool-off" type="button" onMouseDown="addAllTrs()" value="Add All"/>
            <input class="map-tool-off" type="button" onMouseDown="removeAllTrs()" value="Remove All"/>

            <!-- <input id="map-render-stop-play" class="map-tool-off" type="button" onMouseDown="stopRender()" value="Stop (Experimental)"/>  -->
          </div>
        </div>

        <div id="map-stats-container">
          <!-- Check the css for this, some not used now  -->
          <div id="map-info-global" class="map-info-containers hide">
            <span id="map-info-total"></span>
            <br/>
            <span id="map-router-exclusion"></span>
            <br/>
            <span id="map-impossible-distance-log"></span>
          </div>
        </div>
        <!-- / map-stats-container -->
      </div>
      <!-- / map-container -->

      <div style="clear:both;"></div>

      <!-- map-canvas-container -->
      <div id="map-canvas-container" class="hide">
        <div style="float:left;">
          <div id="map_canvas" class="map-canvas"></div>
        </div>
        <div style="">
          <div id="map-legend" class="map-info-containers--">map-legend</div>
          <div id="map-tr-active" class="map-info-containers">map-tr-active</div>
          <div id="map-info" class="map-info-containers">map-mouse-actions</div>
        </div>
      </div>
      <!-- /map-canvas-container -->

      <div style="clear:both;"></div>

      <div id="filter-results" class="hide">
        <!-- filled in when queries are returned -->
      </div>
      <div id="filter-results-ixmaps-data" class="hide">
        <!-- filled in when queries are returned -->
      </div>

    </div><!-- #content -->
    <footer>
      <?php include("includes/footer.php"); ?>
    </footer>
  </div><!-- #wrapper -->
  <br/>

  <div id="tr-details" class="hide">
    <div id="tr-details-close">
      <a href="javascript:closeTrDetails();">
        <img src="images/icon-close.png">
      </a>
    </div>

    <div id="tr-details-data">
      <iframe id="tr-details-iframe" src=""></iframe>
    </div>
  </div>

  <div id="privacy-details" class="hide">
    <div id="privacy-details-close">
      <a href="javascript:closePrivacy();">
        <img src="images/icon-close.png">
      </a>
    </div>
    <div id="carrier-title"></div>
    <div style="clear: both;"></div>
    <div id="privacy-details-data">privacy-details-data</div>
  </div>

  <div id="ip-flags" class="hide">
    <div id="ip-flags-close">
      <a href="javascript:closeIpFlags();">
        <img src="images/icon-close.png">
      </a>
    </div>
    <div id="ip-flags-new">
      <a href="javascript:newIpFlag();">Create a new Report</a>
    </div>

    <div id="ip-flags-Title">
      <h2>User generated flags</h2>
    </div>

    <div id="ip-flag-active"></div>

    <div style="clear: both;"></div>

    <div>
      <div id="ip-flag-info"></div>

      <div id="ip-flag-first-msg">
        <p>Please flag routers you believe are shown in the wrong place. Flagged routers alert other users to possible inaccuracies and can be eliminated from traceroute mapping so what you see is more reliable (See Explore>Map options>Exclude routers>User-flagged). Flagging routers will also help us to re-locate them more accurately, especially if you can provide us with good clues as to their correct position. We periodically review the database and review flagged routes for correction.</p>
        <p>We appreciate helpful details, but all fields are optional.</p>
        <p>Thanks.</p>
        <div id="ip-flag-log"></div>
      </div>
    </div>

    <div style="clear: both;"></div>

    <div id="ip-flag-insert" class="hide">
      <h3>Create a new report</h3>
      <table>
        <tr>
          <td>Username</td>
          <td><input id="user_nick" type="text"/></td>
        </tr>
        <tr>
          <td>Comment:</td>
          <td><textarea id="user_msg"></textarea></td>
        </tr>
        <tr>
          <td>Suggested Location:</td>
          <td><textarea id="ip_new_loc"></textarea></td>
        </tr>
      </table>
      <br/>
      <input type="button" id="submit-ip-flag" value="Submit" onclick="saveIpFlag()"/>
      <input type="button" id="cancel-ip-flag" value="Cancel" onclick="cancelIpFlag()"/>
    </div>
    <div id="ip-flags-data">
      <div id="ip-flags-data-list"></div>
    </div>
  </div>

</body>
</html>
