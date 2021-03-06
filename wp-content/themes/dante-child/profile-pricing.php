<?php
/**
*
* template name: Profile Pricing
*
**/
?>
<?php get_header(); ?>
<?php 

if (isset($_SESSION['section_5'])){
	$section = $_SESSION['section_5'];	
}else if(isset($_POST['section_5'])){
	$section = $_POST['section_5'];
} else {
	$section = array();
}


?>

<script>
	jQuery(document).ready(function($){
		
		// setting variables in the prototype to have the previously selected bits
		$(function(){
			var previous_selections = <?php echo (empty($_SESSION['section_5']))? 'false':'true'; ?>;
			Object.previous_selections = previous_selections;
			Object.shirt_min_price = '<?php echo @$_SESSION['section_5']['shirt_min_price']; ?>';
			Object.shirt_max_price = '<?php echo @$_SESSION['section_5']['shirt_max_price']; ?>';
			Object.trouser_min_price = '<?php echo @$_SESSION['section_5']['trouser_min_price']; ?>';
			Object.trouser_max_price = '<?php echo @$_SESSION['section_5']['trouser_max_price']; ?>';
			Object.coat_min_price = '<?php echo @$_SESSION['section_5']['coat_min_price']; ?>';
			Object.coat_max_price = '<?php echo @$_SESSION['section_5']['coat_max_price']; ?>';
			Object.shoes_min_price = '<?php echo @$_SESSION['section_5']['shoes_min_price']; ?>';
			Object.shoes_max_price = '<?php echo @$_SESSION['section_5']['shoes_max_price']; ?>';
		});

		/*===============================
		=            sliders            =
		===============================*/
		$(function() {
			var amount = [2, 3];

			$( "#shirt_price" ).slider({
				range:true,
				values:amount,
				min: 1,
				max: 4,
				step: 1,
				slide: function( event, ui ) {
					$( "#shirt_price_selection" ).val(increments[ui.values[0]] +'-'+ increments[ui.values[1]]);
				}
			});

			var increments = {
				1: "£50", 
				2: "£100",
				3: "£150",
				4: "£150+",
			};

			if (Object.previous_selections){
				for(key in increments){
					if (increments[key] == Object.shirt_min_price){
						amount[0] = parseInt(key);
					}
					if (increments[key] == Object.shirt_max_price){
						amount[1] = parseInt(key);
					}
				}
				$( "#shirt_price_selection" ).val(increments[amount[0]] +'-'+ increments[amount[1]]);	
				$( "#shirt_price" ).slider({values:amount});
			}else{
				$( "#shirt_price_selection" ).val(increments[amount[0]] +'-'+ increments[amount[1]]);	
			}
		});

		$(function() {
			var amount = [2, 3];

			$( "#trousers_price" ).slider({
				range:true,
				values:amount,
				min: 1,
				max: 4,
				step: 1,
				slide: function( event, ui ) {
					$( "#trousers_price_selection" ).val( increments[ui.values[0]] +'-'+ increments[ui.values[1]] );
				}
			});
			var increments = {
				1: "£50", 
				2: "£100",
				3: "£150",
				4: "£200+",
			};

			if (Object.previous_selections){
				for(key in increments){
					if (increments[key] == Object.trouser_min_price){
						amount[0] = parseInt(key);
					}
					if (increments[key] == Object.trouser_max_price){
						amount[1] = parseInt(key);
					}
				
				}
				$( "#trousers_price_selection" ).val(increments[amount[0]] +'-'+ increments[amount[1]]);	
				$( "#trousers_price" ).slider({values:amount});
			}else{
				$( "#trousers_price_selection" ).val(increments[amount[0]] +'-'+ increments[amount[1]]);
			}
		});

		$(function() {
			var amount = [2, 4];

			$( "#coat_price" ).slider({
				range: true,
				values:amount,
				min: 1,
				max: 4,
				step: 1,
				slide: function( event, ui ) {
					$( "#coat_price_selection" ).val(increments[ui.values[0]] +'-'+ increments[ui.values[1]]);
				}
			});
			var increments = {
				1: "£150", 
				2: "£200",
				3: "£250",
				4: "£300+",
			};

			if (Object.previous_selections){
				for(key in increments){
					if (increments[key] == Object.coat_min_price){
						amount[0] = parseInt(key);
					}
					if (increments[key] == Object.coat_max_price){
						amount[1] = parseInt(key);
					}
				
				}
				$( "#coat_price_selection" ).val(increments[amount[0]] +'-'+ increments[amount[1]]);	
				$( "#coat_price" ).slider({values:amount});
			}else{
				$( "#coat_price_selection" ).val(increments[amount[0]] +'-'+ increments[amount[1]]);
			}

		});


		$(function() {
			var amount = [2, 4];

			$( "#shoe_price" ).slider({
				range: true,
				values:amount,
				min: 1,
				max: 5,
				step: 1,
				slide: function( event, ui ) {
					$( "#shoe_price_selection" ).val(increments[ui.values[0]] +'-'+ increments[ui.values[1]]);
				}
			});
			var increments = {
				1: "£50", 
				2: "£100",
				3: "£150",
				4: "£200",
				5: "£200+",
			};

			if (Object.previous_selections){
				for(key in increments){
					if (increments[key] == Object.shoes_min_price){
						amount[0] = parseInt(key);
					}
					if (increments[key] == Object.shoes_max_price){
						amount[1] = parseInt(key);
					}
				
				}
				$( "#shoe_price_selection" ).val(increments[amount[0]] +'-'+ increments[amount[1]]);	
				$( "#shoe_price" ).slider({values:amount});
			}else{
				$( "#shoe_price_selection" ).val(increments[amount[0]] +'-'+ increments[amount[1]]);	
			}

		});
		
		
		/*-----  End of sliders  ------*/
		
		
		// 
		$('.submit-button').click(function(e){
			
			var shirt_price = $( "#shirt_price_selection" ).val();
			var trousers_price = $( "#trousers_price_selection" ).val();
			var coat_price = $( "#coat_price_selection" ).val();
			var shoe_price = $( "#shoe_price_selection" ).val();

			$('<input>').attr({
				type: 'hidden',
				name: 'section_5[shirt_price]',
				value: shirt_price,
			}).appendTo('form[name="section_5"]');

			$('<input>').attr({
				type: 'hidden',
				name: 'section_5[trousers_price]',
				value: trousers_price,
			}).appendTo('form[name="section_5"]');

			$('<input>').attr({
				type: 'hidden',
				name: 'section_5[coat_price]',
				value: coat_price,
			}).appendTo('form[name="section_5"]');

			$('<input>').attr({
				type: 'hidden',
				name: 'section_5[shoe_price]',
				value: shoe_price,
			}).appendTo('form[name="section_5"]');


			$('form').submit();
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
							<li><span>Your Details</span></li>
							<li><span>Pick Your Style</span></li>
							<li><span>Preferences</span></li>
							<li><span>Size and Colour</span></li>
							<li><span style="border-right:none;" class="active">Price and Summary</span></li>
								</ul>
								<div class="shadow"><img src="<?php bloginfo('template_url') ?>-child/images/shadow.png" alt="" /></div>
							</div><!--details-menu-->

							<div class="styles-block">
								<div class="fade-border-left"></div>
								<div class="fade-border-right"></div>


								<!-- form -->
								<form action="" method="POST" name='section_5'>
									<?php $nonce = wp_create_nonce( get_uri() ); ?>
									<div class="flashmessages col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
				            			<?php flashMessagesDisplay(); ?>
				           			</div>	
           							<div class="title-forms">					
										<div class="mini-wrapper-forms">
											<div class="numbering">01</div>
											<p>HOW MUCH WOULD YOU TYPICALLY SPEND ON EACH ITEM?</p>
										</div><!--mini-wrapper-forms-->

											 <select style="display:none;" class="selectmenu" tabindex="10" name="section_5[box_preset]" style="margin-top:0;" >
												<option value="0">Choose your box</option>
												<option value="small">Small</option>
												<option value="medium">Medium</option>
												<option value="big">Big</option>
											</select> 

										<div class="slider_wrapper">
											<div class="col-sm-2 slider_label">Shirt Price</div>
											<div class="col-sm-7 slider">
												<div id="shirt_price" style="margin-top:20px;">
													<div class="notch_big" style="left:0%;"><div class="notch_label">£50</div></div>
													<div class="notch_big" style="left:33.3333333333%;"><div class="notch_label">£100</div></div>
													<div class="notch_big" style="left:66.6666666666%;"><div class="notch_label">£150</div></div>
													<div class="notch_big" style="left:100%;"><div class="notch_label">£150+</div></div>
													<div class="slider_left"></div>
													<div class="slider_right"></div>
												</div>
											</div>
											<div class="col-sm-3">
												<input type="text" id="shirt_price_selection" class="slider_selection" disabled="disabled">
											</div>
											<div class="hidden-md hidden-lg">Please click to make your selection</div>
										</div>
                                                
 
 										<div class="slider_wrapper">
											<div class="col-sm-2 slider_label">Trousers Price</div>
											<div class="col-sm-7 slider">
												<div id="trousers_price" style="margin-top:20px;">
													<div class="notch_big" style="left:0%;"><div class="notch_label">£50</div></div>
													<div class="notch_big" style="left:33.3333333333%;"><div class="notch_label">£100</div></div>
													<div class="notch_big" style="left:66.6666666666%;"><div class="notch_label">£150</div></div>
													<div class="notch_big" style="left:100%;"><div class="notch_label">£200+</div></div>
													<div class="slider_left"></div>
													<div class="slider_right"></div>
												</div>
											</div>
											<div class="col-sm-3">
												<input type="text" id="trousers_price_selection" class="slider_selection" disabled="disabled">
											</div>
											<div class="hidden-md hidden-lg">Please click to make your selection</div>
										</div>
                                                
 
 										<div class="slider_wrapper">
											<div class="col-sm-2 slider_label">Coat Price</div>
											<div class="col-sm-7 slider">
												<div id="coat_price" style="margin-top:20px;">
													<div class="notch_big" style="left:0%;"><div class="notch_label">£150</div></div>
													<div class="notch_big" style="left:33.3333333333%;"><div class="notch_label">£200</div></div>
													<div class="notch_big" style="left:66.6666666666%;"><div class="notch_label">£250</div></div>
													<div class="notch_big" style="left:100%;"><div class="notch_label">£300+</div></div>
													<div class="slider_left"></div>
													<div class="slider_right"></div>
												</div>
											</div>
											<div class="col-sm-3">
												<input type="text" id="coat_price_selection" class="slider_selection" disabled="disabled">
											</div>
											<div class="hidden-md hidden-lg">Please click to make your selection</div>
										</div>


										<div class="slider_wrapper" style="border-bottom:1px solid #e3e3e3; margin-bottom:40px;">
											<div class="col-sm-2 slider_label">Shoe Price</div>
											<div class="col-sm-7 slider">
												<div id="shoe_price" style="margin-top:20px;">
													<div class="notch_big" style="left:0%;"><div class="notch_label">£50</div></div>
													<div class="notch_big" style="left:25%;"><div class="notch_label">£100</div></div>
													<div class="notch_big" style="left:50%;"><div class="notch_label">£150</div></div>
													<div class="notch_big" style="left:75%;"><div class="notch_label">£200</div></div>
													<div class="notch_big" style="left:100%;"><div class="notch_label">£200+</div></div>
													<div class="slider_left"></div>
													<div class="slider_right"></div>
												</div>
											</div>
											<div class="col-sm-3">
												<input type="text" id="shoe_price_selection" class="slider_selection" disabled="disabled">
											</div>
											<div class="hidden-md hidden-lg">Please click to make your selection</div>
										</div>

									<label class="css-label">Is there anything extra you'd like to add?</label>
									<textarea type="text" class="customer-info3" tabindex="2" placeholder="e.g. I'm going on holiday to Caribbean next week." name="section_5[extra]" value=""><?php echo @echo_if_exists($section['extra_price']); ?></textarea>
									
                                    <!-- <div class="col-md-9 col-sm-10 col-xs-11 promo_code_wrapper">
									<label class="css-label" style="padding-top:30px; color:#fff;">Gift Card Code</label>
                                    <input type='text' class="promo_code" id='' tabindex="9" name='section_5[giftcode]' placeholder='' value="">
									</div> -->

										<div class="mini-wrapper5">
											<input type="hidden" value="<?php echo $nonce; ?>" name='nonce'>
							                <a href="/profile/sizing/" class="button4">Go Back</a>
							                <div class="button_spacer col-sm-1 hidden-xs"></div>
							                <button class="button4 submit-button">Save and Continue</button>
                						</div>
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


