<?php

class SwiftPageBuilderShortcode_portfolio extends SwiftPageBuilderShortcode {

    protected function content($atts, $content = null) {

		   	$title = $width = $el_class = $filter_output = $exclude_categories = $output = $tax_terms = $items = $el_position = '';
		
	        extract(shortcode_atts(array(
	        	'title' => '',
	        	'display_type' => 'standard',
	        	'columns'		=> '4',
	        	'show_title'	=> 'yes',
	        	'show_subtitle'	=> 'yes',
	        	'show_excerpt'	=> 'no',
	        	'hover_show_excerpt' => 'no',
	        	"excerpt_length" => '20',
	        	'item_count'	=> '-1',
	        	'category'		=> '',
	        	"exclude_categories" => '',
	        	'portfolio_filter'		=> 'yes',
	        	'pagination'	=> 'no',
	        	'el_position' => '',
	        	'width' => '1/1',
	        	'el_class' => ''
	        ), $atts));
	        
	        
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
	        
	        
	        /* PORTFOLIO FILTER
	        ================================================== */ 
	        if ($portfolio_filter == "yes" && $sidebars == "no-sidebars") {
	        	$filter_output = sf_portfolio_filter();
	        }
	        
	        
	        /* PORTFOLIO ITEMS
	        ================================================== */	        
	        $items = sf_portfolio_items($display_type, $columns, $show_title, $show_subtitle, $show_excerpt, $hover_show_excerpt, $excerpt_length, $item_count, $category, $exclude_categories, $pagination, $sidebars);
	        
	        
			/* PAGE BUILDER OUTPUT
			================================================== */ 
    		$width = spb_translateColumnWidthToSpan($width);
    		$el_class = $this->getExtraClass($el_class);
            
            $output .= "\n\t".'<div class="spb_portfolio_widget spb_content_element '.$width.$el_class.'">';
            $output .= "\n\t\t".'<div class="spb_wrapper portfolio-wrap">';
            $output .= ($title != '' ) ? "\n\t\t\t".'<h3 class="spb-heading"><span>'.$title.'</span></h3>' : '';
            if ($filter_output != "") {
            $output .= "\n\t\t\t".$filter_output;
            }
            $output .= "\n\t\t\t".$items;
            $output .= "\n\t\t".'</div> '.$this->endBlockComment('.spb_wrapper');
            $output .= "\n\t".'</div> '.$this->endBlockComment($width);
    
            $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
            
            global $sf_include_isotope;
            $sf_include_isotope = true;
            
            global $sf_has_portfolio;
            $sf_has_portfolio = true;

            return $output;
		
    }
}

SPBMap::map( 'portfolio', array(
    "name"		=> __("Portfolio", "swift-page-builder"),
    "base"		=> "portfolio",
    "class"		=> "spb_portfolio",
    "icon"      => "spb-icon-portfolio",
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
            "heading" => __("Display type", "swift-page-builder"),
            "param_name" => "display_type",
            "value" => array(__('Standard', "swift-page-builder") => "standard", __('Gallery', "swift-page-builder") => "gallery", __('Masonry', "swift-page-builder") => "masonry", __('Masonry Gallery', "swift-page-builder") => "masonry-gallery"),
            "description" => __("Select the type of portfolio you'd like to show.", "swift-page-builder")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Column count", "swift-page-builder"),
            "param_name" => "columns",
            "value" => array("4", "3", "2"),
            "description" => __("How many portfolio columns to display.", "swift-page-builder")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Show title text", "swift-page-builder"),
            "param_name" => "show_title",
            "value" => array(__('Yes', "swift-page-builder") => "yes", __('No', "swift-page-builder") => "no"),
            "description" => __("Show the item title text. (Standard/Masonry only)", "swift-page-builder")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Show subtitle text", "swift-page-builder"),
            "param_name" => "show_subtitle",
            "value" => array(__('Yes', "swift-page-builder") => "yes", __('No', "swift-page-builder") => "no"),
            "description" => __("Show the item subtitle text. (Standard/Masonry only)", "swift-page-builder")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Show item excerpt", "swift-page-builder"),
            "param_name" => "show_excerpt",
            "value" => array(__('No', "swift-page-builder") => "no", __('Yes', "swift-page-builder") => "yes"),
            "description" => __("Show the item excerpt text. (Standard/Masonry only)", "swift-page-builder")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Excerpt Hover", "swift-page-builder"),
            "param_name" => "hover_show_excerpt",
            "value" => array(__('No', "swift-page-builder") => "no", __('Yes', "swift-page-builder") => "yes"),
            "description" => __("Show the item excerpt on hover, instead of the arrow button. (Gallery/Masonry Gallery only)", "swift-page-builder")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Excerpt Length", "swift-page-builder"),
            "param_name" => "excerpt_length",
            "value" => "20",
            "description" => __("The length of the excerpt for the posts.", "swift-page-builder")
        ),
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of items", "swift-page-builder"),
            "param_name" => "item_count",
            "value" => "12",
            "description" => __("The number of portfolio items to show per page. Leave blank to show ALL portfolio items.", "swift-page-builder")
        ),
        array(
            "type" => "select-multiple",
            "heading" => __("Portfolio category", "swift-page-builder"),
            "param_name" => "category",
            "value" => sf_get_category_list('portfolio-category'),
            "description" => __("Choose the category from which you'd like to show the portfolio items.", "swift-page-builder")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Filter", "swift-page-builder"),
            "param_name" => "portfolio_filter",
            "value" => array(__('Yes', "swift-page-builder") => "yes", __('No', "swift-page-builder") => "no"),
            "description" => __("Show the portfolio category filter above the items. NOTE: This is only available on a page with the no sidebar setup.", "swift-page-builder")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Pagination", "swift-page-builder"),
            "param_name" => "pagination",
            "value" => array(__('Yes', "swift-page-builder") => "yes", __('No', "swift-page-builder") => "no"),
            "description" => __("Show portfolio pagination.", "swift-page-builder")
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