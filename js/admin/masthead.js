/**
 * Admin JS for exa_masthead post type.
 * // todo: This is messy... Each jQuery block here is basically the same. 
            But the first controls assignment rows  while the section 
            controls sections.

            It would be good to abstract this.
 */

// Fist, stuff for managing assignments:
jQuery(document).ready(function($) {

	function getButtonCount(button) {
		if( !button.attr('data-click-count') ) {
			return 0;
		}
		return parseInt( button.attr('data-click-count') );
	}

	function getUpdatedButtonCount(button) {
		var newCount = getButtonCount(button) + 1;
		button.attr( 'data-click-count', newCount );
		return newCount;
	}

	/**
	 * Takes a 
	 */
	function increment_assignment_indexes(listItem) {
		// Recursion, to increment the last item first.
		if( listItem.next().length > 0 ) {
			increment_assignment_indexes(listItem.next());
		}

		var section_index = listItem.closest('.exa_masthead_section').data('section-index');
		var currentIndex = parseInt( listItem.attr('data-staff-index') );
		var userField = listItem.find("[name='exa_masthead_assignments[" + section_index + "][staff][" + currentIndex + "][uid]']")
		var positionField = listItem.find("[name='exa_masthead_assignments[" + section_index + "][staff][" + currentIndex + "][position]']")		
	
		userField.attr("name","exa_masthead_assignments[" + section_index + "][staff][" + (currentIndex + 1) + "][uid]")
		positionField.attr("name","exa_masthead_assignments[" + section_index + "][staff][" + (currentIndex + 1) + "][position]")		
		listItem.attr('data-staff-index', currentIndex + 1);	

	}

	function assignment_add_toggle_clicked(addButton) {
		var clickCount = getUpdatedButtonCount(addButton);

		var listItem = addButton.closest('li.masthead-assignment-row');

		var staff_index = listItem.data('staff-index');
		var section_index = listItem.closest('.exa_masthead_section').data('section-index');

		var data = {
			'action': 'exa_masthead_user_field_html',
			'staff_index': staff_index + 1,
			'section_index': section_index,
			'user_select_id': 'inserted-masthead-field-' + section_index + '-' + staff_index + '-' + clickCount
		};

		$.ajax({	type: "POST",
  					url: ajaxurl,
  					data: data,
  					context: listItem,
					success: function(response) {
								var listItem = $(this);
								increment_assignment_indexes(listItem.next());							
								listItem.after(response);
						 	 }
				});
	}

	function assignment_remove_toggle_clicked(removeButton) {
		var listItem = removeButton.closest('li.masthead-assignment-row');
		listItem.remove();
	}

	function assignment_up_toggle_clicked(upButton) {
		var listItem = upButton.closest('li.masthead-assignment-row');
		if( listItem.prev().length > 0 ) {
			move_row_down(listItem.prev());
		}
	}

	function assignment_down_toggle_clicked(downButton) {
		var listItem = downButton.closest('li.masthead-assignment-row');
		move_row_down(listItem);
	}

	function move_row_down(listItem) {
		var nextListItem = listItem.next('li.masthead-assignment-row');
		if( nextListItem.length > 0 ) {
			listItem.detach();
			nextListItem.after(listItem);
			increment_assignment_indexes(listItem);
			increment_assignment_indexes(listItem);
		}
	}

	$(document).on( 'click', '.exa_masthead_assignment_toggle', function() {

		var toggle = $(this);
		var action = $(this).data('masthead-assignment-action');

		switch (action) {
			case 'add':
				assignment_add_toggle_clicked(toggle);
				break;
			case 'remove':
				assignment_remove_toggle_clicked(toggle);
				break;
			case 'up':
				assignment_up_toggle_clicked(toggle);
				break;
			case 'down':
				assignment_down_toggle_clicked(toggle);
				break;
			default:
			  console.log('Unexpected action');
		}

		// something changed: warn user to save:
		$(window).on( 'beforeunload.edit-post', function() {
    		return true;
		})

	});

});


// Second, stuff for managing sections:
jQuery(document).ready(function($) {

	/**
	 * Takes a 
	 */
	function increment_section_indexes(section) {

		if( section.length == 0 ) {
			return;
		}
		// Recursion, to increment the last item first.
		if( section.next('.exa_masthead_section').length > 0 ) {
			increment_section_indexes(section.next('.exa_masthead_section'));
		}

		var section_index = parseInt( section.attr('data-section-index') );

		var userFields = section.find("[name^='exa_masthead_assignments[" + section_index + "][staff]']");
		var positionFields = section.find("[name^='exa_masthead_assignments[" + section_index + "][staff]']");
		var titleField = section.find("[name='exa_masthead_assignments[" + section_index + "][title]']");

		userFields.each(function() {
			userField = $(this);
			var staff_index = userField.data('staff-index');
			userField.attr("name","exa_masthead_assignments[" + (section_index + 1) + "][staff][" + staff_index + "][uid]");
		});

		positionFields.each(function() {
			positionField = $(this);
			var staff_index = positionField.data('staff-index');
			positionField.attr("name","exa_masthead_assignments[" + (section_index + 1) + "][staff][" + staff_index + "][position]");
		});

		titleField.attr("name","exa_masthead_assignments[" + (section_index + 1) + "][title]");
		section.attr('data-section-index', section_index + 1);	

	}

	function section_add_toggle_clicked(addButton) {
		var section = addButton.closest('.exa_masthead_section');

		var section_index = section.data('section-index');

		var data = {
			'action': 'exa_masthead_section_html',
			'section_index': section_index + 1,
		};

		$.ajax({	type: "POST",
  					url: ajaxurl,
  					data: data,
  					context: section,
					success: function(response) {
								var section = $(this);
								increment_section_indexes(section.next('.exa_masthead_section'));							
								section.after(response);
						 	 }
				});
	}

	function section_remove_toggle_clicked(removeButton) {
		var section = removeButton.closest('.exa_masthead_section');
		section.remove();
	}

	function section_up_toggle_clicked(upButton) {
		var section = upButton.closest('.exa_masthead_section');
		if( section.prev('.exa_masthead_section').length > 0 ) {
			move_section_down(section.prev('.exa_masthead_section'));
		}
	}

	function section_down_toggle_clicked(downButton) {
		var section = downButton.closest('.exa_masthead_section');
		move_section_down(section);
	}

	function move_section_down(section) {
		var nextSection = section.next('.exa_masthead_section');
		if( nextSection.length > 0 ) {
			section.detach();
			nextSection.after(section);
			increment_section_indexes(section);
			increment_section_indexes(section);
		}
	}


	$(document).on( 'click', '.exa_masthead_section_toggle', function() {

		var toggle = $(this);
		var action = toggle.data('masthead-assignment-action');

		switch (action) {
			case 'add':
				section_add_toggle_clicked(toggle);
				break;
			case 'remove':
				section_remove_toggle_clicked(toggle);
				break;
			case 'up':
				section_up_toggle_clicked(toggle);
				break;
			case 'down':
				section_down_toggle_clicked(toggle);
				break;
			default:
			  console.log('Unexpected action');
		}

		// something changed: warn user to save:
		$(window).on( 'beforeunload.edit-post', function() {
    		return true;
		})

	});

});
