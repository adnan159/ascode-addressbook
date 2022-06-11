<?php 


namespace AsCode\Addressbook;

class Admin {

	/**
	 * Initilized the class 
	 */
	public function __construct() {
		$this->dispatch_action();
		new Admin\Menu();
	}

	/**
	 * Dispatch bind action
	 * 
	 * @return void
	 */

	public function dispatch_action() {
		$addressbook = new Admin\Addressbook();
		add_action( 'admin_init', [$addressbook, 'form_handler'] );
	}
}