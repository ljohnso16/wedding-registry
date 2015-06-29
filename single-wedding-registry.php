<?php
wp_head();
while ( have_posts() ) : the_post();					

$thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
$thumb_url = $thumb_url_array[0];
$couple_name = get_post_meta( get_the_ID(), 'wedding_registry_field_a', true ) . ' & ' . get_post_meta( get_the_ID(), 'wedding_registry_field_b', true );
$new_title = $couple_name .'\'s Wedding Registry';
$event_date = get_post_meta( get_the_ID(), 'event-date', true); 
?>

<title> <?php echo $new_title; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta property="og:title" content="<?php echo $new_title; ?>" />
<meta property="og:image" content="<?php echo $thumb_url; ?>" />
<meta property="og:description" content="<?php echo $couple_name . ' are getting married! Come see their Honeymoon Registry and contribute to their trip.' . get_the_content(); ?>">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=288590654507288";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script type="text/javascript">
/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
var disqus_shortname = 'ljohnso16'; // required: replace example with your forum shortname

/* * * DON'T EDIT BELOW THIS LINE * * */
(function () {
var s = document.createElement('script'); s.async = true;
s.type = 'text/javascript';
s.src = '//' + disqus_shortname + '.disqus.com/count.js';
(document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
}());
</script>
<div class="">
	<div class="well">
		<div class="row">
	        <div class="col-lg-12 col-md-12 col-xs-12 cover-photo" style="background-image: linear-gradient(rgba(0, 0, 0, 0.30),rgba(0, 0, 0, 0.30)),url(<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>);">
		        	<?php the_post_thumbnail('large',array('class'=>'','style'=>'width:100%;visibility:hidden;','alt'=> $couple_name )); ?>
		        
		        	<p class="float-couple"><?php echo $couple_name; ?></p>
		        
		    </div>
	        <div class="col-lg-12 col-md-12 col-xs-12 wedding-registry-content"><?php the_content();?>
	   			<div class="row text-center">
					<div class="col-xs-4 col-lg-4 col-md-4">

						<?php if(!empty(get_post_meta( get_the_ID(), 'wedding_registry_url', true ))&& !empty(get_post_meta( get_the_ID(), 'wedding_registry_url_title', true )))
						echo '<a href="'.get_post_meta( get_the_ID(), 'wedding_registry_url', true ).'">'.get_post_meta( get_the_ID(), 'wedding_registry_url_title', true ).'</a>';?>
					</div>
					<div class="col-xs-4 col-lg-4 col-md-4"><p>Save the Date</p> <p><?php if(!empty($event_date))echo $event_date; ?></p></div>
					<div class="col-xs-4 col-lg-4 col-md-4"><p>Location</p></div>
				</div>
	   			<div class="row text-center" id="social-row">
	   				<div class="col-xs-6 col-md-6 col-lg-6"><p><div class="fb-share-button" data-href="<?php the_permalink(); ?>" data-layout="button_count"></div></p></div>
	   				<div class="col-xs-6 col-md-6 col-lg-6"><p><a href="https://twitter.com/share" class="twitter-share-button" data-via="AMT_Travel">Tweet</a></p><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></div>

	   			</div>

	        </div>
			<div class="col-lg-12 col-md-12 col-xs-12" style="padding:0px !important;">
				<div class="panel panel-info">
					<div class="panel-heading">
					 	<h3 class="panel-title text-center">Paypal Secure Form</h3>
					</div>
					<div class="panel-body">
						<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
						<input type="hidden" name="cmd" value="_s-xclick">
						<input type="hidden" name="hosted_button_id" value="CEE6EYH8BKXNE">
						<div class="row">
							<input type="hidden" name="on0" value="How Much">Gift Amount:
						</div>
						<div class="row">
							<select name="os0">
								<option value="Give $25">Give $25.00 USD</option>
								<option value="Give $50">Give $50.00 USD</option>
								<option value="Give $100">Give $100.00 USD</option>
								<option value="Give $200">Give $200.00 USD</option>
								<option value="Give $400">Give $400.00 USD</option>
								<option value="Give $800">Give $800.00 USD</option>
								<option value="Give $1,600">Give $1,600.00 USD</option>
								<option value="Give $3,200">Give $3,200.00 USD</option>
								<option value="Give $6,400">Give $6,400.00 USD</option>
								<option value="Give 128,000">Give $128,000.00 USD</option>
							</select> 
						</div>
						<div class="row">
							<input type="hidden" name="on1" value="Couple Name">Couple Name
						</div>
						<div class="row">
						<input type="text" name="os1" maxlength="200" value="<?php echo $couple_name; ?>">
						</div>
						<div class="row">
							<input type="hidden" name="currency_code" value="USD">
							<input type="submit" value="Buy Now" name="submit" title="PayPal - The safer, easier way to pay online!" class="paypal_btn">
							<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
						</div>
						</form>
						
					</div>
				</div>
			</div>
			<div class="row"> 
				<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
					<div class="panel panel-info">
						<div class="panel-heading">
							<span class="clickable">
								<h3 class="panel-title">Comments</h3>
								<span class="pull-right clickable  panel-collapsed"><i class="glyphicon glyphicon-chevron-up"></i></span>
							</span >
						</div>
						<div class="panel-body" style="display:none;">
							<div id="disqus_thread"></div>
							<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
						</div>
					</div>
				</div>						
			</div>
		</div>
	</div>
</div>


<?php 
	endwhile; 
	//get_footer(); 
?>
