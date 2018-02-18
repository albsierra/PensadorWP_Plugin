<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    IES2MaresPensador
 * @subpackage IES2MaresPensador/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    IES2MaresPensador
 * @subpackage IES2MaresPensador/admin
 * @author     Your Name <email@example.com>
 */
class IES2MaresPensador_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $IES2MaresPensador    The ID of this plugin.
	 */
	private $IES2MaresPensador;

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
	 * @param      string    $IES2MaresPensador       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $IES2MaresPensador, $version ) {

		$this->IES2MaresPensador = $IES2MaresPensador;
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
		 * defined in IES2MaresPensador_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The IES2MaresPensador_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->IES2MaresPensador, plugin_dir_url( __FILE__ ) . 'css/IES2MaresPensador-admin.css', array(), $this->version, 'all' );

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
		 * defined in IES2MaresPensador_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The IES2MaresPensador_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->IES2MaresPensador, plugin_dir_url( __FILE__ ) . 'js/IES2MaresPensador-admin.js', array( 'jquery' ), $this->version, false );

	}

    public function IES2MaresPensador_respuesta() {
        $response = array(
            'error' => false,
        );

        $respuesta = array(
            'post_id' => $_POST['post_id'],
            'nombre' => htmlspecialchars($_POST['nombre']),
            'curso' => htmlspecialchars($_POST['curso']),
            'solucion' => htmlspecialchars($_POST['solucion'])
        );

        $respuestas = get_option('IES2MaresPensador_respuestas');
        $respuestas[] = $respuesta;
        update_option('IES2MaresPensador_respuestas', $respuestas);
        $response['message'] = __("Respuesta registrada correctamente");

        exit(json_encode($response));
    }
}
