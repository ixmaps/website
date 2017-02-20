var activeInfo = 0;

// keeps track of what filter line we're on (rows will not always be sequential numbers, since deletions can occur)
var filterCounter = 1;

// keeps track of when first load housekeeping functions
var firstLoad = true;

// define ajax object for query submit
var ajaxObj;

// autocomplete arrays (to be filled with ajax call to backend)
var countryTags = [];
var regionTags = [];
var cityTags = [];
var zipCodeTags = [];
var ISPTags = [];
var ASnumTags = [];
var submitterTags = [];
var zipCodeSubmitterTags = [];
var destHostNameTags = [];
var ipAddressTags = [];
var hostNameTags = [];
var trIdTags = [];

var initialize = function() {
  // default settings
  jQuery(function() {
    jQuery( document ).tooltip();
  });

  jQuery('#news-btn').click(function() {
    window.open("/documents/Keeping_Internet_Users_Summ_review_App_final_Jan_27.pdf","_newtab");
  });

  // onclick events
  jQuery('#remove-all-trs-btn').click(function() {
    removeAllTrs();
  });

  jQuery('#add-all-trs-btn').click(function() {
    addAllTrs();
  });

  jQuery('.ql-button').click(function() {
    jQuery('.ql-button').removeClass('selected');
    jQuery(this).addClass('selected');
  });

  jQuery('#options-btn').click(function() {
    jQuery('.map-icon-popup-container').hide();
    jQuery('#options-container').toggle();
  });

  jQuery('#layers-btn').click(function() {
    jQuery('.map-icon-popup-container').hide();
    jQuery('#layers-container').toggle();
  });

  jQuery('#help-btn').click(function() {
    jQuery('.map-icon-popup-container').hide();
    jQuery('#help-container').toggle();
  });

  jQuery('.map-icon-close-btn').click(function() {
    jQuery('.map-icon-popup-container').hide();
  });

  jQuery('#close-ip-flags').click(function() {
    jQuery('#ip-flags-data').hide();
    jQuery('#ip-flags').fadeOut('fast');
  });

  jQuery('#tr-details-close-btn').click(function() {
    jQuery('#tr-details').hide();
    removeTr();
  });

  jQuery('#privacy-details-close-btn').click(function() {
    jQuery('#privacy-details').hide();
  });

  jQuery('#last-submission-button').click(function() {
    // we clear here so that if they've previousy chosen another quick select, the selectors will be (slightly) less inaccurate (since they won't reset with last/recent). I haven't bothered with the dropdowns, since we will eventually be adding a time related dropdown which will render this all moot
    jQuery('#filter-constraint-1 .ui-autocomplete-input').val('');
    submitLastSubmissionObject();
  });

  jQuery('#recent-routes-button').click(function() {
    // we clear here so that if they've previousy chosen another quick select, the selectors will be (slightly) less inaccurate (since they won't reset with last/recent). I haven't bothered with the dropdowns, since we will eventually be adding a time related dropdown which will render this all moot
    jQuery('#filter-constraint-1 .ui-autocomplete-input').val('');
    submitRecentRoutesObject();
  });

  jQuery('#my-city-button').click(function() {
    jQuery('#process-filters-button').effect("highlight", {}, 3000);
    submitMyCityObject();
  });

  jQuery('#my-country-button').click(function() {
    jQuery('#process-filters-button').effect("highlight", {}, 3000);
    submitMyCountryObject();
  });

  jQuery('#all-boomerangs-button').click(function() {
    jQuery('#process-filters-button').effect("highlight", {}, 3000);
    submitBoomerangObject();
  });

  jQuery('#contain-NSA-button').click(function() {
    jQuery('#process-filters-button').effect("highlight", {}, 3000);
    submitNSAObject();
  });

  jQuery('#my-isp-button').click(function() {
    jQuery('#process-filters-button').effect("highlight", {}, 3000);
    submitMyISPObject();
  });

  jQuery('#non-US-button').click(function() {
    jQuery('#process-filters-button').effect("highlight", {}, 3000);
    submitNonUSObject();
  });

  jQuery('#pratt-origin-button').click(function() {
    jQuery('#process-filters-button').effect("highlight", {}, 3000);
    submitPrattOriginObject();
  });

  jQuery('#submitted-by-button').click(function() {
    jQuery('#filter-constraint-1 .ui-autocomplete-input').effect("highlight", {}, 3000);
    submitSubmittedBy();
  });

  jQuery('#submitted-from-button').click(function() {
    jQuery('#filter-constraint-1 .ui-autocomplete-input').effect("highlight", {}, 3000);
    submitSubmittedFrom();
  });

  jQuery('#process-filters-button').click(function() {
    processFilters();
  });

  jQuery('#reset-filters-button').click(function() {
    console.log('resetting...')
    resetFilterConstraints();
  });

  jQuery('#custom-filters-more-button').click(function() {
    toggleText();
  });

  jQuery('#filter-results-summary-container').click(function() {
    jQuery('#filter-results-summary').toggle();
  });

  jQuery('#cancel-query').click(function() {
    cancelQuery();
    hideLoader();
  });

  jQuery('#userloc-close-btn').click(function() {
    jQuery('#userloc').hide();
    submitUserLocObject();
  });

  jQuery('#userloc-find-creepy-btn').click(function() {
    jQuery('#userloc-creepy-explanation').toggle();
  });

  // add the first row of constraints
  addFilterConstraint();

  // load autocomplete data from db and populate js arrays
  loadAutoCompleteData('country', ' ');
  loadAutoCompleteData('region', ' ');
  loadAutoCompleteData('city', ' ');
  loadAutoCompleteData('zipCode', ' ');
  //loadAutoCompleteData('asnum', ' ');
  loadAutoCompleteData('ISP', ' ');
  loadAutoCompleteData('submitter', ' ');


  jQuery('#cancel-query').click(function() {
    cancelQuery();
    hideLoader();
  });

  // flip settings for this version
  setAllowMultipleTrs();
  //excludeE();       // c'mon, for serious?

  // since we now want the last submitted route to be shown on landing - now switching to user loc (see userloc-close-btn)
  //submitLastSubmissionObject();
  // show button as selected
  //jQuery('#last-submission-button').addClass('selected');
}

var submitNSAObject = function() {
  resetFilterConstraints();
  var nsaCities = new Array("San Francisco", "Los Angeles", "New York", "Dallas", "Washington", "Ashburn", "Seattle", "San Jose", "San Diego", "Miami", "Boston", "Phoenix", "Salt Lake City", "Nashville", "Denver", "Saint Louis", "Bridgeton", "Bluffdale", "Houston", "Chicago", "Atlanta", "Portland");
  var a;

  var c = 0;
  var fixedFilterC;
  jQuery.each(nsaCities, function(key, value) {
    // set the first
    if(c==0){
      a = jQuery('#filter-constraint-1 .constraint');
      jQuery(a[1]).val('contain');
      jQuery(a[2]).val('city');
      jQuery(a[3]).val(value);
      jQuery(a[4]).val('OR');
    } else {
      addFilterConstraint();
      fixedFilterC = filterCounter-1;
      a = jQuery('#filter-constraint-'+fixedFilterC+' .constraint');
      jQuery(a[1]).val('contain');
      jQuery(a[2]).val('city');
      jQuery(a[3]).val(value);
      jQuery(a[4]).val('OR');
    }
    c++;
    console.log('adding constraint');
  });
}

var addFilterConstraint = function () {
  // creating the row
  var filterLine = "<div class='filter-item'>";
  filterLine += "<select class='constraint' class='hidden'>";
  filterLine += "<option value='does'>Does</option>";
  filterLine += "<option value='doesNot'>Does not</option>";
  filterLine += "</select>";

  filterLine += "<select class='constraint'>";
  filterLine += "<option value='originate'>Originate in</option>";
  filterLine += "<option value='terminate'>Terminate in</option>";
  filterLine += "<option value='goVia'>Go Via</option>";
  filterLine += "<option value='contain'>Contain</option>";
  filterLine += "</select>";

  filterLine += "<select class='constraint constraint-dropdown'>";
  filterLine += "<option value='submitter'>Submitter Name</option>";
  filterLine += "<option value='zipCodeSubmitter'>Submitter Postcode</option>";
  filterLine += "<option value='trId'>Traceroute Id</option>";
  filterLine += "<option value='ipAddr'>IP Address</option>";
  filterLine += "<option value='asnum'>AS Number</option>";
  filterLine += "<option value='hostName'>Hostname</option>";
  filterLine += "<option value='ISP'>ISP/Carrier</option>";
  filterLine += "<option value='country'>Country</option>";
  filterLine += "<option value='region'>Province/State</option>";
  filterLine += "<option value='zipCode'>Postcode</option>";
  filterLine += "<option value='city'>City</option>";
  filterLine += "<option value='destHostName'>Destination Hostname</option>";
  //filterLine += "<option value='NSA'>NSA</option>";
  filterLine += "</select>";
  filterLine += "<input class='constraint constraint-text-entry' type='text'/>";
  filterLine += "</div>";
  filterLine = jQuery(filterLine);
  // maybe add an 'order by' dropdown? Order by: Id, Date/Time submitted, Submitter? Other?

  containerId = 'filter-constraint-' + filterCounter;
  jQuery(filterLine).attr('id', containerId);

  // creating the and/or dropdown for the row
  var booleanFilter = jQuery("<select class='constraint'><option value='AND'>AND</option><option value='OR'>OR</option></select>");
  booleanFilterId = 'boolean-constraint-' + filterCounter;
  jQuery(booleanFilter).attr('id', booleanFilterId);

  // creating the delete button for the row, but not for the first row
  if (filterCounter > 1) {
    var deleteButton = jQuery("<button class='delete-button'>X</button>");
    buttonId = 'delete-button-' + filterCounter;
    jQuery(deleteButton).attr('id', buttonId);
    // adding delete button click handler
    jQuery(deleteButton).click(function(event) {
      removeFilterConstraint(jQuery('#'+event.target.id).parent());
    });
  }

  // creating the add button for the row
  var addButton = jQuery("<button class='add-button'><b>+</></button>");
  jQuery(addButton).click(function(event) {
    addFilterConstraint();
  })

  // adding the elements to the row
  jQuery(filterLine).append(booleanFilter);
  jQuery(filterLine).append(addButton);
  jQuery(filterLine).append(deleteButton);
  jQuery('#filter-container').append(filterLine);

  // adding the autocompletes to the text inputs
  var rowId = "#filter-constraint-" + filterCounter;

  // bind data for country as default
  bindAutocompletes('country', rowId);

  // on change approach
  jQuery('.constraint-dropdown').change(function(ev) {
    // FIXME: we need to capture here the actual rowId, so we don't run bindAutocompletes for all the constraint-dropdown(s).
    //jQuery('.constraint-text-entry').val('');
    bindAutocompletes(jQuery(ev.target).val(), rowId);
  });

  // if the dropdown has not changed on this row, but on another
  jQuery('.constraint-text-entry').click(function(ev) {
    var type = jQuery(ev.target.previousSibling).val();
    bindAutocompletes(type, rowId);
  });

  // ANTO: key down approch

/*  jQuery('input.constraint:text').keyup(function(e) {
    vMin = 1;
    var a = jQuery(this).val();
    var b = jQuery(this).parent("div").attr("id");
    var c = jQuery(this).prev('.constraint').val();

    console.log('key... '+a+' : '+b+' : '+c);
    console.log(c+':'+a.length);
    // ANTO: autocomplete functional for the following
    if((c=='city' || c=='country' || c=='region') && a.length>=vMin) {
      loadAutoCompleteData(c,a);
    }

    if (a.length==0) {
      jQuery('#autocomplete-data').html('');
    }


    // on hit enter
    code = (e.keyCode ? e.keyCode : e.which);
    if (code == 13) {
      //alert('Enter key was pressed.');
      jQuery('#process-filters-button').focus();
    }

  });*/

  // increment the counter to get ready for the next row
  filterCounter++;
};

var removeFilterConstraint = function(rowId) {
  console.log('removing row...');
  jQuery(rowId).remove();
};

var removeAllFilterConstraints = function() {
  jQuery('.constraint').removeClass('blank-field-error');

  _.each(jQuery('.filter-item'), function(item) {
    if (jQuery(item).attr('id') != 'filter-constraint-1') {
      removeFilterConstraint(jQuery(item));
    }
  });
};

var clearFilterValues = function() {
  _.each(jQuery('.constraint'), function(constraint) {
    jQuery(constraint).val('');
  });
};

var resetFilterConstraints = function() {
  removeAllFilterConstraints();
  clearFilterValues();
};

// get ready for submission, do the error checking and go through each field to construct the data object
var processFilters = function() {
  var submission = {};
  var i = 0;
  var errorCount = 0;

  // clear the error fields
  jQuery('.constraint').removeClass('blank-field-error');
  _.each(jQuery('.filter-item'), function(item) {
    i = 0;
    constraint = {};

    _.each(jQuery(item).children('.constraint'), function(c) {
      i++;
      if (jQuery(c).val()) {
        constraint['constraint'+i] = jQuery(c).val();
      } else {
        // highlight unfilled fields
        errorCount++;
        jQuery(c).addClass('blank-field-error');
      }
    });

    // one line of filters
    submission[jQuery(item).attr('id')] = constraint;
  });

  // if there are no errors, submit
  if (errorCount === 0) {
    submitQuery(submission);
  } else {
    alert('One or more fields were not filled. Submission canceled');
  }
};

var submitQuery = function(obj) {
  console.log('Submitting...');
  submittedObj = obj;
  // jQuery('#map-canvas-container').hide();
  // jQuery('#map-container').hide();
  // jQuery('#filter-results').hide();
  jQuery('#filter-results-log').html('');
  /*jQuery('#map-core-controls').hide();*/
  showLoader();
  ajaxObj = jQuery.ajax(url_base + '/application/controller/explore_controller.php', {
    type: 'post',
    data: obj,
    success: function (e) {
      console.log("Query submitted");
      //if(e!=0){
      var data = jQuery.parseJSON(e);
      if (data.totTrs!=undefined){
        console.log(" Total TRs: "+data.totTrs);
        console.log(" Total Hops: "+data.totHops);
        console.log(" File Name: "+data.ixdata);
        console.log(" File Size: "+data.ixsize+' KB');
        console.log(" Execution Time: "+data.execTime+' Sec.');
        writeIxMapsJs(data.ixdata);
        jQuery('#map-canvas-container').show();
        jQuery('#map-container').show();
        jQuery('#filter-results').show();
        jQuery('#filter-results-log').show();
        /*jQuery('#map-core-controls').show();*/
        jQuery('#filter-results').html(data.trsTable);
        jQuery('#filter-results-log').html(data.queryLogs);
        jQuery('#filter-results-summary').html(data.querySummary);
      } else {
        // we may need more error messages, but for now this will handle the majority...
        jQuery.toast({
          heading: 'No routes found',
          text: 'No routes were found with specified criteria, returning last submitted route instead. Adjust the query options to be more inclusive, then click Submit to re-query.',
          hideAfter: 10000,
          allowToastClose: true,
          position: 'mid-center',
          icon: 'error',
        });
        // DANGER! This could result in an endless loop if there is no last submitted
        submitLastSubmissionObject();
        jQuery('#filter-results-log').show();
        jQuery('#filter-results-log').html(data.queryLogs);
        jQuery('#filter-results-summary').html(data.querySummary);
      }
      hideLoader();
    },
    error: function (e) {
      console.log("Error! Submission unsuccessful");
      hideLoader();
    }
  });
};

var writeIxMapsJs = function(ixMapsJsFile){
  var script = '<script type="text/javascript" src="' + url_base +
  '/gm-temp/'+ixMapsJsFile+'"></script>';
  jQuery('#filter-results-ixmaps-data').html('');
  jQuery('#filter-results-ixmaps-data').html(script);
}

/************** HELPER FUNCTIONS *****************/
var loadAutoCompleteData = function(type, value) {
  //console.log(type + ":" + value);
  var obj = {
    action: 'loadAutoCompleteData',
    field: type,
    keyword: value
  };

  jQuery.ajax(url_base + '/application/controller/autocomplete.php', {
    type: 'post',
    data: obj,
    success: function (e) {
      console.log("Autocomplete data loaded: "+type);
      // populate js auto-complete array(s)
      var data = jQuery.parseJSON(e);
      populateAutoCompleteArrays(type,data);
    },
    error: function (e) {
      console.log("Error! autocomplete data can't be loaded", e);
    }
  });

};

var populateAutoCompleteArrays = function(type, data){
  if(type=='country') {
    countryTags.length = 0;
    jQuery.each(data, function(key, value) {
      if(value != null){
        countryTags.push(value);
      }
    });

  } else if(type=='region') {
    regionTags.length = 0;
    jQuery.each(data, function(key, value) {
      if(value != null){
       regionTags.push(value);
      }
    });

  } else if(type=='city') {
    cityTags.length = 0;
    jQuery.each(data, function(key, value) {
      if(value != null){
       cityTags.push(value);
      }
    });

  } else if(type=='asnum') {
    ASnumTags.length = 0;
    jQuery.each(data, function(key, value) {
      if(value != null){
       ASnumTags.push(value);
      }
    });

  } else if(type=='zipCode') {
    zipCodeTags.length = 0;
    jQuery.each(data, function(key, value) {
      if(value != null){
       zipCodeTags.push(value);
      }
    });

  } else if(type=='ISP') {
    ISPTags.length = 0;
    jQuery.each(data, function(key, value) {
      if(value != null){
       ISPTags.push(value);
      }
  });

  } else if(type=='submitter') {
    submitterTags.length = 0;
    jQuery.each(data, function(key, value) {
      if(value != null){
       submitterTags.push(value);
      }
  });
  }

  if(firstLoad==true){
    firstLoadFunc();
  }
}

var firstLoadFunc = function () {
  console.log('Running firstLoad housekeeping functions...');
  // bind data for first row on first load
  bindAutocompletes('country', '#filter-constraint-1');

  // clean this up for next time - autocomplete needs more abstracting
  jQuery(jQuery('.userloc-city')).autocomplete({
    source: cityTags
  });
  jQuery(jQuery('.userloc-country')).autocomplete({
    source: countryTags
  });
  jQuery(jQuery('.userloc-isp')).autocomplete({
    source: ISPTags
  });

  // jQuery.toast({
  //   heading: 'Welcome to the Explore page',
  //   // text: 'The map shows the path of the most recent traceroute contributed to the IXmaps database. For more details, see panels on the right, hover over the routers (dots) and click on the hops (lines). You appear to be in ' +myCity+ ', ' +myCountry+ ' at the IP address ' +myIp+ '.' ,
  //   text: 'Your current IP address is: '+myIp+ '. You appear to be near ' +myCity+ ', ' +myCountry+'.',
  //   hideAfter: 10000,
  //   allowToastClose: true,
  //   position: 'mid-center',
  //   icon: 'info',
  // });

  /*This ajax call is not needed now, as the all the data is available on first load.*/
  /*jQuery.ajax({
    url: "https://www.ixmaps.ca/application/geoip/mygeoip.php",
    success: function(result) {
      var myISP = result.isp
      jQuery('#userloc').show();
      jQuery('.userloc-ip').text(myIp);
      jQuery('.userloc-city').val(myCity);
      jQuery('.userloc-country').val(myCountry);
      jQuery('.userloc-isp').val(myISP);
      jQuery('.userloc-asn').val(myAsn);
    }
  });*/

  jQuery('#userloc').show();
  jQuery('.userloc-ip').text(myIp);
  jQuery('.userloc-city').val(myCity);
  jQuery('.userloc-country').val(myCountry);
  jQuery('.userloc-isp').text(myISP);
  jQuery('.userloc-asn').text(myASN);

  firstLoad = false;
}

var submitUserLocObject = function() {
  myCity = jQuery('.userloc-city').val();
  myCountry = jQuery('.userloc-country').val();
  myISP = jQuery('.userloc-isp').val();

  var userLocJSON = {
    "parameters":
    {
      "submitOnLoad": true,
      "submissionType": "customFilter",
      "otherFunction": ""
    },
    "constraints":
    {
      "filter-constraint-1":
      {
        constraint1: "does",
        constraint2: "originate",
        constraint3: "",
        constraint4: "",
        constraint5: "AND"
      }
    }
  };

  if (myCity!="" && myCountry!="" && myASN) {
    console.log('Searching based on ASN, Country, and City');
    userLocJSON = {
      "parameters":
      {
        "submitOnLoad": true,
        "submissionType": "customFilter",
        "otherFunction": ""
      },
      "constraints":
      {
        "filter-constraint-1":
        {
          constraint1: "does",
          constraint2: "originate",
          constraint3: "asnum",
          constraint4: myASN,
          constraint5: "AND"
        },
        "filter-constraint-2":
        {
          constraint1: "does",
          constraint2: "originate",
          constraint3: "country",
          constraint4: myCountry,
          constraint5: "AND"
        }
      }
    };
  } else if (myCountry!="" && myASN) {
    console.log('Searching based on ASN and Country');

  } // end if

    var jsonToString = JSON.stringify(userLocJSON);
    processPostedData(jsonToString);
  } else if (myISP) {
    console.log('Searching based on ISP');
    userLocJSON.constraints["filter-constraint-1"].constraint3 = "ISP";
    userLocJSON.constraints["filter-constraint-1"].constraint4 = myISP;
    var jsonToString = JSON.stringify(userLocJSON);
    processPostedData(jsonToString);
  } else if (myCity) {
    console.log('Searching based on city');
    userLocJSON.constraints["filter-constraint-1"].constraint3 = "city";
    userLocJSON.constraints["filter-constraint-1"].constraint4 = myCity;
    var jsonToString = JSON.stringify(userLocJSON);
    processPostedData(jsonToString);
  } else if (myCountry) {
    console.log('Searching based on country');
    userLocJSON.constraints["filter-constraint-1"].constraint3 = "country";
    userLocJSON.constraints["filter-constraint-1"].constraint4 = myCountry;
    var jsonToString = JSON.stringify(userLocJSON);
    processPostedData(jsonToString);
  } else {
    console.log('Giving up, last submission instead of user geoloc');
    submitLastSubmissionObject();
  }
}



var bindAutocompletes = function(tagType, rowId) {
  el = rowId + " .constraint-text-entry";
  if (tagType == 'country') {
    jQuery(el).autocomplete({
      source: countryTags
    });
  } else if (tagType == 'region') {
    jQuery(el).autocomplete({
      source: regionTags
    });
  } else if (tagType == 'city') {
    jQuery(el).autocomplete({
      source: cityTags
    });
  } else if (tagType == 'zipCode') {
    jQuery(el).autocomplete({
      source: zipCodeTags
    });
  } else if (tagType == 'ISP') {
    jQuery(el).autocomplete({
      source: ISPTags
    });
  } else if (tagType == 'asnum') {
    jQuery(el).autocomplete({
      source: ASnumTags
    });
  } else if (tagType == 'submitter') {
    jQuery(el).autocomplete({
      source: submitterTags
    });
  } else if (tagType == 'zipCodeSubmitter') {
    jQuery(el).autocomplete({
      source: zipCodeSubmitterTags
    });
  } else if (tagType == 'destHostName') {
    jQuery(el).autocomplete({
      source: destHostNameTags
    });
  } else if (tagType == 'ipAddr') {
    jQuery(el).autocomplete({
      source: ipAddressTags
    });
  } else if (tagType == 'hostName') {
    jQuery(el).autocomplete({
      source: hostNameTags
    });
  } else if (tagType == 'trId') {
    jQuery(el).autocomplete({
      source: trIdTags
    });
  } else {
    console.log('tagType is not currently implemented for autocomplete');
  }
};

var showLoader = function() {
  jQuery('#loader').show();
};

var hideLoader = function() {
  jQuery('#loader').hide();
};

var cancelQuery = function() {
  if(ajaxObj && ajaxObj.readystate != 4){
      ajaxObj.abort();
      console.log("Query submission has been canceled.");
  }
};

var submitLastSubmissionObject = function() {
  var obj = {
    "filter-constraint-1":
      {
        constraint1: "quickLink",
        constraint2: "lastSubmission"
      }
  };
  submitQuery(obj);
  // select id from traceroute order by sub_time desc limit 1;
};

var submitRecentRoutesObject = function() {
  var obj = {
    "filter-constraint-1":
      {
        constraint1: "quickLink",
        constraint2: "recentRoutes"
      }
  };
  submitQuery(obj);
  // select id from traceroute order by sub_time desc limit 25;
};

var submitMyCountryObject = function(){
  //alert('Based on your IP:'+myIp+', your country seems to be: "'+myCountry+'"');
  resetFilterConstraints();
  var a;
  a = jQuery('#filter-constraint-1 .constraint');
  jQuery(a[0]).val('does');
  jQuery(a[1]).val('originate');
  jQuery(a[2]).val('country');
  jQuery(a[3]).val(myCountry);
  jQuery(a[4]).val('AND');
};

var submitMyCityObject = function() {
  // alert('Based on your IP:'+myIp+', your location seems to be: "'+myCity+'"');
  resetFilterConstraints();
  var a;
  a = jQuery('#filter-constraint-1 .constraint');
  jQuery(a[0]).val('does');
  jQuery(a[1]).val('originate');
  jQuery(a[2]).val('city');
  jQuery(a[3]).val(myCity);
  jQuery(a[4]).val('AND');
};

var submitMyISPObject = function() {
  jQuery.ajax({url: "https://www.ixmaps.ca/application/geoip/mygeoip.php", success: function(result){
    resetFilterConstraints();
    var a;
    a = jQuery('#filter-constraint-1 .constraint');
    jQuery(a[0]).val('does');
    jQuery(a[1]).val('originate');
    jQuery(a[2]).val('asnum');
    jQuery(a[3]).val(result.asn);
    jQuery(a[4]).val('AND');
  }});
};

var submitBoomerangObject = function() {
  // ANTO: new approach
  resetFilterConstraints();
  var a;
  var fixedFilterC;
  a = jQuery('#filter-constraint-1 .constraint');
  jQuery(a[0]).val('does');
  jQuery(a[1]).val('originate');
  jQuery(a[2]).val('country');
  jQuery(a[3]).val('CA');
  jQuery(a[4]).val('AND');

  addFilterConstraint();
  fixedFilterC = filterCounter-1;
  a = jQuery('#filter-constraint-'+fixedFilterC+' .constraint');
  jQuery(a[0]).val('does');
  jQuery(a[1]).val('goVia');
  jQuery(a[2]).val('country');
  jQuery(a[3]).val('US');
  jQuery(a[4]).val('AND');

  addFilterConstraint();
  fixedFilterC = filterCounter-1;
  a = jQuery('#filter-constraint-'+fixedFilterC+' .constraint');
  jQuery(a[0]).val('does');
  jQuery(a[1]).val('terminate');
  jQuery(a[2]).val('country');
  jQuery(a[3]).val('CA');
  jQuery(a[4]).val('AND');
};

var submitDestinationIXmapsObject = function() {
  resetFilterConstraints();
  var a;
  a = jQuery('#filter-constraint-1 .constraint');
  jQuery(a[0]).val('does');
  jQuery(a[1]).val('terminate');
  jQuery(a[2]).val('destHostName');
  jQuery(a[3]).val('ixmaps.ca');
  jQuery(a[4]).val('AND');
};

var submitNonUSObject = function() {
  resetFilterConstraints();
  var a;
  a = jQuery('#filter-constraint-1 .constraint');
  jQuery(a[0]).val('doesNot');
  jQuery(a[1]).val('contain');
  jQuery(a[2]).val('country');
  jQuery(a[3]).val('US');
  jQuery(a[4]).val('AND');
};

var submitPrattOriginObject = function() {
  resetFilterConstraints();
  var a;
  a = jQuery('#filter-constraint-1 .constraint');
  jQuery(a[0]).val('does');
  jQuery(a[1]).val('contain');
  jQuery(a[2]).val('submitter');
  jQuery(a[3]).val('Pratt Manhattan Gallery');
  jQuery(a[4]).val('AND');
};

var submitSubmittedBy = function() {
  resetFilterConstraints();
  var a;
  a = jQuery('#filter-constraint-1 .constraint');
  jQuery(a[0]).val('does');
  jQuery(a[1]).val('contain');
  jQuery(a[2]).val('submitter');
  jQuery(a[3]).val('Enter name here...');
  jQuery(a[4]).val('AND');
};

var submitSubmittedFrom = function() {
  resetFilterConstraints();
  var a;
  a = jQuery('#filter-constraint-1 .constraint');
  jQuery(a[0]).val('does');
  jQuery(a[1]).val('contain');
  jQuery(a[2]).val('zipCodeSubmitter');
  jQuery(a[3]).val('Enter postcode here...');
  jQuery(a[4]).val('AND');
};

var toggleText = function() {
  jQuery('.expandable').toggle();
  if (jQuery('#custom-filters-more-button').text() === "[more]") {
    jQuery('#custom-filters-more-button').text("[less]");
  } else {
    jQuery('#custom-filters-more-button').text("[more]");
  }
};

// var asnColours = '{"174":"E431EB","3356":"EB7231","7018":"42EDEA","7132":"42EDEA","-1":"676A6B","577":"3D49EB","1239":"ECF244","6461":"E3AEEB","6327":"9C6846","6453":"676A6B","3561":"676A6B","812":"ED0924","20453":"ED0924","852":"4BE625","13768":"419C6B","3257":"676A6B","1299":"676A6B","22822":"676A6B","6939":"676A6B","376":"676A6B","32613":"676A6B","6539":"3D49EB","15290":"676A6B","5769":"676A6B","855":"676A6B","26677":"676A6B","271":"676A6B","6509":"676A6B","3320":"676A6B","23498":"676A6B","549":"676A6B","239":"676A6B","11260":"676A6B","1257":"676A6B","20940":"676A6B","23136":"676A6B","5645":"676A6B","21949":"676A6B","8111":"676A6B","13826":"676A6B","16580":"676A6B","9498":"676A6B","802":"676A6B","19752":"676A6B","11854":"676A6B","7992":"676A6B","17001":"676A6B","611":"676A6B","19080":"676A6B","26788":"676A6B","12021":"676A6B","33554":"676A6B","30528":"676A6B","16462":"676A6B","11700":"676A6B","14472":"676A6B","13601":"676A6B","11032":"676A6B","12093":"676A6B","10533":"676A6B","26071":"676A6B","32156":"676A6B","5764":"676A6B","27168":"676A6B","33361":"676A6B","32489":"676A6B","15296":"676A6B","10400":"676A6B","10965":"676A6B","18650":"676A6B","36522":"676A6B","19086":"676A6B"}';

var asnColours = '{"174":"rgb(228,49,235)","3356":"rgb(235,114,49)","7018":"rgb(66,237,234)","7132":"rgb(66,237,234)","-1":"rgb(103,106,107)","577":"rgb(61,73,235)","1239":"rgb(236,242,68)","6461":"rgb(227,174,235)","6327":"rgb(156,104,70)","6453":"rgb(103,106,107)","3561":"rgb(103,106,107)","812":"rgb(237,9,36)","20453":"rgb(237,9,36)","852":"rgb(75,230,37)","13768":"rgb(65,156,107)","3257":"rgb(103,106,107)","1299":"rgb(103,106,107)","22822":"rgb(103,106,107)","6939":"rgb(103,106,107)","376":"rgb(103,106,107)","32613":"rgb(103,106,107)","6539":"rgb(61,73,235)","15290":"rgb(103,106,107)","5769":"rgb(103,106,107)","855":"rgb(103,106,107)","26677":"rgb(103,106,107)","271":"rgb(103,106,107)","6509":"rgb(103,106,107)","3320":"rgb(103,106,107)","23498":"rgb(103,106,107)","549":"rgb(103,106,107)","239":"rgb(103,106,107)","11260":"rgb(103,106,107)","1257":"rgb(103,106,107)","20940":"rgb(103,106,107)","23136":"rgb(103,106,107)","5645":"rgb(103,106,107)","21949":"rgb(103,106,107)","8111":"rgb(103,106,107)","13826":"rgb(103,106,107)","16580":"rgb(103,106,107)","9498":"rgb(103,106,107)","802":"rgb(103,106,107)","19752":"rgb(103,106,107)","11854":"rgb(103,106,107)","7992":"rgb(103,106,107)","17001":"rgb(103,106,107)","611":"rgb(103,106,107)","19080":"rgb(103,106,107)","26788":"rgb(103,106,107)","12021":"rgb(103,106,107)","33554":"rgb(103,106,107)","30528":"rgb(103,106,107)","16462":"rgb(103,106,107)","11700":"rgb(103,106,107)","14472":"rgb(103,106,107)","13601":"rgb(103,106,107)","11032":"rgb(103,106,107)","12093":"rgb(103,106,107)","10533":"rgb(103,106,107)","26071":"rgb(103,106,107)","32156":"rgb(103,106,107)","5764":"rgb(103,106,107)","27168":"rgb(103,106,107)","33361":"rgb(103,106,107)","32489":"rgb(103,106,107)","15296":"rgb(103,106,107)","10400":"rgb(103,106,107)","10965":"rgb(103,106,107)","18650":"rgb(103,106,107)","36522":"rgb(103,106,107)","19086":"rgb(103,106,107)"}';

var asnColoursJson = jQuery.parseJSON(asnColours);
var getAsnColour = function(asNum){
  var c = 'rgb(153, 153, 153)';
  if (typeof(asnColoursJson[asNum]) != "undefined") {
    c = asnColoursJson[asNum];
  }
  return c;
}

var showTestedCarriers = function(){
  var carrierSampleJson = {
    "parameters":
    {
      "submitOnLoad":true,
      "submissionType":"customFilter",
      "otherFunction":""
    },
    "constraints":
    {
      "filter-constraint-1":
      {
        constraint1: "does",
        constraint2: "contain",
        constraint3: "trId",
        constraint4: "4",
        constraint5: "OR"
      },
      "filter-constraint-2":
      {
        constraint1: "does",
        constraint2: "contain",
        constraint3: "trId",
        constraint4: "43522",
        constraint5: "OR"
      },
      "filter-constraint-3":
      {
        constraint1: "does",
        constraint2: "contain",
        constraint3: "trId",
        constraint4: "43650",
        constraint5: "OR"
      },
      "filter-constraint-4":
      {
        constraint1: "does",
        constraint2: "contain",
        constraint3: "trId",
        constraint4: "232",
        constraint5: "OR"
      },
      "filter-constraint-5":
      {
        constraint1: "does",
        constraint2: "contain",
        constraint3: "trId",
        constraint4: "29386",
        constraint5: "OR"
      },
      "filter-constraint-6":
      {
        constraint1: "does",
        constraint2: "contain",
        constraint3: "trId",
        constraint4: "39044",
        constraint5: "OR"
      },
      "filter-constraint-8":
      {
        constraint1: "does",
        constraint2: "contain",
        constraint3: "trId",
        constraint4: "39032",
        constraint5: "OR"
      },
      "filter-constraint-9":
      {
        constraint1: "does",
        constraint2: "contain",
        constraint3: "trId",
        constraint4: "39038",
        constraint5: "OR"
      },
      "filter-constraint-10":
      {
        constraint1: "does",
        constraint2: "contain",
        constraint3: "trId",
        constraint4: "39014",
        constraint5: "OR"
      },
      "filter-constraint-11":
      {
        constraint1: "does",
        constraint2: "contain",
        constraint3: "trId",
        constraint4: "39038",
        constraint5: "OR"
      },
      "filter-constraint-12":
      {
        constraint1: "does",
        constraint2: "contain",
        constraint3: "trId",
        constraint4: "39054",
        constraint5: "OR"
      },
      "filter-constraint-13":
      {
        constraint1: "does",
        constraint2: "contain",
        constraint3: "trId",
        constraint4: "38672",
        constraint5: "OR"
      },
      "filter-constraint-14":
      {
        constraint1: "does",
        constraint2: "contain",
        constraint3: "trId",
        constraint4: "38410",
        constraint5: "OR"
      }
    }
  };

  var jsonToString = JSON.stringify(carrierSampleJson);
  processPostedData(jsonToString);
}

var boomerangJSON = {
  "parameters":
  {
    "submitOnLoad":true,
    "submissionType":"customFilter",
    "otherFunction":"boomerangs"
  },
  "constraints":
  {
    "filter-constraint-1":
    {
      constraint1: "does",
      constraint2: "originate",
      constraint3: "country",
      constraint4: "CA",
      constraint5: "AND"
    },
    "filter-constraint-2":
    {
      constraint1: "does",
      constraint2: "terminate",
      constraint3: "country",
      constraint4: "CA",
      constraint5: "AND"
    },
    "filter-constraint-3":
    {
      constraint1: "does",
      constraint2: "goVia",
      constraint3: "country",
      constraint4: "US",
      constraint5: "AND"
    }
  }
};

var submitCustomQuery = function(trId, multipleTRs) {
  var singleTrJSON = {
    "parameters":
    {
      "submitOnLoad":true,
      "submissionType":"customFilter",
      "otherFunction":""
    },
    "constraints":
    {
      "filter-constraint-1":
      {
        constraint1: "does",
        constraint2: "contain",
        constraint3: "trId",
        constraint4: trId,
        constraint5: "AND"
      }
    }
  };
  var jsonToString = JSON.stringify(singleTrJSON);
  processPostedData(jsonToString);
}

var processPostedData = function(d){
  var data = jQuery.parseJSON(d);

  setTimeout(function(){
    console.log('Timer ok for load page');
    if(data.parameters.otherFunction=='myCity'){
      submitMyCityObject();
      console.log('submitMyCityObject...');
    } else if (data.parameters.otherFunction=='myCountry'){
      submitMyCountryObject();
      console.log('submitMyCountryObject...');
    } else if (data.parameters.otherFunction=='boomerangs'){
      submitBoomerangObject();
      console.log('submitBoomerangObject...');
    } else if (data.parameters.otherFunction=='nsas'){
      submitNSAObject();
      console.log('submitNSAObject...');
    } else if(data.parameters.submissionType=="customFilter"){
      //console.log('constraints', data.constraints);
      resetFilterConstraints();
      var a;
      var fixedFilterC;
      var conn = 0;
      jQuery.each(data.constraints, function(key,value) {
        //a = jQuery('#filter-constraint-1 .constraint');
      if(conn>0){
        addFilterConstraint();
      }
      fixedFilterC = filterCounter-1;
      a = jQuery('#filter-constraint-'+fixedFilterC+' .constraint');
        jQuery(a[0]).val(value.constraint1);
        jQuery(a[1]).val(value.constraint2);
        jQuery(a[2]).val(value.constraint3);
        jQuery(a[3]).val(value.constraint4);
        jQuery(a[4]).val(value.constraint5);
        conn++;
      });

    }

    if(data.parameters.submitOnLoad){
      processFilters();
    }
  }, 800);
}
