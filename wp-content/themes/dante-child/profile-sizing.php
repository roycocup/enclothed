<?php
/**
*
* template name: Profile Sizing
*
**/
?>
<?php get_header(); ?>




<?php 
if (isset($_SESSION['section_4'])){
	$section = $_SESSION['section_4'];	
}else if(isset($_POST['section_4'])){
	$section = $_POST['section_4'];
} else {
	$section = array();
}

?>



<?php 
// dump($_SESSION['section_4']);
function echo_if_present($word){
	if (!empty($_SESSION['section_4'])){
		$prev_sec_4 = explode(',', $_SESSION['section_4']['sleeve_lenght']);

		if (in_array($word, $prev_sec_4)){
			echo 'selected';
		}

		$prev_extra_info_size 			= @$_SESSION['section_4']['extra_info_size'];
		$prev_more_brands_size 			= @$_SESSION['section_4']['more_brands_size'];
		$prev_tshirt_size 				= @$_SESSION['section_4']['tshirt_size'];
		$prev_neck_size 				= @$_SESSION['section_4']['neck_size'];
		$prev_shoe_size 				= @$_SESSION['section_4']['shoe_size'];
		$prev_trouser_size 				= @$_SESSION['section_4']['trouser_size'];
		$prev_trouser_inside_leg_size  	= @$_SESSION['section_4']['trouser_inside_leg_size'];
	}
}
?>


<script>
	jQuery(document).ready(function($){
		// This is what enables the images to be added to the form 
		// when they are clicked and removed when clicked again
		$('.click').toggle(function(){
			var image = $(this).attr('name');
			$('<input>').attr({
				type: 'hidden',
				name: 'section_4['+image+']',
				value: 'checked',
			}).appendTo('form[name="section_4"]');
		}, function(){
			var image = $(this).attr('id'); 
			$('form input[name="section_4['+image+']"').remove();
		});

		

		//This I dont know what its for... I didnt wrote it... 
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

		// setting variables in the prototype to have the previously selected bits
		$(function(){
			var previous_selections = <?php echo (empty($_SESSION['section_4']))? 'false':'true'; ?>;
			Object.previous_selections = previous_selections;
			Object.tshirt_size = '<?php echo @$_SESSION['section_4']['tshirt_size']; ?>';
			Object.neck_size = '<?php echo @$_SESSION['section_4']['neck_size']; ?>';
			Object.shoe_size = '<?php echo @$_SESSION['section_4']['shoe_size']; ?>';
			Object.trouser_size = '<?php echo @$_SESSION['section_4']['trouser_size']; ?>';
			Object.trouser_inside_leg_size = '<?php echo @$_SESSION['section_4']['trouser_inside_leg_size']; ?>';
		});

		$(function() {
			$( "#tshirt_slider" ).slider({
				value:40,
				min: 0,
				max: 100,
				step: 20,
				slide: function( event, ui ) {
					$( "#tshirt_selection" ).val(tshirt_slider_increments[ui.value]);
				}
			});
			var tshirt_slider_increments = {
				0: "XS", 
				20: "S",
				40: "M",
				60: "L",
				80: "XL",
				100: "XXL"
			};

			// displaying the previously saved values
			if (Object.previous_selections){
				var amount = 0;
				for(key in tshirt_slider_increments){
					if (tshirt_slider_increments[key] == Object.tshirt_size){
						amount = key;
					}
				}
				$( "#tshirt_selection" ).val(tshirt_slider_increments[amount]);	
				$( "#tshirt_slider" ).slider({value:amount});
			}else{
				console.log(10);
				$( "#tshirt_selection" ).val(tshirt_slider_increments[40]);	
			}

			
		});
		$(function() {
			$( "#neck_size_slider" ).slider({
				value:18.5,
				min: 14,
				max: 19,
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

		$(function() {
			$( "#trouser_slider" ).slider({
				value:30,
				min: 28,
				max: 40,
				step: 1,
				slide: function( event, ui ) {
					$( "#trouser_selection" ).val(ui.value );
				}
			});
			$( "#trouser_selection" ).val($( "#trouser_slider" ).slider( "value" ) );
		});

		$(function() {
			$( "#inside_leg_slider" ).slider({
				value:40,
				min: 28,
				max: 42,
				step: 2,
				slide: function( event, ui ) {
					$( "#inside_leg_selection" ).val(inside_leg_increments[ui.value]);
				}
			});
			var inside_leg_increments = {
				28: "28", 
				30: "30",
				32: "32",
				34: "34",
				36: "36",
				38: "SHORT",
				40: "REG",
				42: "LONG"
			};

			// displaying the previously saved values
			if (Object.previous_selections){
				var amount = 0;
				for(key in inside_leg_increments){
					if (inside_leg_increments[key] == Object.trouser_inside_leg_size){
						amount = key;
					}
				}
				$( "#inside_leg_selection" ).val(inside_leg_selection[amount]);	
				$( "#inside_leg_slider" ).slider({value:amount});
			} else {
				console.log(10);
				$( "#inside_leg_selection" ).val(inside_leg_increments[40]);
			}
			
		});


		


		$('.submit-button').click(function(e){
			
			var tshirt_size 	= $( "#tshirt_selection" ).val();
			var neck_size 		= $( "#neck_size_selection" ).val();
			var shoes_size 		= $( "#shoes_selection" ).val();
			var trouser_size 	= $( "#trouser_selection" ).val();
			var inside_leg 		= $( "#inside_leg_selection" ).val();
			

			$('<input>').attr({
				type: 'hidden',
				name: 'section_4[tshirt_size]',
				value: tshirt_size,
			}).appendTo('form[name="section_4"]');

			$('<input>').attr({
				type: 'hidden',
				name: 'section_4[neck_size]',
				value: neck_size,
			}).appendTo('form[name="section_4"]');

			$('<input>').attr({
				type: 'hidden',
				name: 'section_4[shoes_size]',
				value: shoes_size,
			}).appendTo('form[name="section_4"]');

			$('<input>').attr({
				type: 'hidden',
				name: 'section_4[trouser_size]',
				value: trouser_size,
			}).appendTo('form[name="section_4"]');

			$('<input>').attr({
				type: 'hidden',
				name: 'section_4[inside_leg]',
				value: inside_leg,
			}).appendTo('form[name="section_4"]');

			
			
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
							<li class="hidden-sm hidden-xs"><span>Your Details</span></li>
							<li class="hidden-sm hidden-xs"><span>Pick Your Style</span></li>
							<li class="hidden-sm hidden-xs"><span>Preferences</span></li>
							<li><span class='active'>Size and Color</span></li>
							<li class="hidden-sm hidden-xs"><span style="border-right:none;">Price and Summary</span></li>
								</ul>
								<div class="shadow"><img src="<?php bloginfo('template_url') ?>-child/images/shadow.png" alt="" /></div>
							</div><!--details-menu-->

							<div class="styles-block">
								<div class="fade-border-left"></div>
								<div class="fade-border-right"></div>

								
								<form action="" method="POST" name='section_4'>
									<?php $nonce = wp_create_nonce( get_uri() ); ?>
									<div class="flashmessages col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
				            			<?php flashMessagesDisplay(); ?>
				           			</div>	
									<div class="title-forms">
										<div class="mini-wrapper-forms">
											<div class="numbering">01</div>
											<p>Your size and measurements. What fits you well.</p>
											<p class="georgia_text">(All UK sizes - <a href="#" style="color:#b08536;">click for conversion chart</a>)</p>

												<div class="slider_wrapper">
													<div class="col-sm-2 slider_label">T-shirt</div>
													<div class="col-sm-8 slider">
														<div id="tshirt_slider" style="margin-top:20px;">
															<div class="notch_big" style="left:0%;"><div class="notch_label">XS</div></div>
															<div class="notch_big" style="left:20%;"><div class="notch_label">S</div></div>
															<div class="notch_big" style="left:40%;"><div class="notch_label">M</div></div>
															<div class="notch_big" style="left:60%;"><div class="notch_label">L</div></div>
															<div class="notch_big" style="left:80%;"><div class="notch_label">XL</div></div>
															<div class="notch_big" style="left:100%;"><div class="notch_label">XXL</div></div>
															<div class="slider_left"></div>
															<div class="slider_right"></div>
														</div>
													</div>
													<div class="col-sm-2">
														<input type="text" id="tshirt_selection" class="slider_selection" disabled="disabled" name="tshirt_selection">
													</div>
												</div>


												<div class="slider_wrapper">
													<div class="col-sm-2 slider_label">Neck Size</div>
													<div class="col-sm-8 slider">
														<div id="neck_size_slider" style="margin-top:20px;">
															<div class="notch_big" style="left:0%;"><div class="notch_label">14</div></div>
															<div class="notch_small" style="left:10%;"><div class="notch_label">14.5</div></div>
															<div class="notch_big" style="left:20%;"><div class="notch_label">15</div></div>
															<div class="notch_small" style="left:30%;"><div class="notch_label">15.5</div></div>
															<div class="notch_big" style="left:40%;"><div class="notch_label">16</div></div>
															<div class="notch_small" style="left:50%;"><div class="notch_label">16.5</div></div>
															<div class="notch_big" style="left:60%;"><div class="notch_label">17</div></div>
															<div class="notch_small" style="left:70%;"><div class="notch_label">17.5</div></div>
															<div class="notch_big" style="left:80%;"><div class="notch_label">18</div></div>
															<div class="notch_small" style="left:90%;"><div class="notch_label">18.5</div></div>
															<div class="notch_big" style="left:100%;"><div class="notch_label">19</div></div>
															<div class="slider_left"></div>
															<div class="slider_right"></div>
														</div>
													</div>
													<div class="col-sm-2">
														<input type="text" id="neck_size_selection" class="slider_selection" disabled="disabled" name="neck_size_selection">
													</div>
												</div>



												<div class="box_options_wrapper">
													<div class="col-sm-2 box_options_label">Sleeve Length</div>
													<div class="col-sm-10">
														<div class="box_options">
															<div class="shadow"><img src="<?php bloginfo('template_url') ?>-child/images/shadow.png" alt="" /></div>
															<div class="col-sm-4 box_option click <?php echo_if_present('short'); ?>" name="sleeve_lenght_short">Short</div>
															<div class="col-sm-4 box_option click <?php echo_if_present('regular'); ?>" name="sleeve_lenght_regular">Regular</div>
															<div class="col-sm-4 box_option click <?php echo_if_present('long'); ?>" name="sleeve_lenght_long" style="border-bottom: none !important; border-right: none !important;">Long</div>
														</div>
													</div>
													<div style="clear:both;"></div>
												</div>
					



												<div class="slider_wrapper">
													<div class="col-sm-2 slider_label">Shoes (UK)</div>
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
														<input type="text" id="shoes_selection" class="slider_selection" disabled="disabled" name="shoes_selection">
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
														<input type="text" id="jacket_selection" class="slider_selection" disabled="disabled" name="jacket_selection">
													</div>
												</div>



												<div class="slider_wrapper">
													<div class="col-sm-2 slider_label">Trouser</div>
													<div class="col-sm-8 slider">
														<div id="trouser_slider" style="margin-top:20px;">
															<div class="notch_big" style="left:0%;"><div class="notch_label">28</div></div>
															<div class="notch_small" style="left:8.33%;"><div class="notch_label">29</div></div>
															<div class="notch_big" style="left:16.66%;"><div class="notch_label">30</div></div>
															<div class="notch_small" style="left:24.99%;"><div class="notch_label">31</div></div>
															<div class="notch_big" style="left:33.32%;"><div class="notch_label">32</div></div>
															<div class="notch_small" style="left:41.65%;"><div class="notch_label">33</div></div>
															<div class="notch_big" style="left:49.98%;"><div class="notch_label">34</div></div>
															<div class="notch_small" style="left:58.31%;"><div class="notch_label">35</div></div>
															<div class="notch_big" style="left:66.64%;"><div class="notch_label">36</div></div>
															<div class="notch_small" style="left:74.97%;"><div class="notch_label">37</div></div>
															<div class="notch_big" style="left:83.3%;"><div class="notch_label">38</div></div>
															<div class="notch_small" style="left:91.63%;"><div class="notch_label">39</div></div>
															<div class="notch_big" style="left:100%;"><div class="notch_label">40</div></div>
															<div class="slider_left"></div>
															<div class="slider_right"></div>
														</div>
													</div>
													<div class="col-sm-2">
														<input type="text" id="trouser_selection" class="slider_selection" disabled="disabled" name="trouser_selection">
													</div>
												</div>



												<div class="slider_wrapper">
													<div class="col-sm-2 slider_label">Inside leg</div>
													<div class="col-sm-8 slider">
														<div id="inside_leg_slider" style="margin-top:20px;">
															<div class="notch_big" style="left:0%;"><div class="notch_label">28</div></div>
															<div class="notch_small" style="left:14.3%;"><div class="notch_label">30</div></div>
															<div class="notch_big" style="left:28.6%;"><div class="notch_label">32</div></div>
															<div class="notch_small" style="left:42.9%;"><div class="notch_label">34</div></div>
															<div class="notch_big" style="left:57.2%;"><div class="notch_label">36</div></div>
															<div class="notch_small" style="left:71.5%;"><div class="notch_label">SHORT</div></div>
															<div class="notch_big" style="left:85.8%;"><div class="notch_label">REG</div></div>
															<div class="notch_small" style="left:100%;"><div class="notch_label">LONG</div></div>
															<div class="slider_left"></div>
															<div class="slider_right"></div>
														</div>
													</div>
													<div class="col-sm-2">
														<input type="text" id="inside_leg_selection" class="slider_selection" disabled="disabled" name="inside_leg_selection">
													</div>
												</div>



											</div><!--mini-wrapper-forms-->

											
										</div>


									<div class="title-forms" style="border-top: 1px solid #e3e3e3; position: relative;">
										<div class="line_thick" style="position: absolute; height:8px; top:0; width:120px; left:50%; margin-left:-60px;"><img src="<?php bloginfo('template_url') ?>-child/images/line_thick.png" alt="" style="float:left;" /></div>
										<div class="mini-wrapper-forms">
											<div class="numbering">02</div>
											<p>The more you can tell us the better the fit will be.</p>

									<label for="checkbox1"class="css-label">Is there anything extra you'd like to add about your size?</label>
									<textarea type="text" class="customer-info3" tabindex="2" placeholder="" name="section_4[extra]" value=""></textarea>
									<label for="checkbox1"class="css-label">Is there any particular brands that fit you well?</label>
									<textarea type="text" class="customer-info3" tabindex="2" placeholder="" name="section_4[more_brands]" value=""></textarea>
											<p class="georgia_text no-margin-bottom">(This won't affect what brands we send you, it's just about fit)</p>
					
											</div><!--mini-wrapper-forms-->

											<div class="mini-wrapper5">
												<input type="hidden" value="<?php echo $nonce; ?>" name='nonce'>
								                <a href="/profile/preferences/" class="button4">Go Back</a>
								                <div class="button_spacer col-sm-1 hidden-xs"></div>
								                <button class="button4 submit-button">Save and Continue</button>
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
