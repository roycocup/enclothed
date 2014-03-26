<?php 
/**
*
*  Template name: Pricing 
*
**/

?>

<?php get_header(); ?>

<script src="http://code.jquery.com/jquery.min.js"></script>
<script src="<?php echo bloginfo('stylesheet_directory'); ?>/js/responsivemobilemenu.js"></script>
<script src="<?php echo bloginfo('stylesheet_directory'); ?>/js/parallax.js"></script>
<link rel="stylesheet" href="<?php echo bloginfo('stylesheet_directory'); ?>/css/paralax.css" type="text/css">
<link rel="stylesheet" href="<?php echo bloginfo('stylesheet_directory'); ?>/css/normalize.css" type="text/css">
<link rel="stylesheet" href="<?php echo bloginfo('stylesheet_directory'); ?>/css/responsivemobilemenu-edt2.css" type="text/css"/>

<script type="text/javascript">
	$(document).ready(function() {
		$("body").ezBgResize({
				img     : "images/bg.jpg", // Relative path example.  You could also use an absolute url (http://...).
				opacity : 1, // Opacity. 1 = 100%.  This is optional.
				center  : true // Boolean (true or false). This is optional. Default is true.
			});
	});
</script>

<?php
$options = get_option('sf_dante_options');

$default_show_page_heading = $options['default_show_page_heading'];
$default_page_heading_bg_alt = $options['default_page_heading_bg_alt'];
$default_sidebar_config = $options['default_sidebar_config'];
$default_left_sidebar = $options['default_left_sidebar'];
$default_right_sidebar = $options['default_right_sidebar'];

$pb_active = get_post_meta($post->ID, '_spb_js_status', true);
$show_page_title = get_post_meta($post->ID, 'sf_page_title', true);
$page_title_style = get_post_meta($post->ID, 'sf_page_title_style', true);
$page_title = get_post_meta($post->ID, 'sf_page_title_one', true);
$page_subtitle = get_post_meta($post->ID, 'sf_page_subtitle', true);
$page_title_bg = get_post_meta($post->ID, 'sf_page_title_bg', true);
$fancy_title_image = rwmb_meta('sf_page_title_image', 'type=image&size=full');
$page_title_text_style = get_post_meta($post->ID, 'sf_page_title_text_style', true);
$fancy_title_image_url = "";

if ($show_page_title == "") {
	$show_page_title = $default_show_page_heading;
}
if ($page_title_bg == "") {
	$page_title_bg = $default_page_heading_bg_alt;
}
if ($page_title == "") {
	$page_title = get_the_title();
}

foreach ($fancy_title_image as $detail_image) {
	$fancy_title_image_url = $detail_image['url'];
	break;
}

if (!$fancy_title_image) {
	$fancy_title_image = get_post_thumbnail_id();
	$fancy_title_image_url = wp_get_attachment_url( $fancy_title_image, 'full' );
}

$sidebar_config = get_post_meta($post->ID, 'sf_sidebar_config', true);
$left_sidebar = get_post_meta($post->ID, 'sf_left_sidebar', true);
$right_sidebar = get_post_meta($post->ID, 'sf_right_sidebar', true);

if ($sidebar_config == "") {
	$sidebar_config = $default_sidebar_config;
}
if ($left_sidebar == "") {
	$left_sidebar = $default_left_sidebar;
}
if ($right_sidebar == "") {
	$right_sidebar = $default_right_sidebar;
}

sf_set_sidebar_global($sidebar_config);

$page_wrap_class = $post_class_extra = '';
if ($sidebar_config == "left-sidebar") {
	$page_wrap_class = 'has-left-sidebar has-one-sidebar row';
	$post_class_extra = 'col-sm-8';
} else if ($sidebar_config == "right-sidebar") {
	$page_wrap_class = 'has-right-sidebar has-one-sidebar row';
	$post_class_extra = 'col-sm-8';
} else if ($sidebar_config == "both-sidebars") {
	$page_wrap_class = 'has-both-sidebars row';
	$post_class_extra = 'col-sm-9';
} else {
	$page_wrap_class = 'has-no-sidebar';
}

$remove_breadcrumbs = get_post_meta($post->ID, 'sf_no_breadcrumbs', true);
$remove_bottom_spacing = get_post_meta($post->ID, 'sf_no_bottom_spacing', true);
$remove_top_spacing = get_post_meta($post->ID, 'sf_no_top_spacing', true);

if ($remove_bottom_spacing) {
	$page_wrap_class .= ' no-bottom-spacing';
}
if ($remove_top_spacing) {
	$page_wrap_class .= ' no-top-spacing';
}

$options = get_option('sf_dante_options');
$disable_pagecomments = false;
if (isset($options['disable_pagecomments']) && $options['disable_pagecomments'] == 1) {
	$disable_pagecomments = true;
}
?>

<?php if ($show_page_title) { ?>
<div class="container">
	<div class="row">
		<?php if ($page_title_style == "fancy") { ?>
		<?php if ($fancy_title_image_url != "") { ?>
		<div class="page-heading fancy-heading col-sm-12 clearfix alt-bg <?php echo $page_title_text_style; ?>-style fancy-image" style="background-image: url(<?php echo $fancy_title_image_url; ?>);">
			<?php } else { ?>
			<div class="page-heading fancy-heading col-sm-12 clearfix alt-bg <?php echo $page_title_bg; ?>">
				<?php } ?>
				<div class="heading-text">
					<h1 class="entry-title"><?php echo $page_title; ?></h1>
					<?php if ($page_subtitle) { ?>
					<h3><?php echo $page_subtitle; ?></h3>
					<?php } ?>
				</div>
			</div>
			<?php } else { ?>
			<div class="page-heading col-sm-12 clearfix alt-bg <?php echo $page_title_bg; ?>">
				<div class="heading-text">
					<h1 class="entry-title"><?php echo $page_title; ?></h1>
				</div>
				<?php 
				// BREADCRUMBS
				if (!$remove_breadcrumbs) {
					echo sf_breadcrumbs();
				}
				?>
			</div>
			<?php } ?>
		</div>
	</div>
	<?php } ?>

	<?php if ($sidebar_config != "no-sidebars" || $pb_active != "true") { ?>
	<div class="container">
		<?php } ?>

		<div class="inner-page-wrap <?php echo $page_wrap_class; ?> clearfix">

			<?php if (have_posts()) : the_post(); ?>

				<!-- OPEN page -->
				<div <?php post_class('clearfix ' . $post_class_extra); ?> id="<?php the_ID(); ?>">


					<div class="page-content clearfix">

						<!-- parallax bit -->
							<div id="Parallax" class="hidden-xs hidden-sm">
								<ul id="scene" class="scene">
									<li class="layer" data-depth="0"><img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/woodbg.png"></li>
									<!-- <li class="layer" data-depth="0.10"><img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/darkwood_floor.jpg"></li> -->
									<li class="layer" data-depth="0.20"><img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/belt2-fc.png"></li>
									<li class="layer" data-depth="0.30"><img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/glasses-fc.png"></li>
									<li class="layer" data-depth="0.40"><img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/gloves-fc.png"></li>
									<li class="layer" data-depth="0.50"><img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/shirt-fc.png"></li>
									<li class="layer" data-depth="0.60"><img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/shoes-fc.png"></li>
									<li class="layer" data-depth="0.70"><img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/buttons-fc.png"></li>
								</ul>
								<div class="mini-wrapper">
									<div class="intro">
										<div class="great-clothes"><img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/pricing.png" alt="greatclothes" /></div>
										<p class="intro-text">We will only ever charge you the same price the shops do. There are no added fees here - the deliveries and collections are free and the there is no additional charge for the service.</p>
									</div><!--intro-->
								</div><!--minwrapper end-->
							</div> <!--Parallax End-->
						<!-- end of parallax bit -->

						<?php the_content(); ?>

						<div class="link-pages"><?php wp_link_pages(); ?></div>

					</div>


					<!-- CLOSE page -->
				</div>

			<?php endif; ?>

			<?php if ($sidebar_config == "left-sidebar") { ?>
			<aside class="sidebar left-sidebar col-sm-4">
				<?php dynamic_sidebar($left_sidebar); ?>
			</aside>
			<?php } else if ($sidebar_config == "right-sidebar") { ?>
			<aside class="sidebar right-sidebar col-sm-4">
				<?php dynamic_sidebar($right_sidebar); ?>
			</aside>
			<?php } else if ($sidebar_config == "both-sidebars") { ?>
			<aside class="sidebar right-sidebar col-sm-3">
				<?php dynamic_sidebar($right_sidebar); ?>
			</aside>
			<?php } ?>

		</div>

		<?php if ($sidebar_config != "no-sidebars" || $pb_active != "true") { ?>
	</div>
	<?php } ?>

	<!--// WordPress Hook //-->
	
	<script>
		var scene = document.getElementById('scene');
		var parallax = new Parallax(scene);
	</script>
	<?php get_footer(); ?>