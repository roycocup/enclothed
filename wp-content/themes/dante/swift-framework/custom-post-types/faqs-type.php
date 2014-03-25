<?php

	/* ==================================================
	
	FAQs Post Type Functions
	
	================================================== */
	    
	    
	$args = array(
	    "label" 						=> _x('Topics', 'category label', "swift-framework-admin"), 
	    "singular_label" 				=> _x('Topic', 'category singular label', "swift-framework-admin"), 
	    'public'                        => true,
	    'hierarchical'                  => true,
	    'show_ui'                       => true,
	    'show_in_nav_menus'             => false,
	    'args'                          => array( 'orderby' => 'term_order' ),
	    'rewrite'                       => false,
	    'query_var'                     => true
	);
	
	register_taxonomy( 'faqs-category', 'faqs', $args );
	
	
	add_action('init', 'faqs_register');  
	  
	function faqs_register() {  
	
	    $labels = array(
	        'name' => _x('FAQs', 'post type general name', "swift-framework-admin"),
	        'singular_name' => _x('Question', 'post type singular name', "swift-framework-admin"),
	        'add_new' => _x('Add New', 'question', "swift-framework-admin"),
	        'add_new_item' => __('Add New Question', "swift-framework-admin"),
	        'edit_item' => __('Edit Question', "swift-framework-admin"),
	        'new_item' => __('New Question', "swift-framework-admin"),
	        'view_item' => __('View Question', "swift-framework-admin"),
	        'search_items' => __('Search Questions', "swift-framework-admin"),
	        'not_found' =>  __('No questions have been added yet', "swift-framework-admin"),
	        'not_found_in_trash' => __('Nothing found in Trash', "swift-framework-admin"),
	        'parent_item_colon' => ''
	    );
	
	    $args = array(  
	        'labels' => $labels,  
	        'public' => true,  
	        'show_ui' => true,
	        'show_in_menu' => true,
	        'show_in_nav_menus' => false,
	        'rewrite' => false,
	        'supports' => array('title', 'editor'),
	        'has_archive' => true,
	        'taxonomies' => array('faqs-category', 'post_tag')
	       );  
	  
	    register_post_type( 'faqs' , $args );  
	}  
	
	add_filter("manage_edit-faqs_columns", "faqs_edit_columns");   
	  
	function faqs_edit_columns($columns){  
	        $columns = array(  
	            "cb" => "<input type=\"checkbox\" />",  
	            "title" => __("Question", "swift-framework-admin"),
	            "description" => __("Answer", "swift-framework-admin"),
	            "faqs-category" => __("Topics", "swift-framework-admin")
	        );  
	  
	        return $columns;  
	}

?>