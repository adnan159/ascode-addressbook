<?php 


namespace AsCode\Addressbook;

class Frontend {

	public function __construct() {
		new Frontend\Shortcode();
		new Frontend\Enquery();
	}
}