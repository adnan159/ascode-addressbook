<?php 


namespace AsCode\Addressbook\Frontend;


class Shortcode {

	public function __construct() {

		add_shortcode( 'shortcode', [ $this, 'shortcode_callback' ] );
	}

	public function shortcode_callback() {
		return "Hello from Shortcode...............ho............";
	}
}