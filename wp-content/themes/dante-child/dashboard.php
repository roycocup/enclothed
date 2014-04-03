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
		<!-- <div><a href="#">Edit your Style</a></div>
		<div><a href="#">Edit your Sizes and Colours</a></div>
		<div><a href="#">Edit your Prices</a></div>
		<div><a href="#">Edit your Delivery</a></div> -->

		<h2>Request a box</h2>
		<form action="" method="POST" name='more_box'>
		<?php $nonce = wp_create_nonce( get_uri() ); ?>
			<div class="flashmessages"><?php flashMessagesDisplay(); ?></div>
			
			<div class="row">
				<div class="col-xs-12">
					<select name="more_box[address]" id="more_box[addresses]">
						<option value="1">19, Ebeneezer Street, London N1 4LS</option>
						<option value="2">40, Gowan Stree, London EC1 5HJ</option>
					</select>
				</div>
				<br><br>

				<div class="col-xs-6">
					<label for="promocode">You have a promotional code? Great!</label>
					<input type="text" placeholder='Promotional Code' name='promocode'>	
				</div>

				<div class="col-xs-6">
					<label for="promocode">Did you receive a Gift Card? Insert its code here!</label>
					<input type="text" placeholder='Gift Card Code' name='giftcode'>
				</div>
			</div>
			<br><br>

			<input type="hidden" value="<?php echo $nonce; ?>" name='nonce'>
			<div class="mini-wrapper5">
                <button class="button4" onclick="submit()">Save & Send</button>
		 	</div>
		</form>
	</div>
	<?php get_footer(); ?>