 <?php wp_head(); 
wp_title();
 ?>
 <style>
.col-lg-5.col-md-5.col-xs-12, .container-fluid.registry{border:1px solid white;}
.container-fluid.registry .row{border-right:1px solid white;}
.col-xs-12.col-md-4.col-lg-4 form{border:1px solid white;max-width: 200px;}

 </style>
<div class="container-fluid">

 <div class="well">
		<?php while ( have_posts() ) : the_post();					
		$couple_name = get_post_meta( get_the_ID(), 'wedding_registry_field_a', true ) . ' & ' . get_post_meta( get_the_ID(), 'wedding_registry_field_b', true );
		?>
		<div class="row">
	        <div class="col-lg-4 col-md-4 col-xs-12"><p><?php the_post_thumbnail('medium'); ?></p><p><?php echo $couple_name; ?></p></div>
	        <div class="col-lg-6 col-md-6 col-xs-12"><?php the_content();?></div>
	        <div class="col-lg-2 col-md-2 col-xs-12">
	        <p>Date and Site maybe FB HERE</p>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Paypal Secure Form</h3>
    </div>
	<div class="panel-body">
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="hosted_button_id" value="CEE6EYH8BKXNE">
				<table>
				<tr><td><input type="hidden" name="on0" value="How Much">How Much</td></tr><tr><td><select name="os0">
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
	
		


		<?php endwhile;?>
	</div>
	</div>
 <?php wp_footer(); ?>
