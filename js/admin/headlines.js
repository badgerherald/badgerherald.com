/**
 * UI for interacting with alternate headlines.
 */

jQuery(document).ready(function($) {

	if($("textarea[name='_exa_altheads']").val() != '') {
		toggle_edit_on();
	} else {
		toggle_edit_off();
	}
	
	$(".altheads .edit").on("click",function() {
		var textarea = $("textarea[name='_exa_altheads']");
		if(textarea.css('display') == 'none') {
			toggle_edit_off();
			$(this).text('Save');
		} else {
			toggle_edit_on();
			$(this).text('Edit');
		}
	});

	function toggle_edit_on() {

		var textarea = $("textarea[name='_exa_altheads']");
		var altheads = textarea.val().split('\n');
		var ul = $("<ol class='exa-althead-list'></ol>");

		for (var i = 0; i < altheads.length ; i++) {
			if(altheads[i] != '') {
				ul.append('<li><a>' + altheads[i] + '</a></li>');
			}
		}

		ul.find('li').on("click", swap_titles );

		function swap_titles() {

			// todo: switch out title.
			var oldtitle = $("[name='post_title'").val();
			var newtitle = $(this).find('a').html();
			var ul = $("ol.exa-althead-list");

			var li = $('<li><a>' + oldtitle + '</a></li>').on("click", swap_titles);
			ul.append(li);
			$("[name='post_title'").val(newtitle);
			$(this).remove();

			// update text area:
			var heads = ul.find('li a');
			var str = "";

			for (var i = 0; i < heads.length ; i++) {
				str += $(heads[i]).text() + "\n";
			}
			$("textarea[name='_exa_altheads']").val(str);

		}

		textarea.after(ul);
		textarea.hide();

	}

	function toggle_edit_off() {
		$("ol.exa-althead-list").remove();
		$("textarea[name='_exa_altheads']").show();
	}

});