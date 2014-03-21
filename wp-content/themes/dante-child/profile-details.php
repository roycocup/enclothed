<?php
/**
*
* template name: Profile Details
*
**/

get_header(); ?>

<?php 
if (isset($_SESSION['section_1'])){
	$section = $_SESSION['section_1'];	
}else {
	$section = @$_POST['section_1'];
}


?>

<h3><?php the_title(); ?></h3> 
<form action="" method="POST" name='section_1'>
	<?php $nonce = wp_create_nonce( get_uri() ); ?>
	<div class="flashmessages"><?php flashMessagesDisplay(); ?></div>

	<div style="float:left;">
		<input type="text" name="section_1[name]" placeholder='Full Name' value="<?php echo_if_exists($section['name']); ?>"><br>
		<input type="text" name="section_1[address]" placeholder='Address' value="<?php echo_if_exists($section['address']); ?>"><br>
		<input type="text" name="section_1[city]" placeholder='Town / City' value="<?php echo_if_exists($section['city']); ?>"><br>
		<input type="text" name="section_1[email]" placeholder='Email' value="<?php echo_if_exists($section['email']); ?>"><br>
	</div>
	
	<div style="float:left; padding-left:30px;">
		<input type="text" name="section_1[post_code]" placeholder='Post Code' value="<?php echo_if_exists($section['post_code']); ?>"><br>
		<input type="text" name="section_1[phone]" placeholder='Phone Number' value="<?php echo_if_exists($section['phone']); ?>"><br>
		<input type="text" name="section_1[occupation]" placeholder='Occupation' value="<?php echo_if_exists($section['occupation']); ?>"><br>
		<input type="password" name="section_1[password]" placeholder='Password' value="<?php echo_if_exists($section['password']); ?>"><br>
	</div>

	<br><br><br><br><br><br>

	<div>
		<input type="text" name='section_1[dob]' placeholder='Date of Birth' value="<?php echo_if_exists($section['dob']); ?>">

		<h5>How did you hear about Enclothed</h5>
		<select name="section_1[feedback_1]">
			<option value="0">Select One</option>
			<option value="word">Word of Mouth</option>
			<option value="Magazine">Magazine</option>
			<option value="other">Other</option>
		</select>
		<input type="text" name="section_1[feedback_2]" placeholder='What other...'>
	</div>
	

	<br><br><br><br><br><br>


	<input type="hidden" value="<?php echo $nonce; ?>" name='nonce'>
	<button onclick="submit()">Save and Continue</button>
</form>


<?php get_footer(); ?>