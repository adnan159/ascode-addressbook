<?php

/**
 * Plugin Name:       AsCode Address Book
 * Plugin URI:        https://facebook.com/osmanhaider.adnan
 * Description:       Address book plugin for test.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Adnan
 * Author URI:        https://facebook.com/osmanhaider.adnan
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://facebook.com/osmanhaider.adnan
 * Text Domain:       my-basics-plugin
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    die;
}

require_once __DIR__ . '/vendor/autoload.php';

/** 
 * The main class
 * 
 */

final class Ascode_Addressbook {

    const version = '1.0.0';

    private function __construct() {
        
        $this -> define_constants();

        add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
    }


    /**
     * Define essential constants 
     */
    public function define_constants() {
        define( 'ASCODE_VERSION', self::version );

    }

    public function init_plugin() {
        if( is_admin() ) {
            new AsCode\Addressbook\Admin();
        } else {
            new AsCode\Addressbook\Frontend();
        }
    }


    /**
     * define singleton instance 
     */
    public static function init() {
        static $instance = false;

        if( ! $instance ){
            $instance = new self();
        }

        return $instance;
    }

}

function ascode_addressbook() {
   return Ascode_Addressbook:: init();
}

//start from here
ascode_addressbook();
