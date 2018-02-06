<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    IES2MaresJobs
 * @subpackage IES2MaresJobs/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    IES2MaresJobs
 * @subpackage IES2MaresJobs/includes
 * @author     Your Name <email@example.com>
 */
class IES2MaresJobs {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      IES2MaresJobs_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $IES2MaresJobs    The string used to uniquely identify this plugin.
	 */
	protected $IES2MaresJobs;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'IES2MARESJOBS_VERSION' ) ) {
			$this->version = IES2MARESJOBS_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->IES2MaresJobs = 'IES2MaresJobs';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_job_types();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - IES2MaresJobs_Loader. Orchestrates the hooks of the plugin.
	 * - IES2MaresJobs_i18n. Defines internationalization functionality.
	 * - IES2MaresJobs_Admin. Defines all hooks for the admin area.
	 * - IES2MaresJobs_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-IES2MaresJobs-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-IES2MaresJobs-i18n.php';

        /**
         * The class responsible for defining new Job Type
         * of the plugin.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-IES2MaresJobs-job-type.php';

        /**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-IES2MaresJobs-admin.php';

        /**
         * The class responsible for defining widget to suscribe.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-IES2MaresJobsWidgetSuscribe.php';

        /**
         * The class responsible for defining shortcode.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-IES2MaresJobs-shortcode.php';

        /**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-IES2MaresJobs-public.php';

		$this->loader = new IES2MaresJobs_Loader();

    }

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the IES2MaresJobs_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new IES2MaresJobs_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new IES2MaresJobs_Admin( $this->get_IES2MaresJobs(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
        $this->loader->add_action( 'admin_post_nopriv_IES2MaresJob_suscribe', $plugin_admin, 'IES2MaresJob_suscribe' );
        $this->loader->add_action( 'admin_post_IES2MaresJob_suscribe', $plugin_admin, 'IES2MaresJob_suscribe' );

		$plugin_shortcode = new IES2MaresJobs_shortcode();

        $this->loader->add_action( 'init', $plugin_shortcode, 'IES2MaresJobs_shortcode_init' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new IES2MaresJobs_Public( $this->get_IES2MaresJobs(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
	}

    /**
     * Register Job Type.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_job_types() {
        // Register custom post types
        $Job_Type = new IES2MaresJobs_job_type();
    }

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_IES2MaresJobs() {
		return $this->IES2MaresJobs;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    IES2MaresJobs_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
