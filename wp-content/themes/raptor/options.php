<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {
	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = 'Raptor';
	
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {
	
	// Test data
	$magpro_slider_start = array("false" => __("No", 'Raptor' ),"true" => __("Yes", 'Raptor' ));
	$homecat_array = array("hori" => __("Horizontal Layout", 'Raptor' ),"verti" => __("Vertical Layout", 'Raptor' ));
	
	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = __("Select a page:", 'Raptor' );
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
		
	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri(). '/admin/images/';
		
	$options = array();
		
		
							
	$options[] = array( "name" => "country1",
						"type" => "innertabopen");	

		$options[] = array( "name" => __("Select a Skin", 'Raptor' ),
							"type" => "groupcontaineropen");	

				$options[] = array( "name" => __("Select a Skin", 'Raptor' ),
										"desc" => __("Please note that default and Raptor skins are same if you are using Raptor theme. If you are using a child theme then default skin will be child theme.", 'Raptor' ),
										"id" => "skin_style",
										"type" => "images",
										"std" => "default",
										"options" => array(
											'raptor' => $imagepath . 'Raptor.png',
											'blue' => $imagepath . 'blue.png',
											'brown' => $imagepath . 'brown.png',
											'green' => $imagepath . 'green.png',
											'orange' => $imagepath . 'orange.png',
											'purple' => $imagepath . 'purple.png',
											'red' => $imagepath . 'red.png',
											'yellow' => $imagepath . 'yellow.png',
											'aqua' => $imagepath . 'aqua.png',
											'bgre' => $imagepath . 'bgre.png',
											'blby' => $imagepath . 'blby.png',
											'blbr' => $imagepath . 'blbr.png',
											'brow' => $imagepath . 'brow.png',
											'yrst' => $imagepath . 'yrst.png',
											'grun' => $imagepath . 'grun.png',
											'kafe' => $imagepath . 'kafe.png',
											'slek' => $imagepath . 'slek.png',
											'krem' => $imagepath . 'krem.png',
											'mead' => $imagepath . 'mead.png',
											'grngy' => $imagepath . 'grngy.png',
											'kopr' => $imagepath . 'kopr.png',
											'marn' => $imagepath . 'marn.png',
											'gree' => $imagepath . 'gree.png',
											'grey' => $imagepath . 'grey.png',
											'brwgrn' => $imagepath . 'brwgrn.png',
											'pnkr' => $imagepath . 'pnkr.png',
											'bkrd' => $imagepath . 'bkrd.png',
											'default' => $imagepath . 'default.png')
										);						

										
		$options[] = array( "type" => "groupcontainerclose");



		$options[] = array( "name" => __("Logo Settings", 'Raptor' ),
							"type" => "groupcontaineropen");	

				$options[] = array( "name" => __("Upload Logo", 'Raptor' ),
									"desc" => __("Upload your logo here. max width 450px, It will replace the blog title and description.", 'Raptor' ),
									"id" => "header_logo",
									"type" => "proupgrade");	
									
				$options[] = array( "name" => __("Upload FavIcon", 'Raptor' ),
									"desc" => __("Upload your favicon here.", 'Raptor' ),
									"id" => "favicon",
									"type" => "proupgrade");														

										
		$options[] = array( "type" => "groupcontainerclose");	
		

		$options[] = array( "name" => __("Adsense Settings", 'Raptor' ),
							"type" => "groupcontaineropen");	

					$options[] = array( "name" => __("Google Adsense ID", 'Raptor' ),
										"desc" => __("Enter your full adsense id. Ex : pub-1234567890", 'Raptor' ),
										"id" => "google_adsense_id",
										"std" => "",
										"type" => "proupgrade");		
										
		$options[] = array( "type" => "groupcontainerclose");	
		
		$options[] = array( "name" => __("Single Page Settings", 'Raptor' ),
							"type" => "groupcontaineropen");
							
					$options[] = array( "name" => __("Show Featured Image?", 'Raptor' ),
										"desc" => __("Select yes if you want to show featured image as header.", 'Raptor' ),
										"id" => "show_featured_image_single",
										"std" => "false",
										"type" => "select",
										"class" => "mini", //mini, tiny, small
										"options" => $magpro_slider_start);	
										
					$options[] = array( "name" => __("Show Ratings?", 'Raptor' ),
										"desc" => __("Select yes if you want to show ratings under post title.", 'Raptor' ),
										"id" => "show_rat_on_single",
										"std" => "true",
										"type" => "select",
										"class" => "mini", //mini, tiny, small
										"options" => $magpro_slider_start);										
										
					$options[] = array( "name" => __("Show Posted by and Date?", 'Raptor' ),
										"desc" => __("Select yes if you want to show Posted by and Date under post title.", 'Raptor' ),
										"id" => "show_pd_on_single",
										"std" => "true",
										"type" => "select",
										"class" => "mini", //mini, tiny, small
										"options" => $magpro_slider_start);											
										
					$options[] = array( "name" => __("Show Categories and Tags?", 'Raptor' ),
										"desc" => __("Select yes if you want to show categories under post title.", 'Raptor' ),
										"id" => "show_cats_on_single",
										"std" => "true",
										"type" => "select",
										"class" => "mini", //mini, tiny, small
										"options" => $magpro_slider_start);	
										
										
					$options[] = array( "name" => __("Show Social Share Buttons?", 'Raptor' ),
										"desc" => __("Select yes if you want to show social buttons under post title.", 'Raptor' ),
										"id" => "show_socialbuts_on_single",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);																	

					$options[] = array( "name" => __("Show Author Bio", 'Raptor' ),
										"desc" => __("Select yes if you want to show Author Bio Box on single post page.", 'Raptor' ),
										"id" => "show_author_bio",
										"std" => "true",
										"type" => "select",
										"class" => "mini", //mini, tiny, small
										"options" => $magpro_slider_start);	
										
					$options[] = array( "name" => __("Show RSS Box", 'Raptor' ),
										"desc" => __("Select yes if you want to show RSS box on single post page.", 'Raptor' ),
										"id" => "show_rss_box",
										"std" => "true",
										"type" => "select",
										"options" => $magpro_slider_start);		
										
					$options[] = array( "name" => __("Show Social Box", 'Raptor' ),
										"desc" => __("Select yes if you want to show social box on single post page.", 'Raptor' ),
										"id" => "show_social_box",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);	
										
					$options[] = array( "name" => __("Show Next/Previous Box", 'Raptor' ),
										"desc" => __("Select yes if you want to show Next/Previous box on single post page.", 'Raptor' ),
										"id" => "show_np_box",
										"std" => "true",
										"type" => "select",
										"class" => "mini", //mini, tiny, small
										"options" => $magpro_slider_start);	
										
					$options[] = array( "name" => __("Show Related Posts Box", 'Raptor' ),
										"desc" => __("Select yes if you want to show Next/Previous box on single post page.", 'Raptor' ),
										"id" => "show_related_box",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);																																								
										
		$options[] = array( "type" => "groupcontainerclose");						
		
		
		
	$options[] = array( "type" => "innertabclose");	


	$options[] = array( "name" => "country2",
						"type" => "innertabopen");	
						
		$options[] = array( "name" => __("Social Settings", 'Raptor' ),
							"type" => "groupcontaineropen");	

					$options[] = array( "name" => __("Twitter", 'Raptor' ),
										"desc" => __("Enter your twitter id. Do not enter the twitter url, Enter only the id.", 'Raptor' ),
										"id" => "twitter_id",
										"std" => "",
										"type" => "text");

					$options[] = array( "name" => __("Redditt", 'Raptor' ),
										"desc" => __("Enter your reddit url", 'Raptor' ),
										"id" => "redit_id",
										"std" => "",
										"type" => "text");

					$options[] = array( "name" => __("Delicious", 'Raptor' ),
										"desc" => __("Enter your delicious url", 'Raptor' ),
										"id" => "delicious_id",
										"std" => "",
										"type" => "text");

					$options[] = array( "name" => __("Technorati", 'Raptor' ),
										"desc" => __("Enter your technorati url", 'Raptor' ),
										"id" => "technorati_id",
										"std" => "",
										"type" => "text");

					$options[] = array( "name" => __("Facebook", 'Raptor' ),
										"desc" => __("Enter your facebook url", 'Raptor' ),
										"id" => "facebook_id",
										"std" => "",
										"type" => "text");

					$options[] = array( "name" => __("Stumble", 'Raptor' ),
										"desc" => __("Enter your stumbleupon url", 'Raptor' ),
										"id" => "stumble_id",
										"std" => "",
										"type" => "text");

					$options[] = array( "name" => __("Youtube", 'Raptor' ),
										"desc" => __("Enter your youtube url", 'Raptor' ),
										"id" => "youtube_id",
										"std" => "",
										"type" => "text");

					$options[] = array( "name" => __("Flickr", 'Raptor' ),
										"desc" => __("Enter your flickr url", 'Raptor' ),
										"id" => "flickr_id",
										"std" => "",
										"type" => "text");

					$options[] = array( "name" => __("LinkedIn", 'Raptor' ),
										"desc" => __("Enter your linkedin url", 'Raptor' ),
										"id" => "linkedin_id",
										"std" => "",
										"type" => "text");

					$options[] = array( "name" => __("Google", 'Raptor' ),
										"desc" => __("Enter your google url", 'Raptor' ),
										"id" => "google_id",
										"std" => "",
										"type" => "text");

							
		$options[] = array( "type" => "groupcontainerclose");											
														
	$options[] = array( "type" => "innertabclose");
	
	
	$options[] = array( "name" => "country3",
						"type" => "innertabopen");	

		$options[] = array( "name" => __("Slider Settings", 'Raptor' ),
							"type" => "groupcontaineropen");	

					$options[] = array( "name" => __("Select Category", 'Raptor' ),
										"desc" => __("Posts from this category will be shown in the slider.", 'Raptor' ),
										"id" => "magpro_slidercat",
										"std" => "true",
										"type" => "select",
										"options" => $options_categories);
					
					$options[] = array( "name" => __("Show slider on homepage", 'Raptor' ),
										"desc" => __("Select yes if you want to show slider on homepage.", 'Raptor' ),
										"id" => "show_magpro_slider_home",
										"std" => "true",
										"type" => "select",
										"class" => "mini", //mini, tiny, small
										"options" => $magpro_slider_start);
										
					$options[] = array( "name" => __("Show slider on Single post page", 'Raptor' ),
										"desc" => __("Select yes if you want to show slider on Single post page.", 'Raptor' ),
										"id" => "show_magpro_slider_single",
										"std" => "false",
										"type" => "select",
										"class" => "mini", //mini, tiny, small
										"options" => $magpro_slider_start);	
										
					$options[] = array( "name" => __("Show slider on Pages", 'Raptor' ),
										"desc" => __("Select yes if you want to show slider on Pages.", 'Raptor' ),
										"id" => "show_magpro_slider_page",
										"std" => "false",
										"type" => "select",
										"class" => "mini", //mini, tiny, small
										"options" => $magpro_slider_start);	
										
					$options[] = array( "name" => __("Show slider on Category Pages", 'Raptor' ),
										"desc" => __("Select yes if you want to show slider on Category Pages.", 'Raptor' ),
										"id" => "show_magpro_slider_archive",
										"std" => "false",
										"type" => "select",
										"class" => "mini", //mini, tiny, small
										"options" => $magpro_slider_start);																														
					
					$options[] = array( "name" => __("Auto Start?", 'Raptor' ),
										"desc" => __("Select yes if you want the slider to start scrolling automaticaly on page load. Only applies to Accordian and Botique sliders.", 'Raptor' ),
										"id" => "magpro_slider_auto",
										"std" => "false",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);
										
					$options[] = array( "name" => __("How many slides?", 'Raptor' ),
										"desc" => __("Enter a number. Ex: 5 or 7", 'Raptor' ),
										"id" => "magpro_slidernumposts",
										"std" => "5",
										"class" => "mini",
										"type" => "text");										

					$options[] = array( "name" => __("Pause Duration", 'Raptor' ),
										"desc" => __("Time between slide changes. 1000 is 1 Second", 'Raptor' ),
										"id" => "magpro_slider_time",
										"std" => "7000",
										"type" => "proupgrade");
										
					$options[] = array( "name" => __("Select a Slider", 'Raptor' ),
										"desc" => __("Type of slider to use", 'Raptor' ),
										"id" => "magpro_slider",
										"std" => "cheader",
										"type" => "images",
										"options" => array(
											'wilto' => $imagepath . 'wilto.png',
											'cheader' => $imagepath . 'cheader.png')
										);										

										
		$options[] = array( "type" => "groupcontainerclose");	
		
		$options[] = array( "name" => __("Sliders Available in PRO Version", 'Raptor' ),
							"type" => "groupcontaineropen");	

					$options[] = array( "name" => __("Upgrade now for these Sliders", 'Raptor' ),
										"desc" => __("Available in PRO", 'Raptor' ),
										"id" => "magpro_slider_upgrade",
										"std" => "anything",
										"type" => "proimages",
										"options" => array(
											'nivo' => $imagepath . 'nivo.png',
											'camera' => $imagepath . 'camera.png',
											'piecemaker' => $imagepath . 'piecemaker.png',
											'accordian' => $imagepath . 'accordian.png',
											'boutique' => $imagepath . 'boutique.png',	
											'videoboutique' => $imagepath . 'boutiquevid.png',	
											'ken' => $imagepath . 'ken.png',
											'ruby' => $imagepath . 'ruby.png',	
											'wilto' => $imagepath . 'wilto.png',																							
											'wiltovideo' => $imagepath . 'wiltovid.png')
										);				

										
		$options[] = array( "type" => "groupcontainerclose");								
						
	$options[] = array( "type" => "innertabclose");	
	
								

	$options[] = array( "name" => "country4",
						"type" => "innertabopen");
						
		$options[] = array( "name" => __("Layout Settings", 'Raptor' ),
							"type" => "groupcontaineropen");	

					$options[] = array( "name" => __("Select a homepage layout", 'Raptor' ),
										"desc" => __("Images for layout.", 'Raptor' ),
										"id" => "homepage_layout",
										"std" => "magnine",
										"type" => "images",
										"options" => array(
											'magnine' => $imagepath . 'magnine.png',
											'standard' => $imagepath . 'standard.png')
										);					

										
		$options[] = array( "type" => "groupcontainerclose");		
		
		$options[] = array( "name" => __("Layouts Available in PRO", 'Raptor' ),
							"type" => "groupcontaineropen");	

					$options[] = array( "name" => __("Upgrade now for these layouts.", 'Raptor' ),
										"desc" => __("UpGrade Now.", 'Raptor' ),
										"id" => "homepage_layout_upgrade",
										"std" => "",
										"type" => "proimages",
										"options" => array(
											'magpro' => $imagepath . 'magpro.png',
											'magvideo' => $imagepath . 'magvid.png',											
											'maglite' => $imagepath . 'maglite.png',
											'mag' => $imagepath . 'mag.png',
											'magthree' => $imagepath . 'magthree.png',
											'magfour' => $imagepath . 'magfour.png',
											'magfive' => $imagepath . 'magfive.png',
											'magsix' => $imagepath . 'magsix.png',
											'magseven' => $imagepath . 'magseven.png',
											'mageight' => $imagepath . 'mageight.png',
											'standard' => $imagepath . 'standard.png')
										);					

										
		$options[] = array( "type" => "groupcontainerclose");								
						
	$options[] = array( "type" => "innertabclose");		
	
	$options[] = array( "name" => "country6",
						"type" => "innertabopen");

		$options[] = array( "name" => __("MagPro Settings", 'Raptor' ),
							"type" => "tabheading");

	
		
		$options[] = array( "name" => __("Recent Posts", 'Raptor' ),
							"type" => "groupcontaineropen");	


					$options[] = array( "name" => __("How Many Recent Posts?", 'Raptor' ),
										"desc" => __("Enter a number like 7 or 10", 'Raptor' ),
										"id" => "magpro_recent_posts_num",
										"std" => "10",
										"type" => "proupgrade");
										
		$options[] = array( "type" => "groupcontainerclose");			
		
		$options[] = array( "name" => __("Video Settings", 'Raptor' ),
							"type" => "groupcontaineropen");	

					$options[] = array( "name" => __("Show Videos", 'Raptor' ),
										"desc" => __("Select yes if you want to show videos.", 'Raptor' ),
										"id" => "magpro_show_videos",
										"std" => "false",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);

					$options[] = array( "name" => __("Select a Category", 'Raptor' ),
										"desc" => __("For posts in this category, You need to create a custom field called video and enter the url to video in its value field", 'Raptor' ),
										"id" => "magpro_show_videos_cat",
										"type" => "proupgrade",
										"options" => $options_categories);


					$options[] = array( "name" => __("How many Videos", 'Raptor' ),
										"desc" => __("How many Videos would you like to show.", 'Raptor' ),
										"id" => "magpro_show_videos_num",
										"std" => "3",
										"type" => "proupgrade");
										
		$options[] = array( "type" => "groupcontainerclose");	
		
		$options[] = array( "name" => __("Top Rated/Most Popular", 'Raptor' ),
							"type" => "groupcontaineropen");	

					$options[] = array( "name" => __("Show Top Rated/Most popular box ?", 'Raptor' ),
										"desc" => __("Select yes or no", 'Raptor' ),
										"id" => "magpro_show_mostbox",
										"std" => "false",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);


					$options[] = array( "name" => __("How many Posts", 'Raptor' ),
										"desc" => __("How many posts would you like to show.", 'Raptor' ),
										"id" => "magpro_show_mostboxnum",
										"std" => "10",
										"type" => "proupgrade");
										
		$options[] = array( "type" => "groupcontainerclose");	
		
		$options[] = array( "name" => __("Gallery", 'Raptor' ),
							"type" => "groupcontaineropen");	

					$options[] = array( "name" => __("Show Gallery?", 'Raptor' ),
										"desc" => __("Select yes or no", 'Raptor' ),
										"id" => "magpro_show_gallery",
										"std" => "false",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);

					$options[] = array( "name" => __("Which Gallery?", 'Raptor' ),
										"desc" => __("Enter the gallery ID", 'Raptor' ),
										"id" => "magpro_galid",
										"std" => "",
										"type" => "proupgrade");


					$options[] = array( "name" => __("How many Images?", 'Raptor' ),
										"desc" => __("Enter the number of images you would like to show", 'Raptor' ),
										"id" => "magpro_galnum",
										"std" => "10",
										"type" => "proupgrade");
										
		$options[] = array( "type" => "groupcontainerclose");	
		
		$options[] = array( "name" => __("Category Boxes", 'Raptor' ),
							"type" => "groupcontaineropen");	

					$options[] = array( "name" => __("Show Category Boxes", 'Raptor' ),
										"desc" => __("Select yes or no", 'Raptor' ),
										"id" => "magpro_show_catbox",
										"std" => "false",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);

					$options[] = array( "name" => __("Which Layout", 'Raptor' ),
										"desc" => __("Select horizontal or vertical", 'Raptor' ),
										"id" => "magpro_show_catbox_which",
										"std" => "hori",
										"type" => "proupgrade",
										"options" => $homecat_array);


					$options[] = array( "name" => __("Which Categories?", 'Raptor' ),
										"desc" => __("Enter the category ID's seperated by comma. Ex : 1, 7, 20", 'Raptor' ),
										"id" => "magpro_catbox_id",
										"std" => "",
										"type" => "proupgrade");
										
					$options[] = array( "name" => __("How many posts per box?", 'Raptor' ),
										"desc" => __("Enter a number. Ex : 1, 7, 20", 'Raptor' ),
										"id" => "magpro_catbox_num",
										"std" => "7",
										"type" => "proupgrade");										
										
		$options[] = array( "type" => "groupcontainerclose");						
		
									
						
	$options[] = array( "type" => "innertabclose");		


	$options[] = array( "name" => "country12",
						"type" => "innertabopen");
		
		$options[] = array( "name" => __("Video Mag Settings", 'Raptor' ),
							"type" => "tabheading");
		
						
	
		
		$options[] = array( "name" => __("Recent Tab Settings", 'Raptor' ),
							"type" => "groupcontaineropen");	
										
					$options[] = array( "name" => __("Show Recent Videos Tab?", 'Raptor' ),
										"desc" => __("Select yes if you want to show Recent Videos tab in the homepage", 'Raptor' ),
										"id" => "video_mag_recent",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);	

					$options[] = array( "name" => __("How many posts?", 'Raptor' ),
										"desc" => __("Enter a number. Ex : 1, 7, 20", 'Raptor' ),
										"id" => "video_mag_recent_num",
										"std" => "7",
										"type" => "proupgrade");

					$options[] = array( "name" => __("Select the Layout Type", 'Raptor' ),
										"desc" => __("Images for layout.", 'Raptor' ),
										"id" => "video_mag_recent_layout",
										"std" => "vidrecentone",
										"type" => "proupgrade",
										"options" => array(
											'vidrecentone' => $imagepath . 'vidone.png',
											'vidrecenttwo' => $imagepath . 'vidtwo.png',
											'vidrecentthree' => $imagepath . 'vidthree.png',
											'vidrecentfour' => $imagepath . 'vidfour.png')
										);																								
										
		$options[] = array( "type" => "groupcontainerclose");	
		
		$options[] = array( "name" => __("Top Rated Settings", 'Raptor' ),
							"type" => "groupcontaineropen");	
										
					$options[] = array( "name" => __("Show Top Rated Videos Tab?", 'Raptor' ),
										"desc" => __("Select yes if you want to show Top Rated Videos tab in the homepage", 'Raptor' ),
										"id" => "video_mag_toprated",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);	

					$options[] = array( "name" => __("How many posts?", 'Raptor' ),
										"desc" => __("Enter a number. Ex : 1, 7, 20", 'Raptor' ),
										"id" => "video_mag_toprated_num",
										"std" => "7",
										"type" => "proupgrade");

					$options[] = array( "name" => __("Select the Layout Type", 'Raptor' ),
										"desc" => __("Images for layout.", 'Raptor' ),
										"id" => "video_mag_toprated_layout",
										"std" => "vidtopratedone",
										"type" => "proupgrade",
										"options" => array(
											'vidtopratedone' => $imagepath . 'vidone.png',
											'vidtopratedtwo' => $imagepath . 'vidtwo.png',
											'vidtopratedthree' => $imagepath . 'vidthree.png',
											'vidtopratedfour' => $imagepath . 'vidfour.png')
										);																								
										
		$options[] = array( "type" => "groupcontainerclose");		
		
		$options[] = array( "name" => __("Most Popular Settings", 'Raptor' ),
							"type" => "groupcontaineropen");	
										
					$options[] = array( "name" => __("Show Top Rated Videos Tab?", 'Raptor' ),
										"desc" => __("Select yes if you want to show Top Rated Videos tab in the homepage", 'Raptor' ),
										"id" => "video_mag_most",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);	

					$options[] = array( "name" => __("How many posts?", 'Raptor' ),
										"desc" => __("Enter a number. Ex : 1, 7, 20", 'Raptor' ),
										"id" => "video_mag_most_num",
										"std" => "7",
										"type" => "proupgrade");

					$options[] = array( "name" => __("Select the Layout Type", 'Raptor' ),
										"desc" => __("Images for layout.", 'Raptor' ),
										"id" => "video_mag_most_layout",
										"std" => "vidmostone",
										"type" => "proupgrade",
										"options" => array(
											'vidmostone' => $imagepath . 'vidone.png',
											'vidmosttwo' => $imagepath . 'vidtwo.png',
											'vidmostthree' => $imagepath . 'vidthree.png',
											'vidmostfour' => $imagepath . 'vidfour.png')
										);																							
										
		$options[] = array( "type" => "groupcontainerclose");			
		
		$options[] = array( "name" => __("Favourite Tab Settings", 'Raptor' ),
							"type" => "groupcontaineropen");	
										
					$options[] = array( "name" => __("Show Favourite Videos Tab?", 'Raptor' ),
										"desc" => __("Select yes if you want to show Favourite Videos tab in the homepage", 'Raptor' ),
										"id" => "video_mag_fav",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);	
										
					$options[] = array( "name" => __("Select Category", 'Raptor' ),
										"desc" => __("Posts from this category will be shown in the Favourites tab.", 'Raptor' ),
										"id" => "video_mag_fav_cat",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $options_categories);

					$options[] = array( "name" => __("How many posts?", 'Raptor' ),
										"desc" => __("Enter a number. Ex : 1, 7, 20", 'Raptor' ),
										"id" => "video_mag_fav_num",
										"std" => "7",
										"type" => "proupgrade");

					$options[] = array( "name" => __("Select the Layout Type", 'Raptor' ),
										"desc" => __("Images for layout.", 'Raptor' ),
										"id" => "video_mag_fav_layout",
										"std" => "vidfavone",
										"type" => "proupgrade",
										"options" => array(
											'vidfavone' => $imagepath . 'vidone.png',
											'vidfavtwo' => $imagepath . 'vidtwo.png',
											'vidfavthree' => $imagepath . 'vidthree.png',
											'vidfavfour' => $imagepath . 'vidfour.png')
										);																					
										
		$options[] = array( "type" => "groupcontainerclose");		
									
		$options[] = array( "name" => __("Category Boxes", 'Raptor' ),
							"type" => "groupcontaineropen");	

					$options[] = array( "name" => __("Show Category Boxes", 'Raptor' ),
										"desc" => __("Select yes or no", 'Raptor' ),
										"id" => "video_mag_show_catbox",
										"std" => "false",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);

					$options[] = array( "name" => __("Which Categories?", 'Raptor' ),
										"desc" => __("Enter the category ID's seperated by comma. Ex : 1, 7, 20", 'Raptor' ),
										"id" => "video_mag_catbox_id",
										"std" => "",
										"type" => "proupgrade");
										
					$options[] = array( "name" => __("How many posts per box?", 'Raptor' ),
										"desc" => __("Enter a number. Ex : 1, 7, 20", 'Raptor' ),
										"id" => "video_mag_catbox_num",
										"std" => "2",
										"type" => "proupgrade");										
										
		$options[] = array( "type" => "groupcontainerclose");		

						
	$options[] = array( "type" => "innertabclose");	

	
	$options[] = array( "name" => "country7",
						"type" => "innertabopen");
						
		$options[] = array( "name" => __("Mag Settings", 'Raptor' ),
							"type" => "groupcontaineropen");	

					$options[] = array( "name" => __("Show Ratings?", 'Raptor' ),
										"desc" => __("Select yes if you want to show ratings", 'Raptor' ),
										"id" => "show_ratings_mag",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);	
										
					$options[] = array( "name" => __("Show Thumbnail?", 'Raptor' ),
										"desc" => __("Select yes if you want to show thumbnail in the post", 'Raptor' ),
										"id" => "show_postthumbnail_mag",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);														

										
		$options[] = array( "type" => "groupcontainerclose");								
						
	$options[] = array( "type" => "innertabclose");	
	
	$options[] = array( "name" => "country8",
						"type" => "innertabopen");
						
		$options[] = array( "name" => __("MagLite Settings", 'Raptor' ),
							"type" => "groupcontaineropen");	

					$options[] = array( "name" => __("Show Ratings?", 'Raptor' ),
										"desc" => __("Select yes if you want to show ratings", 'Raptor' ),
										"id" => "show_ratings_maglite",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);	
										
					$options[] = array( "name" => __("Show Thumbnail?", 'Raptor' ),
										"desc" => __("Select yes if you want to show thumbnail in the post", 'Raptor' ),
										"id" => "show_postthumbnail_maglite",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);														

										
		$options[] = array( "type" => "groupcontainerclose");								
						
	$options[] = array( "type" => "innertabclose");	
	
	
	
	
	
	$options[] = array( "name" => "country13",
						"type" => "innertabopen");
						
		$options[] = array( "name" => __("MagThree Settings", 'Raptor' ),
							"type" => "groupcontaineropen");	

					$options[] = array( "name" => __("Show Ratings?", 'Raptor' ),
										"desc" => __("Select yes if you want to show ratings", 'Raptor' ),
										"id" => "show_ratings_magthree",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);	
										
					$options[] = array( "name" => __("Show Thumbnail?", 'Raptor' ),
										"desc" => __("Select yes if you want to show thumbnail in the post", 'Raptor' ),
										"id" => "show_postthumbnail_magthree",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);														

										
		$options[] = array( "type" => "groupcontainerclose");								
						
	$options[] = array( "type" => "innertabclose");	
	
	$options[] = array( "name" => "country14",
						"type" => "innertabopen");
						
		$options[] = array( "name" => __("MagFour Settings", 'Raptor' ),
							"type" => "groupcontaineropen");	

					$options[] = array( "name" => __("Show Ratings?", 'Raptor' ),
										"desc" => __("Select yes if you want to show ratings", 'Raptor' ),
										"id" => "show_ratings_magfour",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);	
										
					$options[] = array( "name" => __("Show Thumbnail?", 'Raptor' ),
										"desc" => __("Select yes if you want to show thumbnail in the post", 'Raptor' ),
										"id" => "show_postthumbnail_magfour",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);														

										
		$options[] = array( "type" => "groupcontainerclose");								
						
	$options[] = array( "type" => "innertabclose");		
	
	$options[] = array( "name" => "country15",
						"type" => "innertabopen");
						
		$options[] = array( "name" => __("MagFive Settings", 'Raptor' ),
							"type" => "groupcontaineropen");	

					$options[] = array( "name" => __("Show Ratings?", 'Raptor' ),
										"desc" => __("Select yes if you want to show ratings", 'Raptor' ),
										"id" => "show_ratings_magfive",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);	
										
					$options[] = array( "name" => __("Show Thumbnail?", 'Raptor' ),
										"desc" => __("Select yes if you want to show thumbnail in the post", 'Raptor' ),
										"id" => "show_postthumbnail_magfive",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);														

										
		$options[] = array( "type" => "groupcontainerclose");								
						
	$options[] = array( "type" => "innertabclose");	
	
	$options[] = array( "name" => "country16",
						"type" => "innertabopen");
						
		$options[] = array( "name" => __("MagSix Settings", 'Raptor' ),
							"type" => "groupcontaineropen");	

					$options[] = array( "name" => __("Show Ratings?", 'Raptor' ),
										"desc" => __("Select yes if you want to show ratings", 'Raptor' ),
										"id" => "show_ratings_magsix",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);	
										
					$options[] = array( "name" => __("Show Thumbnail?", 'Raptor' ),
										"desc" => __("Select yes if you want to show thumbnail in the post", 'Raptor' ),
										"id" => "show_postthumbnail_magsix",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);														

										
		$options[] = array( "type" => "groupcontainerclose");								
						
	$options[] = array( "type" => "innertabclose");
	
	$options[] = array( "name" => "country17",
						"type" => "innertabopen");
						
		$options[] = array( "name" => __("MagSeven Settings", 'Raptor' ),
							"type" => "tabheading");
		
		
		$options[] = array( "name" => __("Recent Posts Settings", 'Raptor' ),
							"type" => "groupcontaineropen");	

					$options[] = array( "name" => __("Show Ratings?", 'Raptor' ),
										"desc" => __("Select yes if you want to show ratings", 'Raptor' ),
										"id" => "show_ratings_magseven",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);	
										
					$options[] = array( "name" => __("Show Thumbnail?", 'Raptor' ),
										"desc" => __("Select yes if you want to show thumbnail in the post", 'Raptor' ),
										"id" => "show_postthumbnail_magseven",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);																			

										
		$options[] = array( "type" => "groupcontainerclose");	
		
		$options[] = array( "name" => __("Category Box Settings", 'Raptor' ),
							"type" => "groupcontaineropen");	

					$options[] = array( "name" => __("Show Ratings?", 'Raptor' ),
										"desc" => __("Select yes if you want to show ratings", 'Raptor' ),
										"id" => "show_ratings_magseven_cat",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);	
										
					$options[] = array( "name" => __("Which categories in left sidebar?", 'Raptor' ),
										"desc" => __("Enter the category ID's seperated by comma. Ex : 1, 7, 20", 'Raptor' ),
										"id" => "magseven_catbox_id",
										"std" => "",
										"type" => "proupgrade");	
										
					$options[] = array( "name" => __("How many Posts per Category?", 'Raptor' ),
										"desc" => __("Enter the number of posts per category you would like to show", 'Raptor' ),
										"id" => "magseven_catbox_num",
										"std" => "7",
										"type" => "proupgrade");																											

										
		$options[] = array( "type" => "groupcontainerclose");									
						
	$options[] = array( "type" => "innertabclose");	
	
	$options[] = array( "name" => "country18",
						"type" => "innertabopen");
						
		$options[] = array( "name" => __("MagEight Settings", 'Raptor' ),
							"type" => "tabheading");
		
		
		$options[] = array( "name" => __("Recent Posts Settings", 'Raptor' ),
							"type" => "groupcontaineropen");	

					$options[] = array( "name" => __("Show Ratings?", 'Raptor' ),
										"desc" => __("Select yes if you want to show ratings", 'Raptor' ),
										"id" => "show_ratings_mageight",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);	
										
					$options[] = array( "name" => __("Show Thumbnail?", 'Raptor' ),
										"desc" => __("Select yes if you want to show thumbnail in the post", 'Raptor' ),
										"id" => "show_postthumbnail_mageight",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);																			

										
		$options[] = array( "type" => "groupcontainerclose");	
		
		$options[] = array( "name" => __("Category Box Settings", 'Raptor' ),
							"type" => "groupcontaineropen");	

					$options[] = array( "name" => __("Show Ratings?", 'Raptor' ),
										"desc" => __("Select yes if you want to show ratings", 'Raptor' ),
										"id" => "show_ratings_mageight_cat",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);	
										
					$options[] = array( "name" => __("Which categories in left sidebar?", 'Raptor' ),
										"desc" => __("Enter the category ID's seperated by comma. Ex : 1, 7, 20", 'Raptor' ),
										"id" => "mageight_catbox_id",
										"std" => "",
										"type" => "proupgrade");	
										
					$options[] = array( "name" => __("How many Posts per Category?", 'Raptor' ),
										"desc" => __("Enter the number of posts per category you would like to show", 'Raptor' ),
										"id" => "mageight_catbox_num",
										"std" => "7",
										"type" => "proupgrade");																											

										
		$options[] = array( "type" => "groupcontainerclose");								
						
	$options[] = array( "type" => "innertabclose");			
	
	$options[] = array( "name" => "country19",
						"type" => "innertabopen");
						
		$options[] = array( "name" => __("MagNine Settings", 'Raptor' ),
							"type" => "tabheading");
		
		
		$options[] = array( "name" => __("Recent Posts Settings", 'Raptor' ),
							"type" => "groupcontaineropen");	

					$options[] = array( "name" => __("Show Ratings?", 'Raptor' ),
										"desc" => __("Select yes if you want to show ratings", 'Raptor' ),
										"id" => "show_ratings_magnine",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);	
										
					$options[] = array( "name" => __("Show Thumbnail?", 'Raptor' ),
										"desc" => __("Select yes if you want to show thumbnail in the post", 'Raptor' ),
										"id" => "show_postthumbnail_magnine",
										"std" => "true",
										"type" => "select",
										"class" => "mini", //mini, tiny, small
										"options" => $magpro_slider_start);																			

										
		$options[] = array( "type" => "groupcontainerclose");	
		
		$options[] = array( "name" => __("Category Box Settings", 'Raptor' ),
							"type" => "groupcontaineropen");	

					$options[] = array( "name" => __("Show Ratings?", 'Raptor' ),
										"desc" => __("Select yes if you want to show ratings", 'Raptor' ),
										"id" => "show_ratings_magnine_cat",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);	
										
					$options[] = array( "name" => __("Which categories in left sidebar?", 'Raptor' ),
										"desc" => __("Enter the category ID's seperated by comma. Ex : 1, 7, 20", 'Raptor' ),
										"id" => "magnine_catbox_id",
										"std" => "",
										"type" => "text");	
										
					$options[] = array( "name" => __("How many Posts per Category?", 'Raptor' ),
										"desc" => __("Enter the number of posts per category you would like to show", 'Raptor' ),
										"id" => "magnine_catbox_num",
										"std" => "7",
										"type" => "proupgrade");																											

										
		$options[] = array( "type" => "groupcontainerclose");									
						
	$options[] = array( "type" => "innertabclose");		
	
	
	
	$options[] = array( "name" => "country9",
						"type" => "innertabopen");
						
		$options[] = array( "name" => __("Standard Blog Settings", 'Raptor' ),
							"type" => "groupcontaineropen");	

					$options[] = array( "name" => __("Show Ratings?", 'Raptor' ),
										"desc" => __("Select yes if you want to show ratings", 'Raptor' ),
										"id" => "show_ratings_standard",
										"std" => "true",
										"type" => "select",
										"class" => "mini", //mini, tiny, small
										"options" => $magpro_slider_start);		
										
					$options[] = array( "name" => __("Show Categories/Tags?", 'Raptor' ),
										"desc" => __("Select yes if you want to show categories and tags in posts", 'Raptor' ),
										"id" => "show_ctags_standard",
										"std" => "true",
										"type" => "select",
										"class" => "mini", //mini, tiny, small
										"options" => $magpro_slider_start);														

										
		$options[] = array( "type" => "groupcontainerclose");								
						
	$options[] = array( "type" => "innertabclose");	
	
	$options[] = array( "name" => "country5",
						"type" => "innertabopen");
						
		$options[] = array( "name" => __("Sidebar Settings", 'Raptor' ),
							"type" => "tabheading");
			
		
		$options[] = array( "name" => __("Sidebar Ad Settings", 'Raptor' ),
							"type" => "groupcontaineropen");	

					$options[] = array( "name" => __("Show 300x250 ads in sidebar?", 'Raptor' ),
										"desc" => __("Select yes if you want to show 300x250 ads in sidebar. If you select yes, go to widgets page and drag/drop the ads", 'Raptor' ),
										"id" => "show_sidebar_ads",
										"std" => "false",
										"type" => "select",
										"class" => "mini", //mini, tiny, small
										"options" => $magpro_slider_start);		
										
					$options[] = array( "name" => __("Show 125x125 ads in sidebar?", 'Raptor' ),
										"desc" => __("Select yes if you want to show 125x125 ads in sidebar. If you select yes, go to widgets page and drag/drop the ads", 'Raptor' ),
										"id" => "show_sidebar_ads_onetwofive",
										"std" => "false",
										"type" => "select",
										"class" => "mini", //mini, tiny, small
										"options" => $magpro_slider_start);											
										
		$options[] = array( "type" => "groupcontainerclose");	
		
		$options[] = array( "name" => __("Feedburner Settings", 'Raptor' ),
							"type" => "groupcontaineropen");	

					$options[] = array( "name" => __("Show feedburner?", 'Raptor' ),
										"desc" => __("Select yes if you want to show feedburner in sidebar.", 'Raptor' ),
										"id" => "show_feedburner",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);
										
					$options[] = array( "name" => __("Feedburner Id", 'Raptor' ),
										"desc" => __("Enter your feedburner id", 'Raptor' ),
										"id" => "feedburner_id",
										"std" => "",
										"type" => "proupgrade");																												
																				
		$options[] = array( "type" => "groupcontainerclose");
		
		$options[] = array( "name" => __("Social Settings", 'Raptor' ),
							"type" => "groupcontaineropen");	

										
					$options[] = array( "name" => __("Show Twitter Updates?", 'Raptor' ),
										"desc" => __("Select yes if you want to show twitter updates in sidebar.", 'Raptor' ),
										"id" => "show_twitter_updates",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);																												
																				
		$options[] = array( "type" => "groupcontainerclose");		
		
		$options[] = array( "name" => __("Video Settings", 'Raptor' ),
							"type" => "groupcontaineropen");	

					$options[] = array( "name" => __("Show Videos in sidebar?", 'Raptor' ),
										"desc" => __("Select yes if you want to show videos in sidebar.", 'Raptor' ),
										"id" => "sidebar_show_videos",
										"std" => "false",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);

					$options[] = array( "name" => __("Select a Category", 'Raptor' ),
										"desc" => __("For posts in this category, You need to create a custom field called video and enter the url to video in its value field", 'Raptor' ),
										"id" => "sidebar_show_videos_cat",
										"type" => "proupgrade",
										"options" => $options_categories);


					$options[] = array( "name" => __("How many Videos", 'Raptor' ),
										"desc" => __("How many Videos would you like to show.", 'Raptor' ),
										"id" => "sidebar_show_videos_num",
										"std" => "3",
										"type" => "proupgrade");
										
		$options[] = array( "type" => "groupcontainerclose");	
		
		$options[] = array( "name" => __("Top Rated/Most Popular", 'Raptor' ),
							"type" => "groupcontaineropen");	

					$options[] = array( "name" => __("Show Top Rated/Most popular box in sidebar?", 'Raptor' ),
										"desc" => __("Select yes or no", 'Raptor' ),
										"id" => "sidebar_show_mostbox",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);

					$options[] = array( "name" => __("Select the Layout Type", 'Raptor' ),
										"desc" => __("Images for layout.", 'Raptor' ),
										"id" => "tabboxsidebarlayout",
										"std" => "tabbigthumb",
										"type" => "proupgrade",
										"options" => array(
											'tabbigthumb' => $imagepath . 'vidone.png',
											'tabsmallthumb' => $imagepath . 'vidfour.png')
										);	

					$options[] = array( "name" => __("How many posts", 'Raptor' ),
										"desc" => __("How many posts would you like to show.", 'Raptor' ),
										"id" => "sidebar_show_mostboxnum",
										"std" => "10",
										"type" => "proupgrade");
										
		$options[] = array( "type" => "groupcontainerclose");	
		
		$options[] = array( "name" => __("Polls", 'Raptor' ),
							"type" => "groupcontaineropen");	

					$options[] = array( "name" => __("Show Polls?", 'Raptor' ),
										"desc" => __("Select yes or no", 'Raptor' ),
										"id" => "sidebar_show_poll",
										"std" => "false",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);


					$options[] = array( "name" => __("Which Poll?", 'Raptor' ),
										"desc" => __("Enter the poll ID", 'Raptor' ),
										"id" => "sidebar_show_poll_id",
										"std" => "",
										"type" => "proupgrade");
										
		$options[] = array( "type" => "groupcontainerclose");												
						
	$options[] = array( "type" => "innertabclose");		
	
	$options[] = array( "name" => "country10",
						"type" => "innertabopen");
						
		$options[] = array( "name" => __("AD Settings", 'Raptor' ),
							"type" => "tabheading");		
		
		$options[] = array( "name" => __("Header Ad Settings", 'Raptor' ),
							"type" => "groupcontaineropen");	

					
					$options[] = array( "name" => __("Show Adsense?", 'Raptor' ),
										"desc" => __("If yes, adsense will be show else enter html adcode below", 'Raptor' ),
										"id" => "show_header_adsense",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);		
										
					$options[] = array( "name" => __("Header Ad code", 'Raptor' ),
										"desc" => __("Enter the html ad code", 'Raptor' ),
										"id" => "header_ad_code",
										"type" => "proupgrade");														

										
		$options[] = array( "type" => "groupcontainerclose");								
						
	$options[] = array( "type" => "innertabclose");	
	
	$options[] = array( "name" => "country11",
						"type" => "innertabopen");
						
		$options[] = array( "name" => __("Footer Settings", 'Raptor' ),
							"type" => "tabheading");		
		
		$options[] = array( "name" => __("Footer Widgets", 'Raptor' ),
							"type" => "groupcontaineropen");	

					$options[] = array( "name" => __("Show footer widgets on homepage?", 'Raptor' ),
										"desc" => __("Select yes if you want to show footer widgets on homepage.", 'Raptor' ),
										"id" => "show_footer_widgets_home",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);
										
					$options[] = array( "name" => __("Show footer widgets on single post pages?", 'Raptor' ),
										"desc" => __("Select yes if you want to show footer widgets on single post pages.", 'Raptor' ),
										"id" => "show_footer_widgets_single",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);	
										
					$options[] = array( "name" => __("Show footer widgets on pages?", 'Raptor' ),
										"desc" => __("Select yes if you want to show footer widgets on pages.", 'Raptor' ),
										"id" => "show_footer_widgets_page",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);		
										
					$options[] = array( "name" => __("Show footer widgets on category pages?", 'Raptor' ),
										"desc" => __("Select yes if you want to show footer widgets on category pages.", 'Raptor' ),
										"id" => "show_footer_widgets_archive",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);																													
																				
		$options[] = array( "type" => "groupcontainerclose");
		
		$options[] = array( "name" => __("Footer Logo", 'Raptor' ),
							"type" => "groupcontaineropen");	

					$options[] = array( "name" => __("Show footer logo?", 'Raptor' ),
										"desc" => __("Select yes if you want to show logo in footer.", 'Raptor' ),
										"id" => "show_footer_logo",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);

				$options[] = array( "name" => __("Upload Logo", 'Raptor' ),
									"desc" => __("Upload your logo here. Max width 250px", 'Raptor' ),
									"id" => "footer_logo",
									"type" => "proupgrade");						

										
		$options[] = array( "type" => "groupcontainerclose");
		
		$options[] = array( "name" => __("Search Box", 'Raptor' ),
							"type" => "groupcontaineropen");	

					$options[] = array( "name" => __("Show search box in footer?", 'Raptor' ),
										"desc" => __("Select yes if you want to show search box in footer.", 'Raptor' ),
										"id" => "show_footer_search",
										"std" => "true",
										"type" => "proupgrade",
										"options" => $magpro_slider_start);						

										
		$options[] = array( "type" => "groupcontainerclose");												
						
	$options[] = array( "type" => "innertabclose");			
							
						

							
		
	return $options;
}