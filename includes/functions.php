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

	if( isset( $data['id'] ) ) {

		$id = $data['id'];
		unset( $data['id'] );

		$updated =$wpdb->update(
			"{$wpdb->prefix}ascode_addresses",
			$data,
			[ 'id' => $id ],
			[
				'%s',
				'%s',
				'%s',
				'%d',
				'%s'
			],
			['%d']			
		);

		return $updated;

	} else {
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
}

/**
 * Fetch addresses
 * 
 * @param array $args
 * 
 * @return array 
 */

function ascode_get_addresses( $args = [] ) {
	global $wpdb;

	$defaults = [
		'number'	=> 20,
		'offset'	=> 0,
		'orderby'	=> 'id',
		'order'		=> 'ASC'
	];

	$args = wp_parse_args( $args, $defaults );

	$items = $wpdb->get_results(
		$wpdb->prepare(
			"SELECT * FROM {$wpdb->prefix}ascode_addresses
			ORDER BY {$args['orderby']} {$args['order']}
			LIMIT %d, %d", 
			$args['offset'], $args['number']
		) );

	return $items;
}

/**
 * Get total number of addresses
 *  
 * @return int
 */

function ascode_addresses_count() {
	global $wpdb;

	return (int) $wpdb->get_var( "SELECT count(id) FROM {$wpdb->prefix}ascode_addresses" );
}

/**
 * Fetch single address from database
 * 
 * @param int $id
 * 
 * @return object
*/

function ascode_get_address( $id ) {
	global $wpdb;

	return $wpdb->get_row(
		$wpdb->prepare( "SELECT * FROM {$wpdb->prefix}ascode_addresses WHERE id = %d", $id ) 
	);
}

/**
 * Delete single address
 * 
 * @param int $id
 * 
 * @return int|boolen  
 */

function ascode_delete_address( $id ) {
	global $wpdb;

	return $wpdb->delete(
		$wpdb->prefix . "ascode_addresses",
		[ 'id'	=> $id ],
		[ '%d' ]
	);
}