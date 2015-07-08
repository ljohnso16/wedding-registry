<?php get_header(); ?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta property="og:title" content="AMT Weddings Honeymoon Registry" />
<meta property="og:image" content="" />
<meta property="og:description" content="Take a peek at these honeymoon registries and read what these couples have to say about themselves and their trip">
<div class="clearfix" id="registry-row">
<?php while ( have_posts() ) : the_post();					
$couple_name = get_post_meta( get_the_ID(), 'wedding_registry_field_a', true ) . ' & ' . get_post_meta( get_the_ID(), 'wedding_registry_field_b', true );
?>

	<a href="<?php echo get_permalink( $post->ID ); ?>">
		<div id="registry-hover" class="registry-tile the-objects">
			<div class="img-block registry-content" style="background-image: url(<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID,'thumbnail') ); ?>);"></div>
				<div class="caption registry-overlay">
					<?php echo $couple_name;?>
				</div>
		</div>
	</a>

<?php endwhile; ?>
</div>
<?php get_footer(); ?>