<?php

/**
*
* Plugin Name: Enclothed General Options
* Description: A custom built plugin to enable several extra options for the site
* Depends: Enclothed-Emails
* Author: Like Digital Media
* Version: 0.1
* Author URI: http://likedigitalmedia.com
*
**/


include_once(ABSPATH . 'wp-content/plugins/enclothed-main/enclothed-main.php'); 
include_once(ABSPATH . 'wp-content/plugins/enclothed-main/models/emails.php'); 


/**
*
* Defines where the emails are all going to be directed to if in debug mode
*
**/

add_filter('wp_mail', 'sandbox_emails');
function sandbox_emails($args){
	if (get_option('enc_sandbox_email_on')){
		if($sandbox_email = get_option('enc_sandbox_email')){
			$args['to'] .= ','.$sandbox_email;
			return $args;
		}
		wp_die('Sandbox email is on but no email is defined');		
	}
	return $args;
}


/**
*
* Plugin Admin Menu
*
**/
add_action( 'admin_menu', 'plugin_menu');
function plugin_menu() {
	add_menu_page( 'Enclothed General Options', 'Enclothed Options', 'delete_pages', __FILE__, 'render', null, 101 );
	add_action( 'admin_init', 'register_settings' );
}


function register_settings(){
	register_setting( 'enc_options', 'enc_sandbox_email_on' );
	register_setting( 'enc_options', 'enc_sandbox_email' );
}



function render() {?>

<?php
//must check that the user has the required capability 
if (!current_user_can('delete_pages'))
{
	wp_die( __('You do not have sufficient permissions to access this page.') );
}

$hidden_field_name = 'token';
$sandbox_on = get_option('enc_sandbox_email_on');
$sandbox_email = get_option('enc_sandbox_email');

//all buy options enable/disable
//@TODO - This is not implemented yet
$orders_buy_on = get_option('enc_orders_buy_on');

//emails
$emails = new Emails_model();
$ty_template = $emails->getMailTemplate(Emails_model::TEMPLATE_THANK_YOU);
$oi_template = $emails->getMailTemplate(Emails_model::TEMPLATE_ORDER_IN);
$tyreg_template = $emails->getMailTemplate(Emails_model::TEMPLATE_THANK_REGISTERING);
$newbox_template = $emails->getMailTemplate(Emails_model::TEMPLATE_NEW_BOX);
$newbox_user_template = $emails->getMailTemplate(Emails_model::TEMPLATE_NEW_BOX_USER);




if( isset($_POST[ 'token' ]) && $_POST[ 'token' ] == 'token' ) {

	update_option( 'enc_sandbox_email_on', @$_POST[ 'enc_sandbox_email_on' ] );
	update_option( 'enc_sandbox_email', @$_POST[ 'enc_sandbox_email' ] );
	update_option( 'enc_orders_buy_on', @$_POST[ 'enc_orders_buy_on' ] );

	//emails
	$emails->saveMailTemplate(Emails_model::TEMPLATE_THANK_YOU, stripslashes_deep($_POST['enc_email_ty']));
	$emails->saveMailTemplate(Emails_model::TEMPLATE_ORDER_IN, stripslashes_deep($_POST['enc_email_oi']));
	$emails->saveMailTemplate(Emails_model::TEMPLATE_THANK_REGISTERING, stripslashes_deep($_POST['enc_email_tyreg']));
	$emails->saveMailTemplate(Emails_model::TEMPLATE_NEW_BOX, stripslashes_deep($_POST['enc_email_newbox']));
	$emails->saveMailTemplate(Emails_model::TEMPLATE_NEW_BOX_USER, stripslashes_deep($_POST['enc_email_newbox_user']));

}

?>

<div class="wrap">
	<h2>Enclothed General Options</h2>
	<div>
		<form method="post" action="">
			<input type="hidden" value="token" name="token">
			<?php settings_fields( 'enc_options' ); ?>
			<?php do_settings_sections( 'enc_options' ); ?>
			Additional Emails Active <input type="checkbox" name="enc_sandbox_email_on" value="1" <?php checked( get_option('enc_sandbox_email_on'), 1 ); ?> >
			<br>Addtional emails (comma dilimeted) <input type="text" name="enc_sandbox_email" value="<?php echo get_option('enc_sandbox_email'); ?>">
			

			<!-- emails -->
			<?php 
				$ty_template = $emails->getMailTemplate(Emails_model::TEMPLATE_THANK_YOU);
				$oi_template = $emails->getMailTemplate(Emails_model::TEMPLATE_ORDER_IN);
				$tyreg_template = $emails->getMailTemplate(Emails_model::TEMPLATE_THANK_REGISTERING);
				$newbox_template = $emails->getMailTemplate(Emails_model::TEMPLATE_NEW_BOX);
				$newbox_user_template = $emails->getMailTemplate(Emails_model::TEMPLATE_NEW_BOX_USER);
				
				
			?>
			<h3>Emails</h3>
			<h4>Example Placeholders</h4>
			<ul>
				<li>%name%</li>
				<li>%dob%</li>
				<li>%email%</li>
				<li>%postcode%</li>
			</ul>
			

			<label for="enc_email_ty">Thank you - Send to the user</label><br>
			<textarea cols='100' rows='10' name="enc_email_ty"><?php echo $ty_template->body; ?></textarea>
			<br>
			
			<label for="enc_email_ty">Order in - Sent to Enclothed</label><br>
			<textarea cols='100' rows='10' name="enc_email_oi"><?php echo $oi_template->body; ?></textarea>
			<br>

			
			<label for="enc_email_ty">Thank you for Registering - to user</label><br>
			<textarea cols='100' rows='10' name="enc_email_tyreg"><?php echo $tyreg_template->body; ?></textarea>
			<br>

			<label for="enc_email_ty">User just requested another box - to Enclothed</label><br>
			<textarea cols='100' rows='10' name="enc_email_newbox"><?php echo $newbox_template->body; ?></textarea>
			<br>
			
			<label for="enc_email_ty">User just requested another box - to User</label><br>
			<textarea cols='100' rows='10' name="enc_email_newbox_user"><?php echo $newbox_user_template->body; ?></textarea>
			<br>

			<!--
			<label for="enc_email_ty">Refund Email (Actual refund)</label><br>
			<textarea cols='100' rows='10' name="enc_email_ref"><?php echo $ref_template->body; ?></textarea>
			<br>
			<label for="enc_email_ty">Refund Request (client)</label><br>
			<textarea cols='100' rows='10' name="enc_email_ref_cli"><?php echo $ref_cli_template->body; ?></textarea>
			<br>
			<label for="enc_email_ty">Refund Request (Agency)</label><br>
			<textarea cols='100' rows='10' name="enc_email_ref_ag"><?php echo $ref_ag_template->body; ?></textarea>
			<br>
			<label for="enc_email_ty">Review Submited</label><br>
			<textarea cols='100' rows='10' name="enc_email_rev_sub"><?php echo $rev_sub_template->body; ?></textarea> -->


			<?php submit_button(); ?>
		</form>	
	</div>
</div>

<?php } 

