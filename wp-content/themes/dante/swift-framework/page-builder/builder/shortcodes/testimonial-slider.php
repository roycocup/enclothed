<?php

class SwiftPageBuilderShortcode_testimonial_slider extends SwiftPageBuilderShortcode {

    public function content( $atts, $content = null ) {

        $title = $order = $text_size = $items = $el_class = $width = $el_position = '';

        extract(shortcode_atts(array(
        	'title' => '',
        	'text_size' => '',
           	'item_count'	=> '',
           	'order'	=> '',
        	'category'		=> 'all',
        	'animation'		=> 'fade',
        	'autoplay'		=> 'yes',
            'el_class' => '',
            'alt_background'	=> 'none',
            'el_position' => '',
            'width' => '1/1'
        ), $atts));

        $output = '';
        
        // CATEGORY SLUG MODIFICATION
        if ($category == "All") {$category = "all";}
        if ($category == "all") {$category = '';}
        $category_slug = str_replace('_', '-', $category);
        
        
        // TESTIMONIAL QUERY SETUP
        
        global $post, $wp_query;
        
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            		
        $testimonials_args = array(
        	'orderby' => $order,
        	'post_type' => 'testimonials',
        	'post_status' => 'publish',
        	'paged' => $paged,
        	'testimonials-category' => $category_slug,
        	'posts_per_page' => $item_count,
        	'no_found_rows' => 1,
        	);
        	    		
        $testimonials = new WP_Query( $testimonials_args );
        
        if ($autoplay == "yes") {
        $items .= '<div class="flexslider testimonials-slider content-slider" data-animation="'.$animation.'" data-autoplay="yes"><ul class="slides">';
        } else {
        $items .= '<div class="flexslider testimonials-slider content-slider" data-animation="'.$animation.'" data-autoplay="no"><ul class="slides">';
        }
                  
        // TESTIMONIAL LOOP
        
        while ( $testimonials->have_posts() ) : $testimonials->the_post();
        	
        	$testimonial_text = get_the_content();
        	$testimonial_cite = get_post_meta($post->ID, 'sf_testimonial_cite', true);
        	$testimonial_cite_subtext = get_post_meta($post->ID, 'sf_testimonial_cite_subtext', true);
        	
        	$items .= '<li class="testimonial">';
        	$items .= '<div class="testimonial-text text-'.$text_size.'">'.do_shortcode($testimonial_text).'</div>'; 
        	if ($testimonial_cite_subtext != "") {
        	$items .= '<cite>'.$testimonial_cite.' - '.$testimonial_cite_subtext.'</cite>';
        	} else {
        	$items .= '<cite>'.$testimonial_cite.'</cite>';
        	}
        	$items .= '</li>';
        	        
        endwhile;
        
        wp_reset_postdata();
        		
        $items .= '</ul></div>';
       				        
        $el_class = $this->getExtraClass($el_class);
        $width = spb_translateColumnWidthToSpan($width);
        
        $sidebar_config = get_post_meta(get_the_ID(), 'sf_sidebar_config', true);
        
        $sidebars = '';
        if (($sidebar_config == "left-sidebar") || ($sidebar_config == "right-sidebar")) {
        $sidebars = 'one-sidebar';
        } else if ($sidebar_config == "both-sidebars") {
        $sidebars = 'both-sidebars';
        } else {
        $sidebars = 'no-sidebars';
        }

        $el_class .= ' testimonial';
        
        if ($alt_background == "none" || $sidebars != "no-sidebars") {
		$output .= "\n\t".'<div class="spb_testimonial_slider_widget spb_content_element '.$width.$el_class.'">';
        } else {
        $output .= "\n\t".'<div class="spb_testimonial_slider_widget spb_content_element alt-bg '.$alt_background.' '.$width.$el_class.'">';            
        }
        $output .= "\n\t\t".'<div class="spb_wrapper slider-wrap">';
        $output .= ($title != '' ) ? "\n\t\t\t".'<div class="heading-wrap"><h3 class="spb-heading spb-center-heading"><span>'.$title.'</span></h3></div>' : '';
        $output .= "\n\t\t\t".$items;
        $output .= "\n\t\t".'</div> '.$this->endBlockComment('.spb_wrapper');
        $output .= "\n\t".'</div> '.$this->endBlockComment($width);

        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        
        global $sf_include_carousel;
        $sf_include_carousel = true;
        
        return $output;
    }
}

SPBMap::map( 'testimonial_slider', array(
    "name"		=> __("Testimonials Slider", "swift-page-builder"),
    "base"		=> "testimonial_slider",
    "class"		=> "spb_testimonial_slider spb_slider",
    "icon"      => "spb-icon-testimonial_slider",
    "wrapper_class" => "clearfix",
    "params"	=> array(
    	array(
    	    "type" => "textfield",
    	    "heading" => __("Widget title", "swift-page-builder"),
    	    "param_name" => "title",
    	    "value" => "",
    	    "description" => __("Heading text. Leave it empty if not needed.", "swift-page-builder")
    	),
        array(
            "type" => "dropdown",
            "heading" => __("Text size", "swift-page-builder"),
            "param_name" => "text_size",
            "value" => array(__('Normal', "swift-page-builder") => "normal", __('Large', "swift-page-builder") => "large"),
            "description" => __("Choose the size of the text.", "swift-page-builder")
        ),
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of items", "swift-page-builder"),
            "param_name" => "item_count",
            "value" => "6",
            "description" => __("The number of testimonials to show. Leave blank to show ALL testimonials.", "swift-page-builder")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Testimonials Order", "swift-page-builder"),
            "param_name" => "order",
            "value" => array(__('Random', "swift-page-builder") => "rand", __('Latest', "swift-page-builder") => "date"),
            "description" => __("Choose the order of the testimonials.", "swift-page-builder")
        ),
        array(
            "type" => "select-multiple",
            "heading" => __("Testimonials category", "swift-page-builder"),
            "param_name" => "category",
            "value" => sf_get_category_list('testimonials-category'),
            "description" => __("Choose the category for the testimonials.", "swift-page-builder")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Slider autoplay", "swift-page-builder"),
            "param_name" => "autoplay",
            "value" => array(__('Yes', "swift-page-builder") => "yes", __('No', "swift-page-builder") => "no"),
            "description" => __("Select if you want the slider to autoplay or not.", "swift-page-builder")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Show alt background", "swift-page-builder"),
            "param_name" => "alt_background",
            "value" => array(__("None", "swift-page-builder") => "none", __("Alt 1", "swift-page-builder") => "alt-one", __("Alt 2", "swift-page-builder") => "alt-two", __("Alt 3", "swift-page-builder") => "alt-three", __("Alt 4", "swift-page-builder") => "alt-four", __("Alt 5", "swift-page-builder") => "alt-five", __("Alt 6", "swift-page-builder") => "alt-six", __("Alt 7", "swift-page-builder") => "alt-seven", __("Alt 8", "swift-page-builder") => "alt-eight", __("Alt 9", "swift-page-builder") => "alt-nine", __("Alt 10", "swift-page-builder") => "alt-ten"),
            "description" => __("Show an alternative background around the asset. These can all be set in Theme Options > Asset Background Options. NOTE: This is only available on a page with the no sidebar setup.", "swift-page-builder")
        ),
        array(
            "type" => "altbg_preview",
            "heading" => __("Alt Background Preview", "swift-page-builder"),
            "param_name" => "altbg_preview",
            "value" => "",
            "description" => __("", "swift-page-builder")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "swift-page-builder"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "swift-page-builder")
        )
    )
) );

?>