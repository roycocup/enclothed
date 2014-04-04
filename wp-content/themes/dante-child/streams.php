<?php
/**
*
* Template Name: Streams 
*
**/


// $posts = get_facebook_posts();
// $i = 1;
// foreach ($posts as $post) {
// 	if ($i >= 2) break;
// 	if (empty($post['content'])) {
// 		$post_content = $post['link_description']; 
// 	} else {
// 		$post_content = $post['content']; 
// 	} 

	
// 	$time = time_elapsed($post['timestamp']);

// 	echo "<div class='fb_post' style='padding-bottom:20px'>";
// 	echo "<div class='fb_post_content'>$post_content</div>";
// 	echo "<div class='fb_time'>$time</div>";	
// 	echo "</div>";
// 	$i++;
// }

echo get_fb_posts(2); 


$images = get_fb_post_image(1);
echo $images;
