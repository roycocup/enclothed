<?php
/**
 * Plugin Name: My Extreme Facebook
 * Plugin URI: http://aaryanahmed.net/
 * Description: A widget that displays facebook page stream and likebox.
 * Version: 3.0.2
 * Author: MD AL-Amin
 * Author URI: http://aaryanahmed.net/
 * text_domain: albatross_facebook
 */
function af_action_init ()
{
    load_plugin_textdomain('albatross_facebook', false, basename( dirname( __FILE__ ) ) . '/languages/' );
}

add_action ('init', 'af_action_init');

add_action ('widgets_init', 'register_albatross_facebook');

function register_albatross_facebook ()
{
    register_widget ('Albatross_Facebook_Widget');
}

class Albatross_Facebook_Widget extends WP_Widget
{

    function Albatross_Facebook_Widget ()
    {
        $widget_ops = array ('classname' => 'albatross_facebook', 'description' => __ ('A widget for facebook likebox and stream ', 'albatross_facebook'));
        $control_ops = array ('width' => true, 'height' => true, 'id_base' => 'albatross_facebook-widget');
        $this->WP_Widget ('albatross_facebook-widget', __ ('Albatross Facebook', 'albatross_facebook'), $widget_ops, $control_ops);
    }

    function widget ($args, $instance)
    {
        extract ($args);
        $title = apply_filters ('widget_title', $instance['title']);
        $page_id = $instance['page_id'];
        $color = $instance['color'];
        $height = $instance['height'];
        if (empty ($page_id))
        {
            $page_id = 'h3mdsa.alamin';
        } else
        {
            $page_id = explode ('facebook.com/', $page_id);
            $page_id = $page_id[1];
        }
        $custom_bg = $instance['custom_bg'];
        $show_faces = $instance['show_faces'];
        if ($show_faces == 'on')
        {
            $show_faces = 'true';
        } else
        {
            $show_faces = 'false';
        }
        $show_stream = $instance['show_stream'];
        if ($show_stream == 'on')
        {
            $show_stream = 'true';
        } else
        {
            $show_stream = 'false';
        }
        $show_header = $instance['show_header'];
        if ($show_header == 'on')
        {
            $show_header = 'true';
        } else
        {
            $show_header = 'false';
        }
        $show_border = $instance['show_border'];
        if ($show_border == 'on')
        {
            $show_border = 'true';
        } else
        {
            $show_border = 'false';
        }

        echo $before_widget;

        $facebook_iframe_code = '<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2F' . $page_id . '&amp;width&amp;height&amp;colorscheme=' . $color . '&amp;show_faces=' . $show_faces . '&amp;header=' . $show_header . '&amp;stream=' . $show_stream . '&amp;show_border=' . $show_border . '" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:' . $height . 'px;" allowTransparency="true"></iframe>';

        echo '<div style="background-color:' . $custom_bg . ';">';
        
        // Display the widget title
        if ($title)
            echo $before_title . $title . $after_title;

        echo $facebook_iframe_code;
        echo '</div>';


        echo $after_widget;
    }

    function update ($new_instance, $old_instance)
    {
        $instance = $old_instance;

        //Strip tags from title and name to remove HTML
        $instance['title'] = strip_tags ($new_instance['title']);
        $instance['page_id'] = strip_tags ($new_instance['page_id']);
        $instance['custom_bg'] = strip_tags ($new_instance['custom_bg']);
        $instance['height'] = strip_tags ($new_instance['height']);
        $instance['show_faces'] = strip_tags ($new_instance['show_faces']);
        $instance['color'] = strip_tags ($new_instance['color']);
        $instance['show_stream'] = strip_tags ($new_instance['show_stream']);
        $instance['show_header'] = strip_tags ($new_instance['show_header']);
        $instance['show_border'] = strip_tags ($new_instance['show_border']);

        return $instance;
    }

    function form ($instance)
    {
        //Set up some default widget settings.
        $defaults = array ('title' => __ ('Facebook Feed', 'albatross_facebook'), 'page_id' => __ ('https://www.facebook.com/h3mdsa.alamin', 'albatross_facebook'),
            'show_faces' => __ (true, 'albatross_facebook'),
            'color' => __ ('light', 'albatross_facebook'),
            'show_stream' => __ (true, 'albatross_facebook'),
            'show_header' => __ (true, 'albatross_facebook'),
            'show_border' => __ (true, 'albatross_facebook'),
            'height' => __ ('590', 'albatross_facebook'),
            'show_info' => true);
        $instance = wp_parse_args ((array) $instance, $defaults);
        ?>

        <p>
            <label for="<?php echo $this->get_field_id ('title'); ?>"><?php _e ('Title:', 'albatross_facebook'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id ('title'); ?>" name="<?php echo $this->get_field_name ('title'); ?>" value="<?php echo $instance['title']; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id ('page_id'); ?>"><?php _e ('Facebook page URL', 'albatross_facebook'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id ('page_id'); ?>" name="<?php echo $this->get_field_name ('page_id'); ?>" value="<?php echo $instance['page_id']; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id ('custom_bg'); ?>"><?php _e ('Custom Background Color', 'albatross_facebook'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id ('custom_bg'); ?>" name="<?php echo $this->get_field_name ('custom_bg'); ?>" value="<?php echo $instance['custom_bg']; ?>" placeholder="#FFFFFF or Red/Blue etc" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id ('height'); ?>"><?php _e ('Height', 'albatross_facebook'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id ('height'); ?>" name="<?php echo $this->get_field_name ('height'); ?>" value="<?php echo $instance['height']; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id ('show_faces'); ?>"><?php _e ('Show Faces', 'albatross_facebook'); ?></label>
            <input class="widefat" class="checkbox" type="checkbox" <?php if ($instance['show_faces']) echo 'checked'; ?> id="<?php echo $this->get_field_id ('show_faces'); ?>" name="<?php echo $this->get_field_name ('show_faces'); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id ('color'); ?>"><?php _e ('Color', 'albatross_facebook'); ?></label>
            <select class="widefat" name="<?php echo $this->get_field_name ('color'); ?>">
                <option  <?php if ($instance['color'] == 'light') echo 'selected'; ?> value="light">Light</option>
                <option <?php if ($instance['color'] == 'dark') echo 'selected'; ?> value="dark">Dark</option>
            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id ('show_stream'); ?>"><?php _e ('Show Stream', 'albatross_facebook'); ?></label>
            <input class="checkbox widefat" type="checkbox" <?php if ($instance['show_stream']) echo 'checked'; ?> id="<?php echo $this->get_field_id ('show_stream'); ?>" name="<?php echo $this->get_field_name ('show_stream'); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id ('show_header'); ?>"><?php _e ('Show Header', 'albatross_facebook'); ?></label>
            <input class="checkbox widefat" type="checkbox" <?php if ($instance['show_header']) echo 'checked'; ?> id="<?php echo $this->get_field_id ('show_header'); ?>" name="<?php echo $this->get_field_name ('show_header'); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id ('show_border'); ?>"><?php _e ('Show Border', 'albatross_facebook'); ?></label>
            <input class="checkbox widefat" type="checkbox" <?php if ($instance['show_border']) echo 'checked'; ?> id="<?php echo $this->get_field_id ('show_border'); ?>" name="<?php echo $this->get_field_name ('show_border'); ?>" />
        </p>
        <?php
    }

}
