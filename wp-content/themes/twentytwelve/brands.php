<?php
/**
 *
 * Template Name: Test Brands Template
 *
 */

get_header(); ?>

<?php $nonce = wp_create_nonce( get_uri() ); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<h2>All brands</h2>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->
	
<?php get_footer(); ?>