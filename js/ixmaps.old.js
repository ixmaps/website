
// TODO need to set this dynamically 
//var url_base="http://localhost/mywebapps/ixmaps.ca/dev.ixmaps.ca";

var url_base="http://dev.ixmaps.ischool.utoronto.ca";

var activeInfo = 0;

// keeps track of what filter line we're on (rows will not always be sequential numbers, since deletions can occur)
var filterCounter = 1;

// keeps track of when first load housekeeping functions
var firstLoad = true;

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

  // add the first row of constraints
  addFilterConstraint();

  // load autocomplete data from db and populate js arrays
  loadAutoCompleteData('country', ' ');
  loadAutoCompleteData('region', ' ');
  loadAutoCompleteData('city', ' ');
  loadAutoCompleteData('zipCode', ' ');
  loadAutoCompleteData('asnum', ' ');

};

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
    console.log(jQuery(ev.target).val());
    bindAutocompletes(jQuery(ev.target).val(), rowId);
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
    alert('One or more fields were not filled. Submission cancelled');
  }
};

var submitQuery = function(obj) {
  console.log('submitting...');
  showLoader();

  jQuery.ajax(url_base + '/application/controller/explore_controller.php', {
    type: 'post',
    data: obj,
    success: function (e) {
      console.log("Query submitted");
      jQuery('#filter-results').show();
      jQuery('#filter-results').html(e);
      hideLoader();
      initializeMap();
    },
    error: function (e) {
      console.log("Error! Submission unsuccessful", e);
      hideLoader();
    }
  }); 
};



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

  // } else if(type=='ISP') {
  //   ISPTags.length = 0;
  //   jQuery.each(data, function(key, value) {
  //     if(value != null){
  //      ISPTags.push(value);
  //     }
  //   });
  //   console.log(type+" : ["+ISPTags.length+"]");
  
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

var viewTrDetails = function (trId) {
  jQuery('#tr-details').show();
  var url = 'http://ixmaps.ischool.utoronto.ca/cgi-bin/tr-query.cgi?query_type=traceroute_id&arg='+trId;
  jQuery('#tr-details-iframe').attr('src', url);
};

var showThisTr = function(trId){
  alert('not currently functional. ID: '+trId);
};

var closeTrDetails = function () {
  jQuery('#tr-details').hide();
};

var showLoader = function() {
  var h = jQuery(document).height();
  jQuery('#loader-mask').height(h+'px');
  
  jQuery('#loader').show();
};

var hideLoader = function() {
  jQuery('#loader').hide();
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

var submitMyCityObject = function() {
  alert('This feature is currently under construction');
  // var obj = {
  //   "filter-constraint-1":
  //     {
  //       constraint1: "quickLink",
  //       constraint2: "myCity"
  //     }
  // };
  // submitQuery(obj);
  // not sure how you're grabbing the user's loc - does it need to be submitted with the object?
};

var submitBoomerangObject = function() {
  var obj = {
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
};

var submitNonCAObject = function() {
  var obj = {
    "filter-constraint-1":
      {
        constraint1: "doesNot",
        constraint2: "contain",
        constraint3: "country",
        constraint4: "CA",
        constraint5: "AND"
      }
  };
  submitQuery(obj);
};

var submitNonUSObject = function() {
  var obj = {
    "filter-constraint-1":
      {
        constraint1: "doesNot",
        constraint2: "contain",
        constraint3: "country",
        constraint4: "US",
        constraint5: "AND"
      }
  };
  submitQuery(obj);
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
