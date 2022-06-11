<?php 

namespace AsCode\Addressbook\Admin;


class Addressbook {

	public $error = [];

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

		$name = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '';
		$address = isset( $_POST['address'] ) ? sanitize_textarea_field( $_POST['address'] ) : '';
		$contact = isset( $_POST['contact'] ) ? sanitize_text_field( $_POST['contact'] ) : '';

		if( empty( $name ) ) {
			$this->errors['name'] = __( 'Please provide a name', 'asscode-addressbook' );
		}

		if( empty( $address ) ) {
			$this->errors['address'] = __( 'Please provide a address', 'asscode-addressbook' );
		}

		if( ! empty( $errors) ) {
			return;
		}

		$insert_id = ascode_insert_address( [
				'name' 		=> $name,
				'address'	=> $address,
				'phone'	=> $contact
			] );

		if( is_wp_error( $insert_id ) ) {
			wp_die( $insert_id->get_error_message() );
		}

		$redirect_to = admin_url( 'admin.php?page=ascode-addressbook-home&inserted=true' );

		wp_redirect( $redirect_to );

		exit;
	}
}