/**
 * Functionality specific to Twenty Thirteen.
 *
 * Provides helper functions to enhance the theme experience.
 */



$(document).ready(function() {
	//alert('hi');
	/*
	$(window).scroll(function() {


		console.log($("body").scrollTop()-$("#sidebar").offset().top);


		if(($("body").scrollTop()-$("#sidebar").offset().top)>0) {
			$("#sidebar").addClass("sidebar-fixed");
		}

	});
*/


	$(".search-button").click(function(e) {
		e.preventDefault();
		$(this).find('input').first().attr("value","");
	});

});