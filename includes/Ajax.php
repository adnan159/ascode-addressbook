<?php 


namespace AsCode\Addressbook;

/**
 * Handle Ajax Request 
 */

class Ajax {

    public function __construct() {
        add_action( 'wp_ajax_ascode_enquery', [ $this, 'submit_enquery' ] );
        add_action( 'wp_ajax_nopriv_ascode_enquery', [ $this, 'submit_enquery' ] );
        add_action( 'wp_ajax_ascode-delete-contact', [ $this, 'delete_contact' ] );
    }

    public function submit_enquery() {

        if( ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'ascode-enquery-from-1' ) ) {
            wp_send_json_error( [
                'message'   => 'Nonce Verification Failed!'
            ] );
        } 

        // wp_send_json_success( [
        //     'message'   => 'Enquere has been send successfully!',
        // ] );

        wp_send_json_error( [
            'message'   => 'Enquere not send successfully!!'
        ] );
    }

    public function delete_contact() {

        global $wpdb;
        $id = $_POST['id'];

        $deleted = $wpdb->delete(
            $wpdb->prefix . 'ascode_addresses',
            [ 'id'  => $id ]
        );
        wp_send_json_success($deleted);
    }
}