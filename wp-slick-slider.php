<?php

/**
 * Plugin Name: WP Slick Slider
 * Description: Create slick sliders
 * Version: 0.0.1
 */

class WPSlickSlider {
	protected $db;

	public function __construct() {
		require_once 'DatabaseHandler.php';
		$this->db = new DatabaseHandler;

		add_action('init', [$this, 'register_post_type']);
		add_shortcode('slickslider', [$this, 'display_slider']);
		add_action('wp_enqueue_scripts', [$this, 'register_assets']);

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

	public function register_assets() {
		wp_register_script('slick_slider_js', plugins_url('js/slickslider.js', __FILE__), ['jquery'], ' ');
		wp_register_style('slick_slider_css', plugins_url('css/slickslider.css', __FILE__), [], ' ');
	}

	public function display_slider($attributes) {
		if (!is_array($attributes) || count($attributes) != 1 || !is_numeric($attributes[0])) {
			echo "Shortcode not configured right";
			return;
		}

		$slider_id = $attributes[0];

		if (!$this->db->slider_exists($slider_id)) {
			echo "Slider does not exist";
			return;
		}

		$slider = $this->db->get_slider($slider_id);

		wp_localize_script('slick_slider_js', 'ss_data', $slider->data);
		wp_enqueue_script('slick_slider_js');
		wp_enqueue_style('slick_slider_css');

		require_once 'views/slider.php';
	}
}

new WPSlickSlider;
