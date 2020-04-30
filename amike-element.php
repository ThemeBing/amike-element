<?php
/**
* Plugin Name: Amike Element
* Plugin URI: https://themeforest.net/item/amike-personal-portfolio-wordpress-theme/25159373
* Description: After install the amike WordPress Theme, you must need to install this "amike-element" first to get all functions of amike WP Theme.
* Version: 1.0.1
* Author: ThemeBing
* Author URI: http://themebing.com
* Text Domain: amike
* Domain Path: /languages
* License: GPL/GNU.
*/


/**----------------------------------------------------------------*/
/* Include all file
/*-----------------------------------------------------------------*/  
include_once(dirname( __FILE__ ). '/inc/custom-posts.php');
include_once(dirname( __FILE__ ). '/inc/author-widget.php');
include_once(dirname( __FILE__ ). '/inc/recent-post.php');
include_once(dirname( __FILE__ ). '/inc/social-share.php');
include_once(dirname( __FILE__ ). '/inc/elementor/elementor.php');


function amike_admin_scripts() {
    wp_enqueue_media();
    wp_enqueue_script('amike-admin-main-js', plugin_dir_url( __FILE__ ) . 'admin/assets/js/plugin.js', array('jquery'), wp_get_theme()->get( 'Version' ), true );
}
add_action( 'admin_enqueue_scripts', 'amike_admin_scripts' );