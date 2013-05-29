var baseURL = 'http://dev.ixmaps.ischool.utoronto.ca/'

var initialize = function() {

	jQuery('.video-img').click(function(ev) {
		var playerEl = ev.target.parentElement.children[1];
		setupVideoPlayer(playerEl);
	});
	
	jQuery('.text-video-link').click(function(ev) {
		var playerEl = ev.target.parentElement.parentElement.siblings()[0].children[1];			// lololololol
		setupVideoPlayer(playerEl);
	});

	jQuery('.explore-route-1859').click(function() {
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
					constraint4: "1859",
					constraint5: "AND"
				}
			}	
		};
		JSONstr = JSON.stringify(str);
		window.location = baseURL + '/explore.php?data=' + JSONstr;
	});

	jQuery('.explore-route-3381').click(function() {
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
					constraint4: "3381",
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
	
	
// 	jQuery('#left-big-btn').click(function() {
// 		window.location.pathname = '/about';
// 	});
// 
// 	jQuery('#right-big-btn').click(function() {
// 		window.location.pathname = '/contact';
// 	});
}


function setupVideoPlayer(playerEl) {
	jQuery('.slideshow').cycle('pause');
	jQuery('.slideshow-img').hide();
	jQuery('#play-icon').hide();
	
	jQuery(playerEl).show();
	new YT.Player(playerEl.id, {
		events: {
			'onStateChange': onPlayerStateChange
		}
	});
}
// jQuery(document).ready(function($) {
//     $('.video-thumb').click(function() {
// 
//         var vidId = $(this).attr('id');
//         $('#container').html('<iframe id="player_'+vidId+
//             '" width="420" height="315" src="http://www.youtube.com/embed/'+
//             vidId+'?enablejsapi=1&autoplay=1&autohide=1&showinfo=0" '+
//             'frameborder="0" allowfullscreen></iframe>');
// 
//         new YT.Player('player_'+vidId, {
//             events: {
//                 'onStateChange': onPlayerStateChange
//             }
//         });
//     });
// });

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
	jQuery('.slideshow-video').hide();
	jQuery('#play-icon').show();
	jQuery('.slideshow-img').show();
	jQuery('.slideshow').cycle('resume');
}





/*
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