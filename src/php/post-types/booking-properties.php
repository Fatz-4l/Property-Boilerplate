<?php
/*
Custom Post Type: Booking Properties
*/

new bookingProperties();

class bookingProperties {

    public function __construct() {
        add_action('init', array($this, 'register_post_types'));
    }

    public function register_post_types() {
        register_post_type('booking_properties',
            array(
                'labels'            => array(
                    'name'          => __('Booking Properties'),
                    'singular_name' => __('Booking Property')
                ),
                'has_archive'        => false,
                'public'             => true,
                'publicly_queryable' => true,
                'show_in_rest'       => false,
                'supports'           => array('title', 'thumbnail', 'revisions', 'custom-fields'),
                'menu_icon'          => 'dashicons-admin-home',
                'menu_position'      => 4,
                'rewrite'            => array(
                    'slug' => 'stays',
                    'with_front' => false,
                    'walk_dirs' => false
                )
            )
        );
    }
}
