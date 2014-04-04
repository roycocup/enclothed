<?php
/**
*
* Template Name: Streams 
*
**/


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


$images = get_fb_post_image(16);
echo $images;
