<?php 

namespace AsCode\Addressbook\Admin;


class Addressbook {

	public function plugin_page() {
		$action = isset( $_GET[ 'action'] ) ? $_GET[ 'action' ] : 'list';

		switch ( $action ) {
			case 'new' : 
				$tamplate = __DIR__ . '/views/address-new.php';
				break;

			case 'edit' : 
				$tamplate = __DIR__ . '/views/address-edit.php';
				break;

			case 'view' : 
				$tamplate = __DIR__ . '/views/address-view.php';
				break;
			
			default:
				$tamplate = __DIR__ . '/views/address-list.php';
		}

		if( file_exists( $tamplate ) ) {
			include $tamplate;
		}
	}

	/**
	 * Handle the addressbook from
	 * 
	 * @return void
	 */
	public function form_handler() {
		if( ! isset( $_POST['submit_address'] ) ){
			return;
		}

		if( ! wp_verify_nonce( $_POST['_wpnonce'], 'new-address' ) ){
			wp_die( 'Are you Cheating?' );
		}

		if( ! current_user_can( 'manage_options') ) {
			wp_die( 'Are you Cheating?' );
		}

		var_dump($_POST);
	}
}