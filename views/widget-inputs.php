<div class="wrap">
	<div class="form-control">
		<label>
			Slider id
			<select name="<?= $this->get_field_name('slider_id') ?>">
				<option value="">Choose</option>
				<?php foreach ($sliders as $slider) { ?>
					<option value="<?= $slider->ID ?>" <?= $slider->ID == $slider_id ? 'selected' : '' ?>><?= $slider->post_title ?></option>
				<?php } ?>
			</select>
		</label>
	</div>
</div>
