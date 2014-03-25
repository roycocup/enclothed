<?php
/**
*
* template name: Lost Password 
*
**/

global $wpdb, $user_ID;
wp_enqueue_script( 'jquery' );

//block logged in users and send them home
if ($user_ID) { 
   wp_redirect( home_url() ); exit;
} else {
	
	//Validation stuff, Form stuff, etc
}

function tg_validate_url() {
	global $post;
	$page_url = esc_url(get_permalink( $post->ID ));
	$urlget = strpos($page_url, "?");

	if ($urlget === false) {
		$concate = "?";
	} else {
		$concate = "&";
	}
	
	return $page_url.$concate;
}

	?>


	<div id="content">
		<h1><?php the_title(); ?></h1>
		<div id="result"></div> <!-- To hold validation results -->
		<form id="wp_pass_reset" action="" method="post">

			<label>Username or E-mail</label><br />
			<input type="text" name="user_input" value="" /><br />
			<input type="hidden" name="action" value="tg_pwd_reset" />
			<input type="hidden" name="tg_pwd_nonce" value="<?php echo wp_create_nonce("tg_pwd_nonce"); ?>" />
			<input type="submit" id="submitbtn" name="submit" value="Reset" />

		</form>
		<script type="text/javascript">
			jQuery("#wp_pass_reset").submit(function() {
				jQuery("#result").html("<span class='loading'>Validating...</span>").fadeIn();
				var input_data = jQuery("#wp_pass_reset").serialize();
				jQuery.ajax({
					type: "POST",
					url:  "'. get_permalink( $post->ID ).'",
					data: input_data,
					success: function(msg){
						jQuery(".loading").remove();
						jQuery("<div>").html(msg).appendTo("div#result").hide().fadeIn("slow");
					}
				});
				return false;
			});
		</script>
	</div>
