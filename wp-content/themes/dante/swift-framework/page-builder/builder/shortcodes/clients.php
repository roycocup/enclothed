<?php

class SwiftPageBuilderShortcode_clients extends SwiftPageBuilderShortcode {

    protected function content($atts, $content = null) {

		   	$title = $width = $el_class = $carousel_auto = $output = $tax_terms = $filter = $items = $el_position = '';
		
	        extract(shortcode_atts(array(
	        	'title' => '',
	        	'item_count'	=> '-1',
	        	'category'		=> '',
	        	'carousel_auto' => 'no',
	        	'pagination'	=> 'no',
	        	'el_position' => '',
	        	'width' => '1/1',
	        	'el_class' => ''
	        ), $atts));
	        
	        // CATEGORY SLUG MODIFICATION
	        if ($category == "All") {$category = "all";}
		    if ($category == "all") {$category = '';}
		    $category_slug = str_replace('_', '-', $category);
		    
		    // CLIENTS QUERY SETUP
    		
    		global $post, $wp_query, $sf_carouselID;
    		
    		if ($sf_carouselID == "") {
    		$sf_carouselID = 1;
    		} else {
    		$sf_carouselID++;
    		}
    		
    		
    		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    		    		
    		$client_args=array(
	    		'post_type' => 'clients',
	    		'post_status' => 'publish',
	    		'paged' => $paged,
	    		'clients-category' => $category_slug,
	    		'posts_per_page' => $item_count
       		);
       		    		
    		$clients_items = new WP_Query( $client_args );
    		
    		if ($width == "1/4") {
    		$columns = 2;
    		} else if ($width == "1/2") {
    		$columns = 3;
    		} else if ($width == "3/4") {
    		$columns = 4;
    		} else {
    		$columns = 6;
    		}	
    		
    		if ($carousel_auto == "yes") {
    		$items .= '<div class="carousel-overflow"><ul id="carousel-'.$sf_carouselID.'" class="clients-items carousel-items clearfix" data-columns="'.$columns.'" data-auto="true">';    		
    		} else {
       		$items .= '<div class="carousel-overflow"><ul id="carousel-'.$sf_carouselID.'" class="clients-items carousel-items clearfix" data-columns="'.$columns.'" data-auto="false">';
    		}
    				
    								
			$client_width = 200;
			$client_height = 200;
			
			// CLIENTS LOOP
			
			while ( $clients_items->have_posts() ) : $clients_items->the_post();
			
				$client_image = get_post_thumbnail_id();
				$client_img_url = wp_get_attachment_url( $client_image, 'full' );
				$client_link_url = get_post_meta($post->ID, 'sf_client_link', true);
				    				
				$items .= '<li class="clearfix carousel-item client-item span2">';
				    				
				$items .= '<figure>';
					
				$image = aq_resize( $client_img_url, $client_width, $client_height, true, false);
				
				if ($image) {
				
					if ($client_link_url) {
					$items .= '<a href="'.$client_link_url.'" target="_blank"><img src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" /></a>';
					} else {
					$items .= '<img src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" />';
					}
					
				}

				$items .= '</figure>';
							
			endwhile;
			
			wp_reset_postdata();
					
			$items .= '</ul>';
			
			$items .= '<a href="#" class="prev"><i class="ss-navigateleft"></i></a><a href="#" class="next"><i class="ss-navigateright"></i></a>';
			
			$options = get_option('sf_dante_options');
			if ($options['enable_swipe_indicators']) {
			$items .= '<div class="sf-swipe-indicator"></div>';
			}
			
			$items .= '</div>';
			
			// PAGINATION
			
			if ($pagination == "yes") {
			
				$items .= '<div class="pagination-wrap">';
				
				$items .= pagenavi($clients_items);
									
				$items .= '</div>';
			
			}
			
			// PAGE BUILDER OUPUT
    		
    		$el_class = $this->getExtraClass($el_class);
            $width = spb_translateColumnWidthToSpan($width);
            
            $output .= "\n\t".'<div class="spb_clients_widget spb_content_element '.$width.$el_class.'">';
            $output .= "\n\t\t".'<div class="spb_wrapper clients-wrap carousel-wrap alt-nav">';
            $output .= ($title != '' ) ? "\n\t\t\t".'<h3 class="spb-heading spb-text-heading"><span>'.$title.'</span></h3>' : '';
            $output .= "\n\t\t\t\t".$items;
            $output .= "\n\t\t".'</div> '.$this->endBlockComment('.spb_wrapper');
            $output .= "\n\t".'</div> '.$this->endBlockComment($width);
    
            $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
           
           	global $sf_include_carousel;
           	$sf_include_carousel = true;
           
            return $output;
		
    }
}

SPBMap::map( 'clients', array(
    "name"		=> __("Clients", "swift-page-builder"),
    "base"		=> "clients",
    "class"		=> "clients",
    "icon"      => "spb-icon-clients",
    "params"	=> array(
    	array(
    	    "type" => "textfield",
    	    "heading" => __("Widget title", "swift-page-builder"),
    	    "param_name" => "title",
    	    "value" => "",
    	    "description" => __("Heading text. Leave it empty if not needed.", "swift-page-builder")
    	),
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of items", "swift-page-builder"),
            "param_name" => "item_count",
            "value" => "12",
            "description" => __("The number of clients to show per page. Leave blank to show ALL clients.", "swift-page-builder")
        ),
        array(
            "type" => "select-multiple",
            "heading" => __("Clients category", "swift-page-builder"),
            "param_name" => "category",
            "value" => sf_get_category_list('clients-category'),
            "description" => __("Choose the category for the client items.", "swift-page-builder")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Carousel Auto-Rotate", "swift-page-builder"),
            "param_name" => "carousel_auto",
            "value" => array(__("Yes", "swift-page-builder") => "yes",
            				__("No", "swift-page-builder") => "no"
            			),
            "description" => __("Makes the carousel auto-rotate.", "swift-page-builder")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Pagination", "swift-page-builder"),
            "param_name" => "pagination",
            "value" => array(__('No', "swift-page-builder") => "no", __('Yes', "swift-page-builder") => "yes"),
            "description" => __("Show clients pagination.", "swift-page-builder")
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


class SwiftPageBuilderShortcode_clients_featured extends SwiftPageBuilderShortcode {

    protected function content($atts, $content = null) {

		   	$title = $width = $el_class = $output = $wrap_span = $tax_terms = $filter = $items = $el_position = '';
		
	        extract(shortcode_atts(array(
	        	'title' => '',
	        	'category'		=> '',
	        	'alt_background'	=> 'none',
	        	'el_position' => '',
	        	'width' => '1/1',
	        	'el_class' => ''
	        ), $atts));
	        
	        // CATEGORY SLUG MODIFICATION
	        if ($category == "All") {$category = "all";}
		    if ($category == "all") {$category = '';}
		    $category_slug = str_replace('_', '-', $category);
		    
		    // CLIENTS QUERY SETUP
    		
    		global $post, $wp_query;
    		
    		$sidebar_config = get_post_meta(get_the_ID(), 'sf_sidebar_config', true);
    		
    		$sidebars = '';
    		if (($sidebar_config == "left-sidebar") || ($sidebar_config == "right-sidebar")) {
    		$wrap_span = "col-sm-6";
    		$sidebars = 'one-sidebar';
    		} else if ($sidebar_config == "both-sidebars") {
    		$wrap_span = "col-sm-4";
    		$sidebars = 'both-sidebars';
    		} else {
    		$wrap_span = "col-sm-10";
    		$sidebars = 'no-sidebars';
    		}
       		    		    		
    		$client_args=array(
	    		'post_type' => 'clients',
	    		'post_status' => 'publish',
	    		'clients-category' => $category_slug,
	    		'posts_per_page' => 5
       		);
       		    		
    		$clients_items = new WP_Query( $client_args );
    		
    		$items .= '<h4 class="span2">'.$title.'</h4>';
    				
    		$items .= '<div class="featured-clients-items-wrap '.$wrap_span.'">';
			$items .= '<ul class="featured-clients-items row clearfix">';
			
			$client_width = 300;
			$client_height = NULL;
			
			// CLIENTS LOOP
			
			while ( $clients_items->have_posts() ) : $clients_items->the_post();
			
				$client_image = get_post_thumbnail_id();
				$client_img_url = wp_get_attachment_url( $client_image, 'full' );
				$client_link_url = get_post_meta($post->ID, 'sf_client_link', true);
				    				
				$items .= '<li class="clearfix span2">';
				    				
				$items .= '<figure>';
					
				$image = aq_resize( $client_img_url, $client_width, $client_height, true, false);
				
				if ($image) {
				
					if ($client_link_url) {
					$items .= '<a href="'.$client_link_url.'" target="_blank"><img src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" /></a>';
					} else {
					$items .= '<img src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" />';
					}
					
				}
				
				$items .= '</figure>';
							
			endwhile;
			
			wp_reset_postdata();
					
			$items .= '</ul></div>';
			
			// PAGE BUILDER OUPUT
    		
    		$el_class = $this->getExtraClass($el_class);
            $width = spb_translateColumnWidthToSpan($width);
            
            if ($alt_background == "none" || $sidebars != "no-sidebars") {
            $output .= "\n\t".'<div class="spb_featured_clients_widget spb_content_element '.$width.$el_class.'">';
            } else {
            $output .= "\n\t".'<div class="spb_featured_clients_widget spb_content_element alt-bg '.$alt_background.' '.$width.$el_class.'">';
            }
            
            $output .= "\n\t\t".'<div class="spb_wrapper clients-wrap row">';
            $output .= "\n\t\t\t\t".$items;
            $output .= "\n\t\t".'</div> '.$this->endBlockComment('.spb_wrapper');
            $output .= "\n\t".'</div> '.$this->endBlockComment($width);
    
            $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
            return $output;
		
    }
}

SPBMap::map( 'clients_featured', array(
    "name"		=> __("Clients (Featured)", "swift-page-builder"),
    "base"		=> "clients_featured",
    "class"		=> "clients_featured",
    "icon"      => "spb-icon-clients-featured",
    "params"	=> array(
    	array(
    	    "type" => "textfield",
    	    "heading" => __("Widget title", "swift-page-builder"),
    	    "param_name" => "title",
    	    "value" => "",
    	    "description" => __("Heading text. Leave it empty if not needed.", "swift-page-builder")
    	),
        array(
            "type" => "select-multiple",
            "heading" => __("Clients category", "swift-page-builder"),
            "param_name" => "category",
            "value" => sf_get_category_list('clients-category'),
            "description" => __("Choose the category for the client items.", "swift-page-builder")
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