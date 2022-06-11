<?php 

/**
 * Insert new address 
 * 
 * @param array $args
 * 
 * @return int|WP_Error  
 */

function ascode_insert_address( $args = [] ) {
	global $wpdb;

	if( empty( $args['name'] ) ) {
		return new \WP_Error( 'no-name', __( 'Name cannot be empty', 'asscode-addressbook') );
	}

	$defaults = [
		'name'		=> '',
		'address'	=> '',
		'phone'		=> '',
		'created_by'=> get_current_user_id(),
		'created_at'=> current_time( 'mysql' )
	];

	$data = wp_parse_args( $args, $defaults );

	$inserted = $wpdb->insert(
		"{$wpdb->prefix}ascode_addresses",
		$data,
		[
			'%s',
			'%s',
			'%s',
			'%d',
			'%s'
		]
	);

	if( ! $inserted ) {
		return new \WP_Error( 'failed-to-insert', __( 'Failed to insert data!', 'asscode-addressbook' ) );
	}

	return $wpdb->insert_id;
}