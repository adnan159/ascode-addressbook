<?php 

namespace AsCode\Addressbook\API;

use WP_REST_Controller;
use WP_REST_Server;


/**
 * Addressbook class 
 */
class Addressbook extends WP_REST_Controller {

	public function __construct() {
		$this->namespace = 'ascode/v1';
		$this->rest_base = 'contacts';
	}

	public function register_routes() {
		register_rest_route( 
			$this->namespace,
			'/' . $this->rest_base,
			[
				[
					'methods'				=> WP_REST_Server::READABLE,
					'callback'				=> [ $this, 'get_items'],
					'permission_callback'	=> [ $this, 'get_items_permissions_check' ],
					'args'					=> $this->get_collection_params(),
				],
				'schema' => [ $this, 'get_item_schema' ],
			]
		 );
	}

	/**
	 * Checks if the the request has access to read contacts
	 * 
	 * @param \WP_REST_Request $request
	 * 
	 * @return boolean
	 */
	public function get_items_permissions_check( $request ) {
		if( current_user_can( 'manage_options' ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Checks if the the request has access to read contacts
	 * 
	 * @param \WP_REST_Request $request
	 * 
	 * @return boolean
	 */
	public function get_items( $request ) {
		
		$args = [];
		$params = $this->get_collection_params();

		foreach( $params as $key => $value ) {
			if( isset( $request[ $key ] ) ) {
				$args[ $key ] = $request[ $key ];
			}
		}

		// change `per_page` to `number`
		$args['number'] = $args['per_page'];
		$args['offset'] = $args['number'] * ( $args['page'] - 1 );

		// unset page and perpage
		unset( $args['page'] );
		unset( $args['per_page'] );

		$contacts = ascode_get_addresses( $args );

		return $contacts;
	}

	/**
	 * Retrive the contacts schema, conforming to JSON schema
	 *  
	 * @return array
	 */
	public function get_item_schema() {
		if( $this->schema ) {
			return $this->add_additional_fields_schema( $this->schema );
		}

		$schema = [
			'$schema'			=> 'http://json-schema.org/draft-04/schema',
			'title'				=> 'contact',
			'type'				=> 'object',
			'properties'		=> [
					'id' => [
						'description'	=> __('Unique identifier for object' ),
						'type'			=> 'integer',
						'context'		=> [ 'view', 'edit' ],
						'readonly'		=> true
					],
					'name' => [
						'description'	=> __('Name of contact' ),
						'type'			=> 'string',
						'context'		=> [ 'view', 'edit' ],
						'required'		=> true,
						'arg_options'	=> [
							'sanitize_callback'	=> 'sanitize_text_field',
						],
					],
					'address' => [
						'description'	=> __('Address of contact' ),
						'type'			=> 'string',
						'context'		=> [ 'view', 'edit' ],
						'required'		=> true,
						'arg_options'	=> [
							'sanitize_callback'	=> 'sanitize_textarea_field',
						],
					],
					'phone' => [
						'description'	=> __('Phone number of contact' ),
						'type'			=> 'string',
						'context'		=> [ 'view', 'edit' ],
						'required'		=> true,
						'arg_options'	=> [
							'sanitize_callback'	=> 'sanitize_textarea_field',
						],
					],
					'date' => [
						'description'	=> __('Phone number of contact' ),
						'type'			=> 'string',
						'format'		=> 'date-time',
						'context'		=> [ 'view' ],
						'readonly'		=> true,
					],
			],
		];

		$this->schema = $schema;

		return $this->add_additional_fields_schema( $schema );
	}

	/**
	 * Retrive the query params for collection
	 * 
	 * @return array 
	 */
	public function get_collection_params() {
		$params = parent::get_collection_params();

		unset( $params['search'] );

		return $params;
	}

}