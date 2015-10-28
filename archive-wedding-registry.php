<?php get_header();?>
<title>AMT Weddings Honeymoon Registry</title>
<meta property="og:title" content="AMT Weddings Honeymoon Registry" />
<meta property="og:image" content="http://www.amtweddings.com/wp-content/plugins/wedding-registry/resources/images/wedding-reg-logo.jpg" />
<meta property="og:description" content="Take a peek at these honeymoon registries and read what these couples have to say about themselves and their trip">
<div id="fb-root"></div>
<!-- <script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=281922421818818";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script> -->
<div class="text-center col-sm-12 col-md-12 col-lg-12"><h2>Current Honeymoon Registries</h2></div>
<div class="center-block text-center">	<div class="fb-share-button" data-href="http://amtweddings.com<?php echo $_SERVER['REQUEST_URI']; ?>" data-layout="button_count"></div>
<a href="https://twitter.com/share" class="twitter-share-button" data-via="AMT_Travel" data-related="AMT_Travel" data-hashtags="wedding-registry">Tweet</a>
<!-- <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script> -->
</div>
<div class="center-block text-center col-md-12 col-lg-12"><?php  posts_nav_link(); ?></div>
<div class="col-md-12 col-lg-12" id="registry-row">

<?php while ( have_posts() ) : the_post();
if(has_post_thumbnail())
{
	$img_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' );
	$thumb_url= $img_src[0];
}
else
{
	$thumb_url = plugin_dir_url( __FILE__ ).'resources/images/wedding-couple-silhouette.jpg';
}
$couple_name = get_post_meta( get_the_ID(), 'wedding_registry_field_a', true ) . ' & ' . get_post_meta( get_the_ID(), 'wedding_registry_field_b', true );
?>

	<a href="<?php echo get_permalink( $post->ID ); ?>">
		<div id="registry-hover" class="registry-tile the-objects">
			<div class="img-block registry-content" style="background-image: url(<?php echo $thumb_url; ?>);"></div>
				<div class="caption registry-overlay">
					<p><?php echo $couple_name;?></p>
					</div>
		</div>
	</a>

<?php endwhile;?>

</div>
<div class="center-block text-center" style="clear:both;"><?php  posts_nav_link(); ?></div>


<?php
//get_sidebar();
get_footer(); ?>
