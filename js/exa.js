/**
 * Functionality specific to Twenty Thirteen.
 *
 * Provides helper functions to enhance the theme experience.
 */



$(document).ready(function() {

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
	var anchorBottom;

	function createPane(anchor,type,anchorBottom) {

		anchorBottom = anchorBottom;

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

		var width = pane.outerWidth();
		paneAnchor = anchor;

		block.animate({'position':'relative','left':width+180});
		openPane = pane.css({
			'margin-left':-(width + 180),
			'display':'block'
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
	
		anchorPane();

		return pane;

	}

	function closePane() {

		$('.screen').remove();
		var block = paneAnchor.parents('.block');
		block.animate({'position':'relative','left':0});
		openPane.css({'display':'none'});

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
		var clearance = 120;

		// pane.css("top",anchorTop - wrapper.offset().top);


		if( anchorTop < scrollTop + clearance ) {
			$("html, body").animate({ scrollTop: anchorTop - clearance });
		} else if( anchorBottom > scrollTop + $(window).height()/3) {
			$("html, body").animate({ scrollTop: anchorTop - $(window).height()/3 });
		}


/*
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
	
			console.log('pt:'+paneTop);
			console.log('st:'+scrollTop);
			if( paneTop < blockTop || paneTop > scrollTop ) {
	
				var height = Math.max(blockTop,scrollTop);

				height = $(window).height()  - (height - scrollTop) - 120;

				pane.css({
					"height":height
				});

			}

		}

		*/

	}

});