<?php

	/* ==================================================
	
	Clients Post Type Functions
	
	================================================== */
	    
	    
	$args = array(
		"label" 						=> _x('Client Categories', 'category label', "swift-framework-admin"), 
		"singular_label" 				=> _x('Client Category', 'category singular label', "swift-framework-admin"), 
	    'public'                        => true,
	    'hierarchical'                  => true,
	    'show_ui'                       => true,
	    'show_in_nav_menus'             => false,
	    'args'                          => array( 'orderby' => 'term_order' ),
	    'rewrite'                       => false,
	    'query_var'                     => true
	);
	
	register_taxonomy( 'clients-category', 'clients', $args );
	
	
	add_action('init', 'clients_register');  
	  
	function clients_register() {  
	
	    $labels = array(
	        'name' => _x('Clients', 'post type general name', "swift-framework-admin"),
	        'singular_name' => _x('Client', 'post type singular name', "swift-framework-admin"),
	        'add_new' => _x('Add New', 'Client', "swift-framework-admin"),
	        'add_new_item' => __('Add New Client', "swift-framework-admin"),
	        'edit_item' => __('Edit Client', "swift-framework-admin"),
	        'new_item' => __('New Client', "swift-framework-admin"),
	        'view_item' => __('View Client', "swift-framework-admin"),
	        'search_items' => __('Search Clients', "swift-framework-admin"),
	        'not_found' =>  __('No clients have been added yet', "swift-framework-admin"),
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
	        'supports' => array('title', 'thumbnail'),
	        'has_archive' => true,
	        'taxonomies' => array('clients-category', 'post_tag')
	       );  
	  
	    register_post_type( 'clients' , $args );  
	}  
	
	add_filter("manage_edit-clients_columns", "clients_edit_columns");   
	  
	function clients_edit_columns($columns){  
	        $columns = array(  
	            "cb" => "<input type=\"checkbox\" />",  
	            "thumbnail" => "",
	            "title" => __("Client", "swift-framework-admin"),
	            "clients-category" => __("Categories", "swift-framework-admin")  
	        );  
	  
	        return $columns;  
	}  

?>