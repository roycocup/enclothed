<?php
/**
*
* template name: Profile Style
*
**/
get_header();


if (isset($_SESSION['section_2'])){
	$section = $_SESSION['section_2'];	
}else if(isset($_POST['section_2'])){
	$section = $_POST['section_2'];
} else {
	$section = array();
}


?>

<?php 
function echo_if_present($word){
	if (!empty($_SESSION['section_2'])){
		$prev_sec_2 = explode(',', $_SESSION['section_2']['styles']);

		if (in_array($word, $prev_sec_2)){
			echo 'selected';
		}
	}
}

function echo_if_present_brand($word){
	if (!empty($_SESSION['section_2'])){
		$prev_sec_2 = explode(',', $_SESSION['section_2']['brands']);

		if (in_array($word, $prev_sec_2)){
			echo 'selected';
		}
	}
}
?>

<script>
	jQuery(document).ready(function($){
		// This is what enables the images to be added to the form 
		// when they are clicked and removed when clicked again
		$('.click').click(function(){
			var image = $(this).attr('id');
			if (!$(this).hasClass('selected')) {
				$('<input>').attr({
					type: 'hidden',
					name: 'section_2['+image+']',
					value: 'checked',
				}).appendTo('form[name="section_2"]');
			} else {
				$('form input[name="section_2['+image+']"').remove();
			}
		});

		//add the ones that are prepopulated / selected to the form
		$('.selected').each(function(){
			var image = $(this).attr('id');
			$('<input>').attr({
				type: 'hidden',
				name: 'section_2['+image+']',
				value: 'checked',
			}).appendTo('form[name="section_2"]');
		});

		$( ".click" ).click(function() {

			if($(this).hasClass( "selected" )){

			} else {
				$('#array').val( $('#array').val() + "," + $(this).attr('id') );		
			}
			$(this).toggleClass( "selected" );
		});

		// Autocomplete for the brands box
		function split( val ) {
			return val.split( /,\s*/ );
		}
		function extractLast( term ) {
			return split( term ).pop();
		}

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
							<li><span>Your Details</span></li>
							<li><span class="active">Pick Your Style</span></li>
							<li><span>Preferences</span></li>
							<li><span>Size and Color</span></li>
							<li><span style="border-right:none;">Price and Summary</span></li>
						</ul>
						<div class="shadow">
							<img src="<?php echo get_stylesheet_directory_uri();?>/images/shadow.png" alt="" />
						</div>
					</div><!--details-menu-->
				<div class="styles-block">
					<div class="fade-border-left"></div>
					<div class="fade-border-right"></div>
					<!-- the form -->
					<?php $nonce = wp_create_nonce( get_uri() ); ?>
					<form action="" method="POST" name='section_2'>								
						<div class="flashmessages col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
	            			<?php flashMessagesDisplay(); ?>
	           			</div>	

	           			<div class="title-forms area2" style="border-bottom:1px solid #e3e3e3;">
								<div class="mini-wrapper-forms">
									<div class="numbering">01</div>
									<p>Which brands do you usually wear?</p>
								</div><!--mini-wrapper-forms-->
								<div class="row" style="border-top: 1px solid #e3e3e3;">
									<div class="col-sm-6 grid_left">
										<div class="col-sm-6 col-xs-6 grid_box left">
											<img src="<?php bloginfo('template_url') ?>-child/images/brand_abercrombie_fitch.jpg" class="img-responsive" />
											<div id="brand_abercrombie_fitch" class="grid_box_overlay click <?php echo_if_present_brand('brand_abercrombie_fitch'); ?>"></div>
										</div>
										<div class="col-sm-6 col-xs-6 grid_box right">
											<img src="<?php bloginfo('template_url') ?>-child/images/brand_barbour.jpg" class="img-responsive" />
											<div id="brand_barbour" class="grid_box_overlay click <?php echo_if_present_brand('brand_barbour'); ?>"></div>
										</div>
										<div class="col-sm-6 col-xs-6 grid_box right">
											<img src="<?php bloginfo('template_url') ?>-child/images/brand_allsaints.jpg" class="img-responsive" />
											<div id="brand_allsaints" class="grid_box_overlay click <?php echo_if_present_brand('brand_allsaints'); ?>"></div>
										</div>
										<div class="col-sm-6 col-xs-6 grid_box left">
											<img src="<?php bloginfo('template_url') ?>-child/images/brand_hugo_boss.jpg" class="img-responsive" />
											<div id="brand_hugo_boss" class="grid_box_overlay click <?php echo_if_present_brand('brand_hugo_boss'); ?>"></div>
										</div>
									</div>
									<div class="col-sm-6 grid_right">
										<div class="col-sm-6 col-xs-6 grid_box left">
											<img src="<?php bloginfo('template_url') ?>-child/images/brand_apc.jpg" class="img-responsive" />
											<div id="brand_apc" class="grid_box_overlay click <?php echo_if_present_brand('brand_apc'); ?>"></div>
										</div>
										<div class="col-sm-6 col-xs-6 grid_box right">
											<img src="<?php bloginfo('template_url') ?>-child/images/brand_jack_wills.jpg" class="img-responsive" />
											<div id="brand_jack_wills" class="grid_box_overlay click <?php echo_if_present_brand('brand_jack_wills'); ?>"></div>
										</div>
										<div class="col-sm-6 col-xs-6 grid_box right">
											<img src="<?php bloginfo('template_url') ?>-child/images/brand_armani.jpg" class="img-responsive" />
											<div id="brand_armani" class="grid_box_overlay click <?php echo_if_present_brand('brand_armani'); ?>"></div>
										</div>
										<div class="col-sm-6 col-xs-6 grid_box left">
											<img src="<?php bloginfo('template_url') ?>-child/images/brand_oliver_spencer.jpg" class="img-responsive" />
											<div id="brand_oliver_spencer" class="grid_box_overlay click <?php echo_if_present_brand('brand_oliver_spencer'); ?>"></div>
										</div>
									</div>
									<div class="col-sm-6 grid_left">
										<div class="col-sm-6 col-xs-6 grid_box left">
											<img src="<?php bloginfo('template_url') ?>-child/images/brand_diesel.jpg" class="img-responsive" />
											<div id="brand_diesel" class="grid_box_overlay click <?php echo_if_present_brand('brand_diesel'); ?>"></div>
										</div>
										<div class="col-sm-6 col-xs-6 grid_box right">
											<img src="<?php bloginfo('template_url') ?>-child/images/brand_paul_smith.jpg" class="img-responsive" />
											<div id="brand_paul_smith" class="grid_box_overlay click <?php echo_if_present_brand('brand_paul_smith'); ?>"></div>
										</div>
										<div class="col-sm-6 col-xs-6 grid_box right">
											<img src="<?php bloginfo('template_url') ?>-child/images/brand_gant.jpg" class="img-responsive" />
											<div id="brand_gant" class="grid_box_overlay click <?php echo_if_present_brand('brand_gant'); ?>"></div>
										</div>
										<div class="col-sm-6 col-xs-6 grid_box left">
											<img src="<?php bloginfo('template_url') ?>-child/images/brand_ralph_lauren.jpg" class="img-responsive" />
											<div id="brand_lauren" class="grid_box_overlay click <?php echo_if_present_brand('brand_lauren'); ?>"></div>
										</div>
									</div>
									<div class="col-sm-6 grid_right">
										<div class="col-sm-6 col-xs-6 grid_box left">
											<img src="<?php bloginfo('template_url') ?>-child/images/brand_g-star.jpg" class="img-responsive" />
											<div id="brand_g-star" class="grid_box_overlay click <?php echo_if_present_brand('brand_g-star'); ?>"></div>
										</div>
										<div class="col-sm-6 col-xs-6 grid_box right">
											<img src="<?php bloginfo('template_url') ?>-child/images/brand_reiss.jpg" class="img-responsive" />
											<div id="brand_reiss" class="grid_box_overlay click <?php echo_if_present_brand('brand_reiss'); ?>"></div>
										</div>
										<div class="col-sm-6 col-xs-6 grid_box right">
											<img src="<?php bloginfo('template_url') ?>-child/images/brand_hackett.jpg" class="img-responsive" />
											<div id="brand_hackett" class="grid_box_overlay click <?php echo_if_present_brand('brand_hackett'); ?>"></div>
										</div>
										<div class="col-sm-6 col-xs-6 grid_box left">
											<img src="<?php bloginfo('template_url') ?>-child/images/brand_tommy_hilfiger.jpg" class="img-responsive" />
											<div id="brand_tommy_hilfinger" class="grid_box_overlay click <?php echo_if_present_brand('brand_tommy_hilfinger'); ?>"></div>
										</div>
									</div>

									<label  style="padding-top:40px;" class="css-label">Add more of your own brands</label>
									<textarea type="text" class="customer-info3" tabindex="2" placeholder="" name="section_2[more_brands]" id='brands-autocomplete-box'><?php @echo_if_exists($section['more_brands']); ?></textarea>                                    
								</div>
							</div>

						<div class="title-forms area2">
							<div class="mini-wrapper-forms">
								<div class="numbering">02</div>
								<p>Click on the pictures that best represent your style</p>
							</div><!--mini-wrapper-forms-->
							<div class="row">
								<div class="col-sm-6">
									<div class="col-sm-6 col-xs-6 grid_box left">
										<img src="<?php echo get_stylesheet_directory_uri();?>/images/grid-img1.jpg" class="img-responsive" />
										<div id="style_1" class="grid_box_overlay click <?php echo_if_present('style_1'); ?>"></div>
									</div>
									<div class="col-sm-6 col-xs-6 grid_box right">
										<img src="<?php echo get_stylesheet_directory_uri();?>/images/grid-img2.jpg" class="img-responsive" />
										<div id="style_2" class="grid_box_overlay click <?php echo_if_present('style_2'); ?>"></div>
									</div>
									<div class="col-sm-6 col-xs-6 grid_box right">
										<img src="<?php echo get_stylesheet_directory_uri();?>/images/grid-img6.jpg" class="img-responsive" />
										<div id="style_3" class="grid_box_overlay click <?php echo_if_present('style_3'); ?>"></div>
									</div>
									<div class="col-sm-6 col-xs-6 grid_box left">
										<img src="<?php echo get_stylesheet_directory_uri();?>/images/grid-img5.jpg" class="img-responsive" />
										<div id="style_4" class="grid_box_overlay click <?php echo_if_present('style_4'); ?>"></div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="col-sm-6 col-xs-6 grid_box left">
										<img src="<?php echo get_stylesheet_directory_uri();?>/images/grid-img3.jpg" class="img-responsive" />
										<div id="style_5" class="grid_box_overlay click <?php echo_if_present('style_5'); ?>"></div>
									</div>
									<div class="col-sm-6 col-xs-6 grid_box right">
										<img src="<?php echo get_stylesheet_directory_uri();?>/images/grid-img4.jpg" class="img-responsive" />
										<div id="style_6" class="grid_box_overlay click <?php echo_if_present('style_6'); ?>"></div>
									</div>
									<div class="col-sm-6 col-xs-6 grid_box right">
										<img src="<?php echo get_stylesheet_directory_uri();?>/images/grid-img8.jpg" class="img-responsive" />
										<div id="style_7" class="grid_box_overlay click <?php echo_if_present('style_7'); ?>"></div>
									</div>
									<div class="col-sm-6 col-xs-6 grid_box left">
										<img src="<?php echo get_stylesheet_directory_uri();?>/images/grid-img7.jpg" class="img-responsive" />
										<div id="style_8" class="grid_box_overlay click <?php echo_if_present('style_8'); ?>"></div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="col-sm-6 col-xs-6 grid_box left">
										<img src="<?php echo get_stylesheet_directory_uri();?>/images/grid-img9.jpg" class="img-responsive" />
										<div id="style_9" class="grid_box_overlay click <?php echo_if_present('style_9'); ?>"></div>
									</div>
									<div class="col-sm-6 col-xs-6 grid_box right">
										<img src="<?php echo get_stylesheet_directory_uri();?>/images/grid-img10.jpg" class="img-responsive" />
										<div id="style_10" class="grid_box_overlay click <?php echo_if_present('style_10'); ?>"></div>
									</div>
									<div class="col-sm-6 col-xs-6 grid_box right">
										<img src="<?php echo get_stylesheet_directory_uri();?>/images/grid-img13.jpg" class="img-responsive" />
										<div id="style_11" class="grid_box_overlay click <?php echo_if_present('style_11'); ?>"></div>
									</div>
									<div class="col-sm-6 col-xs-6 grid_box left">
										<img src="<?php echo get_stylesheet_directory_uri();?>/images/grid-img14.jpg" class="img-responsive" />
										<div id="style_12" class="grid_box_overlay click <?php echo_if_present('style_12'); ?>"></div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="col-sm-6 col-xs-6 grid_box left">
										<img src="<?php echo get_stylesheet_directory_uri();?>/images/grid-img11.jpg" class="img-responsive" />
										<div id="style_13" class="grid_box_overlay click <?php echo_if_present('style_13'); ?>"></div>
									</div>
									<div class="col-sm-6 col-xs-6 grid_box right">
										<img src="<?php echo get_stylesheet_directory_uri();?>/images/grid-img12.jpg" class="img-responsive" />
										<div id="style_14" class="grid_box_overlay click <?php echo_if_present('style_14'); ?>"></div>
									</div>
										<div class="col-sm-6 col-xs-6 grid_box right">
											<img src="<?php echo get_stylesheet_directory_uri();?>/images/grid-img15.jpg" class="img-responsive" />
											<div id="style_15" class="grid_box_overlay click <?php echo_if_present('style_15'); ?>"></div>
										</div>
										<div class="col-sm-6 col-xs-6 grid_box left">
											<img src="<?php echo get_stylesheet_directory_uri();?>/images/grid-img16.jpg" class="img-responsive" />
											<div id="style_16" class="grid_box_overlay click <?php echo_if_present('style_16'); ?>"></div>
										</div>
									</div>
								


								<div class="col-sm-6">
									<div class="col-sm-6 col-xs-6 grid_box left">
										<img src="<?php echo get_stylesheet_directory_uri();?>/images/grid-img17.jpg" class="img-responsive" />
										<div id="style_17" class="grid_box_overlay click <?php echo_if_present('style_17'); ?>"></div>
									</div>
									<div class="col-sm-6 col-xs-6 grid_box right">
										<img src="<?php echo get_stylesheet_directory_uri();?>/images/grid-img18.jpg" class="img-responsive" />
										<div id="style_18" class="grid_box_overlay click <?php echo_if_present('style_18'); ?>"></div>
									</div>
									<div class="col-sm-6 col-xs-6 grid_box right">
										<img src="<?php echo get_stylesheet_directory_uri();?>/images/grid-img21.jpg" class="img-responsive" />
										<div id="style_19" class="grid_box_overlay click <?php echo_if_present('style_19'); ?>"></div>
									</div>
									<div class="col-sm-6 col-xs-6 grid_box left">
										<img src="<?php echo get_stylesheet_directory_uri();?>/images/grid-img22.jpg" class="img-responsive" />
										<div id="style_20" class="grid_box_overlay click <?php echo_if_present('style_20'); ?>"></div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="col-sm-6 col-xs-6 grid_box left">
										<img src="<?php echo get_stylesheet_directory_uri();?>/images/grid-img19.jpg" class="img-responsive" />
										<div id="style_21" class="grid_box_overlay click <?php echo_if_present('style_21'); ?>"></div>
									</div>
									<div class="col-sm-6 col-xs-6 grid_box right">
										<img src="<?php echo get_stylesheet_directory_uri();?>/images/grid-img20.jpg" class="img-responsive" />
										<div id="style_22" class="grid_box_overlay click <?php echo_if_present('style_22'); ?>"></div>
									</div>
										<div class="col-sm-6 col-xs-6 grid_box right">
											<img src="<?php echo get_stylesheet_directory_uri();?>/images/grid-img23.jpg" class="img-responsive" />
											<div id="style_23" class="grid_box_overlay click <?php echo_if_present('style_23'); ?>"></div>
										</div>
										<div class="col-sm-6 col-xs-6 grid_box left">
											<img src="<?php echo get_stylesheet_directory_uri();?>/images/grid-img24.jpg" class="img-responsive" />
											<div id="style_24" class="grid_box_overlay click <?php echo_if_present('style_24'); ?>"></div>
										</div>
									</div>
								</div>

							</div>
							
							<div class="mini-wrapper5">
								<input type="hidden" value="<?php echo $nonce; ?>" name='nonce'>
								<a href="/profile/details/" class="button4">Go Back</a>
                				<div class="button_spacer col-sm-1 hidden-xs"></div>
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


