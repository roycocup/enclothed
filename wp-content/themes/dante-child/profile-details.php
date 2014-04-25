<?php
/**
*
* template name: Profile Details
*
**/
// session_destroy();
// var_dump($_SESSION); die;
?>
<?php get_header(); ?>
<?php 
if (isset($_SESSION['section_1'])){
	$section = $_SESSION['section_1'];	
}else if(isset($_POST['section_1'])){
	$section = $_POST['section_1'];
} else {
	$section = array();
}

?>
<script>
	jQuery(document).ready(function($){

		//defaults for datepicker
		$( "#datepicker" ).datepicker({
			dateFormat: 'dd/mm/yy', 
			changeMonth: true,
      		changeYear: true,
      		yearRange: '1920:2010',
      		defaultDate: "10/09/1976",
		});

		for(d=1; d <= 30; d++) {
			var finalValue = d;
			if (d < 10) {
				finalValue = '0'+d;
			}
			$('<option>').attr({
				value: finalValue
			}).text(d).appendTo('#daySelect');
		}

		var selectedDay = 1;

		$("#daySelect").change(function() {
			selectedDay = $(this).val();
		});

		$("#monthSelect").change(function() {
			var selectedValue = $(this).val();
			var thirtyDays = ('september,april,june,november');
			var thirtyOneDays = ('january,march,may,july,august,october,december');
			
			$("#daySelect").empty();
			
			var numberOfDays = 29;
			if (thirtyDays.indexOf(selectedValue) != -1) {
				numberOfDays = 30;
			} else if (thirtyOneDays.indexOf(selectedValue) != -1) {
				numberOfDays = 31;
			}
			
			$('<option>').attr({
					value: ''
				}).text("DAY").appendTo('#daySelect');

			for(d=1; d <= numberOfDays; d++) {
				var finalValue = d;
				if (d < 10) {
					finalValue = '0'+d;
				}
				$('<option>').attr({
					value: finalValue
				}).text(d).appendTo('#daySelect');

			}

			$("#daySelect").val(selectedDay);

		});

		

		$('#howDidYouHearDropdown').change(function() {
			if ($(this).val() == "Other") {
				$('#howDidYouHearOther').show();
			} else {
				$('#howDidYouHearOther').hide();
			}
		})

		$('#areYouPurchasingDropdown').change(function() {
			if ($(this).val() == "Yes") {
				$('#purchasingYes').show();
			} else {
				$('#purchasingYes').hide();
			}
		})

		var howDidYouHear = "<?php @echo_if_exists($section['feedback_1']); ?>";
		var areYouPurchasing = "<?php @echo_if_exists($section['other_person']); ?>";
		
		if (howDidYouHear != "") {
			$("#howDidYouHearDropdown").val(howDidYouHear);
		}

		if (areYouPurchasing != "") {
			$("#areYouPurchasingDropdown").val(areYouPurchasing);
		}

		var dateofBirth = "<?php @echo_if_exists($section['dob']); ?>";

		if (dateofBirth == "") {
			var dateofBirth = "<?php @echo_if_exists($section['dob_year'])?>-<?php @echo_if_exists($section['dob_month'])?>-<?php @echo_if_exists($section['dob_day']) ?>";
		}

		if (dateofBirth != "") {
			var dobSplit = dateofBirth.split("-");

			$("#daySelect").val(dobSplit[2]);
			$("#monthSelect").val(dobSplit[1]);
			$("#yearSelect").val(dobSplit[0]);
		}

		if ($('#howDidYouHearDropdown').val() == "Other") {
			$('#howDidYouHearOther').show();
		}

		if ($('#areYouPurchasingDropdown').val() == "Yes") {
			$('#purchasingYes').show();
		}
		
		//Flashmessages
		//controling the display of errors in the flash messages, depending if there are messages in the session or not
		var has_messages = <?php echo (sessionHasMessages()) ? 'true':'false';?>;
		if (has_messages) {
			$('.flashmessages').show();	
		} 
		
	});

</script>
<?php //session_destroy(); ?>

	
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
	//unset password at this point so relogin doesn't occur however password is required for sageway
	unset($_SESSION['section_1']['password']);
	unset($section['password']);
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
			<li><span class="active">Your Details</span></li>
			<li class="hidden-sm hidden-xs"><span>Pick Your Style</span></li>
			<li class="hidden-sm hidden-xs"><span>Preferences</span></li>
			<li class="hidden-sm hidden-xs"><span>Size and Color</span></li>
			<li class="hidden-sm hidden-xs"><span style="border-right:none;">Price and Summary</span></li>
		</ul>
 <div class="shadow"><img src="<?php bloginfo('template_url') ?>-child/images/shadow.png" alt="" /></div>
 </div><!--details-menu-->
  
	<div class="styles-block">
	<div class="fade-border-left"></div>
	<div class="fade-border-right"></div>
	<form action="" method="POST" name='section_1'>
		<?php $nonce = wp_create_nonce( get_uri() ); ?>
		<div class="flashmessages col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
			<p class="error_message">Please correct the following errors</p>
			<ul class="error_fields">
				<?php flashMessagesDisplay('li'); ?>  
			</ul>
		</div>
			<div class="title-forms">
				<div class="mini-wrapper-forms">
				<div class="numbering">01</div>
				<p>Some Key Pieces of information we need about you.</p>
				<input type="text" class="key-info" tabindex="1" name="section_1[name]" placeholder='Full Name' value="<?php @echo_if_exists($section['name']); ?>" >
				<input type="text" class="key-info" tabindex="2" name="section_1[email]" placeholder='Email' value="<?php @echo_if_exists($section['email']); ?>">
				<input type="text" class="key-info" tabindex="3" name="section_1[address]" placeholder='Address' value="<?php @echo_if_exists($section['address']); ?>">
				<input type="text" class="key-info" tabindex="4" name="section_1[town]" placeholder='Town / City' value="<?php @echo_if_exists($section['town']); ?>">
				<input type="text" class="key-info" tabindex="5" name="section_1[post_code]" placeholder='Post Code' value="<?php @echo_if_exists($section['post_code']); ?>">
				<input type="text" class="key-info" tabindex="6" name="section_1[phone]" placeholder='Phone Number' value="<?php @echo_if_exists($section['phone']); ?>">
				<input type="password" class="key-info"  tabindex="7" name="section_1[password]" placeholder='Password' value="<?php @echo_if_exists($section['password']); ?>">
				<input type="password" class="key-info"  tabindex="8" name="section_1[cpassword]" placeholder='Confirm Password' value="<?php @echo_if_exists($section['cpassword']); ?>">
				<input type="text" class="selectmenu" tabindex="9" name="section_1[occupation]" placeholder='Occupation' value="<?php @echo_if_exists($section['occupation']); ?>">
				<span class="date">
					Date of Birth
				</span> 
				<div class="dateWrapper">
					<select class="selectmenu dateSelect" type='dropdown' name='section_1[dob_day]' id="daySelect"><option value=''>DAY</option></select>
					<select class="selectmenu dateSelect" type='dropdown' name='section_1[dob_month]' id="monthSelect">
					<option value=''>MONTH</option>
					<?php 
					$months = array('january','february','march','april','may','june','july','august','september','october','november','december');
					$monthCount = 1;
					foreach($months as $month) { ?>
						<option value='<?php if ($monthCount < 10) { echo 0;} echo $monthCount; ?>'><?php echo $month; ?></option>
					<?php 
						$monthCount++;
					} ?>
					</select>
					<select class="selectmenu dateSelect noRight" type='dropdown' name='section_1[dob_year]' id="yearSelect">
					<option value=''>YEAR</option>
					<?php 
					$currentYear = date("Y");
					for($i=0; $i<=150; $i++) { ?>
						<option value='<?php echo $currentYear-$i; ?>'><?php echo $currentYear-$i; ?></option>
					<?php } ?>
					</select>
				</div>
			
			
			
			
			<select class="selectmenu" tabindex="10" name="section_1[feedback_1]" id="howDidYouHearDropdown">
					<option value="none">How did you hear about enclothed?</option>
					<option value="From Google">From Google</option>
					<option value="From Facebook">From Facebook</option>
					<option value="From a blog">From a blog</option>
					<option value="From a friend">From a friend</option>
					<option value="From a flyer">From a flyer</option>
					<option value="From the press">From the press</option>
					<option value="Other">Other</option>
			</select>
			<textarea type="text" class="smallerTextArea" tabindex="2" placeholder="Explain Other" style="display:none;" name="section_1[how_hear_other]" id="howDidYouHearOther"><?php @echo_if_exists($section['how_hear_other']); ?></textarea>
			
			<select class="selectmenu" tabindex="11" name="section_1[other_person]" id="areYouPurchasingDropdown">
					<option value="none">Are you purchasing for another person?</option>
					<option value="Yes">Yes</option>
					<option value="No">No</option>
			</select>
			<textarea type="text" class="smallerTextArea" tabindex="2" placeholder="Other Persons Name" style="display:none;" name="section_1[purchasing_yes]" id="purchasingYes"><?php @echo_if_exists($section['purchasing_yes']); ?></textarea>
			
			<div class="checkbox_wrap" style="max-width:400px; padding-bottom:0px; padding-top:30px;">
				<input type="checkbox" class="css-checkbox" id="checkbox1" name="section_1[tc]">
				<label for="checkbox1" class="css-label tickbox">- AGREE WITH THE TERMS AND CONDITONS</label>
			</div>	
				
		</div><!--mini-wrapper-forms-->

		  <div class="mini-wrapper5" style="margin:10px auto;">
           	<input type="hidden" value="<?php echo $nonce; ?>" name='nonce'>
            <button class="button4" onclick="submit()">Save and Continue</button>
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


