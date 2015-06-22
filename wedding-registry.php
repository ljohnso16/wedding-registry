<?php
/*
Plugin Name: Wedding Registry
Plugin URI: http://github.com/ljohnso16/TBD
Description: TBD
Version: 1.0
Author: Lloyd Johnson
Author URI: http://github.com/ljohnso16
License: GPLv2
*/
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
            'supports' => array( 'title', 'editor', 'comments', 'thumbnail', 'custom-fields' ),
            'taxonomies' => array( '' ),//will add this custom taxonomy later
            'menu_icon' => plugins_url(	 'images/small-icon.png', __FILE__ ),
            'has_archive' => false
        )
    );
}
add_action( 'admin_init', 'wedding_registry_admin' );
function wedding_registry_admin() {
    add_meta_box( 'wedding_registry_a_meta_box',
        'First and Last Name of Husband/Wife',
        'display_wedding_registry_meta_box_a',
        'wedding_registries_a', 'normal', 'high'
    );
    add_meta_box( 'wedding_registry_b_meta_box',
        'First and Last Name of Husband/Wife',
        'display_wedding_registry_meta_box_b',
        'wedding_registries_b', 'normal', 'high'
    );

}
function display_wedding_registry_meta_box_a( $wedding_registry ) {
    // Retrieve current name based on registry ID
    $movie_director = esc_html( get_post_meta( $wedding_registry->ID, 'movie_director', true ) );
    $movie_rating = intval( get_post_meta( $wedding_registry->ID, 'movie_rating', true ) );
    ?>
    <table>
        <tr>
            <td style="width: 100%">Movie Director</td>
            <td><input type="text" size="80" name="movie_review_director_name" value="<?php echo $movie_director; ?>" /></td>
        </tr>
        <tr>
            <td style="width: 150px">Movie Rating</td>
            <td>
                <select style="width: 100px" name="movie_review_rating">
                <?php
                // Generate all items of drop-down list
                for ( $rating = 5; $rating >= 1; $rating -- ) {
                ?>
                    <option value="<?php echo $rating; ?>" <?php echo selected( $rating, $movie_rating ); ?>>
                    <?php echo $rating; ?> stars <?php } ?>
                </select>
            </td>
        </tr>
    </table>
    <?php
}
?>