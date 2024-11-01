<?php
/**
 * WOO-Wholesale
 *
 *
 * @package   WOO-wholesale
 * @author    WPDrizzle
 * @license   GPL-3.0
 * @link      https://wpdrizzle.com
 * @copyright 2017 WP Drizzle (Pty) Ltd
 */

namespace WPD\WWS\Styles;

/**
 * @subpackage Template Modifier
 */
class Styles {

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.1
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.1
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
			self::$instance->do_hooks();
		}

		return self::$instance;
	}

	/**
     * Set up WordPress hooks and filters
     *
     * @return void
     */
    public function do_hooks() {

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ), 10, 2 );


    }
    /**
	 *
	 * This is for enqueing style and scripts.
	 *
	 */
	
    public function enqueue() {

		wp_enqueue_script( 'woo-ws-custom', WWS_FILE_URL.'/js/main.js', array('jquery'), '1.0.0', true );
		wp_enqueue_style( 'woo-ws-custom', WWS_FILE_URL.'/css/main.css', '', '1.0.0' );


    }

}