jQuery(document).ready(function($) {

	/** Add JS to user select inputs */
	$(".exa-user-select").autocomplete({
		minLength: 0,
		source: exa_user_select.users,
		autofocus: true,
		focus: function( event, ui ) {
			$(event.target).val( ui.item.display_name );
			return false;
		},
		select: function (event, ui) {
			console.log('selected');
			var id = $(event.target).attr("id");
			$(event.target).attr("value", ui.item.label);
			$('#' + id + '-input').attr("value", ui.item.value);
			return false;
		},
		close: function (event, ui) {
			var id = $(event.target).attr("id");
			if($(event.target).attr("value") == "") {
				$('#' + id + '-input').attr("value", "");
			}
		}
	}).autocomplete( "instance" )._renderItem = function( ul, item ) {
		return $( "<li>" )
			.append( "<a>" + item.label + "</a>" )
			.appendTo( ul );
	};

});