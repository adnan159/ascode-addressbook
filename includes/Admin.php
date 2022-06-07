<?php 


namespace AsCode\Addressbook;

class Admin {

	public function __construct() {
		$this->dispatch_action();
		new Admin\Menu();
	}

	public function dispatch_action() {
		$addressbook = new Admin\Addressbook();
		add_action( 'admin_init', [$addressbook, 'form_handler'] );
	}
}