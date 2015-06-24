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
include( plugin_dir_path( __FILE__ ) . 'date.inc.php');
include( plugin_dir_path( __FILE__ ) . 'metabox.inc.php');//currently empty

add_action( 'init', 'create_wedding_registy' );
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
            'menu_icon' => plugins_url(	 'images/small-icon.png', __FILE__ ),
            'has_archive' => false,
            'rewrite' => array('slug' => 'registry', 'with_front' => FALSE)
        )
    ); 
}

function wedding_registry_rewrite_flush() {
    create_wedding_registy();
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'wedding_registry_rewrite_flush' );
add_action( 'admin_init', 'wedding_registry_admin' );
function wedding_registry_admin() {
    add_meta_box( 'wedding_registry_name_meta_box',
        'First and Last Name of Couple',
        'display_wedding_registry_meta_box',
        'wedding_registry', 'side', 'default'
    );
    add_meta_box( 'wedding_registry_date_meta_box',
        'Wedding Date',
        'display_wedding_registry_date_meta_box',
        'wedding_registry', 'side', 'default'
    );    
    // add_meta_box( 'wedding_registry_url_meta_box',
    //     'Wedding Site URL',
    //     'display_wedding_registry_url_meta_box',
    //     'wedding_registry', 'side', 'default'
    // );  
}

function display_wedding_registry_meta_box( $wedding_registry ) {
    // Retrieve current name based on registry ID
    $wedding_registry_field_a = esc_html( get_post_meta( $wedding_registry->ID, 'wedding_registry_field_a', true ) );
    $wedding_registry_field_b = esc_html( get_post_meta( $wedding_registry->ID, 'wedding_registry_field_b', true ) );

    ?>
    <table>
        <tr>
            <td style="width: 100%">Name</td>
            <td><input style="width: 160px" type="text" size="80" name="wedding_registry_field_a" value="<?php echo $wedding_registry_field_a; ?>" /></td>
        </tr>
        <tr>
            <td style="width: 100%">Name</td>
            <td><input style="width: 160px" type="text" size="80" name="wedding_registry_field_b" value="<?php echo $wedding_registry_field_b; ?>" /></td>
        </tr>

    </table>
    <?php
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
add_action( 'save_post', 'add_wedding_registry_fields', 10, 2 );
function add_wedding_registry_fields( $wedding_registry_id, $wedding_registry ) {
    // Check post type for Registry 
    if ( $wedding_registry->post_type == 'wedding_registry' ) {
        global $wp_rewrite;
        $title = '';
        // Store data in post meta table if present in post data
        if ( isset( $_POST['wedding_registry_field_a'] ) && $_POST['wedding_registry_field_a'] != '' ) {
            $title .= $_POST['wedding_registry_field_a']. ' ';
            update_post_meta( $wedding_registry_id, 'wedding_registry_field_a', $_POST['wedding_registry_field_a'] );
        }
        if ( isset( $_POST['wedding_registry_field_b'] ) && $_POST['wedding_registry_field_b'] != '' ) {
            $title .= $_POST['wedding_registry_field_b'];
            update_post_meta( $wedding_registry_id, 'wedding_registry_field_b', $_POST['wedding_registry_field_b'] );
        }
        if ( isset( $_POST['event_date'] ) && $_POST['event_date'] != '' ) {
            update_post_meta( $wedding_registry_id, 'event_date', $_POST['event_date'] );
        }
        global $wpdb;//defines global wpdb, this alows us to update the db
        $wpdb->update( $wpdb->posts, array( 'post_title' => seoUrl($title) ), array( 'ID' => $wedding_registry_id ) ); 
        $wp_rewrite->flush_rules();
    }
}
function enque_bootstrap(){
    wp_register_style( 'bootstrap', plugins_url('bootstrap/css/bootstrap.min.css', __FILE__ ),'0','css');
    wp_enqueue_style( 'bootstrap' );  

    wp_register_style( 'bootstrap-theme', plugins_url('bootstrap/css/bootstrap-theme.min.css', __FILE__ ),'0','css');
    wp_enqueue_style( 'bootstrap-theme' );  

    wp_register_script( 'bootstrap', plugins_url('bootstrap/js/bootstrap.min.js', __FILE__ ),'0',FALSE );
    wp_enqueue_script( 'bootstrap' );  
}

add_action('wp_enqueue_scripts', 'enque_bootstrap');

add_filter( 'template_include', 'include_reg_template_function', 1 );
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

add_action('do_meta_boxes', 'change_image_box');
function change_image_box()
{
    remove_meta_box( 'postimagediv', 'wedding_registry', 'side' );
    add_meta_box('postimagediv', __('Couple Photo'), 'post_thumbnail_meta_box', 'wedding_registry', 'side', 'default');
}






?>