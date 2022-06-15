<?php 


namespace AsCode\Addressbook;

/**
 * Handle Assets 
 */
class Assets {

	public function __construct(){
		add_action( 'wp_enqueue_scripts', [$this, 'enqueue_assets'] );
		add_action( 'admin_enqueue_scripts', [$this, 'enqueue_assets'] );
	}

	public function enqueue_assets() {

		wp_register_script( 'ascode-script', ASCODE_ASSETS . '/js/frontend.js', false, filemtime( ASCODE_PATH . '/assets/js/frontend.js' ), true );

		wp_register_style( 'ascode-style', ASCODE_ASSETS . '/css/frontend.css', false, filemtime( ASCODE_PATH . '/assets/css/frontend.css' ), false );
	}
}