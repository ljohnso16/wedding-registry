<?php

function include_reg_template_function( $template_path ) {
    if ( get_post_type() == 'wedding_registry' ) {
        if ( is_single() ) {
            // checks if the file exists in the theme first,
            // otherwise serve the file from the plugin
            if ( $theme_file = locate_template( array ( 'single-wedding-registry.php' ) ) ) {
                $template_path = $theme_file;
            } else {
                $template_path = plugin_dir_path( __FILE__ ) . '/single-wedding-registry.php';
            }
        }
    }
    return $template_path;
}

function enque_bootstrap(){
    wp_register_style( 'bootstrap', plugins_url('bootstrap/css/bootstrap.min.css', __FILE__ ),'0','css');
    wp_enqueue_style( 'bootstrap' );  
    wp_register_style( 'bootstrap-theme', plugins_url('bootstrap/css/bootstrap-theme.min.css', __FILE__ ),'0','css');
    wp_enqueue_style( 'bootstrap-theme' );  
    wp_register_script( 'bootstrap', plugins_url('bootstrap/js/bootstrap.min.js', __FILE__ ),'0',FALSE );
    wp_enqueue_script( 'bootstrap' );  
}
function seoUrl($string) {
    //Lower case everything
    $string = strtolower($string);
    //Make alphanumeric (removes all other characters)
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    //Clean up multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", " ", $string);
    //Convert whitespaces and underscore to dash
    $string = preg_replace("/[\s_]/", "-", $string);
    return $string;
}