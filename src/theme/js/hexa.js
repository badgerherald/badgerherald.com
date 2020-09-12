jQuery(document).ready(function($) {

	
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