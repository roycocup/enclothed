<?php
if ( ! isset( $content_width ) )
	$content_width = 520;

$Raptor_themename = "Raptor";
$Raptor_textdomain = "Raptor";

function Raptor_setup(){
  // This theme uses wp_nav_menu() in one location.
  register_nav_menus( array(
    'mainmenu' => __( 'Main Navigation', 'Raptor' )
  ) );

  // This theme uses post thumbnails
  add_theme_support( 'post-thumbnails' );
  add_image_size( 'Raptorthumb', 500, 300, true );
  add_image_size( 'Raptorsingle', 1300, 500, true );  
  add_image_size( 'Raptorbigthumb', 750, 500, true ); 
  
  // Add default posts and comments RSS feed links to head
  add_theme_support( 'automatic-feed-links' );
  
  // Add translation support
  load_theme_textdomain('Raptor', get_template_directory() . '/languages');
  
  // Delete default WordPress gallery css
  add_filter( 'use_default_gallery_style', '__return_false' );

  // Add Custom header feature  
  $customhargs = array(
	'flex-width'    => true,
	'width'         => 1200,
	'flex-height'    => true,
	'height'        => 500,
	'header-text'   => false,
	'default-image' => get_template_directory_uri() . '/skins/images/defaulth.jpg',
  );
  add_theme_support( 'custom-header', $customhargs );  
  
  // Add Custom background feature
  if ( of_get_option('skin_style') ) {
  	$custombgargsskin = of_get_option('skin_style');
  }else {
  	$custombgargsskin = 'raptor';
  }
  
  if ( get_stylesheet_directory() == get_template_directory() ) {
	  $custombgargs = array(
		'default-color' => '292929',
		'default-image' => get_template_directory_uri() . '/skins/images/'.$custombgargsskin.'/page_bg.png',
		);
		
  }else {
	  if ( of_get_option('skin_style') == 'default' ) {
		  $custombgargs = array(
			'default-image' => get_stylesheet_directory_uri() . '/images/page_bg.png',
			);
	  }else {
		  $custombgargs = array(
			'default-image' => get_template_directory_uri() . '/skins/images/'.$custombgargsskin.'/page_bg.png',
			);		  
	  }
  }
  add_theme_support( 'custom-background', $custombgargs );  
}
add_action( 'after_setup_theme', 'Raptor_setup' );

/* 
 * Loads the Options Panel
 */
 
if ( !function_exists( 'optionsframework_init' ) ) {

	/* Set the file path based on whether we're in a child theme or parent theme */


		define('OPTIONS_FRAMEWORK_URL', get_template_directory() . '/admin/');
		define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/');


	require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');
}

/* 
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#example_showhidden').click(function() {
  		jQuery('#section-example_text_hidden').fadeToggle(400);
	});
	
	if (jQuery('#example_showhidden:checked').val() !== undefined) {
		jQuery('#section-example_text_hidden').show();
	}
	
});
</script>

<?php
}













/**
 * Get ID of the page, if this is current page
 */
function Raptor_get_page_id() {
	global $wp_query;

	$page_obj = $wp_query->get_queried_object();

	if ( isset( $page_obj->ID ) && $page_obj->ID >= 0 )
		return $page_obj->ID;

	return -1;
}

/**
 * Get custom field of the current page
 * $type = string|int
 */
function Raptor_get_custom_field($filedname, $id = NULL, $single=true)
{
	global $post;
	
	if($id==NULL)
		$id = get_the_ID();
	
	if($id==NULL)
		$id = Raptor_get_page_id();

	$value = get_post_meta($id, $filedname, $single);
	
	if($single)
		return stripslashes($value);
	else
		return $value;
}

/**
 * Get Limited String
 * $output = string
 * $max_char = int
 */
function Raptor_get_limited_string($output, $max_char=100, $end='...')
{
    $output = str_replace(']]>', ']]&gt;', $output);
    $output = strip_tags($output);
    $output = strip_shortcodes($output);

  	if ((strlen($output)>$max_char) && ($espacio = strpos($output, " ", $max_char )))
	{
        $output = substr($output, 0, $espacio).$end;
		return $output;
   }
   else
   {
      return $output;
   }
}

/**
 * Tests if any of a post's assigned categories are descendants of target categories
 *
 * @param mixed $cats The target categories. Integer ID or array of integer IDs
 * @param mixed $_post The post
 * @return bool True if at least 1 of the post's categories is a descendant of any of the target categories
 * @see get_term_by() You can get a category by name or slug, then pass ID to this function
 * @uses get_term_children() Gets descendants of target category
 * @uses in_category() Tests against descendant categories
 * @version 2.7
 */
function Raptor_post_is_in_descendant_category( $cats, $_post = null )
{
	foreach ( (array) $cats as $cat ) {
		// get_term_children() accepts integer ID only
		$descendants = get_term_children( (int) $cat, 'category');
		if ( $descendants && in_category( $descendants, $_post ) )
			return true;
	}
	return false;
}

/**
 * Custom comments for single or page templates
 */
function Raptor_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
   
   <div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">  <?php echo get_avatar($comment,'82'); ?> <cite class="fn"><?php echo get_comment_author_link(); ?></cite></div>
		<div class="comment-meta commentmetadata"><a href="<?php echo esc_html( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s','Raptor'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)','Raptor'),'  ','') ?></div>
      <?php if ($comment->comment_approved == '0') : ?>
         <p><em><?php _e('Your comment is awaiting moderation.','Raptor') ?></em></p>
      <?php endif; ?>
		<div class="entry">
		<?php comment_text() ?>
		</div>
		<div class="reply"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>
	</div>
<?php
}

/**
 * Browser detection body_class() output
 */
function Raptor_browser_body_class($classes) {
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	return $classes;
}
/**
 * Add StyleSheets
 */
function Raptor_add_stylesheets( ) {
	
	if( !is_admin() ) {

								wp_enqueue_style('Raptor_dropdowncss', get_stylesheet_directory_uri().'/css/dropdown.css');
								wp_enqueue_style('Raptor_rtldropdown', get_stylesheet_directory_uri().'/css/dropdown.vertical.rtl.css');
								wp_enqueue_style('Raptor_advanced_dropdown', get_stylesheet_directory_uri().'/css/default.advanced.css');

								
								echo '<!--[if lte IE 7]>
<style type="text/css">
html .jquerycssmenu{height: 1%;} /*Holly Hack for IE7 and below*/
</style>
<![endif]--> ';

								wp_enqueue_style('Raptor_wilto', get_stylesheet_directory_uri().'/css/wilto.css');
									
								if( of_get_option('skin_style') == 'raptor' ) {
									wp_enqueue_style('Raptor_style', get_template_directory_uri().'/skins/lite.css');	
									wp_enqueue_style('Raptor_responsive', get_template_directory_uri().'/skins/responsive.css');	
								}elseif( of_get_option('skin_style') == 'blue' ) {
									wp_enqueue_style('Raptor_style', get_template_directory_uri().'/skins/lite.css');	
									wp_enqueue_style('Raptor_responsive', get_template_directory_uri().'/skins/responsive.css');
									wp_enqueue_style('Raptor_color', get_template_directory_uri().'/skins/blue.css');		
								}elseif( of_get_option('skin_style') == 'brown' ) {
									wp_enqueue_style('Raptor_style', get_template_directory_uri().'/skins/lite.css');	
									wp_enqueue_style('Raptor_responsive', get_template_directory_uri().'/skins/responsive.css');
									wp_enqueue_style('Raptor_color', get_template_directory_uri().'/skins/brown.css');		
								}elseif( of_get_option('skin_style') == 'green' ) {
									wp_enqueue_style('Raptor_style', get_template_directory_uri().'/skins/lite.css');	
									wp_enqueue_style('Raptor_responsive', get_template_directory_uri().'/skins/responsive.css');
									wp_enqueue_style('Raptor_color', get_template_directory_uri().'/skins/green.css');		
								}elseif( of_get_option('skin_style') == 'orange' ) {
									wp_enqueue_style('Raptor_style', get_template_directory_uri().'/skins/lite.css');	
									wp_enqueue_style('Raptor_responsive', get_template_directory_uri().'/skins/responsive.css');
									wp_enqueue_style('Raptor_color', get_template_directory_uri().'/skins/orange.css');		
								}elseif( of_get_option('skin_style') == 'purple' ) {
									wp_enqueue_style('Raptor_style', get_template_directory_uri().'/skins/lite.css');	
									wp_enqueue_style('Raptor_responsive', get_template_directory_uri().'/skins/responsive.css');
									wp_enqueue_style('Raptor_color', get_template_directory_uri().'/skins/purple.css');		
								}elseif( of_get_option('skin_style') == 'red' ) {
									wp_enqueue_style('Raptor_style', get_template_directory_uri().'/skins/lite.css');	
									wp_enqueue_style('Raptor_responsive', get_template_directory_uri().'/skins/responsive.css');
									wp_enqueue_style('Raptor_color', get_template_directory_uri().'/skins/red.css');		
								}elseif( of_get_option('skin_style') == 'yellow' ) {
									wp_enqueue_style('Raptor_style', get_template_directory_uri().'/skins/lite.css');	
									wp_enqueue_style('Raptor_responsive', get_template_directory_uri().'/skins/responsive.css');
									wp_enqueue_style('Raptor_color', get_template_directory_uri().'/skins/yellow.css');		
								}elseif( of_get_option('skin_style') == 'aqua' ) {
									wp_enqueue_style('Raptor_style', get_template_directory_uri().'/skins/lite.css');	
									wp_enqueue_style('Raptor_responsive', get_template_directory_uri().'/skins/responsive.css');
									wp_enqueue_style('Raptor_color', get_template_directory_uri().'/skins/aqua.css');		
								}elseif( of_get_option('skin_style') == 'bgre' ) {
									wp_enqueue_style('Raptor_style', get_template_directory_uri().'/skins/lite.css');	
									wp_enqueue_style('Raptor_responsive', get_template_directory_uri().'/skins/responsive.css');
									wp_enqueue_style('Raptor_color', get_template_directory_uri().'/skins/bgre.css');		
								}elseif( of_get_option('skin_style') == 'blby' ) {
									wp_enqueue_style('Raptor_style', get_template_directory_uri().'/skins/lite.css');	
									wp_enqueue_style('Raptor_responsive', get_template_directory_uri().'/skins/responsive.css');
									wp_enqueue_style('Raptor_color', get_template_directory_uri().'/skins/blby.css');		
								}elseif( of_get_option('skin_style') == 'blbr' ) {
									wp_enqueue_style('Raptor_style', get_template_directory_uri().'/skins/lite.css');	
									wp_enqueue_style('Raptor_responsive', get_template_directory_uri().'/skins/responsive.css');
									wp_enqueue_style('Raptor_color', get_template_directory_uri().'/skins/blbr.css');		
								}elseif( of_get_option('skin_style') == 'brow' ) {
									wp_enqueue_style('Raptor_style', get_template_directory_uri().'/skins/lite.css');	
									wp_enqueue_style('Raptor_responsive', get_template_directory_uri().'/skins/responsive.css');
									wp_enqueue_style('Raptor_color', get_template_directory_uri().'/skins/brow.css');		
								}elseif( of_get_option('skin_style') == 'yrst' ) {
									wp_enqueue_style('Raptor_style', get_template_directory_uri().'/skins/lite.css');	
									wp_enqueue_style('Raptor_responsive', get_template_directory_uri().'/skins/responsive.css');
									wp_enqueue_style('Raptor_color', get_template_directory_uri().'/skins/yrst.css');		
								}elseif( of_get_option('skin_style') == 'grun' ) {
									wp_enqueue_style('Raptor_style', get_template_directory_uri().'/skins/lite.css');	
									wp_enqueue_style('Raptor_responsive', get_template_directory_uri().'/skins/responsive.css');
									wp_enqueue_style('Raptor_color', get_template_directory_uri().'/skins/grun.css');		
								}elseif( of_get_option('skin_style') == 'kafe' ) {
									wp_enqueue_style('Raptor_style', get_template_directory_uri().'/skins/lite.css');	
									wp_enqueue_style('Raptor_responsive', get_template_directory_uri().'/skins/responsive.css');
									wp_enqueue_style('Raptor_color', get_template_directory_uri().'/skins/kafe.css');		
								}elseif( of_get_option('skin_style') == 'slek' ) {
									wp_enqueue_style('Raptor_style', get_template_directory_uri().'/skins/lite.css');	
									wp_enqueue_style('Raptor_responsive', get_template_directory_uri().'/skins/responsive.css');
									wp_enqueue_style('Raptor_color', get_template_directory_uri().'/skins/slek.css');		
								}elseif( of_get_option('skin_style') == 'krem' ) {
									wp_enqueue_style('Raptor_style', get_template_directory_uri().'/skins/lite.css');	
									wp_enqueue_style('Raptor_responsive', get_template_directory_uri().'/skins/responsive.css');
									wp_enqueue_style('Raptor_color', get_template_directory_uri().'/skins/krem.css');		
								}elseif( of_get_option('skin_style') == 'mead' ) {
									wp_enqueue_style('Raptor_style', get_template_directory_uri().'/skins/lite.css');	
									wp_enqueue_style('Raptor_responsive', get_template_directory_uri().'/skins/responsive.css');
									wp_enqueue_style('Raptor_color', get_template_directory_uri().'/skins/mead.css');		
								}elseif( of_get_option('skin_style') == 'grngy' ) {
									wp_enqueue_style('Raptor_style', get_template_directory_uri().'/skins/lite.css');	
									wp_enqueue_style('Raptor_responsive', get_template_directory_uri().'/skins/responsive.css');
									wp_enqueue_style('Raptor_color', get_template_directory_uri().'/skins/grngy.css');		
								}elseif( of_get_option('skin_style') == 'kopr' ) {
									wp_enqueue_style('Raptor_style', get_template_directory_uri().'/skins/lite.css');	
									wp_enqueue_style('Raptor_responsive', get_template_directory_uri().'/skins/responsive.css');
									wp_enqueue_style('Raptor_color', get_template_directory_uri().'/skins/kopr.css');		
								}elseif( of_get_option('skin_style') == 'marn' ) {
									wp_enqueue_style('Raptor_style', get_template_directory_uri().'/skins/lite.css');	
									wp_enqueue_style('Raptor_responsive', get_template_directory_uri().'/skins/responsive.css');
									wp_enqueue_style('Raptor_color', get_template_directory_uri().'/skins/marn.css');		
								}elseif( of_get_option('skin_style') == 'gree' ) {
									wp_enqueue_style('Raptor_style', get_template_directory_uri().'/skins/lite.css');	
									wp_enqueue_style('Raptor_responsive', get_template_directory_uri().'/skins/responsive.css');
									wp_enqueue_style('Raptor_color', get_template_directory_uri().'/skins/gree.css');		
								}elseif( of_get_option('skin_style') == 'grey' ) {
									wp_enqueue_style('Raptor_style', get_template_directory_uri().'/skins/lite.css');	
									wp_enqueue_style('Raptor_responsive', get_template_directory_uri().'/skins/responsive.css');
									wp_enqueue_style('Raptor_color', get_template_directory_uri().'/skins/grey.css');		
								}elseif( of_get_option('skin_style') == 'brwgrn' ) {
									wp_enqueue_style('Raptor_style', get_template_directory_uri().'/skins/lite.css');	
									wp_enqueue_style('Raptor_responsive', get_template_directory_uri().'/skins/responsive.css');
									wp_enqueue_style('Raptor_color', get_template_directory_uri().'/skins/brwgrn.css');		
								}elseif( of_get_option('skin_style') == 'pnkr' ) {
									wp_enqueue_style('Raptor_style', get_template_directory_uri().'/skins/lite.css');	
									wp_enqueue_style('Raptor_responsive', get_template_directory_uri().'/skins/responsive.css');
									wp_enqueue_style('Raptor_color', get_template_directory_uri().'/skins/pnkr.css');		
								}elseif( of_get_option('skin_style') == 'bkrd' ) {
									wp_enqueue_style('Raptor_style', get_template_directory_uri().'/skins/lite.css');	
									wp_enqueue_style('Raptor_responsive', get_template_directory_uri().'/skins/responsive.css');
									wp_enqueue_style('Raptor_color', get_template_directory_uri().'/skins/bkrd.css');		
								}else {
									wp_enqueue_style('Raptor_style', get_stylesheet_directory_uri().'/lite.css');
									wp_enqueue_style('Raptor_responsive', get_stylesheet_directory_uri().'/responsive.css');
								}						
										

	}
}
/**
 * Add JS scripts
 */
function Raptor_add_javascript( ) {

	if (is_singular() && get_option('thread_comments'))
		wp_enqueue_script('comment-reply');
		
	wp_enqueue_script('jquery');
	
	if( !is_admin() ) {

		wp_enqueue_script('Raptor_respond', get_template_directory_uri().'/js/respond.min.js' );
		wp_enqueue_script('Raptor_respmenu', get_template_directory_uri().'/js/tinynav.min.js' );	
		wp_enqueue_script('Raptor_wilto', get_template_directory_uri().'/js/wilto.js');
		wp_enqueue_script('Raptor_wiltoint', get_template_directory_uri().'/js/wilto.int.js');

	}

}

function Raptor_backupmenu() {
	 	if ( current_user_can('edit_theme_options') ) {
				echo '	<ul id="Main_nav" class="dropdown dropdown-horizontal">
							<li class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home">
								<a href="'.get_admin_url().'nav-menus.php">'.__("Select a Menu to appear here in Dashboard->Appearance->Menus ", "Raptor").'</a>
							</li>
		
						</ul>	';
		} else {
				echo '	<ul id="Main_nav" class="dropdown dropdown-horizontal">
							<li class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home">
								<a href="'.esc_url( get_home_url() ).'">'.__("Home", "Raptor").'</a>
							</li>
		
						</ul>	';			
		}
}

/**
 * Register widgetized areas
 */
function Raptor_the_widgets_init() {
	
    
    $before_widget = '<div id="%1$s" class="sidebar_widget %2$s"><div class="widget">';
    $after_widget = '</div></div>';
    $before_title = '<h3 class="widgettitle">';
    $after_title = '</h3>';

	
	

    register_sidebar(array('name' => __('Default','Raptor'),'id' => 'default','before_widget' => $before_widget,'after_widget' => $after_widget,'before_title' => $before_title,'after_title' => $after_title));
    register_sidebar(array('name' => __('300x250 Ads','Raptor'),'id' => 'sidebar-ads','before_widget' => $before_widget,'after_widget' => $after_widget,'before_title' => $before_title,'after_title' => $after_title));
    register_sidebar(array('name' => __('125x125 Ads','Raptor'),'id' => 'sidebar-ads-onetwofive','before_widget' => $before_widget,'after_widget' => $after_widget,'before_title' => $before_title,'after_title' => $after_title));   
}

/**
 * Filter for get_the_excerpt
 */
 
function Raptor_get_the_excerpt($content){
	return str_replace(' [...]','',$content);
}

/* Wp Title */
function Raptor_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'alexandria' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'Raptor_wp_title', 10, 2 );

add_filter( 'the_content_more_link', 'Raptor_more_link', 10, 2 );

function Raptor_more_link( $more_link, $more_link_text ) {
	return '<br /><br />'.$more_link;
}

add_filter('the_title','Raptor_has_title');
function Raptor_has_title($title){
	global $post;
	if($title == ''){
		return get_the_time(get_option( 'date_format' ));
	}else{
		return $title;
	}
}




if (!is_admin()){
	add_action( 'wp_enqueue_scripts', 'Raptor_add_stylesheets' );	
	add_action( 'wp_enqueue_scripts', 'Raptor_add_javascript' );
}

add_filter('body_class','Raptor_browser_body_class');
add_filter('the_excerpt', 'Raptor_get_the_excerpt');
add_filter('get_the_excerpt', 'Raptor_get_the_excerpt');
add_action( 'widgets_init', 'Raptor_the_widgets_init' );

// Allow Shortcodes in Sidebar Widgets
add_filter('widget_text', 'do_shortcode');

add_action( 'widgets_init', 'Raptor_ads_sidebar' );

/**
 * Register our widget.
 * 'Example_Widget' is the widget class used below.
 *
 * @since 0.1
 */
function Raptor_ads_sidebar() {
	register_widget( 'Raptor_sidebarads' );
}

/**
 * Example Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 0.1
 */
class Raptor_sidebarads extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function Raptor_sidebarads() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'example', 'description' => __('An example widget that displays ads in sidebar.', 'Raptor') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => '300x250' );

		/* Create the widget. */
		$this->WP_Widget( '300x250', __('300x250 Ads', 'Raptor'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$image = $instance['image'];
		$url= $instance['url'];

	
		if ( $url )
			printf( '<p class="sidebar_ad_250"><a href="%1$s">', $url );

		if ( $image )
			printf( '<img src="%1$s" alt="" /></a></p>', $image );


	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['image'] = sanitize_text_field( $new_instance['image'] );
		$instance['url']   = sanitize_text_field(  $new_instance['url']   );		

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'image' => __('', 'Raptor'), 'url' => __('', 'Raptor') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e('Banner URL:', 'Raptor'); ?></label>
			<input id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo $instance['image']; ?>" class="widefat" />
		</p>

		<!-- Your Name: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e('Target URL', 'Raptor'); ?></label>
			<input id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" value="<?php echo $instance['url']; ?>" class="widefat" />
		</p>


	<?php
	}
}


add_action( 'widgets_init', 'Raptor_ads_sidebar_onetwofive' );

/**
 * Register our widget.
 * 'Example_Widget' is the widget class used below.
 *
 * @since 0.1
 */
function Raptor_ads_sidebar_onetwofive() {
	register_widget( 'Raptor_sidebarads_onetwofive' );
}

/**
 * Example Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 0.1
 */
class Raptor_sidebarads_onetwofive extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function Raptor_sidebarads_onetwofive() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'example', 'description' => __('An example widget that displays ads in sidebar.', 'Raptor') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => '125x125' );

		/* Create the widget. */
		$this->WP_Widget( '125x125', __('125x125 Ads', 'Raptor'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$image = $instance['image'];
		$url= $instance['url'];

	
		if ( $url )

			printf( '<p class="sidebar_ad"><a href="%1$s">', $url );

		if ( $image )
			printf( '<img src="%1$s" alt="" /></a></p>', $image );


	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		$instance['image'] = sanitize_text_field( $new_instance['image'] );
		$instance['url']   = sanitize_text_field(  $new_instance['url']   );		

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'image' => __('', 'Raptor'), 'url' => __('', 'Raptor') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e('Banner URL:', 'Raptor'); ?></label>
			<input id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo $instance['image']; ?>" class="widefat" />
		</p>

		<!-- Your Name: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e('Target URL', 'Raptor'); ?></label>
			<input id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" value="<?php echo $instance['url']; ?>" class="widefat" />
		</p>


	<?php
	}
}

?>