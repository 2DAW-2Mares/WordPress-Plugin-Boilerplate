<?php
/**
 * Created by PhpStorm.
 * User: alberto
 * Date: 7/02/18
 * Time: 12:47
 */



class IES2MaresJobs_shortcode
{

    public function IES2MaresJobs_shortcode_init()
    {
        function IES2MaresJobs_shortcode($atts = [], $content = null)
        {
            if(!isset($atts['nOfertas'])) $atts['nOfertas'] = 5;

            $query = new WP_Query( array( 'post_type' => 'job' , 'posts_per_page' => $atts['nOfertas']) );
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
        add_shortcode('IES2MaresJobs', 'IES2MaresJobs_shortcode');
    }

}