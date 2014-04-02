<?php
/**
*
* Template name: Dashboard 
*
**/

get_header(); ?>
	<div class="container">
		<h2>Dashboard</h2>
		
		<div><a href="/profile/details">Edit your Profile</a></div>
		<div><a href="#">Edit your Style</a></div>
		<div><a href="#">Edit your Sizes and Colours</a></div>
		<div><a href="#">Edit your Prices</a></div>
		<div><a href="#">Edit your Delivery</a></div>

		<h2>Request a box</h2>
		<form action="" method="POST" name='more_box'>
		<?php $nonce = wp_create_nonce( get_uri() ); ?>
			<div class="flashmessages"><?php flashMessagesDisplay(); ?></div>
			
			<div class="row">
				<div class="col-xs-12">
					<select name="more_box[address]" id="more_box[addresses]">
						<option value="1">Address 1 - delivery default</option>
						<option value="2">Address 2</option>
						<option value="3">Address 3</option>
					</select>
				</div>
				<br><br>

				<div class="col-xs-6">
					<input type="text" placeholder='Promotional Code' name='promocode'>	
				</div>

				<div class="col-xs-6">
					<input type="text" placeholder='Gift Card Code' name='giftcode'>
				</div>
			</div>
			<br><br>

			<input type="hidden" value="<?php echo $nonce; ?>" name='nonce'>
			<div class="mini-wrapper5">
                <button class="button4" onclick="submit()">Save</button>
		 	</div>
		</form>
	</div>
	<?php get_footer(); ?>