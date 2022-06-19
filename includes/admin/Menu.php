<?php 


namespace AsCode\Addressbook\Admin;

class Menu {

	public function __construct() {
		add_action( 'admin_menu', [ $this, 'admin_menu' ] );
	}


	public function admin_menu() {

		$parent_slug = 'ascode-addressbook-home';
		$capabilities = 'manage_options';

		$hook = add_menu_page( 
			__( 'AsCode', 'asscode-addressbook' ), 
			__( 'AsCode', 'asscode-addressbook' ), 
			$capabilities, 
			$parent_slug, 
			[ $this , 'ascode_addressbook' ], 
			'dashicons-format-aside' 
		);

		add_submenu_page( 
			$parent_slug, 
			__( 'Addressbook', 'asscode-addressbook' ), 
			__( 'Addressbook', 'asscode-addressbook' ), 
			$capabilities, 
			$parent_slug, 
			[ $this, 'ascode_addressbook'], 
		);
		add_submenu_page( 
			$parent_slug, 
			__( 'Settings', 'asscode-addressbook' ), 
			__( 'Settings', 'asscode-addressbook' ), 
			$capabilities, 
			'ascode-addressbook-settings', 
			[ $this, 'addressbook_settings'], 
		);

		add_action( 'admin_head-' . $hook, [$this, 'enqueue_assets'] );
	}

	public function ascode_addressbook() {
		$addressbook = new Addressbook();
		$addressbook->plugin_page();
	}

	public function addressbook_settings() {
		$settings = new Settings();
		$settings->settings_page();
	}

	public function enqueue_assets() {
		wp_enqueue_style( 'ascode-admin-style' );
		wp_enqueue_script( 'ascode-admin-script' );
	}
}