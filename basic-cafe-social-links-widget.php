<?php
/*
  Plugin Name: Basic Cafe Social Links Widget
  Plugin URI: http://haya&aleena.com
  Description: Links to social media
  Author: Haya & Aleena
  Author URI: http://haya&aleena.com
 */
 
 //Code taken from http://designmodo.com/wordpress-social-media-widget/

//Adds Basic_Cafe_Social_Profile widget

class Basic_cafe_Social_Links extends WP_Widget {

//Register widget with WordPress.
   
     public function __construct() {
        parent::__construct(
                'Basic_Cafe_Social_Links',
                __('Social Links', 'translation_domain'), // Name
                array('description' => __('Links to social media', 'translation_domain'),)
        );
    }

// Front-end display of widget.

    public function widget($args, $instance) {

        $title = apply_filters('widget_title', $instance['title']);
        $facebook = $instance['facebook'];
        $twitter = $instance['twitter'];

// social links

        $facebook_profile = '<a class="facebook" href="' . $facebook . '"><i class="fa fa-facebook"></i></a>';
        $twitter_profile = '<a class="twitter" href="' . $twitter . '"><i class="fa fa-twitter"></i></a>';


        echo $args['before_widget'];

        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        echo '<div class="icons">';
        echo (!empty($facebook) ) ? $facebook_profile : null;
        echo (!empty($twitter) ) ? $twitter_profile : null;
        echo '</div>';

        echo $args['after_widget'];
    }

//change links in the backend

    public function form($instance) {
        isset($instance['title']) ? $title = $instance['title'] : null;
        empty($instance['title']) ? $title = 'Social Links' : null;

        isset($instance['facebook']) ? $facebook = $instance['facebook'] : null;
        isset($instance['twitter']) ? $twitter = $instance['twitter'] : null;

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
            <label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo esc_attr($twitter); ?>">
        </p>

        <?php
    }

//Sanitize widget form values as they are saved.

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
        $instance['facebook'] = (!empty($new_instance['facebook']) ) ? strip_tags($new_instance['facebook']) : '';
        $instance['twitter'] = (!empty($new_instance['twitter']) ) ? strip_tags($new_instance['twitter']) : '';

        return $instance;
    }

}

// register Basic_Cafe_Social_Links widget
function register_basic_cafe_social_links() {
    register_widget('Basic_Cafe_Social_Links');
}

add_action('widgets_init', 'register_basic_cafe_social_links');

// enqueue css stylesheet
function basic_cafe_social_links_widget_css() {
    wp_enqueue_style('social-links-widget', plugins_url('basic-cafe-social-links-widget.css', __FILE__));
}

add_action('wp_enqueue_scripts', 'basic_cafe_social_links_widget_css');
