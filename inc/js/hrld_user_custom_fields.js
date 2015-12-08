	var file_frame;
	jQuery(document).ready(function($) {
		
		$('#user-meta-hrld_staff_banner_button').click(function() {
			
			//wp_uploader settings
			var custom_uploader = wp.media({
					title: "Select Image",
					multiple: false,
					frame: 'select',
					library: { type: 'image' },
					orientation: 'landscape'
				});
			//define callback function for uploader on select
			custom_uploader.on('select', function(){
				var media_attachment = custom_uploader.state().get('selection').first().toJSON(),
					preview_img = $('#user-meta-hrld_staff_banner_img');
				preview_img.removeClass('hidden').attr('src', media_attachment.sizes.thumbnail.url);

				if( preview_img_hidden.length == 1){
					preview_img_hidden.removeClass('hidden').siblings('.delete_button').removeClass('hidden');
				}

				$('#user-meta-hrld_staff_banner').val(media_attachment.id);
			});

			//open uploader
			custom_uploader.open();
		});
		$('.delete_button').click(function(){
			$(this).addClass('hidden').siblings('#user-meta-hrld_staff_banner_img').addClass('hidden').attr('src', '');;
			$('#user-meta-hrld_staff_banner').val('');
		});
	});