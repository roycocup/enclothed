<?php

/**
*
* Template Name:  Blog
*
**/

get_header(); ?>

	<div id="primary" class="container">
		<div id="content" role="row">

			<?php 
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$posts_per_page = 10;
				$args = array(
					'post_type' => array('post'),
					'posts_per_page' => $posts_per_page,
					'orderby'=>'date',
					'order'=>'DESC',
					'paged' => $paged,
					);
				$posts = get_posts($args);
			?>


			<?php foreach ($posts as $post) {
				echo $post->post_title;
				echo $post->post_content;
			} ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>