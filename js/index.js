var baseURL = 'http://www.ixmaps.ca/'

var initialize = function() {

	jQuery('.explore-target-route').click(function() {
		var routeId = jQuery(this).data('route-id');
		var str = {
			"parameters":
			{
				   "submitOnLoad":true,
				   "submissionType":"customFilter",
				   "otherFunction":null
			},
			"constraints":
			{
				"filter-constraint-1":
				{
					constraint1: "does",
					constraint2: "contain",
					constraint3: "trId",
					constraint4: routeId,
					constraint5: "AND"
				}
			}
		};
		JSONstr = JSON.stringify(str);
		window.location = baseURL + '/explore.php?data=' + JSONstr;
	});

	jQuery('.explore-boomerang-routes').click(function() {
		var str = {
			"parameters":
			{
				   "submitOnLoad":true,
				   "submissionType":"customFilter",
				   "otherFunction":null
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
		var JSONstr = JSON.stringify(str);
		window.location = baseURL + 'explore.php?data=' + JSONstr;
	});

	jQuery('.explore-my-country-routes').click(function() {
		var str = {
			"parameters":
			{
				   "submitOnLoad":true,
				   "submissionType":null,
				   "otherFunction":"myCountry"
			}
		};
		var JSONstr = JSON.stringify(str);
		window.location = baseURL + 'explore.php?data=' + JSONstr;
	});

	jQuery('.explore-my-city-routes').click(function() {
		var str = {
			"parameters":
			{
				   "submitOnLoad":true,
				   "submissionType":null,
				   "otherFunction":"myCity"
			}
		};
		var JSONstr = JSON.stringify(str);
		window.location = baseURL + 'explore.php?data=' + JSONstr;
	});

	jQuery('.explore-nsa-routes').click(function() {
		var str = {
			"parameters":
			{
				   "submitOnLoad":true,
				   "submissionType":null,
				   "otherFunction":"nsas"
			}
		};
		var JSONstr = JSON.stringify(str);
		window.location = baseURL + 'explore.php?data=' + JSONstr;
	});


	jQuery('#news-btn').click(function() {
		window.open("/documents/Keeping_Internet_Users_Summ_review_App_final_Jan_27.pdf");
	});


	// jQuery('.slideshow-img').click(function(ev) {
	// 	var url = jQuery(ev.target).data('url');
	// 	window.open(url);
	// });

	jQuery('.text-video-link').click(function(ev) {
		//var playerEl = ev.target.parentElement.parentElement.siblings()[0].children[1];			// lololololol
		// setupVideoPlayer(ev.target.parentElement.parentElement.parentElement.id);   TODO: FIXME
	});
}


function setupVideoPlayer(vidId) {
	// jQuery('.slideshow').cycle('pause');
	// jQuery('.slideshow-img-container').hide();
	// jQuery('#play-icon').hide();
	// jQuery('#pager').hide();
	// jQuery('#'+vidId+' .player-container').show();
	// //jQuery('#player-container').css('z-index',999);

	// jQuery('#'+vidId+' .player-container').html('<iframe id="player_'+vidId+'" class="vid-iframe" src="http://www.youtube.com/embed/'+vidId+'?enablejsapi=1&autoplay=1" frameborder="0" allowfullscreen></iframe>');
	// new YT.Player('player_'+vidId, {
 //        events: {
 //            'onStateChange': onPlayerStateChange
 //        }
	// });
}

function onPlayerStateChange(event) {
    switch(event.data) {
        case YT.PlayerState.ENDED:
            console.log('Video has ended.');
            returnToState();
            break;
        case YT.PlayerState.PLAYING:
            console.log('Video is playing.');
            break;
        case YT.PlayerState.PAUSED:
            console.log('Video is paused.');
            break;
        case YT.PlayerState.BUFFERING:
            console.log('Video is buffering.');
            break;
        case YT.PlayerState.CUED:
            console.log('Video is cued.');
            break;
        default:
            console.log('Unrecognized state.');
            break;
    }
}

function returnToState() {
	jQuery('.player-container').hide();
	jQuery('#play-icon').show();
	jQuery('#pager').show();
	jQuery('.slideshow-img-container').show();
	jQuery('.slideshow').cycle('resume');
}







/*
REFERENCE - data structure for the Explore page API
		var boomerangJSON = {
			"parameters":
			{
				"submitOnLoad":true, (true | false)
				"submissionType":"customFilter", (customFilter | quickLink | otherFunction)
				"otherFunction":"myCity" (myCity | myCountry | null)
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
*/
