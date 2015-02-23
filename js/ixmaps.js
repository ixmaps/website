
var activeInfo = 0;

// keeps track of what filter line we're on (rows will not always be sequential numbers, since deletions can occur)
var filterCounter = 1;

// keeps track of when first load housekeeping functions
var firstLoad = true;

var ajaxObj; // define ajax object for query submit

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
  // onclick events

  // quicklink buttons
  // jQuery('#quick-links-list').change(function() {
  //   submitQuickLink();
  // });

  jQuery('#last-submission-button').click(function() {
    submitLastSubmissionObject();
  });

  jQuery('#recent-routes-button').click(function() {
    submitRecentRoutesObject();
  });

  jQuery('#my-city-button').click(function() {
    submitMyCityObject();
  });

  jQuery('#my-country-button').click(function() {
    submitMyCountryObject();
  });

  jQuery('#all-boomerangs-button').click(function() {
    submitBoomerangObject();
  });

  jQuery('#all-submitters-button').click(function() {
    submitAllSubmittersObject();
  });

  jQuery('#all-postal-codes-button').click(function() {
    submitAllSubmittersObject();
  });

  jQuery('#non-CA-button').click(function() {
    submitNonCAObject();
  });

  jQuery('#non-US-button').click(function() {
    submitNonUSObject();
  });

  // advanced query buttons
  jQuery('#process-filters-button').click(function() {
    processFilters();
  });

  // jQuery('#add-filter-button').click(function() {
  //   console.log('adding filter...');
  //   addFilterConstraint();
  // });

  jQuery('#reset-filters-button').click(function() {
    console.log('resetting...')
    resetFilterConstraints();
  });

  jQuery('#custom-filters-more-button').click(function() {
    toggleText();
  });

  jQuery('#contain-NSA-button').click(function() {
    submitNSAObject();
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

  //
  jQuery('#cancel-query').click(function() {
    cancelQuery();
    hideLoader();
  });

}

var submitNSAObject = function() {
  resetFilterConstraints();
  var nsaCities = new Array("San Francisco", "Los Angeles", "New York", "Dallas", "Washington", "Seattle", "San Jose", "San Diego", "Miami", "Boston", "Phoenix", "Salt Lake City", "Nashville", "Denver", "Saint Louis", "Bridgeton", "Bluffdale", "Houston", "Chicago", "Atlanta", "Portland");
  var a;

  var c=0;
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


  //jQuery('#filter-constraint-1 .constraint input').val('Chicago');



}

var addFilterConstraint = function () {
  // creating the row
  var filterLine = "<div class='filter-item'>";
  filterLine += "<select class='constraint' class='hide'>";
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
  filterLine += "<option value='country'>Country</option>";
  filterLine += "<option value='region'>Province/State</option>";
  filterLine += "<option value='city'>City</option>";
  filterLine += "<option value='ISP'>ISP/Carrier</option>";
  filterLine += "<option value='asnum'>AS number</option>";
  filterLine += "<option value='zipCode'>Zip code/Postal</option>";
  filterLine += "<option value='submitter'>Submitter</option>";
  filterLine += "<option value='zipCodeSubmitter'>Zip Code/Postal (Submitter)</option>";
  //filterLine += "<option value='NSA'>NSA</option>";
  filterLine += "<option value='destHostName'>Destination Host Name</option>";
  filterLine += "<option value='ipAddr'>IP Address</option>";
  filterLine += "<option value='hostName'>Host Name</option>";
  filterLine += "<option value='trId'>Traceroute Id</option>";

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
    //////
    console.log('ev.target', ev.target);
    console.log('rowId', rowId);

    console.log(jQuery(ev.target).val());
    bindAutocompletes(jQuery(ev.target).val(), rowId);
  });

  // if the dropdown has not changed on this row, but on another
  jQuery('.constraint-text-entry').click(function(ev) {
    console.log(ev);
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
      removeFilterConstraint(jQuery(item))
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
  /*var tt= jQuery('.filter-item');
  console.log(tt);*/
  _.each(jQuery('.filter-item'), function(item) {
    i = 0;
    constraint = {};

    _.each(jQuery(item).children('.constraint'), function(c) {
      i++;
      /*var c_val = jQuery(c).val();
      console.log(c_val);*/

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
    alert('One or more fields were not filled. Submission cancelled');
  }
};

var submitQuery = function(obj) {
  console.log('submitting...');
  submittedObj = obj;
  jQuery('#map-canvas-container').hide();
  jQuery('#map-container').hide();
  jQuery('#filter-results').hide();
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
      if(data.totTrs!=undefined){
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
      } else {

        jQuery('#filter-results-log').show();
        jQuery('#filter-results-log').html(data.queryLogs);
        //jQuery('#filter-results').html("<p>There are no traceroutes matching the query.<br/><br/>");
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
      console.log("Autocomplete data loaded : "+type);
      //jQuery('#autocomplete-data').html(e);

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
  console.log('Populating AutoComplete Arrays...')
  if(type=='country') {
    countryTags.length = 0;
    jQuery.each(data, function(key, value) {
      if(value != null){
        countryTags.push(value);
      }
    });
    console.log(type+" : ["+countryTags.length+"]");

  } else if(type=='region') {
    regionTags.length = 0;
    jQuery.each(data, function(key, value) {
      if(value != null){
       regionTags.push(value);
      }
    });
    console.log(type+" : ["+regionTags.length+"]");

  } else if(type=='city') {
    cityTags.length = 0;
    jQuery.each(data, function(key, value) {
      if(value != null){
       cityTags.push(value);
      }
    });
    console.log(type+" : ["+cityTags.length+"]");

  } else if(type=='asnum') {
    ASnumTags.length = 0;
    jQuery.each(data, function(key, value) {
      if(value != null){
       ASnumTags.push(value);
      }
    });
    console.log(type+" : ["+ASnumTags.length+"]");

  } else if(type=='zipCode') {
    zipCodeTags.length = 0;
    jQuery.each(data, function(key, value) {
      if(value != null){
       zipCodeTags.push(value);
      }
    });
    console.log(type+" : ["+zipCodeTags.length+"]");

    } else if(type=='ISP') {
    ISPTags.length = 0;
    jQuery.each(data, function(key, value) {
      if(value != null){
       ISPTags.push(value);
      }
    });
    console.log(type+" : ["+ISPTags.length+"]");
    } else if(type=='submitter') {
    ISPTags.length = 0;
    jQuery.each(data, function(key, value) {
      if(value != null){
       submitterTags.push(value);
      }
    });
    console.log(type+" : ["+submitterTags.length+"]");
  }

  if(firstLoad==true){
      firstLoadFunc();
  }

}

var firstLoadFunc = function () {
  console.log('running firstLoad housekeeping functions...');
  // bind data for first row on first load
  bindAutocompletes('country', '#filter-constraint-1');
  firstLoad = false;
}

var bindAutocompletes = function(tagType, rowId) {
  //console.log('bindAutocompletes:'+tagType)

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
  var h = jQuery(document).height();
  jQuery('#loader-mask').height(h+'px');

  jQuery('#loader').show();
};

var hideLoader = function() {
  jQuery('#loader').hide();
};

var cancelQuery = function() {
  //jQuery('#loader').hide();
  if(ajaxObj && ajaxObj.readystate != 4){
      ajaxObj.abort();
      console.log("Query submission has been cancelled.");
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

  // old approach
/*  var obj = {
    "filter-constraint-1":
      {
        constraint1: "quickLink",
        constraint2: "myCity"
      }
  };
  submitQuery(obj);*/
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

  //processFilters();

/*  var obj = {
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
  };
  submitQuery(obj);
*/
};

var submitNonCAObject = function() {
  resetFilterConstraints();
  var a;
  a = jQuery('#filter-constraint-1 .constraint');
  jQuery(a[0]).val('doesNot');
  jQuery(a[1]).val('contain');
  jQuery(a[2]).val('country');
  jQuery(a[3]).val('CA');
  jQuery(a[4]).val('AND');
  //processFilters();

/*  var obj = {
    "filter-constraint-1":
      {
        constraint1: "doesNot",
        constraint2: "contain",
        constraint3: "country",
        constraint4: "CA",
        constraint5: "AND"
      }
  };
  submitQuery(obj);*/
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
  //processFilters();
/*  var obj = {
    "filter-constraint-1":
      {
        constraint1: "doesNot",
        constraint2: "contain",
        constraint3: "country",
        constraint4: "US",
        constraint5: "AND"
      }
  };
  submitQuery(obj);*/
};

var suggetsQuickLink = function() {
  alert("suggetsQuickLink");
};

var toggleText = function() {
  jQuery('.expandable').toggle();
  if (jQuery('#custom-filters-more-button').text() === "[more]") {
    jQuery('#custom-filters-more-button').text("[less]");
  } else {
    jQuery('#custom-filters-more-button').text("[more]");
  }
};

var asnColours = '{"174":"E431EB","3356":"EB7231","7018":"42EDEA","7132":"42EDEA","-1":"676A6B","577":"3D49EB","1239":"ECF244","6461":"E3AEEB","6327":"9C6846","6453":"676A6B","3561":"676A6B","812":"ED0924","20453":"ED0924","852":"4BE625","13768":"419C6B","3257":"676A6B","1299":"676A6B","22822":"676A6B","6939":"676A6B","376":"676A6B","32613":"676A6B","6539":"3D49EB","15290":"676A6B","5769":"676A6B","855":"676A6B","26677":"676A6B","271":"676A6B","6509":"676A6B","3320":"676A6B","23498":"676A6B","549":"676A6B","239":"676A6B","11260":"676A6B","1257":"676A6B","20940":"676A6B","23136":"676A6B","5645":"676A6B","21949":"676A6B","8111":"676A6B","13826":"676A6B","16580":"676A6B","9498":"676A6B","802":"676A6B","19752":"676A6B","11854":"676A6B","7992":"676A6B","17001":"676A6B","611":"676A6B","19080":"676A6B","26788":"676A6B","12021":"676A6B","33554":"676A6B","30528":"676A6B","16462":"676A6B","11700":"676A6B","14472":"676A6B","13601":"676A6B","11032":"676A6B","12093":"676A6B","10533":"676A6B","26071":"676A6B","32156":"676A6B","5764":"676A6B","27168":"676A6B","33361":"676A6B","32489":"676A6B","15296":"676A6B","10400":"676A6B","10965":"676A6B","18650":"676A6B","36522":"676A6B","19086":"676A6B"}';

var asnColoursJson = jQuery.parseJSON(asnColours);
var getAsnColour = function(asNum){
  var c = '676A6B';
  //if(asnColoursJson.indexOf(asNum) != -1){
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
  processpostedData(jsonToString);
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

var submitCustomQuery = function(trId, multipleTRs){
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
  processpostedData(jsonToString);
}

var processpostedData = function(d){
  //console.log(JSON.stringify(d));
  jQuery('#tabs').tabs({ active: 1 });
  var data = jQuery.parseJSON(d);
  //console.log(data);


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
      //console.log('submitting...');
    }
  }, 800);
}
