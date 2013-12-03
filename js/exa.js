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

	/** 
	 * Scrolling for banners
	 * 
	 * Issues: bugs on iOS, safari devices.
	 * 
	 * @author Will Hanyes
	 * @since Nov 2013 
	 */
	$(window).scroll(bannerScroll);
	function bannerScroll() {


		var backgroundImgHeight = 234,
			bannerHeight = 90;
		var scrollTop     = $(window).scrollTop(),
			windowHeight  = $(window).height();
			

		$('.section-banner').each( function() {
			
			var	elementOffset = $(this).offset().top,
			    distance      = (elementOffset - scrollTop);

			console.log(windowHeight + ',' + distance);

			 if(distance > 0 && windowHeight > distance) {
		    	
		    	var	frac		  = (windowHeight - distance) / windowHeight,
		    		pos 		  = (backgroundImgHeight - bannerHeight) - (frac * (backgroundImgHeight-bannerHeight));

		    	$(this).css({'backgroundPosition':'0 -' + pos + 'px'});
	    	}

   		});

	};
	
	window.setTimeout(function() {
		$(".add-so-button").css({'top':'-30px','display':'block'}).animate({'top':'43px','display':'block'},200);
	}, 400 /* but after 2000 ms */);
	$('#shoutoutText').focus();

	$(".search-button").click(function(e) {
		e.preventDefault();
		$(this).find('input').first().attr("value","");
	});
	
	$(".nav-control").click(function(e){
		$(".nav-container").toggleClass("nav-open");
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

	$(".about").hover(function() {

		$('#page').css({
			"position":"relative"

		});

		$('#page-inner').css({
			"position":"absolute",
			"width":"100%",
			"left":0
			});

		$('#page-inner').animate({
			"left":"400px"
			},400);
 
	}, function() {

		$('#page-inner').animate({
			"left":"0px"
			},200);

	});

});