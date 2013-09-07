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

	
	window.setTimeout(function() {	
		$(".add-so-button").css({'top':'-30px','display':'block'}).animate({'top':'43px','display':'block'},200);
	}, 400 /* but after 2000 ms */);
	$('#shoutoutText').focus();

	$(".search-button").click(function(e) {
		e.preventDefault();
		$(this).find('input').first().attr("value","");
	});


	$(".add-so-button").click(function(e) {

		e.preventDefault();


		$('.shoutout-header').hide(300);

		$('.shoutout-add-header').show(300);

		$('#shoutoutText').focus();


	});

	$('#shoutoutText').blur(function(e) {

		window.setTimeout(function() {

			$('.shoutout-header').show(300);

			$('.shoutout-add-header').hide(300);
			$('.so-error').hide(300);

		}, 3000 /* but after 2000 ms */);


	});

});