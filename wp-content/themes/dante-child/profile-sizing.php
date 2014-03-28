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
<script>
	jQuery(document).ready(function($){
		// This is what enables the images to be added to the form 
		// when they are clicked and removed when clicked again
		$('.click').toggle(function(){
			var image = $(this).attr('id');
			$('<input>').attr({
				type: 'hidden',
				name: 'section_3['+image+']',
				value: 'checked',
			}).appendTo('form[name="section_3"]');
		}, function(){
			var image = $(this).attr('id'); 
			$('form input[name="section_3['+image+']"').remove();
		});

		jQuery( ".click" ).click(function() {
			if(jQuery(this).hasClass( "selected" )){
				
			} else {
				jQuery('#array').val(jQuery('#array').val() + "," + jQuery(this).attr('id'))		
			}
			jQuery(this).toggleClass( "selected" );
		});

	});
</script>

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
		$(function() {
			$( "#neck_size_slider" ).slider({
				value:18.5,
				min: 14,
				max: 20,
				step: .5,
				slide: function( event, ui ) {
					$( "#neck_size_selection" ).val(ui.value );
				}
			});
			$( "#neck_size_selection" ).val($( "#neck_size_slider" ).slider( "value" ) );
		});

		$(function() {
			$( "#shoes_slider" ).slider({
				value:9.5,
				min: 7,
				max: 13.5,
				step: .5,
				slide: function( event, ui ) {
					$( "#shoes_selection" ).val(ui.value );
				}
			});
			$( "#shoes_selection" ).val($( "#shoes_slider" ).slider( "value" ) );
		});

		$(function() {
			$( "#jacket_slider" ).slider({
				value:48,
				min: 32,
				max: 56,
				step: 2,
				slide: function( event, ui ) {
					$( "#jacket_selection" ).val(ui.value );
				}
			});
			$( "#jacket_selection" ).val($( "#jacket_slider" ).slider( "value" ) );
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




												<div class="slider_wrapper">
													<div class="col-sm-2 slider_label">T-shirt</div>
													<div class="col-sm-8 slider">
														<div id="tshirt_slider" style="margin-top:20px;">
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
												</div>


												<div class="slider_wrapper">
													<div class="col-sm-2 slider_label">Neck Size</div>
													<div class="col-sm-8 slider">
														<div id="neck_size_slider" style="margin-top:20px;">
															<div class="notch_big" style="left:0%;"><div class="notch_label">14</div></div>
															<div class="notch_small" style="left:8.35%;"><div class="notch_label">14.5</div></div>
															<div class="notch_big" style="left:16.7%;"><div class="notch_label">15</div></div>
															<div class="notch_small" style="left:25.05%;"><div class="notch_label">15.5</div></div>
															<div class="notch_big" style="left:33.4%;"><div class="notch_label">16</div></div>
															<div class="notch_small" style="left:41.75%;"><div class="notch_label">16.5</div></div>
															<div class="notch_big" style="left:50.1%;"><div class="notch_label">17</div></div>
															<div class="notch_small" style="left:58.45%;"><div class="notch_label">17.5</div></div>
															<div class="notch_big" style="left:66.8%;"><div class="notch_label">18</div></div>
															<div class="notch_small" style="left:75.15%;"><div class="notch_label">18.5</div></div>
															<div class="notch_big" style="left:83.5%;"><div class="notch_label">19</div></div>
															<div class="notch_small" style="left:91.85%;"><div class="notch_label">19.5</div></div>
															<div class="notch_big" style="left:100%;"><div class="notch_label">20</div></div>
															<div class="slider_left"></div>
															<div class="slider_right"></div>
														</div>
													</div>
													<div class="col-sm-2">
														<input type="text" id="neck_size_selection" class="slider_selection" disabled="disabled">
													</div>
												</div>



												<div class="slider_wrapper">
													<div class="col-sm-2 slider_label">Sleeve Length</div>
													<div class="col-sm-10">
														<div class="options_wrapper">
															<div class="shadow"><img src="<?php bloginfo('template_url') ?>-child/images/shadow.png" alt="" /></div>
															<div class="col-sm-4 option click">Short</div>
															<div class="col-sm-4 option click selected">Regular</div>
															<div class="col-sm-4 option click" style="border-bottom: none !important; border-right: none !important;">Long</div>
														</div>
													</div>
												</div>
					



												<div class="slider_wrapper">
													<div class="col-sm-2 slider_label">Shoes</div>
													<div class="col-sm-8 slider">
														<div id="shoes_slider" style="margin-top:20px;">
															<div class="notch_big" style="left:0%;"><div class="notch_label">7</div></div>
															<div class="notch_small" style="left:7.7%;"><div class="notch_label">7.5</div></div>
															<div class="notch_big" style="left:15.4%;"><div class="notch_label">8</div></div>
															<div class="notch_small" style="left:23.1%;"><div class="notch_label">8.5</div></div>
															<div class="notch_big" style="left:30.8%;"><div class="notch_label">9</div></div>
															<div class="notch_small" style="left:38.5%;"><div class="notch_label">9.5</div></div>
															<div class="notch_big" style="left:46.2%;"><div class="notch_label">10</div></div>
															<div class="notch_small" style="left:53.9%;"><div class="notch_label">10.5</div></div>
															<div class="notch_big" style="left:61.6%;"><div class="notch_label">11</div></div>
															<div class="notch_small" style="left:69.3%;"><div class="notch_label">11.5</div></div>
															<div class="notch_big" style="left:77%;"><div class="notch_label">12</div></div>
															<div class="notch_small" style="left:84.7%;"><div class="notch_label">12.5</div></div>
															<div class="notch_big" style="left:92.4%;"><div class="notch_label">13</div></div>
															<div class="notch_small" style="left:100%;"><div class="notch_label">13.5</div></div>
															<div class="slider_left"></div>
															<div class="slider_right"></div>
														</div>
													</div>
													<div class="col-sm-2">
														<input type="text" id="shoes_selection" class="slider_selection" disabled="disabled">
													</div>
												</div>



												<div class="slider_wrapper">
													<div class="col-sm-2 slider_label">Jacket</div>
													<div class="col-sm-8 slider">
														<div id="jacket_slider" style="margin-top:20px;">
															<div class="notch_big" style="left:0%;"><div class="notch_label">32</div></div>
															<div class="notch_small" style="left:8.35%;"><div class="notch_label">34</div></div>
															<div class="notch_big" style="left:16.7%;"><div class="notch_label">36</div></div>
															<div class="notch_small" style="left:25.05%;"><div class="notch_label">38</div></div>
															<div class="notch_big" style="left:33.4%;"><div class="notch_label">40</div></div>
															<div class="notch_small" style="left:41.75%;"><div class="notch_label">42</div></div>
															<div class="notch_big" style="left:50.1%;"><div class="notch_label">44</div></div>
															<div class="notch_small" style="left:58.45%;"><div class="notch_label">46</div></div>
															<div class="notch_big" style="left:66.8%;"><div class="notch_label">48</div></div>
															<div class="notch_small" style="left:75.15%;"><div class="notch_label">50</div></div>
															<div class="notch_big" style="left:83.5%;"><div class="notch_label">52</div></div>
															<div class="notch_small" style="left:91.85%;"><div class="notch_label">54</div></div>
															<div class="notch_big" style="left:100%;"><div class="notch_label">56</div></div>
															<div class="slider_left"></div>
															<div class="slider_right"></div>
														</div>
													</div>
													<div class="col-sm-2">
														<input type="text" id="jacket_selection" class="slider_selection" disabled="disabled">
													</div>
												</div>



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



