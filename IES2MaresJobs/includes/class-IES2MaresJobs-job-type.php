<?php
/**
 * Created by PhpStorm.
 * User: alberto
 * Date: 5/02/18
 * Time: 13:28
 */

if(!class_exists('IES2MaresJobs_job_type'))
{
    /**
     * A PostTypeTemplate class that provides 3 additional meta fields
     */
    class IES2MaresJobs_job_type
    {
        const POST_TYPE	= "job";
        private $_meta	= array(
            'meta_a',
            'meta_b',
            'meta_c',
        );

        /**
         * The Constructor
         */
        public function __construct()
        {
            // register actions
            add_action('init', array(&$this, 'init'));
            add_action('admin_init', array(&$this, 'admin_init'));
        } // END public function __construct()

        /**
         * hook into WP's init action hook
         */
        public function init()
        {
            // Initialize Post Type
            $this->create_post_type();
            add_action('save_post', array(&$this, 'save_post'));
            add_action('publish_job', array(&$this, 'send_mail'));
        } // END public function init()

        /**
         * Create the post type
         */
        public function create_post_type()
        {
            register_post_type(self::POST_TYPE,
                array(
                    'labels' => array(
                        'name' => __(sprintf('%ss', ucwords(str_replace("_", " ", self::POST_TYPE)))),
                        'singular_name' => __(ucwords(str_replace("_", " ", self::POST_TYPE)))
                    ),
                    'public' => true,
                    'has_archive' => true,
                    'description' => __("This is a sample post type meant only to illustrate a preferred structure of plugin development"),
                    'supports' => array(
                        'title', 'editor', 'excerpt',
                    ),
                )
            );
        }

        /**
         * Save the metaboxes for this custom post type
         */
        public function save_post($post_id)
        {
            // verify if this is an auto save routine.
            // If it is our form has not been submitted, so we dont want to do anything
            if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            {
                return;
            }

            if(isset($_POST['post_type']) && $_POST['post_type'] == self::POST_TYPE && current_user_can('edit_post', $post_id))
            {
                foreach($this->_meta as $field_name)
                {
                    // Update the post's meta field
                    update_post_meta($post_id, $field_name, $_POST[$field_name]);
                }
            }
            else
            {
                return;
            } // if($_POST['post_type'] == self::POST_TYPE && current_user_can('edit_post', $post_id))
        } // END public function save_post($post_id)

        /**
         * Send mail to subscribers
         */
        public function send_mail($post_id)
        {
            if($emails = get_option('IES2MaresJob_suscriptores')) {
                $post = get_post($post_id);
                $author = $post->post_author; /* Post author ID. */
//                $name = get_the_author_meta( 'display_name', $author );
                $email = get_the_author_meta( 'user_email', $author );
                $title = $post->post_title;
                $permalink = get_permalink( $post_id );
                $edit = get_edit_post_link( $post_id, '' );
                foreach ($emails as $email) {
                    $to[] = $email;
                }
                $subject = sprintf( 'Published: %s', $title );
                $message = sprintf ('Congratulations! Your article “%s” has been published.' . "\n\n", $title );
                $message .= sprintf( 'View: %s', $permalink );
                $headers[] = '';

                wp_mail( $to, $subject, $message, $headers );

            }
        } // END public function save_post($post_id)

        /**
         * hook into WP's admin_init action hook
         */
        public function admin_init()
        {
            // Add metaboxes
            add_action('add_meta_boxes', array(&$this, 'add_meta_boxes'));
        } // END public function admin_init()

        /**
         * hook into WP's add_meta_boxes action hook
         */
        public function add_meta_boxes()
        {
            // Add this metabox to every selected post
            add_meta_box(
                sprintf('wp_plugin_template_%s_section', self::POST_TYPE),
                sprintf('%s Information', ucwords(str_replace("_", " ", self::POST_TYPE))),
                array(&$this, 'add_inner_meta_boxes'),
                self::POST_TYPE
            );
        } // END public function add_meta_boxes()

        /**
         * called off of the add meta box
         */
        public function add_inner_meta_boxes($post)
        {
            // Render the job order metabox
            require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/job-type-template-metabox.php';
        } // END public function add_inner_meta_boxes($post)

    } // END class IES2MaresJobs_job_type
} // END if(!class_exists('IES2MaresJobs_job_type'))