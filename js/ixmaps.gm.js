/*
	IXmaps google maps global vars and init scripts
*/
var allowMultipleTrs = false; // !!
var allowRecenter = true;

var showHops = true;
var showHopsNum = false;
var showRouters = true;
var addMarkerInOrigin = false;


var showDynamicLegend = true; // !!
var showMapInfoGlobal = false;

var excludeCoord0 = true;
var excludeCoordGen = true;
var excludeImpDist = true; 
var excludeReservedAS = true; 
var excludeUserFlaged = false; // not implemented 
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

var totTRs = 0;
var activeCarriers = new Object();
var coordCollected = [];
var coordCollectedObj = [];

// not implemented yet ;)
var setMapToFullScreen = true; // this involves having all the other info in absolute positioning
/*var excluedeUntrustedTrs  = true; //e.g. excluede TRs flaged by users
*/
var addMarkerInLastHop = true; // Not implemented
var addMarkerInDesination = true; // 

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
}

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

}

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
}

          


var setShowHops = function(){
  if(showHops){
    showHops=false;
    jQuery("#map-show-hops").removeClass("map-tool-on").addClass("map-tool-off");
  } else {
    showHops=true;
    jQuery("#map-show-hops").removeClass("map-tool-off").addClass("map-tool-on");
  }
console.log('setShowHops',showHops);
}

var setShowHopsNum = function(){
  if(showHopsNum){
    showHopsNum=false;
    jQuery("#map-show-hops-num").removeClass("map-tool-on").addClass("map-tool-off");
  } else {
    showHopsNum=true;
    jQuery("#map-show-hops-num").removeClass("map-tool-off").addClass("map-tool-on");
  }
console.log('setShowHopsNum',showHops);
}



var setAllowRecenter = function(){
  if(allowRecenter){
    allowRecenter=false;
    jQuery("#map-allow-recenter").removeClass("map-tool-on").addClass("map-tool-off");
  } else {
    allowRecenter=true;
    jQuery("#map-allow-recenter").removeClass("map-tool-off").addClass("map-tool-on");
  }
console.log('setAllowRecenter',allowRecenter);
}

var setShowRouters = function(){
  if(showRouters){
    showRouters=false;
    jQuery("#map-show-routers").removeClass("map-tool-on").addClass("map-tool-off");
  } else {
    showRouters=true;
    jQuery("#map-show-routers").removeClass("map-tool-off").addClass("map-tool-on");
  }
console.log('setShowRouters',showRouters);
}

var setAddMarkerInOrigin = function(){
  if(addMarkerInOrigin){
    addMarkerInOrigin=false;
    jQuery("#map-show-marker-origin").removeClass("map-tool-on").addClass("map-tool-off");
  } else {
    addMarkerInOrigin=true;
    jQuery("#map-show-marker-origin").removeClass("map-tool-off").addClass("map-tool-on");
  }
console.log('setAddMarkerInOrigin',addMarkerInOrigin);
}

var setAllowMultipleTrs = function(){
  if(allowMultipleTrs){
    allowMultipleTrs=false;
    jQuery("#map-allow-multiple").removeClass("map-tool-on").addClass("map-tool-off");
    jQuery('#map-core-controls').hide();
    jQuery('#map-action-remove-all-but-this').hide();
    
  } else {
    allowMultipleTrs=true;
    jQuery("#map-allow-multiple").removeClass("map-tool-off").addClass("map-tool-on");
    jQuery('#map-core-controls').show();
    jQuery('#map-action-remove-all-but-this').show();
  }
console.log('setAllowMultipleTrs',allowMultipleTrs);
}

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
}

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
}

var excludeD = function(){
  if(excludeReservedAS){
    excludeReservedAS=false;
    jQuery("#map-exclude-d").removeClass("map-tool-on").addClass("map-tool-off");
  } else {
    excludeReservedAS=true;
    jQuery("#map-exclude-d").removeClass("map-tool-off").addClass("map-tool-on");
  }
console.log('exclude Reserved AS.',excludeReservedAS);
}

var excludeE = function(){
  if(excludeUserFlaged){
    excludeUserFlaged=false;
    jQuery("#map-exclude-e").removeClass("map-tool-on").addClass("map-tool-off");
  } else {
    excludeUserFlaged=true;
    jQuery("#map-exclude-e").removeClass("map-tool-off").addClass("map-tool-on");
  }
console.log('exclude User Flaged routers.',excludeUserFlaged);
alert('This option has not been implemented.');
}

var loadMapData = function () {
  
  // reset user activity on data set every time a new set is loaded 
  userActivityOnTrSet = new Object();

  ixMapsDataJson = jQuery.parseJSON(ixMapsData);
  var c = 0;
  jQuery.each(ixMapsDataJson, function(trId, value) {
    c++;
  });
  totTRs = c;
  console.log('IXmaps geographic data downloaded! ['+totTRs+']');
  for (first in ixMapsDataJson) break;
  //console.log('showing the first TR', first);
  
  // wait a bit before loading the fist TRid and other functions
  setTimeout(function(){ 
    initializeMap();
    console.log('Google map canvas initialized !');
    showThisTr(first); 
    setTableSorters();
  }, 300);
  
  //jQuery('#map-legend').draggable();
  //jQuery('#map-actions-container').draggable();
  //jQuery('#map-stats-container').draggable();
  
//  jQuery('#tr-list-ids').draggable();
  jQuery('#tr-details').draggable();

  // to prevent confussion remove all after load 
  removeAllTrs();
}

var setTableSorters = function(){
  console.log('Sorting TR Tables');
  jQuery("#tr-list-table").tablesorter(); 
}

var showTotalTrInfo = function(){
  var t2=trCollection.length;

  if(showDynamicLegend) {
    var carriers = '<table id="dynamic-legend" style="width: 100%;" class="tablesorter tr-list-result"><thead><tr><th>asn</th><th>Carrier</th><th># of routers</th>';
    
    // mock up
    carriers+='<th>Nat.</th><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th>';
    
    carriers+='</tr></thead><tbody>';
    jQuery.each(activeCarriers, function(asNum, d) {
      //console.log(asNum,d)
      carriers+='<tr><td class="asn-color-text" style="background-color:#'+getAsnColour(asNum)+'"><span class="asn-num-hops">'+asNum+'</span></td><td>'+d[1]+'</td><td class="asn-color-text">'+d[0]+'</td>';
      
      // mock up data
      carriers+='<td>xx</td><td>X</td><td>X</td><td>X</td><td>X</td><td>X</td>';

      carriers+='</tr></tr>';
    });
    carriers+='</tbody></table>';
    jQuery('#map-legend').html(carriers);
    if(t2!=0) {
      jQuery("#dynamic-legend").tablesorter({sortList: [[2,1]]} ); 
    }
    
  }

  //jQuery('#map-info-total').html('Total TRs: '+totTRs+' : Active Hops: '+t2);
  jQuery('#map-info-total').html('Displayed # of Hops: <strong>'+t2+'</strong>');
}

var showThisTr = function (trId) { 
  
  if(!allowMultipleTrs){
    removeAllTrs();
  }
  renderTr(trId);
  showTotalTrInfo();
}

var stopRender = function(){
  
  if(trRenderStop){
    jQuery('#map-render-stop-play').val('Stop');
    trRenderStop = false;
  } else {
    jQuery('#map-render-stop-play').val('Play');
    trRenderStop = true;
  }
  console.log('stopRender', trRenderStop);
}
var ckeckIfStoped = function() {
  console.log('... Checking trRenderStop');
  return trRenderStop;

}

var addAllTrs = function () {
  removeAllTrs();
  jQuery('#map-status-info').show();
  
  //jQuery('#map-loading-status').html('');
  //var totR = totTRs;

  var conn=1;
  var time = trRenderSpeed;
  var lastId;

  jQuery.each(ixMapsDataJson, function(trId, value) {
    
    var a = ckeckIfStoped();

    setTimeout(function(){ 
      if(trRenderStop){
        //console.log('.... stop function run');
        return false;
      } else { 

        renderTr2(trId);  
        showThisTr(trId);
        jQuery('#map-loading-status').html('<b>'+conn+'</b> of '+ totTRs);
        conn++;
      }
    }, time);

      time += trRenderSpeed;
  });
  // remove last
  removeTr();

  showTotalTrInfo();
  //jQuery('#map-status-info').hide();
}

var removeAllTrs = function () {
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
  jQuery('#map-info').html('');
}

var removeTr = function () {
  //console.log('removing active tr');
  if(activeTrObj!=null){
      activeTrObj.setMap(null);
    }
}

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
  jQuery('#map-impossible-distance-log').html(impDistLog);
  return skipHop;  
}


var renderTr = function (trId) {
  var hopObj = null;
  var p = [];
  var hops=[];
  var coordinates = [];
  var skipHop = false;
  var trInMap = false;
  var trInMapHtml = '';
  var trActiveHtml = '';
  //var skipHopNum = {"coord0:0","Generic Coords:0","Reserved AS:0"};

  var originCoords;

  // need to reset activeCarriers and other vars 
  if(!allowMultipleTrs){
    skippedRouterNum = new Array(0,0,0,0);
    trRouterCount = 0;
    trRouterAdded = 0;
  }

  if(trsAddedToMap.indexOf(trId) != -1){
    trInMap = true;
    //console.log('The TR ('+trId+') is already in the map');
    trInMapHtml = 'The TR is already in the map';
  } else {
    trsAddedToMap.push(trId);
  }
  //console.log('TRs in the map', trsAddedToMap);

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
        var a = new Array(trId, hop, value.lat, value.long, value.asNum, value.asName, value.ip, value.gl_override);
        //google.maps.LatLng(value.lat, value.long);
        
        if(value.asNum in activeCarriers){
          activeCarriers[value.asNum][0]+=1;
        } else {
          activeCarriers[value.asNum]=Array(1,value.asName);
        }
        p.push(a);
        trRouterAdded++;
        
      }

      trRouterCount++;

    });

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
          O_m.setMap(map);
          trOcollection.push(O_m);
      } 

      if(showRouters){
        var markColour = '#'+ getAsnColour([p[index][4]]);
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
            

            title: "'IP: "+p[index][6]+", gl_override: "+p[index][7]+"'"


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
              trHopClick(p[index][0],p[index][1],0);
          });
          google.maps.event.addListener(routerMark, 'mouseover', function() {
              trHopMouseover(p[index][0],p[index][1],0);
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

          var colour = '#'+ getAsnColour([p[index-1][4]]);
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
          google.maps.event.addListener(hopObj, 'mouseout', function() {
              trHopMouseout(p[index-1][0],p[index-1][1]);
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
  	  var bounds = new google.maps.LatLngBounds();
  	  for (var i = 0; i < coordinates.length; i++) {
  	      bounds.extend(coordinates[i]);
  	  }
  	  coordinates.length = 0;
      map.fitBounds(bounds);
    }
} // end if tr in map

  //jQuery('#map-info').html('TRid: <strong>'+trId+'</strong>');

  if(!trInMap){
    trActiveHtml += 'TR added';
  } else {
    trActiveHtml += trInMapHtml;
  }
  
  var h="";
  h+='<div>';
  h+='<div style="float:left;">TRid: <strong>'+trId+'</strong></div>';
  h+='<div style="float:right;"><a href="javascript:viewTrDetails('+trId+');">View TR details</a> <span id="map-action-remove-all-but-this" class="hide">| <a href="javascript:removeAllButThis('+trId+');">Remove all but this</a></span></div>';
  h+='</div>';

  //trActiveHtml = h'<br/> TRid: <strong>'+trId+'</strong> | <a href="javascript:viewTrDetails('+trId+');">View TR details</a> | <a href="javascript:removeAllButThis('+trId+');">Remove all but this</a>';

  var totRoutersSkipped = skippedRouterNum[0]+skippedRouterNum[1]+skippedRouterNum[2]+skippedRouterNum[3];

  var routerExcHtml = '';
  routerExcHtml = '';

  routerExcHtml += 'Tot routers added: <strong>' + trRouterAdded+'</strong>';
  routerExcHtml += '<br/>Tot routers excluded: <strong>' + totRoutersSkipped+'</strong>';
  routerExcHtml += '<br/><br/><strong>Router excluded details:</strong>';
  routerExcHtml += '<br/>Lat/Log = 0: <strong>' + skippedRouterNum[0]+'</strong>';
  routerExcHtml += '<br/>Generic Location: <strong>' + skippedRouterNum[1]+'</strong>';
  routerExcHtml += '<br/>Impossible Distance: <strong>' + skippedRouterNum[2]+'</strong>';
  routerExcHtml += '<br/>Reserved AS: <strong>' + skippedRouterNum[3]+'</strong>';

  jQuery('#map-tr-active').html(h);
  jQuery('#map-router-exclusion').html(routerExcHtml);

  removeTr();

}
var setTRidActive = function(id){
  jQuery('#tr-a-'+id).toggleClass('tr-ids-active');
}

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
  strokeOpacity: 0.4,
  //strokeColor: '#107C82',

  // solid black
  //strokeOpacity: 0,
  strokeColor: '#000000',  
  strokeWeight: 13.0,
  /*icons: [{
    icon: lineSymbol,
    offset: '100%',
    repeat: '10px'}],*/
  zIndex: maxZidx 
  });
  google.maps.event.addListener(activeTrObj, 'click', function() {
    trHopClick(trId,1,1);
  });
  activeTrObj.setMap(map);
}

var trHopMouseout = function (trId,hopN) {
  /*removeTr();*/
}

var trHopMouseover = function (trId,hopN,type) {
  //console.log('called trHopMouseover() TRid: '+trId+', hopNum:'+hopN);
  var ipTxt = '';
  var elTxt = '';
  if(type==0){
    elTxt="Router"
    ipTxt = '<br/>IP: <strong>'+ixMapsDataJson[trId][hopN].ip+'</strong>';
    ipTxt += ' | Total Routers with this IP: <b>'+ ipCollection[ixMapsDataJson[trId][hopN].ip]+'</b> <span class="text-new">[New feature]</span>';
  } else {
    elTxt = "Hop";
  }

  var h='['+elTxt+'] '+'TRid: <strong>'+trId+'</strong>, '+elTxt+': <strong>'+hopN+'</strong>, ASN: <strong>'+ixMapsDataJson[trId][hopN].asNum+'</strong> <br/>Carrier: <strong>'+ixMapsDataJson[trId][hopN].asName+'</strong>'+ipTxt;
  //console.log(ixMapsDataJson[trId][hopN].asNum);
  jQuery('#map-info').html(h);
  //renderTr2(trId);
  activeTrId = trId;
}

var trHopClick = function (trId,hopN,type) {
  //console.log('called trHopClick() TRid: '+trId+', hopNum:'+hopN);
  //viewTrDetails(trId);
  removeTr();
  renderTr2(trId);
  var elTxt = '';
  if(type==0){
    elTxt="Router"
  } else {
    elTxt = "Hop";
  }
  //var h=elTxt+'<div>TRid: <strong>'+trId+'</strong>, '+elTxt+': <strong>'+hopN+'</strong>, ASN: <strong>'+ixMapsDataJson[trId][hopN].asNum+'</strong>, Carrier: <strong>'+ixMapsDataJson[trId][hopN].asName+'</strong></div>';
  
  var h="";
  h+='<div>';
  h+='<div style="float:left;">TRid: <strong>'+trId+'</strong></div>';
  h+='<div style="float:right;"><a href="javascript:viewTrDetails('+trId+');">View TR details</a> | <a href="javascript:removeAllButThis('+trId+');">Remove all but this</a></div>';
  h+='</div>';

  //jQuery('#map-tr-active').html(h);
jQuery('#map-tr-active').html(h);

  
}

var removeAllButThis = function(trId) {
  removeTr();
  removeAllTrs();

  showThisTr(trId);
/*  renderTr(trId);*/
}

var viewTrDetails = function (trId) {
  renderTr2(trId);
  jQuery('#tr-details').fadeIn('slow');
  var url = 'http://ixmaps.ischool.utoronto.ca/cgi-bin/tr-query.cgi?query_type=traceroute_id&arg='+trId;
  jQuery('#tr-details-iframe').attr('src', url);
};

var closeTrDetails = function () {
  jQuery('#tr-details').hide();
  removeTr();
};

var toggleMap = function(){
  jQuery('#map-container').toggle();
  jQuery('#map-canvas-container').toggle();
  jQuery('#tr-list-ids').toggle();
  
}

var initializeMap = function() {
  var myLatLng = new google.maps.LatLng(44, -99);
  var mapOptions = {
      scrollwheel: true,
      navigationControl: true,
      mapTypeControl: false,
      scaleControl: true,
      draggable: true,
      zoom: 4,
      center: myLatLng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);

  document.location.href='#tot-trs';

/*  google.maps.event.addListener(map, 'click', function(event){
    //if(!mouse_in_polyline) {
      m_lat = event.latLng.lat();
      m_lng = event.latLng.lng()
        console.log('Lat: ' + m_lat + ' Lng: ' + m_lng);
        addCollectedCoord(m_lat,m_lng);
      //}
  });*/

} // end initializeMap()