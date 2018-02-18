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
 * @package    IES2MaresPensador
 * @subpackage IES2MaresPensador/includes
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
 * @package    IES2MaresPensador
 * @subpackage IES2MaresPensador/includes
 * @author     Your Name <email@example.com>
 */
class IES2MaresPensador {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      IES2MaresPensador_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $IES2MaresPensador    The string used to uniquely identify this plugin.
	 */
	protected $IES2MaresPensador;

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
		if ( defined( 'IES2MaresPensador_VERSION' ) ) {
			$this->version = IES2MaresPensador_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->IES2MaresPensador = 'IES2MaresPensador';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_reto_types();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - IES2MaresPensador_Loader. Orchestrates the hooks of the plugin.
	 * - IES2MaresPensador_i18n. Defines internationalization functionality.
	 * - IES2MaresPensador_Admin. Defines all hooks for the admin area.
	 * - IES2MaresPensador_Public. Defines all hooks for the public side of the site.
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
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-IES2MaresPensador-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-IES2MaresPensador-i18n.php';

        /**
         * The class responsible for defining new Reto Type
         * of the plugin.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-IES2MaresPensador-reto-type.php';

        /**
         * La clase responsable de la definición del widget de respuesta.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-IES2MaresPensadorWidgetRespuesta.php';

        /**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-IES2MaresPensador-admin.php';

        /**
         * The class responsible for defining shortcode.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-IES2MaresPensador-shortcode.php';

        /**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-IES2MaresPensador-public.php';

		$this->loader = new IES2MaresPensador_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the IES2MaresPensador_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new IES2MaresPensador_i18n();

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

		$plugin_admin = new IES2MaresPensador_Admin( $this->get_IES2MaresPensador(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

        $this->loader->add_action( 'wp_ajax_nopriv_IES2MaresPensador_respuesta', $plugin_admin, 'IES2MaresPensador_respuesta' );
        $this->loader->add_action( 'wp_ajax_IES2MaresPensador_respuesta', $plugin_admin, 'IES2MaresPensador_respuesta' );

        $plugin_shortcode = new IES2MaresPensador_shortcode();

        $this->loader->add_action( 'init', $plugin_shortcode, 'IES2MaresPensador_shortcode_init' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new IES2MaresPensador_Public( $this->get_IES2MaresPensador(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

    /**
     * Register Reto Type.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_reto_types() {
            // Register custom post types
            $Reto_Type = new IES2MaresPensador_reto_type();
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
	public function get_IES2MaresPensador() {
		return $this->IES2MaresPensador;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    IES2MaresPensador_Loader    Orchestrates the hooks of the plugin.
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
