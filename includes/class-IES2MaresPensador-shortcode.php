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
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <div>
                        <h2><?php the_title(); ?></h2>
                        <?php the_content(); ?>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
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
