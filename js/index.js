var initialize = function() {
	jQuery('#left-big-btn').click(function() {
		window.location.pathname = '/about';
	});

	jQuery('#right-big-btn').click(function() {
		window.location.pathname = '/contact';
	});
}
