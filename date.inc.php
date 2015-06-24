<?php
function event_jquery_datepicker() {
    
    wp_register_script( 'my-jquery-ui-datepicker', plugins_url('/jquery-ui-datepicker/jquery-ui-1.8.11.custom.min.js', __FILE__),'1.8.11',FALSE );
    wp_enqueue_script( 'my-jquery-ui-datepicker' );   

    wp_register_script( 'datepicker', plugins_url('/jquery-ui-datepicker/datepicker.js', __FILE__),'1.0',FALSE );
    wp_enqueue_script( 'datepicker' );  

}
add_action('admin_print_scripts-post-new.php', 'event_jquery_datepicker');
add_action('admin_print_scripts-post.php', 'event_jquery_datepicker');

function event_jquery_datepicker_css() {
    wp_register_style( 'jquery-ui-datepicker', plugins_url('/jquery-ui-datepicker/css/smoothness/jquery-ui-1.8.11.custom.css', __FILE__ ),'1.8.11','css');
    wp_enqueue_style( 'jquery-ui-datepicker' );  


  

}
add_action('admin_print_styles-post-new.php', 'event_jquery_datepicker_css');
add_action('admin_print_styles-post.php', 'event_jquery_datepicker_css');

function display_wedding_registry_date_meta_box($wedding_registry){
    $date = get_post_meta($wedding_registry->ID, 'Date', true); ?>
    <p>Date (mm/dd/yy):</p>
    <input id="event-date" name="event-date" type="text" value="<?php echo $date; ?>" />
  

<?php
}

/* save post stuff */
/*        if ( isset( $_POST['event-date'] ) && $_POST['event-date'] != '' ) {

           $date = trim( $_POST['event-date'] );
    
        
              // Validate that what was entered is of the form: 00/00/00
            if(preg_match('(^\d{1,2}\/\d{1,2}\/\d{2}$)', $date) ) {
                update_post_meta($wedding_registry_id, 'Date', $date);   
        } */