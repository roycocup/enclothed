<?php

function recent_facebook_posts($args = array())
{
	$rfbp = rfbp_get_class();
	echo $rfbp->output($args);
}


function get_facebook_posts($num = 10){
	$rfbp = rfbp_get_class();
	return $rfbp->get_posts();
}