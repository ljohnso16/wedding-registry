<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
wp_head();
while ( have_posts() ) : the_post();					
$couple_name = get_post_meta( get_the_ID(), 'wedding_registry_field_a', true ) . ' & ' . get_post_meta( get_the_ID(), 'wedding_registry_field_b', true );
?>
<a href="<?php echo get_permalink( $post->ID ); ?>">
	<div class="the-objects">
		<div class="img-block" style="background-image: url(<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID,'thumbnail') ); ?>);"></div>
		<p><?php echo $couple_name;?></p>
		<div class="caption"></div>
	</div>
</a>
<?php 
	endwhile; 
		get_footer(); 
?>
