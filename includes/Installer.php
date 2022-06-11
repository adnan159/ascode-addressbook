<?php 


namespace AsCode\Addressbook;

/**
 * Installer class
 *  
 */

class Installer {

	/**
	 * Run the installer
	 * 
	 * @return void
	 */ 

	public function run() {
		$this->add_version();
		$this->create_tables();
	}

	/**
	 * Update version
	 * 
	 * @return void
	 */
	public function add_version() {

        $installed = get_option( 'accode_addressbook_installed' );

        if( ! $installed ) {
            update_option( 'accode_addressbook_installed', time() );
        }

        update_option( 'ascode_addressbook_version', ASCODE_VERSION );
	}

	/**
	 * Create necessary tables
	 * 
	 * @return void
	 */

	public function create_tables() {
		global $wpdb;

		$charset_collate = $wpdb->get_charset_collate();

		$schema = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}ascode_addresses` ( `id` INT(11) NOT NULL , `name` VARCHAR(50) NOT NULL , `address` VARCHAR(100) NOT NULL , `phone` VARCHAR(30) NOT NULL , `created_by` BIGINT NOT NULL , `created_at` DATETIME NOT NULL , PRIMARY KEY (`id`)) $charset_collate";

		if( ! function_exists( 'dbDelta' ) ) {
			require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		}

		dbDelta( $schema );

	}

}