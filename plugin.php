<?php
 /**
 * Plugin Name: Dynamic Shortcode Widget for Elementor
 * Plugin URI: https://wordpress.org/plugins/dynamic-shortcode-widget-for-elementor/
 * Description: Just another shortcode widget for elementor. Simple but useful.
 * Version: 0.1.0
 * Author: louisho5
 * License: GPLv2 or later
 * Text Domain: dynamic-shortcode-widget
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}


/***** Compatible with Elementor v3.4.2 above *****/

final class Custom_Ele_Widget_Extension {

    private static $_instance = null;

    public static function instance() {
        if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        add_action( 'plugins_loaded', [ $this, 'init' ] );
    }

    public function init() {
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
    }

    public function includes() {
		// Add the path of custom widget below
		require_once( __DIR__ . '/widgets/widget-dynamic-shortcode.php' );
	}

	public function register_widgets() {
		$this->includes();
		
		// Add custom widget class name below
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Custom_Ele_Widget_Dynamic_Shortcode() );
	}
}

Custom_Ele_Widget_Extension::instance();

?>