<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Fac_U
 * @subpackage Fac_U/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Fac_U
 * @subpackage Fac_U/public
 * @author     Your Name <email@example.com>
 */
class Fac_U_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $facu    The ID of this plugin.
	 */
	private $facu;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $facu       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $facu, $version ) {

		$this->facu = $facu;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Fac_U_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Fac_U_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->facu, plugin_dir_url( __FILE__ ) . 'css/facu-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Fac_U_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Fac_U_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->facu, plugin_dir_url( __FILE__ ) . 'js/facu-public.js', array( 'jquery' ), $this->version, false );

	}

}
