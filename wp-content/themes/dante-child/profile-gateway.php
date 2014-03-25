<?php
/**
*
* template name: Box Payment Gateway
*
**/

get_header();
?>

<?php 
	$ldm_sagepay = new ldm_sagepay();
	$config = $ldm_sagepay->getConfig();
	$config['total'] = '500';
	$sagepay = $ldm_sagepay->getInstance($config);
	$form = $sagepay->renderForm();
?>

	<?php echo $form; ?>
	<?php $nonce = wp_create_nonce( get_uri() ); ?>
	<div class="flashmessages"><?php flashMessagesDisplay(); ?></div>

	<span style='color:white;'>Going to Sagepay for a authorization of £500</span>
	
	
	<br><br><br><br><br><br>


	<input type="hidden" value="<?php echo $nonce; ?>" name='nonce'>
	<button onclick="submit()">Save and Continue</button>
</form>

<?php get_footer(); ?>
