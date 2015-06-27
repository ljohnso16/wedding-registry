<?php
/*
Plugin Name: Wedding Registry
Plugin URI: https://github.com/ljohnso16/wedding-registry/
Description: Custom Wedding Registry for Honeymoon Destination Weddings.
Version: 1.0
Author: Lloyd Johnson
Author URI: http://github.com/ljohnso16
License: GPLv2
*/
include( plugin_dir_path( __FILE__ ) . 'includes/metabox.inc.php');
include( plugin_dir_path( __FILE__ ) . 'includes/theme.inc.php');//currently empty
function enque_bootstrap(){
    wp_register_style( 'bootstrap', plugins_url('resources/bootstrap/css/bootstrap.min.css', __FILE__ ),'0','css');
    wp_enqueue_style( 'bootstrap' ); 
    wp_register_style( 'bootstrap', plugins_url('resources/bootstrap/css/bootstrap.min.css', __FILE__ ),'0','css');
    wp_enqueue_style( 'bootstrap' );  
    wp_register_style( 'bootstrap-theme', plugins_url('resources/bootstrap/css/bootstrap-theme.min.css', __FILE__ ),'0','css');
    wp_enqueue_style( 'bootstrap-theme' );  
    wp_enqueue_script( 'jquery' );      //this enables jquery via wp includes so no registering style
    wp_register_script( 'bootstrap', plugins_url('resources/bootstrap/js/bootstrap.min.js', __FILE__ ),'0',FALSE );
    wp_enqueue_script( 'bootstrap' );  
	
    wp_register_script( 'my_disqus', plugins_url('resources/disqus.js', __FILE__ ),'0',FALSE );
    wp_enqueue_script( 'my_disqus' );  	
}
function include_reg_template_function( $template_path ) {

    if ( get_post_type() == 'wedding_registry' ) 
    {
        if ( is_single() ) 
        {
            $template_path = plugin_dir_path( __FILE__ ) . 'single-wedding-registry.php';
            
        }
        if ( is_archive() )
        {
            $template_path = plugin_dir_path( __FILE__ ) . '/single-wedding-registry.php';
        }
    }
    return $template_path;
}
function create_wedding_registy() {
    register_post_type( 'wedding_registry',
        array(
            'labels' => array(
                'name' => 'Wedding Registry',
                'singular_name' => 'Wedding Registry',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Wedding Registry',
                'edit' => 'Edit',
                'edit_item' => 'Edit Wedding Registry',
                'new_item' => 'New Wedding Registry',
                'view' => 'View',
                'view_item' => 'View Wedding Registry',
                'search_items' => 'Search Wedding Registrys',
                'not_found' => 'No Wedding Registrys found',
                'not_found_in_trash' => 'No Wedding Registrys found in Trash',
                'parent' => 'Parent Wedding Registry'
            ),
 
            'public' => true,
            'menu_position' => 15,
            'supports' => array('editor', 'comments', 'thumbnail'),
            'taxonomies' => array( '' ),//will add this custom taxonomy later
            'menu_icon' => plugins_url(	 'resources/images/small-icon.png', __FILE__ ),
            'has_archive' => true,
            'rewrite' => array('slug' => 'registry', 'with_front' => FALSE)
        )
    ); 
}



//register_activation_hook( __FILE__, 'wedding_registry_rewrite_flush' );
add_action( 'init', 'create_wedding_registy' );
add_action( 'admin_init', 'wedding_registry_admin' );
add_action('wp_enqueue_scripts', 'enque_bootstrap',12);
add_filter( 'template_include', 'include_reg_template_function', 1 );
add_action('do_meta_boxes', 'change_image_box');
add_action('admin_print_scripts-post-new.php', 'events_jquery_datepicker');
add_action('admin_print_scripts-post.php', 'events_jquery_datepicker');
add_action('admin_print_styles-post-new.php', 'events_jquery_datepicker_css');
add_action('admin_print_styles-post.php', 'events_jquery_datepicker_css');
add_action( 'save_post', 'add_wedding_registry_fields', 10, 2 );
//add_action('save_post', 'events_save_meta_box');
?>