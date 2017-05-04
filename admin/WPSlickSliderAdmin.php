<?php

class WPSlickSliderAdmin {
	public function __construct() {
		add_action('add_meta_boxes', [$this, 'add_meta_boxes']);
		add_action('save_post', [$this, 'save_slider'], 10, 3);
		add_action('admin_enqueue_scripts', [$this, 'add_scripts_and_styles']);
	}

	public function add_meta_boxes() {
		add_meta_box(
			'slider_info', 
			'Slider info', 
			[$this, 'display_slider_info_meta'], 
			'slick_slider', 
			'side'
		);

		add_meta_box(
			'slides', 
			'Slides', 
			[$this, 'display_slides_meta'], 
			'slick_slider', 
			'normal'
		);
	}

	public function add_scripts_and_styles() {
		wp_register_script('slick_slider_js', plugins_url('../js/slides.js', __FILE__), ['jquery']);
		wp_enqueue_style('slick_slider_admin_css', plugins_url('../css/admin.css', __FILE__));
	}

	public function display_slider_info_meta() {
		$width = get_post_meta( get_the_ID(), 'ss_width', true );
		$height = get_post_meta( get_the_ID(), 'ss_height', true );
		$duration = get_post_meta( get_the_ID(), 'ss_duration', true );

		require_once __DIR__ . '/../views/meta-boxes/slider-info.php';
	}

	public function display_slides_meta() {
		wp_enqueue_media();
		wp_enqueue_script('slick_slider_js');
		$slide_names = get_post_meta( get_the_ID(), 'ss_slide_name');
		$slide_images = get_post_meta( get_the_ID(), 'ss_slide_image');
		
		$slides = array_map(function($index, $name) use($slide_images) {
			return [
				'name' => $name,
				'image_id' => $slide_images[$index],
				'image_url' => wp_get_attachment_url($slide_images[$index])
			];
		}, array_keys($slide_names), $slide_names);

		require_once __DIR__ . '/../views/meta-boxes/slides.php';
	}

	public function save_slider($post_id, $post, $update) {
		if (!isset($_POST) || count($_POST) == 0 || get_post_type($post_id) != 'slick_slider') return;

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

		if (isset($_POST['ss_name'])) {
			delete_post_meta($post_id, 'ss_slide_name');
			delete_post_meta($post_id, 'ss_slide_image');

			for ($i = 0; $i < count($_POST['ss_name']); $i++) {
				add_post_meta($post_id, 'ss_slide_name', $_POST['ss_name'][$i]);
				add_post_meta($post_id, 'ss_slide_image', $_POST['ss_image'][$i]);
			}
		}
	}
}
