<?php 

namespace AsCode\Addressbook\Admin;

if( ! class_exists( 'WP_List_Table' ) ){
	require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

/**
 * class list table
 */
class Address_List extends \WP_List_Table {
	
	public function __construct() {
		parent::__construct([
			'singular'	=> 'contact',
			'plural'	=> 'comments',
			'ajax'		=> false
		] );
	}

	public function get_columns() {
		return [
			'cb'			=> '<input type="checkbox" />',
			'name'			=> __( 'Name', 'asscode-addressbook' ),
			'address'		=> __( 'Address', 'asscode-addressbook' ),
			'phone'			=> __( 'Phone', 'asscode-addressbook' ),
			'created_at'	=> __( 'Date', 'asscode-addressbook' )
		];
	}

	protected function column_default( $item, $column_name ) {

		switch ( $column_name ) {
			case 'value':
				break;

			default:
				return isset( $item->$column_name ) ? $item->$column_name : '';
		}
	}

	public function column_name( $item ) {
		return sprintf(
			'<a href="%1$s"><strong>%2$s</strong></a>', admin_url('admin.php?page=ascode-addressbook-home&action=view&id'.$item->id), $item->name
		);
	}

	protected function column_cb( $item ) {
		return sprintf(
			'<input type="checkbox" name="address_id[]" value="%d"/>', $item->id
		);
	}

	public function prepare_items() {
		$columns = $this->get_columns();
		$hidden = [];
		$sortable = $this->get_sortable_columns();

		$per_page = 20;

		$this->_column_headers = [ $columns, $hidden, $sortable ];
		$this->items = ascode_get_addresses();

		$this->set_pagination_args( [
			'total_items'	=> ascode_addresses_count(),
			'per_page'		=> $per_page
		] );
	}
}