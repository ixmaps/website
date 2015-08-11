
/*
	IXmaps google maps global vars and init scripts
*/
//var privacyRepUrl = 'https://www.ixmaps.ca/documents/2014_Carrier_Evaluation_Criteria_Dec_22.pdf';
var privacyRepUrl = 'https://www.ixmaps.ca/transparency-2014.php';


var allowMultipleTrs = true; // !!
var allowRecenter = true;

var showHops = true;
var showHopsNum = false;
var showRouters = true;
var showNsa = false;
var showHotel = false;
var showGoogle = false;
var showUc = false;
var addMarkerInOrigin = false;

var showDynamicLegend = true; // !!
var showMapInfoGlobal = false;

var excludeCoord0 = true;
var excludeCoordGen = true;
var excludeImpDist = false;
var excludeReservedAS = true;
var excludeUserFlagged = false;  // REVERT ME!
var impDistLog = '';

var skippedRouterNum = new Array(0,0,0,0);
var trRouterCount = 0;
var trRouterAdded = 0;

var trRenderSpeed = 50;
var trRenderStop = false;

var m_lat = null;
var m_lng = null;
var mouse_in_polyline = true;
var map = null;
var activeTrId = null;
var activeTrObj = null;
var trCollection = []; // hop gm objects
var trOcollection = []; // routers gm objects
var trsAddedToMap = [];
var ipCollection = new Object();
var cHotelData;
var gmObjects = [];
var infowindow = null;
var infowindowRoute = null;         // used as a hackish temp store for the route with current window open

// gm collections of extra layers
var gmNsa = [];
var gmHotel = [];
var gmGoogle = [];
var gmUc = [];

var totTRs = 0;
var activeCarriers = new Object();
var coordCollected = [];
var coordCollectedObj = [];
var addMarkerInLastHop = true; // Not implemented
var addMarkerInDesination = true; //

var privacyData;

var addCollectedCoord = function(lat1,long1){
  var c = new google.maps.LatLng(lat1,long1);
  coordCollected.push(c);
  //console.log('coordCollected: ',coordCollected);
  renderCollectedCoords();

  if(coordCollected.length==2){
    // using goolge maps API to calculate distance between coordinates
    var latLngA = coordCollected[0];
    var latLngB = coordCollected[1];
    var gmDist = google.maps.geometry.spherical.computeDistanceBetween (latLngA, latLngB);
    gmDist=gmDist/1000;
    console.log('gmDist: ', gmDist);

  } else if (coordCollected.length>2){
    // remove origin markers, if any
    for (m in coordCollectedObj)
    {
      coordCollectedObj[m].setMap(null);
    }
    coordCollected.length = 0;
    coordCollectedObj.length = 0;
  }
};

var renderCollectedCoords = function(){
  jQuery.each(coordCollected, function(key,value) {
    //console.log('value', value);

    var objCoords = new google.maps.Polyline({
    path: coordCollected,
    strokeOpacity: 1,
    strokeColor: '#FF0000',
    strokeWeight: 5.0
    });

    coordCollectedObj.push(objCoords);

    objCoords.setMap(map);
  });

};

var setShowInfoGlobal = function(){
  if(showMapInfoGlobal){
    showMapInfoGlobal=false;
    jQuery("#map-show-info-global").removeClass("map-tool-on").addClass("map-tool-off");
    jQuery("#map-info-global").hide();
  } else {
    showMapInfoGlobal=true;
    jQuery("#map-show-info-global").removeClass("map-tool-off").addClass("map-tool-on");
    jQuery("#map-info-global").show();
  }
  console.log('showMapInfoGlobal',showMapInfoGlobal);
};

var setShowHops = function(){
  if(showHops){
    showHops=false;
    jQuery("#map-show-hops").removeClass("map-tool-on").addClass("map-tool-off");
  } else {
    showHops=true;
    jQuery("#map-show-hops").removeClass("map-tool-off").addClass("map-tool-on");
  }
  console.log('setShowHops',showHops);
};

var setShowHopsNum = function(){
  if(showHopsNum){
    showHopsNum=false;
    jQuery("#map-show-hops-num").removeClass("map-tool-on").addClass("map-tool-off");
  } else {
    showHopsNum=true;
    jQuery("#map-show-hops-num").removeClass("map-tool-off").addClass("map-tool-on");
  }
  console.log('setShowHopsNum',showHops);
};

var setAllowRecenter = function(){
  if(allowRecenter){
    allowRecenter=false;
    jQuery("#map-allow-recenter").removeClass("map-tool-on").addClass("map-tool-off");
  } else {
    allowRecenter=true;
    jQuery("#map-allow-recenter").removeClass("map-tool-off").addClass("map-tool-on");
  }
  console.log('setAllowRecenter',allowRecenter);
};

var setShowRouters = function(){
  if(showRouters){
    showRouters=false;
    jQuery("#map-show-routers").removeClass("map-tool-on").addClass("map-tool-off");
  } else {
    showRouters=true;
    jQuery("#map-show-routers").removeClass("map-tool-off").addClass("map-tool-on");
  }
  console.log('setShowRouters',showRouters);
};

var setShowNsa = function(){
  if(showNsa){
    showNsa=false;
    removeGeoMarkers(1);
    jQuery("#map-show-nsa").removeClass("map-tool-on").addClass("map-tool-off");
  } else {
    showNsa=true;
    renderGeoMarkers(1);
    jQuery("#map-show-nsa").removeClass("map-tool-off").addClass("map-tool-on");
  }
  console.log('setShowNsa',showNsa);
};

var setShowHotel = function(){
  if(showHotel){
    showHotel=false;
    removeGeoMarkers(2);
    jQuery("#map-show-hotel").removeClass("map-tool-on").addClass("map-tool-off");
  } else {
    showHotel=true;
    renderGeoMarkers(2);
    jQuery("#map-show-hotel").removeClass("map-tool-off").addClass("map-tool-on");
  }
  console.log('setShowHotel',showHotel);
};

var setShowGoogle = function(){
  if(showGoogle){
    showGoogle=false;
    removeGeoMarkers(3);
    jQuery("#map-show-google").removeClass("map-tool-on").addClass("map-tool-off");
  } else {
    showGoogle=true;
    renderGeoMarkers(3);
    jQuery("#map-show-google").removeClass("map-tool-off").addClass("map-tool-on");
  }
  console.log('setShowGoogle',showGoogle);
};

var setShowUc = function(){
  if(showUc){
    showUc=false;
    removeGeoMarkers(4);
    jQuery("#map-show-uc").removeClass("map-tool-on").addClass("map-tool-off");
  } else {
    showUc=true;
    renderGeoMarkers(4);
    jQuery("#map-show-uc").removeClass("map-tool-off").addClass("map-tool-on");
  }
  console.log('setShowUc',showUc);
};

var setAddMarkerInOrigin = function(){
  if(addMarkerInOrigin){
    addMarkerInOrigin=false;
    jQuery("#map-show-marker-origin").removeClass("map-tool-on").addClass("map-tool-off");
  } else {
    addMarkerInOrigin=true;
    jQuery("#map-show-marker-origin").removeClass("map-tool-off").addClass("map-tool-on");
  }
  console.log('setAddMarkerInOrigin',addMarkerInOrigin);
};

var setAllowMultipleTrs = function(){
  if(allowMultipleTrs){
    allowMultipleTrs=false;
    jQuery("#map-allow-multiple").removeClass("map-tool-on").addClass("map-tool-off");
    //jQuery('#map-core-controls').hide();
    jQuery('#map-action-remove-all-but-this').hide();
  } else {
    allowMultipleTrs=true;
    jQuery("#map-allow-multiple").removeClass("map-tool-off").addClass("map-tool-on");
    //jQuery('#map-core-controls').show();
    jQuery('#map-action-remove-all-but-this').show();
  }
  console.log('setAllowMultipleTrs',allowMultipleTrs);
};

var excludeA = function(){
  if(excludeCoord0){
    excludeCoord0=false;
    jQuery("#map-exclude-a").removeClass("map-tool-on").addClass("map-tool-off");
  } else {
    excludeCoord0=true;
    jQuery("#map-exclude-a").removeClass("map-tool-off").addClass("map-tool-on");
  }
  console.log('exclude coords 0',excludeCoord0);
}

var excludeB = function(){
  if(excludeCoordGen){
    excludeCoordGen=false;
    jQuery("#map-exclude-b").removeClass("map-tool-on").addClass("map-tool-off");
  } else {
    excludeCoordGen=true;
    jQuery("#map-exclude-b").removeClass("map-tool-off").addClass("map-tool-on");
  }
  console.log('exclude generic coords.',excludeCoordGen);
};

var excludeC = function(){
  if(excludeImpDist){
    excludeImpDist=false;
    jQuery("#map-exclude-c").removeClass("map-tool-on").addClass("map-tool-off");
  } else {
    excludeImpDist=true;
    jQuery("#map-exclude-c").removeClass("map-tool-off").addClass("map-tool-on");
  }
  console.log('exclude impossible distance.',excludeImpDist);
  alert('Note that this option is functional but it has not been fully tested.');
};

var excludeD = function(){
  if(excludeReservedAS){
    excludeReservedAS=false;
    jQuery("#map-exclude-d").removeClass("map-tool-on").addClass("map-tool-off");
  } else {
    excludeReservedAS=true;
    jQuery("#map-exclude-d").removeClass("map-tool-off").addClass("map-tool-on");
  }
  console.log('exclude Reserved AS.',excludeReservedAS);
};

var excludeE = function(){
  if(excludeUserFlagged){
    excludeUserFlagged=false;
    jQuery("#map-exclude-e").removeClass("map-tool-on").addClass("map-tool-off");
  } else {
    excludeUserFlagged=true;
    jQuery("#map-exclude-e").removeClass("map-tool-off").addClass("map-tool-on");
  }
  console.log('exclude User Flagged routers.',excludeUserFlagged);
};

// var sortObject = function(map) {
//   var keys = _.sortBy(_.keys(map), function(a) { return -a; });
//   var newmap = {};
//   _.each(keys, function(k) {
//     newmap[k] = map[k];
//   });
//   return newmap;
// }

var loadMapData = function() {
  // reset user activity on data set every time a new set is loaded
  userActivityOnTrSet = new Object();

  ixMapsDataJson = jQuery.parseJSON(ixMapsData);
  var c = 0;
  jQuery.each(ixMapsDataJson, function(trId, value) {
    c++;
  });
  totTRs = c;
  console.log('IXmaps geographic data downloaded! [TRs: '+totTRs+']');
  for (first in ixMapsDataJson) break;

  // wait a bit before loading the first TRid and other functions
  setTimeout(function(){
    initializeMap();
    console.log('Google map canvas initialized !');
    showThisTr(_.last(_.keys(ixMapsDataJson)));           // show the last route (ie the one with the highest trid)
    setTableSorters();

  }, 300);

  jQuery('#tr-details').draggable();

  // to prevent confusion remove all after load
  removeAllTrs();

  // these are hidden to start, unhidden as late as possible in load to prevent them just hanging out in empty space while the map loads
  jQuery('#options-btn').removeClass('hidden');
  jQuery('#layers-btn').removeClass('hidden');
  jQuery('#help-btn').removeClass('hidden');
};

var setTableSorters = function(){
  console.log('Sorting TR Tables');
  jQuery('#tr-list-table').tablesorter( {sortList: [[0,2]]} );
};

var showTotalTrInfo = function(){
  var t2=trCollection.length;

  if(showDynamicLegend) {
    var carriers = '';
    carriers += '<table id="dynamic-legend" style="width: 100%;" class="tablesorter tr-list-result">';
    carriers += '<thead><tr>';
    // carriers += '<th>ASN</th>';
    carriers += '<th>Carrier</th>';
    // add routers
    carriers += '<th class="routers-header">Rtrs.</th>';
    // add nat
    carriers+='<th class="nat-header">Nat.</th>';
    // add star score
    carriers+='<th class="score-header">Transparency</th>';
    // close headers
    carriers+='</tr></thead><tbody>';

    // loop active carriers
    jQuery.each(activeCarriers, function(asNum, d) {
      //console.log(asNum,d)

      // use this only for testing
      function getRandomInt (min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
      }

      // check if carrier has privacy score data
      var cIn = privacyData.scores[asNum];
      var cScore=-1;
      var starsHtml='';
      var scoreDis = '';
      var cLink = '';

      if(cIn===undefined){
        //console.log('Carrier ' + asNum + ' has NOT Privacy data');
        scoreDis='';

      } else {
        // get carrier score
        cScore = getPrivacyScore(asNum);
        //cScore =0;

        //get score stars
        starsHtml = '';
        starsHtml = renderPrivacyScore(cScore);
        //console.log(starsHtml);

        //console.log('---- Carrier score('+asNum+'):' + cScore);
        //console.log('Carrier ' + asNum + ' HAS Privacy data');
        //scoreDis = ' ('+cScore+')';
        //console.log('Carrier score('+asNum+') : ' + cScore);
      }

      // start tr
      //carriers+='<tr style="border: solid 0.19em '+getAsnColour(asNum)+'">';
      carriers+='<tr>'

      if(cScore>=0){
        cLink='<a style="color: white; font-weight: bold; border-bottom: 2px dashed #10578b" href="javascript:viewPrivacy('+asNum+')">'+d[1]+'</a>';
      } else {
        cLink='<span style="color: white">'+d[1]+'</span>';
      }

      // Asn and bg colour
      // carriers+='<td class="asn-color-text" style="background-color:#'+getAsnColour(asNum)+'"><span class="asn-num-hops">'+asNum+'</span></td>';

      var color = getAsnColour(asNum).replace(/rgb/i, "rgba").replace(/\)/i,',0.7)');
      // carrier name
      carriers+='<td style="background-color: '+color+'">'+cLink+'</td>';

      // # of routers
      carriers+='<td class="centered-table-cell">'+d[0]+'</td>';
      // add nat
      carriers+='<td class="centered-table-cell">'+d[2]+'</td>';
      // add stars
      carriers+='<td class="star-col">'+starsHtml+' '+cScore+'</td>';
      // end tr
      carriers+='</tr>';
    });

    carriers+='</tbody></table>';
    jQuery('#map-legend').html(carriers);
    if(t2!=0) {
      // sort the second column of the carrier summary table by desc
      jQuery("#dynamic-legend").tablesorter( {sortList: [[1,1]]} );
    }
  }

  //jQuery('#map-info-total').html('Total TRs: '+totTRs+' : Active Hops: '+t2);
  //jQuery('#map-info-total').html('Displayed # of Hops: <strong>'+t2+'</strong>');
  jQuery('#tr-count').text(trsAddedToMap.length);
};

var showThisTr = function (trId) {
  if(!allowMultipleTrs){
    removeAllTrs();
  }
  renderTr(trId);
  showTotalTrInfo();
};

var stopRender = function(){
  if(trRenderStop){
    jQuery('#map-render-stop-play').val('Stop');
    trRenderStop = false;
  } else {
    jQuery('#map-render-stop-play').val('Play');
    trRenderStop = true;
  }
  console.log('stopRender', trRenderStop);
};

var checkIfStopped = function() {
  console.log('... Checking trRenderStop');
  return trRenderStop;
};

var addAllTrs = function() {
  removeAllTrs();
  jQuery('#map-status-info').show();

  //jQuery('#map-loading-status').html('');
  //var totR = totTRs;

  var conn = 1;
  var time = trRenderSpeed;
  var lastId;

  jQuery.each(ixMapsDataJson, function(trId, value) {

    var a = checkIfStopped();

    setTimeout(function(){
      if(trRenderStop){
        //console.log('.... stop function run');
        return false;
      } else {
        renderTr2(trId);
        showThisTr(trId);
        jQuery('#tr-count').text(conn);
        conn++;
      }
    }, time);

      time += trRenderSpeed;
  });
  // remove last
  removeTr();

  showTotalTrInfo();
  //jQuery('#map-status-info').hide();
};

var removeAllTrs = function() {
  removeTr();
  trsAddedToMap = [];
  skippedRouterNum = new Array(0,0,0,0);
  trRouterAdded=0;
  impDistLog='';
  ipCollection = new Object();
  jQuery('#map-impossible-distance-log').html('');
  jQuery('#map-router-exclusion').html('');
  jQuery('#map-loading-status').html('');
  jQuery('#map-tr-active').html('');

  // remove hops
  for (i in trCollection)
  {
    trCollection[i].setMap(null);
  }
  trCollection.length = 0;

  // remove origin markers, if any
  for (m in trOcollection)
  {
    trOcollection[m].setMap(null);
  }
  trOcollection.length = 0;

  activeCarriers = new Object();
  showTotalTrInfo();
  jQuery('#tr-count').text('0');
};

var removeTr = function() {
  //console.log('removing active tr');
  if(activeTrObj!=null){
    activeTrObj.setMap(null);
  }
};

/* Router exclusion functions */
var excludeRouter = function(value,trId,hop,type) {
  var skipHop = false;
  // A
  if(excludeCoord0){
    if(value.lat==0 && value.long==0){
      skipHop = true;
      if(type==1) {
        skippedRouterNum[0]+=1;
      }
      //console.log('excluding Coords = 0. Hop:' + hop,  value);
    }
  }
  // B
  if(excludeCoordGen){
    if((value.lat==60 && value.long==-95) || (value.lat==38 && value.long==-97)){
      skipHop = true;
      if(type==1) {
        skippedRouterNum[1]+=1;
      }
      //console.log('excluding Generic Coords. Hop:' + hop,  value);
    }
  }
  // C
  if(excludeImpDist){
      //console.log('...Calculating imposible distance');
      if(value.imp_dist==1 && hop!=1){
        skipHop = true;
        if(type==1) {
          skippedRouterNum[2]+=1;

          //console.log('TRid:['+trId+'], Hop: ['+hop+'], IP: '+value.ip + ', Latency: '+value.rtt_ms+', Dist: '+value.dist_from_origin+' Km.');
          //console.log(''+trId+';'+hop+';"'+value.mm_country+'";"'+value.mm_city+'";"'+value.asNum+'";"'+value.ip+'";'+value.rtt_ms+';"'+value.dist_from_origin+' Km.";"'+value.gl_override+'";""');

        }
        //console.log(''+trId+';'+hop+'',value);

        // use this only for debugging. makes the browser quite unresponsive
        //impDistLog += '<br/>';
        //impDistLog += 'TRid: [<a href="javascript:viewTrDetails('+trId+');">'+trId+'</a>], Hop: ['+hop+'], Dist: '+value.dist_from_origin+' Km.';

        //console.log('TRid:['+trId+'], Hop: ['+hop+'], Data: ', value);

        // using goolge maps API to calculate distance again: checking differences with server side calculation
/*        var latLngA = new google.maps.LatLng(value.latOrigin,value.longOrigin);
        var latLngB = new google.maps.LatLng(value.lat, value.long);
        var gmDist = google.maps.geometry.spherical.computeDistanceBetween (latLngA, latLngB);
        console.log('gmDist: ', gmDist);*/
      }
  }
  // D
  if(excludeReservedAS){
    if(value.asNum==-1 && value.gl_override==null){
      skipHop = true;
      if(type==1) {
        skippedRouterNum[3]+=1;
      }
      //console.log('excluding ReservedAS Hop:' + hop,  value);
    }
  }
  if(excludeUserFlagged){
    if(value.flagged==1){
      skipHop = true;
      if(type==1) {
        skippedRouterNum[4]+=1;
      }
      //console.log('excluding ReservedAS Hop:' + hop,  value);
    }
  }
  jQuery('#map-impossible-distance-log').html(impDistLog);
  return skipHop;
};


var renderTr = function (trId) {
  var trId = trId.toString();         // different calls to this func pass trId as string or int
  var hopObj = null;
  var p = [];
  var hops = [];
  var coordinates = [];
  var skipHop = false;
  var trInMap = false;
  var trInMapHtml = '';
  var trActiveHtml = '';
  //var skipHopNum = {"coord0:0","Generic Coords:0","Reserved AS:0"};

  var originCoords;

  // need to reset activeCarriers and other vars
  if(!allowMultipleTrs){
    skippedRouterNum = new Array(0,0,0,0,0);
    trRouterCount = 0;
    trRouterAdded = 0;
  }

  //if(trsAddedToMap.indexOf(trId) != -1){
  if (_.contains(trsAddedToMap, trId)) {
    trInMap = true;
    console.log('The TR ('+trId+') is already in the map');
  } else {
    trsAddedToMap.push(trId);
  }

  if(!trInMap){
    // get hops' coords
    jQuery.each(ixMapsDataJson[trId], function(hop, value) {

      // save first hop lat and long: this is now being done in the server
      if(trRouterCount==0){
        originCoords = new Array(value.lat, value.long);
        // validate here if the origin has been excluded, this will matter if subsequent routers are also excluded
      }
      // check router exclusions
      skipHop = excludeRouter(value, trId, hop,1);

      if(!skipHop){
        //console.log(key +':'+ value.long+', '+value.lat);
        var a = new Array(trId, hop, value.lat, value.long, value.asNum, value.asName, value.ip, value.gl_override, value.mm_city, value.mm_country, value.hostname);
        //google.maps.LatLng(value.lat, value.long);

        if(value.asNum in activeCarriers){
          activeCarriers[value.asNum][0]+=1;
        } else {
          // DUPLICATE: offload this to wherever else it's being done - somewhere in the model? Anto
          var asnName = value.asName;
          if (asnName.length > 15) {
            asnName = asnName.slice(0,15) + '...';
          }
          activeCarriers[value.asNum]=Array(1,asnName,value.mm_country);
        }
        //console.log('---- rendering router: ',value);
        p.push(a);
        trRouterAdded++;
      }

      trRouterCount++;
    }); // end loop routers
    //console.log('--- activeCarriers',activeCarriers);

    // get coordinates for tr with one-hop only
    if(p.length==1){
      console.log("TR with one hop Id:", p[0][0]);
      var oneHop_LatLng = new google.maps.LatLng(p[0][2],p[0][3]);
      coordinates.push(oneHop_LatLng);
    }

    // build each hop as a polyline
    jQuery.each(p, function(index, value) {
      //console.log(index +':'+ value);

      if(addMarkerInOrigin && index==0){
        console.log('addMarkerInOrigin');

          var O_LatLng = new google.maps.LatLng(p[0][2],p[0][3]);
          var O_m = new google.maps.Marker({
              position: O_LatLng,
              map: map,
              title:'Origin: TRid: '+p[0][0]+''
            });
          var iconUrl = url_base + '/images/grn-blank.png';
          O_m.setIcon(iconUrl);
          O_m.setMap(map);
          trOcollection.push(O_m);
      }

      if(showRouters){
        var markColour = getAsnColour([p[index][4]]);
        //var markColour = '#FFFFFF';
        var routerLatLong = new google.maps.LatLng(p[index][2],p[index][3])
        var routerMark = new google.maps.Marker({
            position: routerLatLong,
            map: map,
              icon: {
                path: google.maps.SymbolPath.CIRCLE,
                fillOpacity: 0.6,
                fillColor: markColour,
                  //strokeOpacity: 0.7,
                //strokeColor: '#000000',
                  //strokeColor: markColour,
                strokeWeight: 0,
                scale: 10
                },
            //title: "'TRid: "+p[index][0]+", Router: "+p[index][1]+", Carrier: "+p[index][5]+", IP: "+p[index][6]+", gl_override: "+p[index][7]+"'"


            //title: "'IP: "+p[index][6]+", gl_override: "+p[index][7]+"'"
            //title: "'IP: "+p[index][6]
        });

        // testing performance by using images as markers
        //routerMark.setIcon(url_base+'/images/hop'+p[index][1]+'.png');

        var rIp = p[index][6];
        // add the current router ip to the collection
        if(rIp in ipCollection ){
          ipCollection[rIp]+=1;
        } else {
          ipCollection[rIp]=1;
        }

        google.maps.event.addListener(routerMark, 'click', function() {
          viewTrDetails(p[index][0]);
        });
        google.maps.event.addListener(routerMark, 'mouseover', function() {
          // close all other infowindows
          if (infowindow) {
            infowindow.close();
          }

          var el = createMarkerText(trId, p, index);
          infowindow = new google.maps.InfoWindow({
            content: el
          });
          infowindow.open(map,routerMark);
          //trHopMouseover(p[index][0],p[index][1],0);
          //showFlags(p[index], false); // passing router obj, false= do not open flagging window
          //showFlags(p[index][0], p[index][1], p[index][6], false); // passing each var
        });

        // var a = new Array(trId, hop, value.lat, value.long, value.asNum, value.asName, value.ip);
        routerMark.setMap(map);
        trOcollection.push(routerMark);
      }

      /*  // FIX ME;) just for consistency and accuracy in the data displayed in the map we need add here the first router
      if(index==0){
      }*/
      if(showHops) {
        if(index>0){
          var hopPath = [];
          //console.log(' showing hop poly: '+p[index-1][2]+' --- '+p[index][2]);
          var LatLng1 = new google.maps.LatLng(p[index-1][2],p[index-1][3]);
          var LatLng2 = new google.maps.LatLng(p[index][2],p[index][3]);
          hopPath.push(LatLng1);
          hopPath.push(LatLng2);
          coordinates.push(LatLng1);
          coordinates.push(LatLng2);

          var colour = getAsnColour([p[index-1][4]]);
          //console.log(LatLng1+'---'+LatLng2+'---'+colour);
    /*      if(hopObj!=null){
            hopObj.setMap(null);
          }*/
          hopObj = null;
          hopObj = new google.maps.Polyline({
            path: hopPath,
            strokeColor: colour,
            strokeOpacity: 0.6,
            strokeWeight: 6.0
          });
          google.maps.event.addListener(hopObj, 'click', function() {
            trHopClick(trId,p[index-1][1],1);
          });
          google.maps.event.addListener(hopObj, 'click', function() {
              trHopClick(p[index-1][0],p[index-1][1],1);
          });
          google.maps.event.addListener(hopObj, 'mouseover', function() {
              trHopMouseover(p[index-1][0],p[index-1][1],1);
          });

          //console.log(hopObj);

          hopObj.setMap(map);
          trCollection.push(hopObj);

          //hopPath.length = 0; // this is messing things in the first load

        } // end if index>0
      }

    });

    //setTRidActive(trId); FIX ME

    if(allowRecenter)
    {
      if(coordinates.length!=0)
      {
        if (coordinates.length==1){
          map.setCenter(coordinates[0]);
          map.setZoom(4);
        } else {
          var bounds = new google.maps.LatLngBounds();
          for (var i = 0; i < coordinates.length; i++) {
              bounds.extend(coordinates[i]);
          }
          //console.log(coordinates);
          coordinates.length = 0;
          map.fitBounds(bounds);
        }
      } // end if coordinates not 0
    }
  } // end if tr in map


  if(!trInMap){
    trActiveHtml += 'TR added';
  } else {
    trActiveHtml += trInMapHtml;
  }

  // var h="";
  // h+='<div>';
  // h+='<div style="float:left;">TRid: <strong>'+trId+'</strong></div>';
  // h+='<div style="float:right;"><a href="javascript:viewTrDetails('+trId+');">View TR details</a> <span id="map-action-remove-all-but-this" class="hide">| <a href="javascript:removeAllButThis('+trId+');">Remove all but this</a></span></div>';
  // h+='</div>';

  //trActiveHtml = h'<br/> TRid: <strong>'+trId+'</strong> | <a href="javascript:viewTrDetails('+trId+');">View TR details</a> | <a href="javascript:removeAllButThis('+trId+');">Remove all but this</a>';

  // var totRoutersSkipped = skippedRouterNum[0]+skippedRouterNum[1]+skippedRouterNum[2]+skippedRouterNum[3]+skippedRouterNum[4];

  // var routerExcHtml = '';
  // routerExcHtml = '';

  // routerExcHtml += 'Tot routers added: <strong>' + trRouterAdded+'</strong>';
  // routerExcHtml += '<br/>Tot routers excluded: <strong>' + totRoutersSkipped+'</strong>';
  // routerExcHtml += '<br/><br/><strong>Router excluded details:</strong>';
  // routerExcHtml += '<br/>Lat/Log = 0: <strong>' + skippedRouterNum[0]+'</strong>';
  // routerExcHtml += '<br/>Generic Location: <strong>' + skippedRouterNum[1]+'</strong>';
  // //routerExcHtml += '<br/>Impossible Distance: <strong>' + skippedRouterNum[2]+'</strong>';
  // routerExcHtml += '<br/>Reserved AS: <strong>' + skippedRouterNum[3]+'</strong>';
  // routerExcHtml += '<br/>User-flagged: <strong>' + skippedRouterNum[4]+'</strong>';

  // jQuery('#map-tr-active').html(h);
  // jQuery('#map-router-exclusion').html(routerExcHtml);

  removeTr();
};

var createMarkerText = function(trId, route, index) {
  infowindowRoute = route;            // make sure we keep track of which route is current relevant for the infowindows
  var hop = route[index];
  var cScore = getPrivacyScore(hop[4]);
  var starsEl = '';
  if (cScore > 0) {
    starsEl = '<div>'+renderPrivacyScore(cScore)+'</div>';
  }

  var previousBtnEl = '';
  var nextBtnEl = '';
  if (index > 0) {
    previousBtnEl = '<button style="font-weight: bold;" onclick="openPreviousRouterMarker('+trId+', '+index+')"> < </button>'
  }
  if (index+1 < route.length) {
    nextBtnEl = '<button style="font-weight: bold;" onclick="openNextRouterMarker('+trId+', '+index+')"> > </button>'
  }

  var el =  '<div class="router-infowindow">'+
            '<div>'+previousBtnEl+'<span style="font-weight: bold;"> Router '+hop[1]+' </span>'+nextBtnEl+'<button id="flag-it-btn" data-asn="'+hop[0]+'" data-hop="'+hop[1]+'" data-ip="'+hop[6]+'" onclick="flagActiveRouter()"><span id="flag-btn-text">Flag router</span><img id="flag-btn-img" src="/images/icon-flag.png"/></button></div>'+
            '<div style="margin-top: 8px; font-weight: bold;">'+hop[10]+'</div>'+
            '<div style="font-weight: bold"><span>'+hop[8]+', '+hop[9]+'</span><span style="float: right;">'+hop[2]+', '+hop[3]+'</span></div>'+
            '<div style="margin-bottom: 20px"><span>'+hop[5]+'</span><span style="float: right;">'+starsEl+'</span></div>'+
            // '<div><a href="javascript:removeThis('+hop[0]+');">Remove This Route From Map</a></div>'+
            '<div><a href="javascript:removeAllButThis('+trId+');">Remove All but This Route</a></div>'+
            '<div><a href="javascript:viewTrDetails('+hop[0]+');">View Details of This Route (Id '+hop[0]+')</a></div>'+
            '</div>'

    return el;
}

var openNextRouterMarker = function(trId, index) {
  if (infowindow) {
    infowindow.close();
  }
  var el = createMarkerText(trId, infowindowRoute, index+1);
  infowindow = new google.maps.InfoWindow({
    content: el
  });
  infowindow.open(map,trOcollection[index+1]);       // no need to increment, because of arrays trOcollection and hop (in createMarkerText)
};

var openPreviousRouterMarker = function(trId, index) {
  if (infowindow) {
    infowindow.close();
  }
  var el = createMarkerText(trId, infowindowRoute, index-1);
  infowindow = new google.maps.InfoWindow({
    content: el
  });
  infowindow.open(map,trOcollection[index-1]);
};

var flagActiveRouter = function() {
  // this is a pretty sloppy, look into fixing it (eg passing params instead of using the DOM)
  var data = jQuery('#flag-it-btn').data();
  showFlags(data.asn, data.hop, data.ip, true);
};

var setTRidActive = function(id){
  jQuery('#tr-a-'+id).toggleClass('tr-ids-active');
};

var renderTr2 = function (trId) {
  var p = [];
  var skipHop;

  jQuery.each(ixMapsDataJson[trId], function(key, value) {
    // check router exclusions
    skipHop = excludeRouter(value, trId, key,0);

    if(!skipHop){
      //console.log(key +':'+ value.long+', '+value.lat);
      var a = new google.maps.LatLng(value.lat, value.long);
      p.push(a);
    }
  })

  if(activeTrObj!=null){
    activeTrObj.setMap(null);
  }
  var maxZidx = trCollection.length + 1;
  activeTrObj = null;

  var lineSymbol = {
    path: 'M 0,-0.5 0,0.5',
    strokeWeight: 4,
    strokeOpacity: 1,
    scale: 3
  };

  activeTrObj = new google.maps.Polyline({
  path: p,
  //strokeColor: '#912D55',
  //strokeColor: '#18BEC7',

  // transparent green
  //strokeOpacity: 0.4,
  //strokeColor: '#107C82',

  // solid black
  strokeOpacity: 0,
  //strokeColor: '#000000',
  strokeWeight: 13.0,
  icons: [{
    icon: lineSymbol,
    offset: '100%',
    repeat: '10px'}],
  zIndex: maxZidx
  });
  google.maps.event.addListener(activeTrObj, 'click', function() {
    trHopClick(trId,1,1);
  });
  activeTrObj.setMap(map);
};

var newIpFlag = function() {
  jQuery('#ip-flags-data').hide();
};

var saveIpFlag = function() {
  console.log("saving ip flag");

  // collect all error types
  var errTypes='';
  for(var i=1;i<7;i++){
    var a = jQuery('#ip-t-'+i).is(':checked');
    if(a){
      errTypes+=jQuery('#ip-t-'+i).val()+',';
    }
  }

  var obj = {
    action: 'saveIpFlag',
    ip_addr_f:activeIpFlag,
    user_ip:myIp,
    user_nick:getPar('user_nick'),
    user_reasons_types: errTypes,
    user_msg:getPar('user_msg'),
    ip_new_loc:getPar('ip_new_loc')
  };
  //console.log(obj);

  jQuery.ajax(url_base + '/application/controller/ipFlag.php', {
    type: 'post',
    data: obj,
    success: function (e) {
      console.log("Ok! saveIpFlag");
      alert('Thank you for flagging this router. We will review your suggestion and update our database accordingly. In the meantime, you can view traceroutes with flagged routers removed (these and other options are available through the Gear icon on the map');
      if(e==1){
        getIpFlags(true);
      }
    },
    error: function (e) {
      console.log("Error! saveIpFlag", e);
    }
  });
};

var getPar = function(par){
  var parVal=jQuery('#'+par+ '').val();
  return parVal;
};

var getIpFlags = function(openFlagWin) {
  console.log("getting ip flags data");

  var obj = {
    action: 'getIpFlag',
    ip_addr_f:activeIpFlag
  };

  jQuery.ajax(url_base + '/application/controller/ipFlag.php', {
    type: 'post',
    data: obj,
    success: function (e) {
      console.log("Ok! getIpFlag");
      var data = jQuery.parseJSON(e);

        if(openFlagWin){
          jQuery('#ip-flags').show();

          if(!data['ip_flags']){
            // jQuery('#ip-flag-info').html('');
            jQuery('#ip-flags-data-list').html('');
          } else {
            jQuery('#ip-flags-data').fadeIn('fast');
          }
          // testing this render router data all the times
          renderIpFlagData(data);
        } else {
          renderIpFlagDataMouseOver(data);
        }

    },
    error: function (e) {
      console.log("Error! getIpFlag", e);
    }
  });
};

var renderIpFlagDataMouseOver = function(data){
  console.log("renderIpFlagDataMouseOver");
  //console.log(e);

  // if(!data['ip_flags']){
  //   jQuery('#flagging-info-m').html('No Flags found.');
  //   flagTxt = '[Flag this]';
  // } else {
  //   var totFlags = data['ip_flags'].length;
  //   var geoCorrectStatus = 0;
  //   var flagTxt = '';

  //   flagTxt = '[Flagged]';
  //   jQuery('#flagging-info-m').html(totFlags+' Flags found');
  // }

  // var flagLinkHtml = '<a title="Flag this router if inaccurately located" class="text-new" href="javascript:flagActiveRouter();">'+flagTxt+'</a>';
  // jQuery('#flag-this-link').html(flagLinkHtml);
};

// var flagActiveRouter = function(){
//   showFlags(activeTridFlag, activeHopNumFlag, activeIpFlag, true);
// }

var renderIpFlagData = function(data){
  console.log('OK! renderIpFlagData');

  var ipInfo = data['ip_addr_info'][0];
  var lat = ipInfo.mm_lat;
  var lng = ipInfo.mm_long;
  // this could also be done with gl_override, but this feels safer
  if (ipInfo.mm_lat !== ipInfo.lat) {
    lat = ipInfo.lat;
  }
  if (ipInfo.mm_long !== ipInfo.long) {
    lng = ipInfo.long;
  }

  jQuery('#ip-flag-asn-name').text(ipInfo.name);        // maybe get shortname?
  jQuery('#ip-flag-hostname').text(ipInfo.hostname);
  jQuery('#ip-flag-star-rating').html(renderPrivacyScore(getPrivacyScore(ipInfo.num)));
  jQuery('#ip-flag-location').text(getCityRegionCountry(ipInfo.mm_city,ipInfo.mm_region,ipInfo.mm_country));
  jQuery('#ip-flag-lat-long').text(lat+', '+lng);
  jQuery('#ip-flag-ip-address').text(ipInfo.ip_addr);

  var flagsT = '';

  if(data['ip_flags']){
    flagsT += '<table id="ip-flags-table" style="width: 100%;" class="tablesorter tr-list-result"><thead><tr><th>User</th><th>Date</th><th>Suggested Location</th><th>Comment</th></thead><tbody>';

    jQuery.each(data['ip_flags'], function(key, value) {

      //flagsT+='<tr><td>'+value.user_nick+'</td><td>'+value.date_f+'</td><td>'+value.user_reasons_types+'</td><td>'+value.user_msg+'</td><td>'+value.ip_new_loc+'</td></tr>';
      flagsT += '<tr><td>'+value.user_nick+'</td><td>'+value.date_f.slice(0,10)+'</td><td>'+value.ip_new_loc+'</td><td>'+value.user_msg+'</td></tr>';
    });
    flagsT += '</tbody></table>';
  }
  jQuery('#ip-flags-data-list').html(flagsT);
  jQuery("#ip-flags-table").tablesorter({headers: {
    0:{sorter: false}, 1:{sorter: false}, 2:{sorter: false}, 3:{sorter: false}
  }});      // PUUUUUKE. Maybe we should update this lib?
}

var activeIpFlag = '';
var activeHopNumFlag = '';
var activeTridFlag = '';
var flagCounter = 0;

// new approach get data for this ip on demand, do not rely on tr hop number
//var showFlags = function(routerObj, openFlagWin) {
var showFlags = function(trId, hopN, ip, openFlagWin) {
  //jQuery('#tr-details-iframe').hide();    TODO: should this be included?
  // set var of active router
  activeIpFlag = ip;
  activeTridFlag = trId;
  activeHopNumFlag = hopN;

  console.log('ip: '+ip+', trId: '+trId+', hopH: '+hopN+'');
  //console.log(ixMapsDataJson[trId][hopN]);
  //flagCounter++;
  console.log('Displaying Flag info for ip: '+activeIpFlag);
  //console.log('flagCounter:', flagCounter);
  if(!openFlagWin) {
    jQuery('#flagging-info-m').html('Getting Flags...');
  }
  getIpFlags(openFlagWin);
}

var showFlagsOld = function(trId,hopN) {
  activeIpFlag = ixMapsDataJson[trId][hopN].ip;
  console.log('Displaying Flag info for ip: '+ixMapsDataJson[trId][hopN].ip);

  jQuery('#ip-flags').show();
  jQuery('#ip-flag-active').html(activeIpFlag);
  var ipInfo = '<table>';
  ipInfo += '';
  ipInfo += '<tr><td>IP:</td><td>'+ixMapsDataJson[trId][hopN].ip+'</td></tr>';
  ipInfo += '<tr><td>Carrier:</td><td>'+ixMapsDataJson[trId][hopN].asName+'</td></tr>';
  ipInfo += '<tr><td>ASN:</td><td>'+ixMapsDataJson[trId][hopN].asNum+'</td></tr>';
  ipInfo += '<tr><td>Country:</td><td>'+ixMapsDataJson[trId][hopN].mm_country+'</td></tr>';
  ipInfo += '<tr><td>City:</td><td>'+ixMapsDataJson[trId][hopN].mm_city+'</td></tr>';
  ipInfo += '</table>';
  //jQuery('#ip-flag-info').html(ipInfo);
  getIpFlags(true);
}

var trHopMouseover = function (trId,hopN,type) {
  //console.log('called trHopMouseover() TRid: '+trId+', hopNum:'+hopN);
  var ipTxt = '';
  var elTxt = '';
  var nextTxt = '';
  if(type==0){
    elTxt="Router"
    ipTxt = '<br/>IP: <strong>'+ixMapsDataJson[trId][hopN].ip+'</strong>';
    ipTxt += ' | <span id="flag-this-link"></span>';
  } else {
    elTxt = "Hop";
    var hopNext = parseInt(hopN);
    hopNext++;
    nextTxt = '-'+hopNext;
  }

  var h=''+''+elTxt+': <strong>'+hopN+nextTxt+'</strong><br/>Carrier: <strong>'+ixMapsDataJson[trId][hopN].asName+'</strong>, ASN: <strong>'+ixMapsDataJson[trId][hopN].asNum+'</strong>'+ipTxt;

  // add container for flag info on mouseover
  //h += '<div id="flagging-info-'+ixMapsDataJson[trId][hopN].ip+'">Getting flags for this IP...</div>';
  h += '<div id="flagging-info-m"></div>';
  //console.log(ixMapsDataJson[trId][hopN].asNum);
  jQuery('#map-info').html(h);
  //renderTr2(trId);
  activeTrId = trId;
}

var trHopClick = function (trId,hopN,type) {
  viewTrDetails(trId);
  //console.log('called trHopClick() TRid: '+trId+', hopNum:'+hopN);
  //viewTrDetails(trId);
  // removeTr();
  // renderTr2(trId);
  // var elTxt = '';
  // if(type==0){
  //   elTxt="Router"
  // } else {
  //   elTxt = "Hop";
  // }
  // //var h=elTxt+'<div>TRid: <strong>'+trId+'</strong>, '+elTxt+': <strong>'+hopN+'</strong>, ASN: <strong>'+ixMapsDataJson[trId][hopN].asNum+'</strong>, Carrier: <strong>'+ixMapsDataJson[trId][hopN].asName+'</strong></div>';

  // var h="";
  // h+='<div>';
  // h+='<div style="float:left;">TRid: <strong>'+trId+'</strong></div>';
  // h+='<div style="float:right;"><a href="javascript:viewTrDetails('+trId+');">View TR details</a> | <a href="javascript:removeAllButThis('+trId+');">Remove all but this</a></div>';
  // h+='</div>';

  // //jQuery('#map-tr-active').html(h);
  // jQuery('#map-tr-active').html(h);
}

var removeAllButThis = function(trId) {
  removeTr();
  removeAllTrs();

  showThisTr(trId);
/*  renderTr(trId);*/
}

// var removeThis = function(trId) {
//   removeTr();
// }

var viewPrivacy = function (asNum) {
  var privacyHtml = '';
  var criteriaDes = '';
  var totScore = 0;
  jQuery('#carrier-title').html('<h2>Transparency and Privacy Report:<span class="h2-bigger"> '+privacyData.scores[asNum][0].carrier_name+'</span></h2>ASN: '+privacyData.scores[asNum][0].asn);

  //privacyHtml += 'ASN: '+privacyData.scores[asNum][0].asn+'<br/>';
  privacyHtml += '<table>';
  privacyHtml += '<tr><td> </td><td><b>Criteria</b></td><td><b>Score</b></td></tr>';
  jQuery('#privacy-details').fadeIn('slow');
  jQuery.each(privacyData.scores[asNum], function(key,value) {
    //console.log(key, value);
    var score = parseFloat(value.score);
    totScore+=score;
    var scoreHtml = ''+value.score;
    if(score>0){
      scoreHtml = '<span class="privacy-score-col-non-zero">'+value.score+'</span>';
    }

    criteriaDes =  '<b>'+privacyData.stars[value.star_id].star_short_name+'</b> ';
    criteriaDes +=  ''+privacyData.stars[value.star_id].star_long_des+'';
    privacyHtml += '<tr><td>'+value.star_id+'</td><td>'+criteriaDes+'</td><td class="privacy-score-col">'+scoreHtml+'</td></tr>';

  });

  privacyHtml += '<tr><td></td>';
  privacyHtml += '<td>';
  privacyHtml += '<div id="privacy-feedback-info">To view the full interim report, including a comparison of all carriers rated, <a target="_new" href="'+privacyRepUrl+'">click here</a>.';
  privacyHtml += '<br/>';
  privacyHtml += 'To comment on this carrier rating, <a href="mailto: ixmaps@utoronto.ca?subject=IXmaps transparency feedback ['+privacyData.scores[asNum][0].carrier_name+']">click here</a>.</div>';
  privacyHtml += '<div id="privacy-total-label"><b>Total Score </b></div>';

  privacyHtml += '</td>';

  privacyHtml += '<td class="privacy-score-col"><span class="privacy-score-col-total">'+totScore+'</span></td>';

  privacyHtml += '</tr>';

  privacyHtml += '</table>';
  //privacyHtml += '<p></p>';
  jQuery('#privacy-details-data').html(privacyHtml);
};

var closePrivacy = function() {
  jQuery('#privacy-details').hide();
};

var viewTrDetails = function (trId) {
  renderTr2(trId);
  jQuery('#tr-details').fadeIn('slow');
  var url = url_base+'/cgi-bin/tr-query.cgi?query_type=traceroute_id&arg='+trId;
  jQuery('#tr-details-iframe').attr('src', url);
};

var closeTrDetails = function() {
  jQuery('#tr-details').hide();
  removeTr();
};

var getCityRegionCountry = function(city, region, country) {
  var location = '';
  var locArray = [];
  var first = true;

  if (city.length > 0) {
    locArray.push(city);
  }
  if (region.length > 0) {
    locArray.push(region);
  }
  if (country.length > 0) {
    locArray.push(country);
  }

  locArray.forEach(function(loc) {
    if (first) {
      location += loc;
      first = false;
    } else {
      location += ', ' + loc;
    }
  });

  return location;
};

var toggleMap = function(){
  jQuery('#map-container').toggle();
  jQuery('#map-canvas-container').toggle();
  jQuery('#tr-list-ids').toggle();
};

var initializeMap = function() {
  var myLatLng = new google.maps.LatLng(44, -99);
  var mapOptions = {
      scrollwheel: true,
      navigationControl: true,
      mapTypeControl: true,
      scaleControl: true,
      draggable: true,
      zoom: 4,
      center: myLatLng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);

  //document.location.href='#tot-trs';

/*  google.maps.event.addListener(map, 'click', function(event){
    //if(!mouse_in_polyline) {
      m_lat = event.latLng.lat();
      m_lng = event.latLng.lng()
        console.log('Lat: ' + m_lat + ' Lng: ' + m_lng);
        addCollectedCoord(m_lat,m_lng);
      //}
  });*/

}; // end initializeMap()


var getChotel = function() {
  console.log("Loading Chotel data");

  var obj = {
    action: 'getChotel'
  };

  jQuery.ajax(url_base + '/application/controller/getChotel.php', {
    type: 'post',
    data: obj,
    success: function (e) {
      console.log("Ok! getChotel");
      cHotelData = jQuery.parseJSON(e);
    },
    error: function (e) {
      console.log("Error! getChotel", e);
    }
  });
};

var renderGeoMarkers = function(type){
  jQuery.each(cHotelData, function(key,geoItem) {
    var gmObj;
    //console.log(geoItem);
    if(type==1 && geoItem.type=="NSA"){
      gmObj = createGmMarker(geoItem);
      gmNsa.push(gmObj);
      gmObj.setMap(map);
    }
    if(type==2 && geoItem.type=="CH"){
      gmObj = createGmMarker(geoItem);
      gmHotel.push(gmObj);
      gmObj.setMap(map);
    }
    if(type==3 && geoItem.type=="Google"){
      gmObj = createGmMarker(geoItem);
      gmGoogle.push(gmObj);
      gmObj.setMap(map);
    }
    if(type==4 && geoItem.type=="UC"){
      gmObj = createGmMarker(geoItem);
      gmUc.push(gmObj);
      gmObj.setMap(map);
    }

  });
};

var removeGeoMarkers = function(type){
  if(type==1){
    for (m in gmNsa)
    {
      //console.log(m);
      gmNsa[m].setMap(null);
    }
    gmNsa.length = 0;
  } else if(type==2){
    for (m in gmHotel)
    {
      //console.log(m);
      gmHotel[m].setMap(null);
    }
    gmHotel.length = 0;

  } else if(type==3){
    for (m in gmGoogle)
    {
      //console.log(m);
      gmGoogle[m].setMap(null);
    }
    gmGoogle.length = 0;

  } else if(type==4){
    for (m in gmUc)
    {
      //console.log(m);
      gmUc[m].setMap(null);
    }
    gmUc.length = 0;
  }
};

var createGmMarker = function(geoItem){
  //console.log(geoItem);
  //var coords = geoItem.coordinates.split(',');
  var mLatLong = new google.maps.LatLng(geoItem.lat,geoItem.long);
/*  var image = {
    url: geoItem.icon,
    // This marker is 20 pixels wide by 32 pixels tall.
    size: new google.maps.Size(20, 20),
    // The origin for this image is 0,0.
    origin: new google.maps.Point(0,0),
    // The anchor for this image is the base of the flagpole at 0,32.
    anchor: new google.maps.Point(0, 0)
  };*/
  var gmObj = new google.maps.Marker({
    position: mLatLong,
    map: map,
    //icon: image,
    title: geoItem.address
  });
  var iconUrl = '';
  if(geoItem.type=='NSA' && geoItem.nsa=='A') {
    iconUrl = url_base + '/images/nsa_class_A.png';
  } else if(geoItem.type=='NSA' && geoItem.nsa!='A') {
    iconUrl = url_base + '/images/nsamedium.png';
  } else if(geoItem.type=='CH') {
    iconUrl = url_base + '/images/carrierhotel_small.png';
  } else if(geoItem.type=='UC') {
    iconUrl = url_base + '/images/undersea1.png';
  } else if(geoItem.type=='Google') {
    iconUrl = url_base + '/images/google.png';
  }
  gmObj.setIcon(iconUrl);

  var cHtml = '<b>'+geoItem.address+'</b>';
  if(geoItem.image!=''){
    cHtml += '<br/><img src="'+geoItem.image+'" width="100px"/></a>';
  }
  if(geoItem.isp_src!=''){
    cHtml += '<br/><a href="'+geoItem.isp_src+'">ISP</a>';
  }

  if(geoItem.ch_operator!=''){
    cHtml += '<br/>Operator: <b>'+geoItem.ch_operator+'</b>';
  }
  if(geoItem.nsa_src!=''){
    cHtml += '<br/><a href="'+geoItem.nsa_src+'">NSA Source</a>';
  }
  if(geoItem.ch_build_owner!=''){
    cHtml += '<br/>Building Owner: <b>'+geoItem.ch_build_owner+'</b>';
  } else if(geoItem.ch_build_owner!='' && geoItem.ch_build_owner_src!=''){
    cHtml += '<br/>Building Owner: <a href="'+geoItem.ch_build_owner+'"></a>';
  }
    var infoW = new google.maps.InfoWindow({
    content: cHtml
  });

  google.maps.event.addListener(gmObj, 'click', function() {
    infoW.open(map,gmObj);
  });

  return gmObj;
};

var getPrivacyReport = function(){
  console.log('Loading PrivacyReport data');

  var obj = {
    action: 'getPrivacyReport'
  };

  jQuery.ajax(url_base + '/application/controller/privacyReport.php', {
    type: 'post',
    data: obj,
    success: function (e) {
      console.log("Ok! getPrivacyReport");
      privacyData = jQuery.parseJSON(e);
      //console.log(privacyData);
          //console.log("star id 10 = ", privacyData.stars[10]);
      //console.log(privacyData.stars);
      //console.log(privacyData.scores[812]);
          //console.log('asn: 812 = ', privacyData.scores[812][0].score);
      //var cS = console.log(privacyData.scores[812][0].star_id);
      //console.log(privacyData.stars[cS]);
      //console.log(privacyData.stars[1]);

      /*var s = getPrivacyScore(6327);
      var sHtml = renderPrivacyScore(2.5);*/

    //console.log('object not');
    //console.log('= ', privacyData.scores[100]);

    },
    error: function (e) {
      console.log("Error! getPrivacyReport", e);
    }
  });
};

var getPrivacyScore = function(asn){
  var score = 0;
  if (privacyData.scores[asn]) {
    jQuery.each(privacyData.scores[asn], function(key,value) {
     //console.log(key, value);
     var s = parseFloat(value.score);
     score += s;
    });
  }
  return score;
};

var renderPrivacyScore = function(asnScore){
  //console.log('renderPrivacyScore ... START');

  // get num of full and partial stars
  var scoreInt = 0;
  var scoreF = 0
  var scoreD = parseFloat(asnScore);
  scoreInt = parseInt(asnScore);
  scoreF = asnScore - scoreInt;

  /*console.log('asnScore: ', asnScore);
  console.log('scoreInt: ', scoreInt);
  console.log('scoreF: ', scoreF);*/

  var starHtml = '';

  if(scoreInt>=1){
    // add full stars
    for (var i = 0; i < scoreInt; i++) {
      starHtml += '<img src="'+url_base+'/images/star-a-4.png" class="privacy-star-img">';
    }
  }

  // add stars 0
  if(scoreD==0){
    starHtml += '<img src="'+url_base+'/images/star-a-0.png" class="privacy-star-img">';
  }

  // add fraction stars
  if(scoreF>0 && scoreF<=0.5){
    starHtml += '<img src="'+url_base+'/images/star-a-2.png" class="privacy-star-img">';
    //console.log('star 0.25-0.50');

  //} else if(scoreF>0.50 && scoreF<=0.75){
    //starHtml += '<img src="'+url_base+'/images/star-3.png" class="privacy-star-img">';
    //console.log('star 0.50-0.75');

  //} else if(scoreF>0.5 && scoreF<1){
    //starHtml += '<img src="'+url_base+'/images/star-3.png" class="privacy-star-img">';
    //console.log('star 0.75-1');
  }

  //console.log('starHtml ...',starHtml);
  return starHtml;
};

