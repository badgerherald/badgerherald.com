/**
 * Script for operating post galleries
 *
 */

(function($) {

	$.fn.exaGalleryLink = function(options) {

		// anchor point for the gallery on the page
		var anchor;

		var prevScrollTop;

		var freezePage = function() {
			$('body').css('overflow','hidden');
		}

		var unfreezePage = function() {
			$('body').css('overflow','inherit');
		}


		// Removes the gallery from the screen
		var closeGallery = function() {
			if( anchor !== undefined ) {
				anchor.empty();
			}
			unfreezePage();
		}

		var goLeft = function(galleryContainer) {
			var currentSlide = galleryContainer.find('.active');
			currentSlide.fadeOut(300,function() {
				currentSlide.removeClass('active');
				var prevSlide = currentSlide.prev('.image-slide').length > 0 ? currentSlide.prev('.image-slide') : galleryContainer.find('.image-slide').last();
				prevSlide.fadeIn(300,function() {
					prevSlide.addClass('active');
				});
			});
		}

		var goRight = function(galleryContainer) {
			var currentSlide = galleryContainer.find('.active');
			currentSlide.fadeOut(300,function() {
				currentSlide.removeClass('active');
				var nextSlide = currentSlide.next('.image-slide').length > 0 ? currentSlide.next('.image-slide') : galleryContainer.find('.image-slide').first();
				nextSlide.fadeIn(300,function() {
					nextSlide.addClass('active');
				});
			});
		}

		var bindNavigationEvents = function(galleryContainer) {
			galleryContainer.find('.left-toggle').on('click',function(e) {
				goLeft(galleryContainer);
			});
			galleryContainer.find('.right-toggle').on('click',function(e) {
				goRight(galleryContainer);
			});
			galleryContainer.find('.close').on('click',function(e) {
				closeGallery();
			});
		}

		var positionContainer = function(galleryContainer) {
			$(window).on('resize',function(e) {
				var adminBarHeight = $('#wpadminbar').height();
				galleryContainer.height( $(window).height() - adminBarHeight );
				galleryContainer.css('top', adminBarHeight );
			}).resize();
		}

		var showGallery = function(galleryContainer) {
			galleryContainer.hide();
			anchor.append(galleryContainer);
			galleryContainer.fadeIn();
		}

		// Opens a gallery with the given imageIDs
		var launchGallery = function(imageIDs) {
			closeGallery();

			var data = {
				action: 'exa-galleries-load',
				images: imageIDs
			}

			$.ajax({	type: "POST",
						url: exa_galleries.ajaxurl,
						data: data,
						context: anchor,
						success: function(response) {
									var anchor = $(this);
									var galleryContainer = $(response);
									
									bindNavigationEvents(galleryContainer);
									freezePage();
									positionContainer(galleryContainer);
									showGallery(galleryContainer);
						},
						failed: function(response) {
							alert('Something went wrong');
						}
					});
		}

		var galleryLinkClicked = function(e) {
			imageIDs = $(this).data('image-ids');
			launchGallery(imageIDs);
		}
 
		anchor = $('<div class="exa-gallery-anchor"></div>');
		$('body').prepend(anchor);

		this.on('click',galleryLinkClicked);
		
		return this;
	}

})(jQuery);
