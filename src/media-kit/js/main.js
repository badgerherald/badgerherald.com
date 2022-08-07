/**
 *
 * JS for The Badger Herald's online rate card.
 *
 * author: Will Haynes (@willhaynes)
 * organization: The Badger Herald (@badgerherald) 
 * github: http://github.com/badgerherald/rate-card
 *
 * Copyright © 2015 · The Badger Herald
 *
 * Released under Creative Commons Attribution License
 *
 */


$(document).ready(function() {

	/**
	 * =========================================================================
	 * Region: Global selectors for frequently accessed elements.
	 * =========================================================================
	 */

	var w = $(window);


	/**
	 * =========================================================================
	 * Region: Listener to stick the header to the top.
	 * =========================================================================
	 */

	var navholder;
	var isStuck = false;

	$(window).resize(function() {
		$('.slide').css('min-height',window.innerHeight - 140);
	}).resize();

	$(window).scroll(function() {

		if(isStuck != shouldStick()) {
			if(isStuck) {
				unstickNav();
			} else {
				stickNav();
			}
		}
		
	}).scroll();
	
	/**
	 * Stick the nav to the top.
	 */
	function stickNav() {
		$('nav.nav-slide').css({
			'position':'fixed',
			'top':'0'
		});
		var navHeight = $('nav.nav-slide').outerHeight(true);
		navholder.css({'height':navHeight});
		isStuck = true;
	}

	/**
	 * Unstick the nav from the top.
	 */
	function unstickNav() {
		$('nav.nav-slide').css({
			'position':'inherit',
			'top':'0'
		});
		navholder.css({'height':'0'});
		isStuck = false;
	}

	/**
	 * If the nav should stick, return true. Else, return false.
	 */
	function shouldStick() {

		// Insert the element, once.
		if( !navholder ) {
			$('<div id="nav-holder"></div>').insertAfter('nav.nav-slide');
			navholder = $('#nav-holder');
		}

		var scrollPos = w.scrollTop();
		var navOffset = navholder.offset().top;

		// We only subtract the height if it's not stuck.
		var navHeight = !isStuck ? $('nav.nav-slide').outerHeight(true) : 0;

		// console.log("scrollPos: " + scrollPos + ", navOffset: " + navOffset + ", navHeight: " + navHeight);

		if(scrollPos >= navOffset - navHeight) {
			return true;
		}
		else {
			return false;
		}

	}
 
	/**
	 * =========================================================================
	 * Region: Animate the color of the background.
	 * =========================================================================
	 */
	
	// currentSlide is the slide that we're currently on.
	var currentSlide;

	w.scroll(function() {

		// We have the navholder here because it "adds" to what gets hidden.
		var scrollPos = w.scrollTop() + navholder.outerHeight();

		var minPixelsHidden;
		var slideInView;

		// Go through each slide and determine which one is in view.
		// (which has the smallest amount "above" the fold).
		$('.content-slide').each(function(i){

			var slideOffset = $(this).offset().top;

			if( scrollPos > slideOffset ) {
				if( !minPixelsHidden || minPixelsHidden > (scrollPos - slideOffset) ) {
					minPixelsHidden = scrollPos - slideOffset;
					slideInView = i;
				}
			}

		});

		if( typeof currentSlide === "undefined" ) {
			switchToSlide(slideInView,false);
		}
		else if( currentSlide != slideInView ) {
			switchToSlide(slideInView,true);
		}

	}).scroll();

	/**
	 * Animates the pages background to the passed in color.
	 *
	 *  // Todo: deal with text here too.
	 *
	 * @param color to animate to.
	 */
	function switchToSlide(slideIndex) {
		switchToSlide(slideIndex,true);
	}
	function switchToSlide(slideIndex,animate) {

		currentSlide = slideIndex;

		var slide = $('.content-slide')[slideIndex];
		var bgColor = $(slide).data('nav-background');
		var txtColor = $(slide).data('nav-text-color');
		
		if(txtColor==null) return;
		
		if(!animate) {
			$('nav[role=main]').css({
				'background-color':bgColor,
				'border-color':hex2rgba(txtColor,.2)
			});	

			$('nav[role=main] ul li').css({
				'color':txtColor,
				'border-color':hex2rgba(txtColor,.2)
			});

			$('nav[role=main] ul li a').animate({
				'color':txtColor,
			});

		} else {

			$('nav[role=main]').animate({
				'background-color':bgColor,
				'border-color':hex2rgba(txtColor,.2)
			});

			$('nav[role=main] ul li').animate({
				'color':txtColor,
				'border-color':hex2rgba(txtColor,.2)
			});

			$('nav[role=main] ul li a').animate({
				'color':txtColor,
			});
		}

	}

	function hex2rgba(x,a) {
		var r=x.replace('#','').match(/../g),g=[],i;
		for(i in r){g.push(parseInt(r[i],16));}g.push(a);
		return 'rgba('+g.join()+')';
	}

	/**
	 * =========================================================================
	 * Region: Draw print ad sizes
	 * =========================================================================
	 */

	function drawAds() {

		$('.print-size canvas').each( function() {

			// variables: 
			var canvas 	= $(this),
				ctx		= canvas[0].getContext("2d"),
				width 	= $(this).attr("data-ad-width"),
				height 	= $(this).attr("data-ad-height"),
				adColor = "#cd0f18",
				gutterColor = "rgba(0,0,0,.1)",
				columnR = 20,	// column ration (how thick the column is comparatively).
				gutterR = 1, 	// gutter ratio (how thick the gutter is comparatively).
				column  = parseInt ( ( canvas.parent().width() / (columnR*6+gutterR*7) )*columnR ) ,
				gutter  = parseInt ( ( canvas.parent().width() / (columnR*6+gutterR*7) )*gutterR ) ,
				canvasSize = (column*6)+(gutter*7),
				columnInch = 1.556,		// Size of a column inch (in print).
				gutterInch = 0.111;		// Size of a gutter (in print).

			// canvas setup:
			console.log(width + " " + height);

			canvas.attr("width",  canvasSize) ;
			canvas.attr("height", canvasSize );

			canvas.css({
				'background':"rgba(0,0,0,.045)",
				'display':'block',
				'margin-bottom':"10px",
				'width':'100%',
				'height':'100%'
			});

			// draw gridlines:
			ctx.fillStyle = gutterColor;
			for (var i=1; i<6; i++) {
				//vertical
				ctx.fillRect(gutter*i+column*i,gutter,gutter,(column*6)+gutter*5);
				// horizontal
				ctx.fillRect(gutter,gutter*i+column*i,(column*6)+gutter*5,gutter);
			}

			// draw ad: 
			ctx.fillStyle = adColor;
			var adWidth = column*width + width*gutter + gutter/2; // gutter/2 so it overflows (tastefully)
			var adHeight = column*height + height*gutter + gutter/2;
			ctx.fillRect(canvasSize-adWidth-gutter,canvasSize-adHeight-gutter,adWidth,adHeight);
			console.log(w);

			// populate price and values:
			var inchWidth 	= (columnInch*width + gutterInch*(width-1)).toFixed(3),
				inchHeight 	= (columnInch*height + gutterInch*(height-1)).toFixed(3);

			canvas.parent().find(".size .width").html(inchWidth + '\"');
			canvas.parent().find(".size .height").html(inchHeight + '\"');

		});

	}
	drawAds();

	function priceAds() {

		var inchPrice = $('.rate-nav').find('a.active').parent().attr('data-rate'),
			priceType = $('.rate-nav').find('a.active').html() + " Rate";

		$('.print-size').each( function() {
			
			var ad = $(this),
				width = $(this).find('canvas').attr("data-ad-width"),
				height = $(this).find('canvas').attr("data-ad-height");

			var price = width*height*inchPrice;

			ad.find('.price .dollars').html("$" + price.toFixed(2));
			ad.find('.price .type').html(priceType);

		});

	}
	priceAds();
	$('.rate-nav').find('a').click(function(e) {

		e.preventDefault();
		$(this).parents('.rate-nav').find('a').removeClass('active');
		$(this).addClass('active');

		priceAds();

	});

});



