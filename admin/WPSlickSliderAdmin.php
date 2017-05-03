<?php

class WPSlickSliderAdmin {
	public function __construct() {
		add_action('add_meta_boxes', [$this, 'add_meta_boxes']);
		add_action('save_post', [$this, 'save_slider'], 10, 3);
	}

	public function add_meta_boxes() {
		add_meta_box(
			'slider_info', 
			'Slider info', 
			[$this, 'render_slider_info_meta'], 
			'slick_slider', 
			'side'
		);
	}

	public function render_slider_info_meta() {
		$width = get_post_meta( get_the_ID(), 'ss_width', true );
		$height = get_post_meta( get_the_ID(), 'ss_height', true );
		$duration = get_post_meta( get_the_ID(), 'ss_duration', true );

		require_once __DIR__ . '/../views/meta-boxes/slider-info.php';
	}

	public function save_slider($post_id, $post, $update) {
		if (!isset($_POST) || get_post_type($post_id) != 'slick_slider') return;

		//TODO: Check if it is numbers
		if (isset($_POST['ss_width'])) {
            update_post_meta($post_id, 'ss_width', sanitize_text_field($_POST['ss_width']));
        }

		if (isset($_POST['ss_height'])) {
            update_post_meta($post_id, 'ss_height', sanitize_text_field($_POST['ss_height']));
        }

		if (isset($_POST['ss_duration'])) {
            update_post_meta($post_id, 'ss_duration', sanitize_text_field($_POST['ss_duration']));
        }
	}
}
