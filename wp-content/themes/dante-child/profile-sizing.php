<?php
/**
*
* template name: Profile Sizing
*
**/
?>
<?php get_header(); ?>




<?php 
if (isset($_SESSION['section_3'])){
	$section = $_SESSION['section_3'];	
}else if(isset($_POST['section_3'])){
	$section = $_POST['section_3'];
} else {
	$section = array();
}


?>

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


<?php if ($sidebar_config != "no-sidebars" || $pb_active != "true") { ?>
<div class="container">
	<?php } ?>

	<div class="inner-page-wrap <?php echo $page_wrap_class; ?> clearfix">
		
		<?php if (have_posts()) : the_post(); ?>

			<!-- OPEN page -->
			<div <?php post_class('clearfix ' . $post_class_extra); ?> id="<?php the_ID(); ?>">

				<div class="page-content clearfix">
					<div class="row">
						<div class="full-width-text spb_content_element col-sm-12 spb_text_column no-padding-top">
							<div class="spb_wrapper clearfix">
								<h2 style="text-align: center;"><span style="color: #ffffff;">BUILD YOUR<br>
									ENCLOTHED PROFILE</span></h2>
									<p style="margin-bottom: 0;"><img class="size-full aligncenter" alt="line" src="<?php echo get_bloginfo('stylesheet_directory') ?>/images/line.png"></p>
								</div> 
							</div>
						</div>
						<div class="row">
							<!-- Main Menu -->
							<div class="details-menu">
								<ul>
									<li class="hidden-sm hidden-xs"><span>Your Details</span></li>
									<li class="hidden-sm hidden-xs"><span>Pick your Style</span></li>
									<li><span class='active'>Size and Color</span></li>
									<li class="hidden-sm hidden-xs"><span>Price and Summary</span></li>
									<li class="hidden-sm hidden-xs"><span>Delivery</span></li>
								</ul>
								<div class="shadow"><img src="<?php bloginfo('template_url') ?>-child/images/shadow.png" alt="" /></div>
							</div><!--details-menu-->

							<div class="styles-block">
								<div class="fade-border-left"></div>
								<div class="fade-border-right"></div>

								<form action="" method="POST" name='section_3'>
									<?php $nonce = wp_create_nonce( get_uri() ); ?>
									<div class="flashmessages"><?php flashMessagesDisplay(); ?></div>
									<div class="title-forms">
										<div class="mini-wrapper-forms">
											<div class="numbering">01</div>
											<p>Your size and measurements. What fits you well.</p>
											<p class="title_sub_heading">(All UK sizes - <span style="color:#f7b666;">click for conversion chart</span>)</p>
											<style>
												.title_sub_heading{
													font-family:Georgia, 'Times New Roman', Times, serif !important; font-style:italic !important; text-transform: none !important; letter-spacing:0 !important; font-size:14px !important; margin-top:-30px !important;}
												</style>
		


												<!-- sliders -->
												<script>
                                                    jQuery(document).ready(function($){
														$(function() {
                                                            $( "#tshirt_slider" ).slider({
                                                                value:40,
                                                                min: 0,
                                                                max: 80,
                                                                step: 20,
                                                                slide: function( event, ui ) {
                                                                    $( "#tshirt_selection" ).val(increments[ui.value]);
                                                                }
                                                            });
															var increments = {
																	  0: "XS", 
																	  20: "S",
																	  40: "M",
																	  60: "L",
																	  80: "XL"
																};
																
															$( "#tshirt_selection" ).val(increments[40]);
                                                      });
													});
														
														
													
                                                </script>

												<div class="col-sm-2"></div>
												<div  class="col-sm-8">
                                                    <div id="tshirt_slider">
                                                        <div class="notch_big" style="left:0%;"><div class="notch_label">XS</div></div>
                                                        <div class="notch_big" style="left:25%;"><div class="notch_label">S</div></div>
                                                        <div class="notch_big" style="left:50%;"><div class="notch_label">M</div></div>
                                                        <div class="notch_big" style="left:75%;"><div class="notch_label">L</div></div>
                                                        <div class="notch_big" style="left:100%;"><div class="notch_label">XL</div></div>
                                                        <div class="slider_left"></div>
                                                        <div class="slider_right"></div>
                                                    </div>
                                                </div>
												<div class="col-sm-2">
													<input type="text" id="tshirt_selection" class="slider_selection" disabled="disabled">
												</div>

												<style>
												input .slider_selection{ font-family:proxbold; color:#f7b666; font-size:40px;}
												.notch_big{
													position:absolute; 
													bottom:-9px; 
													background: url(<?php echo get_bloginfo('stylesheet_directory') ?>/images/notch_big.png) no-repeat ; 
													width:2px; 
													height:52px; 
													margin-left:-1px; 
													background-position:bottom;
													overflow:visible; }
												.slider_left{ 
													float:left; 
													background: url(<?php echo get_bloginfo('stylesheet_directory') ?>/images/slider_left.jpg) no-repeat ;
													width:19px;
													height:14px;
													margin-left:-19px;}
												.slider_right{ 
													float:right;
													background: url(<?php echo get_bloginfo('stylesheet_directory') ?>/images/slider_right.jpg) no-repeat;
													width:19px;
													height:14px;
													margin-right:-19px;}
												.notch_label {
													width:70px;
													margin-left:-35px;
													float:left;
													text-align:center;
													font-family:proxbold;
													font-size:13px;	}
												 .ui-slider{ 
													 border-radius:0; 
													 background: url(<?php echo get_bloginfo('stylesheet_directory') ?>/images/slider.jpg) repeat-x ; 
													 height:14px; border:none; 
													 cursor:pointer !important;}
												 .ui-slider-handle{
													 background: url(<?php echo get_bloginfo('stylesheet_directory') ?>/images/slider_arrow.png) !important;
													 height:27px !important;
													 width:20px !important;
													 border:none !important;
													 cursor:pointer !important;
													 margin-top:5px !important; 
													 border-radius:0 !important;}
												</style>

												<select class="selectmenu" tabindex="10" name="section_1[feedback_1]">
													<option value="Date of Birth">How did you hear about enclothed?</option>
													<option value="The Internet">The Internet</option>
													<option value="Word of Mouth">Word of Mouth</option>
													<option value="A Friend ">A Friend </option>
													<option value="Magazine Advert">Magazine Advert</option>
													<option value="Email Marketing">Email Marketing</option>
													<option value="Magazine Article">Magazine Article</option>
													<option value="Promotional Material">Promotional Material</option>
													<option value="Other">Other</option>
												</select>

											</div><!--mini-wrapper-forms-->

											<div class="mini-wrapper5">
												<input type="hidden" value="<?php echo $nonce; ?>" name='nonce'>
												<button class="button4" onclick="submit()">Save and Continue</button>
											</div><!--mini-wrapper4-->

										</div>
									</form>
									<!--styles-block-->
								</div>            
							</div>
						</div>

						<!-- CLOSE page -->
					</div>

				<?php endif; ?>


			</div>

			<?php if ($sidebar_config != "no-sidebars" || $pb_active != "true") { ?>
		</div>
		<?php } ?>

		<!--// WordPress Hook //-->
		<?php get_footer(); ?>



