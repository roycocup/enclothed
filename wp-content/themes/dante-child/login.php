<?php
/**
*
* template name: Login 
*
**/

//wp_enqueue_script( 'jquery' );
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>

	$(document).ready(function($){
		var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
		$.ajax({
			type:'POST',
			url:ajaxurl,
			data: { 
				action: 'enc_ajax_getvars',
				data:   'foobarid'
			},
			beforeSend:function(data){
				console.log(data);
			},
			error:function(e){
				console.log(e);
			},
			success: function(data) {
				console.log(data);
			}
		});
	});
		
	
</script>

<?php
if (!empty($_POST)){
	$creds = array();
	$creds['user_login'] = $_POST['user'];
	$creds['user_password'] = $_POST['password'];
	$creds['remember'] = true;
	$user = wp_signon( $creds, false );
}
?>

<form action="" method="post">
	<input type="hidden" name="nonce" value="<?php echo wp_create_nonce('home_login'); ?>" />
	<input type="text" name="user" placeholder='username'><br>
	<input type="text" name="password" placeholder='password'><br>
	<input type="submit" value="Login">
</form>
<!-- <a href="<?php echo wp_lostpassword_url( get_permalink() ); ?>" title="Lost Password">Lost Password</a> -->

<a href="/home/lostpass" title="Lost Password">Lost Password?</a>








