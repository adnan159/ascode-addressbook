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

	public function get_script() {
		return [
			'ascode-script' => [
				'src'			=> ASCODE_ASSETS . '/js/frontend.js',
				'version'		=> filemtime( ASCODE_PATH . '/assets/js/frontend.js' ),
				'dependency'	=> ('jQuery')
			]
		];
	}

	public function get_style() {
		return [
			'ascode-style' => [
				'src'		=> ASCODE_ASSETS . '/css/frontend.css',
				'version'	=> filemtime( ASCODE_PATH . '/assets/css/frontend.css' )
			]
		];
	}

	public function enqueue_assets() {

		$scripts = $this->get_script();
		$styles = $this->get_style();

		foreach( $scripts as $handle=>$script ) {

			$dependency = isset( $script['dependency'] ) ? $script['dependency'] : false;

			wp_register_script( $handle, $script['src'], $dependency, $script['version'], true );
		}

		foreach( $styles as $handle=>$style ) {

			$dependency = isset( $style['dependency'] ) ? $style['dependency'] : false;

			wp_register_style( $handle, $style['src'], $dependency, $style['version'] );
		}
	}
}