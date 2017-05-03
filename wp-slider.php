<?php

/**
 * Plugin Name: WP Slider
 * Description: Create elegant sliders and ride hippos
 * Version: 0.0.1
 */

class WPSlider {
	public function __construct() {
		add_action('init', [$this, 'register_post_type']);

		if (is_admin()) {
			require_once 'admin/WPSliderAdmin.php';

			new WPSliderAdmin;
		}
	}

	public function register_post_type() {
		register_post_type('slider', [
            'label' => 'Sliders',
            'public' => true,
			'supports' => ['title', 'editor']
        ]);
	}
}

new WPSlider;
