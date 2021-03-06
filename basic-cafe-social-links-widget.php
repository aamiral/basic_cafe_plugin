<?php
/*
  Plugin Name: Basic Cafe Social Links Widget
  Plugin URI: http://haya&aleena.com
  Description: Links to social media
  Author: Haya & Aleena
  Author URI: http://haya&aleena.com
 */
 
 //Code retrieved from http://designmodo.com/wordpress-social-media-widget/

//Adds Basic_Cafe_Social_Profile widget

class Basic_cafe_Social_Links extends WP_Widget {

//Registers widget with WordPress.
   
     public function __construct() {
        parent::__construct(
                'Basic_Cafe_Social_Links',
                __('Social Links', 'translation_domain'), // Name
                array('description' => __('Links to social media', 'translation_domain'),)
        );
    }

// This adds the front-end display of the widget.

    public function widget($args, $instance) {

        $title = apply_filters('widget_title', $instance['title']);
        $facebook = $instance['facebook'];
        $twitter = $instance['twitter'];
        $instagram = $instance['instagram'];

// These are the social media links we have added to the widget

        $facebook_profile = '<a class="facebook" href="' . $facebook . '"><i class="fa fa-facebook"></i></a>';
        $twitter_profile = '<a class="twitter" href="' . $twitter . '"><i class="fa fa-twitter"></i></a>';
        $instagram_profile = '<a class="instagram" href="' . $instagram . '"><i class="fa fa-instagram"></i></a>';


        echo $args['before_widget'];

        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        echo '<div class="icons">';
        echo (!empty($facebook) ) ? $facebook_profile : null;
        echo (!empty($twitter) ) ? $twitter_profile : null;
        echo (!empty($instagram) ) ? $instagram_profile : null;
        echo '</div>';

        echo $args['after_widget'];
    }

//this function allows users to change the link of the social media platform on wordpress

    public function form($instance) {
        isset($instance['title']) ? $title = $instance['title'] : null;
        empty($instance['title']) ? $title = 'Social Links' : null;

        isset($instance['facebook']) ? $facebook = $instance['facebook'] : null;
        isset($instance['twitter']) ? $twitter = $instance['twitter'] : null;
        isset($instance['instagram']) ? $instagram = $instance['instagram'] : null;

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo esc_attr($facebook); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('instagram'); ?>"><?php _e('Instagram:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('instagram'); ?>" name="<?php echo $this->get_field_name('instagram'); ?>" type="text" value="<?php echo esc_attr($instagram); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo esc_attr($twitter); ?>">
        </p>

        <?php
    }

//Reviews, saves, and submits the content made by the user on wordpress

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
        $instance['facebook'] = (!empty($new_instance['facebook']) ) ? strip_tags($new_instance['facebook']) : '';
        $instance['twitter'] = (!empty($new_instance['twitter']) ) ? strip_tags($new_instance['twitter']) : '';
        $instance['instagram'] = (!empty($new_instance['instagram']) ) ? strip_tags($new_instance['instagram']) : '';

        return $instance;
    }

}

// registers Basic_Cafe_Social_Links widget
function register_basic_cafe_social_links() {
    register_widget('Basic_Cafe_Social_Links');
}

add_action('widgets_init', 'register_basic_cafe_social_links');

// enqueues css stylesheet
function basic_cafe_social_links_widget_css() {
    wp_enqueue_style('social-links-widget', plugins_url('basic-cafe-social-links-widget.css', __FILE__));
}

add_action('wp_enqueue_scripts', 'basic_cafe_social_links_widget_css');
