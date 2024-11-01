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

namespace WPD\WWS\Woo;

/**
 * @subpackage Template Modifier
 */
class Template {

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

		add_filter( 'template_include', array( __CLASS__, 'template_loader' ), 20 );
		add_filter( 'woocommerce_loop_add_to_cart_link', array( $this, 'add_to_cart_link' ), 10, 2 );


    }
    /**
	 * Load a template.
	 *
	 * This is for overriding the whole shop page.
	 *
	 * @param string $template Template to load.
	 * @return string
	 */
	public static function template_loader( $template ) {

		if ( WWS_ARCHIVE_ACTIVATE ) {
			$template = WWS_BASE_PATH . '/templates/' . 'archive-products.php';
		}

		return $template;
	}


	public function add_to_cart_link($button, $product ) {
	    if ( $product->is_type('simple') ) {
	        if ($product->is_purchasable()) {
	            ob_start();
	           	include WWS_BASE_PATH . '/templates/' . 'add-to-cart.php';           	
	            $button = ob_get_clean();
	            $replacement = sprintf('data-product_id="%d" data-quantity="1" $1 ajax_add_to_cart add_to_cart_button product_type_simple ', $product->get_id());
	            $button = preg_replace('/(class="single_add_to_cart_button)/', $replacement, $button);
	        }
	    }
	    return $button;
	}


}