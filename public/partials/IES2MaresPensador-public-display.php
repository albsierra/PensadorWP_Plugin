<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    IES2MaresPensador
 * @subpackage IES2MaresPensador/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
function IES2MaresPensadorWidgetPublicForm($args, $instance) {
    if(is_singular( 'reto' )) :
    $title = apply_filters( 'widget_title', $instance['title'] );

    // los argumentos before y after del widget son definidos por el tema
    echo $args['before_widget'];
    if ( ! empty( $title ) )
        echo $args['before_title'] . $title . $args['after_title'];

    // Aquí es donde ejecutaremos el código y mostramos la salida
    echo __( 'Responde aquí al reto', 'IES2MaresPensadorRespuesta_widget_domain' );
    echo $args['after_widget'];
    ?>
    <form  class="widget_form_respuesta" action="<?php echo esc_url( admin_url('admin-ajax.php') ); ?>" method="post">
        <input type="hidden" name="action" value="IES2MaresPensador_respuesta">
        <input type="hidden" name="post_id" value="<?php the_ID() ?>">
        <p>
            <label for="solo-respuesta-nombre"><?php _e('Nombre completo:', 'respuesta-to-comments'); ?>
                <input type="text" name="nombre" id="solo-respuesta-nombre" size="22" value="" /></label>
            <label for="solo-respuesta-curso"><?php _e('Curso:', 'respuesta-to-comments'); ?>
                <input type="text" name="curso" id="solo-respuesta-curso" size="22" value="" /></label>
            <label for="solo-respuesta-solucion"><?php _e('Soluci&oacute;n:', 'respuesta-to-comments'); ?>
                <textarea name="solucion" id="solucion"></textarea></label>
            <input type="submit" name="submit" value="<?php _e('Responder', 'respuesta-to-comments'); ?>" />
        </p>
    </form>
    <p class="message-respuesta"></p>
    <?php
        endif;
}
?>