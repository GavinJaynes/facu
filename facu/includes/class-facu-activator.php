<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Fac_U
 * @subpackage Fac_U/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Fac_U
 * @subpackage Fac_U/includes
 * @author     Your Name <email@example.com>
 */
class Fac_U_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

        /** To be honest - not sure if this is the best way to call this
         * It seems it needs to be fired after the CPT has been called (init hook)
         * https://codex.wordpress.org/Function_Reference/register_post_type#Flushing_Rewrite_on_Activation
         */
        //flush_rewrite_rules();
	}
}