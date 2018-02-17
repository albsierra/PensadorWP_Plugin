<?php
/**
 * Created by PhpStorm.
 * User: alberto
 * Date: 17/02/18
 * Time: 19:12
 */
?>
<table>
    <tr valign="top">
        <th class="metabox_label_column">
            <label for="departamento">Departamento</label>
        </th>
        <td>
<?php
    $catDepartamentos = get_term_by("name", "Departamentos", "category");
    $departamentoSeleccionado = @get_post_meta($post->ID, 'departamento', true);
    $departamentos =     wp_terms_checklist( $post_id, array(
        'taxonomy' => 'category',
        'descendants_and_self' => $catDepartamentos->term_id,
        'selected_cats' => array($departamentoSeleccionado),
        'checked_ontop' => false,
    ) );
 ?>
        </td>
    </tr>
    <tr valign="top">
        <th class="metabox_label_column">
            <label for="fecha_inicio">Fecha de inicio del reto</label>
        </th>
        <td>
            <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo @get_post_meta($post->ID, 'fecha_inicio', true); ?>" />
        </td>
    </tr>
    <tr valign="top">
        <th class="metabox_label_column">
            <label for="fecha_fin">Fecha de finalización del reto</label>
        </th>
        <td>
            <input type="date" id="fecha_fin" name="fecha_fin" value="<?php echo @get_post_meta($post->ID, 'fecha_fin', true); ?>" />
        </td>
    </tr>    <tr valign="top">
        <th class="metabox_label_column">
            <label for="destinatarios">Destinatarios</label>
        </th>
        <td>
            <input type="text" id="destinatarios" name="destinatarios" value="<?php echo @get_post_meta($post->ID, 'destinatarios', true); ?>" />
        </td>
    </tr>
    </tr>
    <tr valign="top">
        <th class="metabox_label_column">
            <label for="solucion">Soluci&oacute;n</label>
        </th>
        <td>
            <?php wp_editor( @get_post_meta($post->ID, 'solucion', true), 'solucion' ); ?>
        </td>
    </tr>
</table>
