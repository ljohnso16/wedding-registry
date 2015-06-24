<?php
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
function change_image_box()
{
    remove_meta_box( 'postimagediv', 'wedding_registry', 'side' );
    add_meta_box('postimagediv', __('Couple Photo'), 'post_thumbnail_meta_box', 'wedding_registry', 'side', 'default');
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