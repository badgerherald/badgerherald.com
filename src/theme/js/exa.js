/**
 * JS functionality specific to Exa.
 */
jQuery(document).ready(function($) {

	jQuery(".snippet.inline").bind( "click", function(e) {
		
		e.preventDefault();

		url = jQuery( this ).attr( 'href' );

		jQuery.post(
			exa_inline_click.ajaxurl,
			{
				action: "ajax-exa_inline_click",
				nonce: exa_inline_click.nonce,
				exa_inline_url: url,		// The clicked URL.
				exa_inline_id: exa_inline_click.id 		// The post ID.
			}, function( response ) { 
				console.log(response);
			}
			);

		window.open(url,"_blank");

	}); 

	$(".container.nameplate .menus-button").on('click', function() {
		$(this).toggleClass('active');
		$(this).next('.menus').toggleClass('active');
	});

	/**
	 * A pair of functions to turn of html scrolling.
	 * This is to turn scrolling for a child element on.
	 *
	 * Don't really work correctly right now. But would be nice to have
	 * someday.
	 */
	function lockScroll() {
		// lock scroll position, but retain settings for later
		var scrollPosition = [
		  self.pageXOffset || document.documentElement.scrollLeft || document.body.scrollLeft,
		  self.pageYOffset || document.documentElement.scrollTop  || document.body.scrollTop
		];
		var html = jQuery('html'); // it would make more sense to apply this to body, but IE7 won't have that
		html.data('scroll-position', scrollPosition);
		html.data('previous-overflow', html.css('overflow'));
		html.css('overflow', 'hidden');
		window.scrollTo(scrollPosition[0], scrollPosition[1]);
	}
	
	function unlockScroll() {
		// un-lock scroll position
		var html = jQuery('html');
		var scrollPosition = html.data('scroll-position');
		html.css('overflow', html.data('previous-overflow'));
		window.scrollTo(scrollPosition[0], scrollPosition[1])
  	}

	/** 
	 * Scrolling for banners
	 * Issues: bugs on iOS, safari devices.
	 * 
	 * @since v0.1
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

			// log distance: console.log(windowHeight + ',' + distance);

			 if(distance > 0 && windowHeight > distance) {
		    	
		    	var	frac		  = (windowHeight - distance) / windowHeight,
		    		pos 		  = (backgroundImgHeight - bannerHeight) - (frac * (backgroundImgHeight-bannerHeight));

		    	$(this).css({'backgroundPosition':'0 -' + pos + 'px'});
	    	}

   		});

	};

	/**
	 *
	 *
	 */
	$('.comment-button').click( function(e) {
		e.preventDefault();

		// Create the pane.
		$('.comments').show(400);
	});
});