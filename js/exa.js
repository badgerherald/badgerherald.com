/**
 * Functionality specific to Twenty Thirteen.
 *
 * Provides helper functions to enhance the theme experience.
 */



$(document).ready(function() {


	/**
	 * A pair of functions to turn of html scrolling.
	 *
	 * This is to turn scrolling for a child element on.
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
	
	window.setTimeout(function() {
		$(".add-so-button").css({'top':'-30px','display':'block'}).animate({'top':'43px','display':'block'},200);
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


    /**
     * Toggles the class of the pullout navigation
     * 
     * @since  v0.2
     */
    var toggleNav = function() {
        if ($("#page").hasClass("pullout-active")) {
            var offset = $("#page").css("top");
            $("#page").css({"top":"auto"});
            offset = parseInt(offset) * -1;
            $("#pullout").toggleClass("active");
            $("#page").toggleClass("pullout-active");
            $("body, html").scrollTop(offset);
        } else {
            var offset = window.pageYOffset;
            $("#page").css({"top": "-" + offset + "px"});
            $("#pullout").toggleClass("active");
            $("#page").toggleClass("pullout-active");
        }
    }

	/**
	 * Open the pullout on pageload if pullout=true is a set get variable.
	 *
	 * @since v0.2
	 */
	if(getUrlVars()['pullout'] == 'true') {
		toggleNav();
	}

    /**
     * Updates the class of the currently hovered nav section
     * @param  {jQuery object} curr The current DOM element hovered
     * 
     * @since  v0.2
     */
    var updateNavActive = function(curr) {
        var dataPostList = curr.attr("data-post-list");
        if (dataPostList === "null") {
            return;
        }
        $("ul#main-nav").children("li").each(function() {
            $(this).removeClass("active");
        });
        curr.addClass("active");
        $("#pullout .nav-stream-container").children(".nav-stream").each(function() {
            $(this).removeClass("active");
            if ($(this).attr("data-post-list") === dataPostList) {
                $(this).addClass("active");
            }
        });
    }

    /**
     * Toggles the pullout when menu button is clicked
     *
     * @since  v0.2
     */
    $(".nav-control").click(function(e){
        toggleNav();
        e.stopPropagation();
    });

    /**
     * Closes the pullout if the body of the page is clicked
     *
     * @since  v0.2
     */
    $("body").click(function(e) {
        if ($("#pullout").hasClass("active")) {
            toggleNav();
        }
    });

    /**
     * Prevents propagation of click event if #pullout is clicked.
     * This stops the previous body click event handler from closing the pullout
     * while it is open if clicked within it.
     *
     * @since  v0.2
     */
    $("#pullout").click(function(e) {
        e.stopPropagation();
    });

    /**
     * Updates the current nav section on hover
     *
     * @since  v0.2
     */
    $("ul#main-nav li").hover(function(e) {
        updateNavActive($(this));
    });

    /**
     * Initiates the first section of the pullout as active on page load.
     *
     * @since  v0.2
     */
    $("#pullout .nav-stream-container").children(".nav-stream").first().addClass("active");
    $("ul#main-nav").children("li").first().addClass("active");

    /**
     * Handles the width calculations of the article progress bar
     *
     * @since  v0.2

    if ($(".progress").length !== 0) {
        $(window).scroll(function() {
            var scrollTop = $(window).scrollTop();
            var scrollH = ($("#content").height() + $("#content").offset().top) - ($(window).height() / 2);
            var progress = Math.max(0, Math.min(1, scrollTop/scrollH)) * 100;
            $(".progress .progress-bar").attr("aria-valuenow", Math.floor(progress)).css("width", progress+"%");
        });
    }
    */

	//Smooth scrolling to anchors from anchor links on same page.
	$(function() {
	  $('a[href*=#]:not([href=#])').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
		  var target = $(this.hash);
		  target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
		  if (target.length) {
			$('html,body').animate({
			  scrollTop: target.offset().top - 79
			}, 1000);
			return false;
		  }
		}
	  });
	});

	$(window).scroll(function() {

		$(window).resize();

	});

	//script for quiz function
	$(".answer-box label").click(function(e){
		var answerParents = $(this).parents("div.quiz-question");
		answerParents.find("li.answer-box").removeClass("inactive");
	});


	/**
	 * Open a tweet pane
	 *
	 *

	$(".article-title.tweet-link").click( function(e) {

		e.preventDefault();

		// Create a new pane.
		var pane = createPane($(this),"tweet",true);

		var href = $(this).attr('href');

		// pane.append('<iframe src="' + href + '"></iframe>');

	});
	 */

	/**
	 * Open an author pane
	 *
	 *
	 */
	$(".open-author-pane").click( function(e) {

		e.preventDefault();

		// Create a new pane.
		var pane = createPane($(this),"author",true);

	});

	/**
	 *
	 *
	 */
	$('.open-comments-pane').click( function(e) {
		
		e.preventDefault();

		// Create the pane.
		var pane = createPane($(this),"comments",true);

	});


	/**
	 * Creates a new pane and inserts it before
	 * the passed in anchor.
	 *
	 * Also positions the pane and animates to its existance
	 * in the case that it would be slightly off screen.
	 *
	 * @since v0.2
	 */

	var isPaneOpen = false;
	var openPane;
	var paneAnchor;

	// anchoredBottom meaning that we're positioned abosolute to the bottom.
	var anchoredBottom = false;

	function createPane(anchor,type,modal) {

		paneAnchor = anchor;

		var block = anchor.parents('.block');
		var wrapper = block.children('.wrapper');

		if (!anchor.prev('*').hasClass('aside-pane') ){
			var pane = $('<aside class="aside-pane aside-' + type + '">dd</aside>').insertBefore(anchor);
		}
		else {
			var pane = anchor.prev('*');
		}


		$('<div id="#screen" class="screen"></div>').css({
			"background":"green",
			"width":"100%",
			"height":"2000px",
			"position":"fixed",
			"left": "0",
			"top" : "0",
			"z-index": "4",
			"background":"#eff4f6",
			"opacity":".5"
		}).prependTo('#page');
		
		pane.css({
			"z-index":"5"
		});

		$('.screen').click(function () {
			closePane();
		});

		var width = 540;

		// have an extra column, fine.
		if(pane.hasClass('aside-pane-wide')) {
			width = 640;
		}

		var offset = parseInt(pane.css('margin-right'));

		console.log(offset);

		block.animate({'position':'relative','left':width});
		openPane = pane.css({
			'margin-left':-width+offset,
			'display':'block',
			'top':'inherit'
		});

		// window scroll decides how to position the pane
		isPaneOpen = true;

		var clearance = 120;

		var pane = openPane;
		var anchor = paneAnchor;
		var block = pane.parents('.block');
		var wrapper = block.children('.wrapper');
		var anchorTop = anchor.offset().top;
		var anchorHeight = anchor.outerHeight();

		var scrollTop = $(window).scrollTop();

		var blockTop = block.offset().top;
		var blockBottom = blockTop + block.outerHeight();

		var paneBottom = scrollTop+pane.outerHeight()+240;

		if(modal) {
			$(window).scroll(function(e){ e.preventDefault()});
		}	
		anchorPane();

		return pane;

	}

	function closePane() {

		$('.screen').remove();
		var block = paneAnchor.parents('.block');
		block.animate({'position':'relative','left':0});
		openPane.css({'display':'none'});

		/* * *
		 * Kind of a hack, but:
		 *
		 * Set margin-right, and exa will send it more
		 * left when it calculates the width.
		 *
		 * * */

		openPane.css({
			'margin-left': 0,
		});

		/* * *
		     *
		 * * */

		openPane = false;
		isPaneOpen = false;
		paneAnchor = null;



	}

	function anchorPane() {

		var anchor = paneAnchor;
		var pane = openPane;
		var block = anchor.parents('.block');
		var wrapper = block.children('.wrapper');

		var anchorTop = anchor.offset().top;
		var anchorHeight = anchor.outerHeight();
		var anchorBottom = anchorTop + anchorHeight;

		var scrollTop = $(window).scrollTop();
		var clearance = 60;

		// pane.css("top",anchorTop - wrapper.offset().top);


		// Have we animated yet? Want to avoid glitches that might happen
		// on small screens that could animate between areas.
		var animated = false;

		if( anchorTop < scrollTop + clearance ) {
			// Of the page upper.
			$("html, body").animate({ scrollTop: anchorTop - clearance });
		}

		// This is not good enough. We must also check that we don't overflow our length.

		var paneTop = pane.offset().top;
		var paneBottom = paneTop + pane.outerHeight();

		var blockTop = block.offset().top;
		var blockBottom = blockTop + block.outerHeight();

		if ( paneBottom > blockBottom ) {

			pane.css({
				"top":"inherit",
				"bottom":"30px"
			});

			// But now it might be taller than our screen, or the amount of block showing.
			
			// We moved pane, update these.
			paneTop = pane.offset().top;
			paneBottom = paneTop + pane.outerHeight();

			console.log('pt:'+paneTop);
			console.log('st:'+scrollTop);

			var screenSpace = $(window).height() - clearance*2;
			if( paneTop < blockTop || pane.outerHeight() > screenSpace ) {

				var height = Math.min(block.outerHeight(),screenSpace);

				pane.css({
					"height":height,
					"overflow":"scroll"
				});

			}

			anchoredBottom = true;

			if( !animated && anchorBottom > scrollTop + $(window).height()/3) {
				// Of the page lower.
				$("html, body").animate({ scrollTop: anchorTop - $(window).height() + clearance });
			}

		}


	}

});