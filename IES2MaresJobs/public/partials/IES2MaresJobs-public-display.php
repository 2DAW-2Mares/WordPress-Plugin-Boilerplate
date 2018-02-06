<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    IES2MaresJobs
 * @subpackage IES2MaresJobs/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
    function IES2MaresJobsWidgetPublicForm($args, $instance) {
    $title = apply_filters( 'widget_title', $instance['title'] );

    // before and after widget arguments are defined by themes
    echo $args['before_widget'];
    if ( ! empty( $title ) )
    echo $args['before_title'] . $title . $args['after_title'];

    // This is where you run the code and display the output
    echo __( 'Suscríbete para recibir nuestras ofertas de trabajo', 'IES2MaresJobsSuscribe_widget_domain' );
    echo $args['after_widget'];
    ?>
    <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
        <input type="hidden" name="action" value="IES2MaresJob_suscribe">

        <p>
            <label for="solo-subscribe-email"><?php _e('E-Mail:', 'subscribe-to-comments'); ?>
                <input type="email" name="email" id="solo-subscribe-email" size="22" value="" /></label>
            <input type="submit" name="submit" value="<?php _e('Subscribe', 'subscribe-to-comments'); ?>" />
        </p>
    </form>
<?php
}
?>