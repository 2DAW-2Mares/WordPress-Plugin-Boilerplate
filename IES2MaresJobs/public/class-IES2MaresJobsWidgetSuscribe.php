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

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/IES2MaresJobs-public-display.php';

        IES2MaresJobsWidgetPublicForm($args, $instance);
    }


// Widget Backend
    public function form( $instance ) {

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/IES2MaresJobs-admin-display.php';


        IES2MaresJobsWidgetAdminForm($instance, $this);
    }

// Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
} // Class IES2MaresJobsWidgetSuscribe ends here