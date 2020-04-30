<?php

if ( ! function_exists('yeadh_custom_post_type') ) {
	
    /**
     * Register a custom post type.
     *
     * @link http://codex.wordpress.org/Function_Reference/register_post_type
     */
    function yeadh_custom_post_type() {

        //portfolio
        register_post_type(
            'portfolio', array(
            'labels'                 => array(
                'name'               => _x( 'Portfolio', 'post type general name', 'yeadh' ),
                'singular_name'      => _x( 'Portfolio', 'post type singular name', 'yeadh' ),
                'menu_name'          => _x( 'Portfolio', 'admin menu', 'yeadh' ),
                'name_admin_bar'     => _x( 'Portfolio', 'add new on admin bar', 'yeadh' ),
                'add_new'            => _x( 'Add New', 'Portfolio', 'yeadh' ),
                'add_new_item'       => __( 'Add New Portfolio', 'yeadh' ),
                'new_item'           => __( 'New Portfolio', 'yeadh' ),
                'edit_item'          => __( 'Edit Portfolio', 'yeadh' ),
                'view_item'          => __( 'View Portfolio', 'yeadh' ),
                'all_items'          => __( 'All Portfolio', 'yeadh' ),
                'search_items'       => __( 'Search Portfolio', 'yeadh' ),
                'parent_item_colon'  => __( 'Parent Portfolio:', 'yeadh' ),
                'not_found'          => __( 'No Portfolio found.', 'yeadh' ),
                'not_found_in_trash' => __( 'No Portfolio found in Trash.', 'yeadh' )
            ),

            'description'        => __( 'Description.', 'yeadh' ),
            'menu_icon'          => 'dashicons-layout',
            'public'             => true,
            'publicly_queryable' => false,
            'rewrite'            => array( 'slug' => 'portfolio' ),
            'supports'           => array( 'title','thumbnail' )
        ));

        // portfolio taxonomy
        register_taxonomy(
            'portfolio_category',
            'portfolio',
            array(
                'labels' => array(
                    'name' => __( 'Portfolio Category', 'yeadh' ),
                    'add_new_item'      => __( 'Add New Category', 'yeadh' ),
                ),
                'hierarchical' => true,
                'show_admin_column'     => true
        ));
    }

    add_action( 'init', 'yeadh_custom_post_type' );

}