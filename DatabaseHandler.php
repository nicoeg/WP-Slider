<?php

class DatabaseHandler {
	private $db;

	public function __construct() {
		global $wpdb;

		$this->db = $wpdb;
	}

	public function get_slides($slider_id) {
		$slide_names = get_post_meta($slider_id, 'ss_slide_name');
		$slide_images = get_post_meta($slider_id, 'ss_slide_image');
		
		return array_map(function($index, $name) use($slide_images) {
			return [
				'name' => $name,
				'image_id' => $slide_images[$index],
				'image_url' => wp_get_attachment_url($slide_images[$index])
			];
		}, array_keys($slide_names), $slide_names);
	}
}
