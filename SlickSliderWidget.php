<?php

class SlickSliderWidget extends WP_Widget {
	public function __construct() {
		parent::__construct('slickslider_widget', 'Slick Slider', [
			'description' => 'Slick Slider',
			'classname' => 'slick-slider-widget'
		]);
	}
}
