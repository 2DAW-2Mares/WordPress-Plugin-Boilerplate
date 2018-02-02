<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    IES2MaresJobs
 * @subpackage IES2MaresJobs/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    IES2MaresJobs
 * @subpackage IES2MaresJobs/public
 * @author     Your Name <email@example.com>
 */
class IES2MaresJobs_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $IES2MaresJobs    The ID of this plugin.
	 */
	private $IES2MaresJobs;

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
	 * @param      string    $IES2MaresJobs       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $IES2MaresJobs, $version ) {

		$this->IES2MaresJobs = $IES2MaresJobs;
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
		 * defined in IES2MaresJobs_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The IES2MaresJobs_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->IES2MaresJobs, plugin_dir_url( __FILE__ ) . 'css/IES2MaresJobs-public.css', array(), $this->version, 'all' );

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
		 * defined in IES2MaresJobs_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The IES2MaresJobs_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->IES2MaresJobs, plugin_dir_url( __FILE__ ) . 'js/IES2MaresJobs-public.js', array( 'jquery' ), $this->version, false );

	}

}
