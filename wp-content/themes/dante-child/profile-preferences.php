<?php
/**
*
* template name: Profile Preferences
*
**/
?>
<?php
wp_enqueue_script('jquery-ui-autocomplete');
get_header();
?>
<!-- <link href="<?php echo bloginfo('stylesheet_directory').'/css/select2.css'; ?>" rel="stylesheet" /> -->
<!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/select2/3.2/select2.min.js"></script> -->
<?php
if (isset($_SESSION['section_2'])){
	$section = $_SESSION['section_2'];	
}else if(isset($_POST['section_2'])){
	$section = $_POST['section_2'];
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
				name: 'section_2['+image+']',
				value: 'checked',
			}).appendTo('form[name="section_2"]');
		}, function(){
			var image = $(this).attr('id'); 
			$('form input[name="section_2['+image+']"').remove();
		});

		jQuery( ".click" ).click(function() {
			if(jQuery(this).hasClass( "selected" )){
				// do nothing		
			} else {
				jQuery('#array').val(jQuery('#array').val() + "," + jQuery(this).attr('id'))		
			}
			jQuery(this).toggleClass( "selected" );
		});

		// Autocomplete for brands box
		// var availableTags = ["ActionScript","AppleScript","Asp","BASIC","C","C++","Clojure","COBOL","ColdFusion","Erlang","Fortran","Groovy","Haskell","Java","JavaScript","Lisp","Perl","PHP","Python","Ruby","Scala","Scheme"];
		var availableTags = ["Abercrombie & Fitch", "All Saints", "A.P.C", "Armani", "Balenciaga", "Banana Republic", "Barbour", "Brooks Brothers",
                "Calvin Klein", "Diesel", "Dockers", "Duck and Cover", "Emmett", "Fat Face", "Fred Perry", "Gant", "Gap", "G Star",
                "Gucci", "Hackett", "Hartford", "Hentsch Man", "Henri Lloyd", "Hugo Boss", "H&M", "Jack Wills", "Lacoste", "Lanvin",
                "Levis", "Lyle & Scott", "Musto", "Northface", "Paul Smith", "Penguin", "Prada", "Rag & Bone", "Ralph Lauren", "Reiss",
                "Sunspel", "Superdry", "Ted Baker", "TM Lewin", "Tods", "Tommy Hilfiger", "Thomas Pink", "Versace", "White Stuff", "Zegna"];
		
		// $("#brands-autocomplete-box").select2({
			// tags: availableTags,
		// });

		// Autocomplete for the brands box
		function split( val ) {
			return val.split( /,\s*/ );
		}
		function extractLast( term ) {
			return split( term ).pop();
		}
		$('#brands-autocomplete-box')// don't navigate away from the field on tab when selecting an item
			.bind( "keydown", function( event ) {
				if ( event.keyCode === $.ui.keyCode.TAB && $( this ).data( "ui-autocomplete" ).menu.active ) {
					event.preventDefault();
				}
			})
			.autocomplete({
				minLength: 0,
				source: function( request, response ) {
				// delegate back to autocomplete, but extract the last term
				response( $.ui.autocomplete.filter(
					availableTags, extractLast( request.term ) ) );
			},
			focus: function() {
				// prevent value inserted on focus
				return false;
			},
			select: function( event, ui ) {
				var terms = split( this.value );
				// remove the current input
				terms.pop();
				// add the selected item
				terms.push( ui.item.value );
				// add placeholder to get the comma-and-space at the end
				terms.push( "" );
				this.value = terms.join( ", " );
				return false;
			}
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
							<h2 style="text-align: center;"><span style="color: #ffffff;">BUILD YOUR<br> ENCLOTHED PROFILE</span></h2>
							<p style="margin-bottom: 0;"><img class="size-full aligncenter" alt="line" src="<?php echo get_bloginfo('stylesheet_directory') ?>/images/line.png"></p>
						</div> 
					</div>
				</div>
				<div class="row">
					<div class="details-menu">
						<ul>
							<li class="hidden-sm hidden-xs"><span>Your Details</span></li>
							<li class="hidden-sm hidden-xs"><span>Pick Your Style</span></li>
							<li><span class="active">Preferences</span></li>
							<li class="hidden-sm hidden-xs"><span>Size and Color</span></li>
							<li class="hidden-sm hidden-xs"><span style="border-right:none;">Price and Summary</span></li>
						</ul>
						<div class="shadow">
							<img src="<?php bloginfo('template_url') ?>-child/images/shadow.png" alt="" />
						</div>
					</div><!--details-menu-->
				<div class="styles-block">
					<div class="fade-border-left"></div>
					<div class="fade-border-right"></div>
					<!-- the form -->
					<?php $nonce = wp_create_nonce( get_uri() ); ?>
					<form action="" method="POST" name='section_2'>								
						<div class="flashmessages"><?php flashMessagesDisplay(); ?></div>				

							<div class="title-forms area2" style="border-bottom:1px solid #e3e3e3;">
								<div class="mini-wrapper-forms">
									<div class="numbering">01</div>
									<p>Favourite brands - not to recieve them but to tell us about your style</p>
								</div><!--mini-wrapper-forms-->
								<div class="row" style="border-top: 1px solid #e3e3e3;">
									<div class="col-sm-6 grid_left">
										<div class="col-sm-6 col-xs-6 grid_box left">
											<img src="<?php bloginfo('template_url') ?>-child/images/grid_logo_1.jpg" class="img-responsive" />
											<div id="area2_1" class="grid_box_overlay click"></div>
										</div>
										<div class="col-sm-6 col-xs-6 grid_box right">
											<img src="<?php bloginfo('template_url') ?>-child/images/grid_logo_2.jpg" class="img-responsive" />
											<div id="area2_2" class="grid_box_overlay click"></div>
										</div>
										<div class="col-sm-6 col-xs-6 grid_box right">
											<img src="<?php bloginfo('template_url') ?>-child/images/grid_logo_6.jpg" class="img-responsive" />
											<div id="area2_3" class="grid_box_overlay click"></div>
										</div>
										<div class="col-sm-6 col-xs-6 grid_box left">
											<img src="<?php bloginfo('template_url') ?>-child/images/grid_logo_5.jpg" class="img-responsive" />
											<div id="area2_4" class="grid_box_overlay click"></div>
										</div>
									</div>
									<div class="col-sm-6 grid_right">
										<div class="col-sm-6 col-xs-6 grid_box left">
											<img src="<?php bloginfo('template_url') ?>-child/images/grid_logo_3.jpg" class="img-responsive" />
											<div id="area2_5" class="grid_box_overlay click"></div>
										</div>
										<div class="col-sm-6 col-xs-6 grid_box right">
											<img src="<?php bloginfo('template_url') ?>-child/images/grid_logo_4.jpg" class="img-responsive" />
											<div id="area2_6" class="grid_box_overlay click"></div>
										</div>
										<div class="col-sm-6 col-xs-6 grid_box right">
											<img src="<?php bloginfo('template_url') ?>-child/images/grid_logo_8.jpg" class="img-responsive" />
											<div id="area2_7" class="grid_box_overlay click"></div>
										</div>
										<div class="col-sm-6 col-xs-6 grid_box left">
											<img src="<?php bloginfo('template_url') ?>-child/images/grid_logo_7.jpg" class="img-responsive" />
											<div id="area2_8" class="grid_box_overlay click"></div>
										</div>
									</div>
									<div class="col-sm-6 grid_left">
										<div class="col-sm-6 col-xs-6 grid_box left">
											<img src="<?php bloginfo('template_url') ?>-child/images/grid_logo_1.jpg" class="img-responsive" />
											<div id="area2_9" class="grid_box_overlay click"></div>
										</div>
										<div class="col-sm-6 col-xs-6 grid_box right">
											<img src="<?php bloginfo('template_url') ?>-child/images/grid_logo_2.jpg" class="img-responsive" />
											<div id="area2_10" class="grid_box_overlay click"></div>
										</div>
										<div class="col-sm-6 col-xs-6 grid_box right">
											<img src="<?php bloginfo('template_url') ?>-child/images/grid_logo_6.jpg" class="img-responsive" />
											<div id="area2_11" class="grid_box_overlay click"></div>
										</div>
										<div class="col-sm-6 col-xs-6 grid_box left">
											<img src="<?php bloginfo('template_url') ?>-child/images/grid_logo_5.jpg" class="img-responsive" />
											<div id="area2_12" class="grid_box_overlay click"></div>
										</div>
									</div>
									<div class="col-sm-6 grid_right">
										<div class="col-sm-6 col-xs-6 grid_box left">
											<img src="<?php bloginfo('template_url') ?>-child/images/grid_logo_3.jpg" class="img-responsive" />
											<div id="area2_13" class="grid_box_overlay click"></div>
										</div>
										<div class="col-sm-6 col-xs-6 grid_box right">
											<img src="<?php bloginfo('template_url') ?>-child/images/grid_logo_4.jpg" class="img-responsive" />
											<div id="area2_14" class="grid_box_overlay click"></div>
										</div>
										<div class="col-sm-6 col-xs-6 grid_box right">
											<img src="<?php bloginfo('template_url') ?>-child/images/grid_logo_8.jpg" class="img-responsive" />
											<div id="area2_15" class="grid_box_overlay click"></div>
										</div>
										<div class="col-sm-6 col-xs-6 grid_box left">
											<img src="<?php bloginfo('template_url') ?>-child/images/grid_logo_7.jpg" class="img-responsive" />
											<div id="area2_16" class="grid_box_overlay click"></div>
										</div>
									</div>

									<label  style="padding-top:40px;" class="css-label">Add more of your own brands</label>
									<textarea type="text" class="customer-info3" tabindex="2" placeholder="" name="" value="" id='brands-autocomplete-box'></textarea>                                    
								</div>
							</div>


							<div class="title-forms area3" style="border-bottom:1px solid #e3e3e3;">
								<div class="line_separator_thick"><img src="<?php bloginfo('template_url') ?>-child/images/line_thick.png" alt=""/></div>
								<div class="mini-wrapper-forms">
									<div class="numbering">02</div>
									<p>How do you wear your jackets?</p>
								</div><!--mini-wrapper-forms-->
								<div class="row">
									<div class="col-sm-11">
										<div class="col-sm-4 col-xs-6 option_image" >
	<img src="<?php bloginfo('template_url') ?>-child/images/jacket-slim.png" class="img-responsive" />
											<div id="area3_1" class="option_image_overlay click">
												<div class="option_image_label">Slim</div>
											</div>
										</div>
										<div class="col-sm-4 col-xs-6 option_image" >
	<img src="<?php bloginfo('template_url') ?>-child/images/jacket-regular.png" class="img-responsive" />
											<div id="area3_2" class="option_image_overlay click">
												<div class="option_image_label">Regular</div>
											</div>
										</div>
										<div class="col-sm-4 col-xs-6 option_image" >
	<img src="<?php bloginfo('template_url') ?>-child/images/jacket-short-sleeve.png" class="img-responsive" />
											<div id="area3_3" class="option_image_overlay click">
												<div class="option_image_label">Short Sleeve</div>
											</div>
										</div>
									</div>
									<div class="col-sm-11" >
										<div class="box_options_wrapper">
											<div class="box_options_label">Where do you wear your jackets?</div>											
											<div class="box_options">
												<div class="shadow"><img src="<?php bloginfo('template_url') ?>-child/images/shadow.png" alt="" /></div>
													<div class="col-sm-3 box_option click">Work</div>
													<div class="col-sm-3 box_option click selected">Casual</div>
													<div class="col-sm-3 box_option click">Friday</div>
													<div class="col-sm-3 box_option click" style="border-bottom: none !important; border-right: none !important;">Linen/Holiday</div>
												</div>
												<div style="clear:both;"></div>
											</div>
											<div style="clear:both;"></div>
										</div>
									</div>
								</div>




							<div class="title-forms area4" style="border-bottom:1px solid #e3e3e3;">
								<div class="line_separator_thick"><img src="<?php bloginfo('template_url') ?>-child/images/line_thick.png" alt=""/></div>
								<div class="mini-wrapper-forms">
									<div class="numbering">03</div>
									<p>How do you wear your shirts?</p>
								</div><!--mini-wrapper-forms-->
								<div class="row">
									<div class="col-sm-11">
										<div class="col-sm-4 col-xs-6 option_image" >
	<img src="<?php bloginfo('template_url') ?>-child/images/shirt-slim.png" class="img-responsive" />
											<div id="area4_1" class="option_image_overlay click">
												<div class="option_image_label">Slim</div>
											</div>
										</div>
										<div class="col-sm-4 col-xs-6 option_image" >
	<img src="<?php bloginfo('template_url') ?>-child/images/shirt-regular.png" class="img-responsive" />
											<div id="area4_2" class="option_image_overlay click">
												<div class="option_image_label">Regular</div>
											</div>
										</div>
										<div class="col-sm-4 col-xs-6 option_image" >
	<img src="<?php bloginfo('template_url') ?>-child/images/shirt-short-sleeve.png" class="img-responsive" />
											<div id="area4_3" class="option_image_overlay click">
												<div class="option_image_label">Short Sleeve</div>
											</div>
										</div>
									</div>
									<div class="col-sm-11" >
										<div class="box_options_wrapper">
											<div class="box_options_label">Where do you wear your shirts?</div>											
											<div class="box_options">
												<div class="shadow"><img src="<?php bloginfo('template_url') ?>-child/images/shadow.png" alt="" /></div>
													<div class="col-sm-3 box_option click">Work</div>
													<div class="col-sm-3 box_option click selected">Casual</div>
													<div class="col-sm-3 box_option click">Friday</div>
													<div class="col-sm-3 box_option click" style="border-bottom: none !important; border-right: none !important;">Linen/Holiday</div>
												</div>
												<div style="clear:both;"></div>
											</div>
											<div style="clear:both;"></div>
										</div>
									</div>
								</div>
						




							<div class="title-forms area5" style="border-bottom:1px solid #e3e3e3;">
								<div class="line_separator_thick"><img src="<?php bloginfo('template_url') ?>-child/images/line_thick.png" alt=""/></div>
								<div class="mini-wrapper-forms">
									<div class="numbering">04</div>
									<p>What trouser do you wear most?</p>
								</div><!--mini-wrapper-forms-->
								<div class="row">
									<div class="col-sm-11">
										<div class="col-sm-3 col-xs-6 option_image" >
	<img src="<?php bloginfo('template_url') ?>-child/images/trouser-jeans.png" class="img-responsive" />
											<div id="area5_1" class="option_image_overlay click">
												<div class="option_image_label">Jeans</div>
											</div>
										</div>
										<div class="col-sm-3 col-xs-6 option_image" >
	<img src="<?php bloginfo('template_url') ?>-child/images/trouser-chinos.png" class="img-responsive" />
											<div id="area5_2" class="option_image_overlay click">
												<div class="option_image_label">Chinos</div>
											</div>
										</div>
										<div class="col-sm-3 col-xs-6 option_image" >
	<img src="<?php bloginfo('template_url') ?>-child/images/trouser-formal.png" class="img-responsive" />
											<div id="area5_3" class="option_image_overlay click">
												<div class="option_image_label">Formal</div>
											</div>
										</div>
										<div class="col-sm-3 col-xs-6 option_image" >
	<img src="<?php bloginfo('template_url') ?>-child/images/trouser-cords.png" class="img-responsive" />
											<div id="area5_4" class="option_image_overlay click">
												<div class="option_image_label">Cords</div>
											</div>
										</div>
									</div>
									<div class="col-sm-11" >
										<div class="box_options_wrapper">
											<div class="box_options_label">What coloured trousers do you wear?</div>											
											<div class="box_options">
												<div class="shadow"><img src="<?php bloginfo('template_url') ?>-child/images/shadow.png" alt="" /></div>
													<div class="col-sm-3 box_option click">Bright</div>
													<div class="col-sm-3 box_option click selected">Neutral</div>
													<div class="col-sm-3 box_option click">Dark</div>
													<div class="col-sm-3 box_option click" style="border-bottom: none !important; border-right: none !important;">Patterned</div>
												</div>
												<div style="clear:both;"></div>
											</div>
											<div style="clear:both;"></div>
										</div>
									</div>
								</div>



							<div class="title-forms area6" style="border-bottom:1px solid #e3e3e3; padding-bottom:40px;">
								<div class="line_separator_thick"><img src="<?php bloginfo('template_url') ?>-child/images/line_thick.png" alt=""/></div>
								<div class="mini-wrapper-forms">
									<div class="numbering">05</div>
									<p>How do you wear your jeans?</p>
								</div><!--mini-wrapper-forms-->
								<div class="row">
									<div class="col-sm-11">
										<div class="col-sm-3 col-xs-6 option_image" >
	<img src="<?php bloginfo('template_url') ?>-child/images/jeans-skinny.jpg" class="img-responsive" />
											<div id="area6_1" class="option_image_overlay click">
												<div class="option_image_label">Skinny</div>
											</div>
										</div>
										<div class="col-sm-3 col-xs-6 option_image" >
	<img src="<?php bloginfo('template_url') ?>-child/images/jeans-chinos.jpg" class="img-responsive" />
											<div id="area6_2" class="option_image_overlay click">
												<div class="option_image_label">Straight</div>
											</div>
										</div>
										<div class="col-sm-3 col-xs-6 option_image" >
	<img src="<?php bloginfo('template_url') ?>-child/images/jeans-bootcut.jpg" class="img-responsive" />
											<div id="area6_3" class="option_image_overlay click">
												<div class="option_image_label">Bootcut</div>
											</div>
										</div>
										<div class="col-sm-3 col-xs-6 option_image" >
	<img src="<?php bloginfo('template_url') ?>-child/images/jeans-baggy.jpg" class="img-responsive" />
											<div id="area6_4" class="option_image_overlay click">
												<div class="option_image_label">Baggy</div>
											</div>
										</div>
									</div>
								</div>
							</div>	







							<div class="title-forms area7" style="border-bottom:1px solid #e3e3e3; padding-bottom:40px;">
								<div class="line_separator_thick"><img src="<?php bloginfo('template_url') ?>-child/images/line_thick.png" alt=""/></div>
								<div class="mini-wrapper-forms">
									<div class="numbering">06</div>
									<p>What colour denim do you prefer?</p>
								</div><!--mini-wrapper-forms-->
								<div class="row">
									<div class="col-sm-11">
										<div class="col-sm-1 hidden-xs"> </div>
										<div class="col-sm-2 col-xs-6 option_image" >
	<img src="<?php bloginfo('template_url') ?>-child/images/material-light.png" class="img-responsive" />
											<div id="area7_1" class="option_image_overlay click">
												<div class="option_image_label">Light</div>
											</div>
										</div>
										<div class="col-sm-2 col-xs-6 option_image" >
	<img src="<?php bloginfo('template_url') ?>-child/images/material-medium.png" class="img-responsive" />
											<div id="area7_2" class="option_image_overlay click">
												<div class="option_image_label">Medium</div>
											</div>
										</div>
										<div class="col-sm-2 col-xs-6 option_image" >
	<img src="<?php bloginfo('template_url') ?>-child/images/material-dark.png" class="img-responsive" />
											<div id="area7_3" class="option_image_overlay click">
												<div class="option_image_label">Dark</div>
											</div>
										</div>
										<div class="col-sm-2 col-xs-6 option_image" >
	<img src="<?php bloginfo('template_url') ?>-child/images/material-black.png" class="img-responsive" />
											<div id="area7_4" class="option_image_overlay click">
												<div class="option_image_label">Black</div>
											</div>
										</div>
										<div class="col-sm-2 col-xs-6 option_image" >
	<img src="<?php bloginfo('template_url') ?>-child/images/material-colored.png" class="img-responsive" />
											<div id="area7_5" class="option_image_overlay click">
												<div class="option_image_label">Colored</div>
											</div>
										</div>
										<div class="col-sm-1 hidden-xs"> </div>
									</div>
								</div>
							</div>



							<div class="title-forms area8" style="border-bottom:1px solid #e3e3e3; padding-bottom:40px;">
								<div class="line_separator_thick"><img src="<?php bloginfo('template_url') ?>-child/images/line_thick.png" alt=""/></div>
								<div class="mini-wrapper-forms">
									<div class="numbering">07</div>
									<p>How do you wear your shorts?</p>
								</div><!--mini-wrapper-forms-->
								<div class="row">
									<div class="col-sm-11">
										<div class="col-sm-4 col-xs-6 option_image" >
	<img src="<?php bloginfo('template_url') ?>-child/images/shorts-below-knee.png" class="img-responsive" />
											<div id="area8_1" class="option_image_overlay click">
												<div class="option_image_label">Below knee</div>
											</div>
										</div>
										<div class="col-sm-4 col-xs-6 option_image" >
	<img src="<?php bloginfo('template_url') ?>-child/images/shorts-above-knee.png" class="img-responsive" />
											<div id="area8_2" class="option_image_overlay click">
												<div class="option_image_label">Above knee</div>
											</div>
										</div>
										<div class="col-sm-4 col-xs-6  option_image" >
	<img src="<?php bloginfo('template_url') ?>-child/images/shorts-short.png" class="img-responsive" />
											<div id="area8_3" class="option_image_overlay click">
												<div class="option_image_label">Short</div>
											</div>
										</div>
									</div>
								</div>
							</div>




							<div class="title-forms area9" style="border-bottom:1px solid #e3e3e3;">
								<div class="line_separator_thick"><img src="<?php bloginfo('template_url') ?>-child/images/line_thick.png" alt=""/></div>
								<div class="mini-wrapper-forms">
									<div class="numbering">08</div>
									<p>Which style of shoes do you wear?</p>
								</div><!--mini-wrapper-forms-->
								<div class="row">
									<div class="col-sm-11">
										<div class="col-sm-4 col-xs-6 option_image" style="margin-bottom:30px;" >
	<img src="<?php bloginfo('template_url') ?>-child/images/shoes-boots.png" class="img-responsive" />
											<div id="area9_1" class="option_image_overlay click">
												<div class="option_image_label">Boots</div>
											</div>
										</div>
										<div class="col-sm-4 col-xs-6 option_image" style="margin-bottom:30px;" >
	<img src="<?php bloginfo('template_url') ?>-child/images/shoes-brogues.png" class="img-responsive" />
											<div id="area9_2" class="option_image_overlay click">
												<div class="option_image_label">Brogues</div>
											</div>
										</div>
										<div class="col-sm-4 col-xs-6 option_image" style="margin-bottom:30px;" >
	<img src="<?php bloginfo('template_url') ?>-child/images/shoes-trainers.png" class="img-responsive" />
											<div id="area9_3" class="option_image_overlay click">
												<div class="option_image_label">Trainers</div>
											</div>
										</div>
										<div class="col-sm-4 col-xs-6 option_image" >
	<img src="<?php bloginfo('template_url') ?>-child/images/shoes-boat.png" class="img-responsive" />
											<div id="area9_4" class="option_image_overlay click">
												<div class="option_image_label">Boat Shoes</div>
											</div>
										</div>
										<div class="col-sm-4 col-xs-6 option_image" >
	<img src="<?php bloginfo('template_url') ?>-child/images/shoes-loafers.png" class="img-responsive" />
											<div id="area9_5" class="option_image_overlay click">
												<div class="option_image_label">Loafers</div>
											</div>
										</div>
										<div class="col-sm-4 col-xs-6 option_image" >
	<img src="<?php bloginfo('template_url') ?>-child/images/shoes-formal.png" class="img-responsive" />
											<div id="area9_6" class="option_image_overlay click">
												<div class="option_image_label">Formal</div>
											</div>
										</div>
									</div>
									<div class="col-sm-11" >
										<div class="box_options_wrapper">
											<div class="box_options_label">What coloured shoes do you wear?</div>											
											<div class="box_options">
												<div class="shadow"><img src="<?php bloginfo('template_url') ?>-child/images/shadow.png" alt="" /></div>
													<div class="col-sm-4 box_option click">Bright</div>
													<div class="col-sm-4 box_option click selected">Neutral</div>
													<div class="col-sm-4 box_option click" style="border-bottom: none !important; border-right: none !important;">Dark</div>
												</div>
												<div style="clear:both;"></div>
											</div>
											<div style="clear:both;"></div>
										</div>
									</div>
								</div>




							<div class="title-forms area10">
								<div class="line_separator_thick"><img src="<?php bloginfo('template_url') ?>-child/images/line_thick.png" alt=""/></div>
								<div class="mini-wrapper-forms">
									<div class="numbering">10</div>
									<p>Which style of underwear do you prefer?</p>
								</div><!--mini-wrapper-forms-->
								<div class="row">
									<div class="col-sm-11">
										<div class="col-sm-4 col-xs-6 option_image" >
	<img src="<?php bloginfo('template_url') ?>-child/images/under-boxers.png" class="img-responsive" />
											<div id="area10_1" class="option_image_overlay click">
												<div class="option_image_label">Boxers</div>
											</div>
										</div>
										<div class="col-sm-4 col-xs-6 option_image" >
	<img src="<?php bloginfo('template_url') ?>-child/images/under-trunks.png" class="img-responsive" />
											<div id="area10_2" class="option_image_overlay click">
												<div class="option_image_label">Trunks</div>
											</div>
										</div>
										<div class="col-sm-4 col-xs-6 option_image" >
	<img src="<?php bloginfo('template_url') ?>-child/images/under-briefs.png" class="img-responsive" />
											<div id="area10_4" class="option_image_overlay click">
												<div class="option_image_label">Briefs</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="mini-wrapper5">
								<input type="hidden" value="<?php echo $nonce; ?>" name='nonce'>
								<button class="button4" onclick="submit()">Save and Continue</button>
							</div><!--mini-wrapper4-->
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


