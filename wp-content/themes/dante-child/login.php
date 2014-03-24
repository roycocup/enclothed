<?php
/**
*
* template name: Login 
*
**/


if (!empty($_POST)){
	$creds = array();
	$creds['user_login'] = $_POST['user'];
	$creds['user_password'] = $_POST['password'];
	$creds['remember'] = true;
	$user = wp_signon( $creds, false );
	var_dump($user);
}



?>

<form action="" method="post">
	<input type="text" name="user" placeholder='username'><br>
	<input type="text" name="password" placeholder='password'><br>
	<input type="submit" value="Login">
</form>
<!-- <a href="<?php echo wp_lostpassword_url( get_permalink() ); ?>" title="Lost Password">Lost Password</a> -->

<a href="/home/lostpass" title="Lost Password">Lost Password?</a>








