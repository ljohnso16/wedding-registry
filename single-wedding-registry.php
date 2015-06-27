<?php
get_header();
while ( have_posts() ) : the_post();					

$thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
$thumb_url = $thumb_url_array[0];
$couple_name = get_post_meta( get_the_ID(), 'wedding_registry_field_a', true ) . ' & ' . get_post_meta( get_the_ID(), 'wedding_registry_field_b', true );
$new_title = $couple_name .'\'s Wedding Registry';
$event_date = get_post_meta( get_the_ID(), 'event-date', true); 
?>

<title> <?php echo $new_title; ?></title>

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

<div class="container-fluid">
	<div class="well">
		<div class="row">
	        <div class="col-lg-3 col-md-4 col-xs-12">
		        	<p><?php the_post_thumbnail('medium',array('class'=>'img-responsive center-block','alt'=> $couple_name )); ?></p>
		        
		        	<p class="text-center"><?php echo $couple_name; ?></p>
		        
		    </div>
	        <div class="col-lg-4 col-md-5 col-xs-12"><?php the_content();?>
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
			<div class="col-lg-3 col-md-3 col-xs-12 col-lg-offset-1">
				<div class="panel panel-info">
					<div class="panel-heading">
					 	<h3 class="panel-title text-center">Paypal Secure Form</h3>
					</div>
					<div class="panel-body">
						<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
							<input type="hidden" name="cmd" value="_s-xclick">
							<input type="hidden" name="hosted_button_id" value="CEE6EYH8BKXNE">
							<table>
							<tr><td><input type="hidden" name="on0" value="How Much">How Much</td></tr><tr><td>
							<select name="os0">
							<option value="Give">Give $25.00 USD</option>
							<option value="Give">Give $50.00 USD</option>
							<option value="Give">Give $100.00 USD</option>
							<option value="Give">Give $200.00 USD</option>
							<option value="Give">Give $400.00 USD</option>
							<option value="Give">Give $800.00 USD</option>
							<option value="Give">Give $1,600.00 USD</option>
							<option value="Give">Give $3,200.00 USD</option>
							<option value="Give">Give $6,400.00 USD</option>
							<option value="Give">Give $128,000.00 USD</option>
							</select> </td></tr>
							<tr><td><input type="hidden" name="on1" value="Couple Name">Couple Name</td></tr><tr><td><input type="text" name="os1" maxlength="200" value="<?php echo $couple_name; ?>"></td></tr>
							</table>
							<input type="hidden" name="currency_code" value="USD">
							<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
							<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
						</form>
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>
<?php 
	endwhile; 
	get_footer(); 
?>
