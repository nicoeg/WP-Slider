<?php

/**
 * Plugin Name: WP Slick Slider
 * Description: Create slick sliders
 * Version: 0.0.1
 */

class WPSlickSlider {
	public function __construct() {
		add_action('init', [$this, 'register_post_type']);

		if (is_admin()) {
			require_once 'admin/WPSlickSliderAdmin.php';

			new WPSlickSliderAdmin;
		}
	}

	public function register_post_type() {
		register_post_type('slick_slider', [
            'label' => 'Sliders',
            'public' => true,
			'supports' => ['title']
        ]);
	}
}

new WPSlickSlider;