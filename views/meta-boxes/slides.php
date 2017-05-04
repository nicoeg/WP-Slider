<div class="slides-wrapper">
	<div class="slides">
		<?php foreach ($slides as $slide) { ?>
			<div class="slide">
				<div class="slide-name form-control">
					<label>
						Title <br>
						<input type="text" name="ss_name[]" class="large-text" value="<?= $slide['name'] ?>">
					</label>
				</div>

				<div class="image-preview-wrapper">
					<img class="image-preview" src="<?= $slide['image_url'] ?>">
				</div>

				<input class="button-secondary upload-image" type="button" value="Select Image" />
				<input type="hidden" name="ss_image[]" value="<?= $slide['image_id'] ?>" class="image-input">

				<div class="button ss-delete">x</div>
			</div>
		<?php } ?>
	</div>

	<div class="button-primary ss-add">+</div>
</div>
