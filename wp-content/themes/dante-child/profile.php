<?php
/**
*
* template name: Profile 
*
**/
?>


<?php //if the user us logged in he does not need to enrol again. Maybe he just wants another box ?>
<?php if ( is_user_logged_in() ) :?>
	<?php get_header(); ?>
	<h2>Dashboard</h2>
	
	<div><a href="/profile/address">Edit your Profile</a></div>
	<div><a href="#">Edit your Style</a></div>
	<div><a href="#">Edit your Sizes and Colours</a></div>
	<div><a href="#">Edit your Prices</a></div>
	<div><a href="#">Edit your Delivery</a></div>

	<h2>Request a box</h2>
	<form action="" method="POST" name='more_box'>
	<?php $nonce = wp_create_nonce( get_uri() ); ?>
		<div class="flashmessages"><?php flashMessagesDisplay(); ?></div>
		<select name="more_box[address]" id="more_box[addresses]">
			<option value="1">Address 1 - delivery default</option>
			<option value="2">Address 2</option>
			<option value="3">Address 3</option>
		</select>
		<br><br>
		<input type="hidden" value="<?php echo $nonce; ?>" name='nonce'>
		<input type="submit" value="submit">
	</form>
	<?php get_footer(); ?>
<?php //if the user is not logged in then bring him to the registration form ?>
<?php else : ?>
	<?php wp_redirect(get_uri()."/address/") ?>
<?php endif; ?>



