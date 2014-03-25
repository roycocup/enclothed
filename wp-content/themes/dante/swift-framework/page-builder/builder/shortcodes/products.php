<?php

class SwiftPageBuilderShortcode_spb_products_mini extends SwiftPageBuilderShortcode {

    protected function content($atts, $content = null) {

		    $title = $asset_type = $width = $el_class = $output = $items = $el_position = '';
		
	        extract(shortcode_atts(array(
		        'title' => '',
		        'asset_type' => 'best-sellers',
	        	'item_count' => '4',
	        	'category' => '',
	        	'el_position' => '',
	        	'width' => '1/4',
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
    		    		
			/* PRODUCT ITEMS
			================================================== */	
			if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			$items = sf_mini_product_items($asset_type, $category, $item_count, $sidebars, $width);
    		} else {
    		$items = __("Please install/active WooCommerce.", "swift-page-builder");
    		}
    		
    		$el_class = $this->getExtraClass($el_class);
            $width = spb_translateColumnWidthToSpan($width);
            
            $output .= "\n\t".'<div class="product_list_widget woocommerce spb_content_element '.$width.$el_class.'">';
            $output .= "\n\t\t".'<div class="spb_wrapper">';
            $output .= ($title != '' ) ? "\n\t\t\t".'<h3 class="spb-heading"><span>'.$title.'</span></h3>' : '';
            $output .= "\n\t\t\t\t".$items;
            $output .= "\n\t\t".'</div> '.$this->endBlockComment('.spb_wrapper');
            $output .= "\n\t".'</div> '.$this->endBlockComment($width);
    
            $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
            
            global $sf_has_products;
            $sf_has_products = true;
            
            return $output;
		
    }
}

SPBMap::map( 'spb_products_mini', array(
    "name"		=> __("Products (Mini)", "swift-page-builder"),
    "base"		=> "spb_products_mini",
    "class"		=> "spb-products-mini",
    "icon"      => "spb-icon-products-mini",
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
	        "heading" => __("Asset type", "swift-page-builder"),
	        "param_name" => "asset_type",
	        "value" => array(
	        	__('Best Sellers', "swift-page-builder") => "best-sellers",
	        	__('Latest Products', "swift-page-builder") => "latest-products",
	        	__('Top Rated', "swift-page-builder") => "top-rated",
	        	__('Sale Products', "swift-page-builder") => "sale-products",
	        	__('Recently Viewed', "swift-page-builder") => "recently-viewed",
	        	__('Featured Products', "swift-page-builder") => "featured-products"
	        	),
	        "description" => __("Select the order of the products you'd like to show.", "swift-page-builder")
	    ),
	    array(
	        "type" => "textfield",
	        "heading" => __("Product category", "swift-page-builder"),
	        "param_name" => "category",
	        "value" => "",
	        "description" => __("Optionally, provide the category slugs for the products you want to show (comma seperated). i.e. trainer,dress,bag.", "swift-page-builder")
	    ),
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of items", "swift-page-builder"),
            "param_name" => "item_count",
            "value" => "4",
            "description" => __("The number of products to show.", "swift-page-builder")
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


class SwiftPageBuilderShortcode_spb_products extends SwiftPageBuilderShortcode {

    protected function content($atts, $content = null) {

		    $title = $asset_type = $carousel = $product_size = $width = $sidebars = $el_class = $output = $items = $el_position = '';
		
	        extract(shortcode_atts(array(
		        'title' => '',
		        'asset_type' => 'best-sellers',
		        'carousel' => 'no',
		        'product_size' => 'standard',
	        	'item_count' => '8',
	        	'category' => '',
	        	'el_position' => '',
	        	'width' => '1/1',
	        	'el_class' => ''
	        ), $atts));
	        
	   	    		
			/* PRODUCT ITEMS
			================================================== */	
    		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			$items = sf_product_items($asset_type, $category, $carousel, $product_size, $item_count, $width);
    		} else {
    		$items = __("Please install/active WooCommerce.", "swift-page-builder");
    		}
    		
    		$el_class = $this->getExtraClass($el_class);
            $width = spb_translateColumnWidthToSpan($width);
            
            $output .= "\n\t".'<div class="product_list_widget products-'.$product_size.' woocommerce spb_content_element '.$width.$el_class.'">';
            $output .= "\n\t\t".'<div class="spb_wrapper">';
            $output .= ($title != '' ) ? "\n\t\t\t".'<h3 class="spb-heading"><span>'.$title.'</span></h3>' : '';
            $output .= "\n\t\t\t\t".$items;
            $output .= "\n\t\t".'</div> '.$this->endBlockComment('.spb_wrapper');
            $output .= "\n\t".'</div> '.$this->endBlockComment($width);
    
            $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
            
            if ($carousel == "yes") {
            	global $sf_include_carousel;
            	$sf_include_carousel = true;
            	
            }
            global $sf_include_isotope, $sf_has_products;
            $sf_include_isotope = true;
            $sf_has_products = true;

            return $output;
		
    }
}

SPBMap::map( 'spb_products', array(
    "name"		=> __("Products", "swift-page-builder"),
    "base"		=> "spb_products",
    "class"		=> "spb-products",
    "icon"      => "spb-icon-products",
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
	        "heading" => __("Asset type", "swift-page-builder"),
	        "param_name" => "asset_type",
	        "value" => array(
	        	__('Best Sellers', "swift-page-builder") => "best-sellers",
	        	__('Latest Products', "swift-page-builder") => "latest-products",
	        	__('Top Rated', "swift-page-builder") => "top-rated",
	        	__('Sale Products', "swift-page-builder") => "sale-products",
	        	__('Recently Viewed', "swift-page-builder") => "recently-viewed",
	        	__('Featured Products', "swift-page-builder") => "featured-products"
	        	),
	        "description" => __("Select the order of products you'd like to show.", "swift-page-builder")
	    ),
	    array(
	        "type" => "textfield",
	        "heading" => __("Product category", "swift-page-builder"),
	        "param_name" => "category",
	        "value" => "",
	        "description" => __("Optionally, provide the category slugs for the products you want to show (comma seperated). i.e. trainer,dress,bag.", "swift-page-builder")
	    ),
	    array(
	        "type" => "dropdown",
	        "heading" => __("Carousel", "swift-page-builder"),
	        "param_name" => "carousel",
	        "value" => array(
	        	__('Yes', "swift-page-builder") => "yes",
	        	__('No', "swift-page-builder") => "no",
	        	),
	        "description" => __("Select if you'd like the asset to be a carousel.", "swift-page-builder")
	    ),
	    array(
	        "type" => "dropdown",
	        "heading" => __("Product Size", "swift-page-builder"),
	        "param_name" => "product_size",
	        "value" => array(
	        	__('Standard', "swift-page-builder") => "standard",
	        	__('Mini', "swift-page-builder") => "mini",
	        	),
	        "description" => __("Select whether you would like the product size to be standard, or mini. Mini shows 6 products in a row on a page with no sidebars.", "swift-page-builder")
	    ),
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of items", "swift-page-builder"),
            "param_name" => "item_count",
            "value" => "8",
            "description" => __("The number of products to show.", "swift-page-builder")
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