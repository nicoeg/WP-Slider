<?php

class WPSliderAdmin {
	public function __construct() {
		add_action('add_meta_boxes', [$this, 'add_meta_boxes']);
	}

	public function add_meta_boxes() {
		add_meta_box(
			'slider_info', 
			'Slider info', 
			[$this, 'render_slider_info_meta'], 
			'slider', 
			'side'
		);
	}

	public function render_slider_info_meta() {
		require_once '../views/meta-boxes/slider-info.php';
	}
}
