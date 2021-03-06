<?php
include("includes/check-redirect.php");
include('application/config.php');
include('application/model/IXmapsMaxMind.php');

$myIp = $_SERVER['REMOTE_ADDR'];
$mm = new IXmapsMaxMind();
$geoIp = $mm->getGeoIp($myIp);
$mm->closeDatFiles();

$myCountry = ''.$geoIp['geoip']['country_code'];
$myCity = ''.$geoIp['geoip']['city'];
$myAsn = $geoIp['asn'];
$myIsp = $geoIp['isp'];

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
  <!-- old key -->
  <!-- <script type="text/javascript" src="https://maps.google.com/maps/api/js?v=3&libraries=geometry&key=AIzaSyA0DDT87jStJevJqxA5Fi9JUV9bemKdFGE"></script> -->
  <!-- new key for new server -->
  <script type="text/javascript" src="https://maps.google.com/maps/api/js?v=3&libraries=geometry&key=AIzaSyDooKbYZYOoTVcJvrV05uMOfQWAxMHtliQ"></script>

  <!-- jQuery Utils  -->
  <script type="text/javaScript" src="js/underscore-min.js"></script>

  <!-- IXmaps config files -->
  <script type="text/javascript" src="js/config.js"></script>
  <script type="text/javascript" src="js/ixmaps.js"></script>
  <script type="text/javascript" src="js/ixmaps.gm.js"></script>

  <script>
    var myIp = '<?php if(isset($myIp)) { echo $myIp;} ?>';
    var myCity = '<?php if(isset($myCity)) { echo $myCity;} ?>';
    var myCountry = '<?php if(isset($myCountry)) { echo $myCountry;} ?>';
    var myISP = '<?php if(isset($myIsp)) { echo $myIsp;} ?>';
    var myASN = '<?php if(isset($myAsn)) { echo $myAsn;} ?>';

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
      processPostedData(postedData);
      <?php
      } else {
      ?>
      jQuery('#userloc').show();
      <?php
      }
      ?>
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

  <!-- include analytics -->
  <?php include("includes/analytics.php"); ?>
</head>
<body onload="initialize()">
  <div id="wrapper"><!-- #wrapper -->
    <header><!-- header -->
      <img src="images/headerimage.jpg" width="1000" height="138">
    </header><!-- end of header -->

    <?php include("includes/navigation.php"); ?>

    <div style="clear: both;"></div>
    <div class="announcement">Please try out the <a href="https://dev.ixmaps.ca">beta version</a> of the re-designed the IXmaps website. We welcome your feedback!</div>
    <div class="announcement">Note: The location accuracy of routers mapped here varies considerably. If you believe a router is incorrectly located, please flag it</div>

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

      <div id="userloc" style="display: none">
        <div id="userloc-mask"></div>
        <div id="userloc-input">
          <br />
          <div>
            Your current IP address is <span class="userloc-ip"></span>
          </div>
          <br />
          <div>
            Your Internet Service Provider is <span class="userloc-isp"></span> (ASN: <span class="userloc-asn"></span>)
          </div>
          <br />
          <div>
            You appear to be near <input class="userloc-text-input userloc-city"></input> <input class="userloc-text-input userloc-country"></input>
          </div>
          <br />
          <div style="font-size: 12px;"><i>Please review and correct if needed</i></div>
          <br /><br />
          <div>
            <span id="userloc-find-creepy-btn">Find this creepy?</span>
            <button id="userloc-close-btn">Go To Map</button>
          </div>

          <br/><br/><br/>
          <div id="userloc-creepy-explanation" style="display: none; clear: both;">
            Every website you visit, and all the carriers along the way, needs the IP address of your device to transmit your data and return content. Using commonly available IP address lookup services, any of these can determine your approximate location. These service providers can also capture your communications, and are largely unfettered in using it for their own purposes. They can also secretly hand it over to third parties, including law enforcement and security agencies. With IXmaps, we only use your IP address to produce these maps. For more, see our privacy policy.
          </div>
        </div>
      </div>

      <!-- map-canvas-container -->
      <div id="map-canvas-container">
        <span id="map-output-container" style="float:left;">
          <div id="map_canvas" class="map-canvas"></div>
          <img id="options-btn" src="images/icon-gear.png" title="Settings" class="hidden"></img>
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
          <img id="layers-btn" src="images/icon-layers.png" title="Map legend and layers" class="hidden"></img>
          <div id="layers-container" class="map-icon-popup-container hidden">
            <img class="map-icon-close-btn" src="images/icon-close.png"></img>

            <div id="map-op-3" class="map-actions-controls">
              <h3>Layers and Legend</h3>

              <div id="map-show-nsa" class="layer-legend-btn map-tool-off" onMouseDown="setShowNsa()" value="NSA">
                <span class="legend-img-container"><img class="legend-img" src="/images/nsa_class_A.png" /></span><span>NSA internet interception site - US</span>
              </div>

              <div id="map-show-IXca" class="layer-legend-btn map-tool-off" onMouseDown="setShowIXca()" value="IX_ca">
                <span class="legend-img-container"><img class="legend-img" src="/images/IX_ca.png" /></span><span>Public Internet Exchange Point (IXP) - Canada</span>
              </div>

              <div id="map-show-CiraIPT" class="layer-legend-btn map-tool-off" onMouseDown="setShowCiraIPT()" value="CIRA_IPT">
                <span class="legend-img-container"><img class="legend-img" src="/images/CIRA_IPT.png" /></span><span>CIRA/M-Lab Internet Performance Test (IPT) server - Canada</span>
              </div>

              <div id="map-show-Att" class="layer-legend-btn map-tool-off" onMouseDown="setShowAtt()" value="AT&T">
                <span class="legend-img-container"><img class="legend-img" src="/images/ATT_logo.png" /></span><span>AT&T/Fairview - suspected surveillance site - worldwide</span>
              </div>

              <div id="map-show-Verizon" class="layer-legend-btn map-tool-off" onMouseDown="setShowVerizon()" value="Verizon">
                <span class="legend-img-container"><img class="legend-img" src="/images/Verizon_Logo_2015.png" /></span><span>Verizon/Stormbrew - suspected surveillance site - worldwide</span>
              </div>

              <div id="map-show-google" class="layer-legend-btn map-tool-off" onMouseDown="setShowGoogle()" value="Google">
                <span class="legend-img-container"><img class="legend-img" src="/images/google.png" /></span><span>Google public data centre / peering point - worldwide (2013)</span>
              </div>

              <div id="map-show-google-to" class="layer-legend-btn map-tool-off" onMouseDown="setShowGoogleTo()" value="Google_TO">
                <span class="legend-img-container"><img class="legend-img" src="/images/google.png" /></span><span>Google data centre - Toronto (2013)</span>
              </div>

              <div id="map-show-hotel" class="layer-legend-btn map-tool-off" onMouseDown="setShowHotel()" value="Hotel">
                <span class="legend-img-container"><img class="legend-img" src="/images/carrierhotel_small.png" /></span><span>Carrier hotel - US+Canada</span>
              </div>

              <div id="map-show-uc" class="layer-legend-btn map-tool-off" onMouseDown="setShowUc()" value="Undersea Cable Landing Site">
                <span class="legend-img-container"><img class="legend-img" src="/images/undersea1.png" /></span><span>Undersea cable landing point - US+Canada</span>
              </div>


<!--               <input id="map-show-nsa" class="map-tool-off" type="button" onMouseDown="setShowNsa()" value="NSA"/>
              <input id="map-show-hotel" class="map-tool-off" type="button" onMouseDown="setShowHotel()" value="Hotel"/>
              <input id="map-show-google" class="map-tool-off" type="button" onMouseDown="setShowGoogle()" value="Google"/>
              <input id="map-show-uc" class="map-tool-off" type="button" onMouseDown="setShowUc()" value="Undersea Cable Landing Site"/> -->
            </div>

<!--             <div id="map-op-3" class="map-actions-controls">
              <h3>Map Layers</h3>
              <div><span class="legend-img-container"><img class="legend-img" src="/images/carrierhotel_small.png" /></span><span>Carrier hotel</span></div>
              <div><span class="legend-img-container"><img class="legend-img" src="/images/google.png" /></span><span>Google data center</span></div>
              <div><span class="legend-img-container"><img class="legend-img" src="/images/undersea1.png" /></span><span>Undersea cable landing point</span></div>
              <div><span class="legend-img-container"><img class="legend-img" src="/images/nsa_class_A.png" /></span><span>NSA listening post (high level of certainty)</span></div>
              <div><span class="legend-img-container"><img class="legend-img" src="/images/nsamedium.png" /></span><span>NSA listening post (medium level of certainty)</span></div>
            </div> -->

          </div>
          <img id="help-btn" src="images/icon-help.png" title="Help" class="hidden"></img>
          <div id="help-container" class="map-icon-popup-container hidden">
            <img class="map-icon-close-btn" src="images/icon-close.png"></img>
            <h3>Help</h3>
            <p>If you're getting started, it may be easiest to begin with some of our canned queries in the Quick Searches section. If you've just generated a route, you'll be able to find it by clicking on 'Last submitted' or 'Last 50 submitted route' or by clicking on 'Submitted By...' and entering your submitter name.</p>

            <div>
              <div>For users more comfortable with querying databases, the Search feature allows customized, extensible queries based on many of the data fields associated with traceroutes. The Quick Search feature generates query examples you can combine and adapt for your more specific purposes. For example, to view routes that originate in your city and are carried by Bell, you could select:</div>
              <div><b>| Does | Originate in | Country | CA | AND | +</b></div>
              <div><b>| Does | Contain | ISP/Caller | Bell |</b></div>
              <div>then click <b>Submit</b></div>
              <div>Or, to look for Canadian boomerang routes destined for Federal Government agencies you could form this query:</div>
              <div><b>| Does | Originate in | Country | CA | AND | +</b></div>
              <div><b>| Does | Go via | Country | US | AND | +</b></div>
              <div><b>| Does | Terminate in | Destination hostname | .gc.ca |</b></div>
              <div>then click <b>Submit</b></div>
              <p>To see how many search results each individual query line produced, click on 'Search results details' at the bottom. This can be helpful in deciding on a next search, especially if no results are found or there are too many.</p>
              <p>Note that while the query is performed on the entire IXmaps database, due to computational and bandwidth limitations the server only returns a sample of at most 100 results to display. If you do not see the route you were looking for, it is best to add additional filter constraints (e.g. Submitter).</p>
            </div>
          </div>
        </span>
        <span id="traceroutes-found-container" style="float:right;">
          <div id="traceroutes-found-title-container">
            <span title="Lists all the traceroutes found by the latest search. (A traceroute records the sequence of routers and transit times of data packets crossing the Internet.) Click on column headings to re-order the list. "><h3 style="display: inline">Traceroutes Found</h3></span>
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
          <h3 style="margin-top: 15px" title="Summary of key information about the telecom carriers represented in the current map. Click on column headings to re-order the list. ">Carrier Summary</h3>
          <div id="filter-results-ixmaps-data">
            <!-- filled in when queries are returned -->
          </div>
          <div id="map-legend" class="map-info-containers"></div>
        </span>
      </div>
      <!-- /map-canvas-container -->

      <span id="search-container" style="float:left">
        <h3 title="Construct your own custom search by selecting from among the various query options. Click on the + at the end of a query line to add another. Click X to delete the line. Then click Submit. Complex queries can take several seconds to complete.">Search</h3>
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
                <button type="button" class="ql-button" id="last-submission-button" title="Map the traceroute most recently contributed to the database.">
                  Last submitted
                </button>
              </form>
            </td>
            <td>
              <form>
                <button type="button" class="ql-button" id="recent-routes-button" title="Map the 50 traceroutes most recently contributed to the database.">
                  Last 50 submitted
                </button>
              </form>
            </td>
          </tr>
          <tr>
            <td>
              <form>
                <button type="button" class="ql-button" id="all-boomerangs-button" title="Map all routes that begin in Canada and end in Canada, but travel via the US (and NSA interception sites). Click Submit.">
                  Boomerangs
                </button>
              </form>
            </td>
            <td>
              <form>
                <button type="button" class="ql-button" id="contain-NSA-button" title="Map all routes that pass through at least one of the 18 cities in the US most likely to contain an NSA splitter surveillance operation. For more, see the FAQ page and its Glossary section.">
                  Containing NSA Cities
                </button>
              </form>
            </td>
          </tr>
          <tr>
            <td>
              <form>
                <button type="button" class="ql-button" id="non-US-button">
                  Not Via US
                </button>
              </form>
            </td>
            <td>
              <form>
                <button type="button" class="ql-button" id="my-isp-button" title="Map all routes already contributed from other subscribers of your internet service provider (using the Autonomous System Number associated with that ISP). Click Submit. ">
                  From My ISP
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
                <button type="button" class="ql-button" id="submitted-by-button" title="Enter a pseudonym to see the routes s/he contributed to the database, then click Submit.">
                  Submitted By...
                </button>
              </form>
            </td>
            <td>
              <form>
                <button type="button" class="ql-button" id="submitted-from-button" title="Enter a postcode to see routes contributed to the database from that area, then click Submit.">
                  From Postcode...
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
      If you believe this router is incorrectly located, please so indicate, offering a more accurate location if possible. Note that since excluding User-flagged routers is enabled by default, the next time this route is mapped, this router will not appear. To see it again, turn off the Exclude router / User-flagged control in Options (the gear icon), then refresh the query.
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
