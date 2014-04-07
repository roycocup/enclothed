<?php
/**
*
* template name: Home
*
**/
?>

<?php get_header(); ?>
	
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
	
		<?php if ($sidebar_config == "both-sidebars") { ?>
			<div class="row">	
				<div class="page-content col-sm-8">
					<?php the_content(); ?>
					<div class="link-pages"><?php wp_link_pages(); ?></div>
					
					<?php if ( comments_open() && !$disable_pagecomments ) { ?>
					<div id="comment-area">
						<?php comments_template('', true); ?>
					</div>
					<?php } ?>
				</div>
					
				<aside class="sidebar left-sidebar col-sm-4">
					<?php dynamic_sidebar($left_sidebar); ?>
				</aside>
			</div>
		<?php } else { ?>
			<div class="page-content clearfix">
	
				<?php the_content(); ?>
				












<div class="container">
	<div class="row">
		<div class="spb_content_element col-sm-12 dynamic_content area3">
			<div class="spb_wrapper">
				<div class="col-sm-12 brands_boxes_wrapper">
					<div class="col-sm-6 brands_box_left">
						<h2>OUR BRANDS</h2>
						<p>Enclothed works with over 30 premium brands. Prices are the same as in the shops</p>
					</div>
					<div class="col-sm-6 brands_box_right">
						<img src="<?php bloginfo('template_url') ?>-child/images/homepage_brands_logos.jpg" alt="" class="image-responsive" />
					</div>
				</div>
				<div class="col-sm-6 featured_blog_boxes_wrapper featured1">
					<div class="col-sm-12 featured_blog_box_left" style="background-image: url(https://31.media.tumblr.com/7141be8ef0e59faad08096bb23d9fd65/tumblr_inline_n2dlc9KRCR1rd6zrs.jpg);">
						<h2>Timeless – tweed jackets</h2>
						<p>Originally favoured for country sports and now a fashion staple tweed jackets are resistant and durable, a timeless classic, which we think everyone should own!</p>
					</div>
				</div>

				<div class="col-sm-6 social_boxes_wrapper">
				<?php 
					$fb_image_url = get_fb_post_image(2);
					if ($fb_image_url == 'default') {
						$fb_image_url = get_stylesheet_directory_uri().'/images/logo_default_icon.png';
						$bck_size = 'contain';
					} else {
						$bck_size = 'cover';
					}
				?>
					<div class="col-sm-6 social_box_left" style="background-image: url(<?php echo $fb_image_url; ?>) ;
					 background-size: <?php echo $bck_size; ?>">

					</div>
					<div class="col-sm-6 social_box_right">
						<div class="facebook_icon"></div>
						<div class="arrow_icon"></div>

						<div class="social_heading">FACEBOOK</div>
						<p><?php echo get_fb_posts(1, 30, false); ?></p>
						<div class="social_footer">

							<div class="e_icon"></div>
							<div class="social_details">
								<span class="social_author">Enclothed</span>
								<span class="social_date"><?php echo get_fb_posts_time(1,30,false); ?></span>
							</div>
							<div class="share_icon"></div>
						</div>
					</div>
				</div>




				<div class="col-sm-6 featured_blog_boxes_wrapper featured2">
					<div class="col-sm-12 featured_blog_box_left" style="background-image: url(https://31.media.tumblr.com/3c5301c9601ff228b299225d189e5586/tumblr_inline_n1cpibQwXD1rd6zrs.jpg);">
						<h2>Smart trainers – what to look for</h2>
						<p>You want something good quality, smart that you can wear to the office on a Friday, that goes with chinos or dark jeans and that will last you well.</p>
					</div>
				</div>
				<div class="col-sm-6 social_boxes_wrapper">
					<div class="col-sm-6 social_box_left" style="background-image: url(<?php echo get_stylesheet_directory_uri().'/images/logo_default_icon.png' ?>); background-size: contain">
					</div>
					<div class="col-sm-6 social_box_right">
						<div class="instagram_icon"></div>
						<div class="arrow_icon"></div>
						<div class="social_heading">INSTAGRAM</div>
						<!-- <p>The winner tonight whilst co-hosting the... with @CharmaineDavies #dontmissit</p> -->
						<p><?php echo get_instagram_posts(); ?></p>
						<div class="social_footer">
							<div class="e_icon"></div>
							<div class="social_details">
								<span class="social_author">Enclothed</span>
								<span class="social_date">1 day ago</span>
							</div>
							<div class="share_icon"></div>
						</div>
					</div>
				</div>

				<div class="col-sm-12 no-margin no-padding" style=" float:left;">
				<img class="image-responsive" alt="line" src="/wp-content/themes/dante-child/images/enclothed_in_the_media.jpg">
				</div>
	



			</div>
		</div> 
	</div> 
</div>

<div class="container"><div class="row">
	<div class="spb_content_element col-sm-12 social_buttons spb_box_text whitestroke">
		<div class="spb_wrapper">
			<div class="box-content-wrap">
<h2><span style="color: #0e2334;">STAY CONNECTED</span></h2>
<p><img class="size-full aligncenter" alt="line" src="/wp-content/themes/dante-child/images/line.png"></p>
<p><a href="#" target="_blank"></a></p><div class="sf-icon-cont cont-medium sf-icon-float-none sf-icon-"><a href="#" target="_blank"><i class="fa-twitter sf-icon sf-icon-medium"></i></a></div><a href="#" target="_blank"><div class="sf-icon-cont cont-medium sf-icon-float-none sf-icon-"><i class="fa-facebook sf-icon sf-icon-medium"></i></div></a><a href="#" target="_blank"><div class="sf-icon-cont cont-medium sf-icon-float-none sf-icon-"><i class="fa-instagram sf-icon sf-icon-medium"></i></div></a><a href="#" target="_blank"><div class="sf-icon-cont cont-medium sf-icon-float-none sf-icon-"><i class="fa-pinterest sf-icon sf-icon-medium"></i></div></a><p></p>
</div>
		</div> 
	</div> </div></div>





<style type="text/css">
.social_boxes_wrapper{
	background-color: #000; 
	margin:0; 
	padding: 0; 
	height: auto; 
	float: left; 
	display: flex;
}
.social_box_left{background-color:#000; 
	margin:0; 
	float:left; 
	background-position: center;
	padding: 20px;
	max-width: 475px;
	min-height: 270px;
	background-repeat: no-repeat;
}
.social_box_right{background-color:#fff; 
	margin:0; 
	float: left; 
	padding:0; 
	max-width: 475px;
	min-height: 270px;
	position: relative;
 }

.social_box_right .arrow_icon{
	position: absolute; 
	width: 8px;
	height: 16px;
	background-image: url(<?php bloginfo('template_url') ?>-child/images/arrow_left.png) ;
	background-position: top -8px;
	top: 15%;
	left: -8px;
 }
.social_box_right .facebook_icon{
	margin:0; 
	float: left; 
	padding:0; 
	width: 29px;
	height: 29px;
	background: url(<?php bloginfo('template_url') ?>-child/images/facebook-mini.png) no-repeat;
	margin: auto;
	float: none;
 }
 .social_box_right .instagram_icon{
	margin:0; 
	float: left; 
	padding:0; 
	width: 29px;
	height: 29px;
	background: url(<?php bloginfo('template_url') ?>-child/images/instagram-mini.png) no-repeat;
	margin: auto;
	float: none;
 }
 .social_box_right .e_icon{
	margin:0; 
	float: left; 
	padding:0; 
	width: 30px;
	height: 30px;
	background: url(<?php bloginfo('template_url') ?>-child/images/E-icon.png) no-repeat;
 }
  .social_box_right .share_icon{
	margin:0; 
	float: right; 
	padding:0; 
	width: 32px;
	height: 32px;
	background: url(<?php bloginfo('template_url') ?>-child/images/iconshare.png) no-repeat;
 }
.social_box_right .social_details{
	margin:0; 
	float: left; 
	padding:0; 
	width: auto;
	height: auto;
	padding-left: 10px;
 }
 .social_box_right .social_author{
	font-size:12px;
	color: #000;
	font-family: proxbold;
	float: left;
	line-height: 15px;
 }
 .social_box_right .social_date{
	font-size:12px;
	color: #999;
	float: left;
	line-height: 15px;
	clear: left;
 }
 .social_box_right p{font-size:14px;
	color: #000;
	padding: 0 20px 20px 20px;
	margin:0;
	letter-spacing: 0;
	text-align: center;
	line-height: 18px;
	height: 127px;
	word-wrap:break-word;
}
.social_box_right .social_heading{
	font-size: 14px;
	font-family: proxbold;
	color: #000;
	text-transform: uppercase;
	padding: 20px;
	letter-spacing: 0;
	text-align: center;
 }
 .social_box_right .social_footer{
 	border-top: 1px solid #e5e5e5;
 	width: 100%;
 	height: 52px;
 	padding:10px;
 }


@media only screen and (max-width: 991px) {

 .social_box_right{
 	height: 340px;
 	min-height: 0;
}
 .social_box_right p{
 	height: 197px;
}
}
 @media only screen and (max-width: 767px) {

.social_boxes_wrapper{	max-width: 475px;
	display: block;
/*	margin: 0 auto;
	float: none;*/
}
.social_box_left{	width: 100%;
}
.social_box_right{
	clear: left;
	min-height: 0;
	height: auto;
 }
.social_box_right .arrow_icon{
	position: absolute; 
	width: 16px;
	height: 8px;
	background-image: url(<?php bloginfo('template_url') ?>-child/images/arrow_up.png) ;
	background-position: top -8px;
	left: 15%;
	top: -8px;
 }
 .social_box_right p{
 	height: auto;
}
}


</style>













<style type="text/css">

.featured_blog_boxes_wrapper{
	margin:0; 
	padding: 0; 
	height: auto; 
	float: left; 
	display: flex;
}
.featured_blog_boxes_wrapper.featured1{
	float: right;}
.featured_blog_boxes_wrapper.featured2{
	float: left;}	
.featured_blog_box_left{
	margin:0; 
	float:left; 
	background-size: cover;
	padding: 20px;
	max-width: 475px;
	height: 350px;
}
.featured_blog_box_left h2{
	font-size:34px !important;
	color:#fff;
	margin-top: 18%;
	line-height: 40px !important;
}
.featured_blog_box_left p{font-size:14px;
	color: #fff;
	text-transform: uppercase;
	padding-top: 20px;
	padding-bottom: 20%;
	letter-spacing: 0;
	text-align: center;
}
.featured_blog_box_right{
	margin:0; 
	float: left; 
	padding:0; 
	max-width: 475px;
 }
.featured_blog_box_right img{ float:left; }

@media only screen and (max-width: 767px) {

.featured_blog_boxes_wrapper{	max-width: 475px;
	display: block;
/*	margin: 0 auto;
	float: none;*/
}
.featured_blog_box_left{	width: 100%;
	height: auto;
}
.featured_blog_box_right{
	clear: left;
 }
}

@media only screen and (max-width: 991px) {

	.featured_blog_box_left h2{
	margin-top: 18%;
}
.featured_blog_box_left p{
	padding-bottom: 10%;
}

}



.brands_boxes_wrapper{
	margin:0; 
	padding: 0; 
	height: auto; 
	float: left; 
	display: flex;
}
.brands_box_left{
	margin:0; 
	float:left; 
	background: url(<?php bloginfo('template_url') ?>-child/images/homepage_brands_text_bg.jpg) no-repeat;
	background-size: cover;
	padding: 20px;
	max-width: 475px;
}
.brands_box_left h2{font-size:34px !important;
	color:#625f5e;
	margin-top: 20%;
}
.brands_box_left p{font-size:14px;
	color: #625f5e;
	text-transform: uppercase;
	padding-top: 20px;
	padding-bottom: 20%;
	letter-spacing: 0;
	text-align: center;
}
.brands_box_right{
	margin:0; 
	float: left; 
	padding:0; 
	max-width: 475px;
 }
.brands_box_right img{ float:left; }

@media only screen and (max-width: 767px) {

.brands_boxes_wrapper{	max-width: 475px;
	display: block;
/*	margin: 0 auto;
	float: none;*/
}
.brands_box_left{	width: 100%;
}
.brands_box_right{
	clear: left;
 }
.dynamic_content{
	margin:auto;
	float: none;
	max-width:475px; 
}
}

@media only screen and (max-width: 991px) {

	.brands_box_left h2{
	margin-top: 10%;
}
.brands_box_left p{
	padding-bottom: 10%;
}

}
</style>






















				<div class="link-pages"><?php wp_link_pages(); ?></div>
				
				<?php if ( comments_open() && !$disable_pagecomments ) { ?>
					<?php if ($sidebar_config == "no-sidebars" && $pb_active == "true") { ?>
					<div id="comment-area" class="container">
					<?php } else { ?>
					<div id="comment-area">
					<?php } ?>
						<?php comments_template('', true); ?>
					</div>
				<?php } ?>				
			</div>
		<?php } ?>	
	
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
<?php get_footer(); ?>