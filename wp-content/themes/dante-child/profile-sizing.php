<?php
/**
*
* template name: Profile Sizing
*
**/

get_header();
if (isset($_SESSION['section_3'])){
	$section = $_SESSION['section_3'];	
}else if(isset($_POST['section_3'])){
	$section = $_POST['section_3'];
} else {
	$section = array();
}


?>

<h3><?php the_title(); ?></h3> 
<form action="" method="POST" name='section_3'>
	<?php $nonce = wp_create_nonce( get_uri() ); ?>
	<div class="flashmessages"><?php flashMessagesDisplay(); ?></div>

	<input type="text" name="name">
	
	<br><br><br><br><br><br>


	<input type="hidden" value="<?php echo $nonce; ?>" name='nonce'>
	<button onclick="submit()">Save and Continue</button>
</form>

<?php get_footer();?>
