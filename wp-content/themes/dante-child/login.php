<?php
/**
*
* template name: Login 
*
**/

//wp_enqueue_script( 'jquery' );
get_header();
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>

	$(document).ready(function($){

		$('#login-bnt').click(function(){
			var user = $('#user').val(); 
			var pass = $('#password').val();
			console.log('user:' + user, 'pass:' + pass);
			ajax_login(user, pass);
		});

		function ajax_login(user, pass){
			var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
			$.ajax({
				type:'POST',
				url:ajaxurl,
				data: { 
					action: 'enc_ajax_getvars',
					function_name: '_ajax_login',
					parameters: [user, pass],
				},
				error:function(e){
					console.log(e);
				},
				success: function(data) {
					console.log(data);
					if(data == "yes"){
						$('.flashmessages').html('You are logged in');
					}else {
						$('.flashmessages').html('Wrong credentials');
					}
				}
			});
		}

	});
		
	
</script>

<?php $user = wp_get_current_user(); ?>
<?php if(empty($user->data)): ?>
	<div class="flashmessages"></div>
	<input type="hidden" name="nonce" value="<?php echo wp_create_nonce('home_login'); ?>" />
	<input type="text" id="user" placeholder='username'><br>
	<input type="text" id="password" placeholder='password'><br>
	<button id="login-bnt">Logs in you and stuff</button>
	<a href="/home/lostpass" title="Lost Password">Lost Password?</a>
<?php else: ?>
	<div>You are already logged in</div>
<?php endif; ?>




<?php get_footer(); ?>



