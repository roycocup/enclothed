<?php
/**
 *
 * Template Name: Test Form Template
 *
 */

get_header(); ?>

<?php $nonce = wp_create_nonce( get_uri() ); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<h2>Test Form</h2>
			<form action="" method="POST">
				<input type="hidden" value="<?php echo $nonce; ?>" name='nonce'>
				<input type="text" name="name">
				<input type="submit">
			</form>

		</div><!-- #content -->
	</div><!-- #primary -->
	
<?php get_footer(); ?>