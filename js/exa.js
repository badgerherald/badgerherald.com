/**
 * Functionality specific to Twenty Thirteen.
 *
 * Provides helper functions to enhance the theme experience.
 */



$(document).ready(function() {
	//alert('hi');

	$(window).scroll(function() {

	//	if($("#sidebar").scrollTop()<0) {
	//	console.log($("body").scrollTop());
		console.log($("body").scrollTop()-$("#sidebar").offset().top);
	//	}

		if(($("body").scrollTop()-$("#sidebar").offset().top)>0) {
			$("#sidebar").addClass("sidebar-fixed");
		}

	});

});