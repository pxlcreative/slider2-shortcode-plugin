<?php
/*
Plugin Name: Slider2 Shortcode
Plugin URI: http://www.pxlcreative.com/
Description: Shortcode for coding Slider2 slideshows
Version: 1.0
Author: PXL Creative
Author URI: http://www.pxlcreative.com/
*/

define('SLIDER2_SHORTCODE_PLUGIN_URL', plugins_url() . "/slider2-shortcode");


add_shortcode('slider2slider','func_slider2slider');
add_shortcode('slide','func_slider2slide');
add_action( 'wp_enqueue_scripts', 'slider_scripts_method' );


function func_slider2slider($atts, $content = null) {

	extract( shortcode_atts(array(
			//defaults
			'id' => null,
			'class' => null,
			'slides' => 'div.slider2-container',
			'timeout' => 4000,
			'fx' => 'fade',
			
			),$atts));
			
	$slider_data = '
		<!-- Slider2 Slideshow -->
			<div id="' . $id . '" class="' . $class . ' cycle-slideshow"
			        data-cycle-slides="' . $slides . '"
			        data-cycle-timeout="' . $timeout . '"
			        data-cycle-fx="' . $fx . '"
			>
		        <div class="cycle-pager"></div>
			    <div class="cycle-prev"></div>
			    <div class="cycle-next"></div>
			    <!-- Slides -->
			    ' . do_shortcode($content) . '
			    <!-- /Slides -->
			</div>
		<!-- /Slider2 Slideshow -->';    

	return $slider_data;
}

function func_slider2slide($atts, $content = null) {

	extract( shortcode_atts(array(
			//defaults
			'class' => 'slider2-container',			
			),$atts));
			
	$slide_data = '<div class="' . $class . '">
			    ' . do_shortcode($content) . '
			    </div>';    

	return $slide_data;
}


function slider_scripts_method() {
	wp_enqueue_script(
		'jquery-cycle2',
		SLIDER2_SHORTCODE_PLUGIN_URL . '/jquery.cycle2.min.js',
		array( 'jquery' )
	);
}

