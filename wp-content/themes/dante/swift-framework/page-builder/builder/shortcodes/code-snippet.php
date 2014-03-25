<?php

class SwiftPageBuilderShortcode_codesnippet extends SwiftPageBuilderShortcode {

    public function content( $atts, $content = null ) {

        $title = $pb_margin_bottom = $el_class = $width = $el_position = '';

        extract(shortcode_atts(array(
        	'title' => '',
        	'pb_margin_bottom'	=> '',
            'el_class' => '',
            'el_position' => '',
            'width' => '1'
        ), $atts));

        $output = '';

        $el_class = $this->getExtraClass($el_class);
        $width = spb_translateColumnWidthToSpan($width);
                
        if ($pb_margin_bottom == "yes") {
        $el_class .= ' pb-margin-bottom';
        }

        $output .= "\n\t".'<div class="spb_codesnippet_element '.$width.$el_class.'">';
        $output .= "\n\t\t".'<div class="spb_wrapper">';
        $output .= ($title != '' ) ? "\n\t\t\t".'<h3 class="spb-heading spb_codesnippet_heading"><span>'.$title.'</span></h3>' : '';
        $output .= "\n\t\t\t<code class='code-block'>".spb_format_content($content)."</code>";
        $output .= "\n\t\t".'</div> ' . $this->endBlockComment('.spb_wrapper');
        $output .= "\n\t".'</div> ' . $this->endBlockComment($width);

        //
        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        return $output;
    }
}

SPBMap::map( 'codesnippet', array(
    "name"		=> __("Code Snippet", "swift-page-builder"),
    "base"		=> "codesnippet",
    "class"		=> "spb_codesnippet",
    "icon"      => "spb-icon-code-snippet",
    "params"	=> array(
	    array(
	        "type" => "textfield",
	        "heading" => __("Widget title", "swift-page-builder"),
	        "param_name" => "title",
	        "value" => "",
	        "description" => __("Heading text. Leave it empty if not needed.", "swift-page-builder")
	    ),
	    array(
	        "type" => "textarea_html",
	        "holder" => "div",
	        "class" => "",
	        "heading" => __("Text", "swift-page-builder"),
	        "param_name" => "content",
	        "value" => __("<p>Add your code snippet here.</p>", "swift-page-builder"),
	        "description" => __("Enter your code snippet.", "swift-page-builder")
	    ),
	    array(
	        "type" => "dropdown",
	        "heading" => __("Margin below widget", "swift-page-builder"),
	        "param_name" => "pb_margin_bottom",
	        "value" => array(__('Yes', "swift-page-builder") => "yes", __('No', "swift-page-builder") => "no"),
	        "description" => __("Add a bottom margin to the widget.", "swift-page-builder")
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