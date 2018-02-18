<?php
/**
 * Created by PhpStorm.
 * User: alberto
 * Date: 17/02/18
 * Time: 22:33
 */
class IES2MaresPensador_shortcode
{

    public function IES2MaresPensador_shortcode_init()
    {
        function IES2MaresPensador_shortcode($atts = [], $content = null)
        {
            if(!isset($atts['nretos'])) $atts['nretos'] = 100;

            // Buscamos los post de tipo 'reto'
            if(!isset($atts['olders']) || $atts['olders'] == 'false') {
                $argsFechas = array(
                    'relation' => 'AND',
                    array(
                        'key'     => 'fecha_inicio',
                        'value'   => date('Y-m-d'),
                        'compare' => '<='
                    ),
                    array(
                        'key'     => 'fecha_fin',
                        'value'   => date('Y-m-d'),
                        'compare' => '>='
                    )
                );
            } else {
                $argsFechas = array();
            }
            $args = array(
                'post_type'    => 'reto',
                'posts_per_page' => $atts['nretos'],
                'meta_query' => $argsFechas
            );

            $query = new WP_Query( $args);
            ob_start();
            if ( $query->have_posts() ) : ?>
                <ul class="cards">
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                        <li class="card">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <?php the_title('<h1>','</h1>'); ?>
                            </a>
                            <?php
                            $departamentoId = @get_post_meta(get_the_ID(), 'departamento', true);                                $fechaFin = @get_post_meta(get_the_ID(), 'fecha_fin', true);
                            $departamento = get_term($departamentoId, 'category');

                            $destinatarios = @get_post_meta(get_the_ID(), 'destinatarios', true);
                            ?>
                            <p style="display:inline; float:right"><?php echo $departamento->name; ?></p>
                            <p><?php echo $destinatarios ?></p>
                        </li>
                <?php endwhile; wp_reset_postdata(); ?>
                </ul>
                <!-- show pagination here -->
            <?php else : ?>
                <!-- show 404 error here -->
            <?php endif; ?>
            <?php
            $content = ob_get_contents ();
            ob_end_clean();
            return $content;
        }
        add_shortcode('IES2MaresPensador', 'IES2MaresPensador_shortcode');
    }

}
