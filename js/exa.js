/**
 * JS functionality specific to Exa.
 *
 * 
 */
jQuery(document).ready(function($) {


	// Remove the preflight container until its loaded.
	jQuery(".preflight-container .dfw-unit").on("dfw:beforeAdLoaded", function() {
		// add the class loaded to the preflight container.
		var preflightcontainer = $(this).closest(".preflight-container");
		preflightcontainer.hide();
	});

	// Decorate the preflight once its loaded on the page: 
	// Adds a didLoad class to the preflight container.
	jQuery(".preflight-container .dfw-unit").on("dfw:afterAdLoaded", function() {
		// add the class loaded to the preflight container.
		var preflightcontainer = $(this).closest(".preflight-container");
		preflightcontainer.addClass("loaded");
		preflightcontainer.show();
	});


    // Adds a dotted overlay effect to img with a container div.dotted-overlays,
    // see css for actual styling.
    //
    // Takes:
    //
    //      <div class="dotted-overlay-container">
    //          <img />
    //      </div>
    //
    // And adds:
    //
    //      <div class="dotted-overlay-container">
    //          <div class="dotted-overlay"></div>
    //          <img />
    //      </div>
    //
    // The new `div.dotted-overlay` object is sized to the same size
    // as the img. This overlay can then be stlyed with css.
    var dotOverlay = function(overlayContainer) {
        var t = overlayContainer.parent('.dotted-overlay-container');
        t.prepend('<div class="dotted-overlay"></div>');
        sizeDotOverlay(overlayContainer);
    }

    var sizeDotOverlay = function(overlayContainer) {
    	var t = overlayContainer.parent('.dotted-overlay-container');
        img = t.find('img');
        t.find('div.dotted-overlay').css({
            'width':img.outerWidth(),
            'height':img.outerHeight(),
        });
    }
    // Run even after each img is done loaded.
    // This ensures the image has a width and height, if one is set to auto.
	$('div.dotted-overlay-container img').each(function() {
		dotOverlay($(this));
		$(this).on('load',function() {
	        sizeDotOverlay($(this));
	    });
	});

	// The overlay needs to be resized everytime the window is
	// resized.
	$(window).on('resize',function() {
		$('div.dotted-overlay-container img').each(function() {
	        sizeDotOverlay($(this));
	    });
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
	 * Fastclick library, to removed 300ms delay for
	 * taps on mobile.
	 *
	 * @since v0.1
	 */
	$(function() {
	    FastClick.attach(document.body);
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

			// log distance: console.log(windowHeight + ',' + distance);

			 if(distance > 0 && windowHeight > distance) {
		    	
		    	var	frac		  = (windowHeight - distance) / windowHeight,
		    		pos 		  = (backgroundImgHeight - bannerHeight) - (frac * (backgroundImgHeight-bannerHeight));

		    	$(this).css({'backgroundPosition':'0 -' + pos + 'px'});
	    	}

   		});

	};
	
    /**
     * Controls the fixed scrolling of the sidebar
     *
     * @since  v0.1
     */
	if($(".fixed-sidebar-container").length != 0){
		var sidebar = $(".fixed-sidebar-container");
		var sidebar_pos = sidebar.offset().top;
		if($("#disqus_thread").length > 0){ 
			var comments = $("#disqus_thread").offset().top;
		} else{ 
			var comments = 999999;
		}
		$(window).resize(function(){
			if(sidebar.hasClass('fixed-sidebar')){
				sidebar.removeClass('fixed-sidebar');
				sidebar_pos = sidebar.offset().top;
				if($("#disqus_thread").length > 0){ 
					var comments = $("#disqus_thread").offset().top;
				} else{ 
					var comments = 999999;
				}
				sidebar.addClass('fixed-sidebar');
			}
			else{
				sidebar_pos = sidebar.offset().top;
				if($("#disqus_thread").length > 0){ 
					var comments = $("#disqus_thread").offset().top;
				} else{ 
					var comments = 999999;
				}
			}
		});
		$(window).scroll(function(){
			var scrollTop = $(window).scrollTop();
			if(((scrollTop + 78) > sidebar_pos) && ((scrollTop + 78 + sidebar.height()) < comments)){
				sidebar.addClass('fixed-sidebar')
			} else{
				sidebar.removeClass('fixed-sidebar');
			}
		});
	}

    /**
     * Puts the Author's name in the fixed header when scrolled past the name in the body
     * on Author pages.
     *
     * @since  v0.2
     */
    if ($(".title.author-title").length != 0) {
        var author_name_pos = $(".author-info .author-title").offset().top;
        $(window).resize( function() {
            author_name_pos = $(".author-info .author-title").offset().top;
        });
        $(window).scroll( function() {
            var scrollTop = $(window).scrollTop();
            if (scrollTop > author_name_pos) {
                $(".title.author-title").addClass("author-title-show");
            } else {
                $(".title.author-title").removeClass("author-title-show");
            }
        });
    }
	
	window.setTimeout(function() {
		$(".add-so-button").css({'top':'-30px','display':'container'}).animate({'top':'43px','display':'container'},200);
	}, 400 /* but after 2000 ms */);
	$('#shoutoutText').focus();


    /**
     * Returns $_GET variable from the url.
     * (note: does not use jQuery)
     * 
     * To check the value of a get variable, use:
     *		var value = getUrlVars()['<key>'];
	 *
     * This currently does not return get variables that don't have
     * an associated value.
     * 
     * @since v0.2
     * @returns object with (key => value)
     */
    function getUrlVars() {
		var vars = {};
		var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
			vars[key] = value;
		});
		return vars;
	}

	//Smooth scrolling to anchors from anchor links on same page.
	$(function() {
	  $('a[href*=#]:not([href=#])').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
		  var target = $(this.hash);
		  target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
		  if (target.length) {
			$('html,body').animate({
			  scrollTop: target.offset().top - 72
			}, 1000);
			return false;
		  }
		}
	  });
	});

	$(window).scroll(function() {
		$(window).resize();
	});

	/**
	 *
	 *
	 */
	$('.comment-button').click( function(e) {
		
		e.preventDefault();

		// Create the pane.
		$('.comments').show(400);

	});

	/**
	 * Make pagination buttons white when on black background pages
	 *
	 * @since v0.6
	 */
	 if( $('div.container.stream.black').length == 1){
	 	$('div.all-link a').css('color', 'white');
	 }

	

});