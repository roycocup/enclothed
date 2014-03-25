<?php
	
	/*
	*
	*	Swift Page Builder - Blog Shortcode
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2013 - http://www.swiftideas.net
	*
	*/

	class SwiftPageBuilderShortcode_blog extends SwiftPageBuilderShortcode {
	
	    protected function content($atts, $content = null) {
				
		    $title = $width = $el_class = $output = $show_blog_aux = $exclude_categories = $blog_aux = $show_read_more = $offset = $content_output = $items = $item_figure = $el_position = '';
			
	        extract(shortcode_atts(array(
	        	'title' => '',
	        	'show_blog_aux' => 'yes',
	        	"blog_type"		=> "standard",
	        	"masonry_effect_type" => "effect-1",
	        	'show_title'	=> 'yes',
	        	'show_excerpt'	=> 'yes',
	        	"show_details"	    => 'yes',
	        	"offset"		=> '0',
	        	"excerpt_length" => '20',
	        	'show_read_more' => 'yes',
	        	"item_count"	=> '5',
	        	"category"		=> '',
	        	"exclude_categories" => '',
	        	"pagination" 	=> "no",
	        	"content_output" => 'excerpt',
	        	'el_position' => '',
	        	'width' => '1/1',
	        	'el_class' => ''
	        ), $atts));

	        
	        $width = spb_translateColumnWidthToSpan($width);
	        
	        
	        /* SIDEBAR CONFIG
	        ================================================== */ 
	        $sidebar_config = get_post_meta(get_the_ID(), 'sf_sidebar_config', true);
	        
	        $sidebars = '';
	        if (($sidebar_config == "left-sidebar") || ($sidebar_config == "right-sidebar")) {
	        $sidebars = 'one-sidebar';
	        } else if ($sidebar_config == "both-sidebars") {
	        $sidebars = 'both-sidebars';
	        } else {
	        $sidebars = 'no-sidebars';
	        }
	        
	        
	        /* BLOG AUX
	        ================================================== */ 
	        if ($show_blog_aux == "yes" && $sidebars == "no-sidebars") {
	        	$blog_aux = sf_blog_aux($width);
	        }
	        
	        
	        /* BLOG ITEMS
	        ================================================== */ 
	        $items = sf_blog_items($blog_type, $masonry_effect_type, $show_title, $show_excerpt, $show_details, $excerpt_length, $content_output, $show_read_more, $item_count, $category, $exclude_categories, $pagination, $sidebars, $width, $offset);
	        
	      			
			/* FINAL OUTPUT
			================================================== */ 
 			
    		$el_class = $this->getExtraClass($el_class);
            
            $output .= "\n\t".'<div class="spb_blog_widget spb_content_element '.$width.$el_class.'">';
            $output .= "\n\t\t".'<div class="spb_wrapper blog-wrap">';            
            $output .= ($title != '' ) ? "\n\t\t\t".'<h3 class="spb-heading"><span>'.$title.'</span></h3>' : '';
            if ($blog_aux != "") {
            $output .= "\n\t\t\t".$blog_aux;
            }
            $output .= "\n\t\t\t".$items;
            $output .= "\n\t\t".'</div> '.$this->endBlockComment('.spb_wrapper');
            $output .= "\n\t".'</div> '.$this->endBlockComment($width);
    
            $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
            
            global $sf_has_blog, $sf_include_imagesLoaded;
            $sf_include_imagesLoaded = true;
            $sf_has_blog = true;
            
            return $output;
			
	    }
	}
	
	SPBMap::map( 'blog', array(
	    "name"		=> __("Blog", "swift-page-builder"),
	    "base"		=> "blog",
	    "class"		=> "spb_blog",
	    "icon"      => "spb-icon-blog",
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
	    	    "heading" => __("Show blog aux options", "swift-page-builder"),
	    	    "param_name" => "show_blog_aux",
	    	    "value" => array(__("Yes", "swift-page-builder") => "yes", __("No", "swift-page-builder") => "no"),
	    	    "description" => __("Show the blog aux options - categories/tags/search/archives/rss. NOTE: This is only available on a page with the no sidebar setup.", "swift-page-builder")
	    	),
	    	array(
	    	    "type" => "dropdown",
	    	    "heading" => __("Blog type", "swift-page-builder"),
	    	    "param_name" => "blog_type",
	    	    "value" => array(__('Standard', "swift-page-builder") => "standard", __('Mini', "swift-page-builder") => "mini", __('Masonry', "swift-page-builder") => "masonry"),
	    	    "description" => __("Select the display type for the blog.", "swift-page-builder")
	    	),
	    	array(
	    	    "type" => "dropdown",
	    	    "heading" => __("Masonry Animation Type", "swift-page-builder"),
	    	    "param_name" => "masonry_effect_type",
	    	    "value" => array(
	    	    		__('Effect 1', "swift-page-builder") => "effect-1",
	    	    		__('Effect 2', "swift-page-builder") => "effect-2",
	    	    		__('Effect 3', "swift-page-builder") => "effect-3",
	    	    		__('Effect 4', "swift-page-builder") => "effect-4",
	    	    		__('Effect 5', "swift-page-builder") => "effect-5",
	    	    		__('Effect 6', "swift-page-builder") => "effect-6",
	    	    		__('Effect 7', "swift-page-builder") => "effect-7",
	    	    		__('Effect 8', "swift-page-builder") => "effect-8",
	    	    		__('No Effect', "swift-page-builder") => "no-effect",
	    	   	),
	    	    "description" => __("If you choose the masonry blog type, you can choose the animation effect here.", "swift-page-builder")
	    	),
	        array(
	            "type" => "textfield",
	            "class" => "",
	            "heading" => __("Number of items", "swift-page-builder"),
	            "param_name" => "item_count",
	            "value" => "5",
	            "description" => __("The number of blog items to show per page.", "swift-page-builder")
	        ),
	        array(
	            "type" => "select-multiple",
	            "heading" => __("Blog category", "swift-page-builder"),
	            "param_name" => "category",
	            "value" => sf_get_category_list('category'),
	            "description" => __("Choose the category for the blog items.", "swift-page-builder")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Posts offset", "swift-page-builder"),
	            "param_name" => "offset",
	            "value" => "0",
	            "description" => __("The offset for the start of the posts that are displayed, e.g. enter 5 here to start from the 5th post.", "swift-page-builder")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Show title text", "swift-page-builder"),
	            "param_name" => "show_title",
	            "value" => array(__("Yes", "swift-page-builder") => "yes", __("No", "swift-page-builder") => "no"),
	            "description" => __("Show the item title text.", "swift-page-builder")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Show item excerpt", "swift-page-builder"),
	            "param_name" => "show_excerpt",
	            "value" => array(__("Yes", "swift-page-builder") => "yes", __("No", "swift-page-builder") => "no"),
	            "description" => __("Show the item excerpt text.", "swift-page-builder")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Show item details", "swift-page-builder"),
	            "param_name" => "show_details",
	            "value" => array(__("Yes", "swift-page-builder") => "yes", __("No", "swift-page-builder") => "no"),
	            "description" => __("Show the item details.", "swift-page-builder")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Excerpt Length", "swift-page-builder"),
	            "param_name" => "excerpt_length",
	            "value" => "20",
	            "description" => __("The length of the excerpt for the posts.", "swift-page-builder")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Content Output", "swift-page-builder"),
	            "param_name" => "content_output",
	            "value" => array(__("Excerpt", "swift-page-builder") => "excerpt", __("Full Content", "swift-page-builder") => "full_content"),
	            "description" => __("Choose whether to display the excerpt or the full content for the post. Full content is not available for the masonry view.", "swift-page-builder")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Show read more link", "swift-page-builder"),
	            "param_name" => "show_read_more",
	            "value" => array(__("Yes", "swift-page-builder") => "yes", __("No", "swift-page-builder") => "no"),
	            "description" => __("Show a read more link below the excerpt.", "swift-page-builder")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Pagination", "swift-page-builder"),
	            "param_name" => "pagination",
	            "value" => array(__("Infinite scroll", "swift-page-builder") => "infinite-scroll", __("Standard", "swift-page-builder") => "standard", __("None", "swift-page-builder") => "none"),
	            "description" => __("Show pagination.", "swift-page-builder")
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