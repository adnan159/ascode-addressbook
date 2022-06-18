<?php 


namespace AsCode\Addressbook;

/**
 * Handle Ajax Request 
 */

class Ajax {

    public function __construct() {
        add_action( 'wp_ajax_ascode_enquery', [ $this, 'submit_enquery' ] );
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
}