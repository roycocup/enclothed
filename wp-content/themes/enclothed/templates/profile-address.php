<?php
/**
*
* template name: Profile Address
*
**/

?>

<h3><?php the_title(); ?></h3> 
<form action="" method="POST" name='section_1'>
	<?php $nonce = wp_create_nonce( get_uri() ); ?>
	<div class="flashmessages"><?php flashMessagesDisplay(); ?></div>

	<div style="float:left;">
		<input type="text" name="section_1[name]" placeholder='Full Name'><br>
		<input type="text" name="section_1[address]" placeholder='Address'><br>
		<input type="text" name="section_1[city]" placeholder='Town / City'><br>
		<input type="text" name="section_1[email]" placeholder='Email'><br>
	</div>
	
	<div style="float:left; padding-left:30px;">
		<input type="text" name="section_1[name]" placeholder='Post Code'><br>
		<input type="text" name="section_1[address]" placeholder='Phone Number'><br>
		<input type="text" name="section_1[occupation]" placeholder='Occupation'><br>
		<input type="password" name="section_1[password]" placeholder='Password'><br>
	</div>

	<br><br><br><br><br><br>

	<input type="hidden" value="<?php echo $nonce; ?>" name='nonce'>
	<input type="submit" value="submit">
</form>
