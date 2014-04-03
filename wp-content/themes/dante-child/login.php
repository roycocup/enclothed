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

		$('.flashmessages').hide();

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
					if(data == "true"){
						$('.flashmessages').html("Welcome!").fadeIn('slow');
						setTimeout(function(){
							$('.flashmessages').fadeOut('slow');
							window.location.replace("<?php echo home_url();?>");
						}, 3000);
					}else {
						$('.flashmessages').html("Wrong credentials. Please try again.").fadeIn('slow');
						setTimeout(function(){
							$('.flashmessages').fadeOut('slow');
						}, 3000);
					}
				}
			});
		}

	});
		
	
</script>
<div class="container">
	<div class="inner-page-wrap <?php echo $page_wrap_class; ?> clearfix">
		<div class="col-xs-3">
			<?php $user = wp_get_current_user(); ?>
			<?php if(empty($user->data)): ?>
				<div class="flashmessages"></div>
				<input type="hidden" name="nonce" value="<?php echo wp_create_nonce('home_login'); ?>" />
				<input type="text" class="customer-info" id='user' tabindex="1" placeholder="Username">
				<input type="password" class="customer-info" id='password' tabindex="1" placeholder="password">
				<button class="button4" id='login-bnt'>login</button>
				
				<a href="/home/lostpass" title="Lost Password">Lost Password?</a>
			<?php else: ?>
				<div>You are already logged in</div>
			<?php endif; ?>
		</div>
	</div>
</div>




<?php get_footer(); ?>



