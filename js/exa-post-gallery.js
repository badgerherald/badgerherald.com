( function($) {
	$(document).ready(function() {
		var speed = 600;
		var auto = 5000;
		window.mySwipe = new Swipe(document.getElementById('swipe'), {
			startSlide: 0,
			speed: speed,
			auto: auto,
			continuous: true,
			disableScroll: false,
			stopPropagation: false,
			callback: swiped,
			transitionEnd: function(index, elem) {}
		});

		swiped(0,document.getElementById('slider'));
		window.mySwipe.stop();
		/**
		 * Function: swiped
		 * 
		 * Callback function that highlights the new slider 
		 * position on the slider navigation.
		 *
		 * @param index the index of the now active slider 
		 * @param elem DOM element of the slider
		 */ 
		function swiped(index,elem) {
			$(".slider-nav").find('li').removeClass("active").eq(index).addClass("active");
		}
		/**
		 * Listener
		 * 
		 * Listens for clicks on the slider nav to change
		 * slider position.
		 */ 
		$(".slider-nav li").click(function() {

			var index = $(".slider-nav").find("li").index($(this));

			window.mySwipe.slide(index,speed);

		});
		var galleryNav = $('ul.slider-nav');
		var gallerySize = galleryNav.children('li').length;
		var pagingSize = 4;
		if (window.innerWidth >= 768) {
			pagingSize = 5;
		}
		var galleryPages = Math.ceil(gallerySize / pagingSize);
		var currGalPage = 0;
		var thumbWidth = $('.slider-nav-container').width() / pagingSize;
		console.log(thumbWidth);
		var thumbRatio = 450/690;
		var thumbHeight = (thumbWidth * thumbRatio) + 12; //12 is the bottom padding of each li within the thumbnail list.
		galleryNav.children('li').each(function(index) {
			$(this).width(thumbWidth-6);
		});
		galleryNav.width(thumbWidth * gallerySize);
		galleryNav.height(thumbHeight);
		$('.slider-nav-page.prev').css({'display':'none'});

		$('.slider-nav-page').click(function() {
			var next = true;
			if ($(this).hasClass('prev')) {
				next = false;
			}
			if (next) {
				if(currGalPage < galleryPages - 1) {
					currGalPage++;
					$('.slider-nav-page.prev').css({'display':'block'});
					if(currGalPage === galleryPages - 1) {
						$('.slider-nav-page.next').css({'display':'none'});
					}
				}
			} else {
				if (currGalPage > 0) {
					currGalPage--;
					$('.slider-nav-page.next').css({'display':'block'});
					if(currGalPage === 0) {
						$('.slider-nav-page.prev').css({'display':'none'});
					}					
				}
			}
			console.log(currGalPage * (pagingSize * thumbWidth * (-1)));
			galleryNav.css('left', (currGalPage * (pagingSize * thumbWidth * (-1))) + 'px');
		});

		$('.swipe-slide-nav-page').click(function() {
			var next = true;
			if ($(this).hasClass('prev')) {
				next = false;
			}
			var index = $(".slider-nav").children('li').index($('li.active'));
			console.log(index);
			if (next) {
				index++;
				if (index === gallerySize) {
					index = 0;
				}
			} else {
				index--;
				if (index < 0) {
					index = gallerySize - 1;
				}
			}
			if (currGalPage !== Math.floor(index/pagingSize)) {
				currGalPage = Math.floor(index/pagingSize);
				galleryNav.css('left', (currGalPage * (pagingSize * thumbWidth * (-1))) + 'px');
				$('.slider-nav-page.next').css({'display':'block'});
				$('.slider-nav-page.prev').css({'display':'block'});
				if(currGalPage === galleryPages - 1) {
					$('.slider-nav-page.next').css({'display':'none'});
				} else if(currGalPage === 0) {
					$('.slider-nav-page.prev').css({'display':'none'});
				}	
			}
			console.log(index);
			window.mySwipe.slide(index,speed);
		});


	});	
})(jQuery);