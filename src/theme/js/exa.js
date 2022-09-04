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

			 if(distance > 0 && windowHeight > distance) {
		    	
		    	var	frac		  = (windowHeight - distance) / windowHeight,
		    		pos 		  = (backgroundImgHeight - bannerHeight) - (frac * (backgroundImgHeight-bannerHeight));

		    	$(this).css({'backgroundPosition':'0 -' + pos + 'px'});
	    	}
   		});
	};


	$('.comment-button').click( function(e) {
		e.preventDefault();

		// Create the pane.
		$('.comments').show(400);
	});


	function isPreflightSize(size) {
		var w = size[0];
		var h = size[1];
		if (w == 300 && h == 340) return true;
		if (w == 760 && h == 340) return true;
		if (w == 1020 && h == 420) return true;
		if (w == 1180 && h == 420) return true;
		return false;
	}


	// Remove the preflight container until its loaded.
	jQuery(".container.preflight .dfw-unit").on("dfw:beforeAdLoaded", function(event,gptEvent) {
		// add the class loaded to the preflight container.
		var preflightcontainer = $(this).closest(".container.preflight");
	});


	// Decorate the preflight once its loaded on the page: 
	// Adds a didLoad class to the preflight container.
	jQuery(".container.preflight .dfw-unit").on("dfw:afterAdLoaded", function(event,gptEvent) {
		var preflightcontainer = $(this).closest(".container.preflight");
		preflightcontainer.addClass("loaded");
		if (isPreflightSize(gptEvent.size)) {
			var wrapper = $(this).closest(".wrapper");
			preflightcontainer.addClass("decorated");
			wrapper.removeClass("wrapper");
		}
	});

	
	jQuery(".ad-in-content").on("dfw:afterAdLoaded", function(event,gptEvent) {
		if (!gptEvent.isEmpty) {
			var adContainer = $(this).closest(".ad-in-content");
			adContainer.css("display", "block");
		}
	});
});
