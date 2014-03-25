<?php
	
	/*
	*
	*	Swift Page Builder - Media Shortcodes Config
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2013 - http://www.swiftideas.net
	*
	*/
	

	/* VIDEO ASSET
	================================================== */ 
	class SwiftPageBuilderShortcode_spb_video extends SwiftPageBuilderShortcode {
	
	    protected function content( $atts, $content = null ) {
	        $title = $link = $size = $el_position = $full_width = $width = $el_class = '';
	        extract(shortcode_atts(array(
	            'title' => '',
	            'link' => '',
	            'size' => ( isset($content_width) ) ? $content_width : 500,
	            'el_position' => '',
	            'width' => '1/1',
	            'full_width' => 'no',
	            'el_class' => ''
	        ), $atts));
	        $output = '';
	
	        if ( $link == '' ) { return null; }
	        $video_h = '';
	        $el_class = $this->getExtraClass($el_class);
	        $width = spb_translateColumnWidthToSpan($width);
	        $size = str_replace(array( 'px', ' ' ), array( '', '' ), $size);
	        $size = explode("x", $size);
	        $video_w = $size[0];
	        if ( count($size) > 1 ) {
	            $video_h = ' height="'.$size[1].'"';
	        }
	
	        global $wp_embed;
	        $embed = $wp_embed->run_shortcode('[embed width="'.$video_w.'"'.$video_h.']'.$link.'[/embed]');
			
			if ($full_width == "yes") {
	        $output .= "\n\t".'<div class="spb_video_widget full-width spb_content_element '.$width.$el_class.'">';
			} else {
	        $output .= "\n\t".'<div class="spb_video_widget spb_content_element '.$width.$el_class.'">';
			}
			
	        $output .= "\n\t\t".'<div class="spb_wrapper">';
	        $output .= ($title != '' ) ? "\n\t\t\t".'<h3 class="spb-heading spb_video_heading"><span>'.$title.'</span></h3>' : '';
	        $output .= $embed;
	        $output .= "\n\t\t".'</div> '.$this->endBlockComment('.spb_wrapper');
	        $output .= "\n\t".'</div> '.$this->endBlockComment($width);
	
	        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
	        return $output;
	    }
	}
	
	SPBMap::map( 'spb_video', array(
	    "name"		=> __("Video Player", "swift-page-builder"),
	    "base"		=> "spb_video",
	    "class"		=> "",
		"icon"		=> "spb-icon-film-youtube",
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
	            "heading" => __("Video link", "swift-page-builder"),
	            "param_name" => "link",
	            "value" => "",
	            "description" => __('Link to the video. More about supported formats at <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">WordPress codex page</a>.', "swift-page-builder")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Video size", "swift-page-builder"),
	            "param_name" => "size",
	            "value" => "",
	            "description" => __('Enter video size in pixels. Example: 200x100 (Width x Height).', "swift-page-builder")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Full width", "swift-page-builder"),
	            "param_name" => "full_width",
	            "value" => array(__('No', "swift-page-builder") => "no", __('Yes', "swift-page-builder") => "yes"),
	            "description" => __("Select this if you want the video to be the full width of the page container (leave the above size blank).", "swift-page-builder")
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
	
	
	/* SINGLE IMAGE ASSET
	================================================== */ 
	class SwiftPageBuilderShortcode_spb_single_image extends SwiftPageBuilderShortcode {
	
	    public function content( $atts, $content = null ) {
	
	        $el_class = $width = $image_size = $animation = $frame = $lightbox = $image_link = $link_target = $caption = $el_position = $el_class = $image = '';
	
	        extract(shortcode_atts(array(
	            'width' => '1/1',
	            'image' => $image,
	            'image_size' => '',
	            'intro_animation' => 'none',
	            'frame'	=> '',
	            'lightbox' => '',
	            'image_link' => '',
	            'link_target' => '',
	            'caption' => '',
	            'el_position' => '',
	            'el_class' => ''
	        ), $atts));
			
			if ($image_size == "") { $image_size = "large"; }
			
	        $output = '';
	        $img = spb_getImageBySize(array( 'attach_id' => preg_replace('/[^\d]/', '', $image), 'thumb_size' => $image_size ));
	        $img_url = wp_get_attachment_image_src($image, 'large');
	        $el_class = $this->getExtraClass($el_class);
	        $width = spb_translateColumnWidthToSpan($width);
	        // $content =  !empty($image) ? '<img src="'..'" alt="">' : '';
	        $content = '';
	        
	        if ($intro_animation != "none") {
	        $output .= "\n\t".'<div class="spb_content_element spb_single_image sf-animation '. $frame .' '.$width.$el_class.'" data-animation="'.$intro_animation.'" data-delay="200">';           	        
	        } else {
	        $output .= "\n\t".'<div class="spb_content_element spb_single_image '. $frame .' '.$width.$el_class.'">';           
			}
			
	        $output .= "\n\t\t".'<div class="spb_wrapper">';
	        if ($lightbox == "yes") {
	        $output .= '<figure class="lightbox animated-overlay overlay-alt clearfix">';
	        } else {
	        $output .= '<figure class="clearfix">';
	        }
	        if ($image_link != "") {
		        $output .= "\n\t\t\t".'<a class="img-link" href="'.$image_link.'" target="'.$link_target.'">';
		        $output .= $img['thumbnail'];
		        $output .= '</a>';
		        if ($caption != "") {
			        $output .= '<figcaption class="image-caption">';
		            $output .= '<h4>'.$caption.'</h4>';			
		        	$output .= '</figcaption>';
		        }
	        } else if ($lightbox == "yes") {
		        $output .= $img['thumbnail'];
		        $output .= '<a class="view" href="'.$img_url[0].'" rel="image-gallery"></a>';
		        $output .= '<figcaption>';
		        if ($caption != "") {
			        $output .= '<div class="thumb-info">';	
			        $output .= '<h4>'.$caption.'</h4>';			
		        } else {
		      		$output .= '<div class="thumb-info thumb-info-alt">';	 
		        }
		        $output .= '<i class="ss-view"></i>';
		        $output .= '</figcaption>';
	        } else { 
	        	$output .= "\n\t\t\t".$img['thumbnail'];
	        }
	        $output .= '</figure>';
	        $output .= "\n\t\t".'</div> '.$this->endBlockComment('.spb_wrapper');
	        $output .= "\n\t".'</div> '.$this->endBlockComment($width);
	
	        //
	        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
	        return $output;
	    }
	
	    public function singleParamHtmlHolder($param, $value) {
	        $output = '';
	        // Compatibility fixes
	        $old_names = array('yellow_message', 'blue_message', 'green_message', 'button_green', 'button_grey', 'button_yellow', 'button_blue', 'button_red', 'button_orange');
	        $new_names = array('alert-block', 'alert-info', 'alert-success', 'btn-success', 'btn', 'btn-info', 'btn-primary', 'btn-danger', 'btn-warning');
	        $value = str_ireplace($old_names, $new_names, $value);
	        //$value = __($value, "swift-page-builder");
	        //
	        $param_name = isset($param['param_name']) ? $param['param_name'] : '';
	        $type = isset($param['type']) ? $param['type'] : '';
	        $class = isset($param['class']) ? $param['class'] : '';
	
	        if ( isset($param['holder']) == false || $param['holder'] == 'hidden' ) {
	            $output .= '<input type="hidden" class="spb_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="'.$value.'" />';
	            if(($param['type'])=='attach_image') {
	                $img = spb_getImageBySize(array( 'attach_id' => (int)preg_replace('/[^\d]/', '', $value), 'thumb_size' => 'thumbnail' ));
	                $output .= ( $img ? $img['thumbnail'] : '<img width="150" height="150" src="' . SwiftPageBuilder::getInstance()->assetURL('img/blank_f7.gif') . '" class="attachment-thumbnail" alt="" title="" />') . '<a href="#" class="column_edit_trigger' . ( $img && !empty($img['p_img_large'][0]) ? ' image-exists' : '' ) . '"><i class="spb-icon-single-image"></i>' . __( 'No image yet! Click here to select it now.', 'swift-page-builder' ) . '</a>';
	            }
	        }
	        else {
	            $output .= '<'.$param['holder'].' class="spb_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">'.$value.'</'.$param['holder'].'>';
	        }
	        return $output;
	    }
	}
	
	SPBMap::map( 'spb_single_image', array(
		"name"		=> __("Image", "swift-page-builder"),
		"base"		=> "spb_single_image",
		"class"		=> "spb_single_image_widget",
		"icon"		=> "spb-icon-single-image",
	    "params"	=> array(
			array(
				"type" => "attach_image",
				"heading" => __("Image", "swift-page-builder"),
				"param_name" => "image",
				"value" => "",
				"description" => ""
			),
			array(
			    "type" => "dropdown",
			    "heading" => __("Image Size", "swift-page-builder"),
			    "param_name" => "image_size",
			    "value" => array(__("Full", "swift-page-builder") => "full", __("Large", "swift-page-builder") => "large", __("Medium", "swift-page-builder") => "medium", __("Thumbnail", "swift-page-builder") => "thumbnail"),
			    "description" => __("Select the source size for the image (NOTE: this doesn't affect it's size on the front-end, only the quality).", "swift-page-builder")
			),
			array(
			    "type" => "dropdown",
			    "heading" => __("Image Frame", "swift-page-builder"),
			    "param_name" => "frame",
			    "value" => array(__("No Frame", "swift-page-builder") => "noframe", __("Border Frame", "swift-page-builder") => "borderframe", __("Glow Frame", "swift-page-builder") => "glowframe", __("Shadow Frame", "swift-page-builder") => "shadowframe"),
			    "description" => __("Select a frame for the image.", "swift-page-builder")
			),
			array(
			    "type" => "dropdown",
			    "heading" => __("Intro Animation", "swift-page-builder"),
			    "param_name" => "intro_animation",
			    "value" => array(
			    			__("None", "swift-page-builder") => "none",
			    			__("Fade In", "swift-page-builder") => "fade-in",
			    			__("Fade From Left", "swift-page-builder") => "fade-from-left",
			    			__("Fade From Right", "swift-page-builder") => "fade-from-right",
			    			__("Fade From Bottom", "swift-page-builder") => "fade-from-bottom",
			    			__("Move Up", "swift-page-builder") => "move-up",
			    			__("Grow", "swift-page-builder") => "grow",
			    			__("Fly", "swift-page-builder") => "fly",
			    			__("Helix", "swift-page-builder") => "helix",
			    			__("Flip", "swift-page-builder") => "flip",
			    			__("Pop Up", "swift-page-builder") => "pop-up",
			    			__("Spin", "swift-page-builder") => "spin",
			    			__("Flip X", "swift-page-builder") => "flip-x",
			    			__("Flip Y", "swift-page-builder") => "flip-y"
			    			),
			    "description" => __("Select an intro animation for the image that will show it when it appears within the viewport.", "swift-page-builder")
			),
			array(
			    "type" => "dropdown",
			    "heading" => __("Full width", "swift-page-builder"),
			    "param_name" => "full_width",
			    "value" => array(__("No", "swift-page-builder") => "no", __("Yes", "swift-page-builder") => "yes"),
			    "description" => __("Select if you want the image to be the full width of the page. (Make sure the element width is 1/1 too).", "swift-page-builder")
			),
			array(
			    "type" => "dropdown",
			    "heading" => __("Enable lightbox link", "swift-page-builder"),
			    "param_name" => "lightbox",
			    "value" => array(__("Yes", "swift-page-builder") => "yes", __("No", "swift-page-builder") => "no"),
			    "description" => __("Select if you want the image to open in a lightbox on click", "swift-page-builder")
			),
			array(
			    "type" => "textfield",
			    "heading" => __("Add link to image", "swift-page-builder"),
			    "param_name" => "image_link",
			    "value" => "",
			    "description" => __("If you would like the image to link to a URL, then enter it here. NOTE: this will override the lightbox functionality if you have enabled it.", "swift-page-builder")
			),
			array(
			    "type" => "dropdown",
			    "heading" => __("Link opens in new window?", "swift-page-builder"),
			    "param_name" => "link_target",
			    "value" => array(__("Self", "swift-page-builder") => "_self", __("New Window", "swift-page-builder") => "_blank"),
			    "description" => __("Select if you want the link to open in a new window", "swift-page-builder")
			),
			array(
			    "type" => "textfield",
			    "heading" => __("Image Caption", "swift-page-builder"),
			    "param_name" => "caption",
			    "value" => "",
			    "description" => __("If you would like a caption to be shown below the image, add it here.", "swift-page-builder")
			),
			array(
			    "type" => "textfield",
			    "heading" => __("Extra class name", "swift-page-builder"),
			    "param_name" => "el_class",
			    "value" => "",
			    "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "swift-page-builder")
			)
	    )
	));
	
	
	/* GOOGLE MAPS ASSET
	================================================== */ 
	class SwiftPageBuilderShortcode_spb_gmaps extends SwiftPageBuilderShortcode {
	
	    protected function content( $atts, $content = null ) {
	
	        $title = $address = $size = $zoom = $color = $saturation = $pin_image = $type = $el_position = $width = $el_class = '';
	        extract(shortcode_atts(array(
	            'title' => '',
	            'address' => '',
	            'size' => 200,
	            'zoom' => 14,
	            'color' => '',
	            'saturation' => '',
	            'pin_image' => '',
	            'type' => 'm',
	            'fullscreen' => 'no',
	            'el_position' => '',
	            'width' => '1/1',
	            'el_class' => ''
	        ), $atts));
	        $output = '';
	
	        if ( $address == '' ) { return null; }
	
	        $el_class = $this->getExtraClass($el_class);
	        $width = spb_translateColumnWidthToSpan($width);
			
	        $size = str_replace(array( 'px', ' ' ), array( '', '' ), $size);
	                
	        $img_url = wp_get_attachment_image_src($pin_image, 'full');
			
			if ($fullscreen == "yes" && $width == "col-sm-12") {
			$output .= "\n\t".'<div class="spb_gmaps_widget fullscreen-map spb_content_element '.$width.$el_class.'">';	          
	        } else {
	        $output .= "\n\t".'<div class="spb_gmaps_widget spb_content_element '.$width.$el_class.'">';	          
	        }
	        $output .= "\n\t\t".'<div class="spb_wrapper">';
	        $output .= ($title != '' ) ? "\n\t\t\t".'<h3 class="spb-heading"><span>'.$title.'</span></h3>' : '';
	        $output .= '<div class="spb_map_wrapper"><div class="map-canvas" style="width:100%;height:'.$size.'px;" data-address="'.$address.'" data-zoom="'.$zoom.'" data-maptype="'.$type.'" data-mapcolor="'.$color.'" data-mapsaturation="'.$saturation.'" data-pinimage="'.$img_url[0].'"></div></div>';
	        $output .= "\n\t\t".'</div> '.$this->endBlockComment('.spb_wrapper');
	        $output .= "\n\t".'</div> '.$this->endBlockComment($width);
			if ($fullscreen != "yes") {
	        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
	        }
	        global $sf_include_maps;
	        $sf_include_maps = true;
	        
	        return $output;
	    }
	}
	
	SPBMap::map( 'spb_gmaps',  array(
	    "name"		=> __("Google Map", "swift-page-builder"),
	    "base"		=> "spb_gmaps",
	    "class"		=> "",
		"icon"		=> "spb-icon-map-pin",
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
	            "heading" => __("Address", "swift-page-builder"),
	            "param_name" => "address",
	            "value" => "",
	            "description" => __('Enter the address that you would like to show on the map here, i.e. "Cupertino".', "swift-page-builder")
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Map Height", "swift-page-builder"),
	            "param_name" => "size",
	            "value" => "300",
	            "description" => __('Enter map height in pixels. Example: 300.', "swift-page-builder")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Map Type", "swift-page-builder"),
	            "param_name" => "type",
	            "value" => array(__("Map", "swift-page-builder") => "ROADMAP", __("Satellite", "swift-page-builder") => "SATELLITE", __("Hybrid", "swift-page-builder") => "HYBRID", __("Terrain", "swift-page-builder") => "TERRAIN"),
	            "description" => __("Select map display type. NOTE, if you set a color below, then only the standard Map type will show.", "swift-page-builder")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Map Zoom", "swift-page-builder"),
	            "param_name" => "zoom",
	            "value" => array(__("14 - Default", "swift-page-builder") => 14, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 15, 16, 17, 18, 19, 20)
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Map Color", "swift-page-builder"),
	            "param_name" => "color",
	            "value" => "",
	            "description" => __('If you would like, you can enter a hex color here to style the map by changing the hue. Please provide the # as well, e.g. #ff9900', "swift-page-builder")
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Map Saturation", "swift-page-builder"),
	            "param_name" => "saturation",
	            "value" => array(__("Color", "swift-page-builder") => "color", __("Mono", "swift-page-builder") => "mono"),
	            "description" => __("Set whether you would like the map to be in color or mono (black/white).", "swift-page-builder")
	        ),
	        array(
	        	"type" => "attach_image",
	        	"heading" => __("Custom Map Pin", "swift-page-builder"),
	        	"param_name" => "pin_image",
	        	"value" => "",
	        	"description" => "Choose an image to use as the custom pin for the address on the map. Upload your custom map pin, the image size must be 150px x 75px."
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Fullscreen Display", "swift-page-builder"),
	            "param_name" => "fullscreen",
	            "value" => array(__("No", "swift-page-builder") => "no", __("Yes", "swift-page-builder") => "yes"),
	            "description" => __("If yes, the map will be displayed from screen edge to edge.", "swift-page-builder")
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