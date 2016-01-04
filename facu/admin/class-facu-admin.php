<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Fac_U
 * @subpackage Fac_U/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Fac_U
 * @subpackage Fac_U/admin
 * @author     Your Name <email@example.com>
 */
class Fac_U_Admin {

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
	 * @param      string    $facu       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $facu, $version ) {

		$this->facu = $facu;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->facu, plugin_dir_url( __FILE__ ) . 'css/facu-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->facu, plugin_dir_url( __FILE__ ) . 'js/facu-admin.js', array( 'jquery' ), $this->version, false );
	}


	/**
	 * Register the custom post type along with the taxonomy
	 * TODO: add plugin flush so no need to save permalinks
	 * https://codex.wordpress.org/Function_Reference/register_post_type
	 *
	 * @since    1.0.0
	 */
	public function register_post_type() {

		$slug = get_option( 'facu_plugin_page_slug' );

		if( empty($slug) ) { $slug = 'faq'; }

       	register_post_type( 'faq',
            array(
                'labels'                => array(
                'name'                  => 'FAQ',
                'singular_name'         => 'FAQ',
                'add_new'               => 'Add Question',
                'add_new_item'          => 'Add Question',
                'edit_item'             => 'Edit faq',
                'new_item'              => 'New Question',
                'all_items'             => 'All FAQs',
                'view_item'             => 'View Page',
                'search_items'          => 'Search FAQs',
                'not_found'             => 'No FAQ found',
                'not_found_in_trash'    => 'No FAQ found in Trash',
                'parent_item_colon'     => '',
                'menu_name'             => 'FAQ'
                ),
                'public'                => true,
                'has_archive'           => true,
                'rewrite'               => array( 'slug' => $slug ),

                'menu_position'         => 22,
                'supports'              => array( 'title', 'editor')
            )
        );
    }

    /**
	 * Register the custom taxonomy
	 * TODO: add plugin flush so no need to save permalinks
	 * https://codex.wordpress.org/Function_Reference/register_post_type
	 *
	 * @since    1.0.0
	 */
	public function register_custom_taxonomy() {

		register_taxonomy(
			'question-category',
			'faq',
			array(
				'label' 		=> 'Category',
				'rewrite' 		=> array( 'slug' => 'question-category' ),
				'hierarchical' 	=> true,
			)
		);
	}

	/**
	 * Custom archive template for our CPT
	 *
	 * @since    1.0.0
	 */
	public function get_custom_post_type_template( $archive_template ) {

	    global $post;

	    if ( is_post_type_archive ( 'faq' ) ) {

	        $archive_template = plugin_dir_path( dirname( __FILE__ ) ) . '/archive-faq.php';
	    }
	    return $archive_template;
	}

	/**
	 * Show our custom taxonomy in the admin columns
	 *
	 * @since    1.0.0
	 */

	/* Display custom column */
	public function display_faq_category( $column, $post_id ) {

		if ( $column == 'question-category' ) {

			$term_list = wp_get_post_terms( $post_id, 'question-category', array( 'fields' => 'names' ));
			$term_list = implode(',', $term_list);
			echo $term_list;
		}
	}

	/* Add custom column to post list */
	public function add_category_column( $columns ) {

	    return array_merge( $columns, array( 'question-category' => 'Category' ) );
	}


	/**
	 * Adds a page under the settings menu
	 *
	 * @since    1.0.0
	 */
	public function add_settings_page() {

		add_submenu_page(
			'options-general.php',
			'FAQ Settings',
			'FAQ Settings',
			'manage_options',
			'faq-settings',
			array( $this, 'faq_settings_page_callback' )
		);
	}

	// TODO: add some validation and such
	public function faq_settings_page_callback() {

		if( isset( $_POST['facu_nonce_field'] ) && wp_verify_nonce( $_POST['facu_nonce_field'], 'facu_nonce' ) ) {

			// Clean up a little
			$facu_title 		= sanitize_text_field( $_POST['facu_page_title'] );
			$facu_slug 		= sanitize_title( $_POST['facu_page_slug'] );
			$facu_content 	= sanitize_text_field( $_POST['facu_page_content'] );

			// Save the data
			update_option( 'facu_plugin_page_title', $facu_title );
			update_option( 'facu_plugin_page_slug', $facu_slug );
			update_option( 'facu_plugin_page_content', $facu_content );
		}

		include plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/facu-admin-display.php';
	}
}