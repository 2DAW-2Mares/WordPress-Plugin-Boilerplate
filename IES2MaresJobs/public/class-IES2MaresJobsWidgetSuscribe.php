<?php
/**
 * Created by PhpStorm.
 * User: alberto
 * Date: 6/02/18
 * Time: 10:45
 */
// Register and load the widget
function IES2MaresSuscribe_load_widget() {
    register_widget( 'IES2MaresJobsWidgetSuscribe' );
}
add_action( 'widgets_init', 'IES2MaresSuscribe_load_widget' );

// Creating the widget
class IES2MaresJobsWidgetSuscribe extends WP_Widget {

    function __construct() {
        parent::__construct(

// Base ID of your widget
            'IES2MaresJobsWidgetSuscribe',

// Widget name will appear in UI
            __('IES2MaresJobs Suscribe Widget', 'IES2MaresJobsSuscribe_widget_domain'),

// Widget description
            array( 'description' => __( 'Suscribirse a las ofertas de empleo del I.E.S. Dos Mares', 'IES2MaresJobsSuscribe_widget_domain' ), )
        );
    }

// Creating widget front-end

    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );

// before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output
        echo __( 'Suscríbete para recibir nuestras ofertas de trabajo', 'IES2MaresJobsSuscribe_widget_domain' );
        echo $args['after_widget'];
?>
            <form action="http://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>" method="post">

                <p>
                    <label for="solo-subscribe-email"><?php _e('E-Mail:', 'subscribe-to-comments'); ?>
                        <input type="text" name="email" id="solo-subscribe-email" size="22" value="" /></label>
                    <input type="submit" name="submit" value="<?php _e('Subscribe', 'subscribe-to-comments'); ?>" />
                </p>
            </form>
<?php
    }


// Widget Backend
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'Cabecera', 'IES2MaresJobsSuscribe_widget_domain' );
        }
// Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php
    }

// Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
} // Class IES2MaresJobsWidgetSuscribe ends here