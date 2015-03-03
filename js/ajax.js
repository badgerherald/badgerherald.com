jQuery( document ).ready(function() {

//	.replaceWith()

	jQuery.get(
		exa.ajaxurl,
		{
			action: "ajax-exa_ajax_comments",
			nonce: exa.nonce,
			id: exa.id
		}, function( response ) { 

			console.log(response);
			$('.exa-ajax-comments').replaceWith(response);

		}, 'html'
	);

			/*
	jQuery(".hrld-inline-link").bind( "click", function(e) {
		
		e.preventDefault();

		url = jQuery( this ).attr( 'href' );

		jQuery.post(
			exa.ajaxurl,
			{
				action: "ajax-exa_ajax",
				nonce: exa.nonce,
				hrld_inline_url: url,		// The clicked URL.
				hrld_inline_id: exa.id 		// The post ID.
			}, function( response ) { 
				console.log(response);
			}
			);

		window.open(url,"_blank");

	}); */

});
