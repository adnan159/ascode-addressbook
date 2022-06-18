<?php 


namespace AsCode\Addressbook\Frontend;

class Enquery {

	public function __construct() {
		add_shortcode( 'ascode-enquery', [ $this, 'render_shortcode' ] );
	}


	function render_shortcode() {
		wp_enqueue_script( 'ascode-enquery-script' );
		wp_enqueue_style( 'ascode-enquery-style' );

		ob_start();
		include __DIR__ . '/views/enquery.php';

		return ob_get_clean();
	}
}