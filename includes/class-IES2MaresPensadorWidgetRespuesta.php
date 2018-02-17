<?php
/**
 * Created by PhpStorm.
 * User: alberto
 * Date: 17/02/18
 * Time: 22:01
 */
// Registrar y cargar el widget
function IES2MaresRespuesta_load_widget() {
    register_widget( 'IES2MaresPensadorWidgetRespuesta' );
}
add_action( 'widgets_init', 'IES2MaresRespuesta_load_widget' );

// Creando el widget
class IES2MaresPensadorWidgetRespuesta extends WP_Widget {

    function __construct() {
        parent::__construct(

// ID base del widget
            'IES2MaresPensadorWidgetRespuesta',

// Nombre del widget que aparecerá en la UI
            __('IES2MaresPensador Respuesta Widget', 'IES2MaresPensadorRespuesta_widget_domain'),

// Descripción del widget
            array( 'description' => __( 'Responder a los retos planteados en El Pensador', 'IES2MaresPensadorRespuesta_widget_domain' ), )
        );
    }

// Creando la vista del widget del Frontend

    public function widget( $args, $instance ) {

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/IES2MaresPensador-public-display.php';

        IES2MaresPensadorWidgetPublicForm($args, $instance);
    }


// Creando la vista del widget del Backend
    public function form( $instance ) {

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/IES2MaresPensador-admin-display.php';


        IES2MaresPensadorWidgetAdminForm($instance, $this);
    }

// Actualizando el widget reemplazando la instancia antigua por la nueva
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
} // Class IES2MaresPensadorWidgetRespuesta ends here