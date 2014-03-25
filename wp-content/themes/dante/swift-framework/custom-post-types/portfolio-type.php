<?php

	/* ==================================================
	
	Portfolio Post Type Functions
	
	================================================== */
	
	$portfolio_permalinks = get_option( 'sf_portfolio_permalinks' );
	
	$args = array(
	    "label" 						=> _x('Portfolio Categories', 'category label', "swift-framework-admin"), 
	    "singular_label" 				=> _x('Portfolio Category', 'category singular label', "swift-framework-admin"), 
	    'public'                        => true,
	    'hierarchical'                  => true,
	    'show_ui'                       => true,
	    'show_in_nav_menus'             => false,
	    'args'                          => array( 'orderby' => 'term_order' ),
		'rewrite' 						=> array(
					    					'slug'         => empty( $portfolio_permalinks['category_base'] ) ? _x( 'portfolio-category', 'slug', 'swift-framework-admin' ) : $portfolio_permalinks['category_base'],
					    					'with_front'   => false,
					    					'hierarchical' => true,
					    	            ),
	    'query_var'                     => true
	);
	
	register_taxonomy( 'portfolio-category', 'portfolio', $args );
	
	    
	add_action('init', 'portfolio_register');  
	  
	function portfolio_register() {
		
		$portfolio_permalinks = get_option( 'sf_portfolio_permalinks' );
		
		$portfolio_permalink = empty( $portfolio_permalinks['portfolio_base'] ) ? _x( 'portfolio', 'slug', 'swift-framework-admin' ) : $portfolio_permalinks['portfolio_base'];
		
	    $labels = array(
	        'name' => _x('Portfolio', 'post type general name', "swift-framework-admin"),
	        'singular_name' => _x('Portfolio Item', 'post type singular name', "swift-framework-admin"),
	        'add_new' => _x('Add New', 'portfolio item', "swift-framework-admin"),
	        'add_new_item' => __('Add New Portfolio Item', "swift-framework-admin"),
	        'edit_item' => __('Edit Portfolio Item', "swift-framework-admin"),
	        'new_item' => __('New Portfolio Item', "swift-framework-admin"),
	        'view_item' => __('View Portfolio Item', "swift-framework-admin"),
	        'search_items' => __('Search Portfolio', "swift-framework-admin"),
	        'not_found' =>  __('No portfolio items have been added yet', "swift-framework-admin"),
	        'not_found_in_trash' => __('Nothing found in Trash', "swift-framework-admin"),
	        'parent_item_colon' => ''
	    );
			
	    $args = array(  
	        'labels' => $labels,  
	        'public' => true,  
	        'show_ui' => true,
	        'show_in_menu' => true,
	        'show_in_nav_menus' => false,
	        'hierarchical' => false,
	        'rewrite' => $portfolio_permalink != "portfolio" ? array(
	        				'slug' => untrailingslashit( $portfolio_permalink ),
	        				'with_front' => false,
	        				'feeds' => true )
	        			: false,
	        'supports' => array('title', 'editor', 'thumbnail'),
	        'has_archive' => true,
	        'taxonomies' => array('portfolio-category')
	       );  
	  
	    register_post_type( 'portfolio' , $args );  
	}  
	
	add_filter("manage_edit-portfolio_columns", "portfolio_edit_columns");   
	  
	function portfolio_edit_columns($columns){  
	        $columns = array(  
	            "cb" => "<input type=\"checkbox\" />",  
	            "thumbnail" => "",
	            "title" => __("Portfolio Item", "swift-framework-admin"),
	            "description" => __("Description", "swift-framework-admin"),
	            "portfolio-category" => __("Categories", "swift-framework-admin") 
	        );  
	  
	        return $columns;  
	}

?>