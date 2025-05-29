<?php
/*
Custom Post Type: Investment Deals
*/

new investmentDeals();

class investmentDeals {

    public function __construct() {
        add_action('init', array($this, 'register_post_types'));
    }

    public function register_post_types() {
        register_post_type('investment_deals',
            array(
                'labels'            => array(
                    'name'          => __('Investment Deals'),
                    'singular_name' => __('Investment Deal')
                ),
                'has_archive'        => false,
                'public'             => true,
                'publicly_queryable' => true,
                'show_in_rest'       => false,
                'supports'           => array('title', 'thumbnail', 'revisions', 'custom-fields'),
                'menu_icon'          => 'dashicons-money',
                'menu_position'      => 3,
                'rewrite'            => array(
                    'slug' => 'investment-deals',
                    'with_front' => false,
                    'walk_dirs' => false
                )
            )
        );
    }
}
