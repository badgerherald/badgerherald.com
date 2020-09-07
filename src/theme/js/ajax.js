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

			


});
