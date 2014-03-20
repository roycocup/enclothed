<?php

/**
*
* template name: Test Brand Template
*
**/
get_header();
	
	$posts = get_facebook_posts();
	$i = 1;
	foreach ($posts as $post) {
		if ($i >= 6) break;
		$post_content = $post['content']; 
		$time = time_elapsed($post['timestamp']);

		echo "<div class='fb_post' style='padding-bottom:20px'>";
		echo "<div class='fb_post_content'>$post_content</div>";
		echo "<div class='fb_time'>$time</div>";	
		echo "</div>";
		$i++;
	}
	

?>

<?php get_footer(); ?>