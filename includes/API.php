<?php 

namespace AsCode\Addressbook;


/**
 * The API class 
 */
class API {

	public function __construct() {
		add_action( 'rest_api_init', [ $this, 'register_api' ] );
	}

	public function register_api() {
		$addressbook = new API\Addressbook();
		$addressbook->register_routes();
	}
}