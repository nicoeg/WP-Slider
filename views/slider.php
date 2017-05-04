<div class="slick-slider" style="width: <?= strlen($slider->data['width']) > 0 ? $slider->data['width'] . 'px' : '100%' ?>; height: <?= $slider->data['height'] ?: '300' ?>px;">
	<div class="slider">
		<div class="arrow left">
			<img src="<?= plugins_url('../img/arrow.png', __FILE__); ?>" alt="Left arrow">
		</div>
		<ul class="slides">
			<?php foreach ($slider->data['slides'] as $slide) { ?>
				<li class="slide">
					<div class="left">
						<img src="<?= $slide['image_url'] ?>">
					</div>
					<div class="right">
						<h1><?= $slide['name'] ?></h1>
					</div>
				</li>
			<?php } ?>
		</ul>
		<div class="arrow right">
			<img src="<?= plugins_url('../img/arrow.png', __FILE__) ?>" alt="Right arrow">
		</div>
	</div>
</div>
