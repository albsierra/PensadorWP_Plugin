<?php
/**
 * Created by PhpStorm.
 * User: alberto
 * Date: 17/02/18
 * Time: 22:01
 */

// Creando la clase Respuesta
class IES2MaresPensadorRespuesta {

// Creando la vista de las respuestas en el Backend
    public static function listado( $post_id ) {
        global $wpdb;
        $respuestas = $wpdb->get_results(
                    $wpdb->prepare("SELECT * FROM {$wpdb->prefix}pensador_respuesta WHERE post_id=%d", $post_id) 
                 );
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/IES2MaresPensador-respuestas-display.php';
        pensadorMostrarRespuestas($respuestas);
    }
        
}
