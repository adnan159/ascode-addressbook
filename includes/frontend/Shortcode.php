<?php 


namespace AsCode\Addressbook\Frontend;


class Shortcode {

	public function __construct() {

		add_shortcode( 'ascode-hello-shortcode', [ $this, 'shortcode_callback' ] );
	}

	public function shortcode_callback() {
		wp_enqueue_style( 'ascode-style' );

		return '<div class="ascode-shortcode" id="ascode-shortcode">Hello From Shortcode </div>';
	}
}