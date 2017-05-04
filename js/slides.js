jQuery( document ).ready( function( $ ) {
	// Uploading files
	var file_frame, element, image_input;
	var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
	var slide_template = '<div class="slide"><div class="slide-name form-control"><label>Title <br><input type="text" name="ss_name[]" class="large-text"></label></div><div class="image-preview-wrapper"><img class="image-preview" src=""></div><input class="button-secondary upload-image" type="button" value="Select Image"/><input type="hidden" name="ss_image[]" class="image-input"><div class="button ss-delete">x</div></div>';

	$('.slides').sortable({
		placeholder: "slide-placeholder"
	});

	$(document).on('click', '.upload-image', function( event ) {
		event.preventDefault();

		element = $(this).closest('.slide');
		image_input = element.find('.image-input');

		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			// Set the post ID to what we want
			file_frame.uploader.uploader.param( 'post_id', image_input.val() );
			// Open frame
			file_frame.open();
			return;
		} else {
			// Set the wp.media post id so the uploader grabs the ID we want when initialised
			wp.media.model.settings.post.id = image_input.val();
		}

		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
			title: 'Select a image to upload',
			button: {
				text: 'Use this image',
			},
			multiple: false	// Set to true to allow multiple files to be selected
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();
			// Do something with attachment.id and/or attachment.url here
			element.find('.image-preview').attr( 'src', attachment.url );
			image_input.val( attachment.id );
			// Restore the main post ID
			wp.media.model.settings.post.id = wp_media_post_id;
		});
		
		// Finally, open the modal
		file_frame.open();
	});
	// Restore the main ID when the add media button is pressed
	$(document).on( 'click', 'a.add_media', function() {
		wp.media.model.settings.post.id = wp_media_post_id;
	});

	$(document).on('click', '.ss-add', function() {
		$('.slides').append(slide_template);
	});

	$(document).on('click', '.ss-delete', function() {
		$(this).closest('.slide').remove();
	});
});
