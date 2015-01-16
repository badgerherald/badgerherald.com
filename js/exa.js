/**
 * Functionality specific to Twenty Thirteen.
 *
 * Provides helper functions to enhance the theme experience.
 */



$(document).ready(function() {

	/**
	 * Fastclick library, to removed 300ms delay for
	 * taps on mobile.
	 */
	$(function() {
	    FastClick.attach(document.body);
	});

	/** 
	 * Scrolling for banners
	 * 
	 * Issues: bugs on iOS, safari devices.
	 * 
	 * @author Will Haynes
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

			// log distance: console.log(windowHeight + ',' + distance);

			 if(distance > 0 && windowHeight > distance) {
		    	
		    	var	frac		  = (windowHeight - distance) / windowHeight,
		    		pos 		  = (backgroundImgHeight - bannerHeight) - (frac * (backgroundImgHeight-bannerHeight));

		    	$(this).css({'backgroundPosition':'0 -' + pos + 'px'});
	    	}

   		});

	};
	
	if($(".fixed-sidebar-container").length != 0){
		/* if($("#sidebar").length > 0){ 
			var sidebar = $(".sidebar-inner");
		} else if($(".post-sidebar").length > 0){ 
			var sidebar = $(".post-sidebar-scroll");
		} */
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

	$(".search-button").click(function(e) {
		e.preventDefault();
		$(this).find('input').first().attr("value","");
	});
	

	$("#main-nav #searchform #s").focus(function(){
		$("#main-nav li a").addClass("nav-search-focus");
		$(this).addClass("nav-search-focus");
	});
	$("#main-nav #searchform").on("blur", "#s", function(){
		$("#main-nav li a").removeClass("nav-search-focus");
		$(this).removeClass("nav-search-focus");
	});

	var toggleNav = function() {
        if ($("#page").hasClass("pullout-active")) {
            var offset = $("#page").css("top");
            $("#page").css({"top":"auto"});
            offset = parseInt(offset) * -1;
            $("#pullout").toggleClass("active");
            $("#page").toggleClass("pullout-active");
            $("body, html").scrollTop(offset);;
            console.log(offset);
        } else {
            var offset = window.pageYOffset;
            $("#page").css({"top": "-" + offset + "px"});
            console.log(offset);
            $("#pullout").toggleClass("active");
            $("#page").toggleClass("pullout-active");
        }
    }

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
    $(".nav-control").click(function(e){
        toggleNav();
        e.stopPropagation();
    });
    $("#pullout").click(function(e) {
        e.stopPropagation();
    });
    $("body").click(function(e) {
        if ($("#pullout").hasClass("active")) {
            toggleNav();
        }
    });

    $("ul#main-nav li").hover(function(e) {
        updateNavActive($(this));
    });

    if ($(".progress").length !== 0) {
        $(window).scroll(function() {
            var scrollTop = $(window).scrollTop();
            var scrollH = ($("#content").height() + $("#content").offset().top) - ($(window).height() / 2);
            var progress = Math.max(0, Math.min(1, scrollTop/scrollH)) * 100;
            $(".progress .progress-bar").attr("aria-valuenow", Math.floor(progress)).css("width", progress+"%");
        });
    }

	
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

});