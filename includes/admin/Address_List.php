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

	/**
	 * Get sortable column
	 *
	 * @return array 
	 */

	public function get_sortable_columns() {
		$sortable_columns = [
			'name'			=> [ 'name', true ],
			'created_at'	=> [ 'created_at', true ]
		];

		return $sortable_columns;
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
		$actions = [];

		$actions['edit'] = sprintf( 
			'<a href="%s" title="%s"> %s </a>', 
			admin_url('admin.php?page=ascode-addressbook-home&action=edit&id=' . $item->id ), 
			$item->id, 
			__( 'Edit', 'asscode-addressbook' ), 
			__( 'Edit', 'asscode-addressbook' ) 
		);

		$actions['delete'] = sprintf( 
			'<a href="%s" class="submitdelete" onclick="return confirm(\'Are you sure?\');" title="%s"> %s </a>',
			wp_nonce_url( admin_url('admin-post.php?page=ascode-addressbook-home&action=edit&id=' . $item->id ) ), 
			$item->id, 
			__( 'Delete', 'asscode-addressbook' ), 
			__( 'Delete', 'asscode-addressbook' ) 
		);

		return sprintf(
			'<a href="%1$s"><strong>%2$s</strong></a> %3$s', 
			admin_url('admin.php?page=ascode-addressbook-home&action=view&id'.$item->id), 
			$item->name, 
			$this->row_actions( $actions )
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

		$this->_column_headers = [ $columns, $hidden, $sortable ];

		$per_page 		= 2;
		$current_page 	= $this->get_pagenum();
		$offset 		= ( $current_page - 1 ) * $per_page;

		if( isset( $_REQUEST['orderby'] ) && isset( $_REQUEST['order'] ) ){
			$args['orderby'] = $_REQUEST['orderby'];
			$args['order'] = $_REQUEST['order'];
		}
		
		$this->items = ascode_get_addresses( [
			'number' 	=> $per_page,
			'offset'	=> $offset
		] );


		$this->set_pagination_args( [
			'total_items'	=> ascode_addresses_count(),
			'per_page'		=> $per_page
		] );
	}
}