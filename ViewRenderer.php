<?php

class ViewRenderer {
	public static function render_slider($slider_id) {
		$db = new DatabaseHandler;

		if (!$db->slider_exists($slider_id)) {
			echo "Slider does not exist";
			return;
		}

		$slider = $db->get_slider($slider_id);

		wp_localize_script('slick_slider_js', 'ss_data', $slider->data);
		wp_enqueue_script('slick_slider_js');
		wp_enqueue_style('slick_slider_css');

		require_once 'views/slider.php';
	}

}
