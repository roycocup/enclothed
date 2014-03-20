<?php
/**
*
* template name: Box Payment Gateway
*
**/

if (isset($_SESSION['section_1'])){
	$section = $_SESSION['section_1'];	
}else {
	$section = $_POST['section_1'];
}


?>

<h3><?php the_title(); ?></h3> 
<form action="" method="POST" name='section_2'>
	<?php $nonce = wp_create_nonce( get_uri() ); ?>
	<div class="flashmessages"><?php flashMessagesDisplay(); ?></div>

	Going to Sagepay for a authorization of £500
	
	
	<br><br><br><br><br><br>


	<input type="hidden" value="<?php echo $nonce; ?>" name='nonce'>
	<button onclick="submit()">Save and Continue</button>
</form>
