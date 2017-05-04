<?php

class ViewRenderer {
	private static $view_data = [];

	public static function render_slider($slider_id) {
		$db = new DatabaseHandler;

		if (!$db->slider_exists($slider_id)) {
			echo "Slider does not exist";
			return;
		}

		$slider = $db->get_slider($slider_id);
		self::$view_data[] = array_merge(['id' => $slider_id], $slider->data);

		wp_localize_script('slick_slider_js', 'ss_data', self::$view_data);
		wp_enqueue_script('slick_slider_js');
		wp_enqueue_style('slick_slider_css');

		require 'views/slider.php';
	}
}
