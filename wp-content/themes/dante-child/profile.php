<?php
/**
*
* template name: Profile 
*
**/
 //if the user us logged in he does not need to enrol again. Maybe he just wants another box 
if ( !is_user_logged_in() ) :
	wp_redirect(get_uri()."/details/"); 
	exit;
 //if the user is not logged in then bring him to the registration form 
else : 
	wp_redirect(get_uri().'/dashboard/');
 endif; ?>



