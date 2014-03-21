<?php
/**
*
* template name: Profile Style
*
**/
get_header();
if (isset($_SESSION['section_2'])){
	$section = $_SESSION['section_2'];	
}else if(isset($_POST['section_2'])){
	$section = $_POST['section_2'];
} else {
	$section = array();
}


?>

<h3><?php the_title(); ?></h3> 
<form action="" method="POST" name='section_2'>
	<?php $nonce = wp_create_nonce( get_uri() ); ?>
	<div class="flashmessages"><?php flashMessagesDisplay(); ?></div>

	<input type="text" name="name">
	
	<br><br><br><br><br><br>


	<input type="hidden" value="<?php echo $nonce; ?>" name='nonce'>
	<button onclick="submit()">Save and Continue</button>
</form>

<?php get_footer(); ?>
