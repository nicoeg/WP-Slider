<?php

class DatabaseHandler {
	private $db;

	public function __construct() {
		global $wpdb;

		$this->db = $wpdb;
	}

	public function slider_exists($id) {
		return get_post_status($id) !== false;
	}

	public function get_slider($id) {
		$slider = get_post($id);
		$slider->data = $this->get_slider_meta($id);
		
		return $slider;
	}

	public function get_slider_meta($id) {
		return [
			'width' => get_post_meta($id, 'ss_width', true),
			'height' => get_post_meta($id, 'ss_height', true),
			'duration' => get_post_meta($id, 'ss_duration', true),
			'slides' => $this->get_slides($id)
		];
	}

	public function get_slides($id) {
		$slide_names = get_post_meta($id, 'ss_slide_name');
		$slide_images = get_post_meta($id, 'ss_slide_image');
		
		return array_map(function($index, $name) use($slide_images) {
			return [
				'name' => $name,
				'image_id' => $slide_images[$index],
				'image_url' => wp_get_attachment_url($slide_images[$index])
			];
		}, array_keys($slide_names), $slide_names);
	}
}
