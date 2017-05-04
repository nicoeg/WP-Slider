<?php

class SlickSliderWidget extends WP_Widget {
	public function __construct() {
		parent::__construct('slickslider_widget', 'Slick Slider', [
			'description' => 'Slick Slider',
			'classname' => 'slick-slider-widget'
		]);
	}

	public function widget($args, $instance) {
		echo $args['before_widget'];

		require_once 'ViewRenderer.php';
		ViewRenderer::render_slider($instance['slider_id']);

		echo $args['after_widget'];
	}

	public function form($instance) {
		$slider_id = !empty($instance['slider_id']) ? $instance['slider_id'] : null;
		$sliders = get_posts(['post_type' => 'slick_slider']);

		require 'views/widget-inputs.php';
	}

	public function update($new_instance, $old_instance) {
		$instance = [];
		$instance['slider_id'] = $new_instance['slider_id'];

		return $instance;
	}
}
